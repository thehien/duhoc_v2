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
	
	if ($status == ''){$sr_search.="";}
	else{$sr_search.=" and cp.coupon_status = '$status'";}
	
	if ($cities == ''){$sr_search.="";}
	else{$sr_search.=" and cp.city = '$cities'";}
		
	$sql = "SELECT cpo.news_name, csh.shopname,
			(SELECT SUM(cod.quantity) FROM coupons_orders_detail cod, coupons_orders cp
			WHERE cod.news_id = cpo.news_id and cp.coupon_code = cod.coupon_code $sr_search) AS pcounts,
			
			(SELECT SUM(cod.price_import*cod.quantity) FROM coupons_orders_detail cod, coupons_orders cp
			WHERE cod.news_id = cpo.news_id and cp.coupon_code = cod.coupon_code $sr_search) AS tong_nhap,
			
			(SELECT SUM(cod.price_new*cod.quantity) FROM coupons_orders_detail cod, coupons_orders cp
			WHERE cod.news_id = cpo.news_id and cp.coupon_code = cod.coupon_code $sr_search) AS tong_ban
			FROM coupons_products cpo, coupons_shop csh
			
			where cpo.shop_id = csh.id and 
			(SELECT SUM(cod.quantity) FROM coupons_orders_detail cod, coupons_orders cp
			WHERE cod.news_id = cpo.news_id and cpo.language ='$language' and cp.coupon_code = cod.coupon_code $sr_search) > 0";
	$res = $db->db_query($sql);								
?>
<?php
	echo'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo ' 
	<table cellpadding="0" cellspacing="0" border="1" class="order_table">
	<tr>	
		<td valign="top" ><strong>'.langcms_spten.'</strong></td>
		<td valign="top" ><strong>'.langcms_spsluong.'</strong></td>
		<td valign="top" ><strong>'.langcms_spgnhap.'</strong></td>
		<td valign="top" ><strong>'.langcms_spgban.'</strong></td>
		<td valign="top" ><strong>'.langcms_carttnn.'</strong></td>
		<td valign="top" ><strong>'.langcms_carttbb.'</strong></td>
		<td valign="top" ><strong>'.langcms_cartlnn.'</strong></td>
		<td valign="top" ><strong>'.langcms_spnhacc.'</strong></td>
	</tr>';
	
	while($rows=$db->db_fetchrow($res))
	{
		if($language)
		{
			$gia_nhap =number_format(round($rows["tong_nhap"]/$rows["pcounts"],-0));
			$gia_ban =number_format(round($rows["tong_ban"]/$rows["pcounts"],-0));
			$tong_nhap =number_format(round($rows["tong_nhap"],-0));
			$tong_ban = number_format(round($rows["tong_ban"],-0));
			$Loi_nhuan = number_format(round($rows["tong_ban"]-$rows["tong_nhap"],-0));
		}
		else
		{
			$gia_nhap =number_format(round($rows["tong_nhap"]/$rows["pcounts"],-3));
			$gia_ban =number_format(round($rows["tong_ban"]/$rows["pcounts"],-3));
			$tong_nhap =number_format(round($rows["tong_nhap"],-3));
			$tong_ban = number_format(round($rows["tong_ban"],-3));
			$Loi_nhuan = number_format(round($rows["tong_ban"]-$rows["tong_nhap"],-3));
		}
		
		echo '
		<tr >
			<td valign="top" >'.$rows["news_name"].'</td>
			<td valign="top" >'.$rows["pcounts"].'</td>
			<td valign="top" >'.$gia_nhap.'</td>
			<td valign="top" >'.$gia_ban.'</td>
			<td valign="top" >'.$tong_nhap.'</td>
			<td valign="top" >'.$tong_ban.'</td>
			<td valign="top" >'.$Loi_nhuan.'</td>
			<td valign="top" >'.$rows["shopname"].'</td>
		</tr>
		';
	}
	
	echo '</table>';
?>

<style type="text/css">
 .order_table{border: 1px solid #CCCCCC; border-collapse: collapse; width:1000px;}
 .order_table td{border: 1px solid #CCCCCC; padding:5px; min-width:20px; font-size:12px; line-height:19px}
</style>

