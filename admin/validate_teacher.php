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










<!-- attendance -->
<div class="dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Validate Teacher</h1>
          <p class="lead text-muted">Validate registered teachers and allow them to create their profile, add subjects, take attendance, store marks etc.</p>
          <div class="panel-heading">
          <h2>  
             
             <a class="btn btn-outline-info " href="admin_dashboard.php?admin_email=<?php echo $admin_email?>" class="btn btn-light">Go Back</a>
          </h2>
       		</div>
          
         

          <!-- registered teachers list-->
          <div>
            
            
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              <?php

                $servername="localhost";
  $username="u444291273_123a";
  $password="arit@006";
  $db_name="u444291273_dis";

                $conn= mysqli_connect($servername,$username,$password,$db_name);

                $sql="SELECT * FROM teachers ORDER BY id DESC";
 			        	
                $result=mysqli_query($conn,$sql);
 					      $i=0;
 					      while($row= $result->fetch_assoc()){
					    	$i++;

 				      ?>
                <tr>
                  <td><?php echo $i  ?></td>
                  <td><?php echo $row['name']?></td>
                  <td><?php echo $row['email']?></td>
                  <td><?php echo $row['phone']?></td>

                  <td><?php echo $row['status']?></td>
                  <td> <a class="btn btn-primary" href="change_teacher_status.php?status=<?php  echo $row['status']; ?>&teacher_id=<?php echo $row['id'] ;?>&admin_email=<?php echo $admin_email ;?>"> Change Status </a> </td>

                  
                  
                 
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