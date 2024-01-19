<?php include('partials-front/menu.php'); ?>

    <?php $search = $_POST['search']; ?>

   
    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">

        <!-- fOOD sEARCH Section Starts Here -->

            <?php 
            $search = mysqli_real_escape_string($conn, $_POST['search']); 
            ?>
            <br><br><br><br><br><br>
            <h2 class = "text-center" style = "color:#799163;">Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
            <br><br><br>

        <!-- fOOD sEARCH Section Ends Here -->

            <h2 class="text-center">Food Menu</h2>
            <br>

            <?php
                
                // Sql query to get food based on search.
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // Execute the query.
                $res = mysqli_query($conn, $sql);

                // Check if food is available or not.
                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    // Food available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // Get the details 
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>
                            <div class="food-menu-box">
                                 <div class="food-menu-img">
                                     <?php
                                        // Check if image_name is available.

                                        if($image_name == "")
                                        {
                                            
                                            // Image not Available.
                                             echo "<div class = 'error'>Image Not Available.</div>";
                                           
                                        }
                                        else
                                        {
                                           // Image Available.

                                           ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                           <?php
                                        }
                                     ?>
                                    
                            </div>

                            <div class="food-menu-desc">
                                 <h4><?php echo $title; ?></h4>
                                    <p class="food-price">₱ <?php echo $price; ?></p>
                                    <p class="food-detail">
                                    <?php echo $description; ?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class = "btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    // Food is not available
                    echo "$search";
                }
            ?>

            <div class="clearfix"></div>

            
        <br><br><br><br><br>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>