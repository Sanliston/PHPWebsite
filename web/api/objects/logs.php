<?php
//This file is for the members
class ClickLog{
	
	//database connection and table name
	private $conn;
	private $table_name = "click_log";
	
	//object properties
	public $clicked_element;
	public $time;
	
	//constructor with db as database connection
	public function __construct($db){
		$this->conn = $db;
	}

	//read all clicks
	function read(){
		//Select all query
		$query = "SELECT * FROM " . $this->table_name . "";
		
		//prepare query statement
		$stmt = $this->conn->prepare($query);

		//execute query
		$stmt->execute();

		return $stmt;
	}

	//create click log
	function create(){
		
		//echo "\nvalues of clicked_element: ".$this->clicked_element;
		//echo "\nvalues of time: ".$this->time;
		//query to insert record
		$query = "INSERT INTO ". $this->table_name." (clicked_element) VALUES ('".$this->clicked_element."')";
		//echo "query : ".$query;
		$stmt = $this->conn->prepare($query);

		//execute
		if($stmt->execute()){
			return true;
		}
		
		//echo "error in logs.create()";
		return false;
	}

}

?>
