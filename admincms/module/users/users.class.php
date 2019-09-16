<?php

class Users_class
{
	function Users_class()
	{
	}

	function check_user($username)// kiem tra user ton tai
	{
		global $db;
		$sql = "SELECT * FROM coupons_users WHERE  username = '$username' and status ='1' and user_role not in ('4') ";
		$rs = $db->db_query($sql);
		$num = $db->db_numrows($rs);
		if ($num == 1) {
			$row = $db->db_fetchrow($rs);
			return $row;
		} else {
			return false;
		}
	}

	function check_login($username, $password) // kiem tra de dang nhap vao
	{
		global $db;
		$sql = "SELECT * FROM coupons_users WHERE password = '$password' and  username = '$username' and status	= '1'";
		$rs = $db->db_query($sql);
		$num = $db->db_numrows($rs);
		if ($num == 1) {
			$row = $db->db_fetchrow($rs);
			$_SESSION[URL_ADMIN]["userid"] = $row["userid"];
			$_SESSION["username"] = $row["username"];
			$_SESSION[URL_ADMIN]["user_role"] = $row["user_role"];
			return $row;
		} else {
			return false;
		}
	}

	function check_email_register($email) // kiem tra email trung
	{
		global $db;
		$sql = "SELECT * FROM coupons_users WHERE email = '$email'";
		$rs = $db->db_query($sql);
		$num = $db->db_numrows($rs);
		return $num;
	}

	function check_user_register($username) // kiem tra user trung
	{
		global $db;
		$sql = "SELECT * FROM coupons_users WHERE username = '$username'";
		$rs = $db->db_query($sql);
		$num = $db->db_numrows($rs);
		return $num;
	}

	function change_password($password) // thay doi pass
	{
		global $db;
		$password = md5($password);
		$sql = "update coupons_users set password = '$password'";
		$res = $db->db_query($sql);
		if ($res) {
			return true;
		} else {
			return false;
		}
	}

//Views
	function num_views($name_search)
	{
		global $db;
		$rs = '';
		if ($name_search == '') {
			$sr_search = "";
		} else {
			$sr_search = "and (firstname like '%" . $name_search . "%' or email like '%" . $name_search . "%' or mobile like '%" . $name_search . "%')";
		}

		if ($_SESSION[URL_ADMIN]["userid"] != 1) {
			$rs = "and userid > 1";
		}

		$sql = "SELECT userid FROM coupons_users where 1 $sr_search $rs";
		$res = $db->db_query($sql);
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}

	function views_table($page, $per_page, $order, $sc, $name_search)
	{
		global $db;
		$rs = '';
		if ($order == "") {
			$orderby = "ORDER BY userid desc ";
		} else {
			$orderby = "ORDER BY $order $sc";
		}

		if ($name_search == '') {
			$sr_search = "";
		} else {
			$sr_search = "and (firstname like '%" . $name_search . "%' or email like '%" . $name_search . "%' or mobile like '%" . $name_search . "%')";
		}

		if ($_SESSION[URL_ADMIN]["userid"] != 1) {
			$rs = "and userid > 1";
		}

		$sql = "SELECT *,(select t4.name from list_country t4 where t4.id = t1.country) as country_name, userid as id_tem
		FROM coupons_users t1 where 1  $sr_search $rs $orderby Limit $page, $per_page";

		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);
		$db->db_freeresult($res);
		return $rows;
	}

//Insert
	function insert_table($data)
	{
		global $db;
		$password = md5($data['password']);
		$sql = "INSERT INTO coupons_users(userid,username,password,firstname,email,mobile,user_role,status) 
				VALUES(NULL,'" . $data['username'] . "','$password','" . $data['firstname'] . "','" . $data['email'] . "','" . $data['mobile'] . "',
				'" . $data['user_role'] . "','" . $data['status'] . "')";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}

//Edit
	function get_id($id)
	{
		global $db;
		$sql = "Select *, userid as id_tem from coupons_users where userid = $id";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}

	function edit_table($id, $data)
	{
		global $db;
		$sr = '';
		if ($data['password']) {
			$sr = ",password='" . md5($data['password']) . "'";
		}
		$sql = "Update coupons_users set username='" . $data['username'] . "' $sr, firstname ='" . $data['firstname'] . "',
		email='" . $data['email'] . "', mobile='" . $data['mobile'] . "', user_role='" . $data['user_role'] . "', status='" . $data['status'] . "'
		where userid='$id'";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return false;
	}

	function update_order_table($id, $firstname, $email, $mobile)
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_users set firstname ='$firstname', email ='$email', mobile='$mobile' where userid='$id'";
		$db->db_query($sql);
		return false;
	}

//delete ok
	function check_delete($id)
	{
		global $db;
		$sql = "Select userid from coupons_users where userid = '$id' and status ='1'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}

	function delete_table($id)
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_users where userid='$id' and status ='0'";
		$db->db_query($sql);
		return false;
	}

//Status ok
	function status_table($id, $status)
	{
		global $db;
		$sql = "Update coupons_users set status ='$status' where userid = $id";
		$res = $db->db_query($sql);
		$db->db_freeresult($res);
		return 1;
	}

	function status_off_table($id)
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_users set status ='0' where userid='$id'";
		$db->db_query($sql);
		return false;
	}

	function status_on_table($id)
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_users set status ='1' where userid='$id'";
		$db->db_query($sql);
		return false;
	}

//User role
	function get_name_users($id)
	{
		global $db;
		$sql = "Select firstname from coupons_users where userid = $id";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}

	function update_module_action($userid)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT * FROM coupons_module where language ='$language' and status = '1'";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);
		for ($i = 0; $i < count($rows); $i++) {
			$module_id = $rows[$i]["module_id"];
			$parent = $rows[$i]["parent"];
			$name = $rows[$i]["name"];
			$content = $rows[$i]["content"];
			$link = $rows[$i]["link"];
			$icon = $rows[$i]["icon"];
			$pos = $rows[$i]["pos"];
			$language = $rows[$i]["language"];
			$res_num = $db->db_query("SELECT * FROM coupons_action where module_id ='$module_id' and userid = '$userid'");
			$check = $db->db_numrows($res_num);
			if ($check == 0) {
				$sql_action = "INSERT INTO coupons_action(action_id,module_id,parent,userid,name,content,link,icon,pos,language) 
				VALUES (NULL,'$module_id','$parent','$userid','$name','$content','$link','$icon','$pos','$language')";
				$res_action = $db->db_query($sql_action);
			} else {
				$sql_up = "Update coupons_action set parent='$parent',name='$name',content='$content',link='$link',icon='$icon',pos='$pos' 
						where module_id='$module_id' and userid='$userid'";
				$res_up = $db->db_query($sql_up);
			}
		}
		$db->db_freeresult($res);
		return $rows;
	}

	function delete_module_action($userid)
	{
		global $db;
		$sql = "Delete from coupons_action where userid = '$userid'";
		$db->db_query($sql);
		return false;
	}

	function views_tree_action($userid, $status = 0, $parent = 0, $spacing = '', $tree_arrays = '', $level = 0)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sr = '';
		if ($status) {
			$sr = "and status ='$status'";
		}
		if (!is_array($tree_arrays)) {
			$tree_arrays = [];
		}
		$sql = "SELECT  a.*, a.action_id as id_tem FROM coupons_action a WHERE a.parent = $parent and a.userid ='$userid' 
		and language ='$language' $sr ORDER BY a.pos ASC";
		$res = $db->db_query($sql);
		if ($db->db_numrows($res) > 0) {
			$rows = $db->db_fetchrowset($res);
			foreach ($rows as $tree) {
				$check_sub = $this->check_sub_category($tree['module_id']);
				if ($check_sub > 0) {
					$sub_category = 1;
				} else {
					$sub_category = 0;
				}

				$str = $spacing . '<i class="fa ' . $tree['icon'] . '"></i>&nbsp;' . $tree['name'];
				if ($level == 0) {
					$str = $spacing . '<b>' . $tree['name'] . '</b>';
				} elseif ($sub_category == 1) {
					$str = $spacing . '' . $tree['name'];
				}
				$i = '';
				$tree_arrays[] = [
					"name" => $str,
					"id_tem" => $tree['id_tem'],
					"module_id" => $tree['module_id'],
					"parent" => $tree['parent'],
					"icon" => $tree['icon'],
					"link" => $tree['link'],
					"action_views" => $tree['action_views'],
					"action_insert" => $tree['action_insert'],
					"action_edit" => $tree['action_edit'],
					"action_delete" => $tree['action_delete'],
					"status" => $tree['status'],
					"sub_category" => $sub_category,
					"level" => $level,
					"rows" => $i++
				];
				$level++;
				$db->db_freeresult($res);
				$tree_arrays = $this->views_tree_action($userid, $status = 0, $tree['module_id'], $spacing . '',
					$tree_arrays, $level);
				$level--;
			}
		}
		return $tree_arrays;
	}

	function check_sub_category($parent)
	{
		global $db;
		$sql = "Select parent From coupons_action Where parent = $parent";
		$res = $db->db_query($sql);
		$num = $db->db_numrows($res);
		$db->db_freeresult($res);
		return $num;
	}

	function update_action_user($id, $action_views, $action_insert, $action_edit, $action_delete, $status)
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_action set action_views ='$action_views', action_insert ='$action_insert', action_edit='$action_edit',
		action_delete='$action_delete',status='$status' where action_id='$id'";
		$db->db_query($sql);
		return false;
	}

	function get_coupons_action($userid, $link)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select * from coupons_action where userid = '$userid' and link = '$link' and status ='1' and language ='$language'";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$db->db_freeresult($res);
		return $rows;
	}

	function get_role_permission($userid, $parent)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT  a.*, a1.* FROM coupons_action a, coupons_action a1
		WHERE a.action_id = a1.action_id and a.parent = $parent and a.userid =$userid and a.language ='$language' and a.status ='1' ORDER BY a.pos ASC";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);
		$db->db_freeresult($res);
		return $rows;
	}

	function check_parent_action($userid, $parent)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select parent from coupons_action where parent = $parent and userid = '$userid' and status ='1' and language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}

}

?>
