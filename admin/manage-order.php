<?php include('partials/menu.php'); ?>

<div class="main-content">
            <br><br><br><br><br>
        <div class = "wrapper-order"> 
             <h1 class = "text-center"> Manage Order </h1>

             <br>

             <?php

                if(isset($_SESSION['cancel-order']))
                {
                    echo $_SESSION['cancel-order'];
                    unset($_SESSION['cancel-order']);

                }

            ?>
                <br>
            <?php

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);

                }
             ?>

            <br> <br>

                        <table class = "tbl-full-order"> 
                            <tr>
                                <th class = "tbl-sn"> S.N. </th>
                                <th> Customer Name </th>
                                <th> Contact #</th>
                                <th> Email </th>
                                <th> Food </th>
                                <th> Price </th>
                                <th> Quantity </th>
                                <th> Total </th>
                                <th> Order Date </th>
                                <th> Delivery Address </th>
                                <th> Status </th>
                                <th> Action </th>
                                
                            </tr>

                            <?php 
                                // Get all data from the db.
                                $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // Display latest order at first.
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                    // Order Available
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        // Get all the order(s) details.
                                        $id = $row['id'];
                                        $food = $row['food'];
                                        $price = $row['price'];
                                        $qty = $row['qty'];
                                        $total = $row['total'];
                                        $order_date = $row['order_date'];
                                        $status = $row['status'];
                                        $customer_name = $row['customer_name'];
                                        $customer_contact = $row['customer_contact'];
                                        $customer_email = $row['customer_email']; 
                                        $customer_address = $row['customer_address'];

                                        ?>
                                                <tr class = "tbl-sn-con" >
                                                        <td class = "tbl-sn"> <?php echo $id; ?> </td>
                                                        <td> <?php echo $customer_name; ?> </td>
                                                        <td> <?php echo $customer_contact; ?> </td>
                                                        <td> <?php echo $customer_email; ?> </td>
                                                        <td> <?php echo $food; ?> </td>
                                                        <td> <?php echo $price; ?> </td>
                                                        <td> <?php echo $qty; ?> </td>
                                                        <td> <?php echo $total; ?> </td>
                                                        <td> <?php echo $order_date; ?> </td>
                                                       
                                                       
                                                       
                                                        <td> <?php echo $customer_address; ?> </td>
                                                        <td> 
                                                           
                                                           <?php 
   
                                                                   if($status == "Ordered")
                                                                   {
                                                                       echo "<label style = 'font-weight: bold;'> $status </label>";
                                                                   }
                                                                   else if($status == "On Delivery")
                                                                   {
                                                                       echo "<label style = 'color: #DE8E4E; font-weight: bold;'> $status </label>";
                                                                   }
                                                                   else if($status == "Delivered")
                                                                   {
                                                                       echo "<label style = 'color: #507B58; font-weight: bold;'> $status </label>";
                                                                   }
                                                                   else if($status == "Canceled")
                                                                   {
                                                                       echo "<label style = 'color: #AB3131; font-weight: bold;'> $status </label>";
                                                                   }
                                                           
                                                           ?> 
   
                                                         </td>
                                                    
                                                        <td class = "tbl-sn"> 
                                                            <a href ="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class = "btn-secondary"> Update Order </a>
                                                        </td>
                                                    </tr>

                                        <?php
                                    }
                                }
                                else
                                {
                                    // Order Not Available
                                    echo "<tr><td colspan ='12' class = 'error'>Order Not Available.</td></tr>";
                                }

                            ?>

                        </table>
                            </div>
                        </div>
        </div>
</div>

<?php include('partials/footer.php'); ?>  