<?php
function homes()
{
	global $db, $smarty, $function;	
	$Process = new Homes_class;
	
	$orders_all = $Process->report_coupons_orders();
	$smarty->assign("orders_all",$orders_all);
	$orders_news = $Process->report_coupons_orders(1);
	$smarty->assign("orders_news",$orders_news);
	$orders_2 = $Process->report_coupons_orders(2);
	$smarty->assign("orders_2",$orders_2);
	$orders_3 = $Process->report_coupons_orders(3);
	$smarty->assign("orders_3",$orders_3);
	$orders_4 = $Process->report_coupons_orders(4);
	$smarty->assign("orders_4",$orders_4);
	$orders_5 = $Process->report_coupons_orders(5);
	$smarty->assign("orders_5",$orders_5);

	
	$comment_news = $Process->report_coupons_comment(0);
	$smarty->assign("comment_news",$comment_news);
	
	$support_news = $Process->report_coupons_support(0);
	$smarty->assign("support_news",$support_news);
	
	$faq_news = $Process->report_coupons_faq(0);
	$smarty->assign("faq_news",$faq_news);
	
	
	$products_all = $Process->report_coupons_products();
	$smarty->assign("products_all",$products_all);
	$users_all = $Process->report_coupons_users();
	$smarty->assign("users_all",$users_all);
	$news_all = $Process->report_coupons_news();
	$smarty->assign("news_all",$news_all);
	$keyword_all = $Process->report_coupons_keyword();
	$smarty->assign("keyword_all",$keyword_all);
	$shop_all = $Process->report_coupons_shop();
	$smarty->assign("shop_all",$shop_all);
	
	$property_all = $Process->report_property();
	$smarty->assign("property_all",$property_all);
	
	$one_all = $Process->report_filter_one();
	$smarty->assign("one_all",$one_all);
	$two_all = $Process->report_filter_two();
	$smarty->assign("two_all",$two_all);
	$three_all = $Process->report_filter_three();
	$smarty->assign("three_all",$three_all);
	$four_all = $Process->report_filter_four();
	$smarty->assign("four_all",$four_all);
	
	
	return $smarty->fetch("welcome.html");	
}
?>