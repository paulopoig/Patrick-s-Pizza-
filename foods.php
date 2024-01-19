<?php include('partials-front/menu.php'); ?>


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">

        <!-- fOOD sEARCH Section Starts Here -->
            
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST" class="food-search text-center">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
            <br>
        <!-- fOOD sEARCH Section Ends Here -->
            <h2 class="text-center">Food Menu</h2>
            <br>

            <?php
                // Create a query to display all active food in the database
                $sql = "SELECT * FROM tbl_food WHERE active = 'Yes'";

                // Execute the query.
                $res = mysqli_query($conn, $sql);

                // Count the rows to check if food is available or not.
                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    // Food(s) is/are available.
                    // We will use while loop to display all the foods fromt the database.
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // Get the values from the database.

                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                        ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            // Check if image is available.
                                            if($image_name == "")
                                            {
                                                // Image not Available
                                                echo "<div class = 'error'>Image Not Available.</div>"; 
                                            }
                                            else
                                            {
                                                // Image Available
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                <?php
                                            }
                                        ?>
                                        
                                     </div>

                                    <div class="food-menu-desc">
                                         <h4><?php echo $title; ?> </h4>
                                            <p class="food-price">₱ <?php echo $price; ?></p>
                                                <p class="food-detail">
                                                    <?php echo $description; ?>
                                                </p>
                                                <br>

                                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                        <?php
                    }

                    
                }
                else
                {
                    // Food not available.
                    echo "<div class = 'error'>Food Not Found.</div>";
                }

            ?>

            

            <div class="clearfix"></div>
            
            <br><br><br><br><br>
        </div>

    </section>
    
    
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php'); ?>