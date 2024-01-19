<?php include('partials/menu.php'); ?>

    <div class="main-content">
        
        <div class="wrapper">
            <br><br><br><br><br>
            <h1 class = "text-center">Update Admin</h1>

            <br>><br><br><br><br>

            <?php
                // Getting the id of the selected admin.
                $id = $_GET['id'];
                // Sql query to get the details.
                $sql = "SELECT * FROM tbl_admin WHERE id = $id";
                // Ececute the query.
                $res = mysqli_query($conn, $sql);

                //Check whether the query is executed or not.

                if($res == TRUE)
                {
                    // Check if the data is available or not.
                    $count = mysqli_num_rows($res);
                    // Check whether we have admin data or not.
                    if($count == 1)
                    {
                        // Get the details.
                        //echo "Admin Available";

                        $row = mysqli_fetch_assoc($res);
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else
                    {
                        // Redirect to Manage Admin Page.
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

            ?>

            <form action="" method = "POST">
                <table class = "tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name = "full_name" value = "<?php echo $full_name ?>" class = "iadmin">
                        </td>   

                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name = "username" value = "<?php echo $username ?>" class = "iadmin">
                        </td>   

                    </tr>

                    <tr>
                            <td colspan = "2">
                                <input type= "hidden" name = "id" value = "<?php echo $id; ?>">
                                <a onclick = "checker()"><input type= "submit" name = "submit" value = "Update Admin" class = "btn-admin" class = "iadmin"></a>
                            </td>
                    </tr>

                </table>

            </form>
        <br><br>
        </div>

    </div>

<?php

// Check whether the submit button is clicked or not.

    if(isset($_POST['submit']))
    {
        // Get all the values from the form.

         $id = $_POST['id'];
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];

         // Create a sql query to update admin.

         $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id = '$id'
         ";

         // Execute now the query
         $res = mysqli_query($conn, $sql);

         // Check whether has executed successfully or not.

         if($res == TRUE){
            // Query executed and admin updated
            $_SESSION['update'] = "<div class = 'success'>Admin Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
         }
         else
         {
            // Fail to update admin
            $_SESSION['update'] = "<div class = 'error'>Admin Fail to Update Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
         }
    }

    ?>
    <script> 
    function checker(){
        var result = confirm('\nYou are about to Update this Admin\n\nConfirm? 🍕');
        if (result == false) {
            event.preventDefault();
        }
    }
    </script>
    <?php

?>

<?php include('partials/footer.php'); ?>