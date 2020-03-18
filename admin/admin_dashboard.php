<?php
ob_start();

$admin_email=$_GET['admin_email'];

session_start();

if(!$_SESSION[$admin_email]){

	header('Location:/D_I_S/index.php');
}
?>
<?php
include "../inc/header.html";
include "../inc/admin_navbar.php";

?>


<!-- Dashboard -->
<div class="dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Dashboard for Admin</h1>
          <p class="lead text-muted">Welcome <?php  echo $admin_email?></p>
          <!-- Dashboard Actions -->
          <div >
            <a href="attendance_report.php<?php echo "?admin_email=".$admin_email ?>" class="btn btn-light btn-lg btn-block btn-outline-primary">
              <i class="fas fa-align-left  text-info mr-1"></i> Generate Attendance Report</a>
              
          </div>
          <br><br>
          <div >
            
          <a href="marks_report.php<?php echo "?admin_email=".$admin_email ?>" class="btn btn-light btn-lg btn-block btn-outline-primary">
              
              <i class="fas fa-align-left text-info mr-1"></i>


             Generate Marks Report</a>
          </div>
          <br><br>

          <div >
            
          <a href="add_student.php?admin_email=<?php echo $admin_email ?>" class="btn btn-light btn-lg btn-block btn-outline-primary">
              
              <i class="fas fa-users text-info mr-1"></i>


              Add Student</a>
          </div>
          <br><br>

          <div >
            
          <a href="add_subject.php<?php echo "?admin_email=".$admin_email ?>" class="btn btn-light btn-lg btn-block btn-outline-primary">
              
              <i class="fas fa-book text-info mr-1"></i>


              Add Subject</a>
          </div>
          <br><br>

          <div >
            
          <a href="validate_teacher.php<?php echo "?admin_email=".$admin_email ?>" class="btn btn-light btn-lg btn-block btn-outline-primary">
              
              <i class="fas  fa-check-square text-info mr-1"></i>


              Validate Teacher</a>
          </div>
          <br><br>

          <div >
            
          <a href="generate_TA_score.php<?php echo "?admin_email=".$admin_email ?>" class="btn btn-light btn-lg btn-block btn-outline-primary">
              
              <i class="fas fa-star text-info mr-1"></i>


              Generate TA score of a teacher</a>
          </div>





          

          
  

<?php
include "../inc/footer.html";
?>