<?php
ob_start();

$teacher_id= $_GET['id'];
$teacher_name = $_GET['name'];


session_start();

if(!$_SESSION[$teacher_name]){

	header('Location:/D_I_S/index.php');
}



?>
<?php



 

$servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";


$conn=mysqli_connect($servername,$username,$password,$db_name);


$sql="SELECT * FROM teachers_profile WHERE teacher_id='$teacher_id'";
$result= mysqli_query($conn,$sql);

//$result= mysqli_query($conn,$sql);
$row= $result->fetch_assoc();


  
//$row = mysql_fetch_assoc($result);

$db_handle=$row['handle'];
$db_designation=$row['designation'];
$db_bio=$row['bio'];
$db_linkedin=$row['linkedin'];


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

$sql=" UPDATE teachers_profile SET handle='$handle' ,designation='$designation', bio='$bio', linkedin='$linkedin' WHERE teacher_id=$teacher_id";

//UPDATE `teachers_profile` SET `teacher_id`=[value-1],`handle`=[value-2],`designation`=[value-3],`bio`=[value-4],`linkedin`=[value-5] WHERE 1

    $result= mysqli_query($conn,$sql);

    if($result){

      ?><div class="alert alert-success"><h3>Profile updated successfully.</h3></div> <?php
      }else{
        ?><div class="alert alert-danger"><h3>Error occurred while updating the profile, try again after some time.</h3></div> <?php
      }
  


}

?>

<?php
$servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";


$conn=mysqli_connect($servername,$username,$password,$db_name);


$sql="SELECT * FROM teachers_profile WHERE teacher_id='$teacher_id'";
$result= mysqli_query($conn,$sql);

//$result= mysqli_query($conn,$sql);
$row= $result->fetch_assoc();


  
//$row = mysql_fetch_assoc($result);

$db_handle=$row['handle'];
$db_designation=$row['designation'];
$db_bio=$row['bio'];
$db_linkedin=$row['linkedin'];


?>


<?php
include "../inc/header.html";
include "../inc/auth_navbar.php";

?>

    <!-- Edit Profile -->
    <div class="create-profile">
      <div class="container">
        <div class="row">
          <div class="col-md-8 m-auto">
          <a class="btn btn-info  " href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name?>">Go Back</a>
              
            <h1 class="display-4 text-center">Edit Your Profile</h1>
            <p class="lead text-center">
              Let's get some information to make your profile stand out
            </p>
            <small class="d-block pb-3">* = required field</small>
            <form action="edit_profile.php<?php echo "?id=".$teacher_id."&name=".$teacher_name ?>" method="post">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Profile handle"
                  name="handle"
                  value="<?php echo $db_handle?>"
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
                  value="<?php echo $db_designation?>"
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
                >
                <?php echo $db_bio?>
                </textarea>
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
                  value="<?php echo $db_linkedin?>"
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

   
