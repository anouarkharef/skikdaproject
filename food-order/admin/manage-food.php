<?php include('partials/menu.php') ?>

                <!--lcontent yebda hna -->
                <div class="Main-content">
                    <div class="wrapper">
                        <H1>Manage Food</H1>
                        <br><br>
                        <?php
                        if(isset($_SESSION['add-food']))
                        {
                            echo $_SESSION['add-food'];
                            unset ($_SESSION['add-food']);
                        }
                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset ($_SESSION['delete']);
                        }
                        if(isset($_SESSION['remove-img']))
                        {
                            echo $_SESSION['remove-img'];
                            unset ($_SESSION['remove-img']);
                        }
                        if(isset($_SESSION['unauthorize']))
                        {
                            echo $_SESSION['unauthorize'];
                            unset ($_SESSION['unauthorize']);
                        }
                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];
                            unset ($_SESSION['update']);
                        }
                        

                        ?>
                        <br><br>
                        <!-- button to add admin--> 
                        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                        <br><br>
                        
                        <table class="table-full">
                            <tr>
                                <th>Serial number</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>featured</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                                //create a sql query to get all the food
                                $sql="SELECT * FROM table_food";
                                //execute the query
                                $res = mysqli_query($conn, $sql);
                                //count the rows to check whether we have food or not
                                $count= mysqli_num_rows($res);

                                //create serial number variable and set default value as 1
                                $sn=1;

                                if($count>0)
                                {
                                    //we have food in dataase 
                                    //get the food from databae and display
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //get value from individuels columns
                                        $id= $row['id'];
                                        $title= $row['title'];
                                        $price= $row['price'];
                                        $image_name = $row['image_name'];
                                        $featured =$row['featured'];
                                        $active = $row['active'];
                                        ?>


                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $title; ?></td>
                                            <td>$<?php echo $price; ?></td>
                                            <td>
                                                <?php
                                                    //chack whethe we have image or not
                                                    if($image_name=="")
                                                    {
                                                        //we do not have image
                                                        echo "<div class ='error'>Image not Added.</div>";
                                                    }
                                                    else
                                                    {
                                                        //we have image, display image
                                                        ?>
                                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?> " width="100px">
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $featured; ?></td>
                                            <td><?php echo $active; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-delete">Delete Food</a>
                                                
                                            </td>
                                        </tr>


                                        <?php
                                    }
                                }
                                else
                                {
                                    //food not added in database
                                    echo"<tr><td colspan='7' class='error'>Food Not Added Yet.</td></tr>";
                                }
                             ?>

                        </table>      
                        
                        



                    </div>
                </div>
                <!--lcontent ya5las hna -->

<?php include('partials/footer.php') ?>
