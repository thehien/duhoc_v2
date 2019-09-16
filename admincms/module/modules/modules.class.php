<?php
class modules_class{
function modules_class(){}

//Views tree
function views_tree_arrays($name_search='',$order='',$sc='',$parent=0,$spacing='',$tree_arrays='',$level=0)
{
	global $db;
	$language = LANG_AUGE_CMS;
	if(!is_array($tree_arrays))$tree_arrays = array();
	if($order ==""){$orderby = "ORDER BY a.pos ASC";}
	else{$orderby = "ORDER BY $order $sc";}
	
	if ($name_search == ''){$sr_search ="";}
	else{$sr_search="and name like '%".$name_search."%'";}

	$sql = "SELECT  a.*, a.module_id as id_tem FROM coupons_module a WHERE a.parent = $parent and language ='$language' $sr_search $orderby";
	$res = $db->db_query($sql);
	if($db->db_numrows($res) > 0)
	{
		$rows = $db->db_fetchrowset($res);
		foreach($rows as $tree)
		{
			$check_sub = $this->check_sub_category($tree['module_id']);
			if($check_sub > 0){$sub_category = 1;}
			else{$sub_category = 0;}
			
			$str = $spacing.'<i style="color:#337ab7" class="fa '.$tree['icon'].'"></i>&nbsp;&nbsp;'.$tree['name'];
			if($level == 0){$str = $spacing.'<i style="color:#337ab7" class="fa '.$tree['icon'].'"></i>&nbsp;<b>'.$tree['name'].'</b>';}
			elseif($sub_category == 1){$str = $spacing.''.$tree['name'];}
			$i='';
			$tree_arrays[] = array
			(
				"name" => $str,
				"id_tem" => $tree['id_tem'],
				"module_id" => $tree['module_id'],
				"parent" => $tree['parent'],
				"link" => $tree['link'],
				"icon" => $tree['icon'],
				"pos" => $tree['pos'],
				"status" => $tree['status'],
				"sub_category" => $sub_category,
				"level" => $level,
				"rows" => $i++
			);
			$level++;
			$db->db_freeresult($res);
			$tree_arrays = $this->views_tree_arrays($name_search='',$order='',$sc='',$tree['module_id'],$spacing.'&nbsp;&nbsp;&nbsp;',$tree_arrays,$level);
			$level--;
		}
	}return $tree_arrays;
}
function check_sub_category($parent){
	global $db;
	$sql = "Select parent From coupons_module Where parent = $parent";
	$res = $db->db_query($sql);
	$num = $db->db_numrows($res);
	$db->db_freeresult($res);
	return $num;	
}
//select tree
function select_tree_arrays($check_id,$parent=0,$spacing='',$tree_arrays='',$level=0)
{
	global $db;
	$language = LANG_AUGE_CMS;
	if(!is_array($tree_arrays))$tree_arrays = array();
	$str = "";
	if($check_id > 0)$str = "and a.parent <> $check_id and a.module_id <> $check_id";
	$sql = "SELECT a.name,a.module_id,a.parent FROM coupons_module a WHERE a.parent = $parent and language ='$language' $str ORDER BY a.pos ASC";
	$res = $db->db_query($sql);
	if($db->db_numrows($res) > 0)
	{
		$rows = $db->db_fetchrowset($res);
		foreach($rows as $tree)
		{
			if($level == 0){$str = $spacing.'<b>'.$tree['name'].'</b>';}
			else{$str = $spacing.'&raquo;&nbsp;'.$tree['name'];}
			
			if($level == 0){$str_box = $spacing.'<b>'.$tree['name'].'</b>';}
			else{$str_box = $spacing.$tree['name'];}
			
			$tree_arrays[] = array
			(
				"name" => $str,
				"checkbox_name" => $str_box,
				"module_id" => $tree['module_id'],
				"level" => $level
			);
			$level++;
			$db->db_freeresult($res);
			$tree_arrays = $this->select_tree_arrays($check_id,$tree['module_id'],$spacing.'&nbsp;&nbsp;&nbsp;&nbsp;',$tree_arrays,$level);
			$level--;
		}
	}return $tree_arrays;
}
//Insert 
function insert_table($data)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "INSERT INTO coupons_module(module_id,name,parent,content,link,icon,action_views,action_insert,action_edit,action_delete,pos,status,language) 
				VALUES(NULL,'".$data['name']."','".$data['parent']."','".$data['content']."','".$data['link']."','".$data['icon']."','1','1','1','1',
				'".$data['pos']."','".$data['status']."','$language')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}
//Edit
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, module_id as id_tem from coupons_module where module_id = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}	
function edit_table($id,$data)
	{
		global $db;
		$sql = "Update coupons_module set 
		name='".$data['name']."',parent='".$data['parent']."',
		content='".$data['content']."',link='".$data['link']."',icon='".$data['icon']."',pos='".$data['pos']."',status='".$data['status']."'
		where module_id='$id'";

		$res = $db->db_query($sql);
		$db->db_freeresult($res);

		$sql1 = "Update coupons_action set name='".$data['name']."',content='".$data['content']."'
		where module_id='$id'";
		$res1 = $db->db_query($sql1);
		$db->db_freeresult($res1);
		return false;
	}
function update_order_table($id,$pos,$link,$icon) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_module set pos ='$pos', link ='$link', icon='$icon' where module_id='$id'";
		$db->db_query($sql);
		return false;
	}				
//delete ok
function check_delete($id)
	{
			global $db;
			$sql = "Select module_id from coupons_module where module_id = '$id' and status ='1'";
			$res = $db->db_query($sql);
			$nums = $db->db_numrows($res);
			return $nums;
	}
function check_delete_parent($id)
	{
			global $db;
			$sql = "Select parent from coupons_module where parent = '$id'";
			$res = $db->db_query($sql);
			$nums = $db->db_numrows($res);
			return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_module where module_id='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}
//Status ok
function status_table($id,$status)
	{
		global $db;
		$sql = "Update coupons_module set status ='$status' where module_id = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;	
	}		
function status_off_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_module set status ='0' where module_id='$id'";
		$db->db_query($sql);
		return false;
	}
function status_on_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_module set status ='1' where module_id='$id'";
		$db->db_query($sql);
		return false;
	}

}
?>
