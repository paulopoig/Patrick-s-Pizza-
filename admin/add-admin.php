<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
        <br><br><br><br>
            <h1 class = "text-center">Add Admin</h1>
        <br><br><br>   
               
               <?php 
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']); // Removing the Permanent Session Message.
                        }

                ?>
                <br /> <br />

                <form action="" method ="POST">
                    <table class = "tbl-30">
                        <tr>
                            <td>Full Name:</td>
                            <td><input type="text" name = "full_name" placeholder = "Enter Your Full Name" class = "iadmin"></td>
                            
                        </tr>

                        <tr>
                            <td>UserName:</td>
                            <td><input type="text" name = "username" placeholder = "Enter Your Username" class = "iadmin"></td>
                            
                        </tr>

                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name = "password" placeholder = "Enter Your Password" class = "iadmin"></td>
                            
                        </tr>
                       
                        <tr>
                            <td colspan = "2">
                               <a onclick = "checker()"><input type="submit" name = "submit" value = "Add Admin" class = "btn-admin"></a> 
                            </td>

                        </tr>

                    </table>
                </form>
        </div>
    </div>
<?php include('partials/footer.php') ?>

<?php
    // Process the Inputs and save it from the Database

    // Check the button's threshold

    if(isset($_POST['submit']))
    {
    
    // Getting the data from the From

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Password Encryption with md5

    // SQL Query to save the data from the Database

        $sql = "INSERT INTO tbl_admin SET 
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

    // Excuting  Query and Saving data into the Database
    //$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); // Database Connection
    //$db_select = mysqli_select_db($conn,'dbms') or die(mysqli_error()); // Selecting Database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    // Check whether the (Query is Executed) data inserted or not and display the appropriate message
    if($res == TRUE)
    {

        // Create a variable to display the message.
        $_SESSION['add'] = "<div class = 'success'>Admin Added Successfully.</div>";
        // Redirect page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Create a variable to display the message.
        $_SESSION['add'] = "<div class = 'error'>Admin Adding Failed Successfully.</div";
        // Redirect page to Add Admin
        header("location:".SITEURL.'admin/add-admin.php');
    }

    }
    ?>
    <script> 
    function checker(){
        var result = confirm('\nYou are about to Add an Admin\n\nConfirm? 🍕');
        if (result == false) {
            event.preventDefault();
        }
    }
    </script>
    <?php
?>