
<?php

Class Database{

public $servername="localhost";
 public $username="u444291273_123a";
 public $password="arit@006";
 public $db_name="u444291273_dis";

 


 public $link;
 public $error;


 public function __construct(){

 	$this->connectDB();
 }


 private function connectDB(){

 	$this->link = new mysqli($this->servername, $this->username, $this->password, $this->db_name);

 	if(!$this->link){

 		$this->error= "Connection Failed: ".$this->link->connect_error ;

 		return false;

 	}
 }



 // Select Data From Database


  public function select($sql){

  	$result= $this->link->query($sql) or die($this->link->error.__LINE__);

  	if($result->num_rows > 0){

  		return $result ;
  	}else{
  		return false;
  	}

  }

// Insert Data Into the Database
  public function insert($sql){


  	$insert_row= $this->link->query($sql) or die($this->link->error.__LINE__);

  	if($insert_row){
  		return $insert_row;
  	}
  }


// update data that is already present in the database
  public function update($sql){

  	$update_row= $this->link->query($sql) or die($this->link->error.__LINE__);

  	if($update_row){

  		return $update_row ;
  	}else{
  		return false;
  	}


  }



}


?>