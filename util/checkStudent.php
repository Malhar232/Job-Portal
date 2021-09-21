<?php
$student_exists="SELECT * FROM students WHERE StudentEmail='{$_SESSION['email']}'";
$q_student_exists=mysqli_query($connection,$student_exists);
if(mysqli_num_rows($q_student_exists)==0)  
{  
    session_destroy();  

    ?><script>window.location.replace("../util/login.php")</script>;<?php
}  
?>