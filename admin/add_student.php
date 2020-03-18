<?php
ob_start();

if($_GET){

$admin_email= $_GET['admin_email'];

}
session_start();

if(!$_SESSION[$admin_email]){

	header('Location:/D_I_S/index.php');
}

?>

<?php

if($_POST){
  $course=$_POST['course'];
  $semester=$_POST['semester'];
  $year=$_POST['year'];
  $name=$_POST['name'];
  $roll=$_POST['roll'];
  $univ_roll=$_POST['univ_roll'];
  $regn_no=$_POST['regn_no'];
  $status=$_POST['status'];

//echo $course." ".$semester." ".$year." ".$name." ".$roll." ".$univ_roll." ".$regn_no." ".$status ;




  $servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";

  $conn= mysqli_connect($servername,$username,$password,$db_name);



  if($course=='BTech'){
    $sql="SELECT * FROM btech_students WHERE semester='$semester' AND year='$year' AND univ_Roll='$univ_roll' AND regn_no='$regn_no' AND status='$status'";
    
    $result= mysqli_query($conn,$sql);
    $row=mysqli_num_rows($result);
    if($row > 0){

      ?><div class="alert alert-danger"><h3>Details of this particular student is already present in the database.</h3></div> <?php
    
    }else{
      $conn2= mysqli_connect($servername,$username,$password,$db_name);
      //$sql="INSERT INTO subject_teacher (teacher_id,subject_title,course,year,semester) VALUES ('$teacher_id','$subject_title','$course','$year','$semester')";

     $sql2="INSERT INTO btech_students (name,roll,semester,year,univ_roll,regn_no,status) VALUES('$name','$roll','$semester','$year','$univ_roll','$regn_no','$status')";

     $result2= mysqli_query($conn2,$sql2);

     if($result2){

	    ?><div class="alert alert-success"><h3>Student added successfully.</h3></div> <?php
	   }else{
		  ?><div class="alert alert-danger"><h3>Error occurred while adding student, try again after some time.</h3></div> <?php
	   }
   }
  }
  //header("Location:/D_I_S/teacher/dashboard.php?name=".$teacher_name."&gravatar=".$gravatar."&id=".$teachers_id);


}
?>


<?php
include "../inc/header.html";
include "../inc/admin_navbar.php";

?>

 <!-- Create Profile -->
 <div class="create-profile">
      <div class="container">
        <div class="row">
          <div class="col-md-8 m-auto">
            <a href="admin_dashboard.php?admin_email=<?php echo $admin_email?>" class="btn btn-light">
              Go Back
            </a>
            <h1 class="display-4 text-center">Add Student</h1>
            <p class="lead text-center">
              Add student's information into the database
            </p>
            <small class="d-block pb-3">* = required field</small>
            <form action="add_student.php<?php echo "?admin_email=".$admin_email?>" method="post">
              <div class="form-group">
              <select
                  class="form-control form-control-lg"
                  name="course"
                  required
                >
                 <option value="">* Select Course</option>
                  <option value="BTech">B.Tech</option>
                  <option value="MTech">M.Tech</option>
                  <option value="MSc">MSc</option>

                </select>
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Semester (eg 3,4 etc.)"
                  name="semester"
                  pattern="[3-8]{1}"
                  title="Enter a semester between 3 and 8."
                  required
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Year (eg 2019,2020 etc.)"
                  name="year"
                  pattern="[2-4]{1}[0-9]{3}"
                  title="Please enter a valid year."
                  required
                />
              </div>

              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Name of the Student"
                  name="name"
                  minlength="3" maxlngth="30"
                  pattern="[a-zA-Z\s]+"
              title="Enter a valid name of atleast 3 characters"
                  required
                />
                
              </div>
              <div class="form-group">
                <input
                  type="number"
                  class="form-control form-control-lg"
                  placeholder="* Class Roll of the Student"
                  name="roll"
                  min="1" max="200"
                  required
                />
                
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* University Roll"
                  maxlength="20"
                  name="univ_roll"
                  required
                />
                
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Registration Number"
                  name="regn_no"
                  maxlength="20"
                  required
                />
                
              </div>
              <div class="form-group">
              <select
                  class="form-control form-control-lg"
                  name="status"
                  required
                >
                 <option value="">* Select Status</option>
                  <option value="active">Active</option>
                  <option value="passive">Passive</option>
                  

                </select>
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