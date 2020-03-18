<?php
ob_start();



$teacher_id= $_GET['id'];
$teacher_name = $_GET['name'];
$course=$_GET['course'];
$semester=$_GET['semester'];
$subject_title=$_GET['subject_title'];
$year=$_GET['year'];
$attendance_date=$_GET['attendance_date'];

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




if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$attendance= $_POST['attendance'];


	$att_update= $stu->updateAttendance($attendance,$course,$subject_title,$semester,$year,$attendance_date);
}

?>

<?php
if(isset($att_update)){

  echo $att_update;
}

?>

<div class='alert alert-danger' style="display: none"><strong>Error!</strong> Student Roll Missing.</div>





<!--Update/View attendance -->
<div class="dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Update Attendance</h1>
          <p class="lead text-muted">Update Attendance for '<?php echo $subject_title?>' course <?php echo $course?>    , <?php echo $semester?>th Sem.</p>
          <div class="panel-heading">
          <h2>  
             <a class="btn btn-info " href="previous_attendance.php<?php echo "?id=".$teacher_id."&name=".$teacher_name."&course=".$course."&semester=".$semester."&subject_title=".$subject_title."&year=".$year ?>"> View All</a>

             <a class="btn btn-outline-info float-right" href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name?>">Go Back</a>
          </h2>
       		</div>
          <div class="text-center alert alert-secondary" role="alert" style="font-size: 20px">
 			        <strong>Date:</strong> <?php   echo $attendance_date;  ?>
 		      </div>
         

          <!-- students list-->
          <div>
            <h4 class="mb-2"><?php echo $subject_title?></h4>
            <form action="view_update_attendance.php<?php echo "?id=".$teacher_id."&name=".$teacher_name."&course=".$course."&semester=".$semester."&subject_title=".$subject_title."&year=".$year."&attendance_date=".$attendance_date ?>" method="post">
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
 				        $get_student = $stu->getAllData($course,$subject_title,$semester,$year,$attendance_date);
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
                  <td><input type="radio" name="attendance[<?php  echo $value['roll']; ?>]" value="present"<?php  
 					if($value['attendance'] == "present"){ echo "checked"; }   ?>> P 
 						<input type="radio" name="attendance[<?php  echo $value['roll']; ?>]" value="absent"<?php  
 					if($value['attendance'] == "absent"){ echo "checked"; }   ?>> A</td>
                  
                 
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