<?php
function imports_process()
{
	global $db, $smarty, $function;
	global $module,$action_views,$action_insert,$action_edit,$action_delete,$main_url,$main_name,$main_content,$msg_time;
	$main = $function->sql_injection(isset($_GET['main'])? $_GET['main']:"");
	$page = $function->sql_injection(isset($_GET['page'])? $_GET['page']:"");
	$id = $function->sql_injection(isset($_GET['id'])? $_GET['id']:""); $smarty->assign("id",$id);
	$limit = $function->sql_injection(isset($_GET['limit'])? $_GET['limit']:""); $smarty->assign("limit",$limit);
	$order = $function->sql_injection(isset($_GET['order'])? $_GET['order']:""); $smarty->assign("order",$order);
	$sc = $function->sql_injection(isset($_GET['sc'])? $_GET['sc']:""); $smarty->assign("sc",$sc);
	$id_edit = $function->sql_injection(isset($_GET['id_edit'])? $_GET['id_edit']:""); $smarty->assign("id_edit",$id_edit);
	$category = $function->sql_injection(isset($_GET['category']) ? $_GET['category'] : ""); $smarty->assign("category",$category);
	$shops = $function->sql_injection(isset($_GET['shops']) ? $_GET['shops'] : ""); $smarty->assign("shops",$shops);
	$submit = $function->sql_injection(isset($_POST['submit']) ? $_POST['submit'] : "");
	
	$Process = new Imports_class;
	$url = $function->sql_injection($main_url);
	$file =  $function->sql_injection($main_url);
	$smarty->assign("url",$url);
	$smarty->assign("main_name",$main_name);
	$smarty->assign("main_content",$main_content);
	
	$class_cate = new categorys_class;
	$tree_select = $class_cate->select_tree_arrays(0,1);
	$smarty->assign('tree_select',$tree_select);
	// shop
	$rs_shop = $Process->show_list_shop();	
	$smarty->assign("rs_shop",$rs_shop);
	
	
	switch($main)
	{
		case "search":
			$name_search = $function->sql_injection(isset($_POST['name_search']) ? $_POST['name_search'] : "");
			$startdate = $function->sql_injection(isset($_POST['startdate']) ? $_POST['startdate'] : "");
			$enddate = $function->sql_injection(isset($_POST['enddate']) ? $_POST['enddate'] : "");
			if($name_search !="" or $startdate !="" or $enddate !="")
			{
				$_SESSION['search']['name_search'] = $name_search;
				$_SESSION['search']['startdate'] = $startdate;
				$_SESSION['search']['enddate'] = $enddate;
			}
			else
			{
				unset($_SESSION["search"]);
			}
			
			$smarty->assign("main_search",$main);
			if($_SESSION[$module]['url_views']){$function->goto_url($_SESSION[$module]['url_views']);}
			else{$function->goto_url(URL_ADMIN."?module={$url}&main=views");}
		break;	
		case "unsession":
			unset($_SESSION["search"]);
			$smarty->assign("main_search","search");
			$function->goto_url($_SESSION[$module]['url_views']);
		break;	
		case "views":
		default:
		if($action_views == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			$_SESSION[$module]['url_views'] =$function->FixQuotes($_SERVER['REQUEST_URI']);
			$smarty->assign("url_views", URL_ADMIN."?module={$url}&main=views");
			
			// Tim kiem 
			$name_search = $function->sql_injection(isset($_SESSION['search']['name_search']) ? $_SESSION['search']['name_search'] : "");
			$smarty->assign("name_search",$name_search);
			if($name_search){$smarty->assign("url_search","&name_search=$name_search");}
			
			$startdate = $function->sql_injection(isset($_SESSION['search']['startdate']) ? $_SESSION['search']['startdate'] : "");
			$smarty->assign("startdate",$startdate);
			if($startdate){$smarty->assign("url_start","&startdate=$startdate");}
		
			$enddate = $function->sql_injection(isset($_SESSION['search']['enddate']) ? $_SESSION['search']['enddate'] : "");
			$smarty->assign("enddate",$enddate);
			if($enddate){$smarty->assign("url_end","&enddate=$enddate");}
			
			$url_limit = ''; $url_order = ''; $url_category = '';$url_shops = '';
			if($category){$smarty->assign("url_category","&category=$category"); $url_category="&category=$category";}
			if($shops){$smarty->assign("url_shops","&shops=$shops"); $url_shops="&shops=$shops";}
			
			if($limit){$smarty->assign("url_limit","&limit=$limit"); $url_limit ="&limit=$limit";}
			if($order){$smarty->assign("url_order","&order=$order&sc=$sc"); $url_order="&order=$order&sc=$sc";}
			if($id_edit){$smarty->assign("url_edit","&id_edit=$id_edit");}
			
			$numf = $Process->num_views($name_search,$startdate,$enddate,$category,$shops);
			if($numf)
			{
				if($page ==""){$page =0;}
				if($limit==""){$limit=10;}
				$per_page = $limit;
				$all_page = $numf ? $numf : 1; 			
				$base_url = URL_ADMIN."?module={$url}&main=views{$url_limit}{$url_order}{$url_category}{$url_shops}";
				$url_last = "";		
				$paging = $function->generate_page_cms($base_url,$url_last,$all_page,$per_page,$page);
				$rs = $Process->views_table($page,$per_page,$order,$sc,$name_search,$startdate,$enddate,$category,$shops);			
				$smarty->assign("paging",$paging);
				$smarty->assign("numf",$numf);
				$smarty->assign("rs",$rs);
			}
		
			return $smarty->fetch("{$file}/views.html");
		break;	
		

		case "delete": 
		if($action_delete == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			$check = $_POST['checkbox_id'];							
			if($check != null)
			{
				foreach($check as $id)
				{										
					$id = $function->sql_injection(intval($id));	
					$rs_dele = $Process->get_id($id);	
					$option_id = $rs_dele['option_id'];
					$import_quantity = $rs_dele['import_quantity'];
					$Process->update_coupons_option($option_id,$import_quantity);
					$Process->delete_table($id);
													
				}
			}
			return $function->msg_box_status(msg_box_delete_succ,$msg_time,$_SESSION[$module]['url_views'],1);
		break;
		
	}
}
?>