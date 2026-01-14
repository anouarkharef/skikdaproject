<?php include('partials-front/menu.php'); ?>

    <!-- Ccategorirs tebda hna -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                //display all the categories that are active
                //sql query
                $sql ="SELECT * FROM table_category WHERE active='Yes'";
                //exececute query
                $res = mysqli_query($conn, $sql);
                //count rows 
                $count = mysqli_num_rows($res);

                //check whether categories available or not
                if($count>0)
                {
                    //categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name =$row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not Found.</div>";

                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //categories not available
                    echo "<div class='error'>Category not Found.</div>";
                }

            
            ?>

            


            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- categories ta5las hna -->

<?php include('partials-front/footer.php'); ?>
  