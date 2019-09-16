<?php
require("module/users_cv/users_cv.class.php");
function users_cv_process()
{
    global $db, $smarty, $function;
    global $module, $action_views, $action_insert, $action_edit, $action_delete, $main_url, $main_name, $msg_time, $main_content;
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

    if ($_SESSION[URL_ADMIN]["userid"] == 1) {
        $action_views = 'views';
        $smarty->assign("action_views", $action_views);
        $action_insert = 'insert';
        $smarty->assign("action_insert", $action_insert);
        $action_edit = 'edit';
        $smarty->assign("action_edit", $action_edit);
        $action_delete = 'delete';
        $smarty->assign("action_delete", $action_delete);
        $main_url = "users_cv";
    }

    $Process = new Users_cv_class;
    $url = $function->sql_injection($main_url);
    $file = $function->sql_injection($main_url);
    $smarty->assign("url", $url);
    $smarty->assign("main_name", $main_name);
    $smarty->assign("main_content", $main_content);

    switch ($main) {
        case "edit":
            if ($submit) {
                $data['info']['firstname'] = $function->sql_injection(isset($_POST['firstname']) ? $_POST['firstname'] : "");
                $data['info']['lastname'] = $function->sql_injection(isset($_POST['lastname']) ? $_POST['lastname'] : "");
                $data['info']['password'] = $function->sql_injection(isset($_POST['password']) ? $_POST['password'] : "");
                $data['info']['email'] = $function->sql_injection(isset($_POST['email']) ? $_POST['email'] : "");
                $data['info']['mobile'] = $function->FixQuotes(isset($_POST['mobile']) ? $_POST['mobile'] : "");
                $data['info']['user_role'] = $function->FixQuotes(isset($_POST['user_role']) ? intval($_POST['user_role']) : 0);
                $data['info']['status'] = $function->FixQuotes(isset($_POST['status']) ? intval($_POST['status']) : 0);
                if ($data['info']['firstname'] == "") {
                    return $function->msg_box_status(msg_box_erro_info, $msg_time, $_SESSION[$module]['url_views'], 2);
                } else {
                    var_dump($data['info']['lastname']);
                    $id_edit = $_SESSION[URL_ADMIN]["userid"];
                    $Process->edit_table($id_edit, $data['info']);
                    return $function->msg_box_status(msg_box_edit_succ, $msg_time, URL_ADMIN . "?module=homes", 1);
                }
            } else {
                $id_edit = $_SESSION[URL_ADMIN]["userid"];
                $rs_edit = $Process->get_id($id_edit);
                $smarty->assign("rs_edit", $rs_edit);
                return $smarty->fetch("users/edit.html");
            }
            break;
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
            if ($limit) {
                $smarty->assign("url_limit", "&limit=$limit");
                $url_limit = "&limit=$limit";
            }
            if ($order) {
                $smarty->assign("url_order", "&order=$order&sc=$sc");
                $url_order = "&order=$order&sc=$sc";
            }
            if ($id_edit) {
                $smarty->assign("url_edit", "&id_edit=$id_edit");
            }

            $numf = $Process->num_views($name_search);
            if ($numf) {
                if ($page == "") {
                    $page = 0;
                }
                if ($limit == "") {
                    $limit = 20;
                }
                $per_page = $limit;
                $all_page = $numf ? $numf : 1;
                $base_url = URL_ADMIN . "?module={$url}&main=views{$url_limit}{$url_order}{$url_category}";
                $url_last = "";
                $paging = $function->generate_page_cms($base_url, $url_last, $all_page, $per_page, $page);
                $rs = $Process->views_table($page, $per_page, $order, $sc, $name_search);

                $smarty->assign("paging", $paging);
                $smarty->assign("numf", $numf);
                $smarty->assign("rs", $rs);
            }
            $rs_edit = $Process->get_id($id_edit);
            $smarty->assign("rs_edit", $rs_edit);
            return $smarty->fetch("{$file}/views.html");
            break;
        case "insert":
            if ($action_insert == '' and $action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }
            if ($submit) {
                $data['info']['firstname'] = $function->sql_injection(isset($_POST['firstname']) ? $_POST['firstname'] : "");
                $data['info']['lastname'] = $function->sql_injection(isset($_POST['lastname']) ? $_POST['lastname'] : "");
                $data['info']['password'] = $function->sql_injection(isset($_POST['password']) ? $_POST['password'] : "");
                $data['info']['email'] = $function->sql_injection(isset($_POST['email']) ? $_POST['email'] : "");
                $data['info']['mobile'] = $function->FixQuotes(isset($_POST['mobile']) ? $_POST['mobile'] : "");
                $data['info']['user_role'] = $function->FixQuotes(isset($_POST['user_role']) ? intval($_POST['user_role']) : 0);
                $data['info']['status'] = $function->FixQuotes(isset($_POST['status']) ? intval($_POST['status']) : 0);
                if ($data['info']['firstname'] == "") {
                    return $function->msg_box_status(msg_box_erro_info, $msg_time, $_SESSION[$module]['url_views'], 2);
                } else {
                    $checks_email = $Process->check_email_register($data['info']['email']);
                    $checks_user = $Process->check_user_register($data['info']['username']);
                    if ($id_edit) {
                        $Process->edit_table($id_edit, $data['info']);
                        return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'],
                            1);
                    } else {
                        if ($checks_user >= 1) {
                            return $function->msg_box_status(msg_box_erro_user, $msg_time,
                                $_SESSION[$module]['url_views'], 2);
                        } elseif ($checks_email >= 1) {
                            return $function->msg_box_status(msg_box_erro_email, $msg_time,
                                $_SESSION[$module]['url_views'], 2);
                        } else {
                            $_SESSION[$url]['name_search'] = '';
                            $Process->insert_table($data['info']);
                            return $function->msg_box_status(msg_box_insert_succ, $msg_time,
                                $_SESSION[$module]['url_views'], 1);
                        }
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
                    $firstname = $function->sql_injection($_POST['firstname' . $id]);
                    $email = $function->sql_injection($_POST['email' . $id]);
                    $mobile = $function->sql_injection($_POST['mobile' . $id]);
                    $id = $function->sql_injection(intval($id));
                    $Process->update_order_table($id, $firstname, $email, $mobile);
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
        case "active_translate":
            if ($action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }
            $id = $function->sql_injection($_GET['id']);
            $active_translate = $function->sql_injection($_GET['active_translate']);
            if ($active_translate == 1) {
                $Process->active_translate_table($id, 0);
            } else {
                $Process->active_translate_table($id, 1);
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

        //User role
        case "action_role":
            if ($action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }
            $_SESSION[$module]['url_views'] = $function->FixQuotes($_SERVER['REQUEST_URI']);
            $Process->update_module_action($id);
            $rs_tree = $Process->views_tree_action($id);
            $smarty->assign('rs_tree', $rs_tree);

            $rs_name = $Process->get_name_users($id);
            $smarty->assign('firstname', $rs_name['firstname']);
            return $smarty->fetch("{$file}/role.html");
            break;
        case "action_user":
            if ($action_edit == '') {
                return $function->msg_box_status(msg_box_action, $msg_time, URL_ADMIN . "?module=homes", 2);
            }
            $check = $_POST['checkbox_id'];
            if ($check != null) {
                foreach ($check as $id) {
                    $action_views = $function->sql_injection(isset($_POST['action_views' . $id]) ? $_POST['action_views' . $id] : "");
                    $action_insert = $function->sql_injection(isset($_POST['action_insert' . $id]) ? $_POST['action_insert' . $id] : "");
                    $action_edit = $function->sql_injection(isset($_POST['action_edit' . $id]) ? $_POST['action_edit' . $id] : "");
                    $action_delete = $function->sql_injection(isset($_POST['action_delete' . $id]) ? $_POST['action_delete' . $id] : "");
                    $status = $function->sql_injection(isset($_POST['status' . $id]) ? $_POST['status' . $id] : "");
                    $id = $function->sql_injection(intval($id));
                    $Process->update_action_user($id, $action_views, $action_insert, $action_edit, $action_delete,
                        $status);
                }
            }
            return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
            break;
        case "action_delete":
            $Process->delete_module_action($id);
            return $function->msg_box_status(msg_box_edit_succ, $msg_time, $_SESSION[$module]['url_views'], 1);
            break;

    }
}

?>
