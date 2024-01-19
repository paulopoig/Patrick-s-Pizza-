<?php 
ob_start();
include('partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <br><br><br><br>
        <h1 class = "text-center">Update Order</h1>
        <br><br><br><br>

        <?php 
            // Check whether id is set or not.

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                // Get all other details based on id.
                // Sql query to get order details.

                $sql = "SELECT * FROM tbl_order WHERE id = $id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    // There are values present in the database.

                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                    ?>

                    <?php
                }
                else
                {
                    // Details not available. Redirect to manage-order.php.
                    
                    header('location:'.SITEURL.'admin/manage-order.php');

                }
            }
            else
            {
                // If not...
                // Redirect to manage-order page.
                header('location:'.SITEURL.'admin/manage-order.php');

            }
        ?>

        <form action="" method = "POST">

            <table class="tbl-30-order">

                <tr>

                    <td>Food Name: </td>
                    <td><b><?php echo  "ㅤ".$food; ?></b></td>

                </tr>

                    <tr>

                    <td>Price: </td>
                    <td><b><?php echo "ㅤ₱ ".$price; ?></b></td>

                </tr>
                
                
                <tr>

                    <td>Qty: </td>
                    <td>
                        <input type="number" name = "qty" value = "<?php echo $qty; ?>">
                    </td>

                </tr>

                <tr>

                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status == "Ordered"){ echo "selected"; }?> value="Ordered">Ordered</option>
                            <option <?php if($status == "On Delivery"){ echo "selected"; }?> value="On Delivery">On Delivery</option>
                            <option <?php if($status == "Delivered"){ echo "selected"; }?> value="Delivered">Delivered</option>
                            <option <?php if($status == "Canceled"){ echo "selected"; }?> value="Canceled">Canceled</option>
                        </select>
                    </td>

                </tr>

                 <tr>

                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name = "customer_name" value = "<?php echo $customer_name; ?>">
                    </td>

                </tr>

                  <tr>

                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name = "customer_contact" value = "<?php echo $customer_contact; ?>">
                    </td>

                </tr>

                <tr>

                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name = "customer_email" value = "<?php echo $customer_email; ?>">
                    </td>

                </tr>
                
                <tr>

                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>

                </tr>

                 <tr>

                    <td colspan = "2"> 
                        <input type="hidden" name = "id" value = "<?php echo $id; ?>">
                        <input type="hidden" name = "price" value = "<?php echo $price; ?>">
                        <br>
                        <a onclick = "checker()"><input type="submit" name = "submit" value = "Update Order" class = "btn-admin"></a>

                    </td>
                    
                </tr>


            </table>

        </form>

        <?php
            // Check if update button is clicked or not.
           
            if(isset($_POST['submit']))
            {
                // Get all the values from the form.
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];
                
                
                // Update the values.

                $sql2 = "UPDATE tbl_order SET
              
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'

                WHERE id = $id
                ";

                $res2 = mysqli_query($conn, $sql2);

                // Check whether the order is updated or not.
                // Redirect to manage-order.php
                if($res2 == TRUE)
                {
                    // Order Updated
                    $_SESSION['update'] = "<div class = 'success text-center'>Order Updated Successfully!</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class = 'error text-center'>Order Not Updated Successfully!</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                
            }

            ?>
            <script> 
            function checker(){
                var result = confirm('\nYou are about to Update this Order\n\nConfirm? 🍕');
                if (result == false) {
                    event.preventDefault();
                }
            }
            </script>
            <?php    
            
        ?>

    </div>
</div>


<?php 
include('partials/footer.php'); 
ob_end_flush();
?>