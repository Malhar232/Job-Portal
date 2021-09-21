<?php
    session_start();
    
    include ('../util/connection.php');
    include ('../util/checkAdmin.php');
    ?>
<title>Selected Students</title>
<link rel="icon" href="../images/logo.png">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" rel="stylesheet">
<style>
    <?php include '../css/Tables.css'; ?>
    <?php include '../css/partials.css'; ?>
    <?php include '../css/globals.css'; ?>
</style>
<header class="head">
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
    $selected_students = "select * from selectedstudents";
    
    if (!($q_selected_students = mysqli_query($connection, $selected_students)))
    {
        echo 'Retrieval of data from Database Failed - #';
    }
    else
    {
      
    ?>
<?php
    echo "<ul id='slide-out' class='side-nav fixed z-depth-2 hide-on-large-only	'>
          
    
    <li id='dash_dashboard'><a class='waves-effect' href='welcome-admin.php'>Home</a></li>
    <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
    <li id='dash_dashboard'><a class='waves-effect' href='jobOffers.php'>Overall Job Applications</a></li>
    <li id='dash_dashboard'><a class='waves-effect' href='companies.php'>List of Companies</a></li>
    <li id='dash_dashboard'><a class='waves-effect' href='DriveApplications.php'>Drive Applications</a></li>
    
    
    </ul>
    ";?>
<h1>Selected Students</h1>
<table class="blueTable">
    <thead>
        <tr>
            <th>Company Name</th>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Student College</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (mysqli_num_rows($q_selected_students) == 0)
            {
                echo '<tr><td colspan="4">Results yet to be declared</td></tr>';
            }
            else
            {
                while ($selected_row = mysqli_fetch_assoc($q_selected_students))
                {
                    echo "<tr>
                    <td>{$selected_row['CompanyName']}</td>
                    <td>{$selected_row['StudentName']}</td>
                    <td>{$selected_row['StudentEmail']}</td>
                    <td>{$selected_row['CollegeName']}</td>
            
                    </tr>\n";
            
                }
            }
            ?>
    </tbody>
</table>
<?php
    }
    
    ?>
<script>
    $('.button-collapse').sideNav();
    
    $('.collapsible').collapsible();
    
    $('select').material_select();
</script>