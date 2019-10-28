<?php

class Duhoc_news_class
{
    function Duhoc_news_class() { }

//Views
    function num_views($name_search, $category)
    {
        global $db;
        $language = LANG_AUGE_CMS;
        $sr_search = '';
        if ($name_search == '') {
            $sr_search .= "";
        } else {
            $sr_search .= "and a.news_name like '%" . $name_search . "%'";
        }

        if ($category == '') {
            $sr_search .= "";
        } else {
            $arr_id = $this->read_record($category);
            $sr_search .= " and b.category_id IN ($arr_id) ";
        }

        $sql = "SELECT a.news_id FROM list_duhoc_news a, list_cate_study_abroad b 
		where a.news_id >= '1' and a.news_category = b.id and a.language ='$language' $sr_search";

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
            $orderby = "ORDER BY a.news_id desc ";
        } else {
            $orderby = "ORDER BY $order $sc";
        }

        $sr_search = '';
        if ($name_search == '') {
            $sr_search .= "";
        } else {
            $sr_search .= "and a.news_name like '%" . $name_search . "%'";
        }

        if ($category == '') {
            $sr_search .= "";
        } else {
            $arr_id = $this->read_record($category);
            $sr_search .= " and b.id IN ($arr_id) ";
        }

        $sql = "SELECT a.news_id as id_tem,a.news_name,a.status,a.news_img,a.news_url,a.pos, b.service_name as category_name
		FROM list_duhoc_news a, list_cate_study_abroad b where a.news_id >= '1' and a.news_category = b.id 
		and a.language ='$language' $sr_search $orderby Limit $page,$per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        $db->db_freeresult($res);
        return $rows;
    }

//category parent all
    function read_record($id)
    {
        global $db;
        $array_id = "$id";
        $sql = "SELECT * FROM coupons_category WHERE parent_id  = '$id';";
        $rs = $db->db_query($sql);
        if ($db->db_numrows($rs) > 0) {
            while ($row = $db->db_fetchrow($rs)) {
                $array_id .= ',' . $this->read_record($row["category_id"]);
            }
        }
        $db->db_freeresult($rs);
        return $array_id;
        return $id;
    }

//Insert
    function insert_table($data)
    {
        global $db;
        $userid = $_SESSION[URL_ADMIN]["userid"];
        $created_date = time();
        $sql = "INSERT INTO list_duhoc_news(news_id,news_name,news_category,news_url,news_img,news_content,description,
				seo_title,seo_desc,seo_key,status,pos,language,created_date) 
				VALUES(NULL,'" . $data['news_name'] . "','" . $data['news_category'] . "','" . $data['news_url'] . "','" . $data['news_img'] . "','" . $data['news_content'] . "','" . $data['description'] . "',
				'" . $data['seo_title'] . "','" . $data['seo_desc'] . "','" . $data['seo_key'] . "',
				'0','0','" . $data['language'] . "','$created_date')";
        //echo $sql;exit;
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return false;
    }

//Edit
    function get_id($id)
    {
        global $db;
        $sql = "Select *, news_id as id_tem from list_duhoc_news where news_id = $id";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $db->db_freeresult($res);
        return $rows;
    }

    function edit_table($id, $data)
    {
        global $db;
        $sr = '';
        $sql = "Update list_duhoc_news set news_name ='" . $data['news_name'] . "', news_category ='" . $data['news_category'] . "',
		news_url ='" . $data['news_url'] . "',
		news_img ='" . $data['news_img'] . "',
		news_content ='" . $data['news_content'] . "',description ='" . $data['description'] . "',
		seo_title ='" . $data['seo_title'] . "',seo_desc ='" . $data['seo_desc'] . "',seo_key ='" . $data['seo_key'] . "'
		where news_id='$id'";
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return false;
    }

    function update_order_table($id, $news_name, $pos)
    {
        global $db;
        $id = intval($id);
        $sql = "Update list_duhoc_news set news_name ='$news_name', pos ='$pos' where news_id='$id'";
        $db->db_query($sql);
        return false;
    }

//delete
    function check_delete($id)
    {
        global $db;
        $sql = "Select news_id from list_duhoc_news where news_id = '$id' and status ='1'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function delete_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Delete from list_duhoc_news where news_id='$id' and status ='0'";
        $db->db_query($sql);
        return false;
    }

//Status
    function status_table($id, $status)
    {
        global $db;
        $sql = "Update list_duhoc_news set status ='$status' where news_id = $id";
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return 1;
    }

    function status_off_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Update list_duhoc_news set status ='0' where news_id='$id'";
        $db->db_query($sql);
        return false;
    }

    function status_on_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Update list_duhoc_news set status ='1' where news_id='$id'";
        $db->db_query($sql);
        return false;
    }
}

?>
