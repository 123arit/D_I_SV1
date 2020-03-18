<?php
ob_start();
include 'inc/header.html';
include "inc/unauth_navbar.html"

?>


<?php

if($_POST){

$servername="localhost";
$username="root";
$password="";
$db_name="cu_attendance_system";


$conn=mysqli_connect($servername,$username,$password,$db_name);

$username= $_POST['username'];
$password= $_POST['password'];

$sql="SELECT * FROM teacher_login WHERE username='$username' AND password='$password'";

$result= mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1){


	
	

	$row= $result->fetch_assoc();



	$teacher_name= $row['name'];

	if($row['status']=="active"){


	
		session_start();
		$_SESSION[$teacher_name]='true'; ?>

		<?php header("Location:/cu_attendance_system_release/teacher/inside/index.php?name=".$teacher_name ); ?>

	<?php  }else{

		?> <div class="alert alert-danger"><h3>Teacher information is not yet validated!</h3>

			</div><br><br><a class="btn btn-light" href="/cu_attendance_system_release/teacher/">BACK</a><?php
	}

}else{

	?>  
		<br><br>

 		<div class="alert alert-danger" role="alert">
 		
 		<h3> <?php echo "Error! Wrong Username and Password"; ?> </h3>
 	</div>


 		<h2> 

            <a class="btn btn-info float-right" href="index.php"> Back</a>
        </h2>

 	

 		<br><br>

 	



<?php
}


}
?>
<?php include 'inc/footer.html'?>