<?php
require('../general/include/config.php');
require('../general/class/db_mysql.php');
require('../general/class/functions.php');
require '../general/libs/Smarty.class.php';

session_start();
if (!isset($_SESSION[URL_ADMIN]["cms_lang"])) {
    $_SESSION[URL_ADMIN]["cms_lang"] = "cms_en";
}
if ($_SESSION[URL_ADMIN]["cms_lang"] == "cms_vn") {
    define("LANG_AUGE_CMS", '0');
    include('../general/language/langcms_vn.php');
} elseif ($_SESSION[URL_ADMIN]["cms_lang"] == "cms_en") {
    define("LANG_AUGE_CMS", '1');
    include('../general/language/langcms_en.php');
}

require("module/modules/modules.class.php");
require("module/users/users.class.php");
require("module/categorys/categorys.class.php");

require("module/banners/banners.class.php");
// Bo loc
require("module/filterones/filterones.class.php");
require("module/filtertwos/filtertwos.class.php");
require("module/filterthrees/filterthrees.class.php");
require("module/filterfours/filterfours.class.php");

require("module/propertys/propertys.class.php");
require("module/cities/cities.class.php");
require("module/districts/districts.class.php");
require("module/shops/shops.class.php");
// Ho tro
require("module/onlines/onlines.class.php");
require("module/faqs/faqs.class.php");
require("module/supports/supports.class.php");
require("module/keywords/keywords.class.php");
require("module/comments/comments.class.php");

require("module/news/news.class.php");
require("module/products/products.class.php");
require("module/porders/porders.class.php");
require("module/purchases/purchases.class.php");
require("module/manages/manages.class.php");
require("module/imports/imports.class.php");

require("module/configs/configs.class.php");
require("module/homes/homes.class.php");

//-----------------------------
$smarty = new Smarty;
$function = new Functions;
$db = null;
$db = new db_mysql(DB_HOST, DB_USER, DB_PWD, DB_NAME, false);
$db->db_query("SET NAMES 'utf8'");
?>
