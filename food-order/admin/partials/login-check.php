<?php 
    //authorization-access control
     //check whether the user is logged or not
     if(!isset($_SESSION['user']))//if user session is not set
     {
        //user is not logged in
        $_SESSION['no-login-message']="<div class='error'>please login to acces Admin Panel</div>";
        //redirect to login page with message
        header('location:'.SITEURL.'admin/login.php');


     }
?>