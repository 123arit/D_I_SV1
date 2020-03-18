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


  $subject_title=$_POST['subject_title'];


  $conn2=mysqli_connect($servername,$username,$password,$db_name);
  $sql2="SELECT * FROM subjects WHERE title='$subject_title'";

  if(mysqli_num_rows(mysqli_query($conn2,$sql2))==0){
  

  $conn=mysqli_connect($servername,$username,$password,$db_name);

  $sql="INSERT INTO subjects (title,course,year,semester) VALUES ('$subject_title','','0000','0')";

    $result= mysqli_query($conn,$sql);
    
    if($result){

      ?><div class="alert alert-success"><h3>Subject added successfully to the database.</h3></div> <?php
      }else{
        ?><div class="alert alert-danger"><h3>Error occurred while adding subject, try again after some time.</h3></div> <?php
      }
      //this query is essential to make the marks store work
      
    }else{
      ?><div class="alert alert-danger"><h3>Subject already present in the database!</h3></div> <?php
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
            <h1 class="display-4 text-center">Add a New Subject</h1>
            <p class="lead text-center"></p>
            <small class="d-block pb-3"></small>
            <form action="add_subject.php<?php echo "?admin_email=".$admin_email ?>" method="post">
              <div class="form-group">
              <input
                  type="text"
                  class="form-control form-control-lg"
                  placeholder="* Enter The Subject Name Accurately."
                  name="subject_title"
                  required
                />
                
                <small class="form-text text-muted"
                  >Enter a new subject that will be taught from now onwards.</small
                >
             
              

              <input type="submit" class="btn btn-info btn-block mt-4" />
            </form>
          </div>
        </div>
      </div>
    </div>

<?php
include "../inc/footer.html";
?>