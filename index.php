<?php include('partials-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">

    <!-- fOOD sEARCH Section Starts Here -->
    <?php
        if(isset($_SESSION['stock-error']))
        {
            echo $_SESSION['stock-error'];
            unset($_SESSION['stock-error']);
        }

        if(isset($_SESSION['stock-zero']))
        {
            echo $_SESSION['stock-zero'];
            unset($_SESSION['stock-zero']);
        }
    ?>
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST" class="food-search text-center">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

    <!-- fOOD sEARCH Section Ends Here -->

            <h2 class="text-center">Explore Foods</h2>

            <?php
                // Get the value from the databse.

                // Create SQL query to display categories inside the databse.
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // We need to count the rows.
                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    // Category Available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // Get the values like (title, image_name, id)
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id ?>&image_name=<?php echo $image_name; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        // Checking if image is available. Only we will display image if it's available.
                                        if($image_name == "")
                                        {   
                                            echo "<div class = 'error'>Image Not Available</div>";
                                        }
                                        else
                                        {
                                            // Image Available.
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    <br><br><br><br><br><br>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>

                        <?php
                    }   
                    
                }
                else
                {
                    // Category is not Available
                    // Display a message
                    echo "<div class = 'error'>Category Not Available.</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // Getting foods from the database that are active.
                // Always start with a query.
                $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";
                
                // Executing the query.
                $res2 = mysqli_query($conn, $sql2);

                // Count the number of rows to determine if data exist in the database.
                $count2 = mysqli_num_rows($res2);

                // Check whether the food is available.
                if($count2 > 0)
                {
                    // Food is available.
                    while($row = mysqli_fetch_assoc($res2))
                    {   
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                            // Check whether Image is Available or not.
                                            if($image_name == "")
                                            {
                                                // Image not Available
                                                echo "<div class = 'error'>Image Not Available.</div>";
                                            }
                                            else
                                            {
                                                // Image Available
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

                                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    // Food is not available.
                    echo "<div class = 'error'>Food Not Available.</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>
        <br><br><br><br><br>
        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>

    