<?php
	require('../../general/include/config.php');	
	require('../../general/class/db_mysql.php');
	require('../module/manages/manages.class.php');
	$Process = new Manages_class;
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

	$filename ="Thong-ke-kho";
	$ngay_in = date("d-m-Y");
	
	/*header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: attachment; filename=".$filename."-ngay-".$ngay_in.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	flush()*/;
?>
<?php
	$name_search = mysql_real_escape_string(isset($_GET['name_search']) ? $_GET['name_search'] : "");
	$shops = mysql_real_escape_string(isset($_GET['shops']) ? $_GET['shops'] : "");
	$category = mysql_real_escape_string(isset($_GET['category']) ? $_GET['category'] : "");
	$displays = mysql_real_escape_string(isset($_GET['displays']) ? $_GET['displays'] : "");
	$order = mysql_real_escape_string(isset($_GET['order']) ? $_GET['order'] : "");
	$sc = mysql_real_escape_string(isset($_GET['sc']) ? $_GET['sc'] : "");

	$sr_search='';
	if($order ==""){$orderby = "ORDER BY a.news_id desc ";}
	else{$orderby = "ORDER BY $order $sc";}
	
	if ($name_search == ''){$sr_search.="";}
	else{$sr_search.="and a.news_name like '%".$name_search."%'";}
	
	if ($category == ''){$sr_search.="";}
	else{$arr_id = $Process->read_record($category);$sr_search.= " and b.category_id IN ($arr_id) ";}
	
	if ($shops == ''){$sr_search.="";}
	else{$sr_search.= " and a.shop_id = '$shops'";}
	
	$sql = "SELECT c.*, c.option_id as id_tem, a.news_name, a.status, a.pos, b.category_name, d.shopname, a.price_import, a.price_new,
	(c.quality_import + c.quality_output + c.quality_sell + c.quality_new) as quality_all,
	(c.quality_import -c.quality_output) AS ton_kho,
	(c.quality_new - (c.quality_import - c.quality_output)) as can_nhap,
	((c.quality_import- c.quality_output) - c.quality_sell) AS kho_tam
	FROM coupons_products a, coupons_category b , coupons_option c, coupons_shop d 
	where a.news_id = c.news_id and a.news_category = b.category_id and d.id = a.shop_id
	and a.language ='$language' $sr_search $orderby";
	$res = $db->db_query($sql);	
		
?>
<?php
	echo'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo ' 
	<table cellpadding="0" cellspacing="0" border="1" class="order_table" >
	<tr>	
		<td valign="top" ><strong>'.langcms_spten.'</strong></td>
		<td valign="top" ><strong>'.langcms_spnhacc.'</strong></td>
		<td valign="top" ><strong>'.langcms_cartchon.'</strong></td>
		<td valign="top" ><strong>'.langcms_spgnhap.'</strong></td>
		<td valign="top" ><strong>'.langcms_spgban.'</strong></td>
		
		<td valign="top" ><strong>'.langcms_nhapkho.'</strong></td>
		<td valign="top" ><strong>'.langcms_xuatban.'</strong></td>
		<td valign="top" ><strong>'.langcms_tonkho.'</strong></td>
		
		<td valign="top" ><strong>'.langcms_chuyendi.'</strong></td>
		<td valign="top" ><strong>'.langcms_khotam.'</strong></td>
		
		<td valign="top" ><strong>'.langcms_xacnhan.'</strong></td>
		<td valign="top" ><strong>'.langcms_cannhap.'</strong></td>
	</tr>';
	
	while($rows=$db->db_fetchrow($res))
	{
		$gia_nhap =number_format(round($rows["price_import"],-3));
		$gia_ban =number_format(round($rows["price_new"],-3));
		if($rows["kho_tam"] < 0){ $rows["kho_tam"]  = 0;}
		if($rows["ton_kho"] < 0){ $rows["ton_kho"]  = 0;}
		if($rows["can_nhap"] < 0){ $rows["can_nhap"]  = 0;}
		
		if ($rows["$displays"] > 0)
		{
			echo '
			<tr >
				<td valign="top" >'.$rows["news_name"].'</td>
				<td valign="top" >'.$rows["shopname"].'</td>
				<td valign="top" >'.$rows["option_name"].'</td>
				<td valign="top" >'.$gia_nhap.'</td>
				<td valign="top" >'.$gia_ban.'</td>
				
				<td valign="top" >'.$rows["quality_import"].'</td>
				<td valign="top" >'.$rows["quality_output"].'</td>
				<td valign="top" >'.$rows["ton_kho"].'</td>
				
				<td valign="top" >'.$rows["quality_sell"].'</td>
				<td valign="top" >'.$rows["kho_tam"].'</td>
				
				<td valign="top" >'.$rows["quality_new"].'</td>
				<td valign="top" >'.$rows["can_nhap"].'</td>
			</tr>
			';
		}
	}
	echo '</table>';
?>
<style type="text/css">
 .order_table{border: 1px solid #CCCCCC; border-collapse: collapse; width:1000px;}
 .order_table td{border: 1px solid #CCCCCC; padding:5px; min-width:20px; font-size:12px; line-height:19px}
</style>

