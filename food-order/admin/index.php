<?php include('partials/menu.php') ?>
                
                <!--lcontent yebda hna -->
                <div class="Main-content">
                    <div class="wrapper">
                        <H1>Dashboard</H1>  
                        <br><br>  
                        <?php 
                            if(isset($_SESSION['login']))
                            {
                                echo $_SESSION['login'];
                                unset($_SESSION['login']);
                            }
                        
                        ?>  
                        <br>
                        
                        <div class="col-4 text-center">
                            <?php 
                                $sql ="SELECT * FROM table_category";
                                //execute query
                                $res = mysqli_query($conn, $sql);
                                //count rows
                                $count = mysqli_num_rows($res);
                            ?>
                            <H1><?php echo $count;?></H1>
                            <br>
                            Categories
                        </div>

                        <div class="col-4 text-center">

                            <?php 
                                $sql2 ="SELECT * FROM table_food";
                                //execute query
                                $res2 = mysqli_query($conn, $sql2);
                                //count rows
                                $count2 = mysqli_num_rows($res2);
                            ?>

                            <H1><?php echo $count2; ?></H1>
                            <br>
                            Foods
                        </div>

                        <div class="col-4 text-center">
                             <?php 
                                $sql3 ="SELECT * FROM table_order";
                                //execute query
                                $res3 = mysqli_query($conn, $sql3);
                                //count rows
                                $count3 = mysqli_num_rows($res3);
                            ?>
                            <H1><?php echo $count3; ?></H1>
                            <br>
                            Total Orders
                        </div>

                        <div class="col-4 text-center">

                            <?php
                                //create sql query to get total revenue
                                //function
                                $sql4 = "SELECT SUM(total) AS Total FROM table_order WHERE status='Delivered'";

                                //execute query
                                $res4 = mysqli_query($conn, $sql4);

                                //get the value
                                $row4 = mysqli_fetch_assoc($res4);
                                //create the Total revenue
                                $total_revenue=$row4['Total'];

                            ?>

                            <H1><?php echo $total_revenue; ?>DA</H1>
                            <br>
                            Revenue Generated
                        </div>

                        <div class="clearfix"> </div>
                    </div>
                </div>
                <!--lcontent ya5las hna -->
                
<?php include('partials/footer.php') ?>


                


