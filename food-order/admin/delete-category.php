<?php
    include('../config/constants.php');

    //check whetherthe id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //echo "get value and delete";
        $id =$_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file if available
        if($image_name !="")
        {
            //image is available. remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);
            //if failed to remove image then add an error message ad stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove']="<div class='error'>There is no Category image To delete from folder.</div>";

                //rediredt to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');

                //stop the process
                //die();

            }
        }

        //delete data from data base
        //sql query to delete data

        $sql = "DELETE FROM table_category WHERE id = $id";

        //redirect to manage category page with message
        $res  = mysqli_query($conn, $sql);

        //chack whther the data is deleted fro dtabase or not
        if($res==true)
        {
            //Set succes message and redirect
            $_SESSION['delete-category'] = "<div class='succes'>Category deleted succesfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set fail message and redirect
            $_SESSION['delete-category'] = "<div class='error'>Failed to delete category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        //redirect to category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>
