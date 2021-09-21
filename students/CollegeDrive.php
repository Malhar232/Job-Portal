<?php  
    session_start();  
    include ('../util/connection.php');
    include ('../util/checkStudent.php');
    
    include('studentCollege.php');
    
    ?>
<title>Campus Drive</title>
<link rel="icon" href="../images/logo.png"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
    <ul class="dropdown-content" id="user_dropdown" >
        <li><a style="color:#4b0082" class="" href="../util/updateProfile.php">Update Profile</a></li>
        <li><a style="color:#4b0082" class="" href="../util/changePass.php">Change Password</a></li>
        <li><a style="color:#4b0082" class="" href="../util/logout.php">Logout</a></li>
    </ul>
    <nav style="background-color:#4b0082;" role="navigation">
        <div class="nav-wrapper">
            <a data-activates="slide-out" class="button-collapse show-on-" href="#!"><img src="../images/logo.png" width="65"/></a>
            <ul class="left hide-on-med-and-down">
                <li id='dash_dashboard'><a class='waves-effect' href='welcome.php'>Home</a></li>
                <li id='dash_dashboard'><a class='waves-effect' href='jobsApplied.php'>Jobs Applied</a></li>
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
<h1>Campus Drive</h1>
<?php
    $campus_details="select * from campusdrive WHERE CollegeName='{$userCollege}'";
    
    
        if( !( $q_campus_details=mysqli_query($connection,$campus_details)) ) {
          echo 'Retrieval of data from Database Failed - #';
        }else{
          echo "<ul id='slide-out' class='side-nav fixed z-depth-2 hide-on-large-only	'>
          
    
          <li id='dash_dashboard'><a class='waves-effect' href='welcome.php'>Home</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='jobsApplied.php'>Jobs Applied</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='companies.php'>List of Companies</a></li>
            <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
    
    
        </ul>
        ";
          ?>
<table class="blueTable">
    <thead>
        <tr>
            <th>Company Name</th>
            <th>College Name</th>
            <th>Round 1</th>
            <th>Date</th>
            <th>Round 2</th>
            <th>Date</th>
            <th>Round 3</th>
            <th>Date</th>
            <th>Round 4</th>
            <th>Date</th>
            <th>Round 5</th>
            <th>Date</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if( mysqli_num_rows( $q_campus_details )==0 ){
              echo '<tr><td colspan="13">No Campus Drives</td></tr>';
            }else{
              while( $college_campus_row = mysqli_fetch_assoc( $q_campus_details ) ){
                if($college_campus_row['Date2']=='1970-01-01'){
                  $college_campus_row['Date2']='-';
              }
              if($college_campus_row['Date3']=='1970-01-01'){
                $college_campus_row['Date3']='-';
              }
              if($college_campus_row['Date4']=='1970-01-01'){
                $college_campus_row['Date4']='-';
              }
              if($college_campus_row['Date5']=='1970-01-01'){
                $college_campus_row['Date5']='-';
              }
                echo "<tr>
                <td>{$college_campus_row['CompanyName']}</td>
                <td>{$college_campus_row['CollegeName']}</td>
                <td>{$college_campus_row['Round1']}</td>
                <td>{$college_campus_row['Date1']}</td>
                <td>{$college_campus_row['Round2']}</td>
                <td>{$college_campus_row['Date2']}</td>
                <td>{$college_campus_row['Round3']}</td>
                <td>{$college_campus_row['Date3']}</td>
                <td>{$college_campus_row['Round4']}</td>
                <td>{$college_campus_row['Date4']}</td>
                <td>{$college_campus_row['Round5']}</td>
                <td>{$college_campus_row['Date5']}</td>
            
                <td><button style='background:#4b0082;color:white;border:none' id='{$college_campus_row['CompanyName']}-{$college_campus_row['CollegeName']}' onclick='openModal(event)'>View Details</button></td>
                
                <div id='{$college_campus_row['CompanyName']}-{$college_campus_row['CollegeName']}' class='modal-cstm'>
            
                    <div class='modal-cstm-content'>
                    <h3>{$college_campus_row['CompanyName']}</h3>
                    <h6 style='color:black;text-decoration:none;font-weight:bold;text-align:center'>{$college_campus_row['CollegeName']}</h6>
                    <p style='color:black;font-style:italic'>{$college_campus_row['Description']}</p>
            
            
            
                </tr>\n";
                
                
              }
            }
            ?>
    </tbody>
</table>
<?php
    }
    
    ?>
<style>
    .modal-cstm {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0, 0, 0); /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }
    /* modal-cstm Content/Box */
    .modal-cstm-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
    }
</style>
<script>
    async function openModal(e) {
        var modal =await document.getElementById(e.target.id);
        modal.style.display = "block";
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
    
</script>
<script>
    $('.button-collapse').sideNav();
    
    $('.collapsible').collapsible();
    
    $('select').material_select();
</script>