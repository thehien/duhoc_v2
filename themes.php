<?php
	require 'general/include/config.php';
	session_start();
	if(!isset($_SESSION[URL_HOME]['themes_web'])) 
	{
		$_SESSION[URL_HOME]['themes_web'] = "themes";
	}
	$themes =$_GET["themes"];
	switch($themes) 
	{
		case "themes":;
			$_SESSION[URL_HOME]['themes_web'] = "themes";	
			header("location: index.php");
		break;
		case "themes_pro":
			$_SESSION[URL_HOME]['themes_web'] = "themes_pro";
			header("location: index.php");
		break;
	}
?>