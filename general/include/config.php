<?php
define("DB_DBMS", 'mysql');
define("DB_HOST", 'localhost');
define("LOGINED_TRUE", '29092013');
if ($_SERVER['SERVER_NAME'] == "localhost") {

    define("DB_NAME", 'duhoc_v2');
    define("DB_USER", 'root');
    define("DB_PWD", '');
    define("URL_HOME", "http://localhost/duhoc_v2");
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT'] . "/duhoc_v2");
} else {

    define("DB_NAME", 'linkrica_duhoc2');
    define("DB_USER", 'linkrica_duhoc2');
    define("DB_PWD", 'Qazwsx123');
    define("URL_HOME", "http://linkrica.com/amv");
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
}

define("URL_HOMEPAGE", URL_HOME . "/");
define("URL_ADMINCMS", URL_HOMEPAGE . "admincms/");
define("URL_ADMIN", URL_HOMEPAGE . "admincms/indexcms.php");
define("URL_ADMIN_THEM", URL_HOMEPAGE . "admincms/bootstrap/");
define("IMG_UPLOAD", "../upload/");
// the them vao
define("IMG_DELETE", "upload/delete/");
define("IMG_IMG", "upload/img/");
define("BG_UPLOAD", "upload/background/");
define("GALLERY_UPLOAD", "upload/gallery/");
define("AVATAR_UPLOAD", "upload/avatar/");
define("CV_UPLOAD", "upload/cv/");
define("IMG_IMG_FILE", "upload/products/");
define("IMG_TRANSLATER", "upload/translater");
define("IMG_THUMBS", "upload/thumbs");
define("PREVIEW_FILE", "load/download/");
define("PREVIEW_IMG_FILE", "load/images/");
define("TRANS_UPLOAD", "upload/trans/");
?>
