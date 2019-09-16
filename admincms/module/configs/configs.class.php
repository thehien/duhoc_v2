<?php
class Configs_class{
function Configs_class(){}
//Views
function num_views($name_search)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if ($name_search == ''){$sr_search ="";}
		else{$sr_search="and config_website like '%".$name_search."%'";}
		
		$sql = "SELECT id FROM coupons_config where id >= '1' and language ='$language' $sr_search";	
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
		else{$sr_search="and config_website like '%".$name_search."%'";}
		
		$sql = "SELECT id as id_tem,config_website,status,pos
		FROM coupons_config where id >= '1' and language ='$language' $sr_search $orderby Limit $page, $per_page";
			
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		$db->db_freeresult($res);
		return $rows;
	}	
//Insert 
function insert_table($data)
	{
		global $db;
		$sql = "INSERT INTO coupons_config(id,config_website,config_phone,config_hotline,config_fax,config_email,config_company,
				config_address,config_tilte,config_keywords,config_description,config_bank,config_time,status,pos,language) 
				VALUES(NULL,'".$data['config_website']."', '".$data['config_phone']."', '".$data['config_hotline']."', '".$data['config_fax']."', 
				'".$data['config_email']."', '".$data['config_company']."', '".$data['config_address']."', '".$data['config_tilte']."', 
				'".$data['config_keywords']."', '".$data['config_description']."', '".$data['config_bank']."', 
				'".$data['config_time']."',1,1,'".$data['language']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, id as id_tem from coupons_config where id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update coupons_config set config_website ='".$data['config_website']."', config_time ='".$data['config_time']."', 
		config_phone ='".$data['config_phone']."', config_hotline ='".$data['config_hotline']."', config_fax ='".$data['config_fax']."', 
		config_email ='".$data['config_email']."', config_company ='".$data['config_company']."', config_address ='".$data['config_address']."', 
		config_tilte ='".$data['config_tilte']."', config_keywords ='".$data['config_keywords']."', config_description ='".$data['config_description']."',
		config_bank ='".$data['config_bank']."' where id='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$config_website,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_config set config_website ='$config_website', pos ='$pos' where id='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select id from coupons_config where id = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_config where id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_config set status ='$status' where id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_config set status ='0' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_config set status ='1' where id='$id'";
		$db->db_query($sql);
		return false;
	}
}
?>
