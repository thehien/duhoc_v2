<?php
class Homes_class{
function Homes_class(){}
function report_coupons_orders($status='')
	{
		global $db;
		$rs ='';
		$language = LANG_AUGE_CMS;
		if($status){$rs=" and coupon_status ='$status'";}
		$sql = "Select coupon_purchaseid from coupons_orders where language ='$language' $rs ";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_coupons_comment($status)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from coupons_comment where status ='$status' and language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_coupons_support($status)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from coupons_support where status ='$status' and language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_coupons_faq($status)
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from coupons_faq where status ='$status' and language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_coupons_products()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select news_id from coupons_products where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_coupons_users()
	{
		global $db;
		$sql = "Select userid from coupons_users";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_coupons_news()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select news_id from coupons_news where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_coupons_keyword()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from coupons_keyword where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_coupons_shop()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from coupons_shop where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
	
function report_property()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from property where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}		
function report_filter_four()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from filter_four where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}
function report_filter_one()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from filter_one where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}	
	function report_filter_two()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from filter_two where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}	
	function report_filter_three()
	{
		global $db;
		$language = LANG_AUGE_CMS;
		$sql = "Select id from filter_three where language ='$language'";
		$res = $db->db_query($sql);
		$nums = $db->db_numrows($res);
		return $nums;
	}		
}
?>
