<?php

$filepath=realpath(dirname(__FILE__));
include_once($filepath.'/Database.php');
?>




<?php


Class Student{

	private $db;

	public function __construct(){

		$this->db= new Database();

	}


	public function getStudents($course,$semester){

		if($course=='BTech'){
		$sql= "SELECT * FROM btech_students WHERE semester='$semester' AND status='active'";
		$result= $this->db->select($sql);
		}else if($course=='MTech'){
			$sql= "SELECT * FROM mtech_students WHERE semester='$semester' AND status='active'";
			$result= $this->db->select($sql);
		}else if($course=='MSc'){
				$sql= "SELECT * FROM msc_students WHERE semester='$semester' AND status='active'";
				$result= $this->db->select($sql);
		}
		return $result;
	}

	public function insertStudent($name,$roll){

		$name= mysqli_real_escape_string($this->db->link, $name); //this function prevents entering symbols such as '@','#' etc
				$roll= mysqli_real_escape_string($this->db->link, $roll);

				if(empty($name) || empty($roll)){
					$msg = "<div class='alert alert-danger'> <strong>Error!</strong> None of the fiels should be empty </div>";
					 

					
				}else{

					$sql="INSERT INTO btech_2 (name,roll) VALUES('$name','$roll')";
					$stu_insert=$this->db->insert($sql);

					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','BS')";
					$stu_insert=$this->db->insert($sql_attendance);
					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','KND')";
					$stu_insert=$this->db->insert($sql_attendance);
					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','NC')";
					$stu_insert=$this->db->insert($sql_attendance);
					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','PB')";
					$stu_insert=$this->db->insert($sql_attendance);
					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','RD')";
					$stu_insert=$this->db->insert($sql_attendance);
					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','RKP')";
					$stu_insert=$this->db->insert($sql_attendance);
					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','SC')";
					$stu_insert=$this->db->insert($sql_attendance);
					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','SK')";
					$stu_insert=$this->db->insert($sql_attendance);
					$sql_attendance="INSERT INTO attendance_btech_2 (roll,taken_by) VALUES ('$roll','SKS')";
					$stu_insert=$this->db->insert($sql_attendance);



					if($stu_insert){

						$msg="<div class='alert alert-success'><strong>Success.</strong> Student data inserted successfully.</div>";
						
					}else{
						$msg="<div class='alert alert-danger'><strong>Error!</strong> Student data not inserted successfully.</div>";
					}

				}
				return $msg;

				

	}


	public function insertAttendance($cur_date, $attendance = array(),$subject_title,$semester,$year,$course){


		$sql="SELECT DISTINCT attendance_date FROM attendance_btech WHERE subject='$subject_title' AND semester='$semester' AND year='$year'";

		$getdata= $this->db->select($sql);

		while($row= $getdata->fetch_assoc()){


			$db_date= $row['attendance_date'];
			//$teacher=$result['taken_by'];

			if($cur_date== $db_date){




			$msg="<div class='alert alert-danger'><strong>Error!</strong> Attendance already taken.</div>";

			return $msg ;

			}

		}

		foreach ($attendance as $atd_key => $atd_value) {
			

			if($atd_value =='present'){

				$stu_sql="INSERT INTO attendance_btech (roll,semester,year,attendance,attendance_date,subject) VALUES ('$atd_key','$semester','$year','present','$cur_date','$subject_title')";
				$data_insert= $this->db->insert($stu_sql);

			}else if($atd_value=='absent'){

				$stu_sql="INSERT INTO attendance_btech (roll,semester,year,attendance,attendance_date,subject) VALUES ('$atd_key','$semester','$year','absent','$cur_date','$subject_title')";
				$data_insert= $this->db->insert($stu_sql);

			}

		}


			if($data_insert){

				$msg="<div class='alert alert-success'><strong>Success.</strong> Attendance data inserted successfully.</div>";
						
			}else{
			
				$msg="<div class='alert alert-danger'><strong>Error!</strong> Attendance data insertion is unsuccessful.</div>";
			}

				return $msg ;
				
				



	}



	public function getDateList($course,$subject_title,$semester,$year){


		$sql="SELECT DISTINCT attendance_date FROM attendance_btech WHERE subject='$subject_title' AND semester='$semester' AND year='$year'";

		$result= $this->db->select($sql);

		return $result;

	}


	public function getAllData($course,$subject_title,$semester,$year,$attendance_date){

		$sql="SELECT btech_students.name, attendance_btech.* 
		      FROM btech_students
		      INNER JOIN attendance_btech
		      ON btech_students.roll= attendance_btech.roll
		      WHERE attendance_btech.attendance_date='$attendance_date' AND attendance_btech.semester='$semester' AND attendance_btech.year='$year' AND  attendance_btech.subject='$subject_title' ";

		$result= $this->db->select($sql);

		return $result;

	}


	public function updateAttendance($attendance,$course,$subject_title,$semester,$year,$attendance_date){


		foreach ($attendance as $atd_key => $atd_value) {
			

			if($atd_value =="present"){

				$sql="UPDATE attendance_btech SET attendance='present' WHERE roll='".$atd_key."' AND attendance_date= '".$attendance_date."' AND semester='$semester' AND subject='$subject_title' AND year='$year' ";
				$data_update= $this->db->update($sql);
			}else if($atd_value=="absent"){

				$sql="UPDATE attendance_btech SET attendance='absent' WHERE roll='".$atd_key."' AND attendance_date= '".$attendance_date."' AND semester='$semester' AND subject='$subject_title' AND year='$year' ";
				$data_update= $this->db->update($sql);
			}

		}


			if($data_update){

				$msg="<div class='alert alert-success'><strong>Success.</strong> Attendance data updated successfully.</div>";
										
			}else{
			
				$msg="<div class='alert alert-danger'><strong>Error!</strong> Attendance data is not updated! </div>";
			}

				return $msg ;
				


	}




} 


?>