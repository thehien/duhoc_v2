<?php

class Cart
{
    function Cart()
    {
        global $db;
    }
//cart ---------------------------------------------------------------
////// kiem tra don hang trong coupons_session
    function check_product_id_member()
    {
        global $db;
        $language = LANG_AUGE;
        $session = session_id();
        $sql = "Select * from coupons_session where session='$session' and language ='$language'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function check_product_in_cart($session, $coupon_id, $option_id)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "Select * from coupons_session where session='$session' and translate_id='$coupon_id' and language='$language'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function add_product_in_cart($session, $translateOrder, $estimate)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "Insert Into coupons_session(id,session,product_id,translate_id,estimate,amount,language,option_id,option_name) 
		Values(NULL,'$session',0,'$translateOrder','$estimate',0,'$language',0,0)";
        $res = $db->db_query($sql);
        return 1;
    }

    function update_product_in_cart($session, $coupon_id, $option_id)
    {
        global $db;
        $sql = "Update coupons_session set amount = amount + 1 where session = '$session' and product_id = '$coupon_id' and option_id = '$option_id'";
        $res = $db->db_query($sql);
        return 1;
    }

    function update_lang_in_cart($session, $param, $language, $translateOrder)
    {
        global $db;
        $sql = "Update coupons_session set $param = '$language' where session = '$session' and translate_id = $translateOrder";
        echo "<pre>";
        var_dump($sql);
        echo "<pre>";
        $res = $db->db_query($sql);
        return 1;
    }

    function delete_cart($session)
    {
        global $db;
        $sql = "DELETE FROM coupons_session where session = '$session'";
        $res = $db->db_query($sql);
        return 1;
    }

    function delete_language_order($session)
    {
        global $db;
        $sql = "DELETE FROM coupons_language_order where session = '$session'";
        $res = $db->db_query($sql);
        return 1;
    }

    function delete_translate_order($session)
    {
        global $db;
        $sql = "DELETE FROM coupons_translate_order where session = '$session'";
        $res = $db->db_query($sql);
        return 1;
    }

    function get_coupons_option($option_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "Select option_name,option_id from coupons_option where option_id = '$option_id'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }

    function get_option_news_id($news_id)
    {
        global $db, $function;
        $sql = "Select option_name,option_id from coupons_option where news_id = '$news_id' and status = 0";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }

//shopping ---------------------------------------------------------------
    function check_cart_session($session)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "Select * from coupons_session where session='$session' and language ='$language'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function show_cart_coupons($session)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "Select cs.*, tr.*, csc.category_name
		from coupons_session cs, coupons_translate_order tr, coupons_special_category csc where cs.translate_id = tr.id and csc.id=tr.special_category and cs.session='$session' and cs.language ='$language' 
		ORDER BY cs.id desc ";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format((float)$rows[$i]["price"], 2, ',', '.');
        }
        $db->db_freeresult($res);
        return $rows;
    }

    function update_amount($id_ss, $amount)
    {
        global $db;
        $sql = "Update coupons_session set amount = '$amount' where id = '$id_ss'";
        $res = $db->db_query($sql);
        return 1;
    }

    function get_amount($id_ss)
    {
        global $db;
        $sql = "Select amount from coupons_session where id = '$id_ss'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function remove_cart($cartid, $session)
    {
        global $db;
        $sql = "Delete From coupons_session where session = '$session' and id = '$cartid'";
        $res = $db->db_query($sql);
        return 1;
    }

    function num_sl($page, $per_page)
    {
        global $db, $function;
        $sql = "SELECT news_id FROM coupons_products Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["vitri"] = $i + 1;
        }
        return $rows;
    }

    function show_priority($page, $per_page)
    {
        global $db;
        $sql = "SELECT * FROM coupons_cities where status ='1' ORDER BY cityid asc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }

    function show_coupons_district($page, $per_page, $priority)
    {
        global $db;
        $sql = "SELECT * FROM coupons_district where status ='1' and  cityid = '$priority' ORDER BY district_name asc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }

// instal order_detail
    function add_table_purchase($userid_u, $thanhtoan, $address, $firstname, $mobile, $note, $email)
    {

        global $db, $smarty, $function;
        $oMember = new Member;
        $language = LANG_AUGE;
        $session = $_SESSION[URL_HOME]["Shopping"];
        $coupon_validityid = rand(111111, 999999);
        $_SESSION[URL_HOME]["coupon_validityid"] = $coupon_validityid;
        $coupon_date = time();

        if ($userid_u == "" or $userid_u == '0') {
            $userid_u = '10';
        }
        $sql_ssid = "Select cs.*, cp.* from coupons_session cs, coupons_products cp  
		where session='$session' and cp.news_id = cs.product_id and cs.language ='$language'";

        $res_ssid = $db->db_query($sql_ssid);
        $rows_ssid = $db->db_fetchrowset($res_ssid);
        $coupon_userid = $function->sql_injection($userid_tem);

        for ($j = 0; $j < count($rows_ssid); $j++) {

            $couponid = $rows_ssid[$j]["product_id"];
            $money = $rows_ssid[$j]["price"];
            $news_name = $rows_ssid[$j]["news_name"];
            $coupon_status = 1;
            $coupon_code = $couponid . "-" . $coupon_validityid . "-" . $quality;
            // insert
            $sql[$i] = "INSERT INTO coupons_purchase (
			coupon_id,money,coupon_userid,coupon_status,
			coupon_code,coupon_date,thanhtoan,address,firstname,mobile,coupon_note,
			news_name,email,language
			)

			VALUES('$couponid','$money','$userid_u','$coupon_status',
			'$coupon_code','$coupon_date','$thanhtoan','$address',
			'$firstname','$mobile','$note','$news_name','$email',
			'$language'
		)";

            $res = $db->db_query($sql[$i]);
        }
        return 1;

    }


    function update_accept_translate($coupon_id, $translater_id)
    {
        global $db;
        $order_date = time();
        $sql = "Update coupons_orders set translater_id = '$translater_id', order_date = '$order_date' where coupon_code = '$coupon_id'";
        $res = $db->db_query($sql);
        return 1;
    }


    function update_table_orders_active($coupon_code, $payment_type)
    {
        global $db;
        $sql = "Update coupons_orders set coupon_status = '$payment_type', order_status = '$payment_type' where coupon_code = '$coupon_code'";

        $res = $db->db_query($sql);
        return 1;
    }

    // instal coupons_orders
    function add_table_orders(
        $userid_u,
        $option_payment,
        $country,
        $address,
        $mobile,
        $fullname,
        $mobileCode,
        $email,
        $total_prices,
        $total_words,
        $payment_type,
        $coupon_code,
        $translate_id
    ) {
        global $db, $smarty, $function;
        $oMember = new Member;
        $language = LANG_AUGE;
        $session = $_SESSION[URL_HOME]["Shopping"];

        // ma Don hang
        if ($payment_type == 2) {
            $coupon_status = 2;
        } else {
            $coupon_status = 1;
        }

        $coupon_date = time();
        if ($userid_u == "" or $userid_u == '0') {
            $userid_u = '10';
        }

        $sql_ssid = "Select cto.*, cs.estimate from coupons_translate_order cto inner join coupons_session cs where cto.id = $translate_id and cs.translate_id = cto.id";

        $res_ssid = $db->db_query($sql_ssid);
        $rows_ssid = $db->db_fetchrowset($res_ssid);

        $nums_ss = $db->db_numrows($res_ssid);
        if ($nums_ss > 0) {
            for ($j = 0; $j < count($rows_ssid); $j++) {

                $translate_id = $rows_ssid[$j]["id"];
                $file_translate = $rows_ssid[$j]["file_translate"];
                $file_zip = $rows_ssid[$j]["file_zip"];
                $count_text = $rows_ssid[$j]["count_text"];
                $price = $rows_ssid[$j]["price"];
                $special_category = $rows_ssid[$j]["special_category"];
                $message = $rows_ssid[$j]["message"];
                $estimate = $rows_ssid[$j]["estimate"];

                $sql[$j] = "INSERT INTO coupons_orders_detail(coupon_code,translate_id,file_translate,file_zip,count_text,price,special_category,message,estimate)
			VALUES	('$coupon_code','$translate_id','$file_translate','$file_zip','$count_text','$price','$special_category','$message','$estimate')";
                $res = $db->db_query($sql[$j]);

                $sql_orders[$j] = "INSERT INTO coupons_orders(total_prices,total_words,coupon_userid,coupon_status,coupon_code,coupon_date,payment,
		address,fullname,mobile,mobile_code,country,email,language)
		VALUES
		('$price','$count_text','$userid_u','$coupon_status','$coupon_code','$coupon_date','$option_payment','$address','$fullname','$mobile','$mobileCode','$country','$email','$language')";
                $res_orders = $db->db_query($sql_orders[$j]);
            }
            return 1;
        }
    }

    function views_coupon_request($translate_id)
    {
        global $db, $function;
        $sql = "SELECT translate_id FROM coupons_orders_detail where translate_id  = '$translate_id'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }

    function add_notices_order($order_id, $user_id, $contentNotices)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "insert into coupons_notices (id,order_id,user_id,content,language) 
	values(NULL,'$order_id','$user_id','$contentNotices','$language')";
        //echo $sql;
        $res = $db->db_query($sql);
        return 1;
    }

    function add_notices_trans_order($order_id, $user_id, $contentNotices, $isComplete = false)
    {
        global $db;
        $language = LANG_AUGE;
        if ($isComplete) {
            $sql = "insert into coupons_translater_notices (id,accept_id,translater_id,content, is_complete,language) 
		values(NULL,'$order_id','$user_id','$contentNotices','$isComplete','$language')";
        } else {
            $sql = "insert into coupons_translater_notices (id,accept_id,translater_id,content,language) 
		values(NULL,'$order_id','$user_id','$contentNotices','$language')";
        }

        $res = $db->db_query($sql);
        return 1;
    }


}

?>
