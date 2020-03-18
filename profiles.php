<?php

include 'inc/header.html';
include "inc/unauth_navbar.html";
?>

<?php

$servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";


$conn=mysqli_connect($servername,$username,$password,$db_name);

$sql="SELECT * FROM teachers WHERE status='active' ORDER BY id DESC";

$result= mysqli_query($conn,$sql);


?>


<!-- Profiles -->
<div class="profiles">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="display-4 text-center">Teacher Profiles</h1>
            <p class="lead text-center">Browse and connect with</p>

            <?php

             $servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";

              $conn2=mysqli_connect($servername,$username,$password,$db_name);


            while($row=$result->fetch_assoc()){
              
              $teacher_id=$row['id'];
              $sql2="SELECT * FROM teachers_profile WHERE teacher_id='$teacher_id'";
              $result2=mysqli_query($conn2,$sql2);

                while($row2=$result2->fetch_assoc()){

                  if($row['id']==$row2['teacher_id']){

                
                
            
            
            ?>

            <!-- Profile Item -->
            <div class="card card-body bg-light mb-3">
              <div class="row">
                <div class="col-2">
                  <img
                    class="rounded-circle"
                    src="<?php echo $row['avatar']?>"
                    alt=""
                  />
                </div>
                <div class="col-lg-6 col-md-4 col-8">
                  <h3><?php echo $row['name'] ?></h3>
                  <p><?php echo $row2['designation'] ?></p>
                  <p>University of Calcutta</p>
                  <a href="view_profile.php?teacher_id=<?php echo $teacher_id?>" class="btn btn-info">View Profile</a>
                </div>
              </div>
            </div>

            <?php
                      }
                  }
            }
            ?>

            
            </div>
          </div>
        </div>
      </div>
    </div>



<?php 
include "inc/footer.html"
?>