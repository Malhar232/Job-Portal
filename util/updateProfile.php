<?php
    session_start();
    include ('../util/connection.php');
    if (!$_SESSION['email'])
    {
    
        header("Location: login.php"); //redirect to the login page to secure the welcome page without login access.
        
    }
    
    $update_user_details = "select * from students WHERE StudentEmail='{$_SESSION['email']}'";
    $update_admin_details = "select * from admin WHERE AdminEmail='{$_SESSION['email']}'";
    
    $q_getUserdetails = mysqli_query($connection, $update_user_details);
    $q_getAdmindetails = mysqli_query($connection, $update_admin_details);
    $redirect = '';
    
    ?>  
<style>
    <?php include '../css/changePass.css'; ?>
</style>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
        <link rel="icon" href="../images/logo.png"/>
        <title>  
            Update Profile
        </title>
    </head>
    <style>
        #message{
        color:white;
        }
    </style>
    <body>
        <div class="panel-body">  
            <?php
                if (mysqli_num_rows($q_getUserdetails) == 0 && mysqli_num_rows($q_getAdmindetails) == 0)
                {
                    echo 'No Data Available';
                    header("Location: $redirect");
                }
                else
                {
                
                    if (mysqli_num_rows($q_getUserdetails) == 0)
                    {
                        $redirect = '../admin/welcome-admin.php';
                        $row = mysqli_fetch_assoc($q_getAdmindetails);
                        echo "
                                  <div class='update-page'>
                                  <div class='form'>
                                  <div class='login'>
                                  <h1>Update Profile</h1>
                                    <form method='post'>
                                    <input class='form-control' id='username' placeholder='Username' name='name' type='text' value='{$row['AdminName']}' autofocus required>    
                                    <input id='submit-btn' type='submit' value='Update' name='updateAdminProfile' class='btn btn-primary btn-block btn-large'>  
                                    <p id='message'></p>
                                    </form>
                                </div>
                                  </div>
                              </div>
                                  ";
                
                    }
                    else
                    {
                        $redirect = "../students/welcome.php";
                        $row = mysqli_fetch_assoc($q_getUserdetails);
                        $formattedDate = date('Y-m-d', strtotime($row['DOB']));
                        echo "
                                  <div class='update-page'>
                                  <div class='form'>
                                  
                                  <div class='login'>
                                  <h1>Update Profile</h1>
                                    <form method='post'>
                                      
                                    <input class='form-control' id='username' placeholder='Username' name='name' type='text' value='{$row['StudentName']}' autofocus required>  
                                   <!-- <input class='form-control' id='college' placeholder='College' name='college' type='text' value='{$row['StudentCollege']}' required>  -->
                                    <input class='form-control' id='dob' placeholder='DOB' name='dob' type='date' value='{$formattedDate}' required>  
                                    <input id='submit-btn' type='submit' value='Update' name='updateStudentProfile' class='btn btn-primary btn-block btn-large'> 
                
                                    <p id='message'></p>
                
                                    </form>
                                </div>
                                  </div>
                              </div>
                                  ";
                    }
                
                }
                ?>
        </div>
    </body>
    <?php
        if (isset($_POST['updateStudentProfile']))
        {
        
            # code...
            $newName = $_POST['name'];
            // $newCollege = $_POST['college'];
            $newDOB = $_POST['dob'];
        
            if ($newName == '' || $newDOB == '')
            {
                echo "<script>alert('Information Missing!')</script>";
            }
            else
            {
        
                $updateProfile = "UPDATE students SET StudentName = '$newName',DOB = '$newDOB' WHERE StudentEmail = '{$_SESSION['email']}'";
                $updateProfile_query = mysqli_query($connection, $updateProfile);
                $updatejobApp = "UPDATE jobapplications SET StudentName = '$newName' WHERE StudentEmail = '{$_SESSION['email']}'";
                $updatejobApp_query = mysqli_query($connection, $updatejobApp);
                $updateselected = "UPDATE selectedstudents SET StudentName = '$newName' WHERE StudentEmail = '{$_SESSION['email']}'";
                $updateselected_query = mysqli_query($connection, $updateselected);
        
        
                if ($updateProfile_query)
                {
                    ?><script>window.location.replace("../students/welcome.php")</script>;<?php
        }
        }
        }
        else if (isset($_POST['updateAdminProfile']))
        {
        # code...
        $newName = $_POST['name'];
        
        if ($newName == '')
        {
        echo "<script>alert('Information Missing!')</script>";
        }
        else
        {
        
        $updateProfile = "update admin SET AdminName='$newName' WHERE AdminEmail='{$_SESSION['email']}'";
        $updateProfile_query = mysqli_query($connection, $updateProfile);
        if ($updateProfile_query)
        {
            ?><script>window.location.replace("../admin/welcome-admin.php")</script>;<?php
        }
        }
        }
        
        ?>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
</html>