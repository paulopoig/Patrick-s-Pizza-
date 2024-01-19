<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Patrick's Pizza Login</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cantata+One&display=swap" rel="stylesheet">
    </head>

        <body class = "login-body">
            <img src="images/logo.png" class = "logo2" alt="logo">
            <div class="login">
                <br>
                <h1 class = "text-center">Login</h1>
                <br>
                <p class = "text-center">BSIT 2-3 | DBMS | Final Project </p>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            
                <!--- Login Form Starts Here! --->
                <form action="" method = "POST" class = "text-center">
                    Username: <br>
                    <input type = "text" name = "username" placeholder = "Enter Username"> <br><br>
                    Password: <br>
                    <input type = "password" name = "password" placeholder = "Enter Password"> <br><br>
                    <input type = "submit" name = "submit" value = "Login" class = "btn-admin-update">

                </form>
            </div>
        </body>

</html>

<?php 
    // Check if the submit button works.
    if(isset($_POST['submit']))
    {
        // Process for login
        // Get first the data from login form.
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $og_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $og_password);

        // Sql query to check whether the user with username and password exists.
        $sql ="SELECT * FROM tbl_admin WHERE username = '$username'";  
        // Execute the query.
        $res = mysqli_query($conn, $sql);

        // Check rows to check whether the user exists or not.
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // User exists.
            $_SESSION['login'] = "<div class = 'success'>Login Successful!</div>";
            $_SESSION['user'] = $username; // Checks if the user is logged in or not and logout will unset it.
            // Redirect
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // User not available.
            $_SESSION['login'] = "<div class = 'error text-center'>Wrong Credentials!</div><br>";
            header('location:'.SITEURL.'admin/login.php');
        }
        
    }
?>