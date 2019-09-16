<?php
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

	require('../../general/include/config.php');	
	require('../../general/class/db_mysql.php');
	require('../module/manages/manages.class.php');
	$Process = new Manages_class;

	$db = null;
	$db = new db_mysql(DB_HOST, DB_USER, DB_PWD, DB_NAME, false);
	$db->db_query("SET NAMES 'utf8'");

	$filename ="Thong-ke-kho";
	$ngay_in = date("d-m-Y");
	
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: attachment; filename=".$filename."-ngay-".$ngay_in.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	flush();
?>
<?php
	$name_search = mysql_real_escape_string(isset($_GET['name_search']) ? $_GET['name_search'] : "");
	$startdate = mysql_real_escape_string(isset($_GET['startdate']) ? $_GET['startdate'] : "");
	$enddate = mysql_real_escape_string(isset($_GET['enddate']) ? $_GET['enddate'] : "");
	$shops = mysql_real_escape_string(isset($_GET['shops']) ? $_GET['shops'] : "");
	$category = mysql_real_escape_string(isset($_GET['category']) ? $_GET['category'] : "");
	$order = mysql_real_escape_string(isset($_GET['order']) ? $_GET['order'] : "");
	$sc = mysql_real_escape_string(isset($_GET['sc']) ? $_GET['sc'] : "");

	$sr_search='';
	if($order ==""){$orderby = "ORDER BY a.id desc ";}
	else{$orderby = "ORDER BY $order $sc";}
			
	if ($name_search == ''){$sr_search ="";}
	else{$sr_search="and (c.news_name like '%".$name_search."%' or b.option_name like '%".$name_search."%' )";}
	
	if ($startdate == ''){$sr_search.="";}
	else{$sr_search.=" and FROM_UNIXTIME(a.import_date,'%d/%m/%Y') >= '$startdate'";}
	
	if ($enddate == ''){$sr_search.="";}
	else{$sr_search.=" and FROM_UNIXTIME(a.import_date,'%d/%m/%Y') <= '$enddate'";}
	
	if ($category == ''){$sr_search.="";}
	else{$arr_id = $this->read_record($category);$sr_search.= " and c.news_category IN ($arr_id) ";}
	
	if ($shops == ''){$sr_search.="";}
	else{$sr_search.= " and c.shop_id = '$shops'";}
	
	$sql = "SELECT a.*,FROM_UNIXTIME(a.import_date,'%d-%m-%Y') as time_news, a.id as id_tem,a.import_note,c.news_name,b.option_name,d.shopname,e.firstname
	FROM coupons_import a, coupons_option b, coupons_products c, coupons_shop d, coupons_users e
	where b.option_id = a.option_id and c.news_id = a.news_id and a.id >= '1' and c.shop_id = d.id and a.userid = e.userid
	and a.language ='$language' $sr_search $orderby";
	$res = $db->db_query($sql);	
?>
<?php
	echo'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo ' 
	<table cellpadding="0" cellspacing="0" border="1" class="order_table" >
	<tr>	
		<td valign="top" ><strong>'.langcms_spten.'</strong></td>
		<td valign="top"><strong>'.langcms_welnccc.'</strong></td>
		<td valign="top" ><strong>'.langcms_cartchon.'</strong></td>
		<td valign="top" align="center"><strong>'.langcms_spgnhap.'</strong></td>
		<td valign="top" align="center"><strong>'.langcms_cartsol.'</strong></td>
		<td valign="top" align="center"><strong>'.langcms_welnnn.'</strong></td>
		<td valign="top" align="center"><strong>'.langcms_tentv.'</strong></td>
	</tr>';
	
	while($rows=$db->db_fetchrow($res))
	{
		$gia_nhap =number_format(round($rows["import_price"],-3));

			echo '
			<tr >
				<td valign="top" >'.$rows["news_name"].'</td>
				<td valign="top" >'.$rows["shopname"].'</td>
				<td valign="top" >'.$rows["option_name"].'</td>
				<td valign="top" align="right">'.$gia_nhap.'</td>
				<td valign="top" align="center">'.$rows["import_quantity"].'</td>
				<td valign="top" align="right">'.$rows["time_news"].'</td>
				<td valign="top" align="right">'.$rows["firstname"].'</td>
			</tr>
			';
	
	}
	echo '</table>';
?>
<style type="text/css">
 .order_table{border: 1px solid #CCCCCC; border-collapse: collapse; width:1000px;}
 .order_table td{border: 1px solid #CCCCCC; padding:5px; min-width:20px; font-size:12px; line-height:19px}
</style>

