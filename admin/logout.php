<?php 
    // for the constants.
    include('../config/constants.php');
    
    // Destroying the Session
    session_destroy(); // unsets $_SESSION['user']
    // Redirecting to login.php
    header('location:'.SITEURL.'admin/login.php');
?>