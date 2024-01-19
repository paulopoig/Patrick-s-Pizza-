<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <br><br><br><br><br><br><br>
            <h2 class="text-center">Explore Foods</h2>

            <?php
                // Display all the categories that are active.
                // Create a query.
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                // Execute the query.
                $res = mysqli_query($conn, $sql);
                // Count the rows.
                $count = mysqli_num_rows($res);
                // Check whether the category is available or not.
                if($count > 0)
                {
                    // Category is available.
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id ?>&image_name=<?php echo $image_name; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        // Display image if there's any available.
                                        if($image_name == "")
                                        {
                                            // Image not available.
                                            echo "<div class = 'error'>Image Not Added.</div>"; 
                                        }
                                        else
                                        {
                                            // Image Available
                                            ?>
                                             <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="Pizza" class="img-responsive img-curve">
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
                    // Category is not available.
                    echo "<div class = 'error'>Category Not Found.</div>";
                }
            ?>;

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>