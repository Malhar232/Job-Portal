<?php
    session_start();  
    
    include ('../util/connection.php');
    include ('../util/checkStudent.php');
    
    include 'studentCollege.php';
    
    ?>
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
    <?php include '../css/companies.css'; ?>
    <?php include '../css/partials.css'; ?>
    <?php include '../css/Tables.css'; ?>
    <?php include '../css/globals.css'; ?>
</style>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
        <title>List of Companies</title>
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
            .apply{
            background: linear-gradient(to right, #7840a1 0%, #5d198e 66%, #4b0082 100%);
            border-radius: 3px;
            border: 0;
            color: white;
            padding: 10px;
            width: 100%;
            font-weight: 600;
            text-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
            cursor: pointer;
            }
            /* modal-cstm Content/Box */
            .modal-cstm-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            overflow-x: auto;
            height:50%;
            }
            form{
            height: 80%;
            }
            /* The Close Button */
            /* resume upload */
            .file-upload__label {
            background-color: rgba(255, 255, 255);
            border-radius: 30px;
            color: #000;
            font-size: .7rem;
            left: 50%;
            cursor: pointer;
            outline: none;
            padding: 15px;
            pointer-events: none;
            position: absolute;
            text-align: center;
            top: 40%;
            transform: translate(-50%, -50%);
            white-space: nowrap;
            width: 200px;
            }
            .file-upload__input {
            color: transparent;
            cursor: pointer;
            opacity: 0;
            width: 100%;
            height: 100%;
            }
            .file-upload {
            position: relative;
            cursor: pointer;
            background-color: #caa6f1; /* Fallback color */
            top: 25%;
            left: 50%;
            width: 75%;
            height: 50%;
            transform: translate(-50%, -50%);
            transition: 0.3s ease-in-out;
            }
            .file-upload:hover {
            background: rgba(46, 49, 49, 1);
            }
            .form_btns {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* padding: 10px 25px; */
            background: white;
            } 
            .status{
            font-weight:bold;
            font-style:normal;
            }
            .dropdown-content li>a, .dropdown-content li>span{
            color:black !important;
            }
            .dropdown-content{
            top:43px !important;
            }
        </style>
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
                    <a data-activates="slide-out" class="button-collapse show-on-" href="#!"><img src="../images/logo.png" width="65"/></a>
                    <ul class="left hide-on-med-and-down">
                        <li id='dash_dashboard'><a class='waves-effect' href='welcome.php'>Home</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='jobsApplied.php'>Jobs Applied</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
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
        <h1>List of Companies</h1>
        <?php
            $selectSQL = 'SELECT * FROM `companies`';
            if( !( $selectRes = mysqli_query( $connection,$selectSQL ) ) ){
              echo 'Retrieval of data from Database Failed - #';
            }else{
              echo "<ul id='slide-out' class='side-nav fixed z-depth-2 hide-on-large-only	'>
              
            
                <li id='dash_dashboard'><a class='waves-effect' href='welcome.php'>Home</a></li>
                <li id='dash_dashboard'><a class='waves-effect' href='jobsApplied.php'>Jobs Applied</a></li>
                <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
                <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
            
            
            </ul>
            ";
              ?>
        <?php
            if( mysqli_num_rows( $selectRes )==0 ){
              echo "<p class='status' style='text-align:center'>No jobs available</p>";
            }else{
            ?>   
        <main class="grid"><?php
            while( $row = mysqli_fetch_assoc( $selectRes ) ){
              echo "
            
              <article>
                <img src='{$row['CompanyPic']}' alt='{$row['CompanyName']}pic'>
                <div class='text'>
                  <h3>{$row['CompanyName']}</h3>
                  <p>{$row['CompanyDesc']}</p>
                  <p title='Total Employees'><i class='fas fa-users' style='color:4b0082'></i> {$row['TotalEmp']}</p>
                  
            
              ";
              if($row['JobsAvailable']!=0){
                $alreadyApplied = "SELECT * FROM `jobapplications` WHERE StudentName='$userName' AND CompanyName='{$row['CompanyName']}' AND Status='pending'";
                $q_alreadyApplied=mysqli_query($connection,$alreadyApplied);
                $reApplied = "SELECT * FROM `jobapplications` WHERE StudentName='$userName' AND CompanyName='{$row['CompanyName']}' AND Status='reapply'";
                $q_reApplied=mysqli_query($connection,$reApplied);
                if( mysqli_num_rows($q_alreadyApplied)>0 ){
                  echo "
                  <button class='{$row['CompanyID']}' onclick='openModal(event)'>Applied</button>
                  </div>
            </article>    
                  <div id='{$row['CompanyID']}' class='modal-cstm'>
            
                      <div class='modal-cstm-content'>
                      <h3>{$row['CompanyName']}</h3>
            
                      <p class='status'>Applied!</p>
                  ";
                }
                elseif(mysqli_num_rows($q_reApplied)>0 ){
                  echo "<button class='{$row['CompanyID']}' id='apply' onclick='openModal(event)'>Apply</button>
                  </div>
            </article>    
                  <div id='{$row['CompanyID']}' class='modal-cstm'>
            
                      <div class='modal-cstm-content'>
                      <h3>{$row['CompanyName']}</h3>
                      <p>*Kindly upload your resume for a given job profile</p>
                    <form  action='upload.php' method='POST' enctype='multipart/form-data'  >
            
                      <div class='file-upload'>
                        <label class='file-upload__label'>Select or drop your resume here</label><input id='input' title='' class='file-upload__input' multiple name='upload[]' type='file' accept='application/pdf,application/msword,application/vnd.openxmlformats-officedocumen.wordprocessingml.document'
                        required/>
                        <input type='hidden' name='CompanyName' value='{$row['CompanyName']}'/>
                        ";
                        $get_all_jobs="SELECT * FROM jobs WHERE CompanyName='{$row['CompanyName']}'";
                          $q_get_all_jobs=mysqli_query($connection,$get_all_jobs);
                          ?><select name="job_post" required>
            <?php
                while($job_row = mysqli_fetch_assoc( $q_get_all_jobs )){
                  echo "
                  <option id='{$job_row['JobName']}' name='job_post' value='{$job_row['JobName']}'>{$job_row['JobName']} - {$job_row['Package']} (LPA)</option>
                  ";
                }
                ?></select><?php
                echo "
                <button class='apply' type='submit' name='submit'>Submit</button>
                </div>
                </form>
                ";
                }
                else{
                $selected = "SELECT * FROM `jobapplications` WHERE StudentName='$userName' AND CompanyName='{$row['CompanyName']}' AND Status='selected'";
                $q_selected=mysqli_query($connection,$selected);
                $rejected = "SELECT * FROM `jobapplications` WHERE StudentName='$userName' AND CompanyName='{$row['CompanyName']}' AND Status='rejected'";
                $q_rejected=mysqli_query($connection,$rejected);
                if( mysqli_num_rows( $q_selected )>0 ){
                echo "
                <button class='{$row['CompanyID']}' onclick='openModal(event)'>Selected</button>
                </div>
                </article>    
                <div id='{$row['CompanyID']}' class='modal-cstm'>
                
                <div class='modal-cstm-content'>
                <h3>{$row['CompanyName']}</h3>
                
                <p  class='status'>Selected!</p>
                ";
                }elseif(mysqli_num_rows($q_rejected)>0 ) {
                echo "
                <button class='{$row['CompanyID']}' onclick='openModal(event)'>Not Selected</button>
                </div>
                </article>    
                <div id='{$row['CompanyID']}' class='modal-cstm'>
                
                <div class='modal-cstm-content'>
                <h3>{$row['CompanyName']}</h3>
                
                <p  class='status'>Not Selected!</p>
                ";
                }else{
                echo "<button class='{$row['CompanyID']}' id='apply' onclick='openModal(event)'>Apply</button>
                </div>
                </article>    
                <div id='{$row['CompanyID']}' class='modal-cstm'>
                
                <div class='modal-cstm-content'>
                <h3>{$row['CompanyName']}</h3>
                <p>*Kindly upload your resume for a given job profile</p>
                
                <form  action='upload.php' method='POST' enctype='multipart/form-data'  >
                
                <div class='file-upload'>
                  <label class='file-upload__label'>Select or drop your resume here</label><input id='input' title='' class='file-upload__input' multiple name='upload[]' type='file' accept='application/pdf,application/msword,application/vnd.openxmlformats-officedocumen.wordprocessingml.document' required/>
                  <input type='hidden' name='CompanyName' value='{$row['CompanyName']}'/>
                  ";
                  $get_all_jobs="SELECT * FROM jobs WHERE CompanyName='{$row['CompanyName']}'";
                  $q_get_all_jobs=mysqli_query($connection,$get_all_jobs);
                  ?><select name="job_post" required>
            <?php
                while($job_row = mysqli_fetch_assoc( $q_get_all_jobs )){
                  echo "
                  <option id='{$job_row['JobName']}' name='job_post' value='{$job_row['JobName']}'>{$job_row['JobName']} - {$job_row['Package']} (LPA)</option>
                  ";
                }
                ?></select><?php
                echo "
                <button class='apply' type='submit' name='submit'>Submit</button>
                </div>
                </form>
                ";
                }
                
                
                }
                $search_campus_drive="SELECT * FROM campusdrive WHERE CompanyName='{$row['CompanyName']}' AND CollegeName='{$userCollege}'";
                $q_getCampusDrive=mysqli_query($connection,$search_campus_drive);
                if( mysqli_num_rows($q_getCampusDrive)==0 ){
                  echo '<p text-align="center">No campus drive scheduled.</p>';
                }else{
                
                  
                
                  $campus_drive_row = mysqli_fetch_assoc( $q_getCampusDrive );
                   if($campus_drive_row['Date2']=='1970-01-01'){
                          $campus_drive_row['Date2']='-';
                      }
                      if($campus_drive_row['Date3']=='1970-01-01'){
                        $campus_drive_row['Date3']='-';
                      }
                      if($campus_drive_row['Date4']=='1970-01-01'){
                        $campus_drive_row['Date4']='-';
                      }
                      if($campus_drive_row['Date5']=='1970-01-01'){
                        $campus_drive_row['Date5']='-';
                      }
                  echo "
                  <table class='blueTable'>
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
                        <h5>Campus Drive for {$userCollege}</h5>
                        <tbody>
                          <tr>
                            <td>{$campus_drive_row['CompanyName']}</td>
                            <td>{$campus_drive_row['CollegeName']}</td>
                            <td>{$campus_drive_row['Round1']}</td>
                            <td>{$campus_drive_row['Date1']}</td>
                            <td>{$campus_drive_row['Round2']}</td>
                            <td>{$campus_drive_row['Date2']}</td>
                            <td>{$campus_drive_row['Round3']}</td>
                            <td>{$campus_drive_row['Date3']}</td>
                            <td>{$campus_drive_row['Round4']}</td>
                            <td>{$campus_drive_row['Date4']}</td>
                            <td>{$campus_drive_row['Round5']}</td>
                            <td>{$campus_drive_row['Date5']}</td>
                
                            <td><a href='CollegeDrive.php'>View Details</a></td>
                            
                            
                          </tr>
                        </tbody>
                  </table>
                  ";
                }
                echo "
                </div>
                
                </div>
                "
                
                ;
                }else{
                echo "<p  class='status'>No Jobs Available!</p></div>
                </article> ";
                
                }
                "
                </tr>\n";
                }
                }
                ?>
        </main>
        <?php
            }
              
              ?>
    </body>
    <script>
        $('.button-collapse').sideNav();
        
        $('.collapsible').collapsible();
        
        $('select').material_select();
    </script>
    <script>
        async function openModal(e) {
          
            var modal =await document.getElementById(e.target.className);
            modal.style.display = "block";
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
        
    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script>
        var dropzone=document.querySelector('.file-upload');
        /* events fired on the drop targets */
        // dropzone.addEventListener("dragover", function(event) {
        //   // prevent default to allow drop
          
        //   e.preventDefault();
        // }, false);
        
        // dropzone.addEventListener("dragenter", function(event) {
        //   // highlight potential drop target when the draggable element enters it
        //   dropzone.style.background = "rgba(46, 49, 49, 1)";
        //   dropzone.style.border = "3px dashed #f4f4f4";
        
        // }, false);
        
        // dropzone.addEventListener("dragleave", function(event) {
        //   // reset background of potential drop target when the draggable element leaves it
        //     dropzone.style.background = "";
        //     dropzone.style.border = "";
        // }, false);
        
        
        (function() {
        $(function() {
          return $('.file-upload__input').on('change', function(e) {
            var count=1;
            var approvedHTML='';
            var totalSize=0
            var files = e.currentTarget.files; 
            for (var x in files) {
              var filesize = ((files[x].size/1024)/1024).toFixed(4); // MB
        
              if (files[x].name != "item" && typeof files[x].name != "undefined") { 
        
                  totalSize+=parseFloat(filesize)
                  if(totalSize<=10){
                        if (count > 1) {
                          approvedHTML += files[x].name+"<br><br>";
        
                        }
                      else {
                          approvedHTML += files[x].name+"<br><br>";
                      }
        
                      count++;
                    }
                    else{
                      alert("Exceeded 10 MB !!");
                      break;
                    }
                }
            }
                
                return $('.file-upload__label').html([this.files.length, 'Files to upload'].join(' '));    
        
        
          });
        });
        
        }).call(this);
        
    </script>
</html>