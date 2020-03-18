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
<?php
include "../inc/header.html";
include "../inc/auth_navbar.php";
include 'lib/Student.php';


?>
<?php
if(isset($insertAttend)){

  echo $insertAttend;
}

?>

<!-- Date of prev attendances -->
<!-- attendance -->
<div class="dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Previous Attendances</h1>
          <p class="lead text-muted">Previous Attendances in '<?php echo $subject_title?>' course <?php echo $course?>    , <?php echo $semester?>th Sem.</p>
          <a class="btn btn-outline-info" href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name?>">Go Back</a>
          
          <div class="text-center alert alert-secondary" role="alert" style="font-size: 20px">
          
 			        <strong>Date:</strong> <?php   echo date("d-m-Y");  ?>
 		      </div>
         

          <!-- students list-->
          <div>
            <h4 class="mb-2"><?php echo $subject_title?></h4>
            <form action="" method="post">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Attendance Date</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>

              <?php
                $stu = new Student();
                $get_date = $stu->getDateList($course,$subject_title,$semester,$year);
                  if($get_date){
                    $i=0;
                      while($value= $get_date->fetch_assoc()){
                        $i++;
 				      ?>
                <tr>
                  <td><?php echo $i  ?></td>
                  <td><?php  echo $value['attendance_date']; ?></td>
                  <td>
                  <a class="btn btn-primary" href="view_update_attendance.php<?php echo "?id=".$teacher_id."&name=".$teacher_name."&course=".$course."&semester=".$semester."&subject_title=".$subject_title."&year=".$year."&attendance_date=".$value['attendance_date'] ?>"> View/Update</a> 
                  </td>
                  
                  
                 
                </tr>
                <?php 
 					        }
 				        }

 				        ?>
                
                
              </tbody>
            </table>
            
          </form>
          </div>








<?php
include "../inc/footer.html";
?>