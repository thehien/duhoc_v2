<?php
////////////////////category////////////////////
class Marketing{
function Marketing()
	{
		global $db;
	}
/////////////////////autohits/////////////////////
function show_link_hits($userid)
	{			
		global $db;	
		$time = time();
		$sql = "SELECT ck.* FROM coupons_keyword ck, coupons_users cu WHERE ck.userid = cu.userid ORDER BY ck.time asc Limit 0,1";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++)
			{					
					$sql_hits = "update coupons_keyword set hits= hits + '1', time = '$time' where id = '".$rows[$i]["id"]."'";	
					$res_hits = $db->db_query($sql_hits);
					
					$sql_sum_hit = "update coupons_users set sum_hit= sum_hit + '1' where userid='$userid'";	
					$res_sum_hit = $db->db_query($sql_sum_hit);		
			}	
		return $rows;
	}
function show_all_link_hits($userid)
	{			
		global $db;	
		$time = time();
		$sql = "SELECT ck.* FROM coupons_keyword ck, coupons_users cu WHERE ck.userid = cu.userid ORDER BY ck.time asc Limit 0,100";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}	

/////////////////////emal/////////////////////////	
// email_from gui
function get_email_from($id_user)
	{
		global $db,$function;
		$date_dm = date("dm");
		$db->db_query("update email_from set send= '1', time='$time', day_month = '$date_dm' where day_month != '$date_dm'");
		$sql = "SELECT * FROM email_from where status = '1' and userid = '$id_user' and send < 500 ORDER BY time asc limit 0,1";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		return $rows;		
	}
function update_time_email_from($id,$day_month)
	{
		global $db, $function;
		$time = time();
		$date_dm = date("dm");
		if ($day_month == $date_dm){$sql = "update email_from set send= send + '1', time='$time', day_month = '$date_dm' where id	= '$id'";}
		else {$sql = "update email_from set send= '1', time='$time', day_month = '$date_dm' where id = '$id'";}
	
		$res = $db->db_query($sql);
		if($res){ return true;}
		else return false;
	}	
// email_from nhan
function get_email_to()
	{
		global $db,$function;
		$sql = "SELECT * FROM email_to where status = '1' ORDER BY time asc limit 0,1";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		return $rows;		
	}
function update_status($id)
	{
		global $db, $function;
		$time = time();
		$sql = "update email_to set send= send + '1', time='$time' where id	= '$id'";	
		$res = $db->db_query($sql);
		if($res){ return true;}
		else return false;
	}
//tinh email gui hom nay
function show_num_send()
	{			
		global $db;	
		$date_dm = date("dm");
		$sql = "SELECT sum(send) as num_send FROM email_from where status = '1' and day_month =$date_dm";				
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		return $rows;
	}	
//thong ke tat ca email da gui
function show_num_to()
	{			
		global $db;	
		$date_dm = date("dm");
		$sql = "SELECT sum(send) as num_to FROM email_to where status = '1'";				
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
		return $rows;
	}

/////////////////////forum///////////////////////
// lay noi dung forum
function num_seo_category($category)
	{
		global $db,$function;
		$sql = "SELECT cc.category_id FROM coupons_category cc 
				where cc.status = '1' and cc.parent_id = '$category' ";		
		$res = $db->db_query($sql);					
		$rows = $db->db_numrows($res);
		return $rows;
	}
// thong tin san pham
function show_marketing($page,$per_page,$category,$parent)
	{			
		global $db,$function;
		if($category == '0'){$tem_category = "";}
		else{$tem_category = "and cc.category_id='$category'";}
		
		if($parent == '0'){$tem_parent = "";}
		else{$tem_parent = "and cc.parent_id ='$parent'";}
		
		$sql = "SELECT cpr.*, cpd.* FROM coupons_products cpr, coupons_description cpd, coupons_category cc WHERE cc.category_id=cpr.news_category and cpd.news_id=cpr.news_id and cpr.status = '1' $tem_category $tem_parent
		ORDER BY rand() Limit $page, $per_page";	

		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);
		for($i = 0; $i < count($rows); $i++)
			{			
				$rows[$i]["gia_ban"] =number_format($rows[$i]["price_new"],".",".",",");	
				if ($rows[$i]["price_new"] != 0 and $rows[$i]["price"] != 0)
				{
					$rows[$i]["tiet_kiem"] = number_format(($rows[$i]["price"]-$rows[$i]["price_new"])/$rows[$i]["price"]*100);
					$rows[$i]["news_content_150"] = $function->cutnchar($rows[$i]["news_content"],140);
				}		
			}	
		return $rows;
	}
// tu khoa hien thi
function show_keyword_seo($category){
		global $db;
		//$sql = "Select * from coupons_keyword where category_id='$category' ORDER BY rand() Limit 0,1 ";	
		//$sql = "Select * from coupons_keyword where userid='1' ORDER BY rand() Limit 0,1 ";	
		$sql = "Select * from coupons_keyword where status = '1' ORDER BY rand() Limit 0,1 ";	
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}
// danh muc menu	
function category_all_seo($category_id,$parent_id,$page,$per_page)
	{
		global $db, $function;
		$language = LANG_AUGE;
		if($category_id == '0'){$tem_category_id = "";}
		else{$tem_category = "and category_id ='$category_id'";}
		
		if($parent_id == '0'){$tem_parent_id = "";}
		else{$tem_parent = "and parent_id='$parent_id'";}
		
		$sql = "SELECT category_id,category_name,parent_id,status,category_url,color,link,layout,news_url
		FROM coupons_category where status = '1' and language ='$language' $tem_category $tem_parent ORDER BY pos asc Limit $page, $per_page";	

		$res = $db->db_query($sql);					
		$rows = $db->db_fetchrowset($res);
		return $rows;
	}	
		
// Noi dung mail lay tu tu khoa
function mail_coupons_keyword($userid)
	{			
		global $db;	
		$time = time();
		$sql = "SELECT ck.* FROM coupons_keyword ck, coupons_users cu WHERE ck.userid = cu.userid ORDER BY ck.time asc Limit 0,1";
		$res = $db->db_query($sql);
		$rows = $db->db_fetchrow($res);
						
		$sql_hits = "update coupons_keyword set hits= hits + '1', time = '$time' where id = '".$rows["id"]."'";	
		$res_hits = $db->db_query($sql_hits);
		
		$sql_sum_hit = "update coupons_users set sum_hit= sum_hit + '1' where userid='$userid'";	
		$res_sum_hit = $db->db_query($sql_sum_hit);		
		return $rows;
	}	
}
?>
