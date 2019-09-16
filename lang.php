<?php
	require 'general/include/config.php';
	session_start();
	
	if(!isset($_SESSION[URL_HOME]["lang"])) {
		$_SESSION[URL_HOME]["lang"] = "en";
	}
	$lang =$_GET["lang"];
	switch($lang) {
		case "en":;
			$_SESSION[URL_HOME]["lang"] = "en";	
			header("location: index.php");
			
		break;
		case "vn":
			$_SESSION[URL_HOME]["lang"] = "vn";
			header("location: index.php");
		break;
	}
?>