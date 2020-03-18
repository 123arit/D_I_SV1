<?php
ob_start();

if($_GET){

//$gravatar= $_GET['gravatar'];
$teacher_id= $_GET['id'];
$teacher_name = $_GET['name'];

//echo $teachers_id;
}
session_start();

if(!$_SESSION[$teacher_name]){

	header('Location:/D_I_S/index.php');
}

?>

<?php

if($_POST){
$handle=$_POST['handle'];
$designation=$_POST['designation'];
$bio=$_POST['bio'];
$linkedin=$_POST['linkedin'];



$servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";
$conn= mysqli_connect($servername,$username,$password,$db_name);


//$sql="INSERT INTO teachers_profile (`teacher_id',`handle`,`designation`,`bio`,`linkedin`) VALUES ('$teacher_id','$handle','$designation','$bio','$linkedin') ";

$sql="INSERT INTO teachers_profile (teacher_id,handle,designation,bio,linkedin) VALUES ('$teacher_id','$handle','$designation','$bio','$linkedin')";

    $result= mysqli_query($conn,$sql);

    if($result){

	?><div class="alert alert-success"><h3>Profile created successfully.</h3></div> <?php
	}else{
		?><div class="alert alert-danger"><h3>Error occurred while creating the profile, try again after some time.</h3></div> <?php
	}

  header("Location:https://www.cucseattendance.com/D_I_S/teacher/dashboard.php?id=".$teacher_id."&name=".$teacher_name);


}
?>


<?php
include "../inc/header.html";
include "../inc/auth_navbar.php";

?>

 <!-- Create Profile -->
 <div class="create-profile">
      <div class="container">
        <div class="row">
          <div class="col-md-8 m-auto">
            <a href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name?>" class="btn btn-light">
              Go Back
            </a>
            <h1 class="display-4 text-center">Create Your Profile</h1>
            <p class="lead text-center">
              Let's get some information to make your profile stand out
            </p>
            <small class="d-block pb-3">* = required field</small>
            <form action="create_profile.php<?php echo "?id=".$teacher_id."&name=".$teacher_name ?>" method="post">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Profile handle"
                  name="handle"
                  required
                />
                <small class="form-text text-muted"
                  >A unique handle for your profile URL. Your full name, company
                  name, nickname, etc (This CAN'T be changed later)</small
                >
              </div>

              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="Designation (eg: Assistant Professor, Associate Professor etc )"
                  name="designation"
                  maxlength="30"
                />
                <small class="form-text text-muted"
                  >Your Designation or the role you play in this
                  Institute</small
                >
              </div>
              <div class="form-group">
                <textarea
                  class="form-control form-control-lg"
                  placeholder="A short bio of yourself"
                  name="bio"
                ></textarea>
                <small class="form-text text-muted"
                  >Tell us a little about yourself</small
                >
              </div>
              <div class="mb-3">
                <button type="button" class="btn btn-light">
                  Add Social Network Links
                </button>
                <span class="text-muted">Optional</span>
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fab fa-linkedin"></i>
                  </span>
                </div>
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="Linkedin Profile URL"
                  name="linkedin"
                  url
                />
              </div>
              <input type="submit" class="btn btn-info btn-block mt-4" />
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
    include "../inc/footer.html";
    ?>