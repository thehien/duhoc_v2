<?php
class Imports_class{
function Imports_class(){}
//Views
function num_views($name_search,$startdate,$enddate,$category,$shops)
	{
		global $db;
		$language = LANG_AUGE_CMS;
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
		
		$sql = "SELECT a.id FROM coupons_import a, coupons_option b, coupons_products c 
		where b.option_id = a.option_id and c.news_id = a.news_id and a.id >= '1' and a.language ='$language' $sr_search ";
		
		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search,$startdate,$enddate,$category,$shops)
	{
		global $db;
		$language = LANG_AUGE_CMS;
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
		
		$sql = "SELECT a.*,  FROM_UNIXTIME(a.import_date,'%d-%m-%Y') as time_news, a.id as id_tem,a.import_note, c.news_name, b.option_name
		FROM coupons_import a, coupons_option b, coupons_products c 
		where b.option_id = a.option_id and c.news_id = a.news_id and a.id >= '1' and a.language ='$language' $sr_search $orderby Limit $page, $per_page";
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++)
		{		
			$rows[$i]["time_end"] = time() - $rows[$i]["import_date"];
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
//Delete
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_import where id='$id'";
		$db->db_query($sql);
		return false;
	}
function get_id($id) 
	{			
		global $db;
		$sql = "Select * from coupons_import where id = $id";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function update_coupons_option($option_id,$import_quantity) 
	{
		global $db;
		$sql = "Update coupons_option set quality_import =quality_import - '$import_quantity' where option_id='$option_id'";
		$db->db_query($sql);
		return false;
	}	
//Nha cung cap
function show_list_shop()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT cs.* FROM coupons_shop cs where language ='$language' ORDER BY cs.id asc ";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}	
		
}
?>
