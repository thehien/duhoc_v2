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

    $limit = 10;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page=1;
    }
    $start_from = ($page-1) * $limit;

    $sql = "select * ";
    $sql .= "from coupons_contents where status = '1' and 
             language = 1 order by pos asc LIMIT $start_from, $limit";
    //echo $sql;
    $stmt = $db_con->prepare($sql);
    $stmt->execute();

    $newsData = $stmt->fetchAll();
    $json = "";
    foreach ($newsData as $value) {
        $value["news_name_limit"] = cutnchar($value["news_name"], 60);
        $value["news_content_limit"] = strip_tags(cutnchar($value["news_content"], 200),'<b>');

        $json .= "<div class=\"col-md-3 fw-mgb20\">
        <div class=\"col-md-12 fw-mgb10\" align=\"center\">
            <a class=\"hover-effect\" href=\"" . URL_HOMEPAGE . "news-detail/" . $value['news_id'] . "/" . $value['news_url'] . ".html\">
               <img class=\"img-thumbnail img-rounded\" src=\"" . URL_HOME . "/upload/contents/" . $value['news_img'] . "\" />
            </a>
        </div>

        <div class=\"col-md-12\">
            <div class=\"team_title\">
                <a class=\"team_title\" href=\"" . URL_HOMEPAGE . "news-detail/" . $value['news_id'] . "/" . $value['news_url'] . ".html\">
                    <strong>" . $value['news_name_limit'] . "</strong>
                </a>
            </div>
            <div class=\"team_content fw-mgb20\" style=\"height:auto; min-height: 80px;\">" . $value['news_content_limit'] . "</div>
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
     echo $json;
}

  function cutnchar($str, $n)
  {
    if (strlen($str) < $n) {
      return $str;
    }
    $html = substr($str, 0, $n);
    $html = substr($html, 0, strrpos($html, ' '));

    return $html . '...';
  }

