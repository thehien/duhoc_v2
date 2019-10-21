<?php
// error_reporting(0);
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);
error_reporting(0);
@ini_set('display_errors', 0);
global $db, $smarty, $function;
include("includecms.php");

$module = $function->sql_injection(isset($_GET['module']) ? $_GET['module'] : '');
$oUsers = new Users_class;
$_SESSION[URL_ADMIN]["userid"] = $function->FixQuotes(isset($_SESSION[URL_ADMIN]["userid"]) ? $_SESSION[URL_ADMIN]["userid"] : '');
$r1 = $function->FixQuotes(isset($r1) ? $r1 : '');
$r2 = $function->FixQuotes(isset($r2) ? $r2 : '');
$r1 = $oUsers->get_role_permission($_SESSION[URL_ADMIN]["userid"], 0);
for ($i = 0; $i < count($r1); $i++) {
    $num_parent = $oUsers->check_parent_action($_SESSION[URL_ADMIN]["userid"], $r1[$i]['module_id']);
    if ($num_parent) {
        $r2[$i] = $oUsers->get_role_permission($_SESSION[URL_ADMIN]["userid"], $r1[$i]['module_id']);
    }
}
$smarty->assign("r1", $r1);
$smarty->assign("r2", $r2);

$rs_act = $oUsers->get_coupons_action($_SESSION[URL_ADMIN]["userid"], $module);
$smarty->assign('rs_act', $rs_act);
if ($rs_act['action_views']) {
    $action_views = 'views';
    $smarty->assign("action_views", $action_views);
}
if ($rs_act['action_insert']) {
    $action_insert = 'insert';
    $smarty->assign("action_insert", $action_insert);
}
if ($rs_act['action_edit']) {
    $action_edit = 'edit';
    $smarty->assign("action_edit", $action_edit);
}
if ($rs_act['action_delete']) {
    $action_delete = 'delete';
    $smarty->assign("action_delete", $action_delete);
}
$main_url = $rs_act['link'];
$main_name = $rs_act['content'];
$main_content = $rs_act['name'];

$module_url_views = $function->FixQuotes(isset($_SESSION[$module]['url_views']) ? $_SESSION[$module]['url_views'] : '');
$msg_time = 2;
define("msg_box_action",
    langcms_boxkcq . ". <a  href=" . URL_ADMIN . "?module=homes" . "> " . langcms_boxhome . "</a>.");
define("msg_box_insert_succ", langcms_boxttc . ". <a  href=" . $module_url_views . "> " . langcms_boxchuot . "</a>.");
define("msg_box_edit_succ", langcms_boxcntc . ". <a  href=" . $module_url_views . "> " . langcms_boxchuot . "</a>.");
define("msg_box_delete_succ", langcms_boxxtc . ". <a  href=" . $module_url_views . "> " . langcms_boxchuot . "</a>.");
define("msg_box_status_succ", langcms_boxdtttc . ". <a  href=" . $module_url_views . "> " . langcms_boxchuot . "</a>.");
define("msg_box_copy_succ", langcms_boxsctc . ". <a  href=" . $module_url_views . "> " . langcms_boxchuot . "</a>.");

$module_url_general = $function->FixQuotes(isset($_SESSION[$module]['general']) ? $_SESSION[$module]['general'] : '');
define("msg_box_general_succ",
    langcms_boxttc . ". <a  href=" . $module_url_general . "> " . langcms_boxchuot . "</a>.");
define("msg_box_general_del", langcms_boxxtc . ". <a  href=" . $module_url_general . "> " . langcms_boxchuot . "</a>.");

$module_url_desc = $function->FixQuotes(isset($_SESSION[$module]['description']) ? $_SESSION[$module]['description'] : '');
define("msg_box_desc_succ", langcms_boxttc . ". <a  href=" . $module_url_desc . "> " . langcms_boxchuot . "</a>.");
define("msg_box_desc_del", langcms_boxxtc . ". <a  href=" . $module_url_desc . "> " . langcms_boxchuot . "</a>.");

define("msg_box_erro_info", langcms_boxvlntt . ". <a href='javascript:history.go(-1);'> " . langcms_boxchuot . "</a>.");
define("msg_box_erro_status",
    langcms_boxtthtk . ". <a href='javascript:history.go(-1);'> " . langcms_boxchuot . "</a>.");
define("msg_box_erro_parent",
    langcms_boxvlxh . ". <a href='javascript:history.go(-1);'> " . langcms_boxchuot . "</a>.");
define("msg_box_erro_email", langcms_boxedd . ". <a href='javascript:history.go(-1);'> " . langcms_boxchuot . "</a>.");
define("msg_box_erro_user", langcms_boxtnddd . ". <a href='javascript:history.go(-1);'> " . langcms_boxchuot . "</a>.");
define("msg_box_erro_img", langcms_boxktsm . ". <a href='javascript:history.go(-1);'> " . langcms_boxchuot . "</a>.");
$module_base_url = $function->FixQuotes(isset($_SESSION[$module]['base_url']) ? $_SESSION[$module]['base_url'] : '');
define("msg_box_import", langcms_boxttc . "<a  href=" . $module_base_url . "> " . langcms_boxchuot . "</a>.");
switch ($module) {
    case 'login':
    default:
        $btn_submit = $function->sql_injection(isset($_POST['btn_submit']) ? $_POST['btn_submit'] : "");
        if ($btn_submit) {
            $password = $function->clean_string(md5($_POST["password"]));
            $username = $function->sql_injection($_POST["username"]);

            $check_user = $oUsers->check_user($username);
            if ($check_user == true) {
                $_SESSION[URL_ADMIN]['logined_detail'] = $oUsers->check_login($username, $password);
                if ($_SESSION[URL_ADMIN]['logined_detail'] == true) {
                    $_SESSION[URL_ADMIN]['logined_user'] = LOGINED_TRUE;
                    $_SESSION[URL_ADMIN]['logined'] = true;
                    $function->goto_url(URL_ADMIN . "?module=homes");
                } else {
                    $_SESSION[URL_ADMIN]['logined'] = false;
                    $smarty->assign("warning", "Incorrect Password");
                    $smarty->display("signin.html");
                }
            } else {
                $_SESSION[URL_ADMIN]['logined'] = false;
                $smarty->assign("warning", "Username does not exist");
                $smarty->display("signin.html");
            }
        } else {
            $smarty->display('signin.html');
        }
        break;
    case "logout":
        unset($_SESSION[URL_ADMIN]);
        $function->goto_url(URL_ADMIN);
        break;
    case 'homes':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/homes/main.php");
            $smarty->assign('panel_module', homes());
            $smarty->display('homepage.html');
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'modules':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/modules/main.php");
            $smarty->assign("panel_module", modules_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'trans_order':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/trans_order/main.php");
            $smarty->assign("panel_module", trans_order_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'kinhnghiem':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/kinhnghiem/main.php");
            $smarty->assign("panel_module", kinhnghiem_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'contents':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/contents/main.php");
            $smarty->assign("panel_module", contents_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'team':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/team/main.php");
            $smarty->assign("panel_module", team_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'blogs':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/blogs/main.php");
            $smarty->assign("panel_module", blogs_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'translator_service':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/translator_service/main.php");
            $smarty->assign("panel_module", translator_service_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'duhoc_content':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/duhoc_content/main.php");
            $smarty->assign("panel_module", duhoc_content_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'scholarship':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/scholarship/main.php");
            $smarty->assign("panel_module", scholarship_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'contact':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/contact/main.php");
            $smarty->assign("panel_module", contact_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'service_content':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/service_content/main.php");
            $smarty->assign("panel_module", service_content_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'partner':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/partner/main.php");
            $smarty->assign("panel_module", partner_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'software':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/software/main.php");
            $smarty->assign("panel_module", software_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'service':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/service/main.php");
            $smarty->assign("panel_module", service_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'news_category':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/news_category/main.php");
            $smarty->assign("panel_module", news_category_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'users':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/users/main.php");
            $smarty->assign("panel_module", users_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'users_cv':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/users_cv/main.php");
            $smarty->assign("panel_module", users_cv_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'country':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/country/main.php");
            $smarty->assign("panel_module", country_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'list_language':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/list_language/main.php");
            $smarty->assign("panel_module", list_language_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'area_code':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/area_code/main.php");
            $smarty->assign("panel_module", area_code_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'categorys':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/categorys/main.php");
            $smarty->assign("panel_module", categorys_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'banners':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/banners/main.php");
            $smarty->assign("panel_module", banners_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    // Bo loc
    case 'filterones':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/filterones/main.php");
            $smarty->assign("panel_module", filterones_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'filtertwos':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/filtertwos/main.php");
            $smarty->assign("panel_module", filtertwos_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'filterthrees':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/filterthrees/main.php");
            $smarty->assign("panel_module", filterthrees_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'filterfours':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/filterfours/main.php");
            $smarty->assign("panel_module", filterfours_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'propertys':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/propertys/main.php");
            $smarty->assign("panel_module", propertys_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'cities':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/cities/main.php");
            $smarty->assign("panel_module", cities_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'districts':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/districts/main.php");
            $smarty->assign("panel_module", districts_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'shops':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/shops/main.php");
            $smarty->assign("panel_module", shops_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'onlines':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/onlines/main.php");
            $smarty->assign("panel_module", onlines_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'faqs':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/faqs/main.php");
            $smarty->assign("panel_module", faqs_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'supports':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/supports/main.php");
            $smarty->assign("panel_module", supports_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'keywords':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/keywords/main.php");
            $smarty->assign("panel_module", keywords_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'comments':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/comments/main.php");
            $smarty->assign("panel_module", comments_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'news':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/news/main.php");
            $smarty->assign("panel_module", news_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'products':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/products/main.php");
            $smarty->assign("panel_module", products_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'translater':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/translater/main.php");
            $smarty->assign("panel_module", translater_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'language':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/language/main.php");
            $smarty->assign("panel_module", language_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;

    case 'special':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/special/main.php");
            $smarty->assign("panel_module", special_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'porders':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/porders/main.php");
            $smarty->assign("panel_module", porders_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'purchases':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/purchases/main.php");
            $smarty->assign("panel_module", purchases_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'manages':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/manages/main.php");
            $smarty->assign("panel_module", manages_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'imports':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/imports/main.php");
            $smarty->assign("panel_module", imports_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;
    case 'configs':
        if (isset($_SESSION[URL_ADMIN]['logined']) AND $_SESSION[URL_ADMIN]['logined'] === true AND $_SESSION[URL_ADMIN]['logined_user'] == LOGINED_TRUE) {
            require("module/configs/main.php");
            $smarty->assign("panel_module", configs_process());
            $smarty->display("homepage.html");
        } else {
            $function->goto_url(URL_ADMIN);
        }
        break;

}
?>
