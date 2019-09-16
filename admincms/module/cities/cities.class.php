<?php
class Cities_class{
function Cities_class(){}
//Views
function num_views($name_search,$category)
	{
		global $db;
		$language = 0;
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.cityname like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.countryid = '$category'";}
		
		$sql = "SELECT a.cityid FROM coupons_cities a where a.cityid >= '1' and a.language ='$language' $sr_search";	
		
		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search,$category)
	{
		global $db;
		$language = 0;
		if($order ==""){$orderby = "ORDER BY a.cityid desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.cityname like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.countryid = '$category'";}
		
		$sql = "SELECT a.cityid as id_tem, a.cityname, a.status, a.pos, a.countryid, a.shipping
		FROM coupons_cities a where a.cityid >= '1' and a.language ='$language' $sr_search $orderby Limit $page,$per_page";

		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		$db->db_freeresult($res);
		return $rows;
	}	
//Insert 
function insert_table($data)
	{
		global $db;
		$sql = "INSERT INTO coupons_cities(cityid,cityname,countryid,shipping,status,pos,language) 
				VALUES(NULL,'".$data['cityname']."','".$data['countryid']."','".$data['shipping']."','".$data['status']."','".$data['pos']."',
				'".$data['language']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, cityid as id_tem from coupons_cities where cityid = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update coupons_cities set cityname ='".$data['cityname']."', countryid ='".$data['countryid']."',shipping ='".$data['shipping']."',
		status ='".$data['status']."',pos ='".$data['pos']."' where cityid='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$cityname,$countryid,$shipping,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_cities set cityname ='$cityname', countryid ='$countryid', shipping ='$shipping', pos ='$pos' where cityid='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select cityid from coupons_cities where cityid = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_cities where cityid='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_cities set status ='$status' where cityid = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_cities set status ='0' where cityid='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_cities set status ='1' where cityid='$id'";
		$db->db_query($sql);
		return false;
	}
}
?>
