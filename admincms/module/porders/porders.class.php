<?php
class Porders_class{
	function Porders_class(){}
//Views
	function num_views($email_search,$create_date,$translate_from,$translate_to,$subject,$status,$country)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if ($email_search == ''){
			$sr_search="";
		} else {
			$sr_search="and (cp.email like '%".$email_search."%')";
		}
		
		if ($create_date == ''){$sr_search.="";}
		else{$sr_search.=" and FROM_UNIXTIME(cp.coupon_date,'%m/%Y') <= '$create_date'";}
		
		if ($translate_from == ''){$sr_search.="";}
		else{$sr_search.=" and cod.translate_from like '%".$translate_from."%'";}

		if ($translate_to == ''){$sr_search.="";}
		else{$sr_search.=" and cod.translate_to like '%".$translate_to."%'";}
		
		if ($subject == ''){$sr_search.="";}
		else{$sr_search.=" and cod.special_category = '$subject'";}

		if ($country == ''){$sr_search.="";}
		else{$sr_search.=" and cp.country = '$country'";}
		
		$sql = "SELECT distinct cp.coupon_purchaseid FROM coupons_orders cp inner join coupons_orders_detail cod
		where cp.coupon_code=cod.coupon_code and cp.language ='$language' $sr_search";	

		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}

	function views_table($page,$per_page,$order,$sc,$email_search,$create_date,$translate_from,$translate_to,$subject,$country)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if($order ==""){$orderby = "ORDER BY cp.coupon_purchaseid desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		if ($email_search == ''){$sr_search="";}
		else{$sr_search="and (cp.email like '%".$email_search."%')";}
		
		if ($create_date == ''){$sr_search.="";}
		else{$sr_search.=" and FROM_UNIXTIME(cp.coupon_date,'%m/%Y') <= '$create_date'";}
		
		if ($translate_from == ''){$sr_search.="";}
		else{$sr_search.=" and cod.translate_from like '%".$translate_from."%'";}
		

		if ($translate_to == ''){$sr_search.="";}
		else{$sr_search.=" and cod.translate_to like '%".$translate_to."%'";}
		
		if ($subject == ''){$sr_search.="";}
		else{$sr_search.=" and cod.special_category = '$subject'";}

		if ($country == ''){$sr_search.="";}
		else{$sr_search.=" and cp.country = '$country'";}
		
		$sql = "SELECT cp.*,cod.*, cuv.name as cust_name, cuv.email as cust_email,cod.file_translate, cp.coupon_purchaseid as id_tem, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua, (select t1.category_name from coupons_special_category t1 where t1.id = cod.special_category) as subject_field, (select t3.name from list_country t3 where t3.id = cp.country) as country_name
		FROM coupons_orders cp, coupons_orders_detail cod, coupons_users cuv
		where cp.language ='$language' and cuv.userid = cp.coupon_userid and cp.coupon_code = cod.coupon_code $sr_search $orderby Limit $page, $per_page";
		//echo $sql;
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++){		
			$rows[$i]["total"] = $rows[$i]["money"] + $rows[$i]["shipping"] + $rows[$i]["cod"];
		}	
		$db->db_freeresult($res);
		return $rows;
	}	
//delete
	function check_delete($id)
	{
		global $db;
		$sql = "Select coupon_purchaseid from coupons_orders where coupon_purchaseid = '$id' and coupon_status !='2'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
	function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_orders where coupon_purchaseid='$id' and coupon_status ='2'";
		$db->db_query($sql);
		return false;
	}
	function delete_orders_detail($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_orders_detail where coupon_code='$id'";
		$db->db_query($sql);
		return false;
	}
	function get_order_language($aUserId) {
		global $db, $function;
		$sql = "SELECT t1.translate_id, (select t2.name from list_languages t2 where t1.from_language = t2.id ) as from_language_name,(select t2.name from list_languages t2 where t1.to_language = t2.id ) as to_language_name FROM coupons_language_order t1 where t1.translate_id=$aUserId order by t1.id desc";

		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++){		
			$rows[$i]["to_language_name"] = $rows[$i]["to_language_name"];
			$rows[$i]["from_language_name"] = $rows[$i]["from_language_name"];
		}	
		$db->db_freeresult($res);
		return $rows;
	}	
	function show_target_download_file($id)
	{
		global $db;
		$sql = "SELECT * FROM coupons_translate_files where order_id ='$id' ORDER BY send_date desc ";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++){		
			$rows[$i]["send_date"] = date('d/m/Y', strtotime($rows[$i]["send_date"]));
		}	
		$db->db_freeresult($res);
		return $rows;
	}		

//Tinh thanh
	function show_all_city($countryid)
	{
		global $db;
		$sql = "SELECT cityname,cityid FROM coupons_cities where countryid ='$countryid' ORDER BY pos desc, cityid desc ";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}

	function show_language_name($id)
	{
		global $db;
		$sql = "SELECT name FROM list_languages where id ='$id' ORDER BY id desc ";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}

	function show_language_name_arr($translateArray) {
		global $db;

		$newArray = explode(',', $translateArray);
		$string = "'" . implode("','",$newArray) . "'";
		$sql = "SELECT name FROM list_languages where id in ($string) ORDER BY id desc ";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}

	function show_list_country() {
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT * FROM list_country where id >= 1 and language=$language order by id asc";
    //echo $sql;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);

		return $rows;
	}

    // kiem tra muc con url
	function show_all_language() {
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT * FROM list_languages where language=$language order by id asc ";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);

		return $rows;
	}

	function show_all_subject_field() {
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT * FROM coupons_special_category where language=$language order by id asc ";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);

		return $rows;
	}
	function show_all_create_date()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT DISTINCT FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua FROM coupons_orders cp where cp.language = '$language'";
		//echo $sql;	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}
	function show_payment_status()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT coupon_status, status_name, status_color FROM coupons_status where language = '$language' and id in (11,15)";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}

	function show_process_status()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT coupon_status, status_name, status_color FROM coupons_status where language = '$language' and id in (16,17,18) order by id";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}
//Edit
	function check_time_update($id)
	{
		global $db;
		$date_time = time();
		$sql = "Select coupon_purchaseid from coupons_orders where coupon_purchaseid = '$id' and coupon_status ='4' and ('$date_time'-time_update) > '86400'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
	function status_table($id,$status)
	{
		global $db;
		$check = $this->check_time_update($id);
		if($check == 0)
		{
			$time_update = time();
			$sql = "Update coupons_orders set coupon_status ='$status', time_update ='$time_update'  where coupon_purchaseid = $id";
			$res = $db->db_query($sql);
			$db->db_freeresult($res);
		}
		return 1;

	}
	function get_id($id) 
	{			
		global $db;
		$sql = "Select *, t1.coupon_purchaseid as id_tem, (select t3.name from list_country t3 where t3.id = t1.country) as country_name from coupons_orders t1 join coupons_users t2 on t1.coupon_userid=t2.userid where t1.coupon_purchaseid = $id";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$rows["total"] = $rows["money"] + $rows["shipping"] + $rows["cod"];
		$db->db_freeresult($res);
		return $rows;
	}	
	function edit_table($id,$data)
	{
		global $db;
		$check = $this->check_time_update($id);
		if($check == 0)
		{
			$sr= '';
			$sql = "Update coupons_orders set fullname ='".$data['fullname']."',mobile ='".$data['mobile']."',email ='".$data['email']."',address ='".$data['address']."'
			where coupon_purchaseid='$id' and coupon_status < '3'";

			$res = $db->db_query($sql);
		}
		return false;
	}
	function update_order_table($id,$data) 
	{
		global $db;
		$check = $this->check_time_update($id);
		if($check == 0)
		{
			$id = intval($id);
			$sql = "Update coupons_orders set firstname ='".$data['firstname']."',mobile ='".$data['mobile']."',email ='".$data['email']."',
			address ='".$data['address']."',coupon_status ='".$data['coupon_status']."',coupon_note ='".$data['coupon_note']."',shipping ='".$data['shipping']."',
			cod ='".$data['cod']."' where coupon_purchaseid='$id' and coupon_status < '3'";
			$db->db_query($sql);
		}
		return false;
	}	
// Chi tiet san pham trong don hang	
	function views_orders_detail($coupon_code)
	{
		global $db,$function;
		$sql = "SELECT * FROM coupons_orders_detail where coupon_code  = '$coupon_code'";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}
	function update_orders_detail($id,$data) 
	{
		global $db;
		$id = intval($id);
		$sql = "Update coupons_orders_detail set price_new ='".$data['price_new']."',quantity ='".$data['quantity']."', 
		price_sum = '".$data['price_new']*$data['quantity']."'
		where orders_id='$id'";
		$db->db_query($sql);
		return false;
	}	
	function update_coupons_orders_money($coupon_code)
	{
		global $db;	
		$sql = "Update coupons_orders set coupons_orders.money = (SELECT sum(coupons_orders_detail.price_sum) 
		from coupons_orders_detail where coupons_orders.coupon_code = coupons_orders_detail.coupon_code and 
		coupons_orders_detail.coupon_code = '$coupon_code') 
		where coupons_orders.coupon_code = '$coupon_code'";	
		$db->db_query($sql);
		return 1;	
	}			

}
?>















