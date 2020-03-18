<?php
include "inc/header.html";
include "inc/unauth_navbar.html";

$teacher_id=$_GET['teacher_id'];
?>
<?php

$servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";


$conn1=mysqli_connect($servername,$username,$password,$db_name);
$conn2=mysqli_connect($servername,$username,$password,$db_name);
$conn3=mysqli_connect($servername,$username,$password,$db_name);


$sql1="SELECT * FROM teachers WHERE id='$teacher_id'";
$sql2="SELECT * FROM teachers_profile WHERE teacher_id='$teacher_id'";
$sql3="SELECT * FROM subject_teacher WHERE teacher_id='$teacher_id'";


$result1= mysqli_query($conn1,$sql1);
$result2= mysqli_query($conn2,$sql2);
$result3= mysqli_query($conn3,$sql3);

$row1=$result1->fetch_assoc();
$row2=$result2->fetch_assoc();
//$row3=$result3->fetch_assoc();


?>

<!-- Profile -->
<div class="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-6">
              <a href="profiles.php" class="btn btn-light mb-3 float-left">Back To Profiles</a>
            </div>
            <div class="col-6">

            </div>
          </div>



          <!-- Profile Header -->
          <div class="row">
            <div class="col-md-12">
              <div class="card card-body bg-info text-white mb-3">
                <div class="row">
                  <div class="col-4 col-md-3 m-auto">
                    <img class="rounded-circle" src="<?php echo $row1['avatar']?>" alt="" />
                  </div>
                </div>
                <div class="text-center">
                  <h1 class="display-4 text-center"><?php echo $row1['name']?></h1>
                  <p class="lead text-center"><?php echo $row2['designation']?></p>
                  <p></p>
                  <p>
                    <a class="text-white p-2" href="#">
                      <i class="fas fa-globe fa-2x"></i>
                    </a>
                    
                    <a class="text-white p-2" href="<?php echo $row2['linkedin']?>">
                      <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                   
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Profile About -->
          <div class="row">
            <div class="col-md-12">
              <div class="card card-body bg-light mb-3 text-center">
                <h3 class="text-center text-info"><?php echo $row1['name']?>'s Bio</h3>
                <p class="lead"><?php echo $row2['bio']?></p>
                <hr />
                
              </div>
            </div>
          </div>

          <!-- Profile Creds -->
          <div class="row">
            
            <div class="col-md-12">
              <h3 class="text-center text-info">Subjects</h3>
              <ul class="list-group">
                <?php
                while($row3=$result3->fetch_assoc()){

                  ?>
                <li class="list-group-item">
                  <h4><?php echo $row3['subject_title']?></h4>
                  <a class="btn btn-outline-success float-right" href="" role="button">Know More</a>
                  
                  <p>
                    <strong>Semester: </strong><?php echo $row3['semester']?></p>
                  <p>
                    <strong>Course: </strong><?php echo $row3['course']?></p>
                  <p>
                    <strong>Year: </strong><?php echo $row3['year']?></p>  
                  <p>
                    
                </li>

                <?php
                }
                ?>
                
              </ul>
            </div>
          </div>

          
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <?php
  include "inc/footer.html";
  ?>