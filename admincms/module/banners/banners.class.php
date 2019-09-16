<?php

class Banners_class
{
    function Banners_class() { }

//Views
    function num_views($name_search, $category)
    {
        global $db;
        $language = LANG_AUGE_CMS;
        $sr_search = '';
        if ($name_search == '') {
            $sr_search .= "";
        } else {
            $sr_search .= "and a.banner_name like '%" . $name_search . "%'";
        }

        if ($category == '') {
            $sr_search .= "";
        } else {
            $sr_search .= "and a.category_id = '$category'";
        }

        $sql = "SELECT a.banner_id FROM coupons_banner a, coupons_category b 
		where a.banner_id >= '1' and a.category_id = b.category_id and a.language ='$language' $sr_search";

        $res = $db->db_query($sql);
        $result = $db->db_query($sql);
        $rows = $db->db_numrows($result);
        $db->db_freeresult($res);
        return $rows;
    }

    function views_table($page, $per_page, $order, $sc, $name_search, $category)
    {
        global $db;
        $language = LANG_AUGE_CMS;
        if ($order == "") {
            $orderby = "ORDER BY a.banner_id desc ";
        } else {
            $orderby = "ORDER BY $order $sc";
        }

        $sr_search = '';
        if ($name_search == '') {
            $sr_search .= "";
        } else {
            $sr_search .= "and a.banner_name like '%" . $name_search . "%'";
        }

        if ($category == '') {
            $sr_search .= "";
        } else {
            $sr_search .= "and a.category_id = '$category'";
        }

        $sql = "SELECT a.banner_id as id_tem, a.banner_name, a.status, a.pos ,a.banner_img, b.category_name, a.banner_category
		FROM coupons_banner a, coupons_category b where a.banner_id >= '1' and a.category_id = b.category_id 
		and a.language ='$language' $sr_search $orderby Limit $page,$per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        $db->db_freeresult($res);
        return $rows;
    }

//Insert
    function insert_table($data)
    {
        global $db;
        $sql = "INSERT INTO coupons_banner(banner_id,banner_name,banner_link,banner_content,banner_img,
				banner_bg,banner_category,category_id,status,pos,language) VALUES(NULL,'" . $data['banner_name'] . "',
				'" . $data['banner_link'] . "','" . $data['banner_content'] . "','" . $data['banner_img'] . "','" . $data['banner_bg'] . "',
				'" . $data['banner_category'] . "','" . $data['category_id'] . "','" . $data['status'] . "','" . $data['pos'] . "','" . $data['language'] . "')";
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return false;
    }

//Edit
    function get_id($id)
    {
        global $db;
        $sql = "Select *, banner_id as id_tem from coupons_banner where banner_id = $id";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $db->db_freeresult($res);
        return $rows;
    }

    function edit_table($id, $data)
    {
        global $db;
        $sr = '';
        $sql = "Update coupons_banner set banner_name ='" . $data['banner_name'] . "', banner_link='" . $data['banner_link'] . "',
		banner_content='" . $data['banner_content'] . "',banner_img='" . $data['banner_img'] . "',banner_category='" . $data['banner_category'] . "',
		banner_bg='" . $data['banner_bg'] . "',
		category_id ='" . $data['category_id'] . "', status ='" . $data['status'] . "',pos ='" . $data['pos'] . "' where banner_id='$id'";
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return false;
    }

    function update_order_table($id, $banner_name, $pos)
    {
        global $db;
        $id = intval($id);
        $sql = "Update coupons_banner set banner_name ='$banner_name', pos ='$pos' where banner_id='$id'";
        $db->db_query($sql);
        return false;
    }

//delete
    function check_delete($id)
    {
        global $db;
        $sql = "Select banner_id from coupons_banner where banner_id = '$id' and status ='1'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function delete_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Delete from coupons_banner where banner_id='$id' and status ='0'";
        $db->db_query($sql);
        return false;
    }

//Status
    function status_table($id, $status)
    {
        global $db;
        $sql = "Update coupons_banner set status ='$status' where banner_id = $id";
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return 1;
    }

    function status_off_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Update coupons_banner set status ='0' where banner_id='$id'";
        $db->db_query($sql);
        return false;
    }

    function status_on_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Update coupons_banner set status ='1' where banner_id='$id'";
        $db->db_query($sql);
        return false;
    }
}

?>
