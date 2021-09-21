<?php
    session_start();
    
    include ('../util/connection.php');
    include ('../util/checkAdmin.php');
    
    ?>  
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" rel="stylesheet">
<style>
    <?php include '../css/companies.css'; ?>
    <?php include '../css/partials.css'; ?>
    <?php include '../css/globals.css'; ?>
</style>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../images/logo.png"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
        <title>Company List</title>
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
                    <a data-activates="slide-out" class="button-collapse show-on-" href="#!"><img src="../images/logo.png" width='65'/></a>
                    <ul class="left hide-on-med-and-down">
                        <li id='dash_dashboard'><a class='waves-effect' href='welcome-admin.php'>Home</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
                        <li id='dash_dashboard'><a class='waves-effect' href='jobOffers.php'>Overall Job Applications</a></li>
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
        <h1>List of Companies</h1>
        <a class='add' href="newCompany.php"><i class='fas fa-plus'></i> Add Company</a>
        <?php
            $selectSQL = 'SELECT * FROM `companies`';
            if (!($selectRes = mysqli_query($connection, $selectSQL)))
            {
                echo 'Retrieval of data from Database Failed!';
            }
            else
            {
              echo "<ul id='slide-out' class='side-nav fixed z-depth-2 hide-on-large-only	'>
                  
            
                  <li id='dash_dashboard'><a class='waves-effect' href='welcome-admin.php'>Home</a></li>
                  <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
                  <li id='dash_dashboard'><a class='waves-effect' href='jobOffers.php'>Overall Job Applications</a></li>
                  <li id='dash_dashboard'><a class='waves-effect' href='DriveApplications.php'>Drive Applications</a></li>
                  <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
            
            
                </ul>
                "
            ?>
        <?php
            if (mysqli_num_rows($selectRes) == 0)
            {
              echo "<br><p class='status'style='margin:10% auto !important'>No companies available</p>";
            }
            else
            {
            ?>
        <main class="grid">
            <?php
                while ($row = mysqli_fetch_assoc($selectRes))
                {
                    echo "<tr>
                    
                    <article>
                      <img src='{$row['CompanyPic']}' alt='{$row['CompanyName']}pic'>
                      <div class='text'>
                        <h3>{$row['CompanyName']}</h3>
                        <p>{$row['CompanyDesc']}</p>
                        <p title='Total Employees'><i class='fas fa-users' style='color:4b0082'></i> {$row['TotalEmp']}</p>
                        <p>Jobs Available: {$row['JobsAvailable']}</p>
                        <a href='edit.php?q={$row['CompanyName']}'><img class='action' src='../images/icons/edit.png' width='32px'></a>
                        <a href='delete.php?q={$row['CompanyName']}'><img class='action' src='../images/icons/delete.png' width='32px'></a>
                      </div>
                      </article>
                    ";
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
            var modal =await document.getElementById(e.target.id);
            modal.style.display = "block";
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
        
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        var dropzone=document.querySelector('.file-upload');
        
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
                  if(totalSize<=35){
                        if (count > 1) {
                          approvedHTML += files[x].name+"<br><br>";
        
                        }
                      else {
                          approvedHTML += files[x].name+"<br><br>";
                      }
        
                      count++;
                    }
                    else{
                      alert("Exceeded 35 MB !!");
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