<?php
require('general/include/config.php');
mysql_connect("localhost", DB_USER, DB_PWD) or die("could not connect to database");
mysql_select_db(DB_NAME) or die("could not select to database");
mysql_query("SET NAMES 'utf8'");
?>
