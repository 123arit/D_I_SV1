<?php
ob_start();



//$gravatar= $_GET['gravatar'];
$teacher_id= $_GET['id'];
$teacher_name = $_GET['name'];

session_start();

if(!$_SESSION[$teacher_name]){

	header('Location:/D_I_S/index.php');
}

$servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";


$conn=mysqli_connect($servername,$username,$password,$db_name);
$sql="SELECT * FROM teachers_profile WHERE teacher_id=$teacher_id";

$result= mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==0){

  header("Location:/D_I_S/teacher/create_profile.php?id=".$teacher_id."&name=".$teacher_name);

}

?>

<?php
$conn2=mysqli_connect($servername,$username,$password,$db_name);

$sql2="SELECT * FROM subject_teacher WHERE teacher_id=$teacher_id";

$result2= mysqli_query($conn2,$sql2);



?>


<?php
include "../inc/header.html";
include "../inc/auth_navbar.php";

?>



  <!-- Dashboard -->
  <div class="dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Dashboard</h1>
          <p class="lead text-muted">Welcome <?php  echo $teacher_name?></p>
          <!-- Dashboard Actions -->
          <div class="btn-group mb-4" role="group">
            <a href="edit_profile.php<?php echo "?id=".$teacher_id."&name=".$teacher_name ?>" class="btn btn-light">
              <i class="fas fa-user-circle text-info mr-1"></i> Edit Profile</a>
            
            <a href="add_subject.php<?php echo "?id=".$teacher_id."&name=".$teacher_name ?>" class="btn btn-light">
              
              <i class="fas fa-book text-info mr-1"></i>


              Add Subject</a>
          </div>

          <!-- Experience -->
          <div>
            <h4 class="mb-2">Subjects</h4>
            <table class="table">
              <thead>
                <tr>
                  <th>Subject</th>
                  <th>Semester</th>
                  <th>Course</th>
                  <th>Year</th>
                  <th />
                </tr>
              </thead>
              <tbody>

              <?php
                  
                  while($row= $result2->fetch_assoc()){
 
                    ?>
                <tr>
                 
                  <td><?php echo $row['subject_title']?></td>
                  <td><?php echo $row['semester']?></td>
                  <td>
                  <?php echo $row['course'] ?>
                  </td>
                  <td><?php echo $row['year'] ?></td>
                  <td>
                    <a class="btn btn-success" href="attendance.php<?php echo "?id=".$teacher_id."&name=".$teacher_name."&course=".$row['course']."&semester=".$row['semester']."&subject_title=".$row['subject_title']."&year=".$row['year'] ?>">
                      Attendance
                    </a>
                  </td>
                  <td>
                    <a class="btn btn-info" href="marks.php<?php echo "?id=".$teacher_id."&name=".$teacher_name."&course=".$row['course']."&semester=".$row['semester']."&subject_title=".$row['subject_title']."&year=".$row['year'] ?>">
                      Marks
                    </a>
                  </td>
                  <td>
                    <button class="btn btn-danger">
                      Delete Subject
                    </button>
                  </td>
                </tr>

                <?php
                    
                  }

                  ?>
                
              </tbody>
            </table>
          </div>

          
  

<?php
include "../inc/footer.html";
?>