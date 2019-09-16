<?php
	require('../../general/include/config.php');	
	require('../../general/class/db_mysql.php');
	$db = null;
	$db = new db_mysql(DB_HOST, DB_USER, DB_PWD, DB_NAME, false);
	$db->db_query("SET NAMES 'utf8'");
	
	session_start();
	if(!isset($_SESSION[URL_ADMIN]["cms_lang"])) 
	{
		$_SESSION[URL_ADMIN]["cms_lang"] = "cms_vn";
	}
	if($_SESSION[URL_ADMIN]["cms_lang"]=="cms_vn")
	{
		include('../../general/language/langcms_vn.php');
		$language ='0';
	}
	else if($_SESSION[URL_ADMIN]["cms_lang"]=="cms_en")
	{
		include('../../general/language/langcms_en.php');
		$language = '1';
	}

	$filename ="Danh-sach-don-hang";
	$ngay_in = date("d-m-Y");
		
	error_reporting(0);

?>

<?php
	$status = mysql_real_escape_string(isset($_GET['status']) ? $_GET['status'] : "");
	$cities = mysql_real_escape_string(isset($_GET['cities']) ? $_GET['cities'] : "");
	$name_search = mysql_real_escape_string(isset($_GET['name_search']) ? $_GET['name_search'] : "");
	$startdate = mysql_real_escape_string(isset($_GET['startdate']) ? $_GET['startdate'] : "");
	$enddate = mysql_real_escape_string(isset($_GET['enddate']) ? $_GET['enddate'] : "");

	if ($name_search == ''){$sr_search="";}
	else{$sr_search="and (cp.firstname like '%".$name_search."%' or cp.coupon_code like '%".$name_search."%' or
	cp.mobile like '%".$name_search."%' or cp.firstname like '%".$name_search."%' or cp.email like '%".$name_search."%')";}
	
	if ($startdate == ''){$sr_search.="";}
	else{$sr_search.=" and FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') >= '$startdate'";}
	
	if ($enddate == ''){$sr_search.="";}
	else{$sr_search.=" and FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') <= '$enddate'";}
	
	if ($status == ''){$sr_status.="";}
	else{$sr_status.=" and cp.coupon_status = '$status'";}
	
	if ($cities == ''){$sr_search.="";}
	else{$sr_search.=" and cp.city = '$cities'";}
	
	if($_SESSION[URL_ADMIN]["user_role"] == 3){$sr_shop= "and cpo.userid = ".$_SESSION[URL_ADMIN]["userid"]."";}	
	
	$sql = "SELECT cpo.*, csh.shopname, cot.option_name, cot.quality_import,
			(SELECT SUM(cp.quality) FROM coupons_purchase cp, coupons_district cw, coupons_cities ct, coupons_status cs
			WHERE cp.coupon_id = cpo.news_id and cp.language ='$language' and cp.city = ct.cityid and cw.district_id = cp.district 
			and cp.coupon_status =cs.coupon_status and cs.language ='$language' $sr_search) AS pcounts,
			
			(SELECT SUM(cp.quality) FROM coupons_purchase cp, coupons_district cw, coupons_cities ct, coupons_status cs
			WHERE cp.coupon_id = cpo.news_id and cp.language ='$language' and cp.city = ct.cityid and cw.district_id = cp.district 
			and cp.coupon_status =cs.coupon_status and cs.language ='$language' and cp.coupon_status = '1' $sr_search) AS status_01,
			
			(SELECT SUM(cp.quality) FROM coupons_purchase cp, coupons_district cw, coupons_cities ct, coupons_status cs
			WHERE cp.coupon_id = cpo.news_id and cp.language ='$language' and cp.city = ct.cityid and cw.district_id = cp.district 
			and cp.coupon_status =cs.coupon_status and cs.language ='$language' and cp.coupon_status = '2' $sr_search) AS status_02,
			
			(SELECT SUM(cp.quality) FROM coupons_purchase cp, coupons_district cw, coupons_cities ct, coupons_status cs
			WHERE cp.coupon_id = cpo.news_id and cp.language ='$language' and cp.city = ct.cityid and cw.district_id = cp.district 
			and cp.coupon_status =cs.coupon_status and cs.language ='$language' and cp.coupon_status = '3' $sr_search) AS status_03,
			
			(SELECT SUM(cp.quality) FROM coupons_purchase cp, coupons_district cw, coupons_cities ct, coupons_status cs
			WHERE cp.coupon_id = cpo.news_id and cp.language ='$language' and cp.city = ct.cityid and cw.district_id = cp.district 
			and cp.coupon_status =cs.coupon_status and cs.language ='$language' and cp.coupon_status = '4' $sr_search) AS status_04,
			
			(SELECT SUM(cp.quality) FROM coupons_purchase cp, coupons_district cw, coupons_cities ct, coupons_status cs
			WHERE cp.coupon_id = cpo.news_id and cp.language ='$language' and cp.city = ct.cityid and cw.district_id = cp.district 
			and cp.coupon_status =cs.coupon_status and cs.language ='$language' and cp.coupon_status = '5' $sr_search) AS status_05
			
			FROM coupons_products cpo, coupons_shop csh, coupons_option cot
			WHERE cpo.shop_id = csh.id and cpo.news_id = cot.news_id and 
			(SELECT SUM(cp.quality) FROM coupons_purchase cp, coupons_district cw, coupons_cities ct, coupons_status cs
			WHERE cp.coupon_id = cpo.news_id and cp.language ='$language' and cp.city = ct.cityid and cw.district_id = cp.district 
			and cp.coupon_status =cs.coupon_status and cs.language ='$language' $sr_search) > '0' $sr_shop ";
	$res = $db->db_query($sql);								
?>
<?php
	echo'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo ' 
	<table cellpadding="0" cellspacing="0" border="1" class="order_table">
	<tr>	
		<td valign="top" ><strong>'.langcms_spten.'</strong></td>
		<td valign="top" ><strong>'.langcms_spgnhap.'</strong></td>
		<td valign="top" ><strong>'.langcms_spgban.'</strong></td>
		<td valign="top" ><strong>'.langcms_spnhacc.'</strong></td>
		<td valign="top" ><strong>'.langcms_weldhm.'</strong></td>
		<td valign="top" ><strong>'.langcms_weldxnn.'</strong></td>
		<td valign="top" ><strong>'.langcms_weldghh.'</strong></td>
		<td valign="top" ><strong>'.langcms_weldtt.'</strong></td>
		<td valign="top" ><strong>'.langcms_weldgb.'</strong></td>
		<td valign="top" ><strong>'.langcms_nhapkho.'</strong></td>
	</tr>';
	
	while($rows=$db->db_fetchrow($res))
	{
		if($language)
		{
			$gia_nhap =number_format(round($rows["price_import"],-0));
			$gia_ban =number_format(round($rows["price_new"],-0));
		}
		else
		{
			$gia_nhap =number_format(round($rows["price_import"],-3));
			$gia_ban =number_format(round($rows["price_new"],-3));
		}
		
		echo '
		<tr >
			<td valign="top" >'.$rows["news_id"].' - '.$rows["news_name"].' - '.$rows["option_name"].'</td>
			<td valign="top" >'.$gia_nhap.'</td>
			<td valign="top" >'.$gia_ban.'</td>
			<td valign="top" >'.$rows["shopname"].'</td>
			<td valign="top" >'.$rows["status_01"].'</td>
			<td valign="top" >'.$rows["status_02"].'</td>
			<td valign="top" >'.$rows["status_03"].'</td>
			<td valign="top" >'.$rows["status_04"].'</td>
			<td valign="top" >'.$rows["status_05"].'</td>
			<td valign="top" >'.$rows["quality_import"].'</td>
		</tr>
		';
	}
	
	echo '</table>';
?>

<style type="text/css">
 .order_table{border: 1px solid #CCCCCC; border-collapse: collapse; width:1200px;}
 .order_table td{border: 1px solid #CCCCCC; padding:5px; min-width:20px; font-size:12px; line-height:19px}
</style>

