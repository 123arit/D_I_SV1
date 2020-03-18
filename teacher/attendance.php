<?php
ob_start();



$teacher_id= $_GET['id'];
$teacher_name = $_GET['name'];
$course=$_GET['course'];
$semester=$_GET['semester'];
$subject_title=$_GET['subject_title'];
$year=$_GET['year'];

session_start();

if(!$_SESSION[$teacher_name]){

	header('Location:/D_I_S/index.php');
}
?>
<?php/*
$servername="localhost";
$username="root";
$password="";
$db_name="dis";

$conn= mysqli_connect($servername,$username,$password,$db_name);

//need to store the attendance and then update into the database

if($course=='BTech'){

  $sql="SELECT * FROM btech_students WHERE semester=$semester AND status='active'";
} 
if($course=='MTech'){
  $sql="SELECT * FROM mtech_students WHERE semester=$semester AND status='active' ";
}

if($course=='MSc'){
  $sql="SELECT * FROM msc_students WHERE semester=$semester AND status='active' ";
}


$result2= mysqli_query($conn,$sql);

*/?>


<?php
include "../inc/header.html";
include "../inc/auth_navbar.php";
include 'lib/Student.php';


?>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script type="text/javascript">
	
$(document).ready(function(){
 $("form").submit(function(){

var roll = true;
$(':radio').each(function(){

name = $(this).attr('name');

if(roll && !$(':radio[name="' + name +'"]:checked').length){


	$('.alert').show();	
	roll= false;	

}

});

	return roll;
 });


});


</script>
<?php
date_default_timezone_set("Asia/Kolkata");
?>


<?php

//error_reporting(0);

$stu = new Student();

$cur_date= date("Y-m-d");

if($_POST){

	$attendance= $_POST['attendance'];


	$insertAttend= $stu->insertAttendance($cur_date,$attendance,$subject_title,$semester,$year,$course);
}


if(isset($insertAttend)){

  echo $insertAttend;
}

?>

<div class='alert alert-danger' style="display: none"><strong>Error!</strong> Student Roll Missing.</div>



<!-- attendance -->
<div class="dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Attendance</h1>
          <p class="lead text-muted">Attendance for '<?php echo $subject_title?>' course <?php echo $course?>    , <?php echo $semester?>th Sem.</p>
          <div class="panel-heading">
          <h2>  
             <a class="btn btn-info " href="previous_attendance.php<?php echo "?id=".$teacher_id."&name=".$teacher_name."&course=".$course."&semester=".$semester."&subject_title=".$subject_title."&year=".$year ?>"> View All</a>

             <a class="btn btn-outline-info float-right" href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name?>">Go Back</a>
          </h2>
       		</div>
          <div class="text-center alert alert-secondary" role="alert" style="font-size: 20px">
 			        <strong>Date:</strong> <?php   echo date("d-m-Y");  ?>
 		      </div>
         

          <!-- students list-->
          <div>
            <h4 class="mb-2"><?php echo $subject_title?></h4>
            <form action="attendance.php<?php echo "?id=".$teacher_id."&name=".$teacher_name."&course=".$course."&semester=".$semester."&subject_title=".$subject_title."&year=".$year ?>" method="post">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Name</th>
                  <th>Roll</th>
                  <th>Attendance</th>
                  <th />
                </tr>
              </thead>
              <tbody>

              <?php

 			        	$get_student = $stu->getStudents($course,$semester);
 				        if($get_student){

 					      $i=0;
 					      while($value= $get_student->fetch_assoc()){
					    	$i++;

 				      ?>
                <tr>
                  <td><?php echo $i  ?></td>
                  <td><?php echo $value['name']?></td>
                  <td>
                  <?php echo $value['roll']?>
                  </td>
                  <td><input type="radio" name="attendance[<?php  echo $value['roll']; ?>]" value="present"> P
 						<input type="radio" name="attendance[<?php  echo $value['roll']; ?>]" value="absent"> A</td>
                  
                 
                </tr>
                <?php 
 					        }
 				        }

 				        ?>
                
                
              </tbody>
            </table>
            <input type="submit" class="btn btn-info btn-block mt-4" />
          </form>
          </div>
<?php
include "../inc/footer.html";
?>