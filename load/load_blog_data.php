<?php
// error_reporting(0);
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);
error_reporting(0);
@ini_set('display_errors', 0);
require('../general/class/functions.php');
include_once("config.inc.php");

$function = new Functions();
// Main process
if ($_GET) {
    $coupons_blog = 'coupons_blogs';
    $category = $_GET['category'];

    $stmt = $db_con->prepare("select news_id, news_img, news_name, news_content 
    from $coupons_blog where news_category=:category and status = 1 order by news_id asc");

    $stmt->execute(array(":category" => $category));
    $blogData = $stmt->fetchAll();

    $data = "";
    foreach ($blogData as $value) {
        $value["news_name_limit"] = $function->cutnchar($value["news_name"], 60);
        $value["news_content_limit"] = strip_tags($function->cutnchar($value["news_content"], 250),'');
        $data .= "<div class=\"col-md-3 no-padding fw-mgb20\">
                                <div class=\"col-md-12 fw-mgb10\" align=\"center\">
                                    <a class=\"hover-effect\" href=\"" . URL_HOMEPAGE . "blog-detail/" . $value['news_id'] . "/" . $value['news_url'] . ".html\">
                                       <img class=\"img-thumbnail img-rounded\" style='height: 140px !important;' src=\"" . URL_HOME . "/upload/blogs/" . $value['news_img'] . "\" /></a>
                                </div>

                                <div class=\"col-md-12\">
                                    <div class=\"team_title\">
                                        <a class=\"team_title\" href=\"" . URL_HOMEPAGE . "blog-detail/" . $value['news_id'] . "/" . $value['news_url'] . ".html\">
                                            <strong>" . $value['news_name_limit'] . "</strong>
                                        </a>
                                    </div>
                                    <div class=\"team_content fw-mgb20\" style=\"height:auto; min-height: 80px;\">{" . $value['news_content_limit'] . "</div>
                                    <div class=\"col-md-12 no-padding\">
                                        <div class=\"col-md-6 no-padding\">
                                            <span class=\"margin-right-md\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i> 609</span>
                                            <span><i class=\"fa fa-eye\" aria-hidden=\"true\"></i> 120</span>
                                        </div>
                                        <div class=\"col-md-6 no-padding\" align=\"right\">
                                            <span style=\"color:#9b9999\"><strong>SHARE</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>";
    }
    echo json_encode($data);
}
