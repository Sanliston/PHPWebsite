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

login($email,$password);


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
	$decoded = json_decode($curl_response, true);
	
	if(isset($decoded->response->status)&& $decoded->response->status == 'ERROR'){
		die('error: '.$decoded->response->errormessage);
	}
	
	return $decoded;

}


function initializeSecureSession($member_info){ //TODO
	$id = uniqid(rand(), true);
	$md5c = md5($id);
	$session_name = "sec_session_".$md5c;
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

	//Set variables
	$_SESSION['username'] = $member_info['username'];
	$_SESSION['account_id'] = $member_info['account_id'];
	$_SESSION['status'] = "logged in";
}

function login($email, $password){

	//get member information from REST API
	$member_info = callAPI();

	if($member_info['password']==""){
		invalid();

	}else if($member_info['password']==$password){ //password is successful
		initializeSecureSession($member_info['account_id']);
		movePage();
	}else{ //password is invalid - Log in attempt is logged in the record
		//echo "invalid login details";
		logAttempt();
		//return page for invalid log in -- I'm doing this as an alternative to dynamic elements on the original landing page, because I found out that for that I would have needed to call the API through javascript.
		//This is an attempt to mitigate that quickly enough, without rewritting the whole API call. Under normal circumstances, I would have rewrote the API call, but the deadline is fast approaching.
		invalid();
	}
	
}

function movePage(){
	header("Location: /app/main/main.php");
}

function invalid(){
	header("Location: /invalid.html");
}

function logAttempt(){
		
		//This will be done by POST API to Login_attempts table -- out of scope of this small project due to time constraints
}


?>
