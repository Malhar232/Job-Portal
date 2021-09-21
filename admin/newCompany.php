<?php
    session_start();
    
    include ('../util/connection.php');
    include ('../util/checkAdmin.php');
    
    ?>  
<style>
    <?php include '../css/partials.css'; ?>
    <?php include '../css/globals.css'; ?>
</style>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="icon" href="../images/logo.png">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" rel="stylesheet">
    </head>
    <style>  
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);
        .login-page {
        width: 360px;
        padding: 3% 0 0;
        margin: auto;
        }
        textarea {
        resize: none;
        }
        .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        .form input,select,textarea {
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
        background: #4b0082;
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
        background: #4b0082;
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
        background: linear-gradient(to right, #7840a1 50%, #4b0082 100%);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;      
        }
    </style>
    <body>
        <header class="head">
            <ul class="dropdown-content" id="user_dropdown" >
                <li><a style="color:#4b0082" class="" href="../util/updateProfile.php">Update Profile</a></li>
                <li><a style="color:#4b0082" class="" href="../util/changePass.php">Change Password</a></li>
                <li><a style="color:#4b0082" class="" href="../util/logout.php">Logout</a></li>
            </ul>
            <nav style="background-color:#4b0082;" role="navigation">
                <div class="nav-wrapper">
                    <a data-activates="slide-out" class="button-collapse show-on-" href="#!"><img src="../images/logo.png" width="65"/></a>
                    <ul class="left hide-on-med-and-down">
                        <li id='dash_dashboard'><a class='waves-effect' href='welcome-admin.php'>Home</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='jobOffers.php'>Overall Job Applications</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='companies.php'>List of Companies</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='DriveApplications.php'>Drive Applications</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
                    </ul>
                    <ul class="right">
                        <li>
                            <a class='right dropdown-button' href='' data-activates='user_dropdown'><i class=' material-icons'>account_circle</i></a>
                        </li>
                    </ul>
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                </div>
            </nav>
        </header>
        <title>Add New Company</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
        <?php
            echo "<ul id='slide-out' class='side-nav fixed z-depth-2 hide-on-large-only	'>
                  
            
            <li id='dash_dashboard'><a class='waves-effect' href='welcome-admin.php'>Home</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='jobOffers.php'>Overall Job Applications</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='companies.php'>List of Companies</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='DriveApplications.php'>Drive Applications</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
            
            
            </ul>
            ";
            ?>
        <div class="login-page">
            <div class="form" >
                <h2>Add New Company</h2>
                <form class="register-form"  method="post" enctype='multipart/form-data'>
                    <input  id="company-name" placeholder="Company Name" name="company-name" type="text" autofocus required>  
                    <textarea name="company-desc" id="company-desc" cols="10" rows="5" placeholder="Company Description" maxlength="1500" autofocus required></textarea>
                    <input  id="company-cover" placeholder="Company Pic" name="company-cover[]" accept="image/png" type="file"  accept="image/*" autofocus required>  
                    <input  id="total-employees" placeholder="Total Employees" min="0" name="total-employees" type="number" autofocus required>  
                    <input  id="total-jobs-available" placeholder="Jobs Available" min="0" name="total-jobs-available" type="number" autofocus >  
                    <div id="companyForm"></div>
                    <input id="submit-btn" type="submit" value="Add Company" name="add-company" >  
                </form>
            </div>
        </div>
    </body>
    <script>
        $('.button-collapse').sideNav();
        
        $('.collapsible').collapsible();
        
        $('select').material_select();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $('#total-jobs-available').on('input', function () {
             var numberOfJobs=document.getElementById("total-jobs-available").value;
             var form=document.getElementById("companyForm");
             form.innerHTML="";
             for (i=0;i<numberOfJobs;i++){
        
              var JobName = document.createElement("input");
              JobName.type = "text";
              JobName.name = "jobName[]";
              JobName.required = true;
              JobName.placeholder = `Job ${i+1} Name`;
              form.appendChild(JobName);
              form.appendChild(document.createElement("br"));
              var Package = document.createElement("input");
              Package.type = "text";
              Package.placeholder = "Package (LPA)";
              Package.name = "Package[]";
              Package.required = true;
              form.appendChild(Package);
              form.appendChild(document.createElement("br"));
              }
            });
    </script>
</html>
<?php
    if (isset($_POST['add-company']))
    {
        $company_name = $_POST['company-name'];
        $company_id = uniqid('C');
        $company_desc = $_POST['company-desc'];
        $company_emp = $_POST['total-employees'];
    
        $jobNames = $_POST['jobName'];
        $Packages = $_POST['Package'];
    
        $company_jobs = $_POST['total-jobs-available'];
        $company_cover = $_FILES['company-cover']['tmp_name'][0];
        $_FILES['company-cover']['name'][0] = $company_id;
        $newFilePath = "../uploads/CompanyPics/" . $_FILES['company-cover']['name'][0] . ".png";
        move_uploaded_file($company_cover, $newFilePath);
        $company_exists = "SELECT CompanyName from companies WHERE CompanyName='$company_name'";
        $q_company_exists = mysqli_query($connection, $company_exists);
        if (mysqli_num_rows($q_company_exists) > 0)
        {
            echo "<script>alert('Company Already Exists')</script>";
            exit();
        }
        else
        {
            $add_company = "INSERT INTO companies (CompanyID,CompanyName,CompanyDesc,CompanyPic,TotalEmp,JobsAvailable) VALUE ('$company_id','$company_name','$company_desc','$newFilePath','$company_emp','$company_jobs')";
            $q_add_company = mysqli_query($connection, $add_company);
    
            for ($i = 0;$i < $company_jobs;$i++)
            {
                $add_jobs = "INSERT INTO jobs (JobName,CompanyName,Package) VALUE ('{$jobNames[$i]}','$company_name','{$Packages[$i]}')";
                mysqli_query($connection, $add_jobs);
            }
    
        }
    
        if ($company_name == '')
        {
            echo "<script>alert('Please enter the Company Name')</script>";
            exit();
        }
        if ($company_desc == '')
        {
            echo "<script>alert('Please enter the Company Desc.')</script>";
            exit();
        }
        if ($company_emp == '')
        {
            echo "<script>alert('Please enter the number of employees')</script>";
            exit();
        }
    
        if ($company_cover == '')
        {
            echo "<script>alert('Please upload the cover pic')</script>";
            exit();
        }
        if ($q_add_company)
        {
    ?><script>window.location.replace("companies.php")</script><?php
    }
    }
    
    ?>