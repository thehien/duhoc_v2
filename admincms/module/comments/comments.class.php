<?php
class Comments_class{
function Comments_class(){}
//Views
function num_views($name_search,$category)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.nickname like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.news_id = '$category'";}
		
		$sql = "SELECT a.id FROM coupons_comment a, coupons_products b 
		where a.id >= '1' and a.news_id = b.news_id and a.language ='$language' $sr_search";	
		
		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search,$category)
	{
		global $db,$function;
		$language = LANG_AUGE_CMS;
		if($order ==""){$orderby = "ORDER BY a.id desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		$sr_search = '';
		if ($name_search == ''){$sr_search.="";}
		else{$sr_search.="and a.nickname like '%".$name_search."%'";}
		
		if ($category == ''){$sr_search.="";}
		else{$sr_search.="and a.news_id = '$category'";}
		
		$sql = "SELECT a.id as id_tem, a.nickname,a.content, a.status, a.pos, b.news_name,b.news_url,b.news_id
		FROM coupons_comment a, coupons_products b where a.id >= '1' and a.news_id = b.news_id 
		and a.language ='$language' $sr_search $orderby Limit $page,$per_page";

		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++)
		{		
			$rows[$i]["content"] = $function->cutnchar($rows[$i]["content"],100);
		}	
		$db->db_freeresult($res);
		return $rows;
	}	
//Insert 
function insert_table($data)
	{
		global $db;
		$sql = "INSERT INTO coupons_comment(id,nickname,content,news_id,status,pos,language) 
				VALUES(NULL,'".$data['nickname']."','".$data['content']."','".$data['news_id']."',
				'".$data['status']."','".$data['pos']."','".$data['language']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, id as id_tem from coupons_comment where id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update coupons_comment set nickname ='".$data['nickname']."', content ='".$data['content']."', news_id ='".$data['news_id']."',
		status ='".$data['status']."',pos ='".$data['pos']."' where id='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_comment set pos ='$pos' where id='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select id from coupons_comment where id = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_comment where id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_comment set status ='$status' where id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_comment set status ='0' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_comment set status ='1' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function all_coupons_products()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT news_id,news_name from coupons_products WHERE language ='$language' ORDER BY pos ASC";
		$res = $db->db_query($sql);	
		$nums = $db->db_numrows($res);	
		if($nums)
		{
			$rows = $db->db_fetchrowset($res);
			$db->db_freeresult($res);
			return $rows;
		}				
		
	}
}
?>
