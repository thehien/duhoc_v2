<?php
require("module/area_code/area_code.class.php");

function area_code_process() {

  global $db, $smarty, $function;
  global $module, $action_views, $action_insert, $action_edit, $action_delete, $main_url, $main_name, $main_content, $msg_time;
  $main = $function->sql_injection(isset($_GET['main']) ? $_GET['main'] : "");
  $page = $function->sql_injection(isset($_GET['page']) ? $_GET['page'] : "");
  $id = $function->sql_injection(isset($_GET['id']) ? $_GET['id'] : "");
  $smarty->assign("id", $id);
  $limit = $function->sql_injection(isset($_GET['limit']) ? $_GET['limit'] : "");
  $smarty->assign("limit", $limit);
  $order = $function->sql_injection(isset($_GET['order']) ? $_GET['order'] : "");
  $smarty->assign("order", $order);
  $sc = $function->sql_injection(isset($_GET['sc']) ? $_GET['sc'] : "");
  $smarty->assign("sc", $sc);
  $id_edit = $function->sql_injection(isset($_GET['id_edit']) ? $_GET['id_edit'] : "");
  $smarty->assign("id_edit", $id_edit);
  $category = $function->sql_injection(isset($_GET['category']) ? $_GET['category'] : "");
  $smarty->assign("category", $category);
  $shops = $function->sql_injection(isset($_GET['shops']) ? $_GET['shops'] : "");
  $smarty->assign("shops", $shops);
  $submit = $function->sql_injection(isset($_POST['submit']) ? $_POST['submit'] : "");

  $Process = new Area_code_class();
  $url = $function->sql_injection($main_url);
  $file = $function->sql_injection($main_url);
  $smarty->assign("url", $url);
  $smarty->assign("main_name", $main_name);
  $smarty->assign("main_content", $main_content);

  $class_cate = new categorys_class();
  $tree_select = $class_cate->select_tree_arrays(0, 1);
  $smarty->assign('tree_select', $tree_select);

  // user
  $rs_language = $Process->show_list_language();
  $smarty->assign("rs_language", $rs_language);

  switch ($main) {

    case "search":
      $name_search = $function->sql_injection(isset($_POST['name_search']) ? $_POST['name_search'] : "");
      $code_search = $function->sql_injection(isset($_POST['code_search']) ? $_POST['code_search'] : "");

      $_SESSION[$module]['name_search'] = $name_search;
      $_SESSION[$module]['code_search'] = $code_search;

      $smarty->assign("main_search", $main);
      if ($_SESSION[$module]['url_views']) {
        $function->goto_url($_SESSION[$module]['url_views']);
      } else {
        $function->goto_url(URL_ADMIN . "?module={$url}&main=views");
      }
      break;

    case "views":
    default:
      if ($action_views == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $_SESSION[$module]['url_views'] = $function->FixQuotes($_SERVER['REQUEST_URI']);
      $smarty->assign("url_views", URL_ADMIN . "?module={$url}&main=views");
      $name_search = $function->sql_injection(isset($_SESSION[$module]['name_search']) ? $_SESSION[$module]['name_search'] : "");
      $code_search = $function->sql_injection(isset($_SESSION[$module]['code_search']) ? $_SESSION[$module]['code_search'] : "");
      $smarty->assign("name_search", $name_search);
      $smarty->assign("code_search", $code_search);

      $url_limit = '';
      $url_order = '';
      $url_category = '';
      $url_shops = '';
      $url_page = '';
      $base_url = '';
      if ($page) {
        $smarty->assign("url_page", "&page=$page");
        $url_page = "&page=$page";
      }
      if ($limit) {
        $smarty->assign("url_limit", "&limit=$limit");
        $url_limit = "&limit=$limit";
      }
      if ($order) {
        $smarty->assign("url_order", "&order=$order&sc=$sc");
        $url_order = "&order=$order&sc=$sc";
      }
      if ($category) {
        $smarty->assign("url_category", "&category=$category");
        $url_category = "&category=$category";
      }
      if ($shops) {
        $smarty->assign("url_shops", "&shops=$shops");
        $url_shops = "&shops=$shops";
      }

      if ($name_search) {
        $numf = $Process->num_views($name_search, $category, $shops);
      } else {
        $numf = $Process->num_views_code($code_search, $category, $shops);
      }

      if ($numf) {
        if ($page == "") {
          $page = 0;
        }
        if ($limit == "") {
          $limit = 10;
        }
        $per_page = $limit;
        $all_page = $numf ? $numf : 1;
        $base_url = URL_ADMIN . "?module={$url}&main=views{$url_category}{$url_shops}{$url_limit}{$url_order}";
        $url_last = "";
        $paging = $function->generate_page_cms($base_url, $url_last, $all_page, $per_page, $page);
        if ($name_search) {
          $rs = $Process->views_table($page, $per_page, $order, $sc, $name_search, $category, $shops);
        } else {
          $rs = $Process->views_table_code($page, $per_page, $order, $sc, $code_search, $category, $shops);
        }
        $smarty->assign("paging", $paging);
        $smarty->assign("numf", $numf);
        $smarty->assign("rs", $rs);
      }
      $_SESSION[$module]['url_views'] = $base_url . $url_page;
      return $smarty->fetch("{$file}/views.html");
      break;

    case "insert":
      if ($action_insert == '' and $action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      if ($submit) {
        $data['info']['name'] = $function->sql_injection(isset($_POST['name']) ? $_POST['name'] : "");
     
        $data['info']['code'] = $function->sql_injection(isset($_POST['code']) ? $_POST['code'] : "");
       
        $data['info']['language']    = LANG_AUGE_CMS;

        $data['info']['status'] = $function->sql_injection(isset($_POST['status']) ? intval($_POST['status']) : 0);

        //var_dump($data['info']);exit;
        if ($data['info']['name'] == "") {
          return $function->msg_box_status(msg_box_erro_info, $msg_time, $_SESSION[$module]['url_views'], 2);
        } else {

          if ($id_edit) {
            $Process->edit_table($id_edit, $data['info']);
            return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
          } else {
            $Process->insert_table($data['info']);
            $id = $db->db_inserted_id();
            return $function->msg_box_status(msg_box_insert_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
          }
        }
      } else {

        $rs_edit = $Process->get_id($id_edit);
        $smarty->assign("rs_edit", $rs_edit);
        $smarty->assign("rs_undo", $_SESSION[$module]['url_views']);
        if ($id_edit) {
          $smarty->assign("url_edit", "&id_edit=$id_edit");
        }
        return $smarty->fetch("{$file}/insert.html");
      }
      break;

    case "copys":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $rs_copy = $Process->get_id($id_edit);
      $smarty->assign("rs_copy", $rs_copy);

      $data['info']['news_name'] = $function->sql_injection(isset($rs_copy['news_name']) ? $rs_copy['news_name'] : "");
      $data['info']['news_url']= $function->sql_injection(isset($rs_copy['news_url']) ? $rs_copy['news_url'] : "");
      $data['info']['news_category'] = $function->sql_injection(isset($rs_copy['news_category']) ? intval($rs_copy['news_category']) : 0);
      $data['info']['news_link'] = $function->sql_injection(isset($rs_copy['news_link']) ? $rs_copy['news_link'] : "");
      $data['info']['news_content'] = $function->FixQuotes(isset($rs_copy['news_content']) ? $rs_copy['news_content'] : "");
      $data['info']['news_code'] = $function->FixQuotes(isset($rs_copy['news_code']) ? $rs_copy['news_code'] : "");
      $data['info']['news_category'] = $function->sql_injection(isset($rs_copy['news_category']) ? intval($rs_copy['news_category']) : 0);
      $data['info']['news_salary'] = $function->FixQuotes(isset($rs_copy['news_salary']) ? $rs_copy['news_salary'] : "");
      $data['info']['news_deadline'] = $function->FixQuotes(isset($rs_copy['news_deadline']) ? $rs_copy['news_deadline'] : "");
      $data['info']['news_work_at'] = $function->sql_injection(isset($rs_copy['news_work_at']) ? $rs_copy['news_work_at'] : "");
      $data['info']['news_level'] = $function->FixQuotes(isset($rs_copy['news_level']) ? $rs_copy['news_level'] : "");
      $data['info']['news_company'] = $function->FixQuotes(isset($rs_copy['news_company']) ? $rs_copy['news_company'] : "");
      $data['info']['news_company_name'] = $function->FixQuotes(isset($rs_copy['news_company_name']) ? $rs_copy['news_company_name'] : "");
      $data['info']['news_requirements'] = $function->FixQuotes(isset($rs_copy['news_requirements']) ? $rs_copy['news_requirements'] : "");
      $data['info']['news_benefits'] = $function->FixQuotes(isset($rs_copy['news_benefits']) ? $rs_copy['news_benefits'] : "");
      $data['info']['news_contact'] = $function->FixQuotes(isset($rs_copy['news_contact']) ? $rs_copy['news_contact'] : "");
      $data['info']['job_type']    = $function->FixQuotes(isset($rs_copy['job_type']) ? $rs_copy['job_type'] : "");
      $data['info']['description'] = $function->FixQuotes(isset($rs_copy['description']) ? $rs_copy['description'] : "");
      $data['info']['language'] = LANG_AUGE_CMS;

      // Seo
      if ($rs_copy['seo_title']) {
        $data['info']['seo_title'] = $function->sql_injection(isset($rs_copy['seo_title']) ? $rs_copy['seo_title'] : "");
      } else {
        $data['info']['seo_title'] = $function->sql_injection(isset($rs_copy['news_name']) ? $rs_copy['news_name'] : "");
      }
      if ($rs_copy['seo_key']) {
        $data['info']['seo_key'] = $function->sql_injection(isset($rs_copy['seo_key']) ? $rs_copy['seo_key'] : "");
      } else {
        $data['info']['seo_key'] = $function->sql_injection(isset($rs_copy['news_name']) ? $rs_copy['news_name'] : "");
      }
      if ($rs_copy['seo_desc']) {
        $data['info']['seo_desc'] = $function->FixQuotes(isset($rs_copy['seo_desc']) ? $rs_copy['seo_desc'] : "");
      } else {
        $data['info']['seo_desc'] = $function->FixQuotes(isset($rs_copy['news_content']) ? $rs_copy['news_content'] : "");
      }

      //status
      $data['info']['status'] = $function->sql_injection(isset($rs_copy['status']) ? intval($rs_copy['status']) : 0);
      $data['info']['userid'] = $function->sql_injection(isset($rs_copy['userid']) ? intval($rs_copy['userid']) : 0);
      $data['info']['home'] = $function->sql_injection(isset($rs_copy['home']) ? intval($rs_copy['home']) : 0);

      //Price
      $data['info']['news_img'] = $function->sql_injection(isset($rs_copy['news_url']) ? $rs_copy['news_img'] : "");
      $data['info']['img_file'] = $function->sql_injection(isset($rs_copy['news_url']) ? $rs_copy['img_file'] : "");

      $Process->insert_table($data['info']);
      $id = $db->db_inserted_id();
      $Process->insert_description($data['info'], $id);
      $Process->insert_option($id);
      return $function->msg_box_status(msg_box_copy_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      break;

    case "update_order":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $check = $_POST['checkbox_id'];
      if ($check != null) {
        foreach ($check as $id) {
          $news_name = $function->sql_injection($_POST['news_name' . $id]);
          $price_import = $function->to_character_price($_POST['price_import' . $id]);
          $price_new = $function->to_character_price($_POST['price_new' . $id]);
          $price = $function->to_character_price($_POST['price' . $id]);
          $home = $function->to_character_price($_POST['home' . $id]);
          if (LANG_AUGE_CMS == 0) {
            $price_import = round($price_import + 499, -3);
            $price_new = round($price_new + 499, -3);
            $price = round($price + 499, -3);
          }
          $pos = $function->sql_injection($_POST['pos' . $id]);
          $id = $function->sql_injection(intval($id));
          $Process->update_order_table($id, $news_name, $pos, $price_import, $price_new, $price, $home);
        }
      }
      return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      break;

    case "delete":
      if ($action_delete == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $check = $_POST['checkbox_id'];
      if ($check != null) {
        foreach ($check as $id) {
// 					$checks = $Process->check_delete($id);
// 					$checks_import_pro = $Process->check_delete_import_pro($id);
// 					$checks_orders = $Process->check_delete_orders($id);
// 					if ($checks > 0){
// 						return $function->msg_box_status(msg_box_erro_status,$msg_time,$_SESSION[$module]['url_views'],2);
// 					} elseif ($checks_import_pro > 0){
// 						return $function->msg_box_status(msg_box_erro_parent,$msg_time,$_SESSION[$module]['url_views'],2);
// 					} elseif ($checks_orders > 0){
// 						return $function->msg_box_status(msg_box_erro_parent,$msg_time,$_SESSION[$module]['url_views'],2);
// 					} else {										
          $id = $function->sql_injection(intval($id));
          //$rs = $Process->get_id($id);
          //unlink(IMG_UPLOAD.$url.'/'.$rs["img_file"].'/'.$rs["news_img"]);
          $Process->show_table_images_id($id);
          $Process->del_product_all($id);
          $Process->delete_table($id);
          //}
        }
      }
      return $function->msg_box_status(msg_box_delete_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      break;

    case "status":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $id = $function->sql_injection($_GET['id']);
      $status = $function->sql_injection($_GET['status']);
      if ($status == 1) {
        $Process->status_table($id, 0);
      } else {
        $Process->status_table($id, 1);
      }
      return $function->msg_box_status(msg_box_status_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      break;

    case "status_off":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $check = $_POST['checkbox_id'];
      if ($check != null) {
        foreach ($check as $id) {
          $id = $function->sql_injection(intval($id));
          $Process->status_off_table($id);
        }
      }
      return $function->msg_box_status(msg_box_status_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      break;

    case "status_on":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $check = $_POST['checkbox_id'];
      if ($check != null) {
        foreach ($check as $id) {
          $id = $function->sql_injection(intval($id));
          $Process->status_on_table($id);
        }
      }
      return $function->msg_box_status(msg_box_status_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      break;

    case "uptop":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $Process->edit_created_date($id_edit);
      return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      break;

    //////////////////////////////General////////////////////////////////
    //Cap nhat bo loc
    case "filter":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $Jobseekers_id = $id_edit;
      $category_id = $function->FixQuotes(isset($_POST['category_id']) ? $_POST['category_id'] : "");
      $url_one = $function->FixQuotes(isset($_POST['url_one']) ? $_POST['url_one'] : "");
      $url_two = $function->FixQuotes(isset($_POST['url_two']) ? $_POST['url_two'] : "");
      $url_three = $function->FixQuotes(isset($_POST['url_three']) ? $_POST['url_three'] : "");
      $numf_product = $Process->num_filter_Jobseekers($Jobseekers_id);
      if ($submit and $id_edit) {
        if ($numf_product < '1') {
          $Process->add_filter_Jobseekers($Jobseekers_id, $category_id, $url_one, $url_two, $url_three);
        } else {
          $Process->edit_filter_Jobseekers($Jobseekers_id, $category_id, $url_one, $url_two, $url_three);
        }
        return $function->msg_box_status(msg_box_general_del, $msg_time, $_SESSION[$module]['general'], 1);
      } else $function->goto_url($_SESSION[$module]['general']);
      break;
    //Them description
    case "description":
      $check_shop = $Process->check_user_Jobseekers($id_edit);
      if ($action_edit == '' or $check_shop == '0') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $_SESSION[$module]['description'] = URL_ADMIN . "?module=Jobseekers&main=description&id_edit=$id_edit";
      if ($id_edit) {
        $smarty->assign("url_edit", "&id_edit=$id_edit");
      }
      if ($submit) {
        $name = $function->sql_injection($_POST['name']);
        $pos = $function->sql_injection($_POST['pos']);
        $description = stripslashes($function->FixQuotes($_POST['description']));
        if ($name != "") {
          $Process->add_description($id, $id_edit, $name, $description, $pos);
        }
        return $function->msg_box_status(msg_box_desc_succ, $msg_time, $_SESSION[$module]['description'], 1);
      } else {
        $rs = $Process->show_all_description($id_edit);
        $smarty->assign("rs", $rs);

        $rs_name = $Process->get_id($id_edit);
        $smarty->assign("rs_name", $rs_name);
        $smarty->assign("news_name", $rs_name["news_name"]);
        $smarty->assign("news_url", $rs_name["news_url"]);
        $smarty->assign("news_id", $rs_name["news_id"]);

        $val = $Process->get_id_description($id);
        $smarty->assign("val", $val);
        return $smarty->fetch("{$file}/description.html");
      }
      break;
    case "deletedesc":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $Process->del_description($id);
      return $function->msg_box_status(msg_box_desc_del, $msg_time, $_SESSION[$module]['description'], 1);
      break;

    //Up gia toan bo theo % cua muc san pham
    case "updateprice":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      if ($_SESSION[URL_ADMIN]["user_role"] == '1') {
        $Process->update_price_percent();
        return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      } else {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      break;
    //Up cong them 1%
    case "updatetang":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      if ($_SESSION[URL_ADMIN]["user_role"] == '1') {
        $Process->update_tang();
        return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      } else {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      break;
    //Up giam 1%
    case "updategiam":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      if ($_SESSION[URL_ADMIN]["user_role"] == '1') {
        $Process->update_giam();
        return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
      } else {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      break;

  }

}

?>