<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once($_SERVER['DOCUMENT_ROOT']."/web/api/config/database.php");
include_once($_SERVER['DOCUMENT_ROOT']."/web/api/objects/members.php");

$member = null;
$email = $_GET["email"];
$password = $_GET["password"];
Echo "\nemail is: ".$email. " password is: ".$password;
echo "\ncalling api";

callAPI();


function checkPassword($email){
	
}

function callAPI(){ //GET
	
	$external_ip = "142.93.32.127"; //change this to be the server's external ip
	$service_url = $external_ip."/web/api/members/read_one.php?email=".$_GET["email"]; 
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	
	if($curl_response === false){
		$info = curl_getinfo($curl);
		curl_close($curl);
		die('error, curl execution failed, details: '.var_export($info));
	}

	curl_close($curl);
	$decoded = json_decode($curl_response);
	
	if(isset($decoded->response->status)&& $decoded->response->status == 'ERROR'){
		die('error: '.$decoded->response->errormessage);
	}

	echo '\nresponse ok: response - '.$curl_response;
	echo 'decoded json: '.$decoded["username"];
	var_export($decoded->response);

}


function initializeSecureSssion(){
	$session_name = "sec_session_id";
	$secure = true;
	
	//stopping javascript from accessing session_id
	$httponly = true;

	//forcing session to only use cookies
	if(ini_set("session.use_only_cookies", 1) === FALSE){
		header("Location: ../error.php?err=Could not initiate a safe session (ini set)"); //what exactly does this do?
		exit();
	}

	//Gets current cookie params
	$cookie_params = session_get_cookie_params();
	session_set_cookie_params($cookie_params["lifetime"], $cookie_params["path"], $cookie_params["domain"], $secure ,$httponly);

	//sets the session name to the one set above
	session_name($session_name);
	session_start(); //start the PHP session
	session_regenerate_id();  //regenerated the session, delete the old one
}

function login($email, $password){

	//checking password will be done by the REST API
	if(checkPassword($email, $password)){ //password is successful

	}else{ //password is invalid - Log in attempt is logged in the record
		
		logAttempt();
	}
	
}

function logAttempt(){
		
		$now = time();
		//query to insert record
		$query = ""; //"INSERT INTO ". $member->table_name." VALUES (".$member->account_id.", ".$member->username.", ".$now")";
		$stmt = $member->conn->prepare($query);

		//execute
		if($stmt->execute()){
			return true;
		}

		return false;
}


?>
