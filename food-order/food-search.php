<?php include('partials-front/menu.php'); ?>


    <!-- food search tebda hna -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                //get the search keyword
                $search = $_POST['search'];

             ?>
            
            <h2>Foods on Your Search <a href="#" class="text-red">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- food search tebda hna -->



    <!-- food menu tebda hna -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php

                
                //sql query to get food based on search keyword
                $sql = "SELECT * FROM table_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);
                //chack whether food available or no
                if($count>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>


                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //check whether image name available or not
                                    if($image_name=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;  ?>" alt ="chike Hawain Pizza" class="img-responsive img-curve">


                                        <?php
                                    }
                                
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?> Da</p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        

                        <?php
                    }
                }
                else
                {
                    //food not available
                    echo "<div class='error'>Food not Available.</div>";
                }

             ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!--food menu ta5las hna -->
<?php include('partials-front/footer.php'); ?>
