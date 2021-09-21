<?php

// data
$get_total_students="select * from students";
$q_get_total_students=mysqli_query($connection,$get_total_students);

// campus drives
$get_campus_drives="select * from campusdrive";
$q_get_campus_drives=mysqli_query($connection,$get_campus_drives);

if(isset($row['StudentCollege'])){
    $get_clg_students="select * from students where StudentCollege='{$row['StudentCollege']}'";
    $q_get_clg_students=mysqli_query($connection,$get_clg_students);
}


$get_selected_students="select * from selectedstudents";
$q_get_selected_students=mysqli_query($connection,$get_selected_students);

$get_companies="select * from companies";
$q_get_companies=mysqli_query($connection,$get_companies);

// RCOEM
$get_total_rcoem_students="select * from students where StudentCollege='RCOEM'";
$q_get_total_rcoem_students=mysqli_query($connection,$get_total_rcoem_students);
// YCCE
$get_total_ycce_students="select * from students where StudentCollege='YCCE'";
$q_get_total_ycce_students=mysqli_query($connection,$get_total_ycce_students);
// Raisoni
$get_total_raisoni_students="select * from students where StudentCollege='Raisoni'";
$q_get_total_raisoni_students=mysqli_query($connection,$get_total_raisoni_students);
// VNIT
$get_total_vnit_students="select * from students where StudentCollege='VNIT'";
$q_get_total_vnit_students=mysqli_query($connection,$get_total_vnit_students);

// RCOEM
$get_RCOEM_students="select * from jobapplications where StudentCollege='RCOEM' and Status!='pending' and Status!='reapply'";
$q_get_RCOEM_students=mysqli_query($connection,$get_RCOEM_students);

$get_RCOEM_selected_students="select * from jobapplications where StudentCollege='RCOEM' and Status='selected'";
$q_get_RCOEM_selected_students=mysqli_query($connection,$get_RCOEM_selected_students);

$percentage_RCOEM=is_nan((mysqli_num_rows($q_get_RCOEM_selected_students)/mysqli_num_rows($q_get_RCOEM_students))*100)?0:(mysqli_num_rows($q_get_RCOEM_selected_students)/mysqli_num_rows($q_get_RCOEM_students))*100;

// YCCE
$get_YCCE_students="select * from jobapplications where StudentCollege='YCCE' and Status!='pending' and Status!='reapply'";
$q_get_YCCE_students=mysqli_query($connection,$get_YCCE_students);

$get_YCCE_selected_students="select * from jobapplications where StudentCollege='YCCE' and Status='selected'";
$q_get_YCCE_selected_students=mysqli_query($connection,$get_YCCE_selected_students);

$percentage_YCCE=is_nan((mysqli_num_rows($q_get_YCCE_selected_students)/mysqli_num_rows($q_get_YCCE_students))*100)?0:(mysqli_num_rows($q_get_YCCE_selected_students)/mysqli_num_rows($q_get_YCCE_students))*100;

// Raisoni
$get_Raisoni_students="select * from jobapplications where StudentCollege='Raisoni' and Status!='pending' and Status!='reapply'";
$q_get_Raisoni_students=mysqli_query($connection,$get_Raisoni_students);

$get_Raisoni_selected_students="select * from jobapplications where StudentCollege='Raisoni' and Status='selected'";
$q_get_Raisoni_selected_students=mysqli_query($connection,$get_Raisoni_selected_students);

$percentage_Raisoni=is_nan((mysqli_num_rows($q_get_Raisoni_selected_students)/mysqli_num_rows($q_get_Raisoni_students))*100)?0:(mysqli_num_rows($q_get_Raisoni_selected_students)/mysqli_num_rows($q_get_Raisoni_students))*100;

// VNIT
$get_VNIT_students="select * from jobapplications where StudentCollege='VNIT' and Status!='pending' and Status!='reapply'";
$q_get_VNIT_students=mysqli_query($connection,$get_VNIT_students);

$get_VNIT_selected_students="select * from jobapplications where StudentCollege='VNIT' and Status='selected'";
$q_get_VNIT_selected_students=mysqli_query($connection,$get_VNIT_selected_students);

$percentage_VNIT=is_nan((mysqli_num_rows($q_get_VNIT_selected_students)/mysqli_num_rows($q_get_VNIT_students))*100)?0:(mysqli_num_rows($q_get_VNIT_selected_students)/mysqli_num_rows($q_get_VNIT_students))*100;

?>