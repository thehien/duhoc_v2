<?php
// error_reporting(0);
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);
error_reporting(0);
@ini_set('display_errors', 0);
include_once("config.inc.php");

if ($_POST) {
    $row = $_POST['row'];
    $rowperpage = 5;
    $news_category = $_POST['news_category'];
    $news_type = $_POST['news_type'];

// selecting posts
    $stmt = $db_con->prepare("SELECT news_id, news_url, news_name, news_img, news_content 
    FROM list_scholarship where status = '1' and language =:language and news_category =:news_category and news_type =:news_type
    ORDER BY news_id asc Limit :row, :rowperpage");
    //var_dump($stmt);
    $stmt->bindValue(':language', $language, PDO::PARAM_INT);
    $stmt->bindValue(':news_category', $news_category, PDO::PARAM_INT);
    $stmt->bindValue(':news_type', $news_type, PDO::PARAM_INT);
    $stmt->bindValue(':row', (int)$row, PDO::PARAM_INT);
    $stmt->bindValue(':rowperpage', (int)$rowperpage, PDO::PARAM_INT);
    //var_dump($language . '-' . $news_category . '-' . $news_type . '-' . $row . '-' . $rowperpage);
    $stmt->execute();
    $data = $stmt->fetchAll();
    $html = '';

    foreach ($data as $row) {
        $shortName = substr($row['news_name'], 0, 60)."...";
        $shortContent = substr($row['news_content'], 0, 250)."...";
        // Creating HTML structure
        $html .= "<div class=\"col-md-12 no-padding fw-border3\" id=\"post_".$row[news_id]."\">
                                        <div class=\"col-md-9\">
                                            <div class=\"team_title fw-mgt10\">
                                                <a href=\"" . URL_HOMEPAGE . "hb-detail/".$row[news_id]."/".$row[news_url].".html\">
                                                    <strong>".$shortName."</strong>
                                                </a>
                                            </div>
                                            <div class=\"team_content fw-mgb10\" style=\"height:auto; min-height: 70px;\">
                                               ".$shortContent."
                                            </div>
                                            <div class=\"col-md-12 no-padding fw-fs-12 fw-mgb10\">
                                                <div class=\"col-md-3 no-padding\">
                                                    <span class=\"margin-right-md\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i> 609</span>
                                                    <span><i class=\"fa fa-eye\" aria-hidden=\"true\"></i> 120</span>
                                                </div>
                                                <div class=\"col-md-3 no-padding\" align=\"right\">
                                                    <div class=\"addthis_sharing_toolbox\"></div>
                                                </div>
                                                <div class=\"col-md-6\">

                                                </div>
                                            </div>
                                        </div>

                                        <div class=\"col-md-3 no-padding\" align=\"right\">
                                            <a href=\"" . URL_HOMEPAGE . "hb-detail/".$row[news_id]."/".$row[news_url].".html\">
                                                <img style=\"height: 150px !important;\"
                                                     src=\"" . URL_HOME . "/upload/scholarship/".$row[news_img]."\"/>
                                            </a>
                                        </div>
                                    </div>
        ";
    }

    echo $html;
}

