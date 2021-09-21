<?php
    session_start();
    
    include ('../util/connection.php');
    include ('../util/checkAdmin.php');
    
    ?>  
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
        <link rel="icon" href="../images/logo.png">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
        <title>Add New Campus Drive</title>
    </head>
    <style>
        <?php include '../css/partials.css'; ?>
        <?php include '../css/globals.css'; ?>
    </style>
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
    <title>Add New Campus Drive
    </title>
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
        <?php
            echo "<ul id='slide-out' class='side-nav fixed z-depth-2 hide-on-large-only	'>
                  
            
            <li id='dash_dashboard'><a class='waves-effect' href='welcome-admin.php'>Home</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='jobOffers.php'>Overall Job Applications</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='companies.php'>List of Companies</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='DriveApplications.php'>Drive Applications</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
            
            
            </ul>
            ";?>
        <div class="login-page">
            <div class="form" >
                <form class="register-form"  method="post" enctype='multipart/form-data'>
                    <h2>Add New Campus Drive</h2>
                    <input  id="company-name" placeholder="Company Name" name="company-name" type="text" autofocus required>  
                    <input  id="college-name" placeholder="College Name" name="college-name" type="text" autofocus required>  
                    <input  id="round1" placeholder="Round 1 Name" name="round-one-name" type="text" autofocus required>  
                    <input class="form-control" id="dor1" placeholder="Round 1 Date" name="round-one-date" type="date" min="2001-01-01" required >  
                    <input  id="round2" placeholder="Round 2 Name" name="round-two-name" type="text"  autofocus >  
                    <input class="form-control" id="dor2" placeholder="Round 2 Date" name="round-two-date" type="date"  min="2001-01-01">  
                    <input  id="round3" placeholder="Round 3 Name" name="round-three-name" type="text" autofocus >  
                    <input class="form-control" id="dor3" placeholder="Round 3 Date" name="round-three-date" type="date" min="2001-01-01" >  
                    <input  id="round4" placeholder="Round 4 Name" name="round-four-name" type="text" autofocus >  
                    <input class="form-control" id="dor4" placeholder="Round 4 Date" name="round-four-date" type="date"  min="2001-01-01">  
                    <input  id="round5" placeholder="Round 5 Name" name="round-five-name" type="text" autofocus >  
                    <input class="form-control" id="dor5" placeholder="Round 5 Date" name="round-five-date" type="date"  min="2001-01-01">  
                    <textarea name="drive-desc" id="drive-desc" cols="10" rows="5" placeholder="Campus Drive Information" maxlength="2500" autofocus required></textarea>
                    <input id="submit-btn" type="submit" value="Add Drive" name="add-drive" >  
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
</html>
<?php
    if (isset($_POST['add-drive']))
    {
        $company_name = $_POST['company-name'];
        $college_name = $_POST['college-name'];
        $drive_desc = $_POST['drive-desc'];
    
        $round_1_name = $_POST['round-one-name'];
        $round_1_date = date('Y-m-d', strtotime($_POST['round-one-date'])); //same
        $round_2_name = $_POST['round-two-name'] ? $_POST['round-two-name'] : "-";
        $round_2_date = date('Y-m-d', strtotime($_POST['round-two-date'])); //same
        $round_3_name = $_POST['round-three-name'] ? $_POST['round-three-name'] : "-";
        $round_3_date = date('Y-m-d', strtotime($_POST['round-three-date'])); //same
        $round_4_name = $_POST['round-four-name'] ? $_POST['round-four-name'] : "-";
        $round_4_date = date('Y-m-d', strtotime($_POST['round-four-date'])); //same
        $round_5_name = $_POST['round-five-name'] ? $_POST['round-five-name'] : "-";
        $round_5_date = date('Y-m-d', strtotime($_POST['round-five-date'])); //same
        
    
        $drive_exists = "SELECT * from campusdrive WHERE CollegeName='$college_name' AND CompanyName='$company_name'";
    
        $q_drive_exists = mysqli_query($connection, $drive_exists);
    
        $company_exists = "SELECT * from companies WHERE CompanyName='$company_name'";
        $q_company_exists = mysqli_query($connection, $company_exists);
        
        $college_exists = "SELECT StudentCollege FROM students WHERE StudentCollege='$college_name'";
        $q_college_exists = mysqli_query($connection, $college_exists);
    
        if (mysqli_num_rows($q_drive_exists) > 0)
        {
            echo "<script>alert('Company Drive Already Exists for this college')</script>";
            exit();
        }
        elseif (mysqli_num_rows($q_company_exists) == 0)
        {
            echo "<script>alert('Company Does not Exist')</script>";
            exit();
        }
        else
        {   
            if (mysqli_num_rows($q_college_exists) == 0)
            {
                echo "<script>alert('College Does not Exist')</script>";
                exit();
            }else{
            $add_drive = "INSERT INTO campusdrive (CompanyName,CollegeName,Round1,Date1,Round2,Date2,Round3,Date3,Round4,Date4,Round5,Date5,Description) VALUE ('$company_name','$college_name','$round_1_name','$round_1_date','$round_2_name','$round_2_date','$round_3_name','$round_3_date','$round_4_name','$round_4_date','$round_5_name','$round_5_date','$drive_desc')";
            $q_add_drive = mysqli_query($connection, $add_drive);
            }
    
        }
    
        if ($company_name == '')
        {
            echo "<script>alert('Please enter the Company Name')</script>";
            exit();
        }
        if ($college_name == '')
        {
            echo "<script>alert('Please enter the College Name')</script>";
            exit();
        }
        if ($drive_desc == '')
        {
            echo "<script>alert('Please enter the Drive Information')</script>";
            exit();
        }
    
        if ($round_1_name == '')
        {
            echo "<script>alert('Please enter atleast 1 round details')</script>";
            exit();
        }
        if ($round_1_date == '')
        {
            echo "<script>alert('Please enter atleast 1 round details')</script>";
            exit();
        }
        if ($q_add_drive)
        {
    ?><script>window.location.replace("CollegeDrive.php")</script><?php
    }
    }
    
    ?>