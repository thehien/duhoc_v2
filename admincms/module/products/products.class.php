<?php

class Products_class {
  function Products_class() {
  }

//Views
  function num_views($name_search, $category, $shops) {
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

    if ($shops == '') {
      $sr_search .= "";
    } else {
      $sr_search .= " and a.shop_id = '$shops'";
    }

    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_search .= "and a.userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }

    $sql = "SELECT a.news_id FROM coupons_products a, coupons_category b , coupons_shop c
		where a.news_id >= '1' and a.news_category = b.category_id and a.shop_id = c.id and a.language ='$language' $sr_search";

    $res = $db->db_query($sql);
    $result = $db->db_query($sql);
    $rows = $db->db_numrows($result);
    $db->db_freeresult($res);
    return $rows;
  }

  function num_views_code($code_search, $category, $shops) {
    global $db;
    $language = 1;
    $sr_search = '';
    if ($name_search == '') {
      $sr_search .= "";
    } else {
      $sr_search .= "and a.news_code like '%" . $code_search . "%'";
    }

    if ($category == '') {
      $sr_search .= "";
    } else {
      $arr_id = $this->read_record($category);
      $sr_search .= " and b.category_id IN ($arr_id) ";
    }

    if ($shops == '') {
      $sr_search .= "";
    } else {
      $sr_search .= " and a.shop_id = '$shops'";
    }

    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_search .= "and a.userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }

    $sql = "SELECT a.news_id FROM coupons_products a, coupons_category b
		where a.news_id >= '1' and a.news_category = b.category_id and a.language ='$language' $sr_search";

    $res = $db->db_query($sql);
    $result = $db->db_query($sql);
    $rows = $db->db_numrows($result);
    $db->db_freeresult($res);
    return $rows;
  }

  function views_table($page, $per_page, $order, $sc, $name_search, $category, $shops) {
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
      $sr_search .= " and b.category_id IN ($arr_id) ";
    }

    // if ($shops == ''){$sr_search.="";}
    // else{$sr_search.= " and a.shop_id = '$shops'";}

    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_search .= "and a.userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }

    $sql = "SELECT a.*,a.news_id as id_tem, b.category_name,b.category_url,b.news_url as news_urlcate
		FROM coupons_products a, coupons_category b
		where a.news_id >= '1' and a.news_category = b.category_id
		and a.language ='$language' $sr_search $orderby Limit $page,$per_page";

    $res = $db->db_query($sql);
    $rows = $db->db_fetchrowset($res);
    $db->db_freeresult($res);
    return $rows;
  }

  // Search theo mã sản phẩm
  function views_table_code($page, $per_page, $order, $sc, $code_search, $category, $shops)
  {
    global $db;
    //$language = LANG_AUGE_CMS;
    $language = 1;
    if ($order == "") {
      $orderby = "ORDER BY a.news_id desc ";
    } else {
      $orderby = "ORDER BY $order $sc";
    }

    $sr_search = '';
    if ($code_search == '') {
      $sr_search .= "";
    } else {
      $sr_search .= "and a.news_code like '%" . $code_search . "%'";
    }

    if ($category == '') {
      $sr_search .= "";
    } else {
      $arr_id = $this->read_record($category);
      $sr_search .= " and b.category_id IN ($arr_id) ";
    }

    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_search .= "and a.userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }

    $sql = "SELECT a.*,a.news_id as id_tem, b.category_name,b.category_url,b.news_url as news_urlcate
		FROM coupons_products a, coupons_category b
		where a.news_id >= '1' and a.news_category = b.category_id
		and a.language ='$language' $sr_search $orderby Limit $page,$per_page";
    //echo $sql;
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
  function insert_table($data) {
    global $db;
    $userid = $_SESSION[URL_ADMIN]["userid"];
    $created_date = time();
    $sql = "INSERT INTO coupons_products(
			    news_id,news_name,news_content,news_category,news_url,news_img,img_file,news_deadline,news_work_at,news_level,
				news_company,news_company_name,news_requirements,news_benefits,news_contact,job_type,news_code,status,language,userid,created_date)
				VALUES(NULL,'" . $data['news_name'] . "','" . $data['news_content'] . "','" . $data['news_category'] . "','" . $data['news_url'] . "','" . $data['news_img'] . "','" . $data['img_file'] . "','" . $data['news_deadline'] . "','" . $data['news_work_at'] . "','" . $data['news_level'] . "',	'" . $data['news_company'] . "','" . $data['news_company_name'] . "','" . $data['news_requirements'] . "',	'" . $data['news_benefits'] . "','" . $data['news_contact'] . "','" . $data['job_type'] . "','" . $data['news_code'] . "','" . $data['status'] . "','" . $data['language'] . "','$userid','$created_date')";
    //echo $sql;exit;
    $res = $db->db_query($sql);
    $db->db_freeresult($res);
    return false;
  }

  function insert_description($data, $id)
  {
    global $db;
    $sql = "INSERT INTO coupons_description(id,news_id,description,seo_title,seo_desc,seo_key,status,pos)
					VALUES(NULL,'$id','" . $data['description'] . "','" . $data['seo_title'] . "','" . $data['seo_desc'] . "','" . $data['seo_key'] . "','1','0')";
    $res = $db->db_query($sql);
    $db->db_freeresult($res);
    return false;
  }

  function insert_option($id)
  {
    global $db;
    $language = LANG_AUGE_CMS;
    if ($language == 0) {
      $option_name = 'Mặc định';
    } else {
      $option_name = 'Default';
    }

    $sql = "INSERT INTO coupons_option(option_name,news_id,status)
		VALUES('$option_name','$id','0')";
    $res = $db->db_query($sql);
    return 1;
  }

//Check user purchase	
  function check_user_products($id)
  {
    global $db;
    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_shop = "and userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }
    $sql = "Select news_id from coupons_products where news_id = '$id'  $sr_shop";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    return $nums;
  }

//Edit
  function get_id($id)
  {
    global $db;
    $sr_shop = '';
    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_shop = "and a.userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }
    $sql = "Select a.*, a.news_id as id_tem, b.* from coupons_products a, coupons_description b
		where a.news_id = $id and a.news_id = b.news_id and b.pos='0' $sr_shop";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrow($res);
    $db->db_freeresult($res);
    return $rows;
  }

  function edit_table($id, $data){
    global $db;
    $sr_shop = '';
    $sr = '';
    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_shop = "and userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
      $sr_userid = "userid ='" . $_SESSION[URL_ADMIN]["userid"] . "'";
    } else {
      $sr_userid = "userid ='" . $data['userid'] . "'";
    }

    $sql = "Update coupons_products set news_name ='" . $data['news_name'] . "',news_content ='" . $data['news_content'] . "', news_category ='" . $data['news_category'] . "',
		news_url ='" . $data['news_url'] . "',news_deadline ='" . $data['news_deadline'] . "',news_salary ='" . $data['news_salary'] . "',news_work_at ='" . $data['news_work_at'] . "',news_img ='" . $data['news_img'] . "',img_file ='" . $data['img_file'] . "',
		news_level ='" . $data['news_level'] . "',news_company ='" . $data['news_company'] . "',news_company_name ='" . $data['news_company_name'] . "',
		news_requirements ='" . $data['news_requirements'] . "',news_benefits ='" . $data['news_benefits'] . "',
		news_contact ='" . $data['news_contact'] . "',job_type ='" . $data['job_type'] . "',news_code ='" . $data['news_code'] . "',
		status ='" . $data['status'] . "', $sr_userid, home ='" . $data['home'] . "' where news_id='$id' $sr_shop";

    $res = $db->db_query($sql);
    $db->db_freeresult($res);
    return false;
  }

  function edit_description($id, $data)
  {
    global $db;
    $sr = '';
    $sql = "Update coupons_description set description ='" . $data['description'] . "',
		seo_title ='" . $data['seo_title'] . "',seo_desc ='" . $data['seo_desc'] . "',seo_key ='" . $data['seo_key'] . "'
		where news_id='$id' and pos='0'";
    $res = $db->db_query($sql);
    $db->db_freeresult($res);
    return false;
  }

  function update_order_table($id, $news_name, $pos, $price_import, $price_new, $price, $home)
  {
    global $db;
    $id = intval($id);
    $sql = "Update coupons_products set news_name ='$news_name', pos ='$pos',
		 		price_import ='$price_import', price_new ='$price_new', price ='$price', home ='$home' where news_id='$id'";
    $db->db_query($sql);
    return false;
  }

//delete
  function check_delete($id)
  {
    global $db;
    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_shop = "and userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }
    $sql = "Select news_id from coupons_products where news_id = '$id' and status ='1' $sr_shop";
    echo $sql;
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    return $nums;
  }

  function check_delete_orders($id)
  {
    global $db;
    $sql = "Select news_id from coupons_orders_detail where news_id = '$id'";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    return $nums;
  }

  function check_delete_import_pro($id)
  {
    global $db;
    $sql = "Select news_id from coupons_import where news_id = '$id'";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    return $nums;
  }

  function delete_table($id)
  {
    global $db;
    $id = intval($id);
    $sql = "Delete from coupons_products where news_id='$id' and status ='1' or status ='0'";
    $db->db_query($sql);
    return false;
  }

//Status
  function status_table($id, $status)
  {
    global $db;
    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_shop = "and userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }
    $sql = "Update coupons_products set status ='$status' where news_id = $id $sr_shop";
    $res = $db->db_query($sql);
    $db->db_freeresult($res);
    return 1;
  }

  function home_table($id, $home)
  {
    global $db;
    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_shop = "and userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }
    $sql = "Update coupons_products set home ='$home' where news_id = $id $sr_shop";
    $res = $db->db_query($sql);
    $db->db_freeresult($res);
    return 1;
  }

  function status_off_table($id)
  {
    global $db;
    $id = intval($id);
    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_shop = "and userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }
    $sql = "Update coupons_products set status ='0' where news_id='$id' $sr_shop";
    $db->db_query($sql);
    return false;
  }

  function status_on_table($id)
  {
    global $db;
    $id = intval($id);
    if ($_SESSION[URL_ADMIN]["user_role"] == 3) {
      $sr_shop = "and userid = " . $_SESSION[URL_ADMIN]["userid"] . "";
    }
    $sql = "Update coupons_products set status ='1' where news_id='$id' $sr_shop";
    $db->db_query($sql);
    return false;
  }

//shop
  function show_list_shop()
  {
    global $db;
    $language = LANG_AUGE_CMS;
    $sql = "SELECT cs.* FROM coupons_shop cs where cs.language ='$language' ORDER BY cs.id asc ";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrowset($res);
    return $rows;
  }

//thanh vien
  function show_list_user()
  {
    global $db;
    $sql = "SELECT cu.* FROM coupons_users cu where user_role <= '3' ORDER BY cu.userid desc ";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrowset($res);
    return $rows;
  }

//Tinh thanh
  function show_all_city($countryid)
  {
    global $db;
    $sql = "SELECT cityname,cityid FROM coupons_cities where countryid ='$countryid' ORDER BY pos desc, cityid desc ";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrowset($res);
    return $rows;
  }

//Quan huyen
  function show_list_district($cityid)
  {
    global $db;
    $sql = "SELECT district_id,district_name FROM coupons_district where cityid ='$cityid' ORDER BY pos desc, district_id desc ";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrowset($res);
    return $rows;
  }


//////////////////////////////////////////////////////////////////	
  function get_news_category($id)
  {
    global $db;
    $sql = "SELECT a.news_category, b.parent_id FROM coupons_products a, coupons_category b Where a.news_id = '$id' and a.news_category = b.category_id";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrow($res);
    return $rows;
  }

//Hinh chi tiet
  function show_all_images($id)
  {
    global $db;
    $sql = "SELECT t2.*, t1.news_img, t1.news_name FROM coupons_products t1, coupons_img t2
		where t1.news_id = t2.product_id and t2.product_id = '$id' ORDER BY t2.product_id desc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }

  }

  function add_images($product_id, $data)
  {
    global $db;
    $sql = "INSERT INTO coupons_img(product_id,image,img_file,image_name)
	VALUES('$product_id','" . $data['image'] . "','" . $data['img_file'] . "','" . $data['image_name'] . "')";
    $res = $db->db_query($sql);
    return 1;
  }

  function show_images($id)
  {
    global $db;
    $sql = "SELECT * FROM coupons_img Where id = '$id'";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrow($res);
    return $rows;
  }

  function del_images($id)
  {
    global $db;
    $id = intval($id);
    $sql = "Delete from coupons_img where id='$id'";
    $db->db_query($sql);
    return 1;
  }

//Lua chom mua hang
  function show_all_option($id)
  {
    global $db;
    $sql = "SELECT * FROM coupons_option
		where news_id = '$id' ORDER BY news_id desc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }
  }

  function add_option($option_name, $news_id)
  {
    global $db;
    $create_date = time();
    $sql = "INSERT INTO coupons_option(option_name,news_id,status)
		VALUES('$option_name','$news_id','1')";
    $res = $db->db_query($sql);
    return 1;
  }

  function check_delete_import($id)
  {
    global $db;
    $sql = "Select option_id from coupons_import where option_id = '$id'";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    return $nums;
  }

  function check_delete_orders_detail($id)
  {
    global $db;
    $sql = "Select option_id from coupons_orders_detail where option_id = '$id'";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    return $nums;
  }

  function delete_option($id)
  {
    global $db;
    $sql = "Delete from coupons_option where option_id='$id' and status = '1'";
    $db->db_query($sql);
    return 1;
  }

  function update_option($id, $option_name, $price_new, $status)
  {
    global $db;
    $id = intval($id);
    $sql = "Update coupons_option set option_name ='$option_name', price_new ='$price_new', status ='$status' where option_id='$id'";
    $db->db_query($sql);
    return false;
  }

//Thuoc tinh san pham
  function num_filter_property($category_id)
  {
    global $db, $function;
    $sql = "SELECT * FROM property where category_id  = '$category_id' ";
    $rs = $db->db_query($sql);
    return $db->db_numrows($rs);
  }

  function show_filter_property($category_id)
  {
    global $db;
    $sql = "SELECT * FROM property where category_id  = '$category_id'  ORDER BY pos asc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }
  }

  function add_property($news_id, $name, $content, $pos, $id_property)
  {
    global $db;
    $sql_at = "SELECT * from coupons_property where news_id = '$news_id' and id_property='$id_property'";
    $res_at = $db->db_query($sql_at);
    $rows = $db->db_fetchrow($res_at);
    $id = $rows['id'];
    if ($db->db_numrows($res_at) <= 0) {
      if ($content != '') {
        $db->db_query("INSERT INTO coupons_property(news_id,name,content,pos,id_property) VALUES('$news_id','$name','$content',$pos,$id_property)");
        return 1;
      }
    } else {
      if ($content != '') {
        $db->db_query("Update coupons_property set content ='$content' where news_id = '$news_id' and id ='$id' ");
        return 1;
      }
    }
  }

  function show_coupons_property($news_id)
  {
    global $db;
    $sql = "SELECT * FROM coupons_property where news_id  = '$news_id'  ORDER BY pos asc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }
  }

  function delete_coupons_property($news_id)
  {
    global $db;
    $sql = "Delete from coupons_property where id='$news_id'";
    $db->db_query($sql);
    return 1;
  }


////////////////////bo loc san pham
  function show_filter_products($products_id)
  {
    global $db;
    $sql = "SELECT * FROM filter_products Where products_id = '$products_id'";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrow($res);
    return $rows;
  }

  function num_filter_products($products_id)
  {
    global $db, $function;
    $sql = "SELECT * FROM filter_products Where products_id = '$products_id'";
    $rs = $db->db_query($sql);
    return $db->db_numrows($rs);
  }

  function add_filter_products($products_id, $category_id, $url_one, $url_two, $url_three)
  {
    global $db;
    $create_date = time();
    $sql = "INSERT INTO filter_products(products_id,category_id,url_one,url_two,url_three)
		VALUES('$products_id','$category_id','$url_one','$url_two','$url_three')";
    $res = $db->db_query($sql);
    return 1;
  }

  function edit_filter_products($products_id, $category_id, $url_one, $url_two, $url_three)
  {
    global $db;
    $created_date = time();
    $sql = "Update filter_products set category_id ='$category_id', url_one ='$url_one', url_two ='$url_two', url_three ='$url_three'
		where products_id = $products_id";
    $res = $db->db_query($sql);
    return 1;
  }

////////// bo loc 1
  function num_filter_one($category_id)
  {
    global $db, $function;
    $sql = "SELECT * FROM filter_one where category_id  = '$category_id' ";
    $rs = $db->db_query($sql);
    return $db->db_numrows($rs);
  }

  function show_filter_one($category_id)
  {
    global $db;
    $sql = "SELECT * FROM filter_one where category_id  = '$category_id'  ORDER BY pos asc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }
  }

////////// bo loc 2
  function num_filter_two($category_id)
  {
    global $db, $function;
    $sql = "SELECT * FROM filter_two where category_id  = '$category_id' ";
    $rs = $db->db_query($sql);
    return $db->db_numrows($rs);
  }

  function show_filter_two($category_id)
  {
    global $db;
    $sql = "SELECT * FROM filter_two where category_id  = '$category_id'  ORDER BY pos asc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }
  }

////////// bo loc 3
  function num_filter_three($category_id)
  {
    global $db, $function;
    $sql = "SELECT * FROM filter_three where category_id  = '$category_id' ";
    $rs = $db->db_query($sql);
    return $db->db_numrows($rs);
  }

  function show_filter_three($category_id)
  {
    global $db;
    $sql = "SELECT * FROM filter_three where category_id  = '$category_id'  ORDER BY pos asc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }
  }

////////// bo loc 4
  function num_filter_four($category_id)
  {
    global $db, $function;
    $sql = "SELECT * FROM filter_four where category_id  = '$category_id' ";
    $rs = $db->db_query($sql);
    return $db->db_numrows($rs);
  }

  function show_filter_four($category_id)
  {
    global $db;
    $sql = "SELECT * FROM filter_four where category_id  = '$category_id'  ORDER BY pos asc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }
  }


// them description
  function show_all_description($id)
  {
    global $db;
    $sql = "SELECT t2.*, t1.news_name FROM coupons_products t1, coupons_description t2
	where t1.news_id = t2.news_id and t2.news_id = '$id' and t2.pos > '0' ORDER BY t2.news_id desc ";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      return $rows;
    }
  }

  function add_description($id, $news_id, $name, $description, $pos)
  {
    global $db;
    if ($id == 0) {
      $sql = "INSERT INTO coupons_description(news_id,name,description,pos) VALUES('$news_id','$name','$description','$pos')";
    } else {
      $sql = "Update coupons_description set news_id  = '$news_id', name  = '$name', description = '$description', pos = '$pos' where id= $id";
    }
    $res = $db->db_query($sql);
    return 1;
  }

  function del_description($id)
  {
    global $db;
    $id = intval($id);
    $sql = "Delete from coupons_description where id='$id'";
    $db->db_query($sql);
    return 1;
  }

  function get_id_description($id)
  {
    global $db;
    $sql = "SELECT * FROM coupons_description where id  = '$id'";
    $res = $db->db_query($sql);
    $rows = $db->db_fetchrow($res);
    return $rows;
  }

// Delete All
  function show_table_images_id($id)
  {
    global $db;
    $upload_file = IMG_UPLOAD;
    $sql = "SELECT * FROM coupons_img Where product_id = '$id'";
    $res = $db->db_query($sql);
    $nums = $db->db_numrows($res);
    if ($nums) {
      $rows = $db->db_fetchrowset($res);
      for ($i = 0; $i < count($rows); $i++) {
        @unlink($upload_file . 'products/' . $rows[$i]['img_file'] . '/' . $rows[$i]['image']);
      }
      return $rows;
    }

  }

  function del_product_all($id)
  {
    global $db;
    $id = intval($id);
    $db->db_query("Delete from coupons_img where product_id='$id'");
    $db->db_query("Delete from coupons_description where news_id='$id'");
    $db->db_query("Delete from coupons_property where news_id='$id'");
    $db->db_query("Delete from filter_products where products_id='$id'");
    $db->db_query("Delete from coupons_option where news_id='$id'");
    $db->db_query("Delete from coupons_comment where news_id='$id'");
    return 1;
  }

// Cap nhat lai gia theo phan tram cua muc chinh
  function update_price_percent()
  {
    global $db;
    $language = LANG_AUGE_CMS;
    $ngay_update = date("jn");

    $sql = "UPDATE coupons_products, coupons_category ca SET price_new = round((price_import*(1+total_percent/100)+499)/10000,1)*10000
				where news_category = category_id and event ='0' and total_percent > '0' and price_import > '0' and ca.language = '0' ";
    $res = $db->db_query($sql);
    $db->db_freeresult($res);

    $sql_en = "UPDATE coupons_products, coupons_category ca SET price_new = round((price_import*(1+total_percent/100)+0.499)/10,1)*10
				where news_category = category_id and event ='0' and total_percent > '0' and price_import > '0' and ca.language = '1'";
    $res_en = $db->db_query($sql_en);
    $db->db_freeresult($res_en);

    return 1;
  }

// Up cong them 1%
  function update_tang()
  {
    global $db;
    $language = LANG_AUGE_CMS;
    $sql = "UPDATE coupons_category SET total_percent = total_percent+1 where status = '1'  and total_percent < '50' and language ='$language'";
    $res = $db->db_query($sql);
    $db->db_freeresult($res);
    return 1;
  }

// Up giam 1%
  function update_giam()
  {
    global $db;
    $language = LANG_AUGE_CMS;
    $sql = "UPDATE coupons_category SET total_percent = total_percent-1 where status = '1' and total_percent > '10' and language ='$language'";
    $res = $db->db_query($sql);
    $db->db_freeresult($res);
    return 1;
  }

// cap nhat ngay		
  function edit_created_date($news_id)
  {
    global $db;
    $created_date = time();
    $sql = "Update coupons_products set created_date ='$created_date' where news_id = $news_id";
    $res = $db->db_query($sql);
    return 1;
  }

}

?>
