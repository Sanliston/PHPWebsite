<?php
//This file is responsible for reading the database for log information - call by read_one.php?username='email'
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


//set error handler
set_error_handler("customError");

echo "\nread started running";

//include database and object files

include_once($_SERVER['DOCUMENT_ROOT']."/web/api/config/database.php");
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/objects/logs.php");



echo"\n---read finished including";

//instantiate database and member object
$database = new Database();

echo"\nread got database object";

$db = $database->getConnection();

//instantiate object
$click_log = new ClickLog($db);

//query click_logs
$stmt = $click_log->read();
$num = $stmt->rowCount();

echo("\nread.php reached function");

//check if more than 0 record found
if($num>0){
	
	//members array
	$click_logs_array = array();
	$click_logs_array["records"] = array();
	
	//retrieve table contents - fetch() is faster than fetchAll()
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		
		extract($row);
		
		$click_log_item=array(
			"clicked_element" => $clicked_element,
			"time" => $time,

		);

		array_push($click_logs_array["records"], $click_log_item);
	}

	echo json_encode($click_logs_array);
}else{
	echo json_encode(array("message"=>"no click logs found"));
}


?>
