<?php
require 'general/include/config.php';
require('general/class/db_mysql.php');
require 'general/libs/Smarty.class.php';
require('general/class/functions.php');
$smarty = new Smarty;
$function = new Functions;
$db = null;
$db = new db_mysql(DB_HOST, DB_USER, DB_PWD, DB_NAME, false);
$db->db_query("SET NAMES 'utf8'");

session_start();
if (!isset($_SESSION[URL_HOME]["lang"])) {
    $_SESSION[URL_HOME]["lang"] = "en";
}

if ($_SESSION[URL_HOME]["lang"] == "vn") {
    define("LANG_AUGE", '0');
    define("LANG_IDHOME", '1');
    define("LANG_IDPRODUCT", '5');
    define("LANG_IDSERVICE", '9');
    define("LANG_IDSUPPORT", '11');
    define("LANG_IDNEWS", '13');
    //////////////////////////////////
    // New category define
    //////////////////////////////////
    define("LANG_ABOUT", '3');
    define("LANG_DU_HOC_CATEGORY", '95');
    define("LANG_THONG_TIN_DU_HOC", '13');
    define("LANG_CT_BAN_QUAN_TAM", '102');
    define("LANG_HOC_BONG", '103');
    define("LANG_DUONG_DEN_DAI_HOC", '104');
    define("LANG_DAI_HOC_TOP", '105');
    define("LANG_NDTV", '11');
    define("LANG_GIAO_DUC", '106');
    define("LANG_BLOG", '119');
    define("LANG_JOB", '120');
    require('general/include/contact.php');
    include('general/language/language_vn.php');

} else {
    if ($_SESSION[URL_HOME]["lang"] == "en") {
        define("LANG_AUGE", '1');
        define("LANG_IDHOME", '2');
        define("LANG_IDPRODUCT", '90');
        define("LANG_IDSERVICE", '10');
        define("LANG_IDSUPPORT", '12');
        define("LANG_IDNEWS", '14');
        //////////////////////////////////
        // New category define
        //////////////////////////////////
        define("LANG_ABOUT", '4');
        define("LANG_CONTACT", '8');
        define("LANG_DAI_HOC", '95');
        define("LANG_MAJOR_INDUSTRY", '96');
        define("LANG_LINKRICA_TEAM", '97');
        define("LANG_OUR_TRANSLATOR", '98');
        define("LANG_QUALITY", '99');
        define("LANG_REGISTER", '100');
        define("LANG_OUR_MISSION", '105');
        define("LANG_MAKE_US_DIFFERENT", '106');
        define("LANG_WHERE_IS_FIND_US", '110');
        define("LANG_HEAD_TRANSLATOR", '111');
        define("LANG_DU_HOC", '112');
        define("LANG_SERVICE", '126');
        define("LANG_SERVICE_TOP", '10');
        define("LANG_HOC_BONG", '128');
        define("LANG_CHUONG_TRINH", '127');
        define("LANG_BLOG_CENTER", '121');
        define("LANG_BLOG_RIGHT", '122');
        define("LANG_HANH_TRINH", '138');
        define("LANG_WELCOME", '139');
        require('general/include/contact.php');
        include('general/language/language_en.php');
    }
}

require("template/module/news.class.php");
require("template/module/member.class.php");
require("template/module/cart.class.php");
require('general/libraries/Google/gConfig.php');
require('general/libraries/Facebook/autoload.php');
require("template/module/main.php");

include("general/class/thumbnail.class.php");
include("general/class/upload.class.php");

require("template/autohits/marketing.class.php");
require("template/autohits/main.php");

?>
