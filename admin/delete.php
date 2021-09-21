<?php
    session_start();
    
    include ('../util/connection.php');
    include ('../util/checkAdmin.php');
    
    include ('../students/studentCollege.php');
    $get_details = "SELECT * FROM companies WHERE CompanyName='{$_GET['q']}'";
    $q_get_details = mysqli_query($connection, $get_details);
    if (mysqli_num_rows($q_get_details) > 0)
    {
    
        $company_details = mysqli_fetch_assoc($q_get_details);
    
    ?>  
<link rel="icon" href="../images/logo.png">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" rel="stylesheet">
<style>
    <?php include '../css/delete.css'; ?>
    <?php include '../css/partials.css'; ?>
    <?php include '../css/global.css'; ?>
</style>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
        <title>Delete Company</title>
    </head>
    <body>
        <header class="head">
            <ul class="dropdown-content" id="user_dropdown" >
                <li><a style="color:#4b0082" class="" href="../util/updateProfile.php">Update Profile</a></li>
                <li><a style="color:#4b0082" class="" href="../util/changePass.php">Change Password</a></li>
                <li><a style="color:#4b0082" class="" href="../util/logout.php">Logout</a></li>
            </ul>
            <nav style="background-color:#4b0082;" role="navigation">
                <div class="nav-wrapper">
                    <a data-activates="slide-out" class="button-collapse show-on-" href="#!"><img  src="../images/logo.png" width="65" /></a>
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
            ";
            ?>
        <form method="post" style="
            width: 100%;
            ">
            <h1>Are you sure you want to delete <?=$_GET['q']?>?</h1>
            <br>
            <input type="submit" class="ok-btn btns" value="Yes" name="Yes">
            <input type="submit" class="cancel-btn btns" value="Cancel" name="Cancel">
        </form>
        <script>
            $('.button-collapse').sideNav();
            
            $('.collapsible').collapsible();
            
            $('select').material_select();
        </script>
    </body>
    <?php
        if (isset($_POST['Yes']))
        {
            unlink($company_details['CompanyPic']);
            $delete_company = "DELETE FROM companies WHERE CompanyName = '{$_GET['q']}'";
            $q_delete_company = mysqli_query($connection, $delete_company);
            $delete_company_jobs = "DELETE FROM jobs WHERE CompanyName = '{$_GET['q']}'";
            $q_delete_company_jobs = mysqli_query($connection, $delete_company_jobs);
            $delete_company_drive = "DELETE FROM campusdrive WHERE CompanyName = '{$_GET['q']}'";
            $q_delete_company_drive= mysqli_query($connection, $delete_company_drive);
            if ($q_delete_company)
            {
                ?><script>window.location.replace("../admin/companies.php")</script>;<?php
        }
        else
        {
            die('Something Went Wrong!');
        }
        }
        if (isset($_POST['Cancel']))
        {
        ?><script>window.location.replace("../admin/companies.php")</script>;<?php
        }
        ?>
</html>
<?php
    }
    else
    {
        die("No Company Found");
    }
    ?>