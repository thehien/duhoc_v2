<?php
require('../general/include/config.php');	
require('../general/class/db_mysql.php');
$db = null;
$db = new db_mysql(DB_HOST, DB_USER, DB_PWD, DB_NAME, false);
$db->db_query("SET NAMES 'utf8'");

$district_id = isset($_GET['district_id'])? $_GET['district_id']:"";
$get = isset($_GET['cityid'])? $_GET['cityid']:"";

echo'<select name="district" id="district"  class="select_option" >';
$sql="SELECT * from coupons_district WHERE cityid='$get'";
$res = $db->db_query($sql);	
while($row_huyen=$db->db_fetchrow($res))
{
	if($district_id and $district_id == $row_huyen[district_id])
	{
		echo "<option value=$row_huyen[district_id] selected='selected'>$row_huyen[district_name]</strong></option> " ;
	}
	else
	echo "<option value=$row_huyen[district_id] >$row_huyen[district_name]</strong></option> " ;
}
echo'</select> ';
?>