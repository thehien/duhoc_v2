<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////-----------------------------coupons_category 2 language----------------------------////////////////////
class News
{
    function News()
    {
        global $db;
    }
    //////////////////////////////////////////////// kiem tra doi link doi id = url
    //kiem tra parent_id
    function num_parent_id($parent_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT cc.category_id FROM coupons_category cc where cc.status = '1' and cc.parent_id = '$parent_id' and cc.language ='$language'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }

    // kiem tra muc con url
    function check_category_url($category_url)
    {
        global $db;
        $sql = "SELECT category_url FROM coupons_category where category_url  = '$category_url'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        $db->db_freeresult($res);

        return $rows;
    }

    function get_list_new_home($category_id, $page, $per_page, $status_slide = null, $status_home = null)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if (!$category_id) {
            $sr .= "";
        } else {
            $sr .= "and news_category IN ($category_id) ";
        }
        if (!$status_slide) {
            $sr .= " ";
        } else {
            $sr .= "and status_slide = 1 ";
        }

        if (!$status_home) {
            $sr .= " ";
        } else {
            $sr .= "and status_home = 1 ";
        }

        $sql = "SELECT news_id, news_url, news_name, news_img, news_content, FROM_UNIXTIME(created_date,'%d/%m/%Y %h:%i') as time_news ";
        $sql .= "FROM coupons_news where status = '1' and language ='$language' $sr 
        ORDER BY pos asc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_limit"] = $function->cutnchar($rows[$i]["news_name"], 100);
            $rows[$i]["full_news_name"] = $function->cutnchar($rows[$i]["news_name"], 10000);
        }
        return $rows;
    }

    function get_list_industry_content($category_id, $page, $per_page, $status_slide = null, $status_home = null)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if (!$category_id) {
            $sr .= "";
        } else {
            $sr .= "and news_category IN ($category_id) ";
        }
        if (!$status_slide) {
            $sr .= " ";
        } else {
            $sr .= "and status_slide = 1 ";
        }

        if (!$status_home) {
            $sr .= " ";
        } else {
            $sr .= "and status_home = 1 ";
        }

        $sql = "SELECT news_id, news_url, news_name, news_img, news_content, FROM_UNIXTIME(created_date,'%d/%m/%Y %h:%i') as time_news ";
        $sql .= "FROM coupons_contents where status = '1' and language ='$language' $sr 
        ORDER BY news_id desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_limit"] = $function->cutnchar($rows[$i]["news_name"], 60);
            $rows[$i]["news_content_limit"] = strip_tags($function->cutnchar($rows[$i]["news_content"], 200),'<b>');
            $rows[$i]["full_news_name"] = $function->cutnchar($rows[$i]["news_name"], 10000);
        }
        return $rows;
    }

    function count_list_industry_content($category_id, $status_slide = null, $status_home = null)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if (!$category_id) {
            $sr .= "";
        } else {
            $sr .= "and news_category IN ($category_id) ";
        }
        if (!$status_slide) {
            $sr .= " ";
        } else {
            $sr .= "and status_slide = 1 ";
        }

        if (!$status_home) {
            $sr .= " ";
        } else {
            $sr .= "and status_home = 1 ";
        }

        $sql = "SELECT news_id, news_url, news_name, news_img, news_content, FROM_UNIXTIME(created_date,'%d/%m/%Y %h:%i') as time_news ";
        $sql .= "FROM coupons_contents where status = '1' and language ='$language' $sr 
        ORDER BY pos asc";

        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function get_list_blog($category_id, $page, $per_page)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if (!$category_id) {
            $sr .= "";
        } else {
            $sr .= "and news_category = $category_id ";
        }

        $sql = "SELECT news_id, news_url, news_name, news_img, news_content, FROM_UNIXTIME(created_date,'%d/%m/%Y %h:%i') as time_news ";
        $sql .= "FROM coupons_blogs where status = '1' and language ='$language' $sr 
        ORDER BY pos asc Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_limit"] = $function->cutnchar($rows[$i]["news_name"], 60);
            $rows[$i]["news_content_limit"] = strip_tags($function->cutnchar($rows[$i]["news_content"], 250),'');
            $rows[$i]["news_content_limit_1"] = strip_tags($function->cutnchar($rows[$i]["news_content"], 450),'');
            $rows[$i]["full_news_name"] = $function->cutnchar($rows[$i]["news_name"], 10000);
        }
        return $rows;
    }

    function get_detail_blog_content($content_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';

        $sql = "SELECT news_id, news_url, news_name, news_img, news_content, description, FROM_UNIXTIME(created_date,'%d/%m/%Y %h:%i') as time_news ";
        $sql .= "FROM coupons_blogs where status = '1' and news_id = $content_id and language ='$language' $sr 
        ORDER BY pos asc";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function get_detail_industry_content($content_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';

        $sql = "SELECT news_id, news_url, news_name, news_img, news_content, news_tags, description, FROM_UNIXTIME(created_date,'%d/%m/%Y %h:%i') as time_news ";
        $sql .= "FROM coupons_contents where status = '1' and news_id = $content_id and language ='$language' $sr 
        ORDER BY pos asc";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_limit"] = $function->cutnchar($rows[$i]["news_name"], 100);
            $rows[$i]["news_content_limit"] = $function->cutnchar($rows[$i]["news_content"], 200);
            $rows[$i]["full_news_name"] = $function->cutnchar($rows[$i]["news_name"], 10000);
        }
        return $rows;
    }

    function get_slide_industry_content($category_id, $page, $per_page, $status_slide = null)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if (!$category_id) {
            $sr .= "";
        } else {
            $sr .= "and news_category IN ($category_id) ";
        }
        if (!$status_slide) {
            $sr .= " ";
        } else {
            $sr .= "and status_slide = 1 ";
        }

        $sql = "SELECT news_id, news_url, news_name, news_img, news_content, FROM_UNIXTIME(created_date,'%d/%m/%Y %h:%i') as time_news ";
        $sql .= "FROM coupons_contents where status = '1' and language ='$language' $sr 
        ORDER BY pos asc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_limit"] = $function->cutnchar($rows[$i]["news_name"], 100);
            $rows[$i]["full_news_name"] = $function->cutnchar($rows[$i]["news_name"], 10000);
        }
        return $rows;
    }

    function get_list_cate_study_abroad()
    {
        global $db, $function;
        $language = LANG_AUGE;

        $sql = "SELECT * ";
        $sql .= "FROM list_cate_study_abroad where status = '1' and language ='$language' ORDER BY id asc limit 100";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["service_name_limit"] = $function->cutnchar($rows[$i]["service_name"], 70);
            $rows[$i]["service_content_limit"] = strip_tags($function->cutnchar($rows[$i]["service_content"], 250),'');
        }
        return $rows;
    }

    function get_translator_service_by_id($id)
    {
        global $db, $function;
        $language = LANG_AUGE;

        $sql = "SELECT * ";
        $sql .= "FROM list_cate_study_abroad where status = '1' and id=$id and language ='$language' ORDER BY id asc limit 100";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["service_name_limit"] = $function->cutnchar($rows[$i]["service_name"], 70);
            $rows[$i]["service_content_limit"] = strip_tags($function->cutnchar($rows[$i]["service_content"], 250),'');
        }
        return $rows;
    }

    function get_list_service_content($service_id, $limited)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';

        $sql = "SELECT news_id, news_url, news_name, news_img, news_content, FROM_UNIXTIME(created_date,'%d/%m/%Y %h:%i') as time_news ";
        $sql .= "FROM list_content_study_abroad where status = '1' and news_category = $service_id and language ='$language' $sr 
        ORDER BY pos asc limit $limited";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_limit"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["full_news_name"] = $function->cutnchar($rows[$i]["news_name"], 10000);
            $rows[$i]["news_content_limit"] = strip_tags($function->cutnchar($rows[$i]["news_content"], 200),'');
        }
        return $rows;
    }

    // Get data content of category
    function get_category_content($category_id)
    {
        global $db;
        if (is_array($category_id)) {
            $sql = "SELECT category_name, category_content, category_img 
        FROM coupons_category where category_id  in (".implode(',', $category_id).")";
        } else {
            $sql = "SELECT category_name, category_content, category_img 
        FROM coupons_category where category_id  = '$category_id'";
        }
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    // Get data content of category
    function get_sub_list_category($parent_id)
    {
        global $db;
        $sql = "SELECT category_name, category_content, category_img FROM coupons_category where parent_id  = '$parent_id'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    // Get list team
    function get_list_team($parent_id)
    {
        global $db;
        $sql = "SELECT news_id, news_name, news_content, news_img, description FROM coupons_team where news_category  = '$parent_id'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function get_all_list_experience()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_experience where language=$language order by id asc ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    // kiem tra muc con url
    function get_all_language($offset = null, $limit = null)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_languages where language=$language order by id asc ";

        if (($offset == 0 || $offset > 0) && $limit) {
            $sql .= "limit $offset , $limit";
        }
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    // kiem tra muc con url
    function get_list_study_abroad($limit = null)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_cate_study_abroad where language=$language order by id asc ";
        if ($limit) {
            $sql .= "limit $limit";
        }
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["service_name_limit"] = $function->cutnchar($rows[$i]["service_name"], 70);
            $rows[$i]["service_content_limit"] = strip_tags($function->cutnchar($rows[$i]["service_content"], 250),'');
        }

        return $rows;
    }

    // kiem tra muc con url
    function get_list_news_category($limit = null)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_news_category where language=$language order by category_id asc ";
        if ($limit) {
            $sql .= "limit $limit";
        }
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["category_name_limit"] = $function->cutnchar($rows[$i]["category_name"], 70);
            $rows[$i]["category_content_limit"] = strip_tags($function->cutnchar($rows[$i]["category_content"], 250),'');
        }

        return $rows;
    }


    // kiem tra muc con url
    function get_all_software()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_software where language=$language order by id asc ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }


    // kiem tra muc con url
    function get_all_translater()
    {
        global $db, $function;
        $sql = "SELECT * FROM coupons_translater where status = 1 ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        $imgPath = URL_HOME . '/' . IMG_TRANSLATER . '/';
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_img"] = URL_HOME . '/timthumb.php?src=' . $imgPath . $rows[$i]["news_img"] . '&h=40&w=40&zc=1';;

        }


        return $rows;
    }

    function get_list_from_language()
    {
        global $db;
        $sql = "SELECT distinct (t2.from_language) as from_lang_id, t1.name as from_language FROM list_languages t1 inner join coupons_language t2 on t1.id=t2.from_language order by t1.id asc";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function get_list_to_language()
    {
        global $db;
        $sql = "SELECT distinct (t2.to_language) as to_lang_id, t1.name as to_language FROM list_languages t1 inner join coupons_language t2 on t1.id=t2.to_language order by t1.id asc limit 0, 200";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function get_order_translate($aSessionOrder, $aUserId)
    {
        global $db;
        $sql = "SELECT * FROM coupons_translate_order where session = '$aSessionOrder' order by id desc";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format((float)$rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format((float)$rows[$i]["count_text"], 0, ',', ',');
        }
        $db->db_freeresult($res);

        return $rows;
    }

    function get_order_translate_finish($aSessionOrder, $aUserId)
    {
        global $db;
        $sql = "SELECT * FROM coupons_translate_order  where session = '$aSessionOrder' and status=1 order by id desc";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format((float)$rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format((float)$rows[$i]["count_text"], 0, ',', ',');
        }
        $db->db_freeresult($res);

        return $rows;
    }

    function get_total_count_translate($aSessionOrder, $aUserId)
    {
        global $db;
        $sql = "SELECT sum(count_text) as total_text FROM coupons_translate_order where session = '$aSessionOrder' and status = 1 group by count_text";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        $total_text = 0;
        for ($i = 0; $i < count($rows); $i++) {
            $total_text += $rows[$i]["total_text"];

        }

        $db->db_freeresult($res);

        return $total_text;
    }

    function get_total_price_translate($aSessionOrder, $aUserId)
    {
        global $db;
        $sql = "SELECT price FROM coupons_translate_order where session = '$aSessionOrder' and status = 1 group by price";
        // echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        $total_price = 0;
        for ($i = 0; $i < count($rows); $i++) {
            $total_price += $rows[$i]["price"];
            //$total_price = number_format((float)$total_price, 2, ',', '.');
        }
        $db->db_freeresult($res);
        return $total_price;
    }

    function get_order_status_not_active($aSessionOrder)
    {
        global $db;
        $sql = "SELECT t2.order_status as order_status FROM coupons_translate_order t1, coupons_orders t2, coupons_orders_detail t3  where t1.session = '$aSessionOrder' and t1.id = t3.translate_id and t2.coupon_code=t3.coupon_code and t2.order_status = 0";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function get_order_language($aSessionOrder, $aUserId)
    {
        global $db;
        $sql =
            "SELECT t1.*, (select t2.name from list_languages t2 where t1.from_language = t2.id ) as from_language_name,(select t2.name from list_languages t2 where t1.to_language = t2.id ) as to_language_name,(select t3.category_name from coupons_special_category t3 where t1.special_category = t3.id ) as special_category_name FROM coupons_language_order t1 where t1.session = '$aSessionOrder' order by t1.id desc";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["to_language_name"] = $rows[$i]["to_language_name"];
            $rows[$i]["from_language_name"] = $rows[$i]["from_language_name"];

            $rows[$i]["from_flag_language"] = $this->show_info_language($rows[$i]["from_language"]);
            $rows[$i]["to_flag_language"] = $this->show_info_language($rows[$i]["to_language"]);
        }
        return $rows;
    }

    function show_info_language($id)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT img_flag FROM list_languages where language=$language and id=$id order by id asc ";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }


    // Get list hoc bong
    function get_list_category($category_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT category_name, category_code, category_url, category_id, category_content, category_img 
        FROM coupons_category 
        where parent_id = '$category_id' and language=$language and status = 1";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["category_name_limit"] = $function->cutnchar($rows[$i]["category_name"], 30);
            $rows[$i]["category_content_limit"] = strip_tags($function->cutnchar($rows[$i]["category_content"], 200),'');
            $rows[$i]["category_content_left"] = strip_tags($function->cutnchar($rows[$i]["category_content"], 400),'');
        }
        return $rows;
    }


    function get_all_special_category($limit = null)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_cate_study_abroad where language=$language and status = 1 ";
        if ($limit) {
            $sql .= "limit $limit";
        }
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["category_name_limit"] = $function->cutnchar($rows[$i]["category_name"], 30);
        }
        return $rows;
    }

    function get_all_news_category($limit = null)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_news_category where language=$language and status = 1 ";
        if ($limit) {
            $sql .= "limit $limit";
        }
        echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["category_name_limit"] = $function->cutnchar($rows[$i]["category_name"], 30);
        }
        return $rows;
    }

    function get_list_contact()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_contact where language=$language and status = 1 ";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function get_news_category_content($industry_id)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_news_category where category_id = $industry_id and language=$language and status = 1 ";

        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function get_cate_industry($industry_id)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT news_category FROM coupons_contents where news_id=$industry_id and language=$language and status = 1 ";

        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function get_detail_translator_service($service_id)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT news_category, news_name, news_content, news_img, description FROM list_cate_study_abroad where 
        news_id=$service_id and language=$language and status = 1 ";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    // get all mobile code
    function show_list_mobile_code()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_area_code where id >= 1 and language=$language order by id asc";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    // get all mobile code
    function show_list_country()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_country where id >= 1 and language=$language order by id asc";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    // kiem tra menu con id
    function num_category_sup($catid)
    {
        global $db;
        $sql = "Select a.* from coupons_category a, coupons_category b where b.category_id = '$catid'  and b.category_id = a.parent_id ";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;

    }

    // kiem tra supcate muc con
    function check_supcate_url($category_url)
    {
        global $db;
        $sql = "SELECT category_url FROM coupons_category where parent_id != '3' and category_url  = '$category_url'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }

    // lay ten danh  muc bang category_id
    function category_name_category_id($category_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "Select category_id,category_url,parent_id,category_name,category_content,color,link,layout,news_url,seo_title,seo_desc,seo_key
		from coupons_category where status = '1' and category_id = '$category_id' and language ='$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    // lay ten danh muc  bang category_url
    function category_name($category_url)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "Select category_id,category_url,parent_id,category_name,category_content,color,link,layout,news_url,seo_title,seo_desc,seo_key,category_img	 
		from coupons_category where status = '1' and category_url = '$category_url' and language ='$language'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    //lay category_id = parent_id
    function category_all_parent_id($parent_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "Select category_id,category_url,parent_id,category_name,category_content,color,link,layout,news_url,seo_title,seo_desc,seo_key
		from coupons_category where status = '1' and category_id = '$parent_id' and language ='$language'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    // kiem tra san pham
    function check_category_id($parent_id)
    {
        global $db;
        $sql = "SELECT news_id FROM coupons_products where news_category  = '$parent_id'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }

    // kiem tra san pham
    function check_product_id($news_id)
    {
        global $db;
        $sql = "SELECT news_id FROM coupons_products where news_id  = '$news_id'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }
    //////////////////////////////////////////////// hien thi menu
    // menu chinh
    function category_all_home($category_id, $parent_id, $page, $per_page)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if ($category_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and category_id ='$category_id' ";
        }

        if ($parent_id == '0') {
            $sr .= "and parent_id='$parent_id' ";
        } else {
            $sr .= "and parent_id='$parent_id'";
        }

        $sql = "SELECT category_id,category_name,parent_id,status,category_url,color,link,layout,news_url,category_img
		FROM coupons_category ca where status = '1' and language ='$language' $sr ORDER BY pos asc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function category_all($category_id, $parent_id, $page, $per_page)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if ($category_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and category_id ='$category_id'";
        }

        if ($parent_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and parent_id='$parent_id'";
        }

        $sql = "SELECT category_id,category_name,parent_id,status,category_url,color,link,layout,news_url,category_img,category_content
		FROM coupons_category where status = '1' and language ='$language' $sr ORDER BY pos asc Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////-----------------------------coupons_banner 2 language----------------------------//////////////////////
    function show_all_coupons_banner($category_id, $banner_category, $page, $per_page)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if ($category_id != "0") {
            $sr .= "and category_id ='$category_id'";
        } else {
            $sr .= "";
        }
        $sql = "SELECT * FROM coupons_banner 
		where banner_category ='$banner_category' and language ='$language' and status ='1' $sr ORDER BY pos desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["rows_i"] = $i + 1;
            $rows[$i]["banner_content_100"] = $function->cutnchar($rows[$i]["banner_content"], 100);
        }

        return $rows;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////-----------------------------coupons_products 2 language----------------------------//////////////////////
    function num_ckeck_category($news_category) // kiem tra so san pham trong 1 muc
    {
        global $db, $function;
        $sql = "SELECT cc.news_id FROM coupons_products cc 
				where cc.status = '1' and cc.news_category = '$news_category' ";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }

    function show_coupons_products_detail($news_category)//chi tiet mot tin theo news_category
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT cc.news_id,cc.news_url
				FROM coupons_products cc
				where cc.news_category = '$news_category' and  cc.language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    function show_products_detail($news_id)// detail content ten tieu de
    {
        global $db, $function;
        $sql = "Select cd.*, cc.*,ca.category_name from coupons_products cc, coupons_description cd , coupons_category ca
		where cd.news_id = cc.news_id and ca.category_id = cc.news_category and cc.news_id = '$news_id' and cd.pos='0' ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $rows["title_top"] = $function->cutnchar($rows["news_name"], 100);
        $rows["description_top"] = $function->cutnchar($rows["news_content"], 200);
        $rows["price"] = number_format($rows["price"]);
        $rows["img_meta"] = "products";

        $db->db_freeresult($res);

        return $rows;
    }

    function show_coupons_img($product_id)// image detail
    {
        global $db;
        $sql = "SELECT t2.* FROM  coupons_img t2 where t2.product_id = '$product_id' ORDER BY t2.id asc Limit 0, 20 ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        $db->db_freeresult($res);

        return $rows;
    }

    function show_coupons_option($product_id)// lua chon mua hang
    {
        global $db;
        $sql = "SELECT * FROM coupons_option where news_id = '$product_id' and status = '1' ORDER BY option_id asc Limit 0, 20 ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        $db->db_freeresult($res);

        return $rows;
    }

    function show_coupons_property($news_id)// thuoc tinh san pham
    {
        global $db;
        $sql = "SELECT t2.* FROM coupons_property t2 where t2.news_id = '$news_id'  ORDER BY t2.pos asc Limit 0, 20 ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        $db->db_freeresult($res);

        return $rows;
    }


    function update_order_language($orderSession, $translateId, $message)
    {
        global $db;
        $sql = "Update coupons_translate_order set status =1,message = '$message' where session='$orderSession' and id=$translateId";
        $res = $db->db_query($sql);

        return 1;
    }


    function coupons_products_views($news_id)//up so lan xem san pham
    {
        global $db;
        $create_date = time();
        $sql = "Update coupons_products set views  = views + 1 where news_id = $news_id";
        $res = $db->db_query($sql);

        return 1;
    }

    function num_all_coupons_coupons($news_category, $parent_id, $status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if ($news_category == '0') {
            $sr .= "";
        } else {
            $tem_category = "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and ca.parent_id ='$parent_id'";
        }

        if ($status == '0') {
            $sr .= "";
        } else {
            $sr .= "and cc.status = '$status'";
        }

        $sql = "SELECT cc.news_id,ca.category_id,cc.news_img,cc.news_name,cc.status,cc.language,cc.price,cc.pos
				FROM coupons_products cc, coupons_category ca 
				where ca.category_id = cc.news_category and  cc.language = '$language' $sr";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }

    function show_all_coupons_coupons(
        $news_category,
        $parent_id,
        $status,
        $event,
        $page,
        $per_page,
        $orderby,
        $news_id = ''
    ) {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if ($news_id != "") {
            $sr .= "and cc.news_id != '$news_id'";
        }

        if ($news_category == '0') {
            $sr .= "";
        } else {
            $sr .= "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and ca.parent_id ='$parent_id'";
        }

        if ($status == '0') {
            $sr .= "";
        } else {
            $sr .= "and cc.status = '$status'";
        }

        if ($event == '0') {
            $sr .= "";
        } else {
            $sr .= "and cc.event = '$event'";
        }

        if ($orderby == '0') {
            $tem_orderby = "ORDER BY cc.created_date desc ";
        } else {
            $orderby = "cc." . $orderby;
            $tem_orderby = "ORDER BY $orderby desc, cc.created_date desc ";
        }

        $sql = "SELECT FROM_UNIXTIME(cc.created_date,'%d-%m-%Y') as time_news, cc.news_id,cc.news_category,cc.news_img,cc.news_name
				,cc.status,cc.language,cc.price,cc.pos,cc.news_url,cc.img_file,cc.news_content,cc.news_link,
				cc.news_position,cc.news_type,cc.news_time,cc.news_married

				FROM coupons_products cc, coupons_category ca
				where ca.category_id = cc.news_category and ca.status = 1 and cc.language = '$language' $sr $tem_orderby Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        $position = $this->show_filter_one(1);
        $type = $this->show_filter_two(1);
        $married = $this->show_filter_three(1);
        $time = $this->show_filter_four(1);

        for ($i = 0; $i < count($rows); $i++) {

            $rows[$i]["news_name_30"] = $function->cutnchar($rows[$i]["news_name"], 30);
            $rows[$i]["news_name_35"] = $function->cutnchar($rows[$i]["news_name"], 35);
            $rows[$i]["news_name_40"] = $function->cutnchar($rows[$i]["news_name"], 45);
            $rows[$i]["news_name_45"] = $function->cutnchar($rows[$i]["news_name"], 40);
            $rows[$i]["news_name_50"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["news_name_55"] = $function->cutnchar($rows[$i]["news_name"], 55);
            $rows[$i]["news_name_60"] = $function->cutnchar($rows[$i]["news_name"], 60);
            $rows[$i]["news_name_65"] = $function->cutnchar($rows[$i]["news_name"], 65);
            $rows[$i]["news_name_70"] = $function->cutnchar($rows[$i]["news_name"], 70);
            $rows[$i]["news_name_75"] = $function->cutnchar($rows[$i]["news_name"], 75);

            $rows[$i]["news_content_cate"] = $function->cutnchar($rows[$i]["news_content"], 100);
            $rows[$i]["news_content_50"] = $function->cutnchar($rows[$i]["news_content"], 50);
            $rows[$i]["news_content_80"] = $function->cutnchar($rows[$i]["news_content"], 80);
            $rows[$i]["news_content_90"] = $function->cutnchar($rows[$i]["news_content"], 90);
            $rows[$i]["news_content_100"] = $function->cutnchar($rows[$i]["news_content"], 100);
            $rows[$i]["news_content_130"] = $function->cutnchar($rows[$i]["news_content"], 130);
            $rows[$i]["news_content_150"] = $function->cutnchar($rows[$i]["news_content"], 150);
            $rows[$i]["news_content_200"] = $function->cutnchar($rows[$i]["news_content"], 200);
            $rows[$i]["news_content_300"] = $function->cutnchar($rows[$i]["news_content"], 300);

            $rows[$i]["price"] = number_format($rows[$i]["price"]);

        }
        $db->db_freeresult($res);

        return $rows;
    }

    function show_all_coupons_coupons_home(
        $news_category,
        $parent_id,
        $status,
        $event,
        $page,
        $per_page,
        $orderby,
        $news_id = ''
    ) {
        global $db, $function;
        $language = LANG_AUGE;
        $sr = '';
        if ($news_id != "") {
            $sr .= "and cc.news_id != '$news_id'";
        }

        if ($news_category == '0') {
            $sr .= "";
        } else {
            $sr .= "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and ca.parent_id ='$parent_id'";
        }

        if ($status == '0') {
            $sr .= "";
        } else {
            $sr .= "and cc.status = '$status'";
        }

        if ($event == '0') {
            $sr .= "";
        } else {
            $sr .= "and cc.event = '$event'";
        }

        // 		if($orderby == '0'){$tem_orderby = "ORDER BY cc.created_date desc ";}
        // 		else{$orderby = "cc.".$orderby; $tem_orderby = "ORDER BY $orderby desc, cc.created_date desc ";}

        if ($orderby == '0') {
            $tem_orderby = "ORDER BY cc.price_new asc ";
        } else {
            $orderby = "cc." . $orderby;
            $tem_orderby = "ORDER BY cc.price_new asc ";
        }

        $sql = "SELECT FROM_UNIXTIME(cc.created_date,'%d-%m-%Y') as time_news, cc.*
		FROM coupons_products cc, coupons_category ca
		where ca.category_id = cc.news_category and ca.status = 1 and cc.language = '$language' $sr $tem_orderby Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {

            $rows[$i]["gia_kmai"] = number_format($rows[$i]["price"]);
            $rows[$i]["gia_ban"] = number_format($rows[$i]["price_new"]);
            if ($rows[$i]["price_new"] != 0 and $rows[$i]["price"] != 0) {
                $rows[$i]["tiet_kiem"] = number_format(($rows[$i]["price"] - $rows[$i]["price_new"]) / $rows[$i]["price"] * 100);
            } else {
                $rows[$i]["tiet_kiem"] = 0;
            }

        }
        $db->db_freeresult($res);

        return $rows;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////// tim kiem product
    function num_search_coupons_coupons($news_search, $fil_one, $fil_two, $fil_three, $fil_four, $fil_cty, $fil_dis)
    {
        global $db, $function;
        $language = LANG_AUGE;

        if ($news_search != "") {
            $_SESSION[URL_HOME]["news_search"] = $news_search;
        }
        if ($_SESSION[URL_HOME]["news_search"] != "") {
            $sr .= " and cc.news_name like '%" . $function->to_character_search($_SESSION[URL_HOME]["news_search"]) . "%'";
        } else {
            $sr .= "";
        }

        // Bo Loc
        if ($fil_one == 'all') {
            $fil_one = "";
        } else {
            $fil_one = "and fp.url_one = '$fil_one'";
        }

        if ($fil_two == 'all') {
            $fil_two = "";
        } else {
            $fil_two = "and fp.url_two = '$fil_two'";
        }

        if ($fil_three == 'all') {
            $fil_three = "";
        } else {
            $fil_three = "and fp.url_three = '$fil_three'";
        }

        if ($fil_four == 'all') {
            $fil_four = "";
        } else {
            $arr_price = explode("-", $fil_four);
            $min_price = $function->sql_injection($arr_price[0]);
            $max_price = $function->sql_injection($arr_price[1]);
            $fil_four = "and cc.price_new >= '$min_price' and  cc.price_new <= '$max_price' ";
        }

        if ($fil_one == "" and $fil_two == "" and $fil_three == "") {
            $table = "";
            $cate = "";
        } else {
            $table = ", filter_products fp";
            $catego = "and cc.news_id=fp.products_id";
        }

        if ($fil_cty == 'all') {
            $fil_cty = "";
        } else {
            $fil_cty = "and cc.cityid = '$fil_cty'";
        }

        if ($fil_dis == 'all') {
            $fil_dis = "";
        } else {
            $fil_dis = "and cc.district = '$fil_dis'";
        }
        // emd bo loc

        $sql = "SELECT * FROM coupons_products cc, coupons_category ca $table
				where ca.category_id = cc.news_category and  cc.language = '$language' and cc.status = 1 and ca.status =1 $sr $catego $fil_one $fil_two $fil_three $fil_four $fil_cty $fil_dis";

        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        $db->db_freeresult($res);

        return $rows;
    }

    function search_coupons_coupons($param_search, $value_search)
    {
        global $db, $function;
        $language = LANG_AUGE;

        if ($param_search == "from") {
            $param_cond = " (select t2.id from list_languages t2 where t2.id = cod.translate_from) = " . $value_search;
        } elseif ($param_search == "to") {
            $param_cond = " (select t2.id from list_languages t2 where t2.id = cod.translate_to) = " . $value_search;
        } elseif ($param_search == "subject") {
            $param_cond = "special_category = " . $value_search;
        }

        $sql = "SELECT cu.name, cu.avatar, cp.*, cs.* ,cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua , (select t1.category_name from coupons_special_category t1 where t1.id = cod.special_category) as subject_field, (select t2.name from list_languages t2 where t2.id = cod.translate_from) as from_language_name, (select t2.name from list_languages t2 where t2.id = cod.translate_to) as to_language_name
    FROM  coupons_orders cp,coupons_orders_detail cod, coupons_status cs , coupons_users cu
    where cod.coupon_code=cp.coupon_code and cp.language='$language' 
    and cs.coupon_status=cp.coupon_status and cu.userid=cp.coupon_userid and cp.coupon_status = 2 and $param_cond
    group by cp.coupon_purchaseid
    ORDER BY cp.coupon_status asc, cp.coupon_purchaseid desc Limit 0, 200";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["message"] = $function->cutnchar($rows[$i]["message"], 200);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
        }

        return $rows;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////----------------------------- filter_products 2 language----------------------------//////////////////////
    function num_all_category($news_category, $parent_id, $status, $fil_one, $fil_two, $fil_three, $fil_four)
    {
        global $db, $function;
        $language = LANG_AUGE;
        // Bo Loc
        if ($fil_one == 'all') {
            $fil_one = "";
        } else {
            $fil_one = "and fp.url_one = '$fil_one'";
        }

        if ($fil_two == 'all') {
            $fil_two = "";
        } else {
            $fil_two = "and fp.url_two = '$fil_two'";
        }

        if ($fil_three == 'all') {
            $fil_three = "";
        } else {
            $fil_three = "and fp.url_three = '$fil_three'";
        }

        if ($fil_four == 'all') {
            $fil_four = "";
        } else {
            $arr_price = explode("-", $fil_four);
            $min_price = $function->sql_injection($arr_price[0]);
            $max_price = $function->sql_injection($arr_price[1]);
            $fil_four = "and cc.price_new >= '$min_price' and  cc.price_new <= '$max_price' ";
        }

        if ($fil_one == "" and $fil_two == "" and $fil_three == "") {
            $table = "";
            $cate = "";
        } else {
            $table = ", filter_products fp";
            $catego = "and cc.news_id=fp.products_id";
        }
        // emd bo loc

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

        $sql = "SELECT count(cc.news_id) as num_product
				FROM coupons_products cc, coupons_category ca $table
				where ca.category_id = cc.news_category and ca.status = 1 and  cc.language = '$language' 
				$catego $tem_category $tem_parent_id $tem_status $fil_one $fil_two $fil_three $fil_four";

        $rs = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function num_all_filter(
        $news_category,
        $parent_id,
        $status,
        $orderby,
        $fil_one,
        $fil_two,
        $fil_three,
        $fil_four,
        $fil_cty,
        $fil_dis
    ) {
        global $db, $function;
        $language = LANG_AUGE;
        // Bo Loc
        if ($fil_one == 'all') {
            $fil_one = "";
        } else {
            $fil_one = "and fp.url_one = '$fil_one'";
        }

        if ($fil_two == 'all') {
            $fil_two = "";
        } else {
            $fil_two = "and fp.url_two = '$fil_two'";
        }

        if ($fil_three == 'all') {
            $fil_three = "";
        } else {
            $fil_three = "and fp.url_three = '$fil_three'";
        }

        if ($fil_four == 'all') {
            $fil_four = "";
        } else {
            $arr_price = explode("-", $fil_four);
            $min_price = $function->sql_injection($arr_price[0]);
            $max_price = $function->sql_injection($arr_price[1]);
            $fil_four = "and cc.price_new >= '$min_price' and  cc.price_new <= '$max_price' ";
        }

        if ($fil_one == "" and $fil_two == "" and $fil_three == "") {
            $table = "";
            $cate = "";
        } else {
            $table = ", filter_products fp";
            $catego = "and cc.news_id=fp.products_id";
        }

        if ($fil_cty == 'all') {
            $fil_cty = "";
        } else {
            $fil_cty = "and cc.cityid = '$fil_cty'";
        }

        if ($fil_dis == 'all') {
            $fil_dis = "";
        } else {
            $fil_dis = "and cc.district = '$fil_dis'";
        }
        // emd bo loc

        if ($news_category == '0') {
            $tem_category = "";
        } else {
            $tem_category = "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $tem_parent_id .= "";
        } else {
            $arr_id = $this->read_record($parent_id);
            $tem_parent_id .= " and ca.parent_id IN ($arr_id) ";
        }

        if ($status == '0') {
            $tem_status = "";
        } else {
            $tem_status = "and cc.status = '$status'";
        }

        $sql = "SELECT cc.news_id
				FROM coupons_products cc, coupons_category ca $table
				where ca.category_id = cc.news_category and ca.status = 1 and  cc.language = '$language' 
				$catego $tem_category $tem_parent_id $tem_status $fil_one $fil_two $fil_three $fil_four $fil_cty $fil_dis";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }

    function show_all_filter(
        $page,
        $per_page,
        $news_category,
        $parent_id,
        $status,
        $orderby,
        $fil_one,
        $fil_two,
        $fil_three,
        $fil_four,
        $fil_cty,
        $fil_dis,
        $order_by = ""
    ) {
        global $db, $function;
        $language = LANG_AUGE;
        // Bo Loc
        if ($fil_one == 'all') {
            $fil_one = "";
        } else {
            $fil_one = "and fp.url_one = '$fil_one'";
        }

        if ($fil_two == 'all') {
            $fil_two = "";
        } else {
            $fil_two = "and fp.url_two = '$fil_two'";
        }

        if ($fil_three == 'all') {
            $fil_three = "";
        } else {
            $fil_three = "and fp.url_three = '$fil_three'";
        }

        if ($fil_four == 'all') {
            $fil_four = "";
        } else {
            $arr_price = explode("-", $fil_four);
            $min_price = $function->sql_injection($arr_price[0]);
            $max_price = $function->sql_injection($arr_price[1]);
            $fil_four = "and cc.price_new >= '$min_price' and  cc.price_new <= '$max_price' ";
        }

        if ($fil_one == "" and $fil_two == "" and $fil_three == "") {
            $table = "";
            $cate = "";
        } else {
            $table = ", filter_products fp";
            $catego = "and cc.news_id=fp.products_id";
        }

        if ($fil_cty == 'all') {
            $fil_cty = "";
        } else {
            $fil_cty = "and cc.cityid = '$fil_cty'";
        }

        if ($fil_dis == 'all') {
            $fil_dis = "";
        } else {
            $fil_dis = "and cc.district = '$fil_dis'";
        }
        // emd bo loc

        if ($news_category == '0') {
            $tem_category = "";
        } else {
            $tem_category = "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $tem_parent_id .= "";
        } else {
            $arr_id = $this->read_record($parent_id);
            $tem_parent_id .= " and ca.parent_id IN ($arr_id) ";
        }

        if ($status == '0') {
            $tem_status = "";
        } else {
            $tem_status = "and cc.status = '$status'";
        }

        $sql = "SELECT FROM_UNIXTIME(cc.created_date,'%d-%m-%Y') as time_news, cc.news_id,cc.vat,ca.category_id,cc.news_img,cc.views,cc.news_name,cc.price_new,
				cc.status,cc.language,cc.price,cc.pos,cc.news_url,cc.amount,cc.img_file,cc.news_content, 
				cc.rating_stars, (cc.price-cc.price_new)/cc.price*100 as giam_gia
				FROM coupons_products cc, coupons_category ca  $table
				where ca.category_id = cc.news_category and ca.status = 1 and  cc.language = '$language' 
				$catego $tem_category $tem_parent_id $tem_status $fil_one $fil_two $fil_three $fil_four $fil_cty $fil_dis $order_by Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_30"] = $function->cutnchar($rows[$i]["news_name"], 30);
            $rows[$i]["news_name_35"] = $function->cutnchar($rows[$i]["news_name"], 35);
            $rows[$i]["news_name_40"] = $function->cutnchar($rows[$i]["news_name"], 45);
            $rows[$i]["news_name_45"] = $function->cutnchar($rows[$i]["news_name"], 40);
            $rows[$i]["news_name_50"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["news_name_55"] = $function->cutnchar($rows[$i]["news_name"], 55);
            $rows[$i]["news_name_60"] = $function->cutnchar($rows[$i]["news_name"], 60);
            $rows[$i]["news_name_65"] = $function->cutnchar($rows[$i]["news_name"], 65);
            $rows[$i]["news_name_70"] = $function->cutnchar($rows[$i]["news_name"], 70);
            $rows[$i]["news_name_75"] = $function->cutnchar($rows[$i]["news_name"], 75);

            $rows[$i]["news_content_cate"] = $function->cutnchar($rows[$i]["news_content"], 300);
            $rows[$i]["news_content_50"] = $function->cutnchar($rows[$i]["news_content"], 50);
            $rows[$i]["news_content_80"] = $function->cutnchar($rows[$i]["news_content"], 80);
            $rows[$i]["news_content_90"] = $function->cutnchar($rows[$i]["news_content"], 90);
            $rows[$i]["news_content_100"] = $function->cutnchar($rows[$i]["news_content"], 100);
            $rows[$i]["news_content_130"] = $function->cutnchar($rows[$i]["news_content"], 130);
            $rows[$i]["news_content_150"] = $function->cutnchar($rows[$i]["news_content"], 150);
            $rows[$i]["news_content_200"] = $function->cutnchar($rows[$i]["news_content"], 200);
            $rows[$i]["news_content_300"] = $function->cutnchar($rows[$i]["news_content"], 300);

            $rows[$i]["gia_kmai"] = number_format($rows[$i]["price"]);
            $rows[$i]["gia_ban"] = number_format($rows[$i]["price_new"]);
            if ($rows[$i]["price_new"] != 0 and $rows[$i]["price"] != 0) {
                $rows[$i]["tiet_kiem"] = number_format(($rows[$i]["price"] - $rows[$i]["price_new"]) / $rows[$i]["price"] * 100);
            } else {
                $rows[$i]["tiet_kiem"] = 0;
            }

        }
        $db->db_freeresult($res);

        return $rows;
    }

    function show_all_filter_home(
        $page,
        $per_page,
        $news_category,
        $parent_id,
        $status,
        $orderby,
        $fil_one,
        $fil_two,
        $fil_three,
        $fil_four,
        $fil_cty,
        $fil_dis,
        $order_by = "",
        $aJobtype
    ) {
        global $db, $function, $Process;
        $language = LANG_AUGE;

        $Process = new Cart;
        // Bo Loc
        if ($fil_one == 'all') {
            $fil_one = "";
        } else {
            $fil_one = "and fp.url_one = '$fil_one'";
        }

        if ($fil_two == 'all') {
            $fil_two = "";
        } else {
            $fil_two = "and fp.url_two = '$fil_two'";
        }

        if ($fil_three == 'all') {
            $fil_three = "";
        } else {
            $fil_three = "and fp.url_three = '$fil_three'";
        }

        if ($fil_four == 'all') {
            $fil_four = "";
        } else {
            $arr_price = explode("-", $fil_four);
            $min_price = $function->sql_injection($arr_price[0]);
            $max_price = $function->sql_injection($arr_price[1]);
            $fil_four = "and cc.price_new >= '$min_price' and  cc.price_new <= '$max_price' ";
        }

        if ($fil_one == "" and $fil_two == "" and $fil_three == "") {
            $table = "";
            $cate = "";
        } else {
            $table = ", filter_products fp";
            $catego = "and cc.news_id=fp.products_id";
        }

        if ($fil_cty == 'all') {
            $fil_cty = "";
        } else {
            $fil_cty = "and cc.cityid = '$fil_cty'";
        }

        if ($fil_dis == 'all') {
            $fil_dis = "";
        } else {
            $fil_dis = "and cc.district = '$fil_dis'";
        }
        // emd bo loc

        if ($news_category == '0') {
            $tem_category = "";
        } else {
            $tem_category = "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $tem_parent_id .= "";
        } else {
            $arr_id = $this->read_record($parent_id);
            $tem_parent_id .= " and ca.parent_id IN ($arr_id) ";
        }

        if ($status == '0') {
            $tem_status = "";
        } else {
            $tem_status = "and cc.status = '$status'";
        }

        if ($aJobtype == 0) {
            $aJobtype = "and cc.job_type = 0";
        } elseif ($aJobtype == 1) {
            $aJobtype = "and cc.job_type = 1";
        } else {
            $aJobtype = "and cc.job_type in (0,1)";
        }

        $sql = "SELECT FROM_UNIXTIME(cc.created_date,'%d-%m-%Y') as time_news,ca.category_id,cc.*,
		cd.description
		FROM coupons_products cc, coupons_category ca, coupons_description cd $table
		where ca.category_id = cc.news_category and cc.news_id = cd.news_id and ca.status = 1 and  cc.language = '$language'
		$catego $tem_category $aJobtype $tem_parent_id $tem_status $fil_one $fil_two $fil_three $fil_four $fil_cty $fil_dis $order_by Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"]);
        }
        $db->db_freeresult($res);

        return $rows;
    }

    /**
     *
     * Show all hot job
     *
     **/
    function show_all_hot_job(
        $page,
        $per_page,
        $news_category,
        $parent_id,
        $status,
        $orderby,
        $fil_one,
        $fil_two,
        $fil_three,
        $fil_four,
        $fil_cty,
        $fil_dis,
        $order_by = ""
    ) {
        global $db, $function, $Process;
        $language = LANG_AUGE;

        $Process = new Cart;
        // Bo Loc
        if ($fil_one == 'all') {
            $fil_one = "";
        } else {
            $fil_one = "and fp.url_one = '$fil_one'";
        }

        if ($fil_two == 'all') {
            $fil_two = "";
        } else {
            $fil_two = "and fp.url_two = '$fil_two'";
        }

        if ($fil_three == 'all') {
            $fil_three = "";
        } else {
            $fil_three = "and fp.url_three = '$fil_three'";
        }

        if ($fil_four == 'all') {
            $fil_four = "";
        } else {
            $arr_price = explode("-", $fil_four);
            $min_price = $function->sql_injection($arr_price[0]);
            $max_price = $function->sql_injection($arr_price[1]);
            $fil_four = "and cc.price_new >= '$min_price' and  cc.price_new <= '$max_price' ";
        }

        if ($fil_one == "" and $fil_two == "" and $fil_three == "") {
            $table = "";
            $cate = "";
        } else {
            $table = ", filter_products fp";
            $catego = "and cc.news_id=fp.products_id";
        }

        if ($fil_cty == 'all') {
            $fil_cty = "";
        } else {
            $fil_cty = "and cc.cityid = '$fil_cty'";
        }

        if ($fil_dis == 'all') {
            $fil_dis = "";
        } else {
            $fil_dis = "and cc.district = '$fil_dis'";
        }
        // emd bo loc

        if ($news_category == '0') {
            $tem_category = "";
        } else {
            $tem_category = "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $tem_parent_id .= "";
        } else {
            $arr_id = $this->read_record($parent_id);
            $tem_parent_id .= " and ca.parent_id IN ($arr_id) ";
        }

        if ($status == '0') {
            $tem_status = "";
        } else {
            $tem_status = "and cc.status = '$status'";
        }

        $sql = "SELECT FROM_UNIXTIME(cc.created_date,'%d-%m-%Y') as time_news,ca.category_id,cc.*,
		cd.description
		FROM coupons_products cc, coupons_category ca, coupons_description cd $table
		where ca.category_id = cc.news_category and cc.news_id = cd.news_id and cc.home = 1 and  cc.language = '$language'
		$catego $tem_category $tem_parent_id $tem_status $fil_one $fil_two $fil_three $fil_four $fil_cty $fil_dis $order_by Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"]);
        }
        $db->db_freeresult($res);

        return $rows;
    }

    function show_all_filter_detail(
        $page,
        $per_page,
        $news_category,
        $parent_id,
        $status,
        $orderby,
        $fil_one,
        $fil_two,
        $fil_three,
        $fil_four,
        $fil_cty,
        $fil_dis,
        $order_by = ""
    ) {
        global $db, $function, $Process;
        $language = 1;

        $Process = new Cart;
        // Bo Loc
        if ($fil_one == 'all') {
            $fil_one = "";
        } else {
            $fil_one = "and fp.url_one = '$fil_one'";
        }

        if ($fil_two == 'all') {
            $fil_two = "";
        } else {
            $fil_two = "and fp.url_two = '$fil_two'";
        }

        if ($fil_three == 'all') {
            $fil_three = "";
        } else {
            $fil_three = "and fp.url_three = '$fil_three'";
        }

        if ($fil_four == 'all') {
            $fil_four = "";
        } else {
            $arr_price = explode("-", $fil_four);
            $min_price = $function->sql_injection($arr_price[0]);
            $max_price = $function->sql_injection($arr_price[1]);
            $fil_four = "and cc.price_new >= '$min_price' and  cc.price_new <= '$max_price' ";
        }

        if ($fil_one == "" and $fil_two == "" and $fil_three == "") {
            $table = "";
            $cate = "";
        } else {
            $table = ", filter_products fp";
            $catego = "and cc.news_id=fp.products_id";
        }

        if ($fil_cty == 'all') {
            $fil_cty = "";
        } else {
            $fil_cty = "and cc.cityid = '$fil_cty'";
        }

        if ($fil_dis == 'all') {
            $fil_dis = "";
        } else {
            $fil_dis = "and cc.district = '$fil_dis'";
        }
        // emd bo loc

        if ($news_category == '0') {
            $tem_category = "";
        } else {
            $tem_category = "and cc.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $tem_parent_id .= "";
        } else {
            $arr_id = $this->read_record($parent_id);
            $tem_parent_id .= " and ca.parent_id IN ($arr_id) ";
        }

        if ($status == '0') {
            $tem_status = "";
        } else {
            $tem_status = "and cc.status = '$status'";
        }

        $sql = "SELECT FROM_UNIXTIME(cc.created_date,'%d-%m-%Y') as time_news,ca.category_id,cc.*,
		cd.description,ca.category_name
		FROM coupons_products cc, coupons_category ca, coupons_description cd $table
		where ca.category_id = cc.news_category and cc.news_id = cd.news_id and ca.status = 1 and  cc.language = '$language' 
		 $tem_category $tem_parent_id $tem_status $fil_one $fil_two $fil_three $fil_four $fil_cty $fil_dis $order_by Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_30"] = $function->cutnchar($rows[$i]["news_name"], 30);
            $rows[$i]["news_name_35"] = $function->cutnchar($rows[$i]["news_name"], 35);
            $rows[$i]["news_name_40"] = $function->cutnchar($rows[$i]["news_name"], 45);
            $rows[$i]["news_name_45"] = $function->cutnchar($rows[$i]["news_name"], 40);
            $rows[$i]["news_name_50"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["news_name_55"] = $function->cutnchar($rows[$i]["news_name"], 55);
            $rows[$i]["news_name_60"] = $function->cutnchar($rows[$i]["news_name"], 60);
            $rows[$i]["news_name_65"] = $function->cutnchar($rows[$i]["news_name"], 65);
            $rows[$i]["news_name_70"] = $function->cutnchar($rows[$i]["news_name"], 70);
            $rows[$i]["news_name_75"] = $function->cutnchar($rows[$i]["news_name"], 75);

            $rows[$i]["news_content_cate"] = $function->cutnchar($rows[$i]["news_content"], 300);
            $rows[$i]["news_content_50"] = $function->cutnchar($rows[$i]["news_content"], 50);
            $rows[$i]["news_content_80"] = $function->cutnchar($rows[$i]["news_content"], 80);
            $rows[$i]["news_content_90"] = $function->cutnchar($rows[$i]["news_content"], 90);
            $rows[$i]["news_content_100"] = $function->cutnchar($rows[$i]["news_content"], 100);
            $rows[$i]["news_content_130"] = $function->cutnchar($rows[$i]["news_content"], 130);
            $rows[$i]["news_content_150"] = $function->cutnchar($rows[$i]["news_content"], 150);
            $rows[$i]["news_content_200"] = $function->cutnchar($rows[$i]["news_content"], 200);
            $rows[$i]["news_content_300"] = $function->cutnchar($rows[$i]["news_content"], 300);

            $rows[$i]["price"] = number_format($rows[$i]["price"]);
        }
        $db->db_freeresult($res);

        return $rows;
    }

    //category parent all
    function read_record($id)
    {
        global $db;
        $array_id = "$id";
        $sql = "SELECT * FROM coupons_category WHERE parent_id  = '$id';";
        $rs = $db->db_query($sql);
        if ($db->db_numrows($rs) > 0) {
            while ($row = $db->db_fetchrow($rs)) {
                $array_id .= ',' . $this->read_record($row["category_id"]);
            }
        }
        $db->db_freeresult($rs);

        return $array_id;

        return $id;
    }

    ////////// bo loc 1
    function num_filter_one($category_id)
    {
        global $db, $function;
        $sql = "SELECT * FROM filter_one where category_id  = '$category_id' and status ='1' ";
        $rs = $db->db_query($sql);

        return $db->db_numrows($rs);
    }

    function show_filter_one($category_id)
    {
        global $db;
        $sql = "SELECT * FROM filter_one where category_id  = '$category_id' and status ='1' ORDER BY pos asc, id asc  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function seo_filter_one($category_id, $filter_url)
    {
        global $db;
        $sql = "SELECT name,filter_name FROM filter_one where filter_url = '$filter_url' and category_id  = '$category_id'  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    ////////// bo loc 2
    function num_filter_two($category_id)
    {
        global $db, $function;
        $sql = "SELECT * FROM filter_two where category_id  = '$category_id' and status ='1' ";
        $rs = $db->db_query($sql);

        return $db->db_numrows($rs);
    }

    function show_filter_two($category_id)
    {
        global $db;
        $sql = "SELECT * FROM filter_two where category_id  = '$category_id' and status ='1' ORDER BY pos asc, id asc  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function seo_filter_two($category_id, $filter_url)
    {
        global $db;
        $sql = "SELECT name,filter_name FROM filter_two where filter_url = '$filter_url'  and category_id  = '$category_id'  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    ////////// bo loc 3
    function num_filter_three($category_id)
    {
        global $db, $function;
        $sql = "SELECT * FROM filter_three where category_id  = '$category_id' and status ='1'";
        $rs = $db->db_query($sql);

        return $db->db_numrows($rs);
    }

    function show_filter_three($category_id)
    {
        global $db;
        $sql = "SELECT * FROM filter_three where category_id  = '$category_id' and status ='1' ORDER BY pos asc, id asc  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function seo_filter_three($category_id, $filter_url)
    {
        global $db;
        $sql = "SELECT name,filter_name FROM filter_three where filter_url = '$filter_url'  and category_id  = '$category_id'  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    ////////// bo loc 4
    function num_filter_four($category_id)
    {
        global $db, $function;
        $sql = "SELECT * FROM filter_four where category_id  = '$category_id' and status ='1' ";
        $rs = $db->db_query($sql);

        return $db->db_numrows($rs);
    }

    function show_filter_four($category_id)
    {
        global $db;
        $sql = "SELECT * FROM filter_four where category_id  = '$category_id' and status ='1' ORDER BY pos asc, id asc  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function seo_filter_four($category_id, $filter_url)
    {
        global $db;
        $sql = "SELECT name,filter_name FROM filter_four where filter_url = '$filter_url'  and category_id  = '$category_id' ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    ////////// bo loc  thanh pho
    function filter_priority($page, $per_page)
    {
        global $db;
        $sql = "SELECT * FROM coupons_cities where status ='1' ORDER BY cityid asc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function seo_filter_cities($cityid)
    {
        global $db;
        $sql = "SELECT * FROM coupons_cities where cityid ='$cityid'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    ////////// bo loc  quan
    function filter_district($page, $per_page, $priority)
    {
        global $db;
        $sql = "SELECT * FROM coupons_district where status ='1' and  cityid = '$priority' ORDER BY district_name asc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function seo_filter_district($district_id)
    {
        global $db;
        $sql = "SELECT * FROM coupons_district where district_id ='$district_id'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////--------------comment 2 language--------------///////////////////////////////////
    function add_table_comment($news_id, $nickname, $title, $content, $parent_id)
    {
        global $db, $function;
        $status = 0;
        $date = time();
        $user_id = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);
        $sql = "INSERT INTO coupons_comment(news_id,nickname,title,content,status,user_id,date,parent_id)
 		VALUES('$news_id','$nickname','$title','$content','$status','$user_id','$date','$parent_id')";
        $res = $db->db_query($sql);

        return 1;
    }

    function show_comment($page, $per_page, $news_id)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT id,nickname,title,content,date,parent_id,like_cm FROM coupons_comment 
		WHERE news_id = '$news_id' and status = '1' and parent_id ='0' ORDER BY id desc Limit $page,$per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function show_comment_con($page, $per_page, $parent_id)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT id,nickname,title,content,date,parent_id,like_cm FROM coupons_comment 
		WHERE parent_id = '$parent_id' and status = '1' ORDER BY id desc Limit $page,$per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function like_comment($id)
    {
        global $db;
        $sql = "Update coupons_comment set like_cm = like_cm + 1 where id=$id";
        $res = $db->db_query($sql);

        return 1;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////--------------coupons_news--------------/////////////////////////////////////////////////
    function num_news_category($news_category, $parent_id)
    {
        global $db, $function;
        $sr = '';
        if ($news_category == '0') {
            $sr .= "";
        } else {
            $sr .= "and cn.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and ca.parent_id ='$parent_id'";
        }

        $sql = "SELECT cn.news_id FROM coupons_news cn , coupons_category ca
				where cn.status = '1' and ca.category_id = cn.news_category $sr";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }

    function show_news_category($news_category, $parent_id, $page, $per_page, $news_id = '')
    {
        global $db, $function;
        $sr = '';
        if ($news_id != "") {
            $sr .= "and cn.news_id != '$news_id'";
        }

        if ($news_category == '0') {
            $sr .= "";
        } else {
            $sr .= "and cn.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and ca.parent_id ='$parent_id'";
        }

        $sql = "SELECT FROM_UNIXTIME(cn.created_date,'%M %d, %Y') as time_news, 
		cn.news_id,cn.news_link,cn.news_name,cn.news_name,cn.news_img,cn.news_category,
		cn.news_content,cn.created_date, cn.price_new, cn.news_url, cn.views
		FROM coupons_news cn, coupons_category ca where cn.status = '1' and cn.language = '1' and ca.category_id = cn.news_category $sr 
		ORDER BY cn.pos desc, cn.news_id desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {

            $rows[$i]["news_name_30"] = $function->cutnchar($rows[$i]["news_name"], 30);
            $rows[$i]["news_name_35"] = $function->cutnchar($rows[$i]["news_name"], 35);
            $rows[$i]["news_name_40"] = $function->cutnchar($rows[$i]["news_name"], 45);
            $rows[$i]["news_name_45"] = $function->cutnchar($rows[$i]["news_name"], 40);
            $rows[$i]["news_name_50"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["news_name_55"] = $function->cutnchar($rows[$i]["news_name"], 55);
            $rows[$i]["news_name_60"] = $function->cutnchar($rows[$i]["news_name"], 60);
            $rows[$i]["news_name_65"] = $function->cutnchar($rows[$i]["news_name"], 65);
            $rows[$i]["news_name_70"] = $function->cutnchar($rows[$i]["news_name"], 70);
            $rows[$i]["news_name_75"] = $function->cutnchar($rows[$i]["news_name"], 75);
            $rows[$i]["news_name_90"] = $function->cutnchar($rows[$i]["news_name"], 90);
            $rows[$i]["news_name_100"] = $function->cutnchar($rows[$i]["news_name"], 100);

            $rows[$i]["news_content_100"] = $function->cutnchar($rows[$i]["news_content"], 100);
            $rows[$i]["news_content_130"] = $function->cutnchar($rows[$i]["news_content"], 130);
            $rows[$i]["news_content_150"] = $function->cutnchar($rows[$i]["news_content"], 150);
            $rows[$i]["news_content_200"] = $function->cutnchar($rows[$i]["news_content"], 200);
            $rows[$i]["news_content_300"] = $function->cutnchar($rows[$i]["news_content"], 300);

            $rows[$i]["news_name_new"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["news_content_new"] = $function->cutnchar($rows[$i]["news_content"], 280);

        }

        return $rows;
    }

    function show_content_category($news_category, $parent_id, $page, $per_page, $news_id = '')
    {
        global $db, $function;
        $sr = '';
        if ($news_id != "") {
            $sr .= "and cn.news_id = '$news_id' ";
        }

        if ($news_category == '0') {
            $sr .= "";
        } else {
            $sr .= "and cn.news_category ='$news_category'";
        }

        if ($parent_id == '0') {
            $sr .= "";
        } else {
            $sr .= "and ca.parent_id ='$parent_id'";
        }

        $sql = "SELECT FROM_UNIXTIME(cn.created_date,'%M %d, %Y') as time_news, 
		cn.news_id,cn.news_link,cn.news_name,cn.news_name,cn.news_img,cn.news_category,
		cn.news_content,cn.description,cn.created_date, cn.price_new, cn.news_url, cn.views
		FROM coupons_news cn, coupons_category ca where cn.status = '1' and ca.category_id = cn.news_category $sr 
		ORDER BY cn.pos desc, cn.news_id desc Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name_new"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["news_content_new"] = $function->cutnchar($rows[$i]["news_content"], 280);

        }

        return $rows;
    }

    function coupons_news_views($news_id)
    {
        global $db;
        $create_date = time();
        $sql = "Update coupons_news set views  = views + 1 where news_id = $news_id";
        $res = $db->db_query($sql);

        return 1;
    }

    function show_new_detail($news_id)
    {
        global $db, $function;
        $sql = "Select FROM_UNIXTIME(created_date,'%d/%m/%Y') as time_news, news_id, news_name, status, news_img, news_category, news_content,
		description,news_link,news_url,created_date,userid,seo_title,seo_key,seo_desc from coupons_news where news_id = '$news_id'  ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $rows["title_top"] = $function->cutnchar($rows["news_name"], 100);
        $rows["description_top"] = $function->cutnchar($rows["news_content"], 200);
        $rows["img_meta"] = "news";

        return $rows;
    }

    function show_new_detail_category($news_category, $limit)
    {
        global $db, $function;
        $sql = "Select FROM_UNIXTIME(created_date,'%d/%m/%Y') as time_news, news_id,news_name,status,news_img,news_category
		news_content,description,news_link,news_url,created_date,userid from coupons_contents where study_category = '$news_category' and status = 1 order by time_news desc limit $limit";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["title_top"] = $function->cutnchar($rows[$i]["news_name"], 100);
            $rows[$i]["description_top"] = $function->cutnchar($rows[$i]["news_content"], 200);
            $rows[$i]["description_center"] = $function->cutnchar($rows[$i]["news_content"], 500);

            $rows[$i]["description_top"] = strip_tags($rows[$i]["description_top"]);
            $rows[$i]["description_center"] = strip_tags($rows[$i]["description_center"]);
        }
        return $rows;
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////--------------coupons_faq 2 language--------------///////////////////////////////////
    function add_table_faq($question)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "INSERT INTO coupons_faq(question,language) VALUES('$question','$language')";
        $res = $db->db_query($sql);

        return 1;
    }

    function num_table_faq()
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_faq where status = '1' and language = '$language' ";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);

        return $rows;
    }

    function show_table_faq($page, $per_page)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_faq where status = '1' and language = '$language' ORDER BY id desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////--------------keyword--------------///////////////////////////////////
    //XXXUPXXX25-07
    function show_keyword($page, $per_page, $category)
    {
        global $db;
        $sql = "Select keyword,link from coupons_keyword where status ='1' and category_id='$category' Limit $page,$per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////--------------support 2 language--------------///////////////////////////////////
    function add_table_support($txt_email, $txt_name, $txt_tel, $txt_address, $txt_content)
    {
        global $db, $function;
        $status = 0;
        $date = time();
        $language = LANG_AUGE;
        $sql = "INSERT INTO coupons_support(txt_email,txt_name,txt_tel,txt_address,txt_content,date,status,language)
 		VALUES('$txt_email','$txt_name','$txt_tel','$txt_address','$txt_content','$date','$status', $language)";
        $res = $db->db_query($sql);

        return 1;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////--------------gold_price--------------///////////////////////////////////
    function show_gold_price()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "Select * from gold_price where language = '$language' and status ='1'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["buy"] = number_format($rows[$i]["buy"]);
            $rows[$i]["sell"] = number_format($rows[$i]["sell"]);
        }

        return $rows;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////--------------online--------------///////////////////////////////////
    function show_all_online($page, $per_page)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_online where language ='$language' and status = '1' ORDER BY id desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function add_filter_products($products_id, $url_one, $url_two, $url_three)
    {
        global $db;
        $create_date = time();
        $sql = "INSERT INTO filter_products(products_id,url_one,url_two,url_three) VALUES('$products_id','$url_one','$url_two','$url_three')";

        $res = $db->db_query($sql);

        return 1;
    }

    function edit_filter_products($products_id, $url_one, $url_two, $url_three)
    {
        global $db;
        $created_date = time();
        $sql = "Update filter_products set url_one ='$url_one', url_two ='$url_two', url_three ='$url_three' where products_id = $products_id";
        $res = $db->db_query($sql);

        return 1;
    }
}

?>
