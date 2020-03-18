<?php
ob_start();





  $status=$_GET['status'];
  $teacher_id=$_GET['teacher_id'];
  $admin_email=$_GET['admin_email'];
  
  
  session_start();
  
  if(!$_SESSION[$admin_email]){
  
    header('Location:/D_I_S/index.php');
  }
?>

<?php



$servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";



$conn= mysqli_connect($servername,$username,$password,$db_name);
?>

<?php
if($status== 'active'){
	$sql="UPDATE teachers SET status='passive' WHERE id='".$teacher_id."'";

	mysqli_query($conn, $sql);

  header("Location: validate_teacher.php?admin_email=".$admin_email);
}else if($status== 'passive'){


	$sql="UPDATE teachers SET status='active' WHERE id='".$teacher_id."'";

	mysqli_query($conn, $sql);

  header("Location: validate_teacher.php?admin_email=".$admin_email);

}

header("Location: validate_teacher.php?admin_email=".$admin_email);


?>