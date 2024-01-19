
<?php ob_start(); include('partials/menu.php'); ?>

<?php
    // Check if id is set or not.
    if(isset($_GET['id']))
    {
        // Get all the details.
        $id = $_GET['id'];

        // Sql query to get all the selected data.
        $sql2 = "SELECT * FROM tbl_food WHERE id = $id";

        // Executing the query
        $res2 = mysqli_query($conn, $sql2);

        // Get the value based on query executed.
        $row2 = mysqli_fetch_assoc($res2);

        // Get the individual value of the selected food.
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        ////// Stock ///////////
        $stock = $row2['stock'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];


    }
    else
    {
        // Redirect to manage food.
        header('location:'.SITEURL.'admin/manage.food.php');
    }

?>

    <div class="main-content">

        <div class="wrapper">
            <br><br><br><br>
            <h1 class = "text-center">Update Food</h1>
            <br><br><br>

            <form action="" method = "POST" enctype = "multipart/form-data">
                
                <table class = "tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name = "title" value = "<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                        <input type="number" name = "price" value = "<?php echo $price; ?>">  
                        </td>
                    </tr>

                       <!----STOCK ----->
                       <tr>
                        <td>Stock: </td>
                        <td>
                            <input type="number" name = "stock" value = "<?php echo $stock; ?>">
                        </td>
                    </tr>
                    <!----STOCK ----->

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                // Check whether image is available or not.

                                if($current_image == " ")
                                {
                                    // Image  Not Available
                                    echo "<div class = 'error'>No Image</div>";
                                }
                                else
                                {
                                    // Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width = "152px">
                                    <?php
                                }
                            
                            ?>
                        </td>
                    </tr>

                    <tr class = "new-img">
                        <td>New Image: </td>
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
                                    // Query and Executing it.
                                    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                                    $res = mysqli_query($conn, $sql);

                                    // Count the rows to check whether there exist data or not.
                                    $count = mysqli_num_rows($res);
                                   
                                    // Check whether the caterory is available or not.
                                    if($count > 0)
                                    {
                                        // Category Available
                                        // Getting the data from the database.
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];

                                            //echo "<option value = '$category_id'>$category_title</option>";

                                            ?>
                                           
                                             <option <?php if($current_category == $category_id){ echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        // Category not Available
                                        echo "<option value = '0' class = 'error'>Category Not Available</option>";
                                    }
                                ?>

                            </select>
                            
                        </td>
                    </tr>

                    <tr>
                        <td> Featured: </td>
                        <td>
                        <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name = "featured" value = "Yes">Yes  
                        <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name = "featured" value = "No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                        <input <?php if($featured == "Yes"){echo "checked";} ?>  type="radio" name = "active" value = "Yes">Yes  
                        <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name = "active" value = "No">No
                        </td>
                    </tr>

                    <tr>
                        <td>

                        <a onclick = "checker()"><input type="submit" name = "submit" value = "Update Food" class = "btn-admin-update"></a>
                        <input type="hidden" name = "id" value = "<?php echo $id; ?>">
                        <input type="hidden" name = "current_image" value = "<?php echo $current_image; ?>">
                    
                        </td>
                    </tr>

                </table>

            </form>

            <?php
                // We need to check the button is clicked or not.

                if(isset($_POST['submit']))
                {
                    // Get all the details from the form.

                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $price = $_POST['price'];
                    $stock = $_POST['stock'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    
                    // Upload the image if selected.
                    // Check if the upload button is clicked or not.
                    if(isset($_FILES['image']['name']))
                    {   
                        // Upload Button Clicked
                        $image_name = $_FILES['image']['name']; // New Image Name

                        // Check whether the file is available or not.

                        if($image_name != "")
                        {   
                            // Uploading New Image
                            // Image is available
                            // Rename the image
                            $ext = end(explode('.', $image_name)); // Gets the extension of the image (.jpg .png)  
                            $image_name = "Food_Name_".rand(000,999).".".$ext; // Sample output: Food Name 690

                            // To upload the image we need to get the source path and the destination path.

                            $src_path = $_FILES['image']['tmp_name']; // Source Path
                            $dest_path = "../images/food/".$image_name; // Destination Path

                            // Upload the image
                            $upload = move_uploaded_file($src_path, $dest_path);

                            // Check whether the image is uploaded or not.
                            if($upload == FALSE)
                            {   
                                // Give a session message, redirect, and terminate the process.
                                $_SESSION['upload'] = "<div class = 'error'>Failed to Upload New Image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();

                            // Remove the current image if a new image is uploaded.
                            // Remove Current Image if Available

                                if($current_image != "")
                                {
                                    // Current Image Available therefore deleting it.
                                    $remove_path = "../images/food/".$current_image;
                                    $remove = unlink($remove_path);

                                    // Check whether the image is removed or not.

                                    if($remove == FALSE)
                                    {
                                        // Fail to remove image.
                                        // Same process, error message, redirect, and terminate.
                                        $_SESSION['remove-failed'] = "<div class = 'error'>Fail to Remove Current Image.</div>";
                                        header('location:'.SITEURL.'admin/manage-food.php');
                                        die();
                                    }
                                }
                            }
                        }
                        else
                        {
                        $image_name = $current_image; // Default image when no new image is uploaded.
                        }
                    }
                    

                    

                    // Update the food in the database.
                    // Redirect and create a session message.

                    // Sql query to update the food in the database
                    $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        stock = $stock,
                        image_name = '$image_name',
                        category_id =  '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                    ";

                    // Executing the sql query...
                    $res3 = mysqli_query($conn, $sql3);

                    // Check whether the query is executed or not.

                    if($res3 == TRUE)
                    {   
                        // Query is executed and food is updated.
                        $_SESSION['update'] = "<div class = 'success'>Food Updated Successfully!</div>";
                        header('location:'.SITEURL.'admin/manage-food.php'); 
                    }
                    else
                    {
                        // Query has failed to be executed and the food is not updated.
                        $_SESSION['update'] = "<div class = 'error'>Food Failed to Update Successfully!</div>";
                        header('location:'.SITEURL.'admin/manage-food.php'); 
                    }



                    
                }

                ?>
                <script> 
                function checker(){
                    var result = confirm('\nYou are about to Update this Food\n\nConfirm? 🍕');
                    if (result == false) {
                        event.preventDefault();
                    }
                }
                </script>
                <?php
            ?>

        </div>

    </div>

<?php include('partials/footer.php'); ob_end_flush(); ?>
