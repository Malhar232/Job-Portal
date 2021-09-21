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
<title>Job Applications</title>
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
    $job_offers = "select * from jobapplications where Status='pending'";
    
    if (!($q_job_offers = mysqli_query($connection, $job_offers)))
    {
        echo 'Retrieval of data from Database Failed - #';
    }
    else
    {
      echo "<ul id='slide-out' class='side-nav fixed z-depth-2 hide-on-large-only	'>
          
    
          <li id='dash_dashboard'><a class='waves-effect' href='welcome-admin.php'>Home</a></li>
          <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
          <li id='dash_dashboard'><a class='waves-effect' href='companies.php'>List of Companies</a></li>
          <li id='dash_dashboard'><a class='waves-effect' href='DriveApplications.php'>Drive Applications</a></li>
          <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
    
    
        </ul>
        "
    ?>
<h1>Job Applications</h1>
<table class="blueTable">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Student College</th>
            <th>Student Email</th>
            <th>Company Name</th>
            <th>Resume</th>
            <th>Post</th>
            <th>Result</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (mysqli_num_rows($q_job_offers) == 0)
            {
                echo '<tr><td colspan="7">No More Applications</td></tr>';
            }
            else
            {
                while ($selected_row = mysqli_fetch_assoc($q_job_offers))
                {
                    echo "<tr>
                    <form method='post'>
                        <td><input type='text' name='StudentName' value='{$selected_row['StudentName']}' readonly></td>
                        <td><input type='text' name='CollegeName' value='{$selected_row['StudentCollege']}' readonly></td>
                        <td><input type='text' name='StudentEmail' value='{$selected_row['StudentEmail']}' readonly></td>
                        <td><input type='text' name='CompanyName' value='{$selected_row['CompanyName']}' readonly></td>
                        <td><a style='color:red !important' href='{$selected_row['ResumePath']}' target='_blank'>Open Resume</a></td>
                        <td><input type='text' name='Post' value='{$selected_row['Post']}' readonly></td>
                        <td><input style='color:green !important' type='submit' name='select' value='Select'> <input type='submit' style='color:red !important' name='NotSelect' value='Not Select'>  <input type='submit' style='color:orange !important' name='reapply' value='Reapply'></td>
                    </form>
            
                    </tr>\n";
            
                }
            }
            ?>
    </tbody>
</table>
<?php
    }
    
    if (isset($_POST['select']))
    {
    
        $StudentName = $_POST['StudentName'];
        $CollegeName = $_POST['CollegeName'];
        $studentEmail = $_POST['StudentEmail'];
        $CompanyName = $_POST['CompanyName'];
        $JobProfile = $_POST['Post'];
    
        $hired_student = "INSERT INTO selectedstudents (CollegeName,CompanyName,StudentName,StudentEmail) VALUES ('$CollegeName','$CompanyName','$StudentName','$studentEmail')";
        $q_hired_student = mysqli_query($connection, $hired_student);
        $update_emp_count = "UPDATE companies set TotalEmp=TotalEmp+1,JobsAvailable=JobsAvailable-1 WHERE CompanyName='$CompanyName'";
        $q_update_emp_count = mysqli_query($connection, $update_emp_count);
    
        if ($q_hired_student)
        {
            $check_status_reapply = "Select * from jobapplications where Status='reapply' AND CompanyName='$CompanyName' AND StudentEmail='$studentEmail' AND Post='$JobProfile'";
            $q_check_status_reapply = mysqli_query($connection, $check_status_reapply);
            if($q_check_status_reapply){
                $remove_application="DELETE from jobapplications where Status='reapply' AND CompanyName='$CompanyName' AND StudentEmail='$studentEmail' AND Post='$JobProfile'";
                $q_remove_application = mysqli_query($connection, $remove_application);
                $update_status = "UPDATE jobapplications set Status='selected' WHERE CompanyName='$CompanyName' AND StudentEmail='$studentEmail' AND Post='$JobProfile'";
                $q_update_status = mysqli_query($connection, $update_status);
            }else{
                $update_status = "UPDATE jobapplications set Status='selected' WHERE CompanyName='$CompanyName' AND StudentEmail='$studentEmail' AND Post='$JobProfile'";
                $q_update_status = mysqli_query($connection, $update_status);
            }
            if ($q_update_status)
            {
              $remove_comp="UPDATE jobapplications set Status='rejected' WHERE CompanyName='$CompanyName' AND Post='$JobProfile' AND Status='pending'";
              $q_remove_comp = mysqli_query($connection, $remove_comp);
              $remove_job="DELETE from jobs WHERE CompanyName='$CompanyName' AND JobName='$JobProfile' LIMIT 1";
              $q_remove_job = mysqli_query($connection, $remove_job);
    
                ?><script>window.location.replace("jobOffers.php")</script><?php
    }
    }
    
    }
    else if (isset($_POST['NotSelect']))
    {
    # code...
    $StudentName = $_POST['StudentName'];
    $CollegeName = $_POST['CollegeName'];
    $studentEmail = $_POST['StudentEmail'];
    $CompanyName = $_POST['CompanyName'];
    $JobProfile = $_POST['Post'];

    
    $check_status_reapply = "Select * from jobapplications where Status='reapply' AND CompanyName='$CompanyName' AND StudentEmail='$studentEmail' AND Post='$JobProfile'";
    $q_check_status_reapply = mysqli_query($connection, $check_status_reapply);
    if($q_check_status_reapply){
        $remove_application="DELETE from jobapplications where Status='reapply' AND CompanyName='$CompanyName' AND StudentEmail='$studentEmail' AND Post='$JobProfile'";
        $q_remove_application = mysqli_query($connection, $remove_application);
        $update_status = "UPDATE jobapplications set Status='rejected' WHERE CompanyName='$CompanyName' AND StudentEmail='$studentEmail' AND Post='$JobProfile'";
        $q_update_status = mysqli_query($connection, $update_status);
    }else{
        $update_status = "UPDATE jobapplications set Status='rejected' WHERE CompanyName='$CompanyName' AND StudentEmail='$studentEmail' AND Post='$JobProfile'";
        $q_update_status = mysqli_query($connection, $update_status);
    }
    
    
    if ($q_update_status)
    {
        ?><script>window.location.replace("jobOffers.php")</script><?php
    }
    
    }
    else if (isset($_POST['reapply']))
    {
    # code...
    $StudentName = $_POST['StudentName'];
    $CollegeName = $_POST['CollegeName'];
    $studentEmail = $_POST['StudentEmail'];
    $CompanyName = $_POST['CompanyName'];
    $update_status = "UPDATE jobapplications set Status='reapply' WHERE CompanyName='$CompanyName' AND StudentEmail='$studentEmail'";
    $q_update_status = mysqli_query($connection, $update_status);
    
    if ($q_update_status)
    {
            ?><script>window.location.replace("jobOffers.php")</script><?php
    }
    
    }
    ?>
<script>
    $('.button-collapse').sideNav();
    
    $('.collapsible').collapsible();
    
    $('select').material_select();
</script>