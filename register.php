<?php
include "inc/header.html";
include "inc/unauth_navbar.html";
?>

<?php

if($_POST){
$name=$_POST['name'];
$email=$_POST['email'];
$password1=$_POST['password1'];
$password2=$_POST['password2'];
$phone=$_POST["phone"];

//gravatar

$default = "http://chittagongit.com/images/default-profile-icon/default-profile-icon-24.jpg";
$size = 200;

$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;


$servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";

$conn= mysqli_connect($servername,$username,$password,$db_name);


if(empty($name)|| empty($email) || empty($password1) || empty($password2) ){ 

	?><div class="alert alert-danger"><h3>None of the fields should be empty!</h3></div> <?php


}else{


	if($password1 == $password2){ 

    $options = [
      'cost' => 11
    ];

    $hashed_password= password_hash($password1, PASSWORD_DEFAULT,$options);

	$sql="INSERT INTO teachers (name,email,password,avatar,phone,status) VALUES ('$name','$email','$hashed_password','$grav_url','$phone','passive')";

    $result= mysqli_query($conn,$sql);

    if($result){

	?><div class="alert alert-success"><h3>Teacher Is Successfully Registered into the system.</h3></div> <?php
	}else{
		?><div class="alert alert-danger"><h3>Teacher Is Not Successfully Registered into the system.</h3></div> <?php
	}

    }else{

    ?><div class="alert alert-danger"><h3>The Passwords Entered Are Not The Same!</h3></div> <?php	
    }


	
}
}
?>




<!-- Register -->
<div class="register">
  <div class="container">
    <div class="row">
      <div class="col-md-8 m-auto">
        <h1 class="display-4 text-center">Sign Up</h1>
        <p class="lead text-center">Create your account</p>
        <form action="register.php" method="post">
          <div class="form-group">
            <input
              type="text"
              class="form-control form-control-lg"
              placeholder="Name"
              name="name"
              minlength="3" maxlength="30"
              pattern="[a-zA-Z\s]+"
              title="Enter a valid name of atleast 3 characters"
              required
            />
          </div>
          <div class="form-group">
            <input
              type="text"
              class="form-control form-control-lg"
              placeholder="Email Address"
              name="email"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              title="Enter a Valid Email ID"
              required
            />
            <small className="form-text text-muted"
              >This site uses Gravatar so if you want a profile image, use a
              Gravatar email</small
            >
          </div>
          <div class="form-group">
            <input
              type="password"
              class="form-control form-control-lg"
              placeholder="Password"
              name="password1"
              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters"
              
              required
            />
          </div>
          <div class="form-group">
            <input
              type="password"
              class="form-control form-control-lg"
              placeholder="Confirm Password"
              name="password2"
              minlength="6" maxlength="20"

              required
            />
          </div>
          <div class="form-group">
            <input
              type="text"
              class="form-control form-control-lg"
              placeholder="Mobile Phone Number"
              name="phone"
               pattern="[5-9]{1}[0-9]{9}" 
              title="Phone number start with 5,6,7,8 or 9 and should contain total of 10 digits"
               required
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