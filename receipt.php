<?php 
ob_start();
include('config/constants.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">

    <!--- Google Font ---->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cantata+One&display=swap" rel="stylesheet">

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    
    
    <?php 
                                // Get all data from the db.
                                $sql = "SELECT * FROM tbl_order ORDER BY id ASC"; // Display latest order at first.
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
                                    }
                                }

                                        ?>



<section class="page-receipt">
        <div class="container">
        <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>
        <br><br>
<h2 class="text-center text-white">Thank You for your Purchase!</h2>
                           


           
               
             

<div class="container" style = "background:none;">
    <div class="row" style = "background:none;">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" style = "background:none; background:linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.5));">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6" style = "background:none;">
                    <address>
                        <strong>Deliver to:</strong>
                        <br>
                        <?php echo $customer_name; ?>
                        <br>
                        <?php echo $customer_address; ?>
                        <br>
                        <abbr title="Phone">Cel #:</abbr> <?php echo $customer_contact; ?>
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: <?php echo $order_date = date('Y-m-d'); ?></em>
                    </p>
                    <p>
                        <em>Receipt #: <?php echo rand(000000, 999999); ?>W</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                    <br><br>
                </div>
                </span>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><em><?php echo $food; ?></em></h4></td>
                            <td class="col-md-1" style="text-align: center"> <?php echo $qty; ?> </td>
                            <td class="col-md-1 text-center">₱<?php echo $price; ?></td>
                            <td class="col-md-1 text-center">₱<?php echo $total; ?></td>
                        </tr>
                    
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong><br></strong>
                            </p>
                            <p>
                                <strong><br> </strong>
                            </p></td>
                            <td class="text-center">
                            <p>
                                <strong></strong>
                            </p>
                            <p>
                                <strong></strong>
                            </p></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>₱<?php echo $total; ?></strong></h4></td>
                        </tr>
                    </tbody>
                </table>

                
            </div>
        </div>
    </div>
                                
    <td>        
                <br>
                <a href ="<?php echo SITEURL; ?>" class = "btn btn-success" style = "margin-left: 370px; padding: 10px; margin-top: 5px; width: 150px;"> Continue Shopping <span class="glyphicon glyphicon-chevron-right"></a></span>
                </td>
                
                <form action="" method = "POST">
                <input type="submit" name = "submit" value = "Cancel Order" class = "btn btn-success btn-lg btn-block" style = "margin: 0 auto; padding: 10px; background: red; margin-top: 5px; width: 150px;">
                </form>

                <?php
                    if(isset($_POST['submit']))
                    {
                        $sql2 = "UPDATE tbl_order SET
                        status = 'Canceled'
                        WHERE id = $id
                        ";

                        $res2 = mysqli_query($conn, $sql2);

                        if($res2 == TRUE)
                        {
                            // Order Canceled
                            $_SESSION['cancel-order'] = "<div class = 'error text-center'>$customer_name Canceled Their Order.</div>";
                            header('location:'.SITEURL);
                        }
                        else
                        {
                            
                            header('location:'.SITEURL);
                        }
                    }
                ?>

    
               
        </div>
        <br><br><br><br><br><br><br><br><br><br>
    </section>


<?php 
ob_end_flush();
include('partials-front/footer.php'); 
?>