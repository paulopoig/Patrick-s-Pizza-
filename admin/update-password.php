<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <br><br><br><br><br>
        <h1 class = "text-center">Change Password</h1>
        <br><br><br><br><br>

        <?php 
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        ?>


        <form action="" method = "POST">
            <table class = "tbl-30">

                <tr>
                    <td> Current Password: </td>
                    <td>
                        <input type="password" name = "current_password" placeholder = "Enter Current Password" class = "ipassword">
                    </td>
                </tr>

                <tr>
                    <td> New Password: </td>
                    <td>
                        <input type="password" name = "new_password" placeholder = "Enter New Password" class = "ipassword">
                    </td>
                </tr>

                <tr>
                    <td> Confirm Password: </td>
                    <td>
                        <input type="password" name = "confirm_password" placeholder = "Re-enter New Password" class = "ipassword">
                    </td>
                </tr>

               <tr>
                   <td colspan = "2">
                       <input type="hidden" name = "id" value = "<?php echo $id; ?>">
                        <input type="submit" name = "submit" value = "Change Password" class = "btn-admin">
                   </td>
               </tr>
            
            </table>

        </form>
    </div>
</div>

<?php
// Check whether the submit button is clicked or not.
if(isset($_POST['submit']))
{
    //echo "Clicked";

    // Get the data from form.
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    // Check whether the user with current id and current password exists.

    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

    // Execute the query

    $res = mysqli_query($conn, $sql);

    if($res == TRUE)
    {
        // Check whether the data is a variabl or not.
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // The user exists and password can be changed
            // echo "User Found.";
            // Check whether the New Password and Confirm Password matched or not.

            if($new_password == $confirm_password)
            {
                //Update the password
                
                $sql2 = "UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id = $id
                ";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether the query executed or not.
                if($res2 == TRUE)
                {
                    // Display Success Message
                    $_SESSION['change-password'] = "<div class = 'success'>Password Changed Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    // Display Error Message
                    $_SESSION['change-password'] = "<div class = 'error'>Password Did Not Changed Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }
            else
            {
                // Redirect to Manage Admin with error message.
                $_SESSION['password-not-matched'] = "<div class = 'error'>Password Did Not Matched.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            
        } 
        else
        {
            // User does not exists, redirect.
            $_SESSION['user-not-found'] = "<div class = 'error'>Wrong Current Password.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }


    // Check whether the New Password and Confirm Password matched or not.

    // Change password if all above is true.
}
?>

<?php include('partials/footer.php'); ?>