<?php
class Keywords_class{
function Keywords_class(){}
//Views
function num_views($name_search,$category)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.keyword like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.category_id = '$category'";}
		
		$sql = "SELECT a.id FROM coupons_keyword a, coupons_category b 
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
		else{$sr_search.="and a.keyword like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.category_id = '$category'";}
		
		$sql = "SELECT a.id as id_tem, a.keyword, a.link, a.status, a.pos, b.category_name
		FROM coupons_keyword a, coupons_category b where a.id >= '1' and a.category_id = b.category_id 
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
		$sql = "INSERT INTO coupons_keyword(id,keyword,link,content,description,category_id,status,pos,language) 
				VALUES(NULL,'".$data['keyword']."','".$data['link']."','".$data['content']."','".$data['description']."',
				'".$data['category_id']."','".$data['status']."','".$data['pos']."','".$data['language']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, id as id_tem from coupons_keyword where id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update coupons_keyword set keyword ='".$data['keyword']."', link ='".$data['link']."',content ='".$data['content']."',
		description ='".$data['description']."',category_id ='".$data['category_id']."',status ='".$data['status']."',pos ='".$data['pos']."' 
		where id='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$keyword,$link,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_keyword set keyword ='$keyword', link ='$link', pos ='$pos' where id='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select id from coupons_keyword where id = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_keyword where id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_keyword set status ='$status' where id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_keyword set status ='0' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_keyword set status ='1' where id='$id'";
		$db->db_query($sql);
		return false;
	}
}
?>
