<?php
ob_start();
?>
<?php
include "inc/header.html";
include "inc/unauth_navbar.html";
?>



<?php

if($_POST){

$servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";


$conn=mysqli_connect($servername,$username,$password,$db_name);

$email= $_POST['email'];
$password= $_POST['password'];

$options = [
  'cost' => 11
];

$hashed_password= password_hash($password, PASSWORD_DEFAULT, $options);

$sql="SELECT * FROM teachers WHERE email='$email'";// AND password='$hashed_password'";

$result= mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1){


	
	

	$row= $result->fetch_assoc();

 if(password_verify($password, $row['password'])){



  $teacher_name= $row['name'];
  $gravatar=$row['avatar'];
  $teacher_id=$row['id'];

	if($row['status']=="active"){


	
		session_start();
		$_SESSION[$teacher_name]='true'; ?>

		<?php header("Location:/D_I_S/teacher/dashboard.php?id=".$teacher_id."&name=".$teacher_name); ?>

	<?php  }else{

		?> <div class="alert alert-danger"><h3>Teacher information is not yet validated!</h3>

			</div><br><br><a class="btn btn-light" href="index.php">BACK</a><?php
  }
}else{

  ?>  
		<br><br>

 		<div class="alert alert-danger" role="alert">
 		
 		<h3> <?php echo "Error! Password is invalid!"; ?> </h3>
 	</div>
<?php

}

}else{

	?>  
		<br><br>

 		<div class="alert alert-danger" role="alert">
 		
 		<h3> <?php echo "Error! Email doesn't exist"; ?> </h3>
 	</div>


 		<h2> 

            <a class="btn btn-info float-right" href="index.php"> Back</a>
        </h2>

 	

 		<br><br>

 	



<?php
}


}
?>

<!-- Login -->
<div class="login">
  <div class="container">
    <div class="row">
      <div class="col-md-8 m-auto">
        <h1 class="display-4 text-center">Log In</h1>
        <p class="lead text-center">Sign in to your account</p>
        <form action="login.php" method="post">
          <div class="form-group">
            <input
              type="email"
              class="form-control form-control-lg"
              placeholder="Email Address"
              name="email"
            />
          </div>
          <div class="form-group">
            <input
              type="password"
              class="form-control form-control-lg"
              placeholder="Password"
              minlength="6" maxlength="20"
              name="password"
            />
          </div>
          <input type="submit" class="btn btn-info btn-block mt-4" />
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include "inc/footer.html";
?>
