<?php

class categorys_class
{
    function categorys_class() { }

//Views tree
    function views_tree_arrays(
        $name_search = '',
        $order = '',
        $sc = '',
        $parent_id = 0,
        $spacing = '',
        $tree_arrays = '',
        $level = 0
    ) {
        global $db;
        $language = LANG_AUGE_CMS;
        if (!is_array($tree_arrays)) {
            $tree_arrays = [];
        }
        if ($order == "") {
            $orderby = "ORDER BY a.pos ASC";
        } else {
            $orderby = "ORDER BY $order $sc";
        }

        if ($name_search == '') {
            $sr_search = "";
        } else {
            $sr_search = "and category_name like '%" . $name_search . "%'";
        }

        $sql = "SELECT  a.*, a.category_id as id_tem FROM coupons_category a WHERE a.parent_id = $parent_id and language ='$language' $sr_search $orderby";
        $res = $db->db_query($sql);
        if ($db->db_numrows($res) > 0) {
            $rows = $db->db_fetchrowset($res);
            foreach ($rows as $tree) {
                $check_sub = $this->check_sub_category($tree['category_id']);
                if ($check_sub > 0) {
                    $sub_category = 1;
                } else {
                    $sub_category = 0;
                }

                $str = $spacing . '&nbsp;&nbsp;' . $tree['category_name'];
                if ($level == 0) {
                    $str = $spacing . '&raquo;&nbsp;<b>' . $tree['category_name'] . '</b>';
                } elseif ($level == 1) {
                    $str = $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;<b>' . $tree['category_name'] . '</b>';
                } elseif ($level == 2) {
                    $str = $spacing . '&nbsp;&nbsp;&nbsp;&raquo;&raquo;&raquo;&nbsp;<b>' . $tree['category_name'] . '</b>';
                }
                $i = '';
                $tree_arrays[] = [
                    "category_name" => $str,
                    "id_tem" => $tree['id_tem'],
                    "category_id" => $tree['category_id'],
                    "category_url" => $tree['category_url'],
                    "parent_id" => $tree['parent_id'],
                    "total_percent" => $tree['total_percent'],
                    "news_url" => $tree['news_url'],
                    "layout" => $tree['layout'],
                    "link" => $tree['link'],
                    "color" => $tree['color'],
                    "pos" => $tree['pos'],
                    "status" => $tree['status'],
                    "sub_category" => $sub_category,
                    "level" => $level,
                    "rows" => $i++
                ];
                $level++;
                $db->db_freeresult($res);
                $tree_arrays = $this->views_tree_arrays($name_search = '', $order = '', $sc = '', $tree['category_id'],
                    $spacing . '', $tree_arrays, $level);
                $level--;
            }
        }
        return $tree_arrays;
    }

    function check_sub_category($parent_id)
    {
        global $db;
        $sql = "Select parent_id From coupons_category Where parent_id = $parent_id";
        $res = $db->db_query($sql);
        $num = $db->db_numrows($res);
        $db->db_freeresult($res);
        return $num;
    }

//select tree
    function select_tree_arrays($check_id, $news_url = '', $parent_id = 0, $spacing = '', $tree_arrays = '', $level = 0)
    {
        global $db;
        $language = LANG_AUGE_CMS;
        if (!is_array($tree_arrays)) {
            $tree_arrays = [];
        }
        $str = "";
        if ($news_url == 1) {
            $str .= "and a.news_url=''";
        }
        if ($news_url == 2) {
            $str .= "and a.news_url='menu/'";
        }
        if ($check_id > 0) {
            $str .= "and a.parent_id <> $check_id and a.category_id <> $check_id";
        }
        $sql = "SELECT a.category_name,a.category_id,a.parent_id FROM coupons_category a 
	WHERE a.parent_id = $parent_id and language ='$language' and status = 1 $str ORDER BY a.pos ASC";
        $res = $db->db_query($sql);
        if ($db->db_numrows($res) > 0) {
            $rows = $db->db_fetchrowset($res);
            foreach ($rows as $tree) {
                if ($level == 0) {
                    $str = $spacing . '&raquo;&nbsp;<b>' . $tree['category_name'] . '</b>';
                } else {
                    $str = $spacing . '&raquo;&raquo;&nbsp;' . $tree['category_name'];
                }

                $tree_arrays[] = [
                    "category_name" => $str,
                    "category_id" => $tree['category_id'],
                    "level" => $level
                ];
                $level++;
                $db->db_freeresult($res);
                $tree_arrays = $this->select_tree_arrays($check_id, $news_url = '', $tree['category_id'],
                    $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;', $tree_arrays, $level);
                $level--;
            }
        }
        return $tree_arrays;
    }

    //select tree
    function get_list_study_arrays(
        $check_id,
        $news_url = '',
        $parent_id = 0,
        $spacing = '',
        $tree_arrays = '',
        $level = 0
    ) {
        global $db;
        $language = LANG_AUGE_CMS;
        if (!is_array($tree_arrays)) {
            $tree_arrays = [];
        }
        $str = "";
        if ($news_url == 1) {
            $str .= "and a.service_url=''";
        }
        if ($news_url == 2) {
            $str .= "and a.service_url='menu/'";
        }
        if ($check_id > 0) {
            $str .= "and a.id <> $check_id";
        }
        $sql = "SELECT a.service_name,a.id FROM list_cate_study_abroad a 
	WHERE language ='$language' and status = 1 $str ORDER BY a.id ASC";
        //echo $sql;
        $res = $db->db_query($sql);
        if ($db->db_numrows($res) > 0) {
            $rows = $db->db_fetchrowset($res);
            foreach ($rows as $tree) {
                if ($level == 0) {
                    $str = $spacing . '&raquo;&nbsp;<b>' . $tree['service_name'] . '</b>';
                } else {
                    $str = $spacing . '&raquo;&raquo;&nbsp;' . $tree['service_name'];
                }

                $tree_arrays[] = [
                    "category_name" => $str,
                    "category_id" => $tree['id'],
                    "level" => $level
                ];
                $level++;
                $db->db_freeresult($res);
//                $tree_arrays = $this->get_list_industry_arrays($check_id, $news_url = '', $tree['id'],
//                    $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;', $tree_arrays, $level);
//                $level--;
            }
        }
        return $tree_arrays;
    }

    //select tree
    function get_list_news_category_arrays(
        $check_id,
        $news_url = '',
        $parent_id = 0,
        $spacing = '',
        $tree_arrays = '',
        $level = 0
    ) {
        global $db;
        $language = LANG_AUGE_CMS;
        if (!is_array($tree_arrays)) {
            $tree_arrays = [];
        }
        $str = "";
        if ($news_url == 1) {
            $str .= "and a.category_url=''";
        }
        if ($news_url == 2) {
            $str .= "and a.category_url='menu/'";
        }
        if ($check_id > 0) {
            $str .= "and a.category_id <> $check_id";
        }
        $sql = "SELECT a.category_name,a.category_id FROM list_news_category a 
	WHERE language ='$language' and status = 1 $str ORDER BY a.category_id ASC";
        //echo $sql;
        $res = $db->db_query($sql);
        if ($db->db_numrows($res) > 0) {
            $rows = $db->db_fetchrowset($res);
            foreach ($rows as $tree) {
                if ($level == 0) {
                    $str = $spacing . '&raquo;&nbsp;<b>' . $tree['category_name'] . '</b>';
                } else {
                    $str = $spacing . '&raquo;&raquo;&nbsp;' . $tree['category_name'];
                }

                $tree_arrays[] = [
                    "category_name" => $str,
                    "category_id" => $tree['category_id'],
                    "level" => $level
                ];
                $level++;
                $db->db_freeresult($res);
//                $tree_arrays = $this->get_list_industry_arrays($check_id, $news_url = '', $tree['id'],
//                    $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;', $tree_arrays, $level);
//                $level--;
            }
        }
        return $tree_arrays;
    }

    //select list service
    function get_list_category_arrays(
        $parent_id = 0,
        $spacing = '',
        $tree_arrays = '',
        $level = 0
    ) {
        global $db;
        $language = LANG_AUGE_CMS;
        if (!is_array($tree_arrays)) {
            $tree_arrays = [];
        }
        $str = "";
        if ($parent_id) {
            $str .= "and a.parent_id = '$parent_id'";
        }

        $sql = "SELECT a.category_name,a.category_id FROM coupons_category a 
        WHERE language ='$language' and status = 1 $str ORDER BY a.category_id ASC";
        //echo $sql;
        $res = $db->db_query($sql);
        if ($db->db_numrows($res) > 0) {
            $rows = $db->db_fetchrowset($res);
            foreach ($rows as $tree) {
                if ($level == 0) {
                    $str = $spacing . '&raquo;&nbsp;<b>' . $tree['category_name'] . '</b>';
                } else {
                    $str = $spacing . '&raquo;&raquo;&nbsp;' . $tree['category_name'];
                }

                $tree_arrays[] = [
                    "category_name" => $str,
                    "category_id" => $tree['category_id'],
                    "level" => $level
                ];
                $level++;
                $db->db_freeresult($res);
            }
        }
        return $tree_arrays;
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
        $sql = "INSERT INTO coupons_category(category_id,category_name,category_content,category_code,category_url,category_img,parent_id,pos,status,color,link,layout,language,seo_title,seo_desc,seo_key,news_url,total_percent) 
				VALUES(NULL,'" . $data['category_name'] . "','" . $data['category_content'] . "','" . $data['category_code'] . "','" . $data['category_url'] . "','" . $data['category_img'] . "','" . $data['parent_id'] . "','" . $data['pos'] . "','" . $data['status'] . "','" . $data['color'] . "','" . $data['link'] . "','" . $data['layout'] . "','" . $data['language'] . "','" . $data['seo_title'] . "','" . $data['seo_desc'] . "','" . $data['seo_key'] . "','" . $data['news_url'] . "','" . $data['total_percent'] . "')";
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return false;
    }

//Edit
    function get_id($id)
    {
        global $db;
        $sql = "Select *, category_id as id_tem from coupons_category where category_id = $id";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $db->db_freeresult($res);
        return $rows;
    }

    function edit_table($id, $data)
    {
        global $db;
        $sql = "Update coupons_category set category_name='" . $data['category_name'] . "', category_content='" . $data['category_content'] . "',
        category_code='" . $data['category_code'] . "',
		category_url='" . $data['category_url'] . "',category_img='" . $data['category_img'] . "',parent_id='" . $data['parent_id'] . "',
		pos='" . $data['pos'] . "',status='" . $data['status'] . "',color='" . $data['color'] . "',link='" . $data['link'] . "',
		layout='" . $data['layout'] . "',seo_title='" . $data['seo_title'] . "',total_percent='" . $data['total_percent'] . "',
		seo_desc='" . $data['seo_desc'] . "',seo_key='" . $data['seo_key'] . "',news_url='" . $data['news_url'] . "'
		where category_id='$id'";
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return false;
    }

    function update_order_table($id, $pos, $total_percent)
    {
        global $db;
        $id = intval($id);
        $sql = "Update coupons_category set pos ='$pos', total_percent='$total_percent' where category_id='$id'";
        $db->db_query($sql);
        return false;
    }

//delete ok
    function check_delete($id)
    {
        global $db;
        $sql = "Select category_id from coupons_category where category_id = '$id' and status ='1'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function check_delete_parent_id($id)
    {
        global $db;
        $sql = "Select parent_id from coupons_category where parent_id = '$id'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function check_delete_product($id)
    {
        global $db;
        $sql = "Select news_category from coupons_products where news_category = '$id'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function check_delete_news($id)
    {
        global $db;
        $sql = "Select news_category from coupons_news where news_category = '$id'";
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function delete_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Delete from coupons_category where category_id='$id' and status ='0' and category_id > '20'";
        $db->db_query($sql);
        return false;
    }

//Status ok
    function status_table($id, $status)
    {
        global $db;
        $sql = "Update coupons_category set status ='$status' where category_id = $id";
        $res = $db->db_query($sql);
        $db->db_freeresult($res);
        return 1;
    }

    function status_off_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Update coupons_category set status ='0' where category_id='$id'";
        $db->db_query($sql);
        return false;
    }

    function status_on_table($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Update coupons_category set status ='1' where category_id='$id'";
        $db->db_query($sql);
        return false;
    }

}

?>
