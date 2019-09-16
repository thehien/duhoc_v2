<?php
class Filterones_class{
function Filterones_class(){}
//Views
function num_views($name_search,$category)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and (a.name like '%".$name_search."%' or a.filter_name like '%".$name_search."%')";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.category_id = '$category'";}
		
		$sql = "SELECT a.id FROM filter_one a, coupons_category b 
		where a.id >= '1' and a.category_id = b.category_id and a.language ='$language' $sr_search";	
		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search,$category)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if($order ==""){$orderby = "ORDER BY a.id desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and (a.name like '%".$name_search."%' or a.filter_name like '%".$name_search."%')";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.category_id = '$category'";}
		
		$sql = "SELECT a.id as id_tem, a.name, a.status, a.pos, a.filter_name, a.filter_url, b.category_name,b.category_id
		FROM filter_one a, coupons_category b where a.id >= '1' and a.category_id = b.category_id 
		and a.language ='$language' $sr_search $orderby Limit $page,$per_page";

		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		$db->db_freeresult($res);
		return $rows;
	}	
//Insert 
function insert_table($data)
	{
		global $db;
		$sql = "INSERT INTO filter_one(id,name,filter_name,filter_url,category_id,status,pos,language) 
				VALUES(NULL,'".$data['name']."','".$data['filter_name']."','".$data['filter_url']."',
				'".$data['category_id']."','".$data['status']."','".$data['pos']."','".$data['language']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, id as id_tem from filter_one where id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update filter_one set name ='".$data['name']."', filter_name ='".$data['filter_name']."', filter_url ='".$data['filter_url']."',
		category_id ='".$data['category_id']."', status ='".$data['status']."',pos ='".$data['pos']."' where id='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$name,$filter_name,$filter_url,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update filter_one set name ='$name',filter_name ='$filter_name',filter_url ='$filter_url', pos ='$pos' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function update_filter_products($filter_url,$url_old,$category_old) 
	{
		global $db;
		$sql = "Update filter_products set url_one ='$filter_url' where url_one='$url_old' and category_id ='$category_old'";
		$db->db_query($sql);
		return false;
	}
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select id from filter_one where id = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from filter_one where id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update filter_one set status ='$status' where id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update filter_one set status ='0' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update filter_one set status ='1' where id='$id'";
		$db->db_query($sql);
		return false;
	}
}
?>
