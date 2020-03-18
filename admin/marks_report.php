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
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";

$conn=mysqli_connect($servername,$username,$password,$db_name);

$sql="SELECT * FROM subjects ";

$result= mysqli_query($conn,$sql);


?>


<?php

if($_POST){

  
  
}

?>

<!-- Add Subject -->
 <div class="add-subject">
      <div class="container">
        <div class="row">
          <div class="col-md-8 m-auto">
            <a href="admin_dashboard.php?admin_email=<?php echo $admin_email?>" class="btn btn-light">
              Go Back
            </a>
            <h1 class="display-4 text-center">Generate Marksheet</h1>
            <p class="lead text-center"></p>
            <small class="d-block pb-3">* = required field</small>
            <form action="marks_pdf.php" method="get">
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
                  >Enter the subject for which the report needs to be generated.</small
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