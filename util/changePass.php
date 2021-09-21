<?php
    session_start();
    include ('../util/connection.php');
    if (!$_SESSION['email'])
    {
        header("Location: login.php"); //redirect to the login page to secure the welcome page without login access.
        
    }
    ?>  
<style>
    <?php include '../css/changePass.css'; ?>
</style>
<html>
    <head>
        <link rel="icon" href="../images/logo.png"/>
        <title>  
            Change Password  
        </title>
        <style>
            .show-hide-password,.show-hide-password2 {
            background: 0;
            border: 0;
            cursor: pointer;
            font-size:12px;
            min-height: 60px;
            min-width: 70px;
            padding: 18px;
            position: absolute;
            }
            .show-hide-password{
            right: 0px;
            top: 75px;
            }
            .show-hide-password2{
            right: 0px;
            top: 122.5px;
            }
            #message{
            color:white;
            text-align:center;
            }
        </style>
    </head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <body style="overflow:hidden">
        <div class="password-page">
            <div class="form">
                <div class="login">
                    <h1>Change Password</h1>
                    <form method="post" action="#">
                        <input type="password" name='oldpass' placeholder="Old Password" required>
                        <div class="show-hide-password js-showHidePassword" tabindex="0">
                            <span aria-hidden="true"><img src="../images/icons/visible.png" alt="show"></span>
                        </div>
                        <input type="password" name='newpass' placeholder="New Password" required>
                        <div class=" show-hide-password2 js-showHidePassword" tabindex="0">
                            <span aria-hidden="true"><img src="../images/icons/visible.png" alt="show"></span>
                        </div>
                        <p id="message"></p>
                        <input type="submit" id="submit-btn" class="btn btn-primary btn-block btn-large" value="Update Password" name='changePassSub'>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script>
            function showHidePasswordfn() {
              // The last span inside the button
              var showHideBtn = $(this);
            
              var showHideSpan = showHideBtn.children().next();
              var $pwd = showHideBtn.prev('input');
            
            
             
            
              if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
              } else {
                $pwd.attr('type', 'password');
              }
            }
            
            // On Click
            $('.js-showHidePassword').on('click', showHidePasswordfn);
            
            
            
        </script> 
    </body>
    <?php
        if (isset($_POST['changePassSub']))
        {
        
            $session_email = $_SESSION['email'];
        
            # code...
            $oldPass = md5($_POST['oldpass']);
            $newPass = md5($_POST['newpass']);
            
            if (strlen($_POST['newpass']) < 6)
            {
              echo "<script>alert('Password must have atleast 6 characters')</script>";
                exit();
            }
            if ($oldPass != $newPass)
            {
        
                $selectPassChangeUser = "select * from students WHERE StudentEmail='{$_SESSION['email']}' AND StudentPassword='$oldPass'";
                $q_passchange = mysqli_query($connection, $selectPassChangeUser);
        
                $selectPassChangeAdmin = "select * from admin WHERE AdminEmail='{$_SESSION['email']}' AND AdminPassword='$oldPass'";
                $q_passchangeAdmin = mysqli_query($connection, $selectPassChangeAdmin);
        
                if (mysqli_num_rows($q_passchange) == 0)
                {
                    if (mysqli_num_rows($q_passchangeAdmin) == 0)
                    {
        ?><script>document.getElementById('message').innerHTML='Old password is wrong!'</script><?php
        }
        else
        {
        
            $updatePass = "UPDATE admin SET AdminPassword = '$newPass' WHERE AdminEmail = '$session_email'";
            $update_query = mysqli_query($connection, $updatePass);
        ?><script>document.getElementById('message').innerHTML='Password Updated! Please Login'</script>
    <?php
        session_destroy();
        echo "<script>
        setTimeout(()=>{
        window.open('login.php','_self');
        },3000)
        </script>";
        }
            
        
        }
        else
        {
        
        $updatePass = "UPDATE students SET StudentPassword = '$newPass' WHERE StudentEmail = '$session_email'";
        $update_query = mysqli_query($connection, $updatePass);
        ?><script>document.getElementById('message').innerHTML='Password Updated! Please Login'</script>
    <?php
        session_destroy();
        echo "<script>
          setTimeout(()=>{
            window.open('login.php','_self');
          },3000)
          </script>";
        
        }
        
        }
        else
        {
        ?><script>document.getElementById('message').innerHTML='Old password and new password are same'</script><?php
        }
        
        }
        ?>
</html>