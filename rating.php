<?php

?>

<?php
include "inc/header.html";
include "inc/rating_navbar.html";



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
  $semester=$_POST['semester'];
  $year=$_POST['year'];
  $name=$_POST['name'];
  $univ_roll=$_POST['univ_roll'];


  $conn2=mysqli_connect($servername,$username,$password,$db_name);
  $conn3=mysqli_connect($servername,$username,$password,$db_name);


  //you are not entitled to rate
  if($course=='BTech'){
  $sql2="SELECT * FROM marks_btech WHERE subject='$subject_title' AND name='$name' AND univ_roll='$univ_roll' AND semester='$semester' AND year='$year' AND mid_sem_marks NOT IN ('0') AND end_sem_marks NOT IN ('0') ";

  }else if($course=='MTech'){
    $sql2="SELECT * FROM marks_mtech WHERE subject='$subject_title' AND name='$name' AND univ_roll='$univ_roll' AND semester='$semester' AND year='$year' WHERE mid_sem_marks NOT IN ('0') AND end_sem_marks NOT IN ('0') ";
  }else if($course=='MSc'){
    $sql2="SELECT * FROM marks_msc WHERE subject='$subject_title' AND name='$name' AND univ_roll='$univ_roll' AND semester='$semester' AND year='$year' WHERE mid_sem_marks NOT IN ('0') AND end_sem_marks NOT IN ('0') ";
  }

  $sql3="SELECT * FROM ratings WHERE subject_title='$subject_title' AND univ_roll='$univ_roll' AND semester='$semester' AND year='$year' AND course='$course' ";

  
  $result2= mysqli_query($conn2,$sql2);
  $result3= mysqli_query($conn3,$sql3);


  if(mysqli_num_rows($result2) > 0){

    if(mysqli_num_rows($result3)>0){

      ?><div class="alert alert-danger"><h3>You can only rate the teacher once.</h3></div> <?php

    }else{
      header("Location:/D_I_S/put_rating.php?subject_title=".$subject_title."&semester=".$semester."&year=".$year."&course=".$course."&univ_roll=".$univ_roll);
    }
  }else{
    ?><div class="alert alert-danger"><h3>You are not entitled to rate the teacher based on this subject</h3></div> <?php
  }

  
  
}

?>

<!-- Add Subject -->
 <div class="add-subject">
      <div class="container">
        <div class="row">
          <div class="col-md-8 m-auto">
            
            <h1 class="display-4 text-center">Rating Teachers </h1>
            <p class="lead text-center"></p>
            <small class="d-block pb-3 text-center">based on the subjects taught.</small>
            <form action="rating.php" method="post">
            <div class="form-group">
                <select
                  class="form-control form-control-lg"
                  name="subject_title"
                >
                  <option value="0">* Select Subject Title</option>

                  <?php
                  
                  while(	$row= $result->fetch_assoc() ){

                    ?>
                    <option value="<?php echo $row['title']?>"><?php echo $row['title'] ?></option>
                    
                    <?php

                  }
                  
                  ?>
                  
                </select>
                
                <small class="form-text text-muted"
                  >Enter the subject that you want to rate.</small
                >
             
              <div class="form-group">
              <select
                  class="form-control form-control-lg"
                  name="course"
                >
                 <option value="0">* Select Course</option>
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
                  pattern="[3-9]{1}"
                  title="Semester must have a value between 3 and 8"
                  required
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Year (eg 2019,2020 etc.)"
                  name="year"
                  pattern="[2-5]{1}[0-9]{3}"
                  title="Enter a vaid (resonable) year"
                  required
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Enter Your Name"
                  name="name"
                  minlength="3" maxlength="30"
                  required
                />
              </div>
              <div class="form-group">
                <input
                  type="string"
                  class="form-control form-control-lg"
                  placeholder="* University Roll Number (eg. T91/CSE/111190)"
                  name="univ_roll"
                  minlength="10" maxlength="20"
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
include "inc/footer.html";
?>