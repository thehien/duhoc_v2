<?php

function process_client()
{

////////////No change/////////////
    global $db, $smarty, $function;
    $oNews = new News;
    $oMember = new Member;
    $oCart = new Cart;

    $str = $function->sql_injection(isset($_GET['cmd']) ? $_GET['cmd'] : "");
    $arr_str = explode("/", $str);
    $arr_str[0] = isset($arr_str[0]) ? $arr_str[0] : "";
    $arr_str[1] = isset($arr_str[1]) ? $arr_str[1] : "";
    $arr_str[2] = isset($arr_str[2]) ? $arr_str[2] : "";
    $arr_str[3] = isset($arr_str[3]) ? $arr_str[3] : "";
    $a = $function->sql_injection($arr_str[0]);
    $b = $function->sql_injection($arr_str[1]);
    $c = $function->sql_injection($arr_str[2]);
    $d = $function->sql_injection($arr_str[3]);

////////// ngay hom nay
    $date_today = date("D, d-m-y");
    $smarty->assign("date_today", $date_today);

////////// kiem tra ngon ngu
    $smarty->assign("lang_auge_check", LANG_AUGE);
    $smarty->assign("cate_product", LANG_IDPRODUCT);

// Check is mobile
    $isMobile = $function->isMobile();
    if ($isMobile == 1) {
        $smarty->assign("isMobile", $isMobile);
    }
////////// giao dien
    $themes = THEMES;
    $smarty->assign("themes", $themes);

////////// lay session_id kiem tra so don hang trong gio
    $_SESSION[URL_HOME]["Shopping"] = $function->sql_injection(session_id());
    $so_don_hang = $oCart->check_cart_session($function->sql_injection($_SESSION[URL_HOME]["Shopping"]));
    $smarty->assign("so_don_hang", $so_don_hang);
    $_SESSION[URL_HOME]["so_don_hang"] = $so_don_hang;

////////// kiem tra id dang nhap
    $smarty->assign("session_logined_user", $_SESSION[URL_HOME]['logined_user']);
    $smarty->assign("login_check", LOGINED_TRUE);
    $smarty->assign("userid_u", isset($_SESSION[URL_HOME]["userid_u"]) ? $_SESSION[URL_HOME]["userid_u"] : "");
    $smarty->assign("username_u", isset($_SESSION[URL_HOME]["username_u"]) ? $_SESSION[URL_HOME]["username_u"] : "");
    $smarty->assign("user_role_u", isset($_SESSION[URL_HOME]["user_role_u"]) ? $_SESSION[URL_HOME]["user_role_u"] : "");
    $smarty->assign("firstname_u", isset($_SESSION[URL_HOME]["firstname_u"]) ? $_SESSION[URL_HOME]["firstname_u"] : "");
    $smarty->assign("email_u", isset($_SESSION[URL_HOME]["email_u"]) ? $_SESSION[URL_HOME]["email_u"] : "");
    $smarty->assign("mobile_u", isset($_SESSION[URL_HOME]["mobile_u"]) ? $_SESSION[URL_HOME]["mobile_u"] : "");
    $smarty->assign("status_u", isset($_SESSION[URL_HOME]["status_u"]) ? $_SESSION[URL_HOME]["status_u"] : "");
    $smarty->assign("address_u", isset($_SESSION[URL_HOME]["address_u"]) ? $_SESSION[URL_HOME]["address_u"] : "");
    $smarty->assign("city_u", isset($_SESSION[URL_HOME]["city_u"]) ? $_SESSION[URL_HOME]["city_u"] : "");
    $smarty->assign("district_u", isset($_SESSION[URL_HOME]["district_u"]) ? $_SESSION[URL_HOME]["district_u"] : "");

/////////// tu khoa - link chia se seo
    $link_web = $_SERVER['REQUEST_URI'];
    $smarty->assign("link_web", $link_web);

////////// chuyen name url sang category_id
    $rs_category = $oNews->category_name($a);
    $smarty->assign("rs_category", $rs_category);
    $category_id = $rs_category["category_id"];
    $parent_id = $rs_category["parent_id"];
    $category_url = $rs_category["category_url"];
    $category_name = $rs_category["category_name"];
    $category_content = $rs_category["category_content"];
    $category_img = $rs_category["category_img"];
    $layout_home = $rs_category["layout"];
    $category_color = $rs_category["color"];
    if ($a == '') {
        $category_id = '0';
    }

/////////// kiem tra category va supcate
    if ($a == '') {
        $url_category = "index.html";
        $url_supcate = "index.html";
    } else {

        $num_parent_id = $oNews->num_parent_id($category_id);

        if ($num_parent_id > 0) {
            $smarty->assign("url_category", $a);
            $url_category = $a;
            $numf_category = $oNews->check_category_url($url_category);
            if ($numf_category == 1) {
                $url_category = $url_category;
            } else {
                $url_category = "index.html";
            }
        } else {
            $smarty->assign("url_supcate", $a);
            $url_supcate = $a;
            $numf_supcate = $oNews->check_category_url($url_supcate);

            if ($numf_supcate == 1) {
                $url_supcate = $url_supcate;
            } else {
                $url_supcate = "index.html";
            }
        }
    }

/////////// doi link chi tiet san pham
    $smarty->assign("url_views", $a);
    $url_views = $a;
    if ($url_views == '') {
        $url_views = "index.html";
    } else {
        $arr_views = explode("-", $a);
        $product_id = $function->sql_injection($arr_views[0]);
        $numf_views = $oNews->check_product_id($product_id);
        if ($numf_views == 1) {
            $url_views = $url_views;
        } else {
            $url_views = "index.html";
        }
    }
    // list country
    $rs_list_country = $oNews->show_list_country();
    $smarty->assign("rs_list_country", $rs_list_country);

    // list number mobile
    $rs_mobile_code = $oNews->show_list_mobile_code();
    $smarty->assign("rs_mobile_code", $rs_mobile_code);

    // Get all language
    $list_language = $oNews->get_all_language();
    $smarty->assign("list_language", $list_language);

    // translate from/to
    $rs_all_language = $oMember->show_all_language();
    $smarty->assign("rs_all_language", $rs_all_language);

    // subject field
    $rs_all_subject_field = $oMember->show_all_subject_field();
    $smarty->assign("rs_all_subject_field", $rs_all_subject_field);


    // Normal login
    if ($_SESSION[URL_HOME]["is_login"]) {
        $show_member = $oMember->show_member_id($function->sql_injection($_SESSION[URL_HOME]["userid_u"]));
        $smarty->assign("show_member", $show_member);

        $number_notices = $oMember->show_number_order_notices($_SESSION[URL_HOME]["userid_u"]);
        $smarty->assign("number_notices", $number_notices);
    }

    // Chuyen vien login
    if ($_SESSION[URL_HOME]["is_login_cv"]) {
        $show_expert_user = $oMember->show_expert_user_id($function->sql_injection($_SESSION[URL_HOME]["userid_cv_u"]));

        $getFromtoLanguage = $oMember->show_from_to_language($function->sql_injection($_SESSION[URL_HOME]["userid_cv_u"]));

        $number_trans_notices = $oMember->show_number_trans_notices($_SESSION[URL_HOME]["userid_cv_u"]);
        $smarty->assign("number_trans_notices", $number_trans_notices);

        // List special category name
        $listSpecialCategory = explode(',', $show_expert_user['special_category']);
        foreach ($listSpecialCategory as $key => $value) {
            $listSpecialName[] = $oMember->show_special_category_name($value);
        }

        $smarty->assign("show_member_language", $getFromtoLanguage);
        $smarty->assign("show_member", $show_expert_user);
        $smarty->assign("show_member_category", $listSpecialName);
        $smarty->assign("show_member_about", $show_expert_user['about']);

        $show_software = $oMember->show_list_software($function->sql_injection($_SESSION[URL_HOME]["userid_cv_u"]));
        $smarty->assign("show_software", $show_software);

        $show_service = $oMember->show_list_service($function->sql_injection($_SESSION[URL_HOME]["userid_cv_u"]));
        $smarty->assign("show_service", $show_service);
    }
////////////////////////////////////////////////////////////////////////////////////////////////////
// Call session of translator or user
///////////////////////////////////////////////////////////////////////////////////////////////////
    if ($_SESSION[URL_HOME]['logined_user']) {
        $smarty->assign('isLogin', $_SESSION[URL_HOME]['logined_user']);
    } else {
        if ($_SESSION[URL_HOME]['logined_user_cv']) {
            $smarty->assign('isLogin_cv', $_SESSION[URL_HOME]['logined_user_cv']);
        }
    }

    $all_order_numbers = $oMember->show_all_number_order($_SESSION[URL_HOME]["userid_u"]);
    $smarty->assign('all_order_numbers', $all_order_numbers);

    $rs_numbers = $oMember->show_numer_order_active($_SESSION[URL_HOME]["userid_u"]);
    $smarty->assign('rs_numbers', $rs_numbers);

    $rs_final_numbers = $oMember->show_numer_order_final($_SESSION[URL_HOME]["userid_u"]);
    $smarty->assign('rs_final_numbers', $rs_final_numbers);

    $rs_cancel_numbers = $oMember->show_numer_order_cancel($_SESSION[URL_HOME]["userid_u"]);
    $smarty->assign('rs_cancel_numbers', $rs_cancel_numbers);

    $rs_accept_number = $oMember->show_numer_accept_active($_SESSION[URL_HOME]["userid_cv_u"]);
    $smarty->assign('rs_accept_number', $rs_accept_number);

    $rs_finalize_number = $oMember->show_numer_accept_finalize($_SESSION[URL_HOME]["userid_cv_u"]);
    $smarty->assign('rs_finalize_number', $rs_finalize_number);

    // Get list industry
    $list_industry_menu = $oNews->get_all_special_category(10);
    $smarty->assign("list_industry_menu", $list_industry_menu);

    // Get list service
    $list_service_menu = $oNews->get_list_study_abroad(10);
    $smarty->assign("list_service_menu", $list_service_menu);

    // Get list news
    $list_news_category_menu = $oNews->get_list_news_category(10);
    $smarty->assign("list_news_category_menu", $list_news_category_menu);

    // Get list contact
    $list_contact = $oNews->get_list_contact();
    $smarty->assign("list_contact", $list_contact);

    // Get list hoc bong
    $list_hoc_bong = $oNews->get_list_category(LANG_HOC_BONG);
    $smarty->assign("list_hoc_bong", $list_hoc_bong);

    // Get list chuong trinh
    $list_chuong_trinh = $oNews->get_list_category(LANG_CHUONG_TRINH);
    $smarty->assign("list_chuong_trinh", $list_chuong_trinh);

    switch (strtolower($a)) {
        /////////////////////////////////////////////Trang chu/////////////////////////////////////
        case 'index':
        default:
            $smarty->assign("home", 1);
            $smarty->assign("category_id", 1);
            $smarty->assign("category_hover", "trang-chu");
            $_SESSION[URL_HOME]['tinseo'] = $function->sql_injection($_SERVER['REQUEST_URI']);

            //Seo google
            $rs_key = $oNews->show_keyword(0, 5, 1);
            $smarty->assign("rs_key", $rs_key);

            $order_rs = 'ORDER BY cc.news_id desc';
            // All job
            $result = $oNews->show_all_filter_home(0, 10, 0, 0, 1, 0, 'all', 'all', 'all', 'all', 'all', 'all',
                $order_rs, 2);
            $smarty->assign("rs", $result);

            // Get all banner
            $list_banner_home = $oNews->show_all_coupons_banner(LANG_IDHOME, 0, 0, 100);
            $smarty->assign("list_banner_home", $list_banner_home);

            $list_banner = $oNews->show_all_coupons_banner(LANG_ABOUT, 0, 0, 100);
            $smarty->assign("list_banner", $list_banner);

            // Get all translator
            $all_partner = $oMember->get_all_partner();
            $smarty->assign("all_partner", $all_partner);

            // Get all news category
            $list_news_category = $oNews->get_list_news_category();
            $smarty->assign("list_news_category", $list_news_category);

            //////////////////////////////////////////////////////
            // Get list category content
            //////////////////////////////////////////////////////
            $list_category_content = $oNews->get_list_category(LANG_THONG_TIN_DU_HOC);
            $smarty->assign("list_category_content", $list_category_content);

            //////////////////////////////////////////////////////
            // Get all list content industry
            //////////////////////////////////////////////////////
            $list_content_industry = $oNews->get_list_industry_content(null, 0, 10, 0, 0);
            $smarty->assign("list_content_industry", $list_content_industry);

            // count all data content industry
            $count_list_industry = $oNews->count_list_industry_content(null, 0, 0);
            $total_pages = ceil($count_list_industry / 10);
            $smarty->assign("total_pages", $total_pages);

            $list_news_slide = $oNews->get_slide_industry_content(null, 0, 10, 1);
            $smarty->assign("list_news_slide", $list_news_slide);

            // Get data index
            $array_const = [
                LANG_ABOUT,
                LANG_DAI_HOC,
                LANG_MAJOR_INDUSTRY,
                LANG_LINKRICA_TEAM,
                LANG_OUR_TRANSLATOR,
                LANG_QUALITY,
                LANG_REGISTER,
                LANG_DU_HOC,
                LANG_HOC_BONG,
                LANG_HANH_TRINH,
                LANG_WELCOME
            ];
            $content_index = $oNews->get_category_content($array_const);
            $smarty->assign("content_index", $content_index);

            // Get data Quality Assurance
            $list_content_quality = $oNews->get_sub_list_category(LANG_QUALITY);
            $smarty->assign("list_content_quality", $list_content_quality);

            //////////////////////////////////////////////////////
            // Get all list content
            //////////////////////////////////////////////////////
            $list_blog_center = $oNews->get_list_blog(121, 0, 6);
            $smarty->assign("list_blog_center", $list_blog_center);

            //////////////////////////////////////////////////////
            // Get all list du hoc
            //////////////////////////////////////////////////////
            $list_du_hoc = $oNews->get_list_study_abroad(20);
            $smarty->assign("list_du_hoc", $list_du_hoc);

            return $smarty->fetch($themes . "/index.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "about-us":
            $smarty->assign("aboutus", 1);

            // Get data index
            $array_const = [
                LANG_ABOUT,
                LANG_HO_SO_DU_HOC,
                LANG_DU_HOC_HE_SU_MENH_GIA_TRI,
                LANG_DU_HOC,
                LANG_HOC_BONG,
                LANG_CHUONG_TRINH,
                LANG_FIND_SCHOOL
            ];
            $content_index = $oNews->get_category_content($array_const);
            $smarty->assign("content_index", $content_index);

            // Get list array data
            $list_content = $oNews->get_sub_list_category(LANG_DU_HOC_HE_SU_MENH_GIA_TRI);
            $smarty->assign("list_content", $list_content);

            // Get list slider img
            $list_content = $oNews->show_all_coupons_banner(LANG_ABOUT_SLIDER_IMG,0, 0, 50);
            $smarty->assign("list_slider_img", $list_content);

            $list_content1 = $oNews->get_sub_list_category(LANG_HO_SO_DU_HOC);
            $smarty->assign("list_content1", $list_content1);

            return $smarty->fetch($themes . "/web/aboutus.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "blog":
            $smarty->assign("blog", 1);
            //////////////////////////////////////////////////////
            // Get all list content
            //////////////////////////////////////////////////////
            $list_blog_center = $oNews->get_list_blog(LANG_BLOG_CENTER, 0, 6);
            $smarty->assign("list_blog_center", $list_blog_center);

            $list_blog_right = $oNews->get_list_blog(LANG_BLOG_RIGHT, 0, 10);
            $smarty->assign("list_blog_right", $list_blog_right);

            return $smarty->fetch($themes . "/web/blog.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "blog-detail":
            $smarty->assign("blog", 1);
            $paramId = $function->sql_injection($b);
            $blog_content = $oNews->get_detail_blog_content($paramId);
            $smarty->assign("blog_content", $blog_content);

            // Get right content
            $list_blog_center = $oNews->get_list_blog(LANG_BLOG_CENTER, 0, 30);
            $smarty->assign("list_blog_center", $list_blog_center);


            $list_blog_right = $oNews->get_list_blog(LANG_BLOG_RIGHT, 0, 10);
            $smarty->assign("list_blog_right", $list_blog_right);

            return $smarty->fetch($themes . "/web/blog_detail.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "news-top":
            $smarty->assign("news", 1);
            // Get all banner
            $list_banner_home = $oNews->show_all_coupons_banner(LANG_IDNEWS, 0, 0, 1);
            $smarty->assign("list_banner_home", $list_banner_home);

            // Get all news category
            $list_news_category = $oNews->get_list_news_category();
            $smarty->assign("list_news_category", $list_news_category);

            // Get data of news category
            $array_const = [LANG_MAJOR_INDUSTRY];
            $content_index = $oNews->get_category_content($array_const);
            $smarty->assign("content_index", $content_index);

            //////////////////////////////////////////////////////
            // Get all list content industry
            //////////////////////////////////////////////////////
            $list_content_industry = $oNews->get_list_industry_content(null, 0, 10, 0, 0);
            $smarty->assign("list_content_industry", $list_content_industry);

            // count all data content industry
            $count_list_industry = $oNews->count_list_industry_content(null, 0, 0);
            $total_pages = ceil($count_list_industry / 10);
            $smarty->assign("total_pages", $total_pages);

            $list_news_slide = $oNews->get_slide_industry_content(null, 0, 10, 1);
            $smarty->assign("list_news_slide", $list_news_slide);

            return $smarty->fetch($themes . "/web/news.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "news":
           $smarty->assign("industry", 1);
           $arr_detail = explode("-", $b);
           $paramId = $function->sql_injection($arr_detail[0]);
           $smarty->assign("main_cate", $paramId);

           // Get content industry
           $industry_content = $oNews->get_news_category_content($paramId);
           $smarty->assign("industry_content", $industry_content);

           $list_content_industry = $oNews->get_list_industry_content($paramId, 0, 100, 0, 0);
           $smarty->assign("list_content_industry", $list_content_industry);

           return $smarty->fetch($themes . "/web/industry.html");
            break;

///////////////////////////////////////////////////////////////////////////////////////////////////////
        case "news-detail":
            $smarty->assign("industry", 1);
            $paramId = $function->sql_injection($b);

            // Get main category
            $main_cate = $oNews->get_cate_industry($paramId);
            $smarty->assign("main_cate", $main_cate[0]['news_category']);

            // Get content industry
            $industry_content = $oNews->get_news_category_content($main_cate[0]['news_category']);
            $smarty->assign("industry_content", $industry_content);

            // List other content
            $list_content_industry = $oNews->get_list_industry_content($main_cate[0]['news_category'], 0, 100, 0, 0);
            $smarty->assign("list_content_industry", $list_content_industry);

            // Detail content
            $detail_content_industry = $oNews->get_detail_industry_content($paramId);
            $smarty->assign("detail_content_industry", $detail_content_industry);

            // tags title
            $tags_array = explode(',', $detail_content_industry[0]['news_tags']);
            $tags_title = "";
            foreach ($tags_array as $tag_value) {
                $tags_title .= "<span><a class=\"btn btn-border btn-sm\" href=\"#\"><i class=\"fa fa-tag\"></i> $tag_value</a></span>";
            }
            $smarty->assign("tags_title", $tags_title);
            return $smarty->fetch($themes . "/web/industry_detail.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "program":
            $smarty->assign("program", 1);

            // Get list program
            $list_chuong_trinh = $oNews->get_list_category(LANG_CHUONG_TRINH);
            $smarty->assign("list_chuong_trinh", $list_chuong_trinh);

            return $smarty->fetch($themes . "/web/program.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "pg-detail":
            $smarty->assign("program", 1);
            $arr_detail = explode("-", $b);
            $paramId = $function->sql_injection($arr_detail[0]);
            $smarty->assign("main_cate", $paramId);

            // Get content service
            $pg_content = $oNews->category_name_category_id($paramId);
            $smarty->assign("pg_content", $pg_content);

            // Get list program
            $list_chuong_trinh = $oNews->get_list_category(LANG_CHUONG_TRINH);
            $smarty->assign("list_chuong_trinh", $list_chuong_trinh);

            return $smarty->fetch($themes . "/web/program_detail.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "hocbong-top":
            $smarty->assign("hocbong", 1);

            // Get data of news category
            $array_const = [LANG_HOC_BONG];
            $content_index = $oNews->get_category_content($array_const);
            $smarty->assign("content_index", $content_index);

            $list_banner_home = $oNews->show_all_coupons_banner(LANG_DU_HOC, 0, 0, 1);
            $smarty->assign("list_banner_home", $list_banner_home);

            // Get list hoc bong
            $list_hoc_bong = $oNews->get_list_category(LANG_HOC_BONG);
            $smarty->assign("list_hoc_bong", $list_hoc_bong);

            return $smarty->fetch($themes . "/web/hocbong_top.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "hocbong":
            $smarty->assign("hocbong", 1);
            $arr_detail = explode("-", $b);
            $paramId = $function->sql_injection($arr_detail[0]);
            $smarty->assign("main_cate", $paramId);

            $hocbong_content = $oNews->category_name_category_id($paramId);
            $smarty->assign("hocbong_content", $hocbong_content);

            // Get total record
            $count_scholarship_center = $oNews->num_scholarship($paramId, 0);
            $smarty->assign("count_scholarship_center", $count_scholarship_center);

            // Get center content
            $per_page = 5;
            $list_scholarship_center = $oNews->get_list_scholarship($paramId, 0, 0, $per_page);
            $smarty->assign("list_scholarship_center", $list_scholarship_center);

            // get right content
            $list_scholarship_right = $oNews->get_list_scholarship($paramId, 1, 0, 10);
            $smarty->assign("list_scholarship_right", $list_scholarship_right);

            return $smarty->fetch($themes . "/web/hocbong.html");
            break;
///////////////////////////////////////////////////////////////////////////////////////////////////////
        case "hb-detail":
            $smarty->assign("hocbong", 1);
            $arr_detail = explode("-", $b);
            $paramId = $function->sql_injection($arr_detail[0]);
            $smarty->assign("main_cate", $paramId);

            // Get main category
            $main_cate = $oNews->get_cate_scholarship($paramId);
            $smarty->assign("main_cate", $main_cate[0]['news_category']);

            $hocbong_content = $oNews->category_name_category_id($main_cate[0]['news_category']);
            $smarty->assign("hocbong_content", $hocbong_content);

            // Get all news category
            $list_news_category = $oNews->get_list_news_category();
            $smarty->assign("list_news_category", $list_news_category);

            // Detail content
            $detail_content_hb = $oNews->get_detail_hb_content($paramId);
            $smarty->assign("detail_content_hb", $detail_content_hb);

            // Get content industry
            $industry_content = $oNews->get_news_category_content($main_cate[0]['news_category']);
            $smarty->assign("industry_content", $industry_content);

            // Get right content
            $list_scholarship_center = $oNews->get_list_scholarship($main_cate[0]['news_category'], 0, 0, 30);
            $smarty->assign("list_scholarship_center", $list_scholarship_center);

            $list_scholarship_right = $oNews->get_list_scholarship($main_cate[0]['news_category'], 1, 0, 10);
            $smarty->assign("list_scholarship_right", $list_scholarship_right);

            return $smarty->fetch($themes . "/web/hocbong_detail.html");
            break;

////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "duhoc-top":
            $smarty->assign("duhoc", 1);

            $list_banner_home = $oNews->show_all_coupons_banner(LANG_DU_HOC, 0, 0, 1);
            $smarty->assign("list_banner_home", $list_banner_home);

            // Get data index
            $list_cate_study_abroad = $oNews->get_list_cate_study_abroad();
            $smarty->assign("list_cate_study_abroad", $list_cate_study_abroad);

            $arr_study_abroad = array();
            for ($i = 0; $i < count($list_cate_study_abroad); $i++) {
                $arr_study_abroad[$i] = $oNews->get_list_service_content($list_cate_study_abroad[$i]["id"], 1000);
            }
            $smarty->assign("arr_study_abroad", $arr_study_abroad);

            $arr_news_study = array();
            for ($i = 0; $i < count($list_cate_study_abroad); $i++) {
                $arr_news_study[$i] = $oNews->show_new_detail_category($list_cate_study_abroad[$i]["id"], 4);
            }

            $smarty->assign("arr_news_study", $arr_news_study);

            return $smarty->fetch($themes . "/web/duhoc_top.html");
            break;

////////////////////////////////////////////////////////////////////////////////////////////////////////
        // du học sub
        case "duhoc":
            $smarty->assign("service", 1);
            $arr_detail = explode("-", $b);
            $paramId = $function->sql_injection($arr_detail[0]);
            $smarty->assign("main_cate", $paramId);
            $list_banner_home = [];
            if ($paramId) {
                $list_banner_home = $oNews->get_detail_study_abroad($paramId);
            }
            $smarty->assign("list_banner_home", $list_banner_home);

            //data top slider
            $duhoc_slide = $oNews->get_duhoc_slide_by_id($paramId);
            $smarty->assign("duhoc_slide", $duhoc_slide);

            // Get main content du hoc
            $duhoc_main_content = $oNews->get_duhoc_main_content_by_id($paramId);
            $smarty->assign("duhoc_main_content", $duhoc_main_content);

            // Sub content of du hoc
            $duhoc_sub_content = $oNews->get_duhoc_sub_content_by_id($paramId);
            $smarty->assign("list_duhoc_sub_content", $duhoc_sub_content);

            // Get list chuong trinh du hoc
            $duhoc_program_cate = $oNews->get_list_duhoc_program($paramId);
            $smarty->assign("duhoc_program_cate", $duhoc_program_cate);

            $programStr = '';
            foreach ($duhoc_program_cate as $value) {
                $programStr .= $value['news_id']. ",";
            }
            $programStrNew = rtrim($programStr, ",");
            $duhoc_program_data = $oNews->get_list_data_program($programStrNew);
            $smarty->assign("duhoc_program_data", $duhoc_program_data);

            // Get list hoc bong
            $duhoc_content = $oNews->get_scholarship_by_id($paramId);
            $smarty->assign("list_duhoc_content", $duhoc_content);
            $smarty->assign("hocbong_cate", $duhoc_content[0]['news_category']);

            // Get list news of du hoc
            $list_duhoc_news = $oNews->get_duhoc_news_by_id($paramId);
            $smarty->assign("list_duhoc_news", $list_duhoc_news);

            // Get list img of du hoc
            $list_duhoc_imgages = $oNews->get_duhoc_img_by_id($paramId);
            $smarty->assign("list_duhoc_images", $list_duhoc_imgages);

            return $smarty->fetch($themes . "/web/duhoc.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Service sub
        case "program-detail":
            $smarty->assign("duhoc", 1);
            $paramId = $function->sql_injection($b);

            // get detail program
            $program_content = $oNews->get_detail_program($paramId);
            $smarty->assign("program_content", $program_content);

            // Get list img
            $list_program_imgages = $oNews->get_list_program_img_by_id($paramId);
            //$function->debugPrint($list_program_imgages);
            $smarty->assign("list_program_images", $list_program_imgages);

            // Get list other program
            $duhoc_program_data = $oNews->get_list_data_program($program_content[0]['news_category']);
            $smarty->assign("duhoc_program_data", $duhoc_program_data);

            return $smarty->fetch($themes . "/web/duhoc_program_detail.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "dh-news":
            $smarty->assign("duhoc", 1);
            $paramId = $function->sql_injection($b);
            // Get main content du hoc
            $duhoc_news_content = $oNews->get_duhoc_content_news_by_id($c);
            $smarty->assign("duhoc_news_content", $duhoc_news_content);

            // Get list chuong trinh du hoc
            $duhoc_program_cate = $oNews->get_list_duhoc_program($paramId);
            $smarty->assign("duhoc_program_cate", $duhoc_program_cate);

            $programStr = '';
            foreach ($duhoc_program_cate as $value) {
                $programStr .= $value['news_id']. ",";
            }
            $programStrNew = rtrim($programStr, ",");
            $duhoc_program_data = $oNews->get_list_data_program($programStrNew);
            $smarty->assign("duhoc_program_data", $duhoc_program_data);

            return $smarty->fetch($themes . "/web/duhoc_all_news.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "dh-detail":
            $smarty->assign("duhoc", 1);
            $paramId = $function->sql_injection($b);

            // get detail news
            $news_content = $oNews->get_detail_duhoc_news($paramId);
            $smarty->assign("news_content", $news_content);

            // Get list other news du hoc
            $duhoc_news_data = $oNews->get_list_duhoc_news($news_content[0]['news_category']);
            $smarty->assign("news_data", $duhoc_news_data);

            return $smarty->fetch($themes . "/web/duhoc_news_detail.html");
            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "register":
            $smarty->assign("register", 1);

            break;
////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "contact":
            $smarty->assign("contact", 1);
            // Get all banner
            $list_banner_home = $oNews->show_all_coupons_banner(LANG_CONTACT, 0, 0, 1);
            $smarty->assign("list_banner_home", $list_banner_home);
            return $smarty->fetch($themes . "/web/contact.html");
            break;

////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "contact-exe":

            $_SESSION['tinseo'] = $function->sql_injection($_SERVER['REQUEST_URI']);
            //$function->debugPrint($_POST);exit;
            $smarty->assign("name_home", lang_lien_he);
            $smarty->assign("category_hover", "lien-he");

            $smarty->assign("seo_title", "Liên hệ");
            $smarty->assign("seo_key", "Liên hệ");
            $smarty->assign("seo_desc", "Liên hệ");

            $txt_name = $function->sql_injection($_POST["name"]);
            $txt_email = $function->sql_injection($_POST["email"]);
            $txt_messages = $function->sql_injection($_POST["messages"]);

            if ($_POST["submitContact"]) {
                $body = "<div style='font-size:20px;'>Thông tin liên hệ từ website " . lang_website . ":</div>
                <br/>
                <div>Họ & tên: <strong>" . $txt_name . "</strong></div>
                <div>Email: <strong>" . $txt_email . "</strong></div>
                <div>Nội dung : <strong>" . $txt_messages . "</strong></div>";

                $to_admin = lang_email;
                $from = lang_email;
                $title = lang_member_title_mail . lang_website;
                $FromName = 'Được gửi từ ' . $txt_email;

                $function->smtpmailer($to_admin, $from, $FromName, $title, $body);
                $function->goto_url(URL_HOMEPAGE . "contact-thanks.html");
            } else {
                return $smarty->fetch($themes . "/web/contact.html");
            }
            break;

        case "contact-thanks":
            $smarty->assign("name_home", lang_thongbao);
            return $function->msg_box_new(lang_main_support, 5, URL_HOMEPAGE);
            break;

////////////////////////////////////////////////////////////////////////////////////////////////////////
        case "search":
            $smarty->assign("name_home", lang_search_product);
            $arr_str = explode("-", $b);
            $paramSearch = $arr_str[0];
            $valueSearch = $arr_str[1];
            $_SESSION[URL_HOME]['param_search'] = $function->sql_injection($paramSearch);
            $_SESSION[URL_HOME]['value_search'] = $function->sql_injection($valueSearch);
            $function->goto_url(URL_HOMEPAGE . "search_detail.html");
            break;
        //////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////search detail/////////////////////////////////
        case "search_detail":
            $smarty->assign("name_home", lang_search_product);
            $param_search = $_SESSION[URL_HOME]['param_search'];
            $value_search = $_SESSION[URL_HOME]['value_search'];

// Search job
            $result = $oNews->search_coupons_coupons($param_search, $value_search);
//$function->debugPrint($result);
            $smarty->assign("result", $result);

            $rs_news_industry = $oMember->show_all_industry(10);
            $smarty->assign("rs_news_industry", $rs_news_industry);

            return $smarty->fetch($themes . "/user/search_order.html");
            break;

        //////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////Email //////////////////////////////////////
        case "email-add":
            $_SESSION[URL_HOME]['tinseo'] = $function->sql_injection($_SERVER['REQUEST_URI']);
            global $db, $smarty, $function, $general;

            $txt_email = $function->sql_injection($_POST["txt_email"]);
            $txt_name = $function->sql_injection($_POST["txt_name"]);
            $txt_tel = $function->sql_injection($_POST["txt_tel"]);
            $txt_address = $function->sql_injection($_POST["txt_address"]);
            $txt_content = "Email";

            if ($_POST["button"]) {
                $oNews->add_table_support($txt_email, $txt_name, $txt_tel, $txt_address, $txt_content);
                $function->goto_url(URL_HOMEPAGE . "email-thanks.html");
            } else {
                $function->goto_url(URL_HOMEPAGE);
            }
            break;
        case "email-thanks":
            $smarty->assign("name_home", lang_thongbao);
            $smarty->assign("category_hover", "support");

            return $function->msg_box_new(lang_main_support, 3, URL_HOMEPAGE);
            break;

        ///////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////Product new link/////////////////////////////
        case $url_category:

            $_SESSION[URL_HOME]['tinseo'] = $function->sql_injection($_SERVER['REQUEST_URI']);
            //Seo google
            $smarty->assign("seo_title", $function->sql_injection($rs_category["seo_title"]));
            $smarty->assign("seo_key", $function->sql_injection($rs_category["seo_key"]));
            $smarty->assign("seo_desc", $function->sql_injection($rs_category["seo_desc"]));
            $rs_key = $oNews->show_keyword(0, 5, $category_id);
            $smarty->assign("rs_key", $rs_key);

            //Category hien tai
            $_SESSION[URL_HOME]["category_id"] = $category_id;
            $smarty->assign("category_hover", $category_url);
            $smarty->assign("category_name", $category_name);
            $smarty->assign("category_id", $category_id);
            $smarty->assign("category_content", $category_content);
            $smarty->assign("category_img", $category_img);
            $smarty->assign("category_color", $category_color);

            //Category cha
            $new_cat_name_con = $oNews->category_all_parent_id($parent_id);
            $smarty->assign("new_cat_name_con", $new_cat_name_con);
            $smarty->assign("supcate_hover", $new_cat_name_con["category_url"]);
            $smarty->assign("supcate_name", $new_cat_name_con["category_name"]);
            $smarty->assign("supcate_content", $new_cat_name_con["category_content"]);
            $_SESSION[URL_HOME]["category_id"] = $new_cat_name_con["category_id"];

            //menu left
            $smarty->assign("catename_left", $category_name);
            $category_left = $oNews->category_all_home(0, $category_id, 0, 20);
            $smarty->assign("category_left", $category_left);

            //Section Product
            $cate_bo = $oNews->category_all_home(0, $category_id, 0, 10);
            for ($i = 0; $i < count($cate_bo); $i++) {
                $cate_pro[$i] = $oNews->show_all_coupons_coupons($cate_bo[$i]["category_id"], 0, 1, 0, 0, 10, 'pos');
            }
            $smarty->assign("cate_bo", $cate_bo);
            $smarty->assign("cate_pro", $cate_pro);

            ///////////////////////////////////////////////////////////////////////////////
            ////////////////////////////// bo loc san pham ////////////////////////////////
            $smarty->assign("cate_filter", $a);
            $smarty->assign("url_filter", $category_url);
            $category_id = $category_id;
            $parent_id = $parent_id;
            $key_cty = '';
            $key_dis = '';
            $key_one = '';
            $key_two = '';
            $key_three = '';
            $key_four = '';
            $arr_link = explode("?", $function->sql_injection($_SERVER['REQUEST_URI']));
            $arr_link[1] = isset($arr_link[1]) ? $arr_link[1] : "";
            $arr_fil = explode("_", $arr_link[1]);
            $arr_fil[1] = isset($arr_fil[1]) ? $arr_fil[1] : "";
            $arr_fil[2] = isset($arr_fil[2]) ? $arr_fil[2] : "";
            $arr_fil[3] = isset($arr_fil[3]) ? $arr_fil[3] : "";
            $arr_fil[4] = isset($arr_fil[4]) ? $arr_fil[4] : "";
            $arr_fil[5] = isset($arr_fil[5]) ? $arr_fil[5] : "";
            $arr_fil[6] = isset($arr_fil[6]) ? $arr_fil[6] : "";

            // bo loc 1
            $check_one = $oNews->num_filter_one($category_id);
            if ($check_one) {
                $category_one = $category_id;
            } else {
                $category_one = $parent_id;
            }
            if ($arr_fil[1] == "" or $arr_fil[1] == "all") {
                $fil_one = 'all';
            } else {
                $fil_one = $arr_fil[1];
                $seo_one = $oNews->seo_filter_one($category_one, $fil_one);;
                $key_one = $seo_one["name"] . " " . $seo_one["filter_name"];
            }
            $smarty->assign("fil_one", $fil_one);
            $smarty->assign("numf_one", $oNews->num_filter_one($category_one));
            $smarty->assign("rs_one", $oNews->show_filter_one($category_one));

            // bo loc 2
            $check_two = $oNews->num_filter_two($category_id);
            if ($check_two) {
                $category_two = $category_id;
            } else {
                $category_two = $parent_id;
            }
            if ($arr_fil[2] == '' or $arr_fil[2] == 'all') {
                $fil_two = 'all';
            } else {
                $fil_two = $arr_fil[2];
                $seo_two = $oNews->seo_filter_two($category_two, $fil_two);
                $key_two = $seo_two["name"] . " " . $seo_two["filter_name"];
            }
            $smarty->assign("fil_two", $fil_two);
            $smarty->assign("numf_two", $oNews->num_filter_two($category_two));
            $smarty->assign("rs_two", $oNews->show_filter_two($category_two));

            // bo loc 3
            $check_three = $oNews->num_filter_three($category_id);
            if ($check_three) {
                $category_three = $category_id;
            } else {
                $category_three = $parent_id;
            }
            if ($arr_fil[3] == '' or $arr_fil[3] == 'all') {
                $fil_three = 'all';
            } else {
                $fil_three = $arr_fil[3];
                $seo_three = $oNews->seo_filter_three($category_three, $fil_three);
                $key_three = $seo_three["name"] . " " . $seo_three["filter_name"];
            }
            $smarty->assign("fil_three", $fil_three);
            $smarty->assign("numf_three", $oNews->num_filter_three($category_three));
            $smarty->assign("rs_three", $oNews->show_filter_three($category_three));

            // bo loc 4
            $check_four = $oNews->num_filter_four($category_id);
            if ($check_four) {
                $category_four = $category_id;
            } else {
                $category_four = $parent_id;
            }
            if ($arr_fil[4] == '' or $arr_fil[4] == 'all') {
                $fil_four = 'all';
            } else {
                $fil_four = $arr_fil[4];
                $seo_four = $oNews->seo_filter_four($category_four, $fil_four);
                $key_four = $seo_four["name"] . " " . $seo_four["filter_name"];
            }
            $smarty->assign("fil_four", $fil_four);
            $smarty->assign("numf_four", $oNews->num_filter_four($category_four));
            $smarty->assign("rs_four", $oNews->show_filter_four($category_four));

            // bo loc tinh thanh
            $rs_priority = $oNews->filter_priority(0, 100);
            $smarty->assign("rs_priority", $rs_priority);
            if ($arr_fil[5] == "" or $arr_fil[5] == "all") {
                $fil_cty = 'all';
            } else {
                $fil_cty = $arr_fil[5];
                $seo_cty = $oNews->seo_filter_cities($fil_cty);
                $key_cty = $seo_cty["cityname"];
            }
            $smarty->assign("fil_cty", $fil_cty);

            // bo loc quan huyen
            $rs_district = $oNews->filter_district(0, 100, $fil_cty);
            $smarty->assign("rs_district", $rs_district);
            if ($arr_fil[6] == "" or $arr_fil[6] == "all") {
                $fil_dis = 'all';
            } else {
                $fil_dis = $arr_fil[6];
                $seo_dis = $oNews->seo_filter_district($fil_dis);
                $key_dis = $seo_dis["district_name"];
            }
            $smarty->assign("fil_dis", $fil_dis);

            //Seo google filter
            if ($key_cty != "") {
                $key_cty = " " . $key_cty;
            } else {
                $key_cty = "";
            }
            if ($key_dis != "") {
                $key_dis = " " . $key_dis;
            } else {
                $key_dis = "";
            }

            if ($key_one != "") {
                $key_one = " " . $key_one;
            } else {
                $key_one = "";
            }
            if ($key_two != "") {
                $key_two = " " . $key_two;
            } else {
                $key_two = "";
            }
            if ($key_three != "") {
                $key_three = " " . $key_three;
            } else {
                $key_three = "";
            }
            if ($key_four != "") {
                $key_four = " " . $key_four;
            } else {
                $key_four = "";
            }

            $key_filter = $key_cty . $key_dis . $key_one . $key_two . $key_three . $key_four;
            $smarty->assign("key_filter", $key_filter);

            ////////////////////////////////// ORDER BY ///////////////////////////////////
            $get_order = $function->sql_injection($arr_str[1]);
            if ($get_order == "") {
                $get_order = '0';
            }
            if ($get_order == '0') {
                $order_by = 'ORDER BY cc.pos desc, cc.created_date desc';
            }
            if ($get_order == 'priceasc') {
                $order_by = 'ORDER BY cc.price_new asc';
                $smarty->assign("hover_gia", "priceasc");
            }
            if ($get_order == 'pricedesc') {
                $order_by = 'ORDER BY cc.price_new desc';
                $smarty->assign("hover_gia", "pricedesc");
            }
            if ($get_order == 'saledesc') {
                $order_by = 'ORDER BY giam_gia desc';
                $smarty->assign("hover_gia", "saledesc");
            }
            if ($get_order == 'viewsdesc') {
                $order_by = 'ORDER BY cc.views desc';
                $smarty->assign("hover_gia", "viewsdesc");
            }

            $page = $function->sql_injection($arr_str[2]);
            if ($page == "") {
                $page = 0;
            }
            $numf = $oNews->num_all_filter(0, $category_id, 1, 0, $fil_one, $fil_two, $fil_three, $fil_four, $fil_cty,
                $fil_dis);

            if ($layout_home == '_NT01') {
                $per_page = 10;
            } else {
                $per_page = 12;
            }

            $all_page = $numf ? $numf : 1;
            $base_url = URL_HOMEPAGE . "{$a}/{$get_order}";
            $url_last = ".html?search" . "_{$fil_one}_{$fil_two}_{$fil_three}_{$fil_four}";
            $paging = $function->generate_page_news($base_url, $url_last, $all_page, $per_page, $page);
            $smarty->assign("paging", $paging);
            $rs = $oNews->show_all_filter($page, $per_page, 0, $category_id, 1, 0, $fil_one, $fil_two, $fil_three,
                $fil_four, 0, 0, $order_by);
            $smarty->assign("rs", $rs);

            //////////////////////////////////Giao dien hien thi //////////////////////////
            $layout = $layout_home;

            return $smarty->fetch($themes . "/web/category.html");
            break;

        ///////////////////////////////////////////////////////////////////////////////////
        // Job of category
        ///////////////////////////////////////////////////////////////////////////////////
        case $url_supcate:
            $_SESSION[URL_HOME]['tinseo'] = $function->sql_injection($_SERVER['REQUEST_URI']);
            //Seo google
            $smarty->assign("seo_title", $function->sql_injection($rs_category["seo_title"]));
            $smarty->assign("seo_key", $function->sql_injection($rs_category["seo_key"]));
            $smarty->assign("seo_desc", $function->sql_injection($rs_category["seo_desc"]));
            $rs_key = $oNews->show_keyword(0, 5, $category_id);
            $smarty->assign("rs_key", $rs_key);

            //Category hien tai
            $smarty->assign("category_hover", $category_url);
            $smarty->assign("category_name", $category_name);
            $smarty->assign("category_id", $category_id);
            $smarty->assign("category_content", $category_content);
            $smarty->assign("category_img", $category_img);

            //Category cha
            $new_cat_name = $oNews->category_all_parent_id($category_id);

            $countProduct = $oNews->check_category_id($category_id);
            $smarty->assign("new_cat_name", $new_cat_name);
            $smarty->assign("new_product_count", $countProduct);
            $smarty->assign("supcate_hover", $new_cat_name_con["category_url"]);
            $smarty->assign("supcate_name", $new_cat_name_con["category_name"]);
            $smarty->assign("supcate_content", $new_cat_name_con["category_content"]);
            $_SESSION[URL_HOME]["category_id"] = $new_cat_name_con["category_id"];

            //category ong noi
            $category_parent_id = $oNews->category_all_parent_id($new_cat_name_con["parent_id"]);
            $smarty->assign("category_parent_id", $category_parent_id);
            $smarty->assign("home_hover", $category_parent_id["category_url"]);
            $smarty->assign("name_home", $category_parent_id["category_name"]);

            //menu left
            $smarty->assign("catename_left", $new_cat_name_con["category_name"]);
            $category_left = $oNews->category_all_home(0, $new_cat_name_con["category_id"], 0, 20);
            $smarty->assign("category_left", $category_left);

            $numf = $oNews->num_ckeck_category($category_id);
            $smarty->assign("numf", $numf);
            if ($numf == '1') {
                $new_detail = $oNews->show_coupons_products_detail($category_id);
                $function->goto_url(URL_HOMEPAGE . $new_detail["news_id"] . "-" . $new_detail["news_url"] . ".html");
            } else {
                ///////////////////////////////////////////////////////////////////////////////
                ////////////////////////////// bo loc san pham ///////////////////////////////
                $smarty->assign("cate_filter", $a);
                $smarty->assign("url_filter", $category_url);
                $category_id = $category_id;
                $parent_id = $parent_id;
                $key_cty = '';
                $key_dis = '';
                $key_one = '';
                $key_two = '';
                $key_three = '';
                $key_four = '';
                $arr_link = explode("?", $function->sql_injection($_SERVER['REQUEST_URI']));
                $arr_link[1] = isset($arr_link[1]) ? $arr_link[1] : "";
                $arr_fil = explode("_", $arr_link[1]);
                $arr_fil[1] = isset($arr_fil[1]) ? $arr_fil[1] : "";
                $arr_fil[2] = isset($arr_fil[2]) ? $arr_fil[2] : "";
                $arr_fil[3] = isset($arr_fil[3]) ? $arr_fil[3] : "";
                $arr_fil[4] = isset($arr_fil[4]) ? $arr_fil[4] : "";
                $arr_fil[5] = isset($arr_fil[5]) ? $arr_fil[5] : "";
                $arr_fil[6] = isset($arr_fil[6]) ? $arr_fil[6] : "";

                // bo loc 1
                $check_one = $oNews->num_filter_one($category_id);
                if ($check_one) {
                    $category_one = $category_id;
                } else {
                    $category_one = $parent_id;
                }
                if ($arr_fil[1] == "" or $arr_fil[1] == "all") {
                    $fil_one = 'all';
                } else {
                    $fil_one = $arr_fil[1];
                    $seo_one = $oNews->seo_filter_one($category_one, $fil_one);;
                    $key_one = $seo_one["name"] . " " . $seo_one["filter_name"];
                }
                $smarty->assign("fil_one", $fil_one);
                $smarty->assign("numf_one", $oNews->num_filter_one($category_one));
                $smarty->assign("rs_one", $oNews->show_filter_one($category_one));

                // bo loc 2
                $check_two = $oNews->num_filter_two($category_id);
                if ($check_two) {
                    $category_two = $category_id;
                } else {
                    $category_two = $parent_id;
                }
                if ($arr_fil[2] == '' or $arr_fil[2] == 'all') {
                    $fil_two = 'all';
                } else {
                    $fil_two = $arr_fil[2];
                    $seo_two = $oNews->seo_filter_two($category_two, $fil_two);
                    $key_two = $seo_two["name"] . " " . $seo_two["filter_name"];
                }
                $smarty->assign("fil_two", $fil_two);
                $smarty->assign("numf_two", $oNews->num_filter_two($category_two));
                $smarty->assign("rs_two", $oNews->show_filter_two($category_two));

                // bo loc 3
                $check_three = $oNews->num_filter_three($category_id);
                if ($check_three) {
                    $category_three = $category_id;
                } else {
                    $category_three = $parent_id;
                }
                if ($arr_fil[3] == '' or $arr_fil[3] == 'all') {
                    $fil_three = 'all';
                } else {
                    $fil_three = $arr_fil[3];
                    $seo_three = $oNews->seo_filter_three($category_three, $fil_three);
                    $key_three = $seo_three["name"] . " " . $seo_three["filter_name"];
                }
                $smarty->assign("fil_three", $fil_three);
                $smarty->assign("numf_three", $oNews->num_filter_three($category_three));
                $smarty->assign("rs_three", $oNews->show_filter_three($category_three));

                // bo loc 4
                $check_four = $oNews->num_filter_four($category_id);
                if ($check_four) {
                    $category_four = $category_id;
                } else {
                    $category_four = $parent_id;
                }
                if ($arr_fil[4] == '' or $arr_fil[4] == 'all') {
                    $fil_four = 'all';
                } else {
                    $fil_four = $arr_fil[4];
                    $seo_four = $oNews->seo_filter_four($category_four, $fil_four);
                    $key_four = $seo_four["name"] . " " . $seo_four["filter_name"];
                }
                $smarty->assign("fil_four", $fil_four);
                $smarty->assign("numf_four", $oNews->num_filter_four($category_four));
                $smarty->assign("rs_four", $oNews->show_filter_four($category_four));

                // bo loc tinh thanh
                $rs_priority = $oNews->filter_priority(0, 100);
                $smarty->assign("rs_priority", $rs_priority);
                if ($arr_fil[5] == "" or $arr_fil[5] == "all") {
                    $fil_cty = 'all';
                } else {
                    $fil_cty = $arr_fil[5];
                    $seo_cty = $oNews->seo_filter_cities($fil_cty);
                    $key_cty = $seo_cty["cityname"];
                }
                $smarty->assign("fil_cty", $fil_cty);

                // bo loc quan huyen
                $rs_district = $oNews->filter_district(0, 100, $fil_cty);
                $smarty->assign("rs_district", $rs_district);
                if ($arr_fil[6] == "" or $arr_fil[6] == "all") {
                    $fil_dis = 'all';
                } else {
                    $fil_dis = $arr_fil[6];
                    $seo_dis = $oNews->seo_filter_district($fil_dis);
                    $key_dis = $seo_dis["district_name"];
                }
                $smarty->assign("fil_dis", $fil_dis);

                //Seo google filter
                if ($key_cty != "") {
                    $key_cty = " " . $key_cty;
                } else {
                    $key_cty = "";
                }
                if ($key_dis != "") {
                    $key_dis = " " . $key_dis;
                } else {
                    $key_dis = "";
                }

                if ($key_one != "") {
                    $key_one = " " . $key_one;
                } else {
                    $key_one = "";
                }
                if ($key_two != "") {
                    $key_two = " " . $key_two;
                } else {
                    $key_two = "";
                }
                if ($key_three != "") {
                    $key_three = " " . $key_three;
                } else {
                    $key_three = "";
                }
                if ($key_four != "") {
                    $key_four = " " . $key_four;
                } else {
                    $key_four = "";
                }

                $key_filter = $key_cty . $key_dis . $key_one . $key_two . $key_three . $key_four;
                $smarty->assign("key_filter", $key_filter);
                ////////////////////////////////// end bo loc /////////////////////////////////

                ////////////////////////////////// ORDER BY ///////////////////////////////////
                $get_order = $function->sql_injection($arr_str[1]);
                if ($get_order == "") {
                    $get_order = '0';
                }
                if ($get_order == '0') {
                    $order_by = 'ORDER BY cc.pos desc, cc.created_date desc';
                }
                if ($get_order == 'priceasc') {
                    $order_by = 'ORDER BY cc.price_new asc';
                    $smarty->assign("hover_gia", "priceasc");
                }
                if ($get_order == 'pricedesc') {
                    $order_by = 'ORDER BY cc.price_new desc';
                    $smarty->assign("hover_gia", "pricedesc");
                }
                if ($get_order == 'saledesc') {
                    $order_by = 'ORDER BY giam_gia desc';
                    $smarty->assign("hover_gia", "saledesc");
                }
                if ($get_order == 'viewsdesc') {
                    $order_by = 'ORDER BY cc.views desc';
                    $smarty->assign("hover_gia", "viewsdesc");
                }

                $page = $function->sql_injection($arr_str[2]);

                if ($page == "") {
                    $page = 0;
                }
                $numf = $oNews->num_all_filter($category_id, 0, 1, 0, $fil_one, $fil_two, $fil_three, $fil_four,
                    $fil_cty, $fil_dis);

                if ($layout_home == '_NT01') {
                    $per_page = 10;
                } else {
                    $per_page = 10;
                }

                $all_page = $numf ? $numf : 1;
                $base_url = URL_HOMEPAGE . "{$a}/{$get_order}";
                $url_last = ".html?search" . "_{$fil_one}_{$fil_two}_{$fil_three}_{$fil_four}";
                $paging = $function->generate_page_news($base_url, $url_last, $all_page, $per_page, $page);
                $smarty->assign("paging", $paging);

                // Du lieu category
                $rs = $oNews->show_all_filter_detail($page, $per_page, $category_id, 0, 1, 0, $fil_one, $fil_two,
                    $fil_three, $fil_four, 0, 0, $order_by);
                $smarty->assign("rs", $rs);
                //////////////////////////////////Giao dien hien thi /////////////////////////////
                //$layout = $layout_home;
                return $smarty->fetch($themes . "/public/content/all_jobs_cate.html");
            }
            break;

        case $url_views;
            $_SESSION[URL_HOME]['tinseo'] = $function->sql_injection($_SERVER['REQUEST_URI']);
            $b = $product_id;
            $smarty->assign("detail", 1);

            if ($_SESSION[URL_ADMIN]["userid"]) {
                $smarty->assign('admin', true);
            }

            //chi tiet san pham
            $new_detail = $oNews->show_products_detail($b);
            //print_r($new_detail);
            $smarty->assign("new_detail", $new_detail);
            $news_category = $new_detail["news_category"];

            //Seo google
            $smarty->assign("seo_title", $function->sql_injection($new_detail["seo_title"]));
            $smarty->assign("seo_key", $function->sql_injection($new_detail["seo_key"]));
            $smarty->assign("seo_desc", $function->sql_injection($new_detail["seo_desc"]));
            $rs_key = $oNews->show_keyword(0, 5, $news_category);
            $smarty->assign("rs_key", $rs_key);

            //hinh anh san pham
            $images = $oNews->show_coupons_img($b);
            $smarty->assign("images", $images);

            //Lua chon khi mua
            $option = $oNews->show_coupons_option($b);
            $smarty->assign("option", $option);

            //Thuoc tinh san pham
            $property = $oNews->show_coupons_property($b);
            $smarty->assign("property", $property);

            //up so lan xem
            $oNews->coupons_products_views($new_detail["news_id"]);

            //show comment
            $bo_cm = $oNews->show_comment(0, 10, $b);
            for ($i = 0; $i < count($bo_cm); $i++) {
                $con_cm[$i] = $oNews->show_comment_con(0, 10, $bo_cm[$i]["id"]);
            }
            $smarty->assign("bo_cm", $bo_cm);
            $smarty->assign("con_cm", $con_cm);

            ///////////////////////////Menu san pham///////////////////////////
            //category hien tai
            $new_cat_name = $oNews->category_name_category_id($news_category);
            $smarty->assign("new_cat_name", $new_cat_name);
            $smarty->assign("category_hover", $new_cat_name["category_url"]);
            $smarty->assign("category_name", $new_cat_name["category_name"]);
            $smarty->assign("category_content", $new_cat_name["category_content"]);

            //category cha
            $category_parent_id = $oNews->category_all_parent_id($new_cat_name["parent_id"]);
            $smarty->assign("category_parent_id", $category_parent_id);
            $smarty->assign("supcate_hover", $category_parent_id["category_url"]);
            $smarty->assign("supcate_name", $category_parent_id["category_name"]);
            $smarty->assign("supcate_content", $category_parent_id["category_content"]);

            //category ong noi
            $category_parent_id_home = $oNews->category_all_parent_id($category_parent_id["parent_id"]);
            $smarty->assign("category_parent_id_home", $category_parent_id_home);
            $smarty->assign("home_hover", $category_parent_id_home["category_url"]);
            $smarty->assign("name_home", $category_parent_id_home["category_name"]);

            //menu left
            $smarty->assign("catename_left", $category_parent_id["category_name"]);
            $category_left = $oNews->category_all_home(0, $category_parent_id["category_id"], 0, 20);
            $smarty->assign("category_left", $category_left);

            //San pham cung loai
            $rs = $oNews->show_all_coupons_coupons($news_category, 0, 1, 0, 0, 20, 'pos', $b);

            $smarty->assign("rs", $rs);

            //////////////////////////////////////////////////////////////////////////////
            ////////////////////////////// bo loc san pham ///////////////////////////////
            $smarty->assign("cate_filter", "supcate");
            $smarty->assign("url_filter", $new_cat_name["category_url"]);
            $category_id = $new_cat_name["category_id"];
            $parent_id = $new_cat_name["parent_id"];

            $arr_link = explode("?", $function->sql_injection($_SERVER['REQUEST_URI']));
            $arr_link[1] = isset($arr_link[1]) ? $arr_link[1] : "";
            $arr_fil = explode("_", $arr_link[1]);
            $arr_fil[1] = isset($arr_fil[1]) ? $arr_fil[1] : "";
            $arr_fil[2] = isset($arr_fil[2]) ? $arr_fil[2] : "";
            $arr_fil[3] = isset($arr_fil[3]) ? $arr_fil[3] : "";
            $arr_fil[4] = isset($arr_fil[4]) ? $arr_fil[4] : "";
            $arr_fil[5] = isset($arr_fil[5]) ? $arr_fil[5] : "";
            $arr_fil[6] = isset($arr_fil[6]) ? $arr_fil[6] : "";

            // bo loc 1
            $check_one = $oNews->num_filter_one($category_id);
            if ($check_one) {
                $category_one = $category_id;
            } else {
                $category_one = $parent_id;
            }
            if ($arr_fil[1] == "" or $arr_fil[1] == "all") {
                $fil_one = 'all';
            } else {
                $fil_one = $arr_fil[1];
                $seo_one = $oNews->seo_filter_one($category_one, $fil_one);;
                $key_one = $seo_one["name"] . " " . $seo_one["filter_name"];
            }
            $smarty->assign("fil_one", $fil_one);
            $smarty->assign("numf_one", $oNews->num_filter_one($category_one));
            $smarty->assign("rs_one", $oNews->show_filter_one($category_one));

            // bo loc 2
            $check_two = $oNews->num_filter_two($category_id);
            if ($check_two) {
                $category_two = $category_id;
            } else {
                $category_two = $parent_id;
            }
            if ($arr_fil[2] == '' or $arr_fil[2] == 'all') {
                $fil_two = 'all';
            } else {
                $fil_two = $arr_fil[2];
                $seo_two = $oNews->seo_filter_two($category_two, $fil_two);
                $key_two = $seo_two["name"] . " " . $seo_two["filter_name"];
            }
            $smarty->assign("fil_two", $fil_two);
            $smarty->assign("numf_two", $oNews->num_filter_two($category_two));
            $smarty->assign("rs_two", $oNews->show_filter_two($category_two));

            // bo loc 3
            $check_three = $oNews->num_filter_three($category_id);
            if ($check_three) {
                $category_three = $category_id;
            } else {
                $category_three = $parent_id;
            }
            if ($arr_fil[3] == '' or $arr_fil[3] == 'all') {
                $fil_three = 'all';
            } else {
                $fil_three = $arr_fil[3];
                $seo_three = $oNews->seo_filter_three($category_three, $fil_three);
                $key_three = $seo_three["name"] . " " . $seo_three["filter_name"];
            }
            $smarty->assign("fil_three", $fil_three);
            $smarty->assign("numf_three", $oNews->num_filter_three($category_three));
            $smarty->assign("rs_three", $oNews->show_filter_three($category_three));

            // bo loc 4
            $check_four = $oNews->num_filter_four($category_id);
            if ($check_four) {
                $category_four = $category_id;
            } else {
                $category_four = $parent_id;
            }
            if ($arr_fil[4] == '' or $arr_fil[4] == 'all') {
                $fil_four = 'all';
            } else {
                $fil_four = $arr_fil[4];
                $seo_four = $oNews->seo_filter_four($category_four, $fil_four);
                $key_four = $seo_four["name"] . " " . $seo_four["filter_name"];
            }
            $smarty->assign("fil_four", $fil_four);
            $smarty->assign("numf_four", $oNews->num_filter_four($category_four));
            $smarty->assign("rs_four", $oNews->show_filter_four($category_four));

            // bo loc tinh thanh
            $rs_priority = $oNews->filter_priority(0, 100);
            $smarty->assign("rs_priority", $rs_priority);
            if ($arr_fil[5] == "" or $arr_fil[5] == "all") {
                $fil_cty = 'all';
            } else {
                $fil_cty = $arr_fil[5];
            }
            $smarty->assign("fil_cty", $fil_cty);
            // bo loc quan huyen
            $rs_district = $oNews->filter_district(0, 100, $fil_cty);
            $smarty->assign("rs_district", $rs_district);
            if ($arr_fil[6] == "" or $arr_fil[6] == "all") {
                $fil_dis = 'all';
            } else {
                $fil_dis = $arr_fil[6];
            }
            $smarty->assign("fil_dis", $fil_dis);
            ////////////////////////////////// end bo loc ////////////////////////////////

            //////////////////////////////////Giao dien hien thi ////////////////////////////////
            $layout = $new_cat_name["layout"];

            return $smarty->fetch($themes . "/web/detail{$layout}.html");
            break;
        //////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////search////////////////////////////////////////
    }
}

?>
