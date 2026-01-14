<?php
    include('../config/constants.php');

    //echo "delete php";
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //process to delete
        // get id and image name
        $id =$_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the image if available
        if($image_name !="")
        {
            //get the image path
            $path = "../images/food/".$image_name;
            //remove image file from folder
            $remove = unlink($path);
            //check whether the image is removed or not
            if($remove==false)
            {
                //failed to remove image
                $_SESSION['remove-img'] ="<div class='error'>Failed to remove File.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        //delet food from data base
        $sql = "DELETE FROM  table_food WHERE id=$id";

        //execute  query
        $res = mysqli_query($conn, $sql);
        
        //check whether the query executed or not
        //redirect to manage food with session message
        if($res==true)
        {
            //food deleted
            $_SESSION['delete']="<div class='succes'>Food Deleted Successfuly</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to delete food
            $_SESSION['delete']="<div class='error'>Failed To Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        

    }
    else
    {
        //redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>