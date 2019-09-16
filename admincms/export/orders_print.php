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
	$sql = "SELECT cp.*, cp.shipping as shipping_cart, cw.district_name, ct.cityname, cs.status_name,
		cp.coupon_purchaseid as id_tem, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua
		FROM coupons_orders cp, coupons_district cw, coupons_cities ct, coupons_status cs 
		where cp.language ='$language' and cp.city = ct.cityid and cp.coupon_status =cs.coupon_status and cw.district_id = cp.district 
		and cs.language ='$language' $sr_search 
		ORDER BY cp.coupon_status asc, cp.coupon_purchaseid desc ";
	$res = $db->db_query($sql);						
?>

<?php
	while($rows=$db->db_fetchrow($res))
	{
			
		if($language)
		{
			$gia_ban =number_format(round($rows["money"],-0));
			$thanh_tien =number_format(round($rows["money"]+$rows["shipping_cart"]+$rows["cod"],-0));
			$shipping_cart =number_format(round($rows["shipping_cart"],-0));
			$cod =number_format(round($rows["cod"],-0));
		}
		else
		{
			$gia_ban =number_format(round($rows["money"],-3));
			$thanh_tien =number_format(round($rows["money"]+$rows["shipping_cart"]+$rows["cod"],-3));
			$shipping_cart =number_format(round($rows["shipping_cart"],-3));
			$cod =number_format(round($rows["cod"],-3));
		}
		echo'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo '<table cellpadding="0" cellspacing="0" border="1" class="order_table">';
		echo '
			<tr>	
				<td valign="top" style="border:none" ><strong>'.langcms_cartttgh.'</strong></td>
				<td valign="top" style="border:none"><strong>'.langcms_cartttd.'</strong></td>
			</tr>
			<tr >
			<td valign="top" style="border:none">
				Phone: <strong>'.$rows["mobile"].'</strong> <br>
				Email: <strong>'.$rows["email"].'</strong> <br>
				'.langcms_cartdchi.': <strong>'.$rows["address"].'</strong> <br>
				'.langcms_cartquantinh.': <strong> '.$rows["district_name"].' - '.$rows["cityname"].'</strong><br>
				'.langcms_cartghichu.': '.$rows["coupon_note"].'
			</td>
			<td valign="top" style="border:none">
				'.langcms_cartmadh.'g:<strong> '.$rows["coupon_code"].' </strong><br>
				'.langcms_carttngaym.':<strong> '.$rows["ngay_mua"].'</strong><br>
				Shipping:<strong> '.$shipping_cart.'</strong> - 
				Cod:<strong> '.$cod.'</strong> <br>
				'.langcms_carttongc.':<strong> '.$thanh_tien.' </strong><br>
				'.langcms_trangthai.':  <strong>'.$rows["status_name"].' </strong>
				
			</td>
			</tr>
			';

		echo '
			<tr>	
				<td  valign="top" ><strong>'.langcms_spten.'</strong></td>
				<td  valign="top" ><strong>'.langcms_cartthanht.'</strong></td>
			</tr>';
		$sql_pro = "SELECT cod.* from coupons_orders_detail cod where cod.coupon_code = ".$rows["coupon_code"]."";
		$res_pro = mysql_query($sql_pro);	
		while($row_pro=mysql_fetch_assoc($res_pro))
		{
			echo '
			<tr >
				<td valign="top" >'.$row_pro["news_name"].' <br>  '.langcms_cartchon.': '.$row_pro["option_name"].'</td>
				<td valign="top" >
				'.number_format(round($row_pro["price_new"],-1)).'  *  '.$row_pro["quantity"].' 
				= '.number_format(round($row_pro["price_sum"],-1)).' </td>
			</tr>
			';
		}
		echo '</table>';
		echo '<table><tr><td style="border:none"><br/></td><td style="border:none"><br/></td></tr></table>';
		
	}
?>
<style type="text/css">
 .order_table{border: 1px solid #CCCCCC; border-collapse: collapse; width:600px;}
 .order_table td{border: 1px solid #CCCCCC; padding:5px; min-width:20px; width:250px !important; font-size:12px; line-height:19px}
</style>

