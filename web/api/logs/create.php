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
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/objects/logs.php");

//for testing cronjob:
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/rss/rss.php");

$database = new Database();
$db = $database->getConnection();

$click_log = new ClickLog($db);


//get posted data
$data = json_decode(file_get_contents("php://input"));

//set click_log property values
$click_log->clicked_element = $data->clicked_element;
$click_log->time = $data->time;

//create the click_log
if($click_log->create()){

	echo '{';
	echo '"message":"click_log was created"';
	echo '}';

}else{
	echo '{';	
	echo '"message":"unable to create click_log"';
	echo '}';
}

?>
