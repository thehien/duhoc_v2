<?php
class Shops_class{
function Shops_class(){}
//Views
function num_views($name_search,$category)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.shopname like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$arr_id = $this->read_record($category);$sr_search.= " and a.category_id IN ($arr_id) ";}
		
		$sql = "SELECT a.id FROM coupons_shop a, coupons_category b 
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
		else{$sr_search.="and a.shopname like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$arr_id = $this->read_record($category);$sr_search.= " and a.category_id IN ($arr_id) ";}
		
		$sql = "SELECT a.id as id_tem, a.shopname, a.status, a.pos, b.category_name
		FROM coupons_shop a, coupons_category b where a.id >= '1' and a.category_id = b.category_id 
		and a.language ='$language' $sr_search $orderby Limit $page, $per_page";
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
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
//Insert 
function insert_table($data)
	{
		global $db;
		$sql = "INSERT INTO coupons_shop(id,shopname,category_id,status,pos,language) 
				VALUES(NULL,'".$data['shopname']."','".$data['category_id']."','".$data['status']."','".$data['pos']."','".$data['language']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, id as id_tem from coupons_shop where id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update coupons_shop set shopname ='".$data['shopname']."', category_id ='".$data['category_id']."',
		status ='".$data['status']."',pos ='".$data['pos']."' where id='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$shopname,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_shop set shopname ='$shopname', pos ='$pos' where id='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select id from coupons_shop where id = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function check_coupons_products($id)
	{
		global $db;
		$sql = "Select shop_id from coupons_products where shop_id = '$id'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
	
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_shop where id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_shop set status ='$status' where id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_shop set status ='0' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_shop set status ='1' where id='$id'";
		$db->db_query($sql);
		return false;
	}
}
?>
