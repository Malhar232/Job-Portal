<?php
    session_start();
    
    include ('../util/connection.php');
    include ('../util/checkAdmin.php');
    
    $get_details = "SELECT * FROM companies WHERE CompanyName='{$_GET['q']}'";
    $q_get_details = mysqli_query($connection, $get_details);
    if (mysqli_num_rows($q_get_details) > 0)
    {
    
        $company_details = mysqli_fetch_assoc($q_get_details);
    
    ?>  
<html>
    <head lang="en">
        <link rel="icon" href="../images/logo.png">
        <meta charset="UTF-8">
        <title>Edit</title>
    </head>
    <style>
        <?php include '../css/partials.css'; ?>
        <?php include '../css/globals.css'; ?>
    </style>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" rel="stylesheet">
    <style>
        <?php include '../css/edit.css'; ?>
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <title>Edit Comapny</title>
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
            ";?>
        <div class="login-page">
            <div class="form" >
                <form class="register-form"  method="post" enctype='multipart/form-data'>
                    <h2>Edit Company Details</h2>
                    <input  id="updated-name" value="<?php echo $_GET['q'] ?>" placeholder="Company Name" name="updated-name" type="text" autofocus required>  
                    <textarea name="updated-desc" id="updated-desc" cols="10" rows="5" placeholder="Company Description" maxlength="1500" autofocus required></textarea>
                    <input  id="updated-cover"  name="updated-cover[]" type="file"  accept="image/*" autofocus >  
                    <input  id="updated-total-employees" value="<?php echo $company_details['TotalEmp'] ?>" placeholder="Total Employees" min="0" name="updated-total-employees" type="number" autofocus required>  
                    <input  id="total-jobs-edit" value="<?php echo $company_details['JobsAvailable'] ?>" placeholder="Jobs Available (default 0)" min="0" name="total-jobs-edit" type="number" autofocus >  
                    <div id="companyForm-edit"></div>
                    <input id="submit-btn" type="submit" value="Update Changes" name="edit-company" >  
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
        $('#total-jobs-edit').on('input', function () {
          var numberOfJobs=document.getElementById("total-jobs-edit");
        
             var form=document.getElementById("companyForm-edit");
             form.innerHTML="";
             for (i=0;i<numberOfJobs.value;i++){
        
              var JobName = document.createElement("input");
              JobName.type = "text";
              JobName.name = "jobName[]";
              JobName.required = true;
              JobName.placeholder = `Job ${i+1} Name`;
              JobName.className = `jobName`;
              form.appendChild(JobName);
              var Package = document.createElement("input");
              Package.type = "text";
              Package.placeholder = "Package (LPA)";
              Package.name = "Package[]";
              Package.required = true;
              Package.className = `package`;
        
              form.appendChild(Package);
        
              form.appendChild(Package);
        
              var Delete = document.createElement("p");
              Delete.innerText="Delete";
              Delete.autofocus=false;
              Delete.className = `delete`;
        
              Delete.onclick=()=>numberOfJobs--;
              Delete.onclick=(e)=>{
                numberOfJobs.value--;
                e.target.previousElementSibling.remove();
                e.target.previousElementSibling.remove();
                e.target.remove();
        
              }
              form.appendChild(Delete);
              
              
              }
            });
        
            document.getElementById("updated-desc").innerHTML='<?=$company_details['CompanyDesc'] ?>';
        
    </script>
</html>
<?php
    $get_jobs = "SELECT * FROM jobs WHERE CompanyName='{$_GET['q']}'";
    $q_get_jobs = mysqli_query($connection, $get_jobs);
    ?><script> var form=document.getElementById("companyForm-edit");    </script><?php
    if (mysqli_num_rows($q_get_jobs) == 0)
    {
    ?><script>form.innerHTML=""</script><?php
    }
    else
    {
    
        while ($job_row = mysqli_fetch_assoc($q_get_jobs))
        {
    ?><script>
    var JobName = document.createElement("input");
    JobName.type = "text";
    JobName.name = "jobName[]";
    JobName.required = true;
    JobName.value = "<?php echo $job_row['JobName'] ?>";
    JobName.placeholder = "Job Name";
    JobName.className = `jobName`;
    
    form.appendChild(JobName);
    var Package = document.createElement("input");
    Package.type = "text";
    Package.placeholder = "Package (LPA)";
    Package.name = "Package[]";
    Package.value = "<?php echo $job_row['Package'] ?>";
    Package.required = true;
    Package.className = `package`;
    
    form.appendChild(Package);
    
    
    var Delete = document.createElement("p");
    Delete.innerText="Delete";
    Delete.autofocus=false;
    Delete.className = `delete`;
    
    var numberOfJobs=document.getElementById("total-jobs-edit");
    
    Delete.onclick=(e)=>{
      numberOfJobs.value--;
      e.target.previousElementSibling.remove();
      e.target.previousElementSibling.remove();
      e.target.remove();
    
    }
    form.appendChild(Delete);
    
</script><?php
    }
    }
    }
    else
    {
    die("No Company Found");
    }
    
    if (isset($_POST['edit-company']))
    {
    $updated_name = $_POST['updated-name'];
    $updated_desc = $_POST['updated-desc'];
    $updated_emp = $_POST['updated-total-employees'];
    $updated_jobs = $_POST['total-jobs-edit'];
    $updated_cover = $_FILES['updated-cover']['tmp_name'][0];
    
    $jobNames = isset($_POST['jobName'])?$_POST['jobName']:'';
    $Packages = isset($_POST['Package'])?$_POST['Package']:'';
    
    if ($updated_cover)
    {
    unlink($company_details['CompanyPic']);
    $newFilePath = "../uploads/CompanyPics/" . $_FILES['updated-cover']['name'][0];
    move_uploaded_file($company_cover, $newFilePath);
    $update_company = "UPDATE companies SET CompanyName='$updated_name',CompanyDesc='$updated_desc',CompanyPic='$newFilePath',TotalEmp='$updated_emp',JobsAvailable='$updated_jobs' WHERE CompanyName = '{$_GET['q']}'";
    $q_update_company = mysqli_query($connection, $update_company);
    
    $remove_jobs = "DELETE FROM jobs WHERE CompanyName='{$_GET['q']}'";
    mysqli_query($connection, $remove_jobs);
    
    for ($i = 0;$i < $updated_jobs;$i++)
    {
        $add_jobs = "INSERT INTO jobs (JobName,CompanyName,Package) VALUE ('{$jobNames[$i]}','{$_GET['q']}','{$Packages[$i]}')";
        mysqli_query($connection, $add_jobs);
    }
    
    }
    else
    {
    
    $remove_jobs = "DELETE FROM jobs WHERE CompanyName='{$_GET['q']}'";
    $q_remove_jobs = mysqli_query($connection, $remove_jobs);
    
    for ($i = 0;$i < $updated_jobs;$i++)
    {
        $add_jobs = "INSERT INTO jobs (JobName,CompanyName,Package) VALUE ('{$jobNames[$i]}','{$_GET['q']}','{$Packages[$i]}')";
        mysqli_query($connection, $add_jobs);
    }
    
    $update_company = "UPDATE companies SET CompanyName='$updated_name',CompanyDesc='$updated_desc',TotalEmp='$updated_emp',JobsAvailable='$updated_jobs' WHERE CompanyName = '{$_GET['q']}'";
    $q_update_company = mysqli_query($connection, $update_company);
    
    }
    if ($_GET['q'] != $updated_name)
    {
    $update_jobs_company = "UPDATE jobs SET CompanyName='$updated_name' WHERE CompanyName = '{$_GET['q']}'";
    $q_update_jobs_company = mysqli_query($connection, $update_jobs_company);
    }
    
    if ($updated_name == '')
    {
    echo "<script>alert('Please enter the Company Name')</script>";
    exit();
    }
    if ($updated_desc == '')
    {
    echo "<script>alert('Please enter the Company Desc.')</script>";
    exit();
    }
    if ($updated_emp == '')
    {
    echo "<script>alert('Please enter the number of employees')</script>";
    exit();
    }
    
    if ($q_update_company)
    {
    ?><script>window.location.replace("companies.php")</script><?php
    }
    }
    
    ?>