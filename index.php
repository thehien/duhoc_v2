<?php
// error_reporting(0);
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);
error_reporting(0);
@ini_set('display_errors', 0);
include("template/module/include.php");

if (!isset($_SESSION[URL_HOME]['themes_web'])) {
    $_SESSION[URL_HOME]['themes_web'] = "themes";
}

define("THEMES", $_SESSION[URL_HOME]['themes_web']);
define("URL_WEB", URL_HOMEPAGE . "templates/");
define("URL_IMAGE", URL_HOMEPAGE . "templates/" . THEMES . "/img/");
define("URL_IMAGE_NEW", URL_HOMEPAGE . "templates/" . THEMES . "/assets/images");
$themes = THEMES;

$module = $function->sql_injection(isset($_GET['mod']) ? $_GET['mod'] : '');
switch ($module) {
    case 'home':
    default:
        $smarty->assign("panel_module", process_client());
        $smarty->display($themes . '/home.html');
        break;
}
?>
