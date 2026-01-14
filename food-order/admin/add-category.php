<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>
            <?php 
                if(isset($_SESSION['add-category']))
                {
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }



            ?>

            <br><br>

            <!-- add category form start here -->
             <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                        <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name= "image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">yes
                            <input type="radio" name="featured" value="No">No
                        </td>

                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
             </form>
             
            <!-- add category form ends here -->
             <?php 
                //check whether the submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //echo 'clicked '
                    // get the value from category form
                    $title = $_POST['title'];
                    //for radio input we need to check whether the button checked or not
                    if(isset($_POST['featured']))
                    {
                        //get the value from form
                        $featured = $_POST['featured'];

                    }
                    else
                    {

                        $featured = "No";

                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    
                    }
                    else
                    {
                        $active = "No";
                    }

                    //check whether the image selected or not and set the value for image name
                    //print_r($_FILES['image']);
                    //die();
                    if(isset($_FILES['image']['name']))
                    {
                        //upload image
                        //to upload image we need image name the source path and distination path
                        $image_name = $_FILES['image']['name'];
                        //upload the image only if image selected
                        if($image_name !="")
                        {
                            

                        
                            //auto rename our image
                            //get the extention of our image
                            $ext = end(explode('.',$image_name));

                            //rename image
                            $image_name = "food_category_".rand(000, 999).'.'.$ext;


                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path ="../images/category/".$image_name;

                            //finaly upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //check whether the image is uploaded or not
                            //and if the image is not uploaded then we will stop the process and redirect with error message
                            if($upload==false)
                            {
                                $_SESSION['upload']= "<div class='error'>Failed to upload image</div>";

                                header('location:'.SITEURL.'admin/add-category.php');

                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        //don't upload image and set the image_name value as blank
                        $image_name="";
                    }


                    //create sql query to insert category into database
                    $sql = "INSERT INTO table_category SET
                        title ='$title',
                        image_name ='$image_name',
                        featured ='$featured',
                        active ='$active'
                    ";
                    //execute the query executed or not and data added or not
                    $res = mysqli_query($conn, $sql);

                    //check whether the query executed or not and data added or not
                    if($res==true)
                    {
                        $_SESSION['add-category']= "<div class='succes'>Category Added succesfully</div>";

                        header('location:'.SITEURL.'admin/manage-category.php');

                    }
                    else
                    {
                        $_SESSION['add-category']= "<div class='error>Failed to add category</div>";

                        header('location:'.SITEURL.'admin/manage-category.php');

                    }



                }

             ?>

            


        </div>
    </div>


<?php include('partials/footer.php') ?>
