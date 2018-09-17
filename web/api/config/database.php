<?php

include ("config.php");

class Database{
	

	private $conn;

	//establish database connection
	public function getConnection(){
		
		$this->conn= null; //make null in preparation for try-catch statement

		try{
			$this->conn = new PDO("pgsql:host=" . HOST . ";dbname=" . DATABASE, USERNAME, PASSWORD);
			$this->conn->exec("set names utf8");
			//echo "log in successful"; //These echos end up in the JSON so remove 

		}catch(PDOException $e){
			//contigency code
			echo "\nlog in unsuccessful :".$e->getMessage();
		}

		return $this->conn;
	}


}
?>
