<?php
function modules_process()
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
	$submit = $function->sql_injection(isset($_POST['submit']) ? $_POST['submit'] : "");
	
	if($_SESSION[URL_ADMIN]["userid"] == 1)
	{
		$action_views='views'; $smarty->assign("action_views",$action_views);
		$action_insert='insert'; $smarty->assign("action_insert",$action_insert);
		$action_edit='edit'; $smarty->assign("action_edit",$action_edit);
		$action_delete='delete'; $smarty->assign("action_delete",$action_delete);
		$main_url = "modules";
	}
	
	$Process = new modules_class;
	$url = $function->sql_injection($main_url);
	$file = $function->sql_injection($main_url);
	$smarty->assign("url",$url);
	$smarty->assign("main_name",$main_name);
	$smarty->assign("main_content",$main_content);
	
	$tree_select = $Process->select_tree_arrays($id_edit);
	$smarty->assign('tree_select',$tree_select);
	switch($main)
	{
		case "search":
			$name_search = $function->sql_injection(isset($_POST['name_search']) ? $_POST['name_search'] : "");
			$_SESSION[$url]['name_search'] = $name_search;
			
			$smarty->assign("main_search",$main);
			if($_SESSION[$module]['url_views']){$function->goto_url($_SESSION[$module]['url_views']);}
			else{$function->goto_url(URL_ADMIN."?module={$url}&main=views");}
		break;	
		case "views":
		default:
		if($action_views == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
		$_SESSION[$module]['url_views'] =$function->FixQuotes($_SERVER['REQUEST_URI']);
			$smarty->assign("url_views", URL_ADMIN."?module={$url}&main=views");
			$name_search = $function->sql_injection(isset($_SESSION[$url]['name_search']) ? $_SESSION[$url]['name_search'] : "");
			$smarty->assign("name_search",$name_search);
			if($order){$smarty->assign("url_order","&order=$order&sc=$sc");}
			
			$rs_tree = $Process->views_tree_arrays($name_search,$order,$sc);
			$smarty->assign('rs_tree',$rs_tree);
			
			if($id_edit){$smarty->assign("url_edit","&id_edit=$id_edit");}
			$rs_edit = $Process->get_id($id_edit);								
			$smarty->assign("rs_edit",$rs_edit);
			
			return $smarty->fetch("{$file}/views.html");
		break;	
		case "insert":
		if($action_insert == '' and $action_edit == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			if($submit)
			{
				$data['info']['name'] = $function->sql_injection(isset($_POST['name']) ? $_POST['name'] : "");
				$data['info']['parent'] = $function->sql_injection(isset($_POST['parent']) ? $_POST['parent'] : "");
				$data['info']['link'] = $function->sql_injection(isset($_POST['link']) ? $_POST['link'] : "");
				$data['info']['icon'] = $function->sql_injection(isset($_POST['icon']) ? $_POST['icon'] : "");
				$data['info']['content'] = $function->FixQuotes(isset($_POST['content']) ? $_POST['content'] : "");
				$data['info']['pos'] = $function->FixQuotes(isset($_POST['pos']) ? intval($_POST['pos']) : 0);
				$data['info']['status'] = $function->FixQuotes(isset($_POST['status']) ? intval($_POST['status']) : 0);

				if($data['info']['name']=="")
				{return $function->msg_box_status(msg_box_erro_info,$msg_time,$_SESSION[$module]['url_views'],2);}											
				else
				{	
					if($id_edit)
					{
						$Process->edit_table($id_edit,$data['info']);
						return $function->msg_box_status(msg_box_edit_succ,$msg_time,$_SESSION[$module]['url_views'],1);
					}
					else
					{
						$Process->insert_table($data['info']);
						return $function->msg_box_status(msg_box_insert_succ,$msg_time,$_SESSION[$module]['url_views'],1);	
					}
				}
			}
			else	
			{
				$function->goto_url($_SESSION[$module]['url_views']);
			}
		break;
		case "update_order":
		if($action_edit == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			$check = $_POST['checkbox_id'];
			if($check != null){
				foreach($check as $id){										
					$pos = $function->sql_injection($_POST['pos'.$id]); 
					$link = $function->sql_injection($_POST['link'.$id]); 
					$icon = $function->sql_injection($_POST['icon'.$id]);
					$id = $function->sql_injection(intval($id));	
					$Process->update_order_table($id,$pos,$link,$icon);		
				}
			}
			return $function->msg_box_status(msg_box_edit_succ,$msg_time,$_SESSION[$module]['url_views'],1);
		break;
		
		case "delete": 
		if($action_delete == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			$check = $_POST['checkbox_id'];							
			if($check != null)
			{
				foreach($check as $id)
				{										
					$checks = $Process->check_delete($id);
					$checks_parent = $Process->check_delete_parent($id);
					if ($checks > 0){return $function->msg_box_status(msg_box_erro_status,$msg_time,$_SESSION[$module]['url_views'],2);}
					elseif ($checks_parent > 0){return $function->msg_box_status(msg_box_erro_parent,$msg_time,$_SESSION[$module]['url_views'],2);}
					else
					{										
						$id = $function->sql_injection(intval($id));										
						$Process->delete_table($id);
					}								
				}
			}
			return $function->msg_box_status(msg_box_delete_succ,$msg_time,$_SESSION[$module]['url_views'],1);
		break;
		case "status": 
		if($action_edit == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			$id = $function->sql_injection($_GET['id']);
			$status = $function->sql_injection($_GET['status']);
			if($status == 1)
			{
				$Process->status_table($id,0);
			}
			else
			{
				$Process->status_table($id,1);
			}							
			return $function->msg_box_status(msg_box_status_succ,$msg_time,$_SESSION[$module]['url_views'],1);							
		break;		
		case "status_off": 
		if($action_edit == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			$check = $_POST['checkbox_id'];							
			if($check != null)
			{
				foreach($check as $id)
				{										
					$id = $function->sql_injection(intval($id));										
					$Process->status_off_table($id);		
				}
			}
			return $function->msg_box_status(msg_box_status_succ,$msg_time,$_SESSION[$module]['url_views'],1);
		break;
		case "status_on": 
		if($action_edit == ''){return $function->msg_box_status(msg_box_action,$msg_time,URL_ADMIN."?module=homes",2);}
			$check = $_POST['checkbox_id'];							
			if($check != null)
			{
				foreach($check as $id)
				{										
					$id = $function->sql_injection(intval($id));										
					$Process->status_on_table($id);		
				}
			}
			return $function->msg_box_status(msg_box_status_succ,$msg_time,$_SESSION[$module]['url_views'],1);
		break;
		
	}
}
?>