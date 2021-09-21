<?php
    session_start();
    
    include ('../util/connection.php');
    include ('../util/checkAdmin.php');
    ?>
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
<title>Drive Applications</title>
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
    <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
    
    
    </ul>
    ";?>
<?php
    if (isset($_GET['q']) && isset($_GET['c']))
    {
        $job_offers = "select * from jobapplications WHERE CompanyName='{$_GET['q']}' AND StudentCollege='{$_GET['c']}'";
    ?>
<h1>Students from <?=$_GET['c'] . ' applied for ' . $_GET['q'] ?></h1>
<?php
    }
    else
    {
        $job_offers = "select * from jobapplications";
    ?>
<h2>Students Campus Drive Applications</h2>
<?php
    }
    
    if (!($q_job_offers = mysqli_query($connection, $job_offers)))
    {
        echo 'Retrieval of data from Database Failed - #';
    }
    else
    {
    ?>
<table class="blueTable">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Company</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (mysqli_num_rows($q_job_offers) == 0)
            {
                echo '<tr><td colspan="4">No Rows Returned</td></tr>';
            }
            else
            {
                while ($selected_row = mysqli_fetch_assoc($q_job_offers))
                {
                    if ($selected_row['Status'] == 'pending')
                    {
                        echo "<tr>
                    <form method='post'>
                        <td><input type='text' name='StudentName' value='{$selected_row['StudentName']}' readonly></td>
                        <td><input type='text' name='StudentEmail' value='{$selected_row['StudentEmail']}' readonly></td>
                        <td><input type='text' name='CompanyName' value='{$selected_row['CompanyName']}' readonly></td>
            
                        <td><input type='text' name='Status' value='{$selected_row['Status']}' readonly></td>
            
                        <td><input type='submit' name='view' value='View'></td>
                    </form>
            
                    </tr>\n";
            
                    }
                    else
                    {
                        echo "<tr>
                        <form method='post'>
                            <td><input type='text' name='StudentName' value='{$selected_row['StudentName']}' readonly></td>
                            <td><input type='text' name='StudentEmail' value='{$selected_row['StudentEmail']}' readonly></td>
                            <td><input type='text' name='CompanyName' value='{$selected_row['CompanyName']}' readonly></td>
            
                            <td><input type='text' name='Status' value='{$selected_row['Status']}' readonly ></td>
            
                        </form>
            
                        </tr>\n";
                    }
            
                }
            }
            ?>
    </tbody>
</table>
<?php
    }
    
    if (isset($_POST['view']))
    {
        # code...
       
            ?><script>window.location.replace("jobOffers.php")</script><?php
    }
    ?>
<script>
    $('.button-collapse').sideNav();
    
    $('.collapsible').collapsible();
    
    $('select').material_select();
</script>