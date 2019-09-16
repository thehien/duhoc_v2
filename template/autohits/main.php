<?php
function autohits_process_client()
	{
		
			global $db, $smarty, $function;
			$oMarketing =  new Marketing;
			$str = $function->sql_injection(isset($_GET['cmd']) ? $_GET['cmd'] : "");
			$arr_str = explode("_",$str);
			$a  = $function->sql_injection($arr_str[0]);
			
			$fresh_time = 20 + rand(20,30);
			$smarty->assign("fresh_time",$fresh_time);
			// member
			$arr_url = explode("=",$_SERVER['REQUEST_URI']);
			$id_user  = $function->sql_injection($arr_url[1]);
			$id_user_click  = $function->sql_injection($arr_url[2]);
			$smarty->assign("id_user",$id_user);
			
			$link_web = $_SERVER['REQUEST_URI'];
			$smarty->assign("link_web", $link_web);
			
			switch(strtolower($a))
			{							
					case "home": 
						if($id_user != "")
						{	
							$time = time();
							$time_secs = 500; // 60 = 1p
							$time_out = $time - $time_secs; 
							// link hits
							$link_hits = $oMarketing->show_link_hits($id_user);
							$smarty->assign("link_hits_rs",$link_hits);
							$smarty->assign("link_hits",$link_hits["0"]["link"]);
							// danh sach link
							$link_all = $oMarketing->show_all_link_hits($id_user);
							$smarty->assign("link_all",$link_all);
							 
							return $smarty->fetch("autohits/index.html");		
						}
						else
					 	{
							$function->goto_url(URL_HOMEPAGE."member/register.html");	
						}									
					break;
				
					case "forum": 
						$category = $function->sql_injection($arr_url[1]);
						$smarty->assign("category",$category);
						
						$num_ca= $oMarketing->num_seo_category($category);
						if($num_ca == '0')
						{
							$rs= $oMarketing->show_marketing(0,1,$category,0);
							$smarty->assign("rs",$rs);
						}
						else
						{
							$rs= $oMarketing->show_marketing(0,1,0,$category);
							$smarty->assign("rs",$rs);
						}
						
						$rs_seo= $oMarketing->show_keyword_seo($category);
						$smarty->assign("rs_seo",$rs_seo);
						
						return $smarty->fetch("autohits/forum.html");	
					break;
					
					case "forumup": 
						$category = $function->sql_injection($arr_url[1]);
						$smarty->assign("category",$category);
						
						$num_ca= $oMarketing->num_seo_category($category);
						if($num_ca == '0')
						{
							$rs= $oMarketing->show_marketing(0,1,$category,0);
							$smarty->assign("rs",$rs);
						}
						else
						{
							$rs= $oMarketing->show_marketing(0,1,0,$category);
							$smarty->assign("rs",$rs);
						}
						return $smarty->fetch("autohits/forumup.html");	
					break;
					
					case "seo": 
						$rs= $oMarketing->category_all_seo(0,0,0,100);
						$smarty->assign("rs",$rs);
						return $smarty->fetch("autohits/seo.html");		
					break;
					
					case "email":
						$num_send= $oMarketing->show_num_send();
						$smarty->assign("num_send",$num_send["num_send"]);
						$num_to= $oMarketing->show_num_to();
						$smarty->assign("num_to",$num_to["num_to"]);
						
						$smarty->assign("lang_website",lang_website);
						$smarty->assign("lang_phone",lang_phone);
						$smarty->assign("lang_hotine",lang_hotine);
						$smarty->assign("lang_dia_chi",lang_dia_chi);
						$smarty->assign("lang_cong_ty",lang_cong_ty);
						$smarty->assign("lang_email",lang_email);
						
						// noi dung mail
						$rs_mail= $oMarketing->mail_coupons_keyword($id_user);
						$smarty->assign("rs_mail",$rs_mail);
				
						// email gui
						$rs_from= $oMarketing->get_email_from($id_user);
						if ($rs_from["username"] !="")
						{
							$oMarketing->update_time_email_from($rs_from["id"],$rs_from["day_month"]);
							$smarty->assign("email_from",$rs_from["username"]);
							// email nhan
							$rs_to= $oMarketing->get_email_to();
							$oMarketing->update_status($rs_to["id"]);
							$smarty->assign("email_to",$rs_to["email"]);
							
							$port = $rs_from["port"];
							$host = $rs_from["host"];
							$username = $rs_from["username"]; 
							$password = $rs_from["password"];
							$smtp = $rs_from["smtp"]; 
							
							$to = $rs_to["email"];
							$from = $rs_from["username"]; 
							$subject = $rs_mail["keyword"];
							$from_name =$rs_from["firstname"]; 
							$body = $smarty->fetch("autohits/marketing.html");
							$function->smtpmailer_marketing($to,$from,$from_name,$subject,$body,$port,$host,$username,$password,$smtp); 
							return $smarty->fetch("autohits/email.html");
						}
						else
						{		
							$smarty->assign("thong_bao","Stop Email Marketing");
							return $smarty->fetch("autohits/email.html");
						}			
					break;
					
			}
	}
	
	
?>