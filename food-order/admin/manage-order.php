<?php include('partials/menu.php') ?>

                <!--lcontent yebda hna -->
                <div class="Main-content">
                    <div class="wrapper">
                        <H1>Manage Order</H1>  
                        <br><br>
                        <?php
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset ($_SESSION['update']);
                            }
                        ?>
                        <br><br>
                        
                        <table class="table-full">
                            <tr>
                                <th>Serial number</th>
                                <th>Food</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Customer Name</th>
                                <th>Customer Contact</th>
                                <th>Email</th>
                                <th>Adress</th>
                                <th>Actions</th>
                            </tr>
                            <?php 
                                //get all the orders from database
                                $sql= "SELECT * FROM table_order ORDER BY id DESC";
                                //execute query
                                $res = mysqli_query($conn, $sql);
                                //count the rows
                                $count= mysqli_num_rows($res);
                                $sn =1;
                                if($count>0)
                                {
                                    //order Available
                                    while($row= mysqli_fetch_assoc($res))
                                    {
                                        //get all the order details
                                        $id= $row['id'];
                                        $food= $row['food'];
                                        $price= $row['price'];
                                        $quantity= $row['quantity'];
                                        $total= $row['total'];
                                        $order_date= $row['order_date'];
                                        $status= $row['status'];
                                        $customer_name= $row['customer_name'];
                                        $customer_contact= $row['customer_contact'];
                                        $customer_email= $row['customer_email'];
                                        $customer_adress= $row['customer_adress'];
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++ ;?></td>
                                            <td>ََ<?php echo $food ;?></td>
                                            <td><?php echo $price;?> DA</td>
                                            <td><?php echo $quantity;?></td>
                                            <td><?php echo $total;?> DA</td>
                                            <td><?php echo $order_date;?></td>

                                            <td>
                                                <?php 
                                                    
                                                    if($status=="Ordered")
                                                    {
                                                        echo "<label>$status</label>";
                                                    }
                                                    elseif($status=="On Delivery")
                                                    {
                                                        echo "<label style='color: orange;'>$status</label>";
                                                    }
                                                    elseif($status=="Delivered")
                                                    {
                                                        echo "<label style='color: green;'>$status</label>";
                                                    }
                                                    elseif($status=="Cancelled")
                                                    {
                                                        echo "<label style='color: red;'>$status</label>";
                                                    }
                                                 ?>
                                            </td>

                                            <td><?php echo $customer_name;?></td>
                                            <td><?php echo $customer_contact;?></td>
                                            <td><?php echo $customer_email;?></td>
                                            <td><?php echo $customer_adress;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    
                                }
                                else
                                {
                                    //orders not available
                                    echo "<tr><td colspan ='12' class='error'></td>0rders not Available.</tr>";
                                }
                            ?>

                            

                            
                        </table>    
                        
                        



                    </div>
                </div>
                <!--lcontent ya5las hna -->

<?php include('partials/footer.php') ?>
