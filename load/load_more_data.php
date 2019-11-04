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
    $coupons_orders = 'coupons_orders';
    $coupons_orders_detail = 'coupons_orders_detail';
    $coupons_status = 'coupons_status';
    $coupons_user = 'coupons_users';

    $stmt = $db_con->prepare("SELECT cu.name, cu.avatar,cp.*, cs.* ,cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua , (select t1.category_name from coupons_special_category t1 where t1.id = cod.special_category) as subject_field FROM " . $coupons_orders . " cp ," . $coupons_orders_detail . " cod," . $coupons_status . " cs  , " . $coupons_user . " cu
		WHERE cod.coupon_code=cp.coupon_code and cp.language=1 
		and cs.coupon_status=cp.coupon_status and cu.userid=cp.coupon_userid and cp.coupon_status = 2 and cp.coupon_purchaseid <:last_id GROUP BY cp.coupon_purchaseid ORDER BY cp.coupon_status, cp.coupon_purchaseid desc");

    $stmt->execute([":last_id" => $_GET['last_id']]);

    $orderData = $stmt->fetchAll();

    $json = "";
    foreach ($orderData as $key => $value) {
        $value["price"] = number_format($value["price"], 0, ',', '.');
        $value["count_text"] = number_format($value["count_text"], 0, ',', '.');
        $fromTolanguage[] = get_order_language_by_id($value['translate_id']);

        $json .= "<div class='grid-item col-md-12 no-padding fw-pdr10 fw-pdb20 post-id'' id='" . $value['coupon_purchaseid'] . "'>
		<form role='form' class='form-ad' name='acceptTranslate' method='post' action='" . URL_HOMEPAGE . "accept-translate.html'/>
		<input type='hidden' name='coupon_code_id' value='" . $value['coupon_code'] . "'>

		<div class='fw-mgb10 box'>
		<div class='fw-mgb10' style='font-size: 16px;'>
		<strong>ID " . $value['coupon_code'] . ": " . $value['file_translate'] . "</strong>
		</div>
		<div style='clear: both;'></div>
		<div class='col-md-12 no-padding fw-mgb10'>
		<div class='col-md-1 no-padding'>";
        if ($value['avatar']) {
            $json .= " <img width='30' height='30' src='" . URL_HOME . "/upload/avatar/" . $value['avatar'] . "' class='img-circle'/> ";
        } else {
            $json .= "<img width='30' height='30' src='" . URL_HOME . "/assets/img/info/man-user.png' class='img-circle' />";
        }
        $json .= " </div>
		<div class='col-md-11' style='line-height: 30px;'><strong>" . $value['name'] . "</strong></div>
		</div>
		<div>
		<table width='330'>
		<tr>
		<td align='left' width='40%'>";
        foreach ($fromTolanguage as $fromtoLanguageChild) {
            foreach ($fromtoLanguageChild as $key => $value1) {
                if ($value1['translate_id'] == $value['translate_id']) {
                    $json .= " <span id='translate_from' class='language-bg' style='margin-bottom: 5px;'>
					<img width='25' height='25' src='" . URL_HOME . "/upload/list_language/" . $value1['from_flag_language'][0]['img_flag'] . "' class='img-circle'/><span style='margin:5px; font-size: 13px;'>" . $value1['from_language_name'] . "</span>
					</span>
					<br/>";
                }
            }
        }
        $json .= "
		</td>";

        $json .= "<td align='left' width='20%' style='padding-left:5px;'>";
        foreach ($fromTolanguage as $fromtoLanguageChild) {
            foreach ($fromtoLanguageChild as $key => $value1) {
                if ($value1['translate_id'] == $value['translate_id']) {
                    $json .= "<div id='translate_to' style='margin-bottom: 5px;'>
					<i class='fa fa-angle-right fa-lg' aria-hidden='true'></i>
					</div>";
                }
            }
        }
        $json .= "
		</td>";

        $json .= "<td align='left' width='40%'>";
        foreach ($fromTolanguage as $fromtoLanguageChild) {
            foreach ($fromtoLanguageChild as $key => $value1) {
                if ($value1['translate_id'] == $value['translate_id']) {
                    $json .= "<span id='translate_from' class='language-bg' style='margin-bottom: 5px;'>
					<img width='25' height='25' src='" . URL_HOME . "/upload/list_language/" . $value1['to_flag_language'][0]['img_flag'] . "' class='img-circle'/><span style='margin:5px; font-size: 13px;'>" . $value1['to_language_name'] . "</span>
					</span>
					<br/>";
                }
            }
        }
        $json .= "
		</td>
		</tr>
		</table>
		</div>

		<div style='clear: both;'></div>
		<div class='fw-mgt10'>
		<div class='col-md-12  fw-mgb10'>
		Subject : " . $value['subject_field'] . "
		</div>

		<div class='col-md-12 fw-mgb10'>
		Created Date: " . $value['ngay_mua'] . "
		</div>

		<div class='col-md-12  fw-mgb10'>
		Estimated Delivery: " . $value['estimate'] . " (hours)
		</div>

		<div class='col-md-6'>
		<strong style='font-size: 20px;'>" . $value['count_text'] . "</strong> word(s)
		</div>

		<div class='col-md-6'>
		<strong style='font-size: 20px;'>$ " . $value['price'] . "</strong>
		</div>
		<div class='col-md-12'>
		<hr/>
		</div>
		</div>
		<div style='clear: both;'></div>

		<center>
		<div class='fw-mgb10'>";
        if ($value['translater_id'] > 0) {
            $json .= " <a class='accept_receive' href='#'> Received </a> ";
        } else {
            $json .= " <a class='accept_order' href='#'> Open </a> ";
        }
        $json .= "</div>
		<div>
		<a class='btn btn-submit log-btn' href='" . URL_HOMEPAGE . "detail/" . $value['coupon_purchaseid'] . "-" . $value['coupon_code'] . ".html'>
		View Details
		</a>
		</div>
		</center>

		</div> 
		</form>

		</div>
		<div style='clear: both;'></div>
		";
    }
    echo json_encode($json);
}

function get_order_language_by_id($aUserId)
{
    global $db_con;
    $stmt = $db_con->prepare("SELECT t1.from_language, t1.to_language , t1.translate_id, (select t2.name from list_languages t2 where t1.from_language = t2.id ) as from_language_name,(select t2.name from list_languages t2 where t1.to_language = t2.id ) as to_language_name FROM coupons_language_order t1 where t1.translate_id=:userId order by t1.id desc");

    $stmt->execute([":userId" => $aUserId]);
    $rows = $stmt->fetchAll();
    for ($i = 0; $i < count($rows); $i++) {
        $rows[$i]["to_language_name"] = $rows[$i]["to_language_name"];
        $rows[$i]["from_language_name"] = $rows[$i]["from_language_name"];
        $rows[$i]["from_flag_language"] = show_info_language($rows[$i]["from_language"]);
        $rows[$i]["to_flag_language"] = show_info_language($rows[$i]["to_language"]);
    }
    return $rows;
}

function show_info_language($id)
{
    global $db_con;
    $language = 1;
    $stmt = $db_con->prepare("SELECT img_flag FROM list_languages where language=:language and id=:id order by id asc ");
    $stmt->execute([":language" => $language, ":id" => $id]);
    $rows = $stmt->fetchAll();
    return $rows;
}

?>
