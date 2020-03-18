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
$servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";

$conn= mysqli_connect($servername,$username,$password,$db_name);

//nothing effective is done inthis marks.php yet

if($course=='BTech'){

  $sql="SELECT * FROM marks_btech WHERE semester='$semester' AND year='$year' AND subject='$subject_title'";
} 
if($course=='MTech'){
  $sql="SELECT * FROM marks_mtech WHERE semester='$semester' AND course='$course' AND year='$year' AND subject='$subject_title' ";
}

if($course=='MSc'){
  $sql="SELECT * FROM marks_msc WHERE semester='$semester' AND course='$course' AND year='$year' AND subject='$subject_title' ";
}


$result2= mysqli_query($conn,$sql);

?>

<?php
if($_POST){

$mid_sem_marks= $_POST['mid_sem_marks'];
$end_sem_marks= $_POST['end_sem_marks'];




$servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";

$conn2= mysqli_connect($servername,$username,$password,$db_name);


//querying to the server
foreach ($mid_sem_marks as $atd_key => $atd_value) {
			

  

    $sql="UPDATE marks_btech SET mid_sem_marks='".$atd_value."' WHERE roll='".$atd_key."' AND semester='$semester' AND subject='$subject_title' AND year='$year' ";
    $result3=mysqli_query($conn2,$sql);
  
}

foreach ($end_sem_marks as $atd_key => $atd_value) {
			

  

  $sql="UPDATE marks_btech SET end_sem_marks='".$atd_value."' WHERE roll='".$atd_key."' AND semester='$semester' AND subject='$subject_title' AND year='$year' ";
  $result4=mysqli_query($conn2,$sql);

}



  if(($result3==true)&&($result4==true)){

    $msg="<div class='alert alert-success'><strong>Success.</strong> Marks updated successfully.</div>";
                
  }else{
  
    $msg="<div class='alert alert-danger'><strong>Error!</strong> Marks are not updated! Try again later.</div>";
  }

    
    



}



?>
<?php
$servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";

$conn= mysqli_connect($servername,$username,$password,$db_name);

//nothing effective is done inthis marks.php yet

if($course=='BTech'){

  $sql="SELECT * FROM marks_btech WHERE semester='$semester' AND year='$year' AND subject='$subject_title'";
} 
if($course=='MTech'){
  $sql="SELECT * FROM marks_mtech WHERE semester='$semester' AND course='$course' AND year='$year' AND subject='$subject_title' ";
}

if($course=='MSc'){
  $sql="SELECT * FROM marks_msc WHERE semester='$semester' AND course='$course' AND year='$year' AND subject='$subject_title' ";
}


$result2= mysqli_query($conn,$sql);

?>












<?php
include "../inc/header.html";
include "../inc/auth_navbar.php";



?>
<?php
//echo $msg ;
?>



<!-- Dashboard -->
<div class="dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Store Marks</h1>
          <p class="lead text-muted">Marks for '<?php echo $subject_title." "?>' course  <?php echo " ".$course." "?> <?php echo $semester?>th Sem <?php echo $year?>.</p>
         
          <div class="panel-heading">
          <h2>  
             
             <a class="btn btn-outline-info " href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name?>">Go Back</a>
          </h2>
       		</div>
          <!-- Experience -->
          <div>
            <h4 class="mb-2"><?php echo $subject_title." "?>- semester exam marks</h4>
            <form action="marks.php<?php echo "?id=".$teacher_id."&name=".$teacher_name."&course=".$course."&semester=".$semester."&subject_title=".$subject_title."&year=".$year ?>" method="post">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  
                  <th>Roll</th>
                  <th>Name</th>
                  <th>Univ. Roll</th>
                  <th>Mid Sem Marks</th>
                  <th>End Sem Marks</th>
                  <th />
                </tr>
              </thead>
              <tbody>
                <?php
                  $i=0;
                while($row=$result2->fetch_assoc()){
                  $i++;
                  ?>
              
                <tr>
                  <td><?php echo $i ?></td>
                  
                  <td><?php echo $row['roll']?></td>
                  <td><?php echo $row['name']?></td>
                  <td><?php echo $row['univ_roll']?></td>
                  <td><input
                  type="number"
                  
                  placeholder="Mid sem Marks"
                  name="mid_sem_marks[<?php  echo $row['roll']; ?>]"
                  value="<?php echo $row['mid_sem_marks']?>"
                  max="30"
                  min="0"
                 
                /></td>
                  <td><input
                  type="number"
                  class="form-control form-control-lg"
                  placeholder="End sem marks"
                  name="end_sem_marks[<?php  echo $row['roll']; ?>]"
                  value="<?php echo $row['end_sem_marks']?>"
                  max="70"
                  min="0"
                /></td>
                  
                 
                </tr>

                <?php
                }
                
                ?>
              
                
              </tbody>
            </table>
            <input type="submit" class="btn btn-info btn-block mt-4" />
          </form>
          </div>
<?php
include "../inc/footer.html";
?>