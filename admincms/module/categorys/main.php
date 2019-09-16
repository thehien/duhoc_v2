<?php
function categorys_process()
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
    $submit = $function->sql_injection(isset($_POST['submit']) ? $_POST['submit'] : "");

    $Process = new categorys_class;
    $url = $function->sql_injection($main_url);
    $file = $function->sql_injection($main_url);
    $smarty->assign("url", $url);
    $smarty->assign("main_name", $main_name);
    $smarty->assign("main_content", $main_content);

    $tree_select = $Process->select_tree_arrays($id_edit);
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
            $url_order = '';
            if ($order) {
                $smarty->assign("url_order", "&order=$order&sc=$sc");
            }
            $rs_tree = $Process->views_tree_arrays($name_search, $order, $sc);
            $smarty->assign('rs_tree', $rs_tree);

            if ($id_edit) {
                $smarty->assign("url_edit", "&id_edit=$id_edit");
            }
            $rs_edit = $Process->get_id($id_edit);
            $smarty->assign("rs_edit", $rs_edit);

            $base_url = URL_ADMIN . "?module={$url}&main=views{$url_order}";
            $_SESSION[$module]['url_views'] = $base_url;
            return $smarty->fetch("{$file}/views.html");
            break;
        case "insert":
            if ($action_insert == '' and $action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }
            if ($submit) {
                $data['info']['category_name'] = $function->sql_injection(isset($_POST['category_name']) ? $_POST['category_name'] : "");
                $data['info']['category_content'] = isset($_POST['category_content']) ? $_POST['category_content'] : "";
                $data['info']['category_code'] = isset($_POST['category_code']) ? $_POST['category_code'] : "";
                if ($_POST['category_url']) {
                    $data['info']['category_url'] = $function->character_url(isset($_POST['category_url']) ? $_POST['category_url'] : "");
                } else {
                    $data['info']['category_url'] = $function->character_url(isset($_POST['category_name']) ? $_POST['category_name'] : "");
                }
                $data['info']['parent_id'] = $function->sql_injection(isset($_POST['parent_id']) ? $_POST['parent_id'] : "");
                $data['info']['color'] = $function->sql_injection(isset($_POST['color']) ? $_POST['color'] : "");
                $data['info']['link'] = $function->sql_injection(isset($_POST['link']) ? $_POST['link'] : "");

                $data['info']['layout'] = $function->sql_injection(isset($_POST['news_url']) ? $_POST['layout'] : "");
                if ($_POST['seo_title']) {
                    $data['info']['seo_title'] = $function->sql_injection(isset($_POST['seo_title']) ? $_POST['seo_title'] : "");
                } else {
                    $data['info']['seo_title'] = $function->sql_injection(isset($_POST['category_name']) ? $_POST['category_name'] : "");
                }

                if ($_POST['seo_key']) {
                    $data['info']['seo_key'] = $function->sql_injection(isset($_POST['seo_key']) ? $_POST['seo_key'] : "");
                } else {
                    $data['info']['seo_key'] = $function->sql_injection(isset($_POST['category_name']) ? $_POST['category_name'] : "");
                }

                if ($_POST['seo_desc']) {
                    $data['info']['seo_desc'] = $function->FixQuotes(isset($_POST['seo_desc']) ? $_POST['seo_desc'] : "");
                } else {
                    $data['info']['seo_desc'] = $function->FixQuotes(isset($_POST['category_content']) ? $_POST['category_content'] : "");
                }

                $data['info']['news_url'] = $function->sql_injection(isset($_POST['news_url']) ? $_POST['news_url'] : "");
                $data['info']['total_percent'] = $function->sql_injection(isset($_POST['total_percent']) ? intval($_POST['total_percent']) : 0);
                $data['info']['pos'] = $function->sql_injection(isset($_POST['pos']) ? intval($_POST['pos']) : 0);
                $data['info']['status'] = $function->sql_injection(isset($_POST['status']) ? intval($_POST['status']) : 0);
                $data['info']['language'] = LANG_AUGE_CMS;

                $_SESSION["info"]["parent_id"] = $data['info']['parent_id'];

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
                    $data['info']['category_img'] = $name_image;
                } else {
                    $data['info']['category_img'] = '';
                }
                // end image

                if ($data['info']['category_name'] == "") {
                    return $function->msg_box_status(msg_box_erro_info, $msg_time, $_SESSION[$module]['url_views'], 2);
                } else {
                    if ($id_edit) {
                        $image_old = $function->FixQuotes(isset($_POST['image_old']) ? $_POST['image_old'] : "");
                        $delete_img = $function->FixQuotes(isset($_POST['delete_img']) ? intval($_POST['delete_img']) : 0);
                        if ($new_name) {
                            if ($image_old) {
                                unlink(IMG_UPLOAD . $url . '/' . $image_old);
                            }
                        } elseif ($delete_img == 1 or $new_name != "") {
                            unlink(IMG_UPLOAD . $url . '/' . $image_old);
                            $data['info']['category_img'] = "";
                        } else {
                            $data['info']['category_img'] = $image_old;
                        }

                        $Process->edit_table($id_edit, $data['info']);
                        return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'],
                            1);
                    } else {
                        $Process->insert_table($data['info']);
                        return $function->msg_box_status(msg_box_insert_succ, $msg_time,
                            $_SESSION[$module]['url_views'], 1);
                    }
                }
            } else {
                $function->goto_url($_SESSION[$module]['url_views']);
            }
            break;
        case "update_order":
            if ($action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }
            $check = $_POST['checkbox_id'];
            if ($check != null) {
                foreach ($check as $id) {
                    $pos = $function->sql_injection($_POST['pos' . $id]);
                    $total_percent = $function->sql_injection($_POST['total_percent' . $id]);
                    $id = $function->sql_injection(intval($id));
                    $Process->update_order_table($id, $pos, $total_percent);
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
                    $checks_parent = $Process->check_delete_parent_id($id);
                    $checks_product = $Process->check_delete_product($id);
                    $checks_news = $Process->check_delete_news($id);
                    if ($checks > 0) {
                        return $function->msg_box_status(msg_box_erro_status, $msg_time,
                            $_SESSION[$module]['url_views'], 2);
                    } elseif ($checks_parent > 0) {
                        return $function->msg_box_status(msg_box_erro_parent, $msg_time,
                            $_SESSION[$module]['url_views'], 2);
                    } elseif ($checks_product > 0) {
                        return $function->msg_box_status(msg_box_erro_parent, $msg_time,
                            $_SESSION[$module]['url_views'], 2);
                    } elseif ($checks_news > 0) {
                        return $function->msg_box_status(msg_box_erro_parent, $msg_time,
                            $_SESSION[$module]['url_views'], 2);
                    } else {

                        $id = $function->sql_injection(intval($id));
                        $rs = $Process->get_id($id);
                        unlink(IMG_UPLOAD . $url . '/' . $rs["category_img"]);
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
