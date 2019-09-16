<?php
require('../general/include/config.php');
session_start();
if (!isset($_SESSION[URL_HOME]["lang"])) {
  $_SESSION[URL_HOME]["lang"] = "vn";
}
if ($_SESSION[URL_HOME]["lang"] == "vn") {
  $language = 0;
  include('../general/language/language_vn.php');
} else {
  $language = 1;
  include('../general/language/language_en.php');
}
try{
  $db_username = DB_USER; //database username
  $db_password = DB_PWD; //database password
  $db_name = DB_NAME; //database name
  $db_host = DB_HOST; //hostname or IP
  
  $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_username, $db_password);
  $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db_con->exec("set names utf8");
}catch(PDOException $e){
  echo $e->getMessage();
}
?>