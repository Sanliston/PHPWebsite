<?php //This is responsible for updating the data of the click logs, due to time restraints - I opted not to use this as it is not necessary. It's also unfinished.
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//database and log files
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/config/database.php");
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/objects/logs.php");

$database = new Database();
$db = $database->getConnection();

$click_log = new ClickLog();
$data = json_decode(file_get_contents("php://input"));

//set id of log to be update
$click_log->id = $data->id;


?>
