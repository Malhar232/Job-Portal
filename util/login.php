<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }else{
    session_destroy(); //session starts here
    }
    
    ?>  
<style>
    <?php include '../css/login.css'; ?>
</style>
<html>
    <head lang="en">
        <link rel="icon" href="../images/logo.png">

        <meta charset="UTF-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    </head>
    <body>
        <div id="wrapper">
            <div id="left">
                <div id="signin">
                    <div class="logo">
                        <img src='../images/logo.png'>
                    </div>
                    <form method="post" action="login.php">
                        <div>
                            <label>Email</label>
                            <input class="text-input" placeholder="E-mail" name="email" type="email" autofocus required>  
                        </div>
                        <div>
                            <label>Password</label>
                            <input class="text-input" placeholder="Password" name="pass" type="password" value="" required>  
                        </div>
                        <input id="submit-btn" class="primary-btn" type="submit" value="Login" name="login" >
                    </form  >
                    <p id="message"></p>
                    <div class="or">
                        <hr class="bar" />
                        <span>OR</span>
                        <hr class="bar" />
                    </div>
                    <a href="signup.php" class="secondary-btn">Create an account</a>
                </div>
            </div>
            <div id="right">
                <div id="showcase">
                    <div class="showcase-content">
                        <h1 class="showcase-text">
                            It's time to start living the life you've imagined.
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
    </body>
</html>
<?php
    include ("../util/connection.php");
    
    if (isset($_POST['login']))
    {
        $user_email = $_POST['email'];
        $user_pass = md5($_POST['pass']);
    
        $check_user = "select * from students WHERE StudentEmail='$user_email'AND StudentPassword='$user_pass'";
        $run = mysqli_query($connection, $check_user);
        $check_admin = "select * from admin WHERE AdminEmail='$user_email'AND AdminPassword='$user_pass'";
        $run_admin_check = mysqli_query($connection, $check_admin);
    
        if (mysqli_num_rows($run))
        {
            echo "<script>window.open('../students/welcome.php','_self')</script>";
    
            $_SESSION['email'] = $user_email;
    
        }
        else if (mysqli_num_rows($run_admin_check))
        {
            echo "<script>window.open('../admin/welcome-admin.php','_self')</script>";
            $_SESSION['email'] = $user_email;
        }
        else
        {
          ?><script>document.getElementById('message').innerHTML='Email/Password combination is incorrect!'</script><?php
    }
    }
    ?>