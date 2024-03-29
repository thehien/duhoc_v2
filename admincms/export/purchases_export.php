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
		
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: attachment; filename=".$filename."-ngay-".$ngay_in.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	flush();
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
	
	if($_SESSION[URL_ADMIN]["user_role"] == 3){$sr_search.= "and pro.userid = ".$_SESSION[URL_ADMIN]["userid"]."";}
	
	$sql = "SELECT cp.*, cp.coupon_purchaseid as id_tem, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua, cw.district_name, ct.cityname ,cs.*
	FROM coupons_purchase cp, coupons_district cw, coupons_cities ct, coupons_status cs, coupons_products pro    
	where cp.language ='$language' and cp.city = ct.cityid and cw.district_id = cp.district and cp.coupon_status =cs.coupon_status 
	and pro.news_id = cp.coupon_id and cs.language ='$language' $sr_search  ORDER BY cp.coupon_status asc ";
		
	$res = $db->db_query($sql);						
?>

<?php
	while($rows=$db->db_fetchrow($res))
	{
			
		if($language)
		{
			$gia_ban =number_format(round($rows["money"],-0));
			$thanh_tien =number_format(round(($rows["money"]*$rows["quality"])+$rows["shipping"]+$rows["cod"],-0));
			$shipping_cart =number_format(round($rows["shipping"],-0));
			$cod =number_format(round($rows["cod"],-0));
		}
		else
		{
			$gia_ban =number_format(round($rows["money"],-3));
			$thanh_tien =number_format(round(($rows["money"]*$rows["quality"])+$rows["shipping"]+$rows["cod"],-3));
			$shipping_cart =number_format(round($rows["shipping"],-3));
			$cod =number_format(round($rows["cod"],-3));
		}
		echo'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo '<table cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC;" >';
		echo '<thead>
			<tr>	
				<td valign="top"><strong>'.langcms_cartttd.'</strong></td>
				<td valign="top" ><strong>'.langcms_cartttgh.'</strong></td>
			</tr>
			</thead>
			<thead>
			<tr >
			
			<td valign="top" height="20" >
				<i>'.langcms_cartmadh.'</i>:<strong> '.$rows["coupon_code"].' </strong><br>
				<i>'.langcms_carttngaym.'</i>:<strong> '.$rows["ngay_mua"].'</strong><br>
				<i>Shipping:<strong></i>: '.$shipping_cart.'</strong> <br>
				<i>Cod:<strong></i>: '.$cod.'</strong> <br>
				<i>'.langcms_spsluong.'</i>:<strong> '.$rows["quality"].' </strong><br>
				<i>'.langcms_spgban.'</i>:<strong> '.$gia_ban.' </strong><br>
				<i>'.langcms_carttongc.'</i>:<strong> '.$thanh_tien.' </strong><br>
				<i>'.langcms_trangthai.'</i>:  <strong>'.$rows["status_name"].' </strong>
			</td>
			<td valign="top" height="20" width="800" >
				Phone: <strong>'.$rows["mobile"].'</strong> <br>
				Email: <strong>'.$rows["email"].'</strong> <br>
				'.langcms_cartdchi.': <strong>'.$rows["address"].'</strong> <br>
				'.langcms_cartquantinh.': <strong> '.$rows["district_name"].' - '.$rows["cityname"].'</strong><br>
				'.langcms_spten.': <strong>'.$rows["news_name"].'</strong> <br>
				'.langcms_sptimma.': <strong>'.$rows["coupon_id"].'</strong> - 
				'.langcms_cartchon.': <strong>'.$rows["option_name"].'</strong> <br>
				'.langcms_cartghichu.': '.$rows["coupon_note"].'
			</td>
			</tr>
			<thead>
			';
		echo '</table>';
		echo '<table><tr>
		<td style="border:none"><br></td>
		<td style="border:none"><br></td></tr></table>';
		
	}
?>

