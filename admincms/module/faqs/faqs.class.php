<?php
class Faqs_class{
function Faqs_class(){}
//Views
function num_views($name_search)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if ($name_search == ''){$sr_search ="";}
		else{$sr_search="and question like '%".$name_search."%'";}
		
		$sql = "SELECT id FROM coupons_faq where id >= '1' and language ='$language' $sr_search";	
		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search)
	{
		global $db,$function;
		$language = LANG_AUGE_CMS;
		if($order ==""){$orderby = "ORDER BY id desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		if ($name_search == ''){$sr_search ="";}
		else{$sr_search="and question like '%".$name_search."%'";}
		
		$sql = "SELECT id as id_tem,question,status,pos
		FROM coupons_faq where id >= '1' and language ='$language' $sr_search $orderby Limit $page, $per_page";
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++)
		{		
			$rows[$i]["question"] = $function->cutnchar($rows[$i]["question"],100);
		}	
		$db->db_freeresult($res);
		return $rows;
	}	
//Insert 
function insert_table($data)
	{
		global $db;
		$sql = "INSERT INTO coupons_faq(id,question,answer,status,pos,language) 
				VALUES(NULL,'".$data['question']."','".$data['answer']."','".$data['status']."','".$data['pos']."','".$data['language']."')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, id as id_tem from coupons_faq where id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sr= '';
		$sql = "Update coupons_faq set question='".$data['question']."', answer='".$data['answer']."',status ='".$data['status']."',pos ='".$data['pos']."'
		where id='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
function update_order_table($id,$pos) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_faq set pos ='$pos' where id='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select id from coupons_faq where id = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_faq where id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_faq set status ='$status' where id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_faq set status ='0' where id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_faq set status ='1' where id='$id'";
		$db->db_query($sql);
		return false;
	}
}
?>
