<?php
function products_process()
{
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

  $Process = new Products_class;
  $url = $function->sql_injection($main_url);
  $file = $function->sql_injection($main_url);
  $smarty->assign("url", $url);
  $smarty->assign("main_name", $main_name);
  $smarty->assign("main_content", $main_content);

  $class_cate = new categorys_class;
  $tree_select = $class_cate->select_tree_arrays(0, 1);
  $smarty->assign('tree_select', $tree_select);

  // shop
  $rs_shop = $Process->show_list_shop();
  $smarty->assign("rs_shop", $rs_shop);
  // user
  $rs_user = $Process->show_list_user();
  $smarty->assign("rs_user", $rs_user);
  // City
  $rs_city = $Process->show_all_city(1);
  $smarty->assign("rs_city", $rs_city);

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

      // Bộ lọc nội dung
      $smarty->assign("rs_one", $Process->show_filter_one(1));
      $smarty->assign("rs_two", $Process->show_filter_two(1));
      $smarty->assign("rs_three", $Process->show_filter_three(1));
      $smarty->assign("rs_four", $Process->show_filter_four(1));
      if ($submit) {
        $data['info']['news_name'] = $function->sql_injection(isset($_POST['news_name']) ? $_POST['news_name'] : "");
        if ($_POST['news_url']) {
          $data['info']['news_url'] = $function->character_url(isset($_POST['news_url']) ? $_POST['news_url'] : "");
        } else {
          $data['info']['news_url'] = $function->character_url(isset($_POST['news_name']) ? $_POST['news_name'] : "");
        }
        $data['info']['news_category'] = $function->sql_injection(isset($_POST['news_category']) ? intval($_POST['news_category']) : 0);
        $data['info']['news_content'] = $function->FixQuotes(isset($_POST['news_content']) ? $_POST['news_content'] : "");
        $data['info']['news_code'] = $function->FixQuotes(isset($_POST['news_code']) ? $_POST['news_code'] : "");
        $data['info']['news_salary'] = $function->FixQuotes(isset($_POST['news_salary']) ? $_POST['news_salary'] : "");
        $data['info']['news_deadline'] = $function->FixQuotes(isset($_POST['news_deadline']) ? $_POST['news_deadline'] : "");
        $data['info']['news_work_at'] = $function->sql_injection(isset($_POST['news_work_at']) ? $_POST['news_work_at'] : "");
        $data['info']['news_level'] = $function->FixQuotes(isset($_POST['news_level']) ? $_POST['news_level'] : "");
        $data['info']['news_company'] = $function->FixQuotes(isset($_POST['news_company']) ? $_POST['news_company'] : "");
        $data['info']['news_company_name'] = $function->FixQuotes(isset($_POST['news_company_name']) ? $_POST['news_company_name'] : "");
        $data['info']['news_requirements'] = $function->FixQuotes(isset($_POST['news_requirements']) ? $_POST['news_requirements'] : "");
        $data['info']['news_benefits'] = $function->FixQuotes(isset($_POST['news_benefits']) ? $_POST['news_benefits'] : "");
        $data['info']['news_contact'] = $function->FixQuotes(isset($_POST['news_contact']) ? $_POST['news_contact'] : "");
        $data['info']['job_type'] = $function->FixQuotes(isset($_POST['job_type']) ? $_POST['job_type'] : "");
        $data['info']['description'] = $function->FixQuotes(isset($_POST['description']) ? $_POST['description'] : "");
        $data['info']['language'] = LANG_AUGE_CMS;

        // Seo
        if ($_POST['seo_title']) {
          $data['info']['seo_title'] = $function->sql_injection(isset($_POST['seo_title']) ? $_POST['seo_title'] : "");
        } else {
          $data['info']['seo_title'] = $function->sql_injection(isset($_POST['news_name']) ? $_POST['news_name'] : "");
        }
        if ($_POST['seo_key']) {
          $data['info']['seo_key'] = $function->sql_injection(isset($_POST['seo_key']) ? $_POST['seo_key'] : "");
        } else {
          $data['info']['seo_key'] = $function->sql_injection(isset($_POST['news_name']) ? $_POST['news_name'] : "");
        }
        if ($_POST['seo_desc']) {
          $data['info']['seo_desc'] = $function->FixQuotes(isset($_POST['seo_desc']) ? $_POST['seo_desc'] : "");
        } else {
          $data['info']['seo_desc'] = $function->FixQuotes(isset($_POST['news_content']) ? $_POST['news_content'] : "");
        }

        //status
        $data['info']['status'] = $function->sql_injection(isset($_POST['status']) ? intval($_POST['status']) : 0);
        $data['info']['userid'] = $function->sql_injection(isset($_POST['userid']) ? intval($_POST['userid']) : 0);

        $data['info']['home'] = $function->sql_injection(isset($_POST['home']) ? intval($_POST['home']) : 0);

        //Price
        $data['info']['price'] = $function->to_character_price(isset($_POST['price']) ? $_POST['price'] : 0);
        if (LANG_AUGE_CMS == 0) {
          $data['info']['price'] = round($data['info']['price'] + 499, -3);
        }

        // upload image
        $img_file = date("Y");
        $types = array("image/gif", "image/GIF", "image/JPG", "image/png", "image/PNG", "image/jpg", "image/JPEG", "image/jpeg");
        $file_size = $_FILES['filename']['size'];
        $tmp_name = $_FILES['filename']['tmp_name'];
        $type_name = $_FILES['filename']['type'];
        $new_name = $_FILES['filename']['name'];
        $name_image = date("hs") . '-' . $function->character_name_img($new_name);
        if ($file_size > 2097152) {
          return $function->msg_box_status(msg_box_erro_img, 20, $_SESSION[$module]['url_views'], 2);
        } elseif (in_array($type_name, $types)) {
          move_uploaded_file($tmp_name, IMG_UPLOAD . $url . '/' . $img_file . '/' . $name_image);
          $data['info']['news_img'] = $name_image;
          $data['info']['img_file'] = $img_file;
        } else {
          $data['info']['news_img'] = '';
          $data['info']['img_file'] = '';
        }
        // end image


        if ($data['info']['news_name'] == "" or $data['info']['news_category'] == "") {
          return $function->msg_box_status(msg_box_erro_info, $msg_time, $_SESSION[$module]['url_views'], 2);
        } else {


          if ($id_edit) {
            $image_old = $function->FixQuotes(isset($_POST['image_old']) ? $_POST['image_old'] : "");
            $file_old = $function->FixQuotes(isset($_POST['file_old']) ? $_POST['file_old'] : "");
            $delete_img = $function->FixQuotes(isset($_POST['delete_img']) ? intval($_POST['delete_img']) : 0);
            if ($new_name) {
              if ($image_old) {
                //unlink(IMG_UPLOAD.$url.'/'.$file_old.'/'.$image_old);
              }
            } elseif ($delete_img == 1 or $new_name != "") {
              //unlink(IMG_UPLOAD.$url.'/'.$file_old.'/'.$image_old);
              $data['info']['news_img'] = "";
              $data['info']['img_file'] = "";
            } else {
              $data['info']['news_img'] = $image_old;
              $data['info']['img_file'] = $file_old;
            }

            $Process->edit_table($id_edit, $data['info']);
            $Process->edit_description($id_edit, $data['info']);
            return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
          } else {

            $_SESSION[$module]['name_search'] = '';
            $Process->insert_table($data['info']);
            $id = $db->db_inserted_id();
            $Process->insert_description($data['info'], $id);
            $Process->insert_option($id);
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
      $data['info']['news_url'] = $function->sql_injection(isset($rs_copy['news_url']) ? $rs_copy['news_url'] : "");
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
      $data['info']['job_type'] = $function->FixQuotes(isset($rs_copy['job_type']) ? $rs_copy['job_type'] : "");
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

    case "home":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $id = $function->sql_injection($_GET['id']);
      $home = $function->sql_injection($_GET['home']);
      if ($home == 1) {
        $Process->home_table($id, 0);
      } else {
        $Process->home_table($id, 1);
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
    case "general":
      $check_shop = $Process->check_user_products($id_edit);
      if ($action_edit == '' or $check_shop == '0') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $_SESSION[$module]['general'] = $function->FixQuotes($_SERVER['REQUEST_URI']);
      if ($id_edit) {
        $smarty->assign("url_edit", "&id_edit=$id_edit");
      }


      $rs_name = $Process->get_id($id_edit);
      $smarty->assign("rs_name", $rs_name);
      $smarty->assign("news_name", $rs_name["news_name"]);
      $smarty->assign("news_url", $rs_name["news_url"]);
      $smarty->assign("news_id", $rs_name["news_id"]);

      //Hinh chi tiet san pham
      $rs = $Process->show_all_images($id_edit);
      $smarty->assign("rs", $rs);

      //Lua chon mua hang
      $rs_op = $Process->show_all_option($id_edit);
      $smarty->assign("rs_op", $rs_op);

      $rs_cate = $Process->get_news_category($id_edit);
      $category_id = $rs_cate["news_category"];
      $parent_id = $rs_cate["parent_id"];

      //Thuoc tinh san pham
      $check_property = $Process->num_filter_property($category_id);
      if ($check_property) {
        $category_property = $category_id;
      } else {
        $category_property = $parent_id;
      }
      $smarty->assign("numf_property", $Process->num_filter_property($category_property));
      $smarty->assign("rs_property", $Process->show_filter_property($category_property));
      $smarty->assign("rs_tt", $Process->show_coupons_property($id_edit));

      //Bo loc san pham
      $rs_filter = $Process->show_filter_products($id_edit);
      $smarty->assign("rs_filter", $rs_filter);
      //Bo loc 1
      $check_one = $Process->num_filter_one($category_id);
      if ($check_one) {
        $category_one = $category_id;
      } else {
        $category_one = $parent_id;
      }
      $smarty->assign("category_filter", $category_one);
      $smarty->assign("numf_one", $Process->num_filter_one($category_one));
      $smarty->assign("rs_one", $Process->show_filter_one($category_one));
      //Bo loc 2
      $check_two = $Process->num_filter_two($category_id);
      if ($check_two) {
        $category_two = $category_id;
      } else {
        $category_two = $parent_id;
      }
      $smarty->assign("numf_two", $Process->num_filter_two($category_two));
      $smarty->assign("rs_two", $Process->show_filter_two($category_two));
      //Bo loc 3
      $check_three = $Process->num_filter_three($category_id);
      if ($check_three) {
        $category_three = $category_id;
      } else {
        $category_three = $parent_id;
      }
      $smarty->assign("numf_three", $Process->num_filter_three($category_three));
      $smarty->assign("rs_three", $Process->show_filter_three($category_three));
      //Bo loc 4
      $check_four = $Process->num_filter_four($category_id);
      if ($check_four) {
        $category_four = $category_id;
      } else {
        $category_four = $parent_id;
      }
      $smarty->assign("numf_four", $Process->num_filter_four($category_four));
      $smarty->assign("rs_four", $Process->show_filter_four($category_four));

      return $smarty->fetch("{$file}/general.html");
      break;
    //Hinh chi tiet san pham
    case "images":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      global $max_size, $files_mime, $extension;
      if ($submit) {
        $data['info']['image_name'] = $function->sql_injection(isset($_POST['image_name']) ? $_POST['image_name'] : "");
        $img_file = date("Y");
        $types = array("image/gif", "image/GIF", "image/JPG", "image/png", "image/PNG", "image/jpg", "image/JPEG", "image/jpeg");
        $file_size = $_FILES['filename']['size'];
        $tmp_name = $_FILES['filename']['tmp_name'];
        $type_name = $_FILES['filename']['type'];
        $new_name = $_FILES['filename']['name'];
        $name_image = date("hs") . '-' . $function->character_name_img($new_name);
        if ($file_size > 2097152) {
          return $function->msg_box_status(msg_box_erro_img, 20, $_SESSION[$module]['url_views'], 2);
        } elseif (in_array($type_name, $types)) {
          move_uploaded_file($tmp_name, IMG_UPLOAD . $url . '/' . $img_file . '/' . $name_image);
          $data['info']['image'] = $name_image;
          $data['info']['img_file'] = $img_file;
        } else {
          $data['info']['image'] = '';
          $data['info']['img_file'] = '';
        }

        if ($data['info']['image'] and $id_edit) {
          $Process->add_images($id_edit, $data['info']);
        }
        return $function->msg_box_status(msg_box_general_succ, $msg_time, $_SESSION[$module]['general'], 1);
      }
      $function->goto_url($_SESSION[$module]['general']);
      break;

    case "delimage":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $rs = $Process->show_images($id);
      unlink(IMG_UPLOAD . $url . '/' . $rs['img_file'] . '/' . $rs['image']);
      $Process->del_images($id);
      return $function->msg_box_status(msg_box_general_del, $msg_time, $_SESSION[$module]['general'], 1);
      break;

    //Lua chon mua hang
    case "option":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $option_name = $function->sql_injection(isset($_POST['option_name']) ? $_POST['option_name'] : "");
      if ($submit) {
        if ($option_name and $id_edit) {
          $Process->add_option($option_name, $id_edit);
        }
      }
      return $function->msg_box_status(msg_box_general_succ, $msg_time, $_SESSION[$module]['general'], 1);
      break;

    case "deloption":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }

      $checks_import = $Process->check_delete_import($id);
      $checks_orders_detail = $Process->check_delete_orders_detail($id);
      if ($checks_import > 0) {
        return $function->msg_box_status(msg_box_erro_parent, $msg_time, $_SESSION[$module]['url_views'], 2);
      } elseif ($checks_orders_detail > 0) {
        return $function->msg_box_status(msg_box_erro_parent, $msg_time, $_SESSION[$module]['url_views'], 2);
      } else {
        $Process->delete_option($id);
      }
      return $function->msg_box_status(msg_box_general_del, $msg_time, $_SESSION[$module]['general'], 1);
      break;

    case "upoption":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $check = $_POST['checkbox_id'];
      if ($check != null) {
        foreach ($check as $id) {
          $option_name = $function->sql_injection($_POST['option_name' . $id]);
          $price_new = $function->to_character_price($_POST['price_new' . $id]);
          if (LANG_AUGE_CMS == 0) {
            $price_new = round($price_new + 499, -3);
          }
          $status = $function->to_character_price($_POST['status' . $id]);
          $id = $function->sql_injection(intval($id));
          $Process->update_option($id, $option_name, $price_new, $status);
        }
      }
      return $function->msg_box_status(msg_box_general_del, $msg_time, $_SESSION[$module]['general'], 1);
      break;

    //Thuoc tinh san pham
    case "property":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      global $max_size, $files_mime, $extension;
      if ($submit and $id_edit) {
        $num = $function->sql_injection($_POST['num']);
        for ($i = 0; $i <= $num; $i++) {
          $name = $function->sql_injection(isset($_POST['name' . $i]) ? $_POST['name' . $i] : "");
          $content = $function->sql_injection(isset($_POST['content' . $i]) ? $_POST['content' . $i] : "");
          $pos = $function->sql_injection(isset($_POST['pos' . $i]) ? $_POST['pos' . $i] : "");
          $property = $function->sql_injection(isset($_POST['property' . $i]) ? $_POST['property' . $i] : "");
          $Process->add_property($id_edit, $name, $content, $pos, $property);
        }
        return $function->msg_box_status(msg_box_general_succ, $msg_time, $_SESSION[$module]['general'], 1);
      } else $function->goto_url($_SESSION[$module]['general']);
      break;

    case "delproperty":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $Process->delete_coupons_property($id);
      return $function->msg_box_status(msg_box_general_del, $msg_time, $_SESSION[$module]['general'], 1);
      break;

    //Cap nhat bo loc
    case "filter":
      if ($action_edit == '') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $products_id = $id_edit;
      $category_id = $function->FixQuotes(isset($_POST['category_id']) ? $_POST['category_id'] : "");
      $url_one = $function->FixQuotes(isset($_POST['url_one']) ? $_POST['url_one'] : "");
      $url_two = $function->FixQuotes(isset($_POST['url_two']) ? $_POST['url_two'] : "");
      $url_three = $function->FixQuotes(isset($_POST['url_three']) ? $_POST['url_three'] : "");
      $numf_product = $Process->num_filter_products($products_id);
      if ($submit and $id_edit) {
        if ($numf_product < '1') {
          $Process->add_filter_products($products_id, $category_id, $url_one, $url_two, $url_three);
        } else {
          $Process->edit_filter_products($products_id, $category_id, $url_one, $url_two, $url_three);
        }
        return $function->msg_box_status(msg_box_general_del, $msg_time, $_SESSION[$module]['general'], 1);
      } else $function->goto_url($_SESSION[$module]['general']);
      break;
    //Them description
    case "description":
      $check_shop = $Process->check_user_products($id_edit);
      if ($action_edit == '' or $check_shop == '0') {
        return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
      }
      $_SESSION[$module]['description'] = URL_ADMIN . "?module=products&main=description&id_edit=$id_edit";
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