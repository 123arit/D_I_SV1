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
include "../inc/header.html";
include "../inc/admin_navbar.php";



?>

<?php

$servername="localhost";
$username="root";
$password="";
$db_name="dis";


$conn=mysqli_connect($servername,$username,$password,$db_name);

$sql="SELECT * FROM subjects ";

$result= mysqli_query($conn,$sql);


?>

<?php

if($_POST){

  $subject_title=$_POST['subject_title'];
  $course=$_POST['course'];
  $year=$_POST['year'];
  $semester=$_POST['semester'];



  $servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";

  $conn2=mysqli_connect($servername,$username,$password,$db_name);


  $sql1="SELECT * FROM ratings WHERE subject_title='$subject_title' AND semester='$semester' AND year='$year' AND course='$course' ";

  $result=mysqli_query($conn2,$sql1);

  $i=0; 
  $total_rating=0;
  $TA_sum=0;

    while($row= $result->fetch_assoc()){
      $i++;
      $r=$row['rating']; // ith rating, i.e Ri
      $univ_roll=$row['univ_roll'];
      $total_rating=$total_rating + $r;

      if($course=='BTech'){
      $sql_marks="SELECT * FROM marks_btech WHERE subject='$subject_title' AND semester='$semester' AND year='$year' AND univ_roll='$univ_roll' ";
      $conn_marks=mysqli_connect($servername,$username,$password,$db_name);
      $result_marks=mysqli_query($conn_marks,$sql_marks);

      $row_marks=$result_marks->fetch_assoc();
      $total_marks= $row_marks['mid_sem_marks']+$row_marks['end_sem_marks'];// ith marks
      $marks_ratio=round(($total_marks/100),2); // ith value of M..i.e Mi
      $class_roll=$row_marks['roll'];// getting class roll ,to use it as a key to get the attendance records


      $sql_attendance1="SELECT * FROM attendance_btech WHERE semester='$semester' AND year='$year' AND roll='$class_roll' AND subject='$subject_title' AND attendance NOT IN ('na') ";
      $conn_attendance1=mysqli_connect($servername,$username,$password,$db_name);
      
      $result_attendance1=mysqli_query($conn_attendance1,$sql_attendance1);
      $num_rows1=mysqli_num_rows($result_attendance1);//total no of classes

      
      $sql_attendance2="SELECT * FROM attendance_btech WHERE semester='$semester' AND year='$year' AND subject='$subject_title' AND roll='$class_roll' AND attendance='present'";

      $conn_attendance2=mysqli_connect($servername,$username,$password,$db_name);

      $result_attendance2=mysqli_query($conn_attendance2,$sql_attendance2);

      $num_rows2=mysqli_num_rows($result_attendance2);//total no of classes present

      $attendance_ratio=round(($num_rows2/$num_rows1),2);//ith attendance ratio, i.e Ai

      $TA_sum=$TA_sum + round($r*((2*$attendance_ratio)+$marks_ratio),2);

      }


    }

    $avg_rating=round(($total_rating/$i),2);
    $TA_score=round(($TA_sum/$total_rating),2);

    
    if($result){
      ?> <div class="alert alert-success"><h3>Average rating is <?php echo $avg_rating?></h3>
      <small class="d-block pb-3">out of 10</small>
      </div><br><div class="alert alert-success"><h3>TA Score is <?php echo $TA_score?></h3>
      <small class="d-block pb-3">Maximum Possible value is 3</small>
      <small class="d-block pb-3">Refer to the software documentation for more details.</small>
			</div><br><?php
    }else{
      ?> <div class="alert alert-danger"><h3>Rating could not be generated, try again later.</h3>
			</div><?php
    }
}

?>

<?php

$servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";


$conn=mysqli_connect($servername,$username,$password,$db_name);

$sql="SELECT * FROM subjects ";

$result= mysqli_query($conn,$sql);


?>



 <!-- Add Subject -->
 <div class="add-subject">
      <div class="container">
        <div class="row">
          <div class="col-md-8 m-auto">
            <a href="admin_dashboard.php?admin_email=<?php echo $admin_email?>" class="btn btn-light" class="btn btn-light">
              Go Back
            </a>
            <h1 class="display-4 text-center">Generate TA* Score</h1>
            <p class="lead text-center"></p>
            <small class="d-block pb-3 text-center">TA Score: Teaching Ability Score</small>
            <small class="d-block pb-3 text-center">(TA Score can only be generated after the respective teacher has submitted his marks) </small>

            <form action="generate_TA_score.php<?php echo "?admin_email=".$admin_email ?>" method="post">
              <div class="form-group">
                <select
                  class="form-control form-control-lg"
                  name="subject_title"
                  required
                >
                  <option value="">* Select Subject Title</option>

                  <?php
                  
                  while(	$row= $result->fetch_assoc() ){

                    ?>
                    <option value="<?php echo $row['title']?>"><?php echo $row['title'] ?></option>
                    
                    <?php

                  }
                  
                  ?>
                  
                </select>
                </div> 
                
             
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

              <input type="submit" class="btn btn-info btn-block mt-4" />
            </form>
          </div>
        </div>
      </div>
    </div>

<?php
include "../inc/footer.html";
?>