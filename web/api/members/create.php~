<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
Header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//get database connection
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/config/database.php");

//Instantiate member object
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/objects/members.php");

$database = new Database();
$db = $database->getConnection();

$member = new Member($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

//TODO check the username is not already in database:
check_username();
//set member property values
$member->username = $data->username;
$member->email = $data->email;
$member->password = $data->password;

//create the member
if($member->create()){

	echo '{';
	echo '"message":"member was created"';
	echo '}';

}else{
	echo '{';	
	echo '"message":"unable to create member"';
	echo '}';
}

function check_username(){
	//TODO
}

?>
