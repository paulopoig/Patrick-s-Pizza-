<?php 
ob_start();
include('partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <br><br><br><br>
        <h1 class = "text-center">Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

            <form action="" method = "POST" enctype = "multipart/form-data">
                <table class = "tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name = "title" placeholder = "Enter Food Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                        <textarea name="description" cols="30" rows="5" placeholder = "Enter Food Description"></textarea>  
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name = "price" placeholder = "Enter Food Price">
                        </td>
                    </tr>
                    <!----STOCK ----->
                    <tr>
                        <td>Stock: </td>
                        <td>
                            <input type="number" name = "stock" placeholder = "Enter Food Stock">
                        </td>
                    </tr>
                    <!----STOCK ----->
                    <tr class = "new-img">
                        <td>Select Image: </td>
                        <td>
                            <label class = "custom-file-upload">
                                <input type="file" name = "image" style = "border: none;">
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">

                                <?php 
                                    // Create PHP code to display the cateogry in the dropdown coming from the databse.
                                    // Create sql to get all active categories.

                                    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                                   
                                    // Executing the query
                                    $res = mysqli_query($conn, $sql);

                                    // Count the rows to check whether the category exist or not.
                                    $count = mysqli_num_rows($res);

                                    if($count > 0)
                                    {
                                        // We have values.
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            // Create the details of the categories
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php

                                        }
                                        
                                    }
                                    else
                                    {
                                        // We don't have values.
                                        ?>
                                        <option value="0">No Categories Found</option>
                                        <?php
                                       
                                    }

                                    // Display it on the dropdown 
                                
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name = "featured" value = "Yes">Yes
                            <input type="radio" name = "featured" value = "No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name = "active" value = "Yes">Yes
                            <input type="radio" name = "active" value = "No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan = "2">
                            <a onclick = "checker()"><input type="submit" name = "submit" value = "Add Food" class = "btn-admin"></a>
                        </td>
                    </tr>

                </table>
            </form>

            <?php
                // We wil check whether the button is clicked or not.
                if(isset($_POST['submit']))
                {
                    // Add the food in the databse
                    // Get the data from form
                    
                    $title = $_POST['title'];
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $price = $_POST['price'];
                    $stock = $_POST['stock']; // Stock (remove in case)
                    $category = $_POST['category'];

                    // For the feature and active we need to check first it was clicked.
                    if(isset($_POST['featured']))
                    {
                         $featured = $_POST['featured'];

                    }
                    else
                    {
                        // Set default value.
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                         $active = $_POST['active'];

                    }
                    else
                    {
                        // Set default value.
                        $active = "No";
                    }

                    // Upload the image if selected
                    // Check whether the select image is clicked or not and upload the image only if the image is selected

                    if(isset($_FILES['image']['name']))
                    {
                        // Get the details of the selected image.
                        $image_name = $_FILES['image']['name'];
                        // Check whether the image is selected or not and upload image only if again, selected
                        if($image_name != "")
                        {
                            // It means image is selected
                            // We need to rename the image

                            // Firts get the image extension (.jpg .png)
                            $ext = end(explode('.',$image_name));

                            // Create new name for image
                            $image_name = "Food-Name ".rand(000,999).".".$ext; // Sample Output: Food-Name 690.jpg

                            // Getting the source path. It's the current location of the image which is like...
                            $src = $_FILES['image']['tmp_name'];

                            // Destination path... for the image to be uploaded
                            $dst = "../images/food/".$image_name;

                            // Then upload the image
                            $upload = move_uploaded_file($src, $dst);

                            // Check whether the image is uploaded or not.
                            if($upload == FALSE)
                            {
                                // Failed to upload the image. Error message and redirect. End Process.
                                $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image</div>";
                                header('location:'.SITEURL.'admin/add-food.php');
                            }
                        }
                        else
                        {

                        }
                    }
                    else
                    {   
                        // Set default value.
                        $image_name = "";
                    }
                    // Insert into the database
                    // Create a Sql query to save food or add food.
                    // For numerical value we do not need ( ' ' ) since it's a numerical value and not string.

                    $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        stock = $stock, 
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    // Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    // Check whether the data is inserted or not
                    if($res2 == TRUE)
                    {
                        // Data Inserted Successfully
                        $_SESSION['add'] = "<div class = 'success'>Food Added Successfully!</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');

                    }
                    else
                    {
                        // Fail to insert data.
                        $_SESSION['add'] = "<div class = 'error'>Food Not Added Successfully!</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');

                    }

                    
                    // We will redirect with message to manage food page
                }
                else
                {

                }
                ?>
                <script> 
                function checker(){
                    var result = confirm('\nYou are about to Add a Food\n\nConfirm? 🍕');
                    if (result == false) {
                        event.preventDefault();
                    }
                }
                </script>
                <?php
            ?>
    </div>
</div>




<?php 
ob_end_flush();
include('partials/footer.php'); 
?>