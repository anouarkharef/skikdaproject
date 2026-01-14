
<?php
ob_start(); 
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>
    

        <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Title Of Food" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="10" placeholder="Description of The Food" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" min="0" step="0.01" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image" accept="image/*">
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" required>
                                <?php
                                    //create sql to get all active categories from database
                                    $sql="SELECT * FROM table_category WHERE active ='Yes'";
                                    //executing query
                                    $res= mysqli_query($conn, $sql);
                                    //count rows to check whether we have categories or not
                                    $count= mysqli_num_rows($res);
                                    
                                    if($count>0)
                                    {
                                        //we have categories
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $id=$row['id'];
                                            $title=$row['title'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No" > No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes" > Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name='submit' value="Add Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
            
                $title = mysqli_real_escape_string($conn, trim($_POST['title']));
                $description = mysqli_real_escape_string($conn, trim($_POST['description']));
                $price = mysqli_real_escape_string($conn, $_POST['price']);
                $category = mysqli_real_escape_string($conn, $_POST['category']);
                
                
                $featured = isset($_POST['featured']) ? mysqli_real_escape_string($conn, $_POST['featured']) : "No";
                $active = isset($_POST['active']) ? mysqli_real_escape_string($conn, $_POST['active']) : "Yes";
                
                
                $image_name = "";
                
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
                {
                    $original_name = $_FILES['image']['name'];
                    
                    
                    $ext_array = explode('.', $original_name);
                    $ext = strtolower(end($ext_array)); // تحويل إلى أحرف صغيرة
                    
                    
                    $allowed_ext = array("jpg", "jpeg", "png", "gif");
                    
                    if(in_array($ext, $allowed_ext))
                    {
                        
                        $image_name = "Food-" . time() . "-" . rand(1000, 9999) . "." . $ext;
                        
                    
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/" . $image_name;
                        
                        
                        if(move_uploaded_file($src, $dst))
                        {
                            
                            $image_name = mysqli_real_escape_string($conn, $image_name);
                        }
                        else
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image. Please try again.</div>";
                            ob_end_clean();
                            header('location:'.SITEURL.'admin/add-food.php');
                            exit();
                        }
                    }
                    else
                    {
                        $_SESSION['upload'] = "<div class='error'>Invalid image format. Only JPG, JPEG, PNG, GIF are allowed.</div>";
                        ob_end_clean();
                        header('location:'.SITEURL.'admin/add-food.php');
                        exit();
                    }
                }
                
                
                $sql2 = "INSERT INTO table_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'";
                
                $res2 = mysqli_query($conn, $sql2);
                
                if($res2)
                {

$_SESSION['add-food'] = "<div class='succes'>Food Added Successfully</div>";
                    ob_end_clean();
                    header('location:'.SITEURL.'admin/manage-food.php');
                    exit();
                }
                else
                {
                    
                    $error_msg = mysqli_error($conn);
                    $_SESSION['add-food'] = "<div class='error'>Failed to Add Food. Error: " . $error_msg . "</div>";
                    ob_end_clean();
                    header('location:'.SITEURL.'admin/add-food.php');
                    exit();
                }
            }
        ?>
    </div>
</div>

<?php 
ob_end_flush(); 
include('partials/footer.php'); 
?>


