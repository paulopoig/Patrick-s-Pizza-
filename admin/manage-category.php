<?php include('partials/menu.php'); ?>


    <div class="main-content">
        <div class = "wrapper"> 
            <br><br><br><br>
             <h1 class = "text-center"> Manage Category </h1>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);

                }
                
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);

                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);

                }

                if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);

                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);

                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);

                }

                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);

                }
            ?>

                <br><br>

                    <!--- Button to Add Category --->
                    <a href ="<?php echo SITEURL; ?>admin/add-category.php" class = "btn-primary-category"> Add Category </a>

                    
                    <br><br><br><br>

                        <table class = "tbl-full-category"> 
                            <tr>
                                <th> S.N. </th>
                                <th> Title </th>
                                <th> Image </th>
                                <th> Featured </th>
                                <th> Active </th>
                                <th> Actions </th>
                            </tr>

                            <?php
                                 
                                // Query to get all the categories from the databse.
                                $sql = "SELECT * FROM tbl_category";
                               
                                // Execute the query.
                                $res = mysqli_query($conn, $sql);

                                //Count Rows

                                $count = mysqli_num_rows($res);

                                // Check whether we have data in the database.

                                if($count > 0)
                                {
                                    // We have data in the database.
                                    // Get the data and display.
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        $image_name = $row['image_name'];
                                        $featured = $row['featured'];
                                        $active = $row['active'];
                                        
                                        

                                ?>
                                         <tr>
                                            <td> <?php echo $id; ?> </td>
                                            <td> <?php echo $title; ?> </td>

                                            <td>  
                                                <?php 
                                                    // Check whether the image name is available or not.
                                                    if($image_name != "")
                                                    {
                                                        // Display the Image
                                                        ?>

                                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width = "200px">
                                                       
                                                       <?php 
                                                        
                                                    }
                                                    else
                                                    {
                                                        // Display the Message
                                                        echo "<div class = 'error'>Image Not Added.</div>";
                                                    }
                                                ?>  
                                            </td>
                                            
                                            <td> <?php echo $featured; ?> </td>
                                            <td> <?php echo $active; ?> </td>
                                            <td> 
                                                <a href ="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class = "btn-secondary"> Update Category </a>
                                                <a onclick = "checker()" href ="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class = "btn-danger"> Delete Category </a>
                                            </td>
                                        </tr>       
                                <?php

                                    }

                                }
                                else
                                {
                                    // The database is empty.
                                    // We will display the message inside the table.
                                ?>

                                <tr>
                                    <td colspan = "6" ><div class="error">No Category Added.</div></td>
                                </tr>
                          
                                <?php
                               
                                }

                                ?>
                                <script> 
                                function checker(){
                                    var result = confirm('\nYou are about to Delete this Category\n\nConfirm? 🍕');
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