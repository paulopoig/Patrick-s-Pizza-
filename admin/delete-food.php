<?php 

// Include defined constants.
include('../config/constants.php');

// Check whether the value is passed on the url or not.

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // Start process to unlink.
    
    // Get the id and image name.
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
    // Remove the image if available.
    // Check first whether the image is availabe or not. Delete only if available.

    if($image_name != "")
    {
        // It have image therefore deleting the image.
        // Get the image path and remove the image file from the folder.

        $path = "../images/food/".$image_name;
        $remove = unlink($path);

        // Now check if the message is deleted or not.
        if($remove == FALSE)
        {
            // Fail to remove image.
            $_SESSION['upload'] = "<div class = 'error'>Failed to Remove Image Successfully!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            // Then stop the process.
            die();
        }
        
    }

    // Delete food from the database.
    // Create a query.
    $sql = "DELETE FROM tbl_food WHERE id = $id";
    // Execute the query.
    $res = mysqli_query($conn, $sql);

    // Check whether the query run successfully or not.
    // Redirect to manage food with system message.

    if($res == TRUE)
    {
        // The food is deleted!
        $_SESSION['delete'] = "<div class = 'success'>Food Deleted Successfully!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        // Fail to delete food.
        $_SESSION['delete'] = "<div class = 'error'>Food Not Deleted Successfully!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}

else
{
    // Redirect to Manage Food page/
    $_SESSION['unauthorized'] = "<div class = 'error'>Unauthorized Access!</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>