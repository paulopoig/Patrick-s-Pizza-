<?php 
ob_start();
include('partials-front/menu.php'); 
?>

    <?php
        // Check whether food id is set or not.
        if(isset($_GET['food_id']))
        {
            // Get the food_id and details of the selected food. 
            $food_id = $_GET['food_id'];

            // Now get the tweet details of the selected food.
            $sql = "SELECT * FROM tbl_food WHERE id = '$food_id'";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                // Data Available
                // Get the data from DB.
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                //// Stock
                $stock = $row['stock'];
                $image_name = $row['image_name'];
            }
            else
            {
                // Data is not Available
                // Redirect to home page.
                header('location:'.SITEURL);
            }
        }
        else
        {
            // Redirect to home page.
            header('location:'.SITEURL);
        }

        
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="page-order">
        <div class="container">
            <br><br><br><br><br><br><br><br>
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            
            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            // Check whether the image is available, display if available.
                            if($image_name == "")
                            {
                                // Image not available.
                                echo "<div class = 'error'>Image Not Available</div>";
                            }
                            else
                            {   
                                // Image is available.
                                ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name ?>" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name = "food" value = "<?php echo $title; ?>">
                        
                        
                        <p class="food-price">₱ <?php echo $price; ?></p>
                        <input type="hidden" name = "price" value = "<?php echo $price; ?>">
                        <!--- Stock --->
                        <p class="food-price">Stock left: <?php echo $stock; ?></p>
                        <input type="hidden" name = "stock" value = "<?php echo $stock; ?>">
                        <!--- Stock --->
                        <div class="order-label">Quantity</div>
                        <input type="number" name= "qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                        
                <fieldset>

                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Anya Forger" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 09843xxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@anya.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. 00 Street, City" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                // Low Stock Message
                if($stock < 5){
                    echo'<script>alert("\nThe Product is Low in Stock. 🍕")</script>';
                }

                if($stock == 0){
                    $_SESSION['stock-zero'] = "<br><div class = 'error text-center'>The Food Has No Available Stock.</div>";
                    header('location:'.SITEURL);
                }

                // Check if submit button is clicked or not.
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form.
                    
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date('Y-m-d h:i:sa');
                    
                    $status = "Ordered"; // Ordered, On Delivery, Delivered, Cancelled.

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    
                   

                    // Save the order in database.

                    $sql2 = "INSERT INTO tbl_order SET
                        
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'   
                    ";
                    
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == TRUE && $stock < $qty){
                        $_SESSION['stock-error'] = "<br><br><div class = 'error text-center'>The Food Quantity Requested is Not Available. Try Again Next Time.</div>";
                        header('location:'.SITEURL);
                    }


                    else if($res2 == TRUE)
                    
                    {
                        // Query executed; Order Saved.
                        $sql4 =    "UPDATE tbl_food
                                    INNER JOIN tbl_order
                                    ON tbl_order.food = tbl_food.title
                                    SET tbl_food.stock = tbl_food.stock - tbl_order.qty
                                    WHERE tbl_food.id = '$food_id'
                                    ORDER BY tbl_order.id DESC
                                    ";

                        $res4 = mysqli_query($conn, $sql4);

                        $_SESSION['order'] = "<br><br><br><br><br><br><div class = 'success text-center'>Order Processed Succesfully! </div>";
                        header("location:".SITEURL.'receipt.php');
                    }

                    else
                    {
                        // Fail to save order.
                        header('location:'.SITEURL);
                    }

                }

            ?>
        <br><br><br><br><br><br><br><br>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); 
    ob_end_flush();
    ?>

    