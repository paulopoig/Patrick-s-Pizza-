<?php include('partials/menu.php'); ?>
  


<div class="main-content">
      
        <div class="wrapper">
            <br><br><br><br>
            <h1 class = "text-center">Add Category</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);

                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);

                }
            ?>

            <br><br>


            <!--- Category Form Starts --->
                <form action="" method = "POST" enctype = "multipart/form-data">
                    <table class= "tbl-30">
                      
                        <tr>
                            <td> Title: </td>
                            <td>
                                <input type="text" name = "title" placeholder = "Category Title">
                            </td>
                        </tr>

                        <tr>
                            
                            <td >Select Image: </td>
                            <td>
                                 <label class="custom-file-upload">
                                    <input type="file" name = "image" style = "border: none;">
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <td> Featured: </td>
                            <td>
                                <input type="radio" name = "featured" value = "Yes"> Yes
                                <input type="radio" name = "featured" value = "No"> No

                            </td>
                        </tr>

                        <tr>
                            <td> Active: </td>
                            <td>
                                <input type="radio" name = "active" value = "Yes"> Yes
                                <input type="radio" name = "active" value = "No"> No
                            </td>
                        </tr>

                        <tr>
                            <td colspan = "2">
                            <a onclick = "checker()"><input type="submit" name = "submit" value ="Add Category" class = "btn-admin"></a>
                            </td>
                        </tr>


                    </table>
                </form>

            <!--- Category Form Ends --->

            <?php 
            // Checks whether the button is clicked or not.

            if(isset($_POST['submit']))
            {
             $title = $_POST['title'];

            // For radio input type we need to check whether the button is selected or not.
                if(isset($_POST['featured']))
                {
                    // We need to get the value.
                    $featured = $_POST['featured'];
                }
                else
                {
                    // Set a default value.
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    // We need to get the value.
                    $active = $_POST['active'];
                }
                else
                {
                    // Set a default value.
                    $active = "No";
                }

                // Check whether the image is selected or not and set the value for image name accordingly.
                //print_r($_FILES['image']);
                //die(); // Break the code here.

                if(isset($_FILES['image']['name']))
                {
                    // Upload the image.
                    // To upload image we need img name and source path, and destination path.

                    $image_name = $_FILES['image']['name'];

                    // Upload image only if image is selected.
                    if($image_name != "")
                    {

                    

                    // Auto rename image if there's any duplicates.
                    // Get the extension of our image.
                    $ext = end(explode('.', $image_name));

                    // Rename now the image.
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext; // Sample Output: Food_Category_690.png

                    // Continue after getting its source path and destination path.

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    // Finally upload the image.
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not.
                    // And if the image is not uploaded, then we will stop the process and redirect with error message.

                    if($upload == FALSE)
                    {
                        // Error Message
                        $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                        // Stop the Process
                        die();
                        
                    }
                    }
                }
                else
                {
                    // Don't upload the image and set the image value as blank.
                    $image_name = "";
                }

                // Create a Sql Query
                $sql = "INSERT INTO tbl_category SET
                title = '$title', 
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                ";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Check whether the query executed or not

                if($res == TRUE)
                {
                    // Query executed and category added
                    $_SESSION['add'] = "<div class = 'success'>Category Added Successfully!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // Failed to add category.
                    $_SESSION['add'] = "<div class = 'error'>Category Failed to be Added Successfully!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }

            ?>
            <script> 
            function checker(){
                var result = confirm('\nYou are about to Add a Category\n\nConfirm? 🍕');
                if (result == false) {
                    event.preventDefault();
                }
            }
            </script>
            <?php
        
            ?>
       
        </div>
    </div>



<?php include('partials/footer.php'); ?>