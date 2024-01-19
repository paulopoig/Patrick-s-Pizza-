<?php include('partials/menu.php'); ?>

<div class="main-content">

        <div class = "wrapper"> 
        <br><br><br>
             <h1 class = "text-center"> Manage Food </h1>
                <br> <br>
                <!--- Button to Add Food --->
                <a href ="<?php echo SITEURL; ?>admin/add-food.php" class = "btn-primary"> Add Food </a>

                
                <br /> <br /><br />

                <?php
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        } 

                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        } 

                        if(isset($_SESSION['upload']))
                        {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        } 

                        if(isset($_SESSION['unauthorized']))
                        {
                            echo $_SESSION['unauthorized'];
                            unset($_SESSION['unauthorized']);
                        } 

                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        } 
                 ?>

                 <br><br>

                <table class = "tbl-full-category"> 
                        <tr>
                        <th> S.N. </th>
                        <th> Title </th>
                        <th> Price </th>
                        <th> Image </th>
                        <th> Stock </th>
                        <th> Active </th>
                        <th> Actions </th>
                        </tr>

                        <?php
                                // Create SQL query to get all the data food.
                                $sql = "SELECT * FROM tbl_food";

                                // Execute the query
                                $res = mysqli_query($conn, $sql);

                                // Count the rows to know whether there is food data or not.
                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                        // We have food in the database.
                                        // Get the food from the database and finally display it.

                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                                // Get the value from individual columns.
                                                $id = $row['id'];
                                                $title = $row['title'];
                                                $price = $row['price'];
                                                $stock = $row['stock'] ?? null;
                                                $image_name = $row['image_name'];
                                                $featured = $row['featured'];
                                                $active = $row['active'];
                                                
                                                ?>
                                                          <tr>
                                                                <td> <?php echo $id; ?> </td>
                                                                <td> <?php echo $title; ?> </td>
                                                                <td> ₱<?php echo $price; ?> </td>
                                                                <td> 
                                                                        <?php  
                                                                        
                                                                                // Check whether we have image name or not.
                                                                                if($image_name != "")
                                                                                {
                                                                                      // We have image 
                                                                                      ?>
                                                                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" width = "100px">
                                                                                      <?php
                                                                                }
                                                                                else
                                                                                {
                                                                                        // We do not have image
                                                                                        echo "<div class = 'error'>No Image</div>";
                                                                                }
                                                                        ?> 
                                                                </td>
                                                        
                                                                <td> <?php echo $stock; ?> </td>
                                                                <td> <?php echo $active; ?> </td>
                                                                
                                                                <td> 
                                                                        <a href ="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class = "btn-secondary"> Update Food </a>
                                                                        <a onclick = "checker()" href ="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class = "btn-danger"> Delete Food </a>
                                                                </td>
                                                         </tr>
                                                <?php
                                        }
                                }
                                else
                                {
                                        // Food not added in the database
                                        echo "<tr><td colspan = '7'class = 'error'>Food Not Added Yet</td></tr>";
                                }



                                ?>
                                <script> 
                                function checker(){
                                    var result = confirm('\nYou are about to Delete this Food\n\nConfirm? 🍕');
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
<?php include('partials/footer.php'); ?>  