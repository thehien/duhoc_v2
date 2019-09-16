<?php
$language = LANG_AUGE;
$sql = "SELECT * FROM coupons_config Where language ='$language'";
$res = $db->db_query($sql);
$rows = $db->db_fetchrow($res);

$lang_website = $rows['config_website'];
$lang_phone = $rows['config_phone'];
$lang_hotine = $rows['config_hotline'];
$lang_fax = $rows['config_fax'];
$lang_email = $rows['config_email'];
$lang_cong_ty = $rows['config_company'];
$lang_dia_chi = $rows['config_address'];
$lang_img = $rows['config_tilte'];
$lang_title = $rows['config_tilte'];
$lang_keywords = $rows['config_keywords'];
$lang_description = $rows['config_description'];
$lang_bank = $rows['config_bank'];
$lang_time = $rows['config_time'];
?>
