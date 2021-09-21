<html>
    <head lang="en">
        <link rel='icon' href='../images/logo.png'/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
        <title>Registration</title>
    </head>
    <style>
        <?php include '../css/login.css'; ?>
    </style>
    <body>
        <div id="wrapper">
            <div id="left">
                <div id="signin">
                    <form method="post" action="signup.php">
                        <div>
                            <label>Username</label>
                            <input class="text-input" id="username" placeholder="Username" name="name" type="text" autofocus required>  
                        </div>
                        <div>
                            <label>Email</label>
                            <input class="text-input" id="Email" placeholder="E-mail" name="email" type="email" autofocus required>  
                        </div>
                        <div>
                            <label>Password</label>
                            <input class="text-input" id="password" placeholder="Password" name="pass" type="password" required>    
                        </div>
                        <div>
                            <label>Confirm Password</label>
                            <input class="text-input" id="confirm-password" placeholder="Confirm Password" name="pass2" type="password" required>   
                        </div>
                        <div>
                            <label>Date of Birth</label>
                            <input class="text-input" id="dob" placeholder="DOB" name="dob" type="date" value="2017-06-01" min="1950-01-01" max="2003-01-01" required>  
                        </div>
                        <div>
                            <label>College Name</label>
                            <!-- <input class="text-input" id="confirm-password" placeholder="Confirm Password" name="pass2" type="password" required>    -->
                            <select class="text-input" name="college" id="college" required>
                                <option value="" default>College Name</option>
                                <option value="RCOEM">RCOEM</option>
                                <option value="YCCE">YCCE</option>
                                <option value="VNIT">VNIT</option>
                                <option value="Raisoni">Raisoni</option>
                            </select>
                        </div>
                        <input id="submit-btn" class="primary-btn" type="submit" value="Register" name="register" >  
                    </form  >
                    <p id="message"></p>
                    <div class="or">
                        <hr class="bar" />
                        <span>OR</span>
                        <hr class="bar" />
                    </div>
                    <a href="login.php" class="secondary-btn">Already have an account?</a>
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
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</html>
<?php
    include ("../util/connection.php"); //make connection here
    if (isset($_POST['register']))
    {
        $user_name = $_POST['name']; //here getting result from the post array after submitting the form.
        $user_pass = $_POST['pass']; //same
        $user_pass2 = $_POST['pass2']; //same
        $user_pass_hash = md5($user_pass);
        $user_pass2_hash = md5($user_pass2);
        $user_email = $_POST['email']; //same
        $user_college = $_POST['college']; //same
        $user_dob = date('Y-m-d', strtotime($_POST['dob'])); //same
        $user_id = uniqid(); //same
        
    
        if ($user_name == '')
        {
            //javascript use for input checking
            ?><script>document.getElementById('message').innerHTML='Please Enter Name'</script><?php
    exit();
    
    }
    
    if ($user_pass == '')
    {
    ?><script>document.getElementById('message').innerHTML='Password Missing'</script><?php
    exit();
    }
    if ($user_pass2 == '')
    {
    ?><script>document.getElementById('message').innerHTML='Confirm Password'</script><?php
    exit();
    }
    
    if ($user_college == '')
    {
    ?><script>document.getElementById('message').innerHTML='Please Enter College Name'</script><?php
    exit();
    }
    if ($user_email == '')
    {
    ?><script>document.getElementById('message').innerHTML='Please Enter Email'</script><?php
    exit();
    }
    if ($user_dob == '')
    {
    ?><script>document.getElementById('message').innerHTML='Please Enter Date of Birth'</script><?php
    exit();
    }
    
    
    //here query check weather if user already registered so can't register again.
    $check_email_query = "select * from students WHERE StudentEmail='$user_email'";
    $run_query = mysqli_query($connection, $check_email_query);
    
    $check_email_query_admin = "select * from admin WHERE AdminEmail='$user_email'";
    $run_query_admin = mysqli_query($connection, $check_email_query_admin);
    
    $check_username_query_user = "select * from students WHERE StudentName='$user_name'";
    $run_query_user_username = mysqli_query($connection, $check_username_query_user);
    
    $check_username_query_admin = "select * from admin WHERE AdminName='$user_name'";
    $run_query_admin_username = mysqli_query($connection, $check_username_query_admin);
    
    if (mysqli_num_rows($run_query_admin) > 0 || mysqli_num_rows($run_query_admin_username) > 0)
    {
    ?><script>document.getElementById('message').innerHTML='Email or username is registered as admin. Kindly Login'</script><?php
    echo "<script>
    setTimeout(()=>{
      window.open('login.php','_self');
    },5000)
    </script>";
    }
    elseif (mysqli_num_rows($run_query) > 0 || mysqli_num_rows($run_query_user_username) > 0)
    {
    ?><script>document.getElementById('message').innerHTML='Email or username already exists in our database, Please try another one!'</script><?php
    }
    else{
        
      if ($user_pass == $user_pass2)
      {
          if (strlen($user_pass) < 6)
            {
              ?><script>document.getElementById('message').innerHTML='Password should have more than 6 characters'</script><?php
    }else{
        $insert_user = "insert into students (UUID,StudentName,StudentEmail,StudentPassword,StudentCollege,DOB) VALUE ('$user_id','$user_name','$user_email','$user_pass_hash','$user_college','$user_dob')";
          if (mysqli_query($connection, $insert_user))
          {
            ?><script>document.getElementById('message').innerHTML='Account Created Successfully! Kindly Login'</script><?php
    echo "<script>
    setTimeout(()=>{
      window.open('login.php','_self');
    },3000)
    </script>";
    }
    }
    
    }
    else
    {
    ?><script>document.getElementById('message').innerHTML='Passwords dont match'</script><?php
    }
    }
    //insert the user into the database.
    
    
    }
    ?>