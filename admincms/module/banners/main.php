<?php
function banners_process()
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
    $submit = $function->sql_injection(isset($_POST['submit']) ? $_POST['submit'] : "");

    $Process = new Banners_class;
    $url = $function->sql_injection($main_url);
    $file = $function->sql_injection($main_url);
    $smarty->assign("url", $url);
    $smarty->assign("main_name", $main_name);
    $smarty->assign("main_content", $main_content);

    $class_cate = new categorys_class;
    $tree_select = $class_cate->select_tree_arrays(0);
    $smarty->assign('tree_select', $tree_select);

    switch ($main) {
        case "search":
            $name_search = $function->sql_injection(isset($_POST['name_search']) ? $_POST['name_search'] : "");
            $_SESSION[$url]['name_search'] = $name_search;

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
            $name_search = $function->sql_injection(isset($_SESSION[$url]['name_search']) ? $_SESSION[$url]['name_search'] : "");
            $smarty->assign("name_search", $name_search);
            $url_limit = '';
            $url_order = '';
            $url_category = '';
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
            if ($id_edit) {
                $smarty->assign("url_edit", "&id_edit=$id_edit");
            }

            $numf = $Process->num_views($name_search, $category);
            if ($numf) {
                if ($page == "") {
                    $page = 0;
                }
                if ($limit == "") {
                    $limit = 10;
                }
                $per_page = $limit;
                $all_page = $numf ? $numf : 1;
                $base_url = URL_ADMIN . "?module={$url}&main=views{$url_limit}{$url_order}{$url_category}";
                $url_last = "";
                $paging = $function->generate_page_cms($base_url, $url_last, $all_page, $per_page, $page);
                $rs = $Process->views_table($page, $per_page, $order, $sc, $name_search, $category);
                $smarty->assign("paging", $paging);
                $smarty->assign("numf", $numf);
                $smarty->assign("rs", $rs);
            }
            $_SESSION[$module]['url_views'] = $base_url . $url_page;
            $rs_edit = $Process->get_id($id_edit);
            $smarty->assign("rs_edit", $rs_edit);
            return $smarty->fetch("{$file}/views.html");
            break;
        case "insert":
            if ($action_insert == '' and $action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }
            if ($submit) {
                $data['info']['banner_name'] = $function->sql_injection(isset($_POST['banner_name']) ? $_POST['banner_name'] : "");
                $data['info']['banner_link'] = $function->FixQuotes(isset($_POST['banner_link']) ? $_POST['banner_link'] : "");
                $data['info']['banner_content'] = $function->FixQuotes(isset($_POST['banner_content']) ? $_POST['banner_content'] : "");
                $data['info']['banner_category'] = $function->sql_injection(isset($_POST['banner_category']) ? intval($_POST['banner_category']) : 0);
                $data['info']['banner_bg'] = $function->sql_injection(isset($_POST['banner_bg']) ? $_POST['banner_bg'] : "");
                $data['info']['category_id'] = $function->sql_injection(isset($_POST['category_id']) ? intval($_POST['category_id']) : 0);
                $data['info']['pos'] = $function->sql_injection(isset($_POST['pos']) ? intval($_POST['pos']) : 0);
                $data['info']['status'] = $function->sql_injection(isset($_POST['status']) ? intval($_POST['status']) : 0);
                $data['info']['language'] = LANG_AUGE_CMS;

                // upload image
                $types = [
                    "image/gif",
                    "image/GIF",
                    "image/JPG",
                    "image/png",
                    "image/PNG",
                    "image/jpg",
                    "image/JPEG",
                    "image/jpeg"
                ];
                $file_size = $_FILES['filename']['size'];
                $tmp_name = $_FILES['filename']['tmp_name'];
                $type_name = $_FILES['filename']['type'];
                $new_name = $_FILES['filename']['name'];
                $name_image = date("hs") . '-' . $function->character_name_img($new_name);
                if ($file_size > 2097152) {
                    return $function->msg_box_status(msg_box_erro_img, 20, $_SESSION[$module]['url_views'], 2);
                } elseif (in_array($type_name, $types)) {
                    move_uploaded_file($tmp_name, IMG_UPLOAD . $url . '/' . $name_image);
                    $data['info']['banner_img'] = $name_image;
                } else {
                    $data['info']['banner_img'] = '';
                }
                // end image
                if ($data['info']['banner_name'] == "") {
                    return $function->msg_box_status(msg_box_erro_info, $msg_time, $_SESSION[$module]['url_views'], 2);
                } else {
                    if ($id_edit) {
                        $image_old = $function->FixQuotes(isset($_POST['image_old']) ? $_POST['image_old'] : "");
                        $delete_img = $function->FixQuotes(isset($_POST['delete_img']) ? intval($_POST['delete_img']) : 0);
                        if ($new_name) {
                            if ($image_old) {
                                //unlink(IMG_UPLOAD.$url.'/'.$image_old);
                            }
                        } elseif ($delete_img == 1 or $new_name != "") {
                            //unlink(IMG_UPLOAD.$url.'/'.$image_old);
                            $data['info']['banner_img'] = "";
                        } else {
                            $data['info']['banner_img'] = $image_old;
                        }

                        $Process->edit_table($id_edit, $data['info']);
                        return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'],
                            1);
                    } else {
                        $_SESSION[$url]['name_search'] = '';
                        $Process->insert_table($data['info']);
                        return $function->msg_box_status(msg_box_insert_succ, $msg_time,
                            $_SESSION[$module]['url_views'], 1);
                    }
                }
            } else {
                $function->goto_url($_SESSION[$module]['url_views']);
            }
            break;
        case "copys":
            if ($action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }

            $rs_copy = $Process->get_id($id_edit);
            $smarty->assign("rs_copy", $rs_copy);

            $data['info']['banner_name'] = $function->sql_injection(isset($rs_copy['banner_name']) ? $rs_copy['banner_name'] : "");
            $data['info']['banner_img'] = $function->sql_injection(isset($rs_copy['banner_img']) ? $rs_copy['banner_img'] : "");
            $data['info']['banner_link'] = $function->FixQuotes(isset($rs_copy['banner_link']) ? $rs_copy['banner_link'] : "");
            $data['info']['banner_content'] = $function->FixQuotes(isset($rs_copy['banner_content']) ? $rs_copy['banner_content'] : "");
            $data['info']['banner_category'] = $function->sql_injection(isset($rs_copy['banner_category']) ? intval($rs_copy['banner_category']) : 0);
            $data['info']['banner_bg'] = $function->sql_injection(isset($rs_copy['banner_bg']) ? $rs_copy['banner_bg'] : "");
            $data['info']['category_id'] = $function->sql_injection(isset($rs_copy['category_id']) ? intval($rs_copy['category_id']) : 0);
            $data['info']['pos'] = $function->sql_injection(isset($rs_copy['pos']) ? intval($rs_copy['pos']) : 0);
            $data['info']['status'] = $function->sql_injection(isset($rs_copy['status']) ? intval($rs_copy['status']) : 0);
            $data['info']['language'] = LANG_AUGE_CMS;

            $Process->insert_table($data['info']);
            return $function->msg_box_status(msg_box_insert_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
            break;
        case "update_order":
            if ($action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }
            $check = $_POST['checkbox_id'];
            if ($check != null) {
                foreach ($check as $id) {
                    $banner_name = $function->sql_injection($_POST['banner_name' . $id]);
                    $pos = $function->sql_injection($_POST['pos' . $id]);
                    $id = $function->sql_injection(intval($id));
                    $Process->update_order_table($id, $banner_name, $pos);
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
                    $checks = $Process->check_delete($id);
                    if ($checks > 0) {
                        return $function->msg_box_status(msg_box_erro_status, $msg_time,
                            $_SESSION[$module]['url_views'], 2);
                    } else {
                        $id = $function->sql_injection(intval($id));
                        //$rs = $Process->get_id($id);
                        //unlink(IMG_UPLOAD.$url.'/'.$rs["banner_img"]);
                        $Process->delete_table($id);
                    }
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
    }
}

?>
