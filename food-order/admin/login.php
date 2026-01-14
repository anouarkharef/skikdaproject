<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login- Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
    <div class="login">
        <h1 claas= >Login</h1><br>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        
        ?>
        <br><br>

        <!-- Login form yebda hna -->

        <form action="" method="POST" >
            Username: <br>
            <input type="text" name="username" placeholder ="Enter Username"> <br><br>
            Password: <br>
            <input type="password" name="password" placeholder ="Enter Password"><br><br>

            <input type="submit" name="submit" value="login" class="btn-primary">
        </form>
        <br>

        <!-- Login form ya5las hna -->

        <p class= >Created By - <a href="#">Anouar Kharef</a></p>

    </div>
    </body>
</html>
<?php 
        //check wheter the submit button clicked or not
        if(isset($_POST['submit']))
        {
            //1.get the data from login form
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            //2.SQL to check whether the user with username exists or not
            $sql = "SELECT * FROM table_admin WHERE username='$username' AND password='$password'" ;

            //execute the query
            $res =mysqli_query($conn,$sql);

            // count rows to check whether the user exists or not
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //use available and login success
                $_SESSION['login']="<div class='succes'>Login Successful</div>";
                $_SESSION['user']= $username; //check whether the user logged or not ad logout will unset it

                //redirect to home page/dashboard
                header('location:' .SITEURL.'admin/');

            }
            else
            {
                //user not available and login failed
                $_SESSION['login']="<div class='error'>Username or Password did not Match</div>";

                header('location:' .SITEURL.'admin/login.php');
            }  
        }
?>