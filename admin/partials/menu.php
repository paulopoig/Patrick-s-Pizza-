<?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>

<html>


    <head>
        <meta charset="UTF-8">
        <!-- Important to make website responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <title> Patrick's Pizza - Admin </title>
        <link rel="stylesheet" href="../css/admin.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cantata+One&display=swap" rel="stylesheet">
    </head>

    <body>

        <!-- Menu Section Starts --->
        <div class = "menu text-center">
            <img class = "logo" src = "images/logo.png" alt = "logo">
            <div class = "wrapper">
                <ul> 
                    <li><a href = "index.php">Home</a></li>
                    <li><a href = "manage-admin.php">Admin</a></li>
                    <li><a href = "manage-category.php">Category</a></li>
                    <li><a href = "manage-food.php">Food</a></li>
                    <li><a href = "manage-order.php">Order</a></li>
                    <li><a onclick = "checker_logout()" href = "logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

    
    <script> 
    function checker_logout(){
        var result = confirm('\nYou are about to Logout\n\nConfirm? 🍕');
        if (result == false) {
            event.preventDefault();
        }
    }
    </script>
    

        
        <!-- Menu Section Ends --->

      
