<?php
    include('../config/constants.php');

    //Destroy the session
    session_destroy();


    //redirect to login page
    header('location:'.SITEURL. 'admin/login.php');

?>    