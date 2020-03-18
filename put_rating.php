<?php
//ob_start();



if($_GET){

  $subject_title= $_GET['subject_title'];
  $semester= $_GET['semester'];

  $year= $_GET['year'];
  $course= $_GET['course'];
  $univ_roll= $_GET['univ_roll'];


  
}


?>


<?php
    $conn = new mysqli('localhost', 'u444291273_123a', 'arit@006', 'u444291273_dis');
    $conn2 = new mysqli('localhost', 'u444291273_123a', 'arit@006', 'u444291273_dis');

    if (isset($_POST['save'])) {

      $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;

      

      $result2=mysqli_query($conn2,"SELECT * FROM ratings WHERE subject_title='$subject_title' AND semester='$semester' AND year='$year' course='$course' AND univ_roll='$univ_roll'");

      if(mysqli_num_rows($result2) > 0){

        ?><div class="alert alert-danger"><h3>You have already rated the teacher based on the given subject.</h3></div> <?php
      }else{

        $result=mysqli_query($conn,"INSERT INTO ratings (subject_title,semester,year,course,univ_roll,rating) VALUES ('$subject_title','$semester','$year','$course','$univ_roll','$ratedIndex')");
      }
      
/* error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);


flush();
header("Location:https://www.cucseattendance.com/D_I_S/rating.php");
die('should have redirected by now');*/
      
      

      
       
    }

    
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
      integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="css/style.css" />
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rating System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<!-- Navbar -->
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="rating.php">Home</a>
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
          <li class="nav-item">
            <a class="nav-link" href="rating.php">Teachers </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="rating.php">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rating.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rating.php">Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>

<body>


<div class="col-md-8 m-auto">
<h1 class="display-4 text-center">Enter your Rating</h1>
            <a href="rating.php" class="btn btn-success">
              Go Back
            </a>
            <br><br>
 
    <div align="center" style="background: #000; padding: 50px;color:white;">
    
      
      
        <i class="fa fa-star fa-2x" data-index="0"></i>1
        <i class="fa fa-star fa-2x" data-index="1"></i>2

        <i class="fa fa-star fa-2x" data-index="2"></i>3

        <i class="fa fa-star fa-2x" data-index="3"></i>4

        <i class="fa fa-star fa-2x" data-index="4"></i>5
        <i class="fa fa-star fa-2x" data-index="5"></i>6
        <i class="fa fa-star fa-2x" data-index="6"></i>7
        <i class="fa fa-star fa-2x" data-index="7"></i>8
        <i class="fa fa-star fa-2x" data-index="8"></i>9
        <i class="fa fa-star fa-2x" data-index="9"></i>10











        <br><br>
        <?php// echo round($avg,2) ?>

        
  
     
    </div>
    <small class="d-block pb-3 text-center">A single click on the stars will store your response, then you can just click on the 'Go Back' button</small>
    </div>

    <!--<script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>-->
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <script>
        var ratedIndex = -1;// uID = 0;

        $(document).ready(function () {
            resetStarColors();

            if (localStorage.getItem('ratedIndex') != null) {
                setStars(parseInt(localStorage.getItem('ratedIndex')));
                //uID = localStorage.getItem('uID');
            }

            $('.fa-star').on('click', function () {
               ratedIndex = parseInt($(this).data('index'));
               localStorage.setItem('ratedIndex', ratedIndex);
               saveToTheDB();
            });

            $('.fa-star').mouseover(function () {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex);
            });

            $('.fa-star').mouseleave(function () {
                resetStarColors();

                if (ratedIndex != -1)
                    setStars(ratedIndex);
            });
        });

        function saveToTheDB() {
            $.ajax({
               url: "put_rating.php<?php echo "?subject_title=".$subject_title."&semester=".$semester."&year=".$year."&course=".$course."&univ_roll=".$univ_roll?>",
               method: "POST",
               dataType: 'json',
               data: {
                   save: 1,
                   //uID: uID,
                   
                   ratedIndex: ratedIndex
               }, success: function (r) {
                    //uID = r.id;
                    
               }
            });
        }

        function setStars(max) {
            for (var i=0; i <= max; i++)
                $('.fa-star:eq('+i+')').css('color', 'yellow');
        }

        function resetStarColors() {
            $('.fa-star').css('color', 'white');
        }
    </script>
</body>
</html>