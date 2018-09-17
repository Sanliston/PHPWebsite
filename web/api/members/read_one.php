<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once($_SERVER['DOCUMENT_ROOT']."/web/api/config/database.php");
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/objects/members.php");

$database = new Database();
$db = $database->getConnection();

$member = new Member($db);

//set username property of member to be edited
$member->email = isset($_GET['email']) ? $_GET['email'] : die();  //called by read_one.php?username='email' - can be tested by setting this as Directory index

//read the details of the member to be edited
$member->readOne();

//create array
$member_array = array(
	"account_id" => $member->account_id,
	"username" => $member->username,
	"email"=>$member->email,
	"password"=>$member->password
);

//make into json
print_r(json_encode($member_array));

?>
