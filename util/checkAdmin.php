<?php
$admin_exists="SELECT * FROM admin WHERE AdminEmail='{$_SESSION['email']}'";
$q_admin_exists=mysqli_query($connection,$admin_exists);
if(mysqli_num_rows($q_admin_exists)==0)  
{  
    session_destroy();  

    ?><script>window.location.replace("../util/login.php")</script>;<?php
}  
?>