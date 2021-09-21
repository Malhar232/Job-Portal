<?php  
$get_user_college="select StudentCollege,StudentName from students WHERE StudentEmail='{$_SESSION['email']}'";
$q_getUserCollege=mysqli_query($connection,$get_user_college);
if( mysqli_num_rows($q_getUserCollege)==0 ){
  // echo 'No Data Available';
}else{
  $row = mysqli_fetch_assoc( $q_getUserCollege );
  $userCollege=$row['StudentCollege'];
  $userName=$row['StudentName'];
  
}
?>

