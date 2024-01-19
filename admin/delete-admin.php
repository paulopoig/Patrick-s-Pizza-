<?php

    // Include constant.php file here
   include('../config/constants.php');

    // Get the id of the admin - to be deleted
    
    $id = $_GET['id'];
   
    // Create sql query to delete the admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";
    
    // Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query execute successfully or not.

    if($res == TRUE)
    {
        // echo "Admin Deleted";
        // Create SESSION variable to display a Message.
        $_SESSION['delete'] = "<div class = 'success'>Admin Deleted Successfully.</div>";
        // Redirect to Manage Admin page.
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class = 'error'>Admin Failed to be Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    // Redirect to manage-admin page, with message. Success or Error.

?>