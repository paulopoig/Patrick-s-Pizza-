<?php include('partials/menu.php'); ?>

       
        <!-- Main Content Section Starts --->
        <div class = "main-content">
            <div class = "wrapper">
               <br><br><br><br>
                <h1 class = "text-center"> Dashboard </h1>
               <br><br>
               <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                <br><br>

                     <div class = "col-4 text-center">

                     <?php
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                     ?> 

                        <h1><?php echo $count; ?></h1>
                        <br>
                        Categories
                     </div>

                     <div class = "col-4 text-center">

                     <?php
                        $sql2 = "SELECT * FROM tbl_food";
                        $res2 = mysqli_query($conn, $sql2);

                        $count2 = mysqli_num_rows($res2);
                     ?> 
               
                        <h1><?php echo $count2; ?></h1>
                        <br>
                        Foods
                     </div>

                     <div class = "col-4 text-center">

                     <?php
                        $sql3 = "SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn, $sql3);

                        $count3 = mysqli_num_rows($res3);
                     ?> 

                        <h1><?php echo $count3; ?></h1>
                        <br>
                         Total Orders
                     </div>
                     <div class = "col-4 text-center">
                   
                   <?php

                        // Execute function to sum the t-revenue.

                        $sql4 = "SELECT SUM(total) AS t_revenue FROM tbl_order WHERE status = 'Delivered'";
                        $res4 = mysqli_query($conn, $sql4);

                        $count4 = mysqli_num_rows($res4);

                        // Get the value.
                        $row = mysqli_fetch_assoc($res4);

                        // Getting the total revenue.
                        $t_revenue = $row['t_revenue'];
                     ?> 

                        <h1>₱ <?php echo $t_revenue; ?></h1>
                        <br>
                        Revenue Generated
                     </div>

                     <div class="clearfix"></div>
            </div>  
        </div>

        <!-- Main Content Section Ends --->

<?php include('partials/footer.php'); ?>     