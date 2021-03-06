<?php
//This file is responible for reading the database for member information
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


//set error handler
set_error_handler("customError");

echo "\nread started running";

//include database and object files

include_once($_SERVER['DOCUMENT_ROOT']."/Embargo/web/api/config/database.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Embargo/web/api/objects/members.php");



echo"\n---read finished including";

//instantiate database and member object
$database = new Database();

echo"\nread got database object";

$db = $database->getConnection();

//instantiate object
$member = new Member($db);

//query members
$stmt = $member->read();
$num = $stmt->rowCount();

echo("\nread.php reached function");

//check if more than 0 record found
if($num>0){
	
	//members array
	$members_array = array();
	$members_array["records"] = array();
	
	//retrieve table contents - fetch() is faster than fetchAll()
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		
		extract($row);
		
		$member_item=array(
			"account_id" => $account_id,
			"username" => $username,
			"email" => $email,
			"password" => $password

		);

		array_push($members_array["records"], $member_item);
	}

	echo json_encode($members_array);
}else{
	echo json_encode(array("message"=>"no members found"));
}


?>
