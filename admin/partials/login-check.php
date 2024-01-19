<?php 

    // Authorization or access control
    // Check whether the user is logged in or not.

    if(! isset($_SESSION['user'])) // If the user session is not set.
    {
        // The user is not logged in.
        // Redirect to login.php with message.
        $_SESSION['no-login-message'] = "<div class = 'error text-center'>Please Login to Access Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

?>