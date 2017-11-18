<?php
session_start();
/**
* Database Class
*/
include_once "constants.php";

class Database
{
	
	private $con;

	public function connectDB(){
		$this->con = new Mysqli(HOST, USER, PASS, DB);
		if($this->con->connect_error){
			echo "Error : ".die($this->con->connect_error);
		}
		return $this->con;
	}

}


?>