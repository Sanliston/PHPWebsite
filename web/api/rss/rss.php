<?php

	$url = "http://rss.cnn.com/rss/cnn_topstories.rss";
	$str = file_get_contents($url);
	//echo $str; //works

	//save str
	//check if file already exists
	$file = fopen($_SERVER['DOCUMENT_ROOT']."/app/main/rss/rss.xml", "w+"); //This stores the rss in the app folder so it can be access from the front end without the use of an API. This was done due to time constraints
	fwrite($file, $str);
	if($file == false){
		echo "error - file not opened";
	}
	fclose($file);

?>
