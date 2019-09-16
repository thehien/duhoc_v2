<?php
require('../general/include/config.php');	
session_start();
if(!isset($_SESSION[URL_ADMIN]["cms_lang"])){
	$_SESSION[URL_ADMIN]["cms_lang"] = "cms_en";
}

$lang =$_GET["cms_lang"];
switch($lang){
	case "cms_en":;
		$_SESSION[URL_ADMIN]["cms_lang"] = "cms_en";	
		header("location: indexcms.php?module=homes");
		break;
	case "cms_vn":
		$_SESSION[URL_ADMIN]["cms_lang"] = "cms_vn";
		header("location: indexcms.php?module=homes");
		break;
}

?>