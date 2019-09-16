<?php
class Manages_class{
function Manages_class(){}
//Views
function num_views($name_search,$category,$shops)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.news_name like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$arr_id = $this->read_record($category);$sr_search.= " and b.category_id IN ($arr_id) ";}
		
		if ($shops == ''){$sr_search.="";}
		else{$sr_search.= " and a.shop_id = '$shops'";}
		
		$sql = "SELECT a.news_id FROM coupons_products a, coupons_category b, coupons_option c , coupons_shop d 
		where a.news_id = c.news_id and a.news_category = b.category_id and d.id = a.shop_id and a.language ='$language' $sr_search";	
		
		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search,$category,$shops)
	{
		global $db,$function;
		$language = LANG_AUGE_CMS;
		if($order ==""){$orderby = "ORDER BY a.news_id desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.news_name like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$arr_id = $this->read_record($category);$sr_search.= " and b.category_id IN ($arr_id) ";}
		
		if ($shops == ''){$sr_search.="";}
		else{$sr_search.= " and a.shop_id = '$shops'";}
		
		$sql = "SELECT c.*, c.option_id as id_tem, a.news_name, a.status, a.pos, b.category_name, d.shopname,
		(c.quality_import + c.quality_output + c.quality_sell + c.quality_new) as quality_all,
		(c.quality_import -c.quality_output) AS ton_kho,
		(c.quality_new - (c.quality_import - c.quality_output)) as can_nhap,
		((c.quality_import- c.quality_output) - c.quality_sell) AS kho_tam
		FROM coupons_products a, coupons_category b , coupons_option c, coupons_shop d 
		where a.news_id = c.news_id and a.news_category = b.category_id and d.id = a.shop_id
		and a.language ='$language' $sr_search $orderby Limit $page,$per_page";
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++)
		{		
			$rows[$i]["news_name_new"] = $function->cutnchar($rows[$i]["news_name"],40);
			if($rows[$i]["kho_tam"] < 0){ $rows[$i]["kho_tam"]  = 0;}
			if($rows[$i]["ton_kho"] < 0){ $rows[$i]["ton_kho"]  = 0;}
			if($rows[$i]["can_nhap"] < 0){ $rows[$i]["can_nhap"]  = 0;}
		}	
		$db->db_freeresult($res);
		return $rows;
	}	
//category parent all
function read_record($id)
	{
		global $db;
		$array_id = "$id";
		$sql = "SELECT * FROM coupons_category WHERE parent_id  = '$id';";
		$rs = $db->db_query($sql);
		if($db->db_numrows($rs)>0){
			while($row= $db->db_fetchrow($rs))
			{	
				$array_id .= ','.$this->read_record($row["category_id"]);
			}										   
		}
		$db->db_freeresult($rs);
		return $array_id;
		return $id;
	}
//Dong bo du lieu	
function update_info_coupons_option()
	{
		global $db;
		//Dong bo don hang da ban
		$sql_4 = "Update coupons_option cpt set cpt.quality_output=(SELECT sum(cod.quantity)from coupons_orders_detail cod, coupons_orders cp 
		where cpt.option_id = cod.option_id and cp.coupon_code = cod.coupon_code and cp.coupon_status = '4') ";	
		$db->db_query($sql_4);
		
		//Dong bo don hang dang giao
		$sql_3 = "Update coupons_option cpt set cpt.quality_sell=(SELECT sum(cod.quantity)from coupons_orders_detail cod, coupons_orders cp 
		where cpt.option_id = cod.option_id and cp.coupon_code = cod.coupon_code and cp.coupon_status = '3') ";	
		$db->db_query($sql_3);
		
		//Dong hang moi can nhap
		$sql_2 = "Update coupons_option cpt set cpt.quality_new=(SELECT sum(cod.quantity)from coupons_orders_detail cod, coupons_orders cp 
		where cpt.option_id = cod.option_id and cp.coupon_code = cod.coupon_code and cp.coupon_status = '2') ";	
		$db->db_query($sql_2);
		
		return false;
	}
//Nha cung cap
function show_list_shop()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT cs.* FROM coupons_shop cs where cs.language ='$language' ORDER BY cs.id asc ";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}
//Tinh thanh
function show_all_city($countryid)
	{
		global $db;
		$sql = "SELECT cityname,cityid FROM coupons_cities where countryid ='$countryid' ORDER BY pos desc, cityid desc ";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}
// Cap nhat kho
function get_coupons_option($option_id) 
	{			
		global $db;
		$sql = "Select a.*, b.news_name, b.price_import from coupons_option a, coupons_products b where a.news_id = b.news_id and a.option_id = $option_id";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}
//Insert update
function insert_coupons_import($data)
	{
		global $db;
		$import_date = time();
		$userid = $_SESSION[URL_ADMIN]["userid"];
		$sql = "INSERT INTO coupons_import(id,option_id,news_id,import_quantity,import_price,import_note,language,import_date,userid) 
				VALUES(NULL,'".$data['option_id']."','".$data['news_id']."','".$data['import_quantity']."',
				'".$data['import_price']."','".$data['import_note']."','".$data['language']."','$import_date','$userid')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_coupons_option($data) 
	{
		global $db;
		$sql = "Update coupons_option set quality_import =quality_import + '".$data['import_quantity']."' where option_id='".$data['option_id']."'";
		$db->db_query($sql);
		return false;
	}	
function update_coupons_products($data) 
	{
		global $db;
		$sql = "Update coupons_products set price_import ='".$data['import_price']."' where news_id='".$data['news_id']."'";
		$db->db_query($sql);
		return false;
	}	

}
?>
