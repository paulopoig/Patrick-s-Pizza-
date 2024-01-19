<?php include('partials/menu.php'); ?>
   

    <div class="main-content">
        <div class="wrapper">
            <br><br><br><br>
            <h1 class = "text-center">Update Category</h1>
            <br /><br />

            <?php 
                // Check whether the id is set or not.
                if(isset($_GET['id']))
                {
                    // Get the id and all other details.
                    $id = $_GET['id'];

                    // Create sql query
                    $sql = "SELECT * FROM tbl_category WHERE id = '$id'";

                    // Execute the query
                    $res = mysqli_query($conn, $sql);

                    // Count the rows to check whether the id is valid or not.
                    $count = mysqli_num_rows($res);

                    // Check if count is equal to one.
                    if($count == 1)
                    {
                        // Get all the data.
                        $row = mysqli_fetch_assoc($res);

                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                    }
                    else
                    {
                        // Redirect to manage category with system message.
                        $_SESSION['no-category-found'] = "<div class = 'error'>Category Not Found!</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                }
                else
                {
                    // Redirect to manage category.
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            ?>

            <form action= "" method = "POST" enctype = "multipart/form-data">
               
                <table class="tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type ="text" name = "title" value = "<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image != "")
                                {
                                    // Display the Image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width = "152px">
                            <?php
                                } 
                                else
                                {
                                    // Display a Message
                                    echo "<div class = 'error'>ㅤNo Image Available</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td>
                            <label class="custom-file-upload">
                                <input type ="file" name = "image" style = "border: none;">
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured == "Yes") { echo "checked"; } ?> type ="radio" name = "featured" value = "Yes">Yes
                            <input <?php if($featured == "No") { echo "checked"; } ?> type ="radio" name = "featured" value = "No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active == "Yes") { echo "checked"; } ?> type ="radio" name = "active" value = "Yes">Yes
                            <input <?php if($active == "No") { echo "checked"; } ?> type ="radio" name = "active" value = "No">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                        <input type="hidden" name = "current_image" value = "<?php echo $current_image; ?>">
                        <input type="hidden" name = "id" value = "<?php echo $id; ?>">
                        <a onclick = "checker()"><input type="submit" name = "submit" value = "Update Category" class = "btn-admin"></a>
                        </td>
                    </tr>

                </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    // Get all the values from our form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    // Updating the new image if selected 
                    // Check whether the image is selected or not
                    
                    if(isset($_FILES['image']['name']))
                    {
                        // Get the image details
                        $image_name = $_FILES['image']['name'];

                        // Check whether the image is available or not.
                        if($image_name != "")
                        {
                            // Image is available
                            // [A] Upload the new image 
                            
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
                                header('location:'.SITEURL.'admin/manage-category.php');
                                // Stop the Process
                                die();
                                
                            }

                            // [B] Remove the current/old image if available
                            if($current_image != "")
                            {
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);
    
                                // Check whether the image is remove or not and if fail to remove, then display a message, then stop the process.
                                if($remove == FALSE)
                                {
                                    // Fail to remove message
                                    $_SESSION['failed-remove'] = "<div class = 'error'>Failed to Remove the Current Image.</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }
                            
                        }
                        else
                        {
                            // Not Available
                        }

                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    // Update the Database
                    // Sql Query
                    $sql2 = "UPDATE tbl_category SET
                        title = '$title', 
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = '$id'
                    ";
                    // Execute the Query

                    $res2 = mysqli_query($conn, $sql2);

                    // Redirect to Manage Category with Message
                    // Check whether the query has executed or not.
                    if($res2 == TRUE)
                    {
                        // Category updated
                        $_SESSION['update'] = "<div class = 'success'>Category Updated Successfully!</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        // Fail to update category
                        $_SESSION['update'] = "<div class = 'error'>Category Failed to Update Successfully!</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    
                }

                ?>
                <script> 
                function checker(){
                    var result = confirm('\nYou are about to Update this Category\n\nConfirm? 🍕');
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
