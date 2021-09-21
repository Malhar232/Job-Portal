<?php
session_start();  
include ('../util/connection.php');
include ('../util/checkStudent.php');
include('studentCollege.php');



if(isset($_POST['submit'])){
    $Job_Title=$_POST['job_post'];
    if ($Job_Title == '')
    {
      ?><script>document.getElementById('message').innerHTML='Please Enter Job Profile'</script><?php
    }
    $rep=preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['CompanyName']);
    $companyName=$rep;
    $total = count($_FILES['upload']['name']);
    $totalSum= (array_sum($_FILES['upload']['size'])/1024)/1024;
    // Loop through each file
    if(!$_FILES['upload']['name'][0]){
        die("No files were uploaded!");
    }else{
        if($total>1){
                 ?><script>alert('Maximum files that can be uploaded = 1')</script><?php
                ?><script>window.location.replace("../students/companies.php")</script><?php

            }
        else{
            if ($totalSum>10) {
            die("Total Size Exceeds 10 MB !");
            ?><script>window.location.replace("../students/companies.php")</script><?php
            }
            else{
                for( $i=0 ; $i < $total ; $i++ ) {
    
                //Get the temp file path
                $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
            
                //Make sure we have a file path
                    if ($tmpFilePath != ""){
                        
                        $filename = "../uploads/Resumes/".$companyName;

                        if (!file_exists($filename)) {
                            mkdir("../uploads/Resumes/" . $companyName, 0777);
                            $newFilePath = "../uploads/Resumes/$companyName/" ."$userName_".$_FILES['upload']['name'][$i];
                            move_uploaded_file($tmpFilePath, $newFilePath);      
                        }else{
                            $newFilePath = "../uploads/Resumes/$companyName/" ."$userName_".$_FILES['upload']['name'][$i];
                            move_uploaded_file($tmpFilePath, $newFilePath);    
                        }
                       
                    }
                }
                $jobApply="INSERT INTO jobapplications (CompanyName,StudentName,StudentEmail,StudentCollege,ResumePath,Post,Status) VALUE ('{$_POST['CompanyName']}','$userName','{$_SESSION['email']}','$userCollege','$newFilePath','$Job_Title','pending')";
                $q_jobApply=mysqli_query($connection,$jobApply);
                if($q_jobApply){
                    echo "Successfully Applied!";

                    ?><script>window.location.replace("../students/companies.php")</script><?php
                }else{
                    die("Something went wrong!<br>Try Again Later!");
                }
            }
            
            
        }
    }
    
    
}
else {
    ?><script>window.location.replace("../students/companies.php")</script><?php

}
?>


