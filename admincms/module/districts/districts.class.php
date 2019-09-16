<?php
class Districts_class{
function Districts_class(){}
//Views
function num_views($name_search,$category)
	{
		global $db;
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.district_name like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.cityid = '$category'";}
		
		$sql = "SELECT a.district_id FROM coupons_district a, coupons_cities b 
		where a.district_id >= '1' and a.cityid = b.cityid $sr_search";	
		
		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search,$category)
	{
		global $db;
		if($order ==""){$orderby = "ORDER BY a.district_id desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.district_name like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.cityid = '$category'";}
		
		$sql = "SELECT a.district_id as id_tem, a.district_name, a.shipping, a.status, a.pos, b.cityname
		FROM coupons_district a, coupons_cities b where a.district_id >= '1' and a.cityid = b.cityid 
		$sr_search $orderby Limit $page,$per_page";

		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		$db->db_freeresult($res);
		return $rows;
	}	
//Insert 
function insert_table($data)
	{
		global $db;
		$sql = "INSERT INTO coupons_district(district_id,district_name,cityid,shipping,status,pos) 
				VALUES(NULL,'".$data['district_name']."','".$data['cityid']."','".$data['shipping']."','".$data['status']."',
				'".$data['pos']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, district_id as id_tem from coupons_district where district_id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update coupons_district set district_name ='".$data['district_name']."', cityid ='".$data['cityid']."', shipping ='".$data['shipping']."',
		status ='".$data['status']."',pos ='".$data['pos']."' where district_id='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$district_name,$shipping,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_district set district_name ='$district_name', shipping ='$shipping', pos ='$pos' where district_id='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select district_id from coupons_district where district_id = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_district where district_id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_district set status ='$status' where district_id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_district set status ='0' where district_id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_district set status ='1' where district_id='$id'";
		$db->db_query($sql);
		return false;
	}
	
function all_coupons_cities()
	{
		global $db;
		$language = 0;
		$sql = "SELECT cityname, cityid from coupons_cities WHERE language ='$language' ORDER BY pos ASC";
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		$db->db_freeresult($res);
		return $rows;
	}
}
?>
