<?php
session_start(); //session starts here
require '../PHPMailer/PHPMailer/PHPMailerAutoload.php';
function Redirect_to(){
    echo "Sent";
}
?>  
  
<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <title>Forgot Password</title>  
</head>  
<style>  

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative ;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input,select {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
#submit-btn {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
#submit-btn:hover,#submit-btn:active,#submit-btn:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}

.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
</style>  
  
<body>  
  

<div class="login-page">
  <div class="form">
<?php
if (isset($_GET['token']))
{
    echo "
    <form class='password-form' method='post' >

    <input type='password' name='newpass' placeholder='New Password' required>
    <div class='show-hide-password js-showHidePassword' tabindex='0'>
        <span aria-hidden='true'><img src='../images/icons/visible.png' alt='show'></span>
    </div>
    <input type='password' name='confpass' placeholder='Confirm Password' required>
    <div class=' show-hide-password2 js-showHidePassword' tabindex='0'>
        <span aria-hidden='true'><img src='../images/icons/visible.png' alt='show'></span>
    </div>
    
    <input type='submit' id='submit-btn' value='Change Password' name='changePassSub'>
    <p id='message'></p>
    </form>
    ";
}
else
{
    echo "
      <form class='login-form' method='post' >

    <input class='form-control' placeholder='E-mail' name='email' type='email' autofocus required>  
    <input id='submit-btn' type='submit' value='Send Rest Link' name='reset' >  

    </form>
      ";
}
?>
    
  </div>
</div>
<!--  -->
</body>  
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
</html>  
  
<?php

include ("../util/connection.php");

if (isset($_POST['reset']))
{
    
    $user_email = $_POST['email'];

    $token = bin2hex(random_bytes(50));
    
    $mail = new PHPMailer;




// TCP port to connect to

$mail->isSMTP();
$mail->Host = 'localhost';
$mail->SMTPAuth = false;
$mail->SMTPAutoTLS = false; 
$mail->Port = 42; 

$mail->setFrom('malhar19deshkar@gmail.com', 'Mailer');
$mail->addAddress($user_email, 'User');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'https://toxicant-facepiece.000webhostapp.com/util/forgotPassword.php?token='.$token;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}


    
    if ($user_email == '')
    {
        echo "<script>alert('Please enter the Email')</script>";
        exit();
    }
}
if (isset($_POST['changePassSub']))
{
    $new_pass = $_POST['newpass'];
    $conf_pass = $_POST['confpass'];

    if ($new_pass != $conf_pass)
    {
?><script>document.getElementById('message').innerHTML='Passwords are different'</script><?php
    }
    else
    {
        $get_token = "SELECT * FROM forgotpassword WHERE Token='{$_GET['token']}'";
        $q_get_token = mysqli_query($connection, $get_token);
        $selected_row = mysqli_fetch_assoc($q_get_token);
        $newpass = md5($new_pass);
        $del_token = "DELETE FROM forgotpassword WHERE Email='{$selected_row['Email']}'";
        $q_del_token = mysqli_query($connection, $del_token);

        $update_pass_admin = "UPDATE admin SET AdminPassword = '$newpass' WHERE AdminEmail = '{$selected_row['Email']}'";
        $q_update_pass_admin = mysqli_query($connection, $update_pass_admin);
        if ($q_update_pass_admin)
        {
?><script>document.getElementById('message').innerHTML='Password Reset Success'</script><?php
            ?><script>window.location.replace("login.php")</script><?php
        }

        $update_pass = "UPDATE students SET StudentPassword = '$newpass' WHERE StudentEmail = '{$selected_row['Email']}'";
        $q_update_pass = mysqli_query($connection, $update_pass);
        if ($q_update_pass)
        {
?><script>document.getElementById('message').innerHTML='Password Reset Success'</script><?php
            ?><script>window.location.replace("login.php")</script><?php
        }

    }

    if ($new_pass == '')
    {
        echo "<script>alert('Field Missing')</script>";
        exit();
    }
    if ($conf_pass == '')
    {
        echo "<script>alert('Field Missing')</script>";
        exit();
    }
    if (strlen($new_pass) < 6)
    {
        echo "<script>alert('Password must contain minimum 6 characters')</script>";
        exit();
    }
}

?>
