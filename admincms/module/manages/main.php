<?php
function manages_process()
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
	$displays = $function->sql_injection(isset($_GET['displays']) ? $_GET['displays'] : ""); 
	$submit = $function->sql_injection(isset($_POST['submit']) ? $_POST['submit'] : "");

	$Process = new Manages_class;
	$url = $function->sql_injection($main_url);
	$file = $function->sql_injection($main_url);
	$smarty->assign("url",$url);
	$smarty->assign("main_name",$main_name);
	$smarty->assign("main_content",$main_content);
	
	$class_cate = new categorys_class;
	$tree_select = $class_cate->select_tree_arrays(0,1);
	$smarty->assign('tree_select',$tree_select);
	// shop
	$rs_shop = $Process->show_list_shop();	
	$smarty->assign("rs_shop",$rs_shop);
	// City
	$rs_city = $Process->show_all_city(1);			
	$smarty->assign("rs_city", $rs_city);
		
	switch($main)
	{
		case "search":
			$name_search = $function->sql_injection(isset($_POST['name_search']) ? $_POST['name_search'] : "");
			$_SESSION[$url]['name_search'] = $name_search;
			
			$smarty->assign("main_search",$main);
			if($_SESSION[$module]['url_views']){$function->goto_url($_SESSION[$module]['url_views']);}
			else{$function->goto_url(URL_ADMIN."?module={$url}&main=views");}
		break;	
		case "unsession":
			$Process->update_info_coupons_option();
			unset($_SESSION[$url]['name_search']);
			$smarty->assign("main_search","search");
			$function->goto_url(URL_ADMIN."?module={$url}&main=views");
		break;	
		case "views":
		default:
		if($action_views == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			$_SESSION[$module]['url_views'] =$function->FixQuotes($_SERVER['REQUEST_URI']);
			$smarty->assign("url_views", URL_ADMIN."?module={$url}&main=views");
			$name_search = $function->sql_injection(isset($_SESSION[$url]['name_search']) ? $_SESSION[$url]['name_search'] : "");
			$smarty->assign("name_search",$name_search);
			$url_limit = ''; $url_order = ''; $url_category = '';$url_shops = ''; $base_url ='';
			if($limit){$smarty->assign("url_limit","&limit=$limit"); $url_limit ="&limit=$limit";}
			if($order){$smarty->assign("url_order","&order=$order&sc=$sc"); $url_order="&order=$order&sc=$sc";}
			if($category){$smarty->assign("url_category","&category=$category"); $url_category="&category=$category";}
			if($shops){$smarty->assign("url_shops","&shops=$shops"); $url_shops="&shops=$shops";}
			
			if($displays)
			{
				$smarty->assign("url_displays","&displays=$displays");
				$url_displays="&displays=$displays";
				$smarty->assign("displays",$displays);
			}
			else
			{
				$smarty->assign("url_displays","&displays=news_id"); 
				$url_displays=""; 
				$smarty->assign("displays","news_id");
			}
			
			$numf = $Process->num_views($name_search,$category,$shops);
			if($numf)
			{
				if($page ==""){$page =0;}
				if($limit==""){$limit=10;}
				$per_page = $limit;
				$all_page = $numf ? $numf : 1; 			
				$base_url = URL_ADMIN."?module={$url}&main=views{$url_limit}{$url_order}{$url_category}{$url_shops}{$url_displays}";
				$url_last = "";		
				$paging = $function->generate_page_cms($base_url,$url_last,$all_page,$per_page,$page);
				$rs = $Process->views_table($page,$per_page,$order,$sc,$name_search,$category,$shops);			
				$smarty->assign("paging",$paging);
				$smarty->assign("numf",$numf);
				$smarty->assign("rs",$rs);
			}
			
			//Nhap kho	
			$rs_edit = $Process->get_coupons_option($id_edit);								
			$smarty->assign("rs_edit",$rs_edit);
			$_SESSION[$module]['base_url'] =$base_url;
			return $smarty->fetch("{$file}/views.html");
		break;	
		
		case "insert":
		if($action_insert == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			if($submit)
			{
				$data['info']['option_id'] = $function->sql_injection(isset($_POST['option_id']) ? intval($_POST['option_id']) : 0);
				$data['info']['news_id'] = $function->sql_injection(isset($_POST['news_id']) ? intval($_POST['news_id']) : 0);
				$data['info']['import_quantity'] = $function->sql_injection(isset($_POST['import_quantity']) ? intval($_POST['import_quantity']) : 0);
				$data['info']['import_note'] = $function->sql_injection(isset($_POST['import_note']) ? $_POST['import_note'] : "");
				
				$data['info']['import_price'] = $function->to_character_price(isset($_POST['import_price']) ? $_POST['import_price'] : 0);
				if(LANG_AUGE_CMS == 0){$data['info']['import_price'] = round($data['info']['import_price']+499,-3);}

				$data['info']['language'] = LANG_AUGE_CMS;
				if($data['info']['import_quantity']=="")
				{return $function->msg_box_status(msg_box_erro_info,$msg_time,$_SESSION[$module]['base_url'],2);}											
				else
				{	
					$Process->insert_coupons_import($data['info']);
					$Process->update_coupons_option($data['info']);
					$Process->update_coupons_products($data['info']);
					return $function->msg_box_status(msg_box_import,$msg_time,$_SESSION[$module]['base_url'],1);	
				}
			}
			else	
			{
				$function->goto_url($_SESSION[$module]['base_url']);
			}
		break;
		
	}
}
?>