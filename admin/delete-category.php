<?php
    // Include defined constants.
    include('../config/constants.php');

    // Check whether the id and the image are passing the value with the button or not.
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // Get the Value and Delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the image if there's any.
        if($image_name != "")
        {
            // Image is available, hence remove it.
            $path = "../images/category/".$image_name;
            // After finding the path, remove the image.
            $remove = unlink($path);

            // If fail to remove the image, then add an error message and stop the process.
            if($remove == FALSE)
            {
                // Set a sesson message.
                $_SESSION['remove'] = "<div class = 'error'>Failed to Remove Category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process.
                die();
            }
        }

            // Delete data from the database
            // Sql query to delete data from the database
            $sql = "DELETE FROM tbl_category WHERE id = '$id'";
            // Executing the query.
            $res = mysqli_query($conn, $sql);
            // Check whether the data was deleted or not.
            if($res == TRUE)
            {
                // Sucess message and redirect.
                $_SESSION['delete'] = "<div class = 'success'>Category Deleted Successfully!</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                // Set Fail message and redirect.
                $_SESSION['delete'] = "<div class = 'error'>Category Not Deleted Successfully!</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }

    }
    else
    {
        // Redirect to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>