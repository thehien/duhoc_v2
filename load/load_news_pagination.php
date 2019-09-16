<?php
// error_reporting(0);
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);
error_reporting(0);
@ini_set('display_errors', 0);
include_once("config.inc.php");

// Main process
if ($_GET) {

    $limit = 4;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page=1;
    }
    $start_from = ($page-1) * $limit;
    $cate_id = $_GET['category_id'];

    $sql = "select * ";
    $sql .= "from coupons_schools where status = '1' and news_category =:category_id and 
             language = 0 order by news_id asc LIMIT $start_from, $limit";
    $stmt = $db_con->prepare($sql);
    $stmt->execute([":category_id" => (int)$cate_id]);

    $newsData = $stmt->fetchAll();
    $json = "";
    foreach ($newsData as $value) {
        $json .= " <div class=\"col-md-6 fw-mgb10\">
                <div class=\"box_how_it_works\" style=\"padding:10px;\">
                    <div class=\"col-md-3 fw-mgb10\">
                        <center>
                            <a href=\"#\">
                                <img src='" . URL_HOME . "/upload/schools/" . $value['news_img'] . "'/>
                            </a>
                        </center>
                    </div>
                    <div class=\"col-md-9\">
                        <div class=\"fw-mgb10\">
                            <a href=\"#\">
                                <h4>
                                    <strong>".$value['news_name']."</strong>
                                </h4>
                            </a>
                        </div>
                        <div class=\"fw-mgb10 text-justify\">
                            ".$value['news_content']."
                        </div>
                    </div>
                    <div class=\"clearfix\"></div>
                </div>
            </div>";
    }
    echo json_encode($json);
}
