<?php
if($_GET){

//$subject_title=$_GET['subject_title'];
$course=$_GET['course'];
$semester=$_GET['semester'];
$year=$_GET['year'];




}

require('fpdf181/fpdf.php');
$con=mysqli_connect('localhost','u444291273_123a','arit@006');
$con1=mysqli_connect('localhost','u444291273_123a','arit@006');
$con2=mysqli_connect('localhost','u444291273_123a','arit@006');

mysqli_select_db($con,'u444291273_dis');
mysqli_select_db($con1,'u444291273_dis');
mysqli_select_db($con2,'u444291273_dis');


class PDF extends FPDF {
	function Header(){
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		$this->Image('logo-small.png',10,10,10);
		
		$this->Cell(100,10,'Students Attendance Report',0,1);
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(10);
		
		$this->SetFont('Arial','B',11);
		
		$this->SetFillColor(180,180,255);
    $this->SetDrawColor(180,180,255);
   
    $this->Cell(20,5,'Sl No.',1,0,'',true);
    $this->Cell(10,5,'Roll',1,0,'',true);
    $this->Cell(50,5,'Name',1,0,'',true);
    $this->Cell(50,5,'Attendance percentage',1,1,'',true);

		
   // $this->Cell(1,5,'',1,1,'',true);



		
	}
	function Footer(){
		//add table's bottom line
		$this->Cell(190,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
    $this->SetFont('Arial','',8);

    $this->SetFont('Arial','B',11);
		
		$this->SetFillColor(180,180,255);
    $this->SetDrawColor(180,180,255);
    
    $this->Cell(30,5,'Signature H.O.D',0,0,'',true);
    $this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
    $this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
    
    

	}
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();
$pdf->Ln();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(50,50,100);
if($course=='BTech'){
  
  $result1=mysqli_query($con1,"SELECT * FROM attendance_btech WHERE semester='$semester' AND year='$year' AND attendance NOT IN ('na')");

  $num_rows1=mysqli_num_rows($result1);//number of rows

  $result2=mysqli_query($con2,"SELECT * FROM btech_students WHERE semester='$semester' AND year='$year' AND status='active'");

  $num_rows2=mysqli_num_rows($result2);//no of students currently in the give sem and year

  $total_no_of_class=round(($num_rows1/ $num_rows2),0);// total no of classes occurred in that given sem and year 

  $result=mysqli_query($con,"SELECT * FROM btech_students WHERE semester='$semester' AND year='$year' AND status='active' ORDER BY roll");

}else if($course=='MTech'){

}else if($course=='MSc'){


}

$i=0;
while($data=$result->fetch_assoc()){
  $i++;

  $conn=mysqli_connect('localhost','u444291273_123a','arit@006');
  mysqli_select_db($conn,'u444291273_dis');
  $name=$data['name'];
  $roll=$data['roll'];
  $semester=$data['semester'];
  $year=$data['year'];
  $sql="SELECT * FROM attendance_btech WHERE semester='$semester' AND year='$year' AND roll='$roll' AND attendance='present'";
  $result_1=mysqli_query($conn,$sql);
  $num_of_days_present=mysqli_num_rows($result_1);
  $attendance_percentage=round(($num_of_days_present/$total_no_of_class),2)*100;


  $pdf->Cell(20,5,$i,1,0);
	$pdf->Cell(10,5,$data['roll'],1,0);
  $pdf->Cell(50,5,$data['name'],1,0);
  $pdf->Cell(50,5,$attendance_percentage."%",1,1);

  

} 

  $pdf->output();


?>




