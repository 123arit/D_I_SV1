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
include "../inc/header.html";
include "../inc/auth_navbar.php";



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

<?php

if($_POST){


  $subject_title=$_POST['subject_title'];
  $course=$_POST['course'];
  $year=$_POST['year'];
  $semester=$_POST['semester'];

  $conn=mysqli_connect($servername,$username,$password,$db_name);

  $sql="INSERT INTO subject_teacher (teacher_id,subject_title,course,year,semester) VALUES ('$teacher_id','$subject_title','$course','$year','$semester')";

    $result= mysqli_query($conn,$sql);
    // this query is required to make the attendance date view work
    $sql2="INSERT INTO attendance_btech (roll,semester,year,attendance,attendance_date,subject) VALUES ('0','$semester','$year','na','0000-00-00','$subject_title')";
    $result2= mysqli_query($conn,$sql2);
    //
    if($result){

      ?><div class="alert alert-success"><h3>Subject added successfully to the profile.</h3></div> <?php
      }else{
        ?><div class="alert alert-danger"><h3>Error occurred while adding subject, try again after some time.</h3></div> <?php
      }
      //this query is essential to make the marks store work
      if($course=='BTech'){
      $sql3="SELECT * from marks_btech WHERE semester='$semester' AND year='$year' AND subject='$subject_title'";

      $result3=mysqli_query($conn,$sql3);

      $conn2=mysqli_connect($servername,$username,$password,$db_name);
      if(mysqli_num_rows($result3)==0){

        //initialize the space for marks corresponding to each n every student of that sem and year learning that subject.....in the marks table

        $sql_btech="SELECT * FROM btech_students WHERE semester='$semester' AND year='$year'";
          $result_btech=mysqli_query($conn,$sql_btech);

          while($row=$result_btech->fetch_assoc()){

            $db_roll=$row['roll'];
            $db_name=$row['name'];
            $db_univ_roll=$row['univ_roll'];

            $sql_insert= " INSERT INTO marks_btech (roll,name,univ_roll,semester,year,subject) VALUES ('$db_roll','$db_name','$db_univ_roll','$semester','$year','$subject_title') ";

            mysqli_query($conn2,$sql_insert);

          }
      
      }




      }else if ($course=='MTech'){

        $sql3="SELECT * from marks_mtech WHERE semester='$semester' AND year='$year' AND subject='$subject_title'";

        $result3=mysqli_connect($sql3,$conn);
        if(mysqli_num_rows($result3)==0){

          //initialize the space for marks corresponding to each n every student of that sem and year learning that subject.....in the marks table

          


          
        
        }

      }else if ($course=='MSc'){

        $sql3="SELECT * from marks_msc WHERE semester='$semester' AND year='$year' AND subject='$subject_title'";

        $result3=mysqli_connect($sql3,$conn);
        if(mysqli_num_rows($result3)==0){

          //initialize the space for marks corresponding to each n every student of that sem and year learning that subject.....in the marks table
        
        }

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
            <a href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name?>" class="btn btn-light">
              Go Back
            </a>
            <h1 class="display-4 text-center">Add a New Subject</h1>
            <p class="lead text-center"></p>
            <small class="d-block pb-3">* = required field</small>
            <form action="add_subject.php<?php echo "?id=".$teacher_id."&name=".$teacher_name ?>" method="post">
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
                
                <small class="form-text text-muted"
                  >Enter the subject that you are about to teach.</small
                >
             
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
                  type="string"
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