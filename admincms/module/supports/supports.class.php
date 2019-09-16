<?php
class Supports_class{
function Supports_class(){}
//Views
function num_views($name_search)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if ($name_search == ''){$sr_search ="";}
		else{$sr_search="and txt_name like '%".$name_search."%'";}
		
		$sql = "SELECT id FROM coupons_support where id >= '1' and language ='$language' $sr_search";	
		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if($order ==""){$orderby = "ORDER BY id desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		if ($name_search == ''){$sr_search ="";}
		else{$sr_search="and txt_name like '%".$name_search."%'";}
		
		$sql = "SELECT id as id_tem,txt_name,status,pos,txt_email,txt_tel
		FROM coupons_support where id >= '1' and language ='$language' $sr_search $orderby Limit $page, $per_page";
			
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		$db->db_freeresult($res);
		return $rows;
	}	
//Insert 
function insert_table($data)
	{
		global $db;
		$sql = "INSERT INTO coupons_support(id,txt_name,txt_email,txt_tel,txt_address,txt_content,status,pos,language) 
				VALUES(NULL,'".$data['txt_name']."','".$data['txt_email']."','".$data['txt_tel']."','".$data['txt_address']."',
				'".$data['txt_content']."','".$data['status']."','".$data['pos']."','".$data['language']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, id as id_tem from coupons_support where id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update coupons_support set txt_name ='".$data['txt_name']."',txt_email ='".$data['txt_email']."',txt_tel ='".$data['txt_tel']."',
		txt_address ='".$data['txt_address']."',txt_content ='".$data['txt_content']."',status ='".$data['status']."',pos ='".$data['pos']."'
		where id='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$txt_name,$txt_email,$txt_tel,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_support set txt_name ='$txt_name',txt_email ='$txt_email',txt_tel ='$txt_tel', pos ='$pos' where id='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select id from coupons_support where id = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_support where id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_support set status ='$status' where id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_support set status ='0' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_support set status ='1' where id='$id'";
		$db->db_query($sql);
		return false;
	}
}
?>
