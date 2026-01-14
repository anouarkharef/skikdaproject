<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
                if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
         ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="username" placeholder="Enter Your User-Name"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                         <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>








<?php include('partials/footer.php') ?>

<?php 
//process the value from form and save t in database

//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //button clicked
    //echo "Button clicked";
    //get data from form

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //sql query to save the data into database

    $sql = "INSERT INTO table_admin SET
        full_name='$full_name',
        username='$username',
        password='$password' 
    ";

    
    //execting query and saving data into database
    $res = mysqli_query($conn,$sql)or die(mysqli_error());

    // check whether the query(is executed or not) and display appropriate message
    if($res==TRUE)
    {
        //echo "Data inseted";
        $_SESSION['add'] = "Admin Added Successfuly";
        //redirect Page
        header("location:" .SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //echo "failed";
        $_SESSION['add'] = "failed to add admin";
        //redirect Page to add admin
        header("location:" .SITEURL.'admin/manage-admin.php');
    }
}

?>
