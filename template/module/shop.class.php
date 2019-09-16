<?php

class Shop
{
    function Shop()
    {
        global $db;

    }

// kiem tra shop bang url
    function check_shop($shop_url)
    {
        global $db;
        $sql = "SELECT shop_url FROM coupons_shop where shop_url  = '$shop_url'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

// lay cac danh muc dang cua thanh vien
    function category_all_shop($user_shop)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT cc.category_name, cc.category_id, cc.category_url, cc.parent_id FROM coupons_category cc, coupons_products cp where cp.news_category=cc.category_id and cp.userid='$user_shop' GROUP BY cc.category_name, cc.category_id, cc.category_url, cc.parent_id";
        //print_r($sql);
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }

// lay thong tin shop
    function get_id_shop($shop_url)
    {
        global $db;
        $sql = "SELECT * FROM coupons_shop where shop_url  = '$shop_url'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }

// menu chinh
    function category_all($parent_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT category_id,category_name,parent_id,status,category_url,link FROM coupons_category where status = '1' and parent_id ='$parent_id' and language ='$language' ORDER BY pos asc	";
        //print_r($sql);
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }
// soi url thanh id
// lay ten danh muc  bang category_url
    function category_name($category_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "Select category_id,category_url,parent_id,category_name,category_content from coupons_category where status = '1' and category_id = '$category_id' and language ='$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }
/// lay san pham
//lay san pham nhieu dieu kien
    function num_all_coupons_coupons($news_category, $parent_id, $status)
    {
        global $db, $function;
        $language = LANG_AUGE;

        if ($news_category == '0') {
            $tem_category = "";
        } else {
            $tem_category = "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $tem_parent_id = "";
        } else {
            $tem_parent_id = "and ca.parent_id ='$parent_id'";
        }

        if ($status == '0') {
            $tem_status = "";
        } else {
            $tem_status = "and cc.status = '$status'";
        }

        $sql = "SELECT cc.news_id,ca.category_id,cc.news_img,cc.news_name,cc.price_new,cc.status,cc.language,cc.price,cc.pos,news_url
				FROM coupons_products cc, coupons_category ca 
				where ca.category_id = cc.news_category and  cc.language = '$language' $tem_category $tem_parent_id $tem_status";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        $db->db_freeresult($res);
        return $rows;
    }

    function show_all_coupons_coupons($page, $per_page, $news_category, $parent_id, $status, $orderby)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $user_shop = $_SESSION["userid_shop"];
        if ($news_category == '0') {
            $tem_category = "";
        } else {
            $tem_category = "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $tem_parent_id = "";
        } else {
            $tem_parent_id = "and ca.parent_id ='$parent_id'";
        }

        if ($status == '0') {
            $tem_status = "";
        } else {
            $tem_status = "and cc.status = '$status'";
        }

        if ($orderby == '0') {
            $tem_orderby = "ORDER BY cc.created_date desc ";
        } else {
            $orderby = "cc." . $orderby;
            $tem_orderby = "ORDER BY $orderby desc, cc.created_date desc ";
        }
        $sql = "SELECT cc.news_id,ca.category_id,cc.news_img,cc.news_name,cc.price_new,cc.price_import,cc.status,cc.language,cc.price,cc.pos,cc.news_url,cc.amount,cc.img_file
				FROM coupons_products cc, coupons_category ca 
				where ca.category_id = cc.news_category and ca.status = 1 and cc.userid = '$user_shop' and  cc.language = '$language' $tem_category $tem_parent_id $tem_status $tem_orderby Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {

            $rows[$i]["news_name_30"] = $function->cutnchar($rows[$i]["news_name"], 32);
            $rows[$i]["news_name_28"] = $function->cutnchar($rows[$i]["news_name"], 25);
            $rows[$i]["news_name_35"] = $function->cutnchar($rows[$i]["news_name"], 35);
            $rows[$i]["news_name_40"] = $function->cutnchar($rows[$i]["news_name"], 40);
            $rows[$i]["news_name_50"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["news_name_55"] = $function->cutnchar($rows[$i]["news_name"], 55);
            $rows[$i]["news_name_60"] = $function->cutnchar($rows[$i]["news_name"], 60);
            $rows[$i]["news_name_65"] = $function->cutnchar($rows[$i]["news_name"], 65);
            $rows[$i]["gia_goc"] = number_format($rows[$i]["price"]);
            $rows[$i]["gia_ban"] = number_format($rows[$i]["price_new"]);
            $rows[$i]["gia_voucher"] = number_format($rows[$i]["price_import"]);
            if ($rows[$i]["price_new"] != 0 and $rows[$i]["price"] != 0) {
                $rows[$i]["tiet_kiem"] = number_format(($rows[$i]["price"] - $rows[$i]["price_new"]) / $rows[$i]["price"] * 100);
            } else {
                $rows[$i]["tiet_kiem"] = 0;
            }

        }
        $db->db_freeresult($res);
        return $rows;
    }

// detail new ten tieu de
    function show_products_detail($news_id)
    {
        global $db, $function;
        /*$sql = "Select news_id,news_name,status,news_img,news_category,news_content,description,news_link,news_url,created_date,userid,price,price_new,amount,img_file from coupons_products where news_id = '$news_id'  ";*/
        $sql = "Select cp.news_id,cp.news_name,cp.status,cp.news_img,cp.news_category,cd.news_content,cd.description,cp.news_link,cp.news_url,cp.created_date,cp.userid,cp.price,cp.price_new,cp.price_import,cp.amount,cp.img_file from coupons_products cp, coupons_description cd where cd.news_id = cp.news_id and cp.news_id = '$news_id'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $rows["title_top"] = $function->cutnchar($rows["news_name"], 100);
        $rows["description_top"] = $function->cutnchar($rows["news_content"], 200);
        $rows["gia_goc"] = number_format($rows["price"]);
        $rows["gia_ban"] = number_format($rows["price_new"]);
        $rows["gia_voucher"] = number_format($rows["price_import"]);
        if ($rows["price_new"] != 0 and $rows["price"] != 0) {
            $rows["tiet_kiem"] = number_format(($rows["price"] - $rows["price_new"]) / $rows["price"] * 100);
        } else {
            $rows["tiet_kiem"] = 0;
        }
        $db->db_freeresult($res);
        return $rows;
    }

// image detail
    function show_coupons_img($product_id)
    {
        global $db;
        $sql = "SELECT t2.* FROM coupons_products t1 , coupons_img t2 where t1.news_id  = t2.product_id and t2.product_id = $product_id  ORDER BY t2.id desc Limit 0,4";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }

// thong tin shop
    function get_id_info_shop($userid)
    {
        global $db;
        $sql = "SELECT cs.* FROM coupons_shop cs where cs.userid  = '$userid'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }

    function get_id_info_users($userid)
    {
        global $db;
        $sql = "SELECT email,mobile,yahoochat,facebook ,address FROM coupons_users where userid  = '$userid'";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }
//////////////////////////////////////////////////////////////////// bai viet tin tuc
//coupons_news lay theo news_category sap xep theo ngay pos
    function num_news_category($news_category)
    {
        global $db, $function;
        $user_shop = $_SESSION["userid_shop"];
        $sql = "SELECT cn.news_id FROM coupons_news cn 
				where cn.status = '1' and cn.news_category = '$news_category' and cn.userid = '$user_shop'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function show_news_category($news_category, $page, $per_page)
    {

        global $db, $function;
        $user_shop = $_SESSION["userid_shop"];
        $sql = "SELECT FROM_UNIXTIME(cn.created_date,'%d/%m/%Y') as time_news, cn.news_id,cn.news_link,cn.news_name,cn.news_name,cn.news_img,cn.news_category,cn.news_content,cn.created_date, cn.price_new, cn.news_url, cn.description FROM coupons_news cn where cn.status = '1' and cn.news_category = '$news_category' and cn.userid = '$user_shop' ORDER BY cn.pos desc, cn.created_date desc Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {

            $rows[$i]["news_name_new"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["news_content_new"] = $function->cutnchar($rows[$i]["news_content"], 280);
            $rows[$i]["created_date_new"] = $rows[$i]["created_date"];
            $rows[$i]["price_new_new"] = number_format($rows[$i]["price_new"], ".", ".", ",");


        }
        $db->db_freeresult($res);
        return $rows;
    }

// chi tiet mot tin theo news_category
    function show_new_detail_category($news_category)
    {
        global $db, $function;
        $user_shop = $_SESSION["userid_shop"];
        $sql = "Select FROM_UNIXTIME(created_date,'%d/%m/%Y') as time_news, news_id,news_name,status,news_img,news_category,news_content,description,news_link,news_url,created_date,userid from coupons_news where news_category = '$news_category' and userid	 = '$user_shop'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $rows["title_top"] = $function->cutnchar($rows["news_name"], 100);
        $rows["description_top"] = $function->cutnchar($rows["news_content"], 200);
        $db->db_freeresult($res);
        return $rows;
    }

// detail new  vslat ten tieu de
    function show_new_detail($news_id)
    {
        global $db, $function;
        $sql = "Select FROM_UNIXTIME(created_date,'%d/%m/%Y') as time_news, news_id, news_name, status, news_img, news_category, news_content,description,news_link,news_url,created_date,userid from coupons_news where news_id = '$news_id'  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $rows["title_top"] = $function->cutnchar($rows["news_name"], 100);
        $rows["description_top"] = $function->cutnchar($rows["news_content"], 200);
        $db->db_freeresult($res);
        return $rows;
    }

//////////////////////////////////// tags
    function show_tags($userid)
    {
        global $db;
        $sql = "Select * from coupons_keyword where userid = '$userid' ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }


}

?>
