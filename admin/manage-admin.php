<?php include('partials/menu.php'); ?>

    
        <!-- Main Content Section Starts --->
        <div class = "main-content">
            <div class = "wrapper">
                <br><br><br><br>
                <h1 class = "text-center"> Manage Admin </h1>
               

                <?php 
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']); // Removing the Permanent Session Message.
                        }
                        
                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }

                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }

                        if(isset($_SESSION['user-not-found']))
                        {
                            echo $_SESSION['user-not-found'];
                            unset($_SESSION['user-not-found']);
                        }

                        if(isset($_SESSION['password-not-matched']))
                        {
                            echo $_SESSION['password-not-matched'];
                            unset($_SESSION['password-not-matched']);
                        }

                        if(isset($_SESSION['change-password']))
                        {
                            echo $_SESSION['change-password'];
                            unset($_SESSION['change-password']);
                        }


                ?>

                <br /><br />

                 <!--- Button to Add Admin --->
                    <a href ="add-admin.php" class = "btn-primary-ma"> Add Admin </a>

                    
                <br /> <br /> <br />

                        <table class = "tbl-full"> 
                            <tr>
                                <th> Serial No. </th>
                                <th> Full Name </th>
                                <th> Username </th>
                                <th> Actions </th>
                            </tr>

                            <?php 
                                // Query to get the Admin
                                $sql = "SELECT * FROM tbl_admin";

                                // Execute the Query
                                $res = mysqli_query($conn, $sql);

                                // Check weather the Query is executed
                                
                                if($res == TRUE)
                                {
                                    // Count the Rows to Check we have data in the databse or not
                                    $count = mysqli_num_rows($res); // Function to get all the Rows in the Database

                                    // Check the num of Rows

                                    if($count > 0)
                                    {
                                        // We have data in the Database
                                        while($rows=mysqli_fetch_assoc($res))
                                        {
                                            // Using While Loop will get all the data from the DB
                                            // Will run as long as we have data from the DB

                                            // Get individual data
                                            $id = $rows['id'];
                                            $full_name = $rows['full_name'];
                                            $username = $rows['username'];

                                            // Display the values in our Table
                            ?>

                            <tr>
                                <td> <?php echo $id; ?> </td>
                                <td> <?php echo $full_name; ?>  </td>
                                <td> <?php echo $username; ?>  </td>
                                <td> 
                                    <a href ="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class = "btn-primary-admin">Change Password</a>
                                    <a href ="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class = "btn-secondary"> Update Admin </a>
                                    <a onclick = "checker()" href ="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class = "btn-danger"> Delete Admin </a>
                                </td>
                            </tr>
                                          
                            <?php

                                            
                                        }
                                    }
                                    else
                                    {
                                        // We do not have data in the Database
                                    }
                                }

                                    
                                ?>
                                <script> 
                                function checker(){
                                    var result = confirm('\nYou are about to Delete this Admin\n\nConfirm? 🍕');
                                    if (result == false) {
                                        event.preventDefault();
                                    }
                                }
                                </script>
                                <?php
                                
                            ?>

                        </table>
                    </div>  
            </div>

        <!-- Main Content Section Ends --->

 <?php include('partials/footer.php'); ?>

       