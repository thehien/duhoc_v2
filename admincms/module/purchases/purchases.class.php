<?php
class Purchases_class{
function Purchases_class(){}
//Views
function num_views($name_search,$startdate,$enddate,$status,$cities)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if ($name_search == ''){$sr_search="";}
		else{$sr_search="and (cp.name like '%".$name_search."%' or cp.coupon_code like '%".$name_search."%' or
		cp.mobile like '%".$name_search."%' or cp.name like '%".$name_search."%' or pro.news_name like '%".$name_search."%' or cp.jobseeker_name like '%".$name_search."%' or cp.jobseeker_title like '%".$name_search."%' or cp.email like '%".$name_search."%')";}
		
		if ($startdate == ''){$sr_search.="";}
		else{$sr_search.=" and FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') >= '$startdate'";}
		
		if ($enddate == ''){$sr_search.="";}
		else{$sr_search.=" and FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') <= '$enddate'";}
		
		if ($status == ''){$sr_search.="";}
		else{$sr_search.=" and cp.coupon_status = '$status'";}

		if($_SESSION[URL_ADMIN]["user_role"] == 3){$sr_search.= "and pro.userid = ".$_SESSION[URL_ADMIN]["userid"]."";}
		
		$sql = "SELECT cp.coupon_purchaseid FROM coupons_purchase cp, coupons_jobseekers pro  
		where cp.language ='$language' and pro.news_id = cp.coupon_id $sr_search";	

		$res = $db->db_query($sql);					
		$result = $db->db_query($sql);
		$rows = $db->db_numrows($result);
		$db->db_freeresult($res);
		return $rows;
	}
function views_table($page,$per_page,$order,$sc,$name_search,$startdate,$enddate,$status,$cities)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		if($order ==""){$orderby = "ORDER BY cp.coupon_purchaseid desc ";}
		else{$orderby = "ORDER BY $order $sc";}
		
		if ($name_search == ''){$sr_search="";}
		else{$sr_search="and (cp.name like '%".$name_search."%' or cp.coupon_code like '%".$name_search."%' or
		cp.mobile like '%".$name_search."%' or cp.name like '%".$name_search."%' or pro.news_name like '%".$name_search."%' or cp.jobseeker_name like '%".$name_search."%' or cp.jobseeker_title like '%".$name_search."%' or cp.email like '%".$name_search."%')";}
		
		if ($startdate == ''){$sr_search.="";}
		else{$sr_search.=" and FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') >= '$startdate'";}
		
		if ($enddate == ''){$sr_search.="";}
		else{$sr_search.=" and FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') <= '$enddate'";}
		
		if ($status == ''){$sr_search.="";}
		else{$sr_search.=" and cp.coupon_status = '$status'";}
		
		if($_SESSION[URL_ADMIN]["user_role"] == 3){$sr_search.= "and pro.userid = ".$_SESSION[URL_ADMIN]["userid"]."";}
		
		$sql = "SELECT cp.*, cp.coupon_purchaseid as id_tem, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua
		FROM coupons_purchase cp, coupons_jobseekers pro 
		where cp.language ='$language' and pro.news_id = cp.coupon_id $sr_search 
		$orderby Limit $page, $per_page";
			
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++)
		{		
				$rows[$i]["total"] = ($rows[$i]["money"]*$rows[$i]["quality"]) + $rows[$i]["shipping"] + $rows[$i]["cod"];
		}	
		$db->db_freeresult($res);
		return $rows;
	}
	
//Check user purchase	
function check_user_purchase($id) 
	{			
		global $db;
		if($_SESSION[URL_ADMIN]["user_role"] == 3){$sr_shop= "and pro.userid = ".$_SESSION[URL_ADMIN]["userid"]."";}
		$sql = "Select cp.coupon_purchaseid from coupons_purchase cp, coupons_jobseekers pro  
			where cp.coupon_purchaseid = $id and pro.news_id = cp.coupon_id $sr_shop";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}	
//delete
function check_delete($id)
	{
		global $db;
		$sql = "Select coupon_purchaseid from coupons_purchase where coupon_purchaseid = '$id' and coupon_status !='2'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function delete_table($id) 
	{
		global $db;
		$id = intval($id);
		$sql = "Delete from coupons_purchase where coupon_purchaseid='$id' and coupon_status ='2'";
		$db->db_query($sql);
		return false;
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
function show_coupons_status()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "SELECT coupon_status, status_name, status_color FROM coupons_status where language = '$language'";	
		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}
	
//Edit
function check_time_update($id)
	{
		global $db;
		$date_time = time();
		$sql = "Select coupon_purchaseid from coupons_purchase 
				where coupon_purchaseid='$id' and coupon_status='4' and ('$date_time'-time_update) > '86400'";
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
			$sql = "Update coupons_purchase set coupon_status ='$status', time_update ='$time_update'  where coupon_purchaseid = $id";
			$res = $db->db_query($sql);
			$db->db_freeresult($res);
		}
		return 1;
			
	}
function get_id($id) 
	{			
		global $db;
		$sql = "Select *, coupon_purchaseid as id_tem from coupons_purchase where coupon_purchaseid = $id"	;
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		$rows["total"] = ($rows["money"]*$rows["quality"]) + $rows["shipping"] + $rows["cod"];
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
			$sql = "Update coupons_purchase set firstname ='".$data['firstname']."',mobile ='".$data['mobile']."',email ='".$data['email']."',
			address ='".$data['address']."',coupon_status ='".$data['coupon_status']."',coupon_note ='".$data['coupon_note']."',
			shipping ='".$data['shipping']."',cod ='".$data['cod']."',money ='".$data['money']."',quality ='".$data['quality']."'
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
			$sql = "Update coupons_purchase set firstname ='".$data['firstname']."',mobile ='".$data['mobile']."',email ='".$data['email']."',
			address ='".$data['address']."',coupon_status ='".$data['coupon_status']."',shipping ='".$data['shipping']."',cod ='".$data['cod']."',
			money ='".$data['money']."',quality ='".$data['quality']."'
			where coupon_purchaseid='$id' and coupon_status < '3'";
			$db->db_query($sql);
		}
		return false;
	}				

}
?>
