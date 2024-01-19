<?php include('partials-front/menu.php'); ?>

    <?php
        // Check whether id is passed or not.
        if(isset($_GET['category_id']))
        {
            // Category id is set.
            $category_id = $_GET['category_id'];

            // Get the category title.
            // Query and execution
            $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
            $res = mysqli_query($conn, $sql);

            // Getting the value from the database.
            $row = mysqli_fetch_assoc($res);

            // Get the title
            $category_title = $row['title'];

        }
        else
        {
            // Category id is not set.
            // Redirect to home page.
            header('location:'.SITEURL);
        }
    ?>

   

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
           
            <h2 class="food-search text-center" style = "color:#799163;">Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

            <h2 class="text-center">Food Menu</h2>

            <?php
                // Create another sql query to get food based on category.
                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
                $res2 = mysqli_query($conn, $sql2);

                // Count the rows to check whether category foods is present or not.
                $count = mysqli_num_rows($res2);

                if($count > 0)
                {
                    // Food is available
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $decription = $row2['description'];
                        $price = $row2['price'];
                        $image_name = $row2['image_name'];

                        ?>
                            <div class="food-menu-box">
                              <div class="food-menu-img">
                                  <?php 
                                        // Check if img is available or not
                                        if($image_name == "")
                                        {
                                            // Image Not Available
                                            echo "<div class = 'error'>Image Not Available</div>";
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
                             <h4><?php echo $title; ?></h4>
                                <p class="food-price">₱ <?php echo $price; ?></p>
                                <p class="food-detail">
                                 <?php echo $decription; ?>
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
                    // Food is not available
                    echo "<div class = 'error'>No Food Available</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>
        <br><br><br><br><br><br><br><br>
    </section>
   
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>