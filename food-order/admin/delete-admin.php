
<?php

    include('../config/constants.php') ;

    //get the id of admin to be deleted
    $id = $_GET['id'];

    //create sql query to delete admin
    $sql = "DELETE FROM table_admin WHERE  id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not
    if($res ==true)
    {
        //query executed succesfuly and admin deleted
        //echo "admin deleted";
        //create session variable to display message
        $_SESSION['delete'] = "<div class='succes'>Admin Deleted Successfully.</div>";

        //redirect to manage Admin page
        header("location:".SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //failed
        //echo "failed to delete admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div> ";
        header("location:".SITEURL.'admin/manage-admin.php');


        

    }

    //redirect to manage admin page with message(succes/error)


?>