<?php include('partials/menu.php') ?>

    <!--Main  Content Section Strats -->
    <div class="Main-content">
        <div class="wrapper">
            <H1>Manage Category</H1>     
            <br><br>

            <?php 
                if(isset($_SESSION['add-category']))
                {
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['delete-category']))
                {
                    echo $_SESSION['delete-category'];
                    unset($_SESSION['delete-category']);
                }
                if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
                if(isset($_SESSION['update-cate']))
                {
                    echo $_SESSION['update-cate'];
                    unset($_SESSION['update-cate']);
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

            
            
                    <!-- button to add category--> 
                    <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                    <br><br>
                    
                    <table class="table-full">
                        <tr>
                            <th>Serial number</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>

                        <?php
                            //query to get all categories from database
                            $sql="SELECT * FROM table_category";
                            //execute query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            //Create serial number variable
                            $sn=1;
                            //check whther we hae data in database or not
                            if($count>0)
                            {
                                //we have data in database
                                //get the data and display
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image_name'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];

                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title ?></td>
                                        
                                        <td>ََ
                                            <?php  
                                                //check whether image name is available or not
                                                if($image_name!="")
                                                {
                                                    //display the image
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" width="100px" >

                                                    <?php
                                                }
                                                else
                                                {
                                                    //display the message
                                                    echo "<div class='error'>Image not Added</div>";
                                                }
                                            ?>
                                        </td>
                                        <td>ََ<?php echo $featured ?></td>
                                        <td>ََ<?php echo $active ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL ;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITEURL ;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?> " class="btn-delete">Delete Category</a>
                                            
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                //we do not have data
                                //we'll display the message inside table

                        ?>
                        
                                <tr>
                                    <td colspan="6"><div Class="error">No Category Added.</div></td>
                                </tr>
                                <?php 
                            }


                        ?> 

                    </table> 
            
            



        </div>
    </div>
                <!--lcontent ya5las hna -->

<?php include('partials/footer.php') ?>
