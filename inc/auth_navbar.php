<?php


if($_GET){
  $teacher_id= $_GET['id'];
$teacher_name = $_GET['name'];
}

$servername="localhost";
$username="u444291273_123a";
$password="arit@006";
$db_name="u444291273_dis";


$conn=mysqli_connect($servername,$username,$password,$db_name);
$sql="SELECT * FROM teachers WHERE id='$teacher_id'";
$result= mysqli_query($conn,$sql);

$row= $result->fetch_assoc();
$gravatar=$row['avatar'];


?>


<!-- Navbar -->
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name?>">Home</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#mobile-nav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mobile-nav">
        <ul class="navbar-nav mr-auto">
          
        </ul>

        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php<?php echo "?id=".$teacher_id."&name=".$teacher_name ?> ">
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <img
                class="rounded-circle"
                style="width: 25px;margin-right:5px"
                src="<?php echo $gravatar ?>"
                alt=""
                title="You must have a Gravatar connected to your email to display an image"
              />
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>
