<?php
//This file is for the members
class Member{
	
	//database connection and table name
	private $conn;
	private $table_name = "members";
	
	//object properties
	public $account_id;
	public $username;
	public $email;
	public $password;
	
	//constructor with db as database connection
	public function __construct($db){
		echo "\nmember object initialized";
		$this->conn = $db;
		$this->account_id = $this->generate_id();
	}

	//read members
	function read(){
		//Select all query
		$query = "SELECT * FROM " . $this->table_name . "";
		
		//prepare query statement
		$stmt = $this->conn->prepare($query);

		//execute query
		$stmt->execute();

		return $stmt;
	}

	function readOne(){

		//query to read a single record
		$query = "SELECT * FROM " . $this->table_name . " WHERE EMAIL = '".$this->email."'";
		
		//prepare query statement
		$stmt = $this->conn->prepare($query);

		//execute query
		$stmt->execute();

		//get retrieved data
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		//set values to member properties
		$this->account_id = $row['account_id'];
		$this->username = $row['username'];
		$this->email = $row['email'];
		$this->password = $row['password'];

		
		
	}

	function generate_id(){

		$id = uniqid(rand(), true);
		$md5c = md5($id);
		return $md5c;
	}

	//create member
	function create(){

		//Sanitize
		$this->username=htmlspecialchars(strip_tags($this->username));
		$this->email=htmlspecialchars(strip_tags($this->email));
		$this->password=htmlspecialchars(strip_tags($this->password));
		
		//query to insert record
		$query = "INSERT INTO ". $this->table_name." VALUES (".$this->account_id.", ".$this->username.", ".$this->email.", ".$this->password.")";
		$stmt = $this->conn->prepare($query);

		//execute
		if($stmt->execute()){
			return true;
		}

		return false;
	}

}

?>
