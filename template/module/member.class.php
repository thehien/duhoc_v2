<?php

////////////////////category////////////////////
class Member
{
    function Member()
    {
        global $db;
    }

    //////////////////////////////////////////////////// User cv ///////////////////////////////////
    // kiem tra dang nhap
    function check_name_cv($name)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_cv WHERE name = '$name' and status = 1";
        //echo $sql;exit;
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }

    function check_order_translate_active($id)
    {
        global $db;
        $sql = "SELECT * FROM coupons_orders WHERE coupon_code = '$id' and coupon_status = 2 and order_status=2 and accept_status=0";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }

    function get_order_translate_active($id)
    {
        global $db;
        $sql = "SELECT total_prices as price_percent FROM coupons_orders WHERE coupon_code = '$id' and coupon_status = 2";
        $rs = $db->db_query($sql);
        $row = $db->db_fetchrow($rs);
        $row["price_percent"] = number_format($row["price_percent"] * 55 / 100, 2, ',', '.');
        return $row;
    }

    function accept_order_translate_active($id, $isActiveOrder)
    {
        global $db;
        $sql = "UPDATE coupons_orders set order_status = '$isActiveOrder', accept_status=1 WHERE coupon_code = '$id' and coupon_status = 2";
        if ($db->db_query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function get_order_language_by_id($aUserId)
    {
        global $db, $function;
        $sql = "SELECT t1.from_language, t1.to_language , t1.translate_id, (select t2.name from list_languages t2 where t1.from_language = t2.id ) as from_language_name,(select t2.name from list_languages t2 where t1.to_language = t2.id ) as to_language_name FROM coupons_language_order t1 where t1.translate_id=$aUserId order by t1.id desc";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["to_language_name"] = $rows[$i]["to_language_name"];
            $rows[$i]["from_language_name"] = $rows[$i]["from_language_name"];

            $rows[$i]["from_flag_language"] = $this->show_info_language($rows[$i]["from_language"]);
            $rows[$i]["to_flag_language"] = $this->show_info_language($rows[$i]["to_language"]);
        }
        $db->db_freeresult($res);
        return $rows;
    }

    // them thanh vien moi
    function check_email_cv_register($email)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_cv WHERE email = '$email'";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        return $num;
    }

    function get_all_cv()
    {
        global $db, $function;
        $sql = "SELECT *,(select t3.name from list_languages t3 where t2.nativeLanguage = t3.id) as native_language_name, 
        (select t4.name from list_country t4 where t4.id = t1.country) as country_name FROM coupons_users_cv t1";
        $sql .= " inner join coupons_users_cv_info t2 on t2.user_id = t1.userid";
        $sql .= " WHERE t1.status = 1";

        $rs = $db->db_query($sql);
        $rows = $db->db_fetchrowset($rs);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["full_name"] = $function->truncate($rows[$i]["name"], 1000);
            $rows[$i]["name"] = $function->truncate($rows[$i]["name"], 50);
            $rows[$i]["subject_field"] = $this->show_subject_title($rows[$i]["special_category"]);
            $rows[$i]["about_translator"] = $function->truncate($rows[$i]["about"], 300);
        }
        return $rows;
    }


    function get_all_translator_online()
    {
        global $db, $function;
        $sql = "SELECT t1.name, t1.avatar,(select t3.name from list_languages t3 where t2.nativeLanguage = t3.id) as native_language_name, (select t4.name from list_country t4 where t4.id = t1.country) as country_name, t1.userid as translate_id";
        $sql .= " FROM coupons_users_cv t1";
        $sql .= " inner join coupons_users_cv_info t2 on t2.user_id = t1.userid";
        $sql .= " WHERE t1.status = 1";

        $rs = $db->db_query($sql);
        $rows = $db->db_fetchrowset($rs);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["full_name"] = $function->truncate($rows[$i]["name"], 1000);
            $rows[$i]["name"] = $function->truncate($rows[$i]["name"], 15);
        }
        return $rows;
    }

    function get_all_partner()
    {
        global $db, $function;
        $sql = "SELECT news_id, news_name, news_img";
        $sql .= " FROM coupons_partner";
        $sql .= " WHERE status = 1";

        $rs = $db->db_query($sql);
        $rows = $db->db_fetchrowset($rs);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["full_name"] = $function->truncate($rows[$i]["news_name"], 1000);
            $rows[$i]["name"] = $function->truncate($rows[$i]["news_name"], 15);
        }
        return $rows;
    }



    function get_all_customer()
    {
        global $db, $function;
        $sql = "SELECT * FROM coupons_users t1";
        $sql .= " WHERE t1.status = 1";

        $rs = $db->db_query($sql);
        $rows = $db->db_fetchrowset($rs);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["full_name"] = $function->truncate($rows[$i]["name"], 1000);
            $rows[$i]["name"] = $function->truncate($rows[$i]["name"], 15);
        }
        return $rows;
    }

    function show_subject_title($subjectArray)
    {
        global $db;

        $sql = "SELECT category_name FROM coupons_special_category where id in ($subjectArray) ORDER BY id desc ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }

    function get_list_order_by_user($userId)
    {
        global $db, $function;
        $sql = "SELECT *,(select t3.name from list_languages t3 where t2.nativeLanguage = t3.id) as native_language_name, (select t4.name from list_country t4 where t4.id = t1.country) as country_name FROM coupons_users_cv t1";
        $sql .= " inner join coupons_users_cv_info t2 on t2.user_id = t1.userid";
        $sql .= " WHERE t1.status = 1";

        $rs = $db->db_query($sql);
        $rows = $db->db_fetchrowset($rs);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["full_name"] = $function->truncate($rows[$i]["name"], 1000);
            $rows[$i]["name"] = $function->truncate($rows[$i]["name"], 15);
        }
        return $rows;
    }


    function show_list_software($data)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_cv_software WHERE cv_id = '$data'";
        //echo $sql;
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num >= 1) {
            $sql1 = "SELECT * FROM coupons_users_cv_software t1";
            $sql1 .= " inner join list_software t2";
            $sql1 .= " on t1.software_id = t2.id";
            $sql1 .= " WHERE t1.cv_id = $data";
            $rs1 = $db->db_query($sql1);
            $rows1 = $db->db_fetchrowset($rs1);
            return $rows1;
        }
    }

    function show_list_service($data)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_cv_service t1";
        $sql .= " inner join list_service t2";
        $sql .= " on t1.service_id = t2.id";
        $sql .= " WHERE t1.cv_id = $data";
        $rs = $db->db_query($sql);
        $rows = $db->db_fetchrowset($rs);
        return $rows;
    }

    function insert_cv($data)
    {
        global $db;
        $name = $data['first_name'] . " " . $data['last_name'];
        $created_date = date('y/m/d h:i:s', time());
        $sql = "INSERT INTO coupons_users_cv(firstname,lastname,mobile_code,mobile,name,email,password, country, from_translate,to_translate,special_category, address, created_date) VALUES('" . $data['first_name'] . "','" . $data['last_name'] . "','" . $data['mobile_code'] . "','" . $data['mobile'] . "','" . $name . "','" . $data['email'] . "','" . $data['password'] . "','" . $data['country'] . "','" . $data['from_translate'] . "','" . $data['to_translate'] . "','" . $data['special_category'] . "','" . $data['address'] . "','" . $created_date . "');";
        //echo $sql;exit;
        $res = $db->db_query($sql);
        $user_id = $db->db_inserted_id();

        if (!empty($user_id)) {
            $subsql = "INSERT INTO coupons_users_cv_info (user_id) VALUES($user_id);";
            $db->db_query($subsql);

            $subsql1 = "INSERT INTO coupons_users_cv_language (cv_id,from_language,to_language ) VALUES($user_id,'" . $data['from_translate'] . "','" . $data['to_translate'] . "');";
            $db->db_query($subsql1);

            $subsql2 = "INSERT INTO coupons_users_cv_specialize (cv_id,specialize) VALUES($user_id,'" . $data['special_category'] . "');";
            $db->db_query($subsql2);
        }

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function insert_translate_file($data)
    {
        global $db;
        $send_date = date("Y-m-d H:i:s");
        $language = LANG_AUGE;
        $sql = "INSERT INTO coupons_translate_files (user_id, translater_id, order_id, file_name,send_date, language) VALUES('" . $data['user_id'] . "','" . $data['translater_id'] . "','" . $data['order_id'] . "','" . $data['file_name'] . "','$send_date', $language);";

        $res = $db->db_query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }


    // kiem tra dang nhap
    function check_user_cv($email)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_cv WHERE email = '$email' and status = 1";

        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }


    function check_login_cv($email, $password)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_cv WHERE password = '$password' and  email = '$email'";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);
            $_SESSION[URL_HOME]["userid_cv_u"] = $row["userid"];
            $_SESSION[URL_HOME]["username_u"] = $row["username"];
            $_SESSION[URL_HOME]["mobile_u"] = $row["mobile"];
            $_SESSION[URL_HOME]["firstname_u"] = $row["firstname"];
            $_SESSION[URL_HOME]["email_u"] = $row["email"];
            $_SESSION[URL_HOME]["status_u"] = $row["status"];
            $_SESSION[URL_HOME]["address_u"] = $row["address"];
            $_SESSION[URL_HOME]["city_u"] = $row["city"];
            $_SESSION[URL_HOME]["district_u"] = $row["district"];
            $_SESSION[URL_HOME]["is_login_cv"] = 1;

            return $row;
        } else {
            return false;
        }
    }

    //////////////////////////////////////////////////// User ///////////////////////////////////////

    // kiem tra dang nhap
    function check_user($email)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users WHERE email = '$email' and status = 1";

        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }

    // kiem tra dang nhap
    function check_name($name)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users WHERE name = '$name' and status = 1";
        //echo $sql;exit;
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }

    // kiem tra dang nhap
    function check_google_login($user)
    {
        global $db;
        $sql = "SELECT count(google_id) as usercount FROM coupons_users";
        $sql .= " WHERE google_id = $user->id";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }

    function get_google_login($user)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users t1";
        $sql .= " left join coupons_users_info t2";
        $sql .= " on t1.userid = t2.user_id";
        $sql .= " WHERE t1.google_id = $user";
        //echo $sql;
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }

    // kiem tra dang nhap
    function check_facebook_login($facebookId)
    {
        global $db;
        $sql = "SELECT count(facebook_id) as usercount FROM coupons_users";
        $sql .= " WHERE facebook_id = '$facebookId'";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }

    function get_facebook_login($id)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users t1";
        $sql .= " left join coupons_users_info t2";
        $sql .= " on t1.userid = t2.user_id";
        $sql .= " WHERE t1.facebook_id = '$id'";
        //echo $sql;
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }

    // Insert google login user
    function insert_google_login($user)
    {
        global $db;
        $sql = "INSERT INTO coupons_users(google_id, google_name, google_email, google_link, google_picture_link) VALUES( $user->id,'$user->name', '$user->email', '$user->link', '$user->picture')";
        //echo $sql;
        $res = $db->db_query($sql);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function insert_google_user_info($userId)
    {
        global $db;
        $sql = "INSERT INTO coupons_users_info(user_id) VALUES( $userId)";
        $res = $db->db_query($sql);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    // Insert facebook login user
    function insert_facebook_login($facebookId, $facebookName, $facebookEmail)
    {
        global $db;
        $sql = "INSERT INTO coupons_users(facebook_id, facebook_name, facebook_email) VALUES('$facebookId','$facebookName', '$facebookEmail')";
        $res = $db->db_query($sql);

        $user_id = $db->db_inserted_id();

        if (!empty($user_id)) {
            $subsql = "INSERT INTO coupons_users_info (user_id) VALUES($user_id);";
            $db->db_query($subsql);
        }

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function getInfoUser($userId)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_info";
        $sql .= " WHERE user_id = $userId";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);

            return $row;
        } else {
            return false;
        }
    }


    function show_from_to_language($userId)
    {
        global $db;
        $sql = "SELECT *, (select name from list_languages t2 where t1.from_language=t2.id) as from_language_name,  (select name from list_languages t2 where t1.to_language=t2.id) as to_language_name FROM coupons_users_cv_language t1";
        $sql .= " WHERE t1.cv_id = $userId";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        $newArray = [];
        if ($num > 0) {
            $rows = $db->db_fetchrowset($rs);

            return $rows;
        } else {
            return false;
        }
    }

    function insertBackgroundAccount($data, $userId)
    {
        global $db;
        $sql = "INSERT INTO coupons_users_info(user_id,background) 
    VALUES($userId ,'$data')";
        $res = $db->db_query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function insertGalleryAccount($data, $userId)
    {
        global $db;
        $sql = "INSERT INTO coupons_users_gallery(user_id,images) 
    VALUES( '$userId','$data')";
        $res = $db->db_query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function getGalleryUser($userId)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_gallery";
        $sql .= " WHERE user_id = $userId";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        $newArray = [];
        if ($num > 0) {
            $rows = $db->db_fetchrowset($rs);

            return $rows;
        } else {
            return false;
        }
    }

    function updateBackgroundAccount($data, $userId)
    {
        global $db;
        $sql = "UPDATE coupons_users_info set background = '$data' where user_id = $userId";
        $res = $db->db_query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function check_login($email, $password)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users WHERE password = '$password' and  email = '$email'";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        if ($num == 1) {
            $row = $db->db_fetchrow($rs);
            $_SESSION[URL_HOME]["userid_u"] = $row["userid"];
            $_SESSION[URL_HOME]["username_u"] = $row["username"];
            $_SESSION[URL_HOME]["user_role_u"] = $row["user_role"];
            $_SESSION[URL_HOME]["mobile_u"] = $row["mobile"];
            $_SESSION[URL_HOME]["firstname_u"] = $row["firstname"];
            $_SESSION[URL_HOME]["email_u"] = $row["email"];
            $_SESSION[URL_HOME]["status_u"] = $row["status"];
            $_SESSION[URL_HOME]["address_u"] = $row["address"];
            $_SESSION[URL_HOME]["city_u"] = $row["city"];
            $_SESSION[URL_HOME]["district_u"] = $row["district"];
            $_SESSION[URL_HOME]["is_login"] = 1;

            return $row;
        } else {
            return false;
        }
    }

    function check_login_new()
    {
        global $db, $function;
        $userid = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);
        $sql = "SELECT * FROM coupons_users WHERE userid = '$userid'";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);
        if ($num == 1) {
            $row = $db->db_fetchrow($rs);
            $_SESSION[URL_HOME]["userid_u"] = $row["userid"];
            $_SESSION[URL_HOME]["username_u"] = $row["username"];
            $_SESSION[URL_HOME]["user_role_u"] = $row["user_role"];
            $_SESSION[URL_HOME]["mobile_u"] = $row["mobile"];
            $_SESSION[URL_HOME]["firstname_u"] = $row["firstname"];
            $_SESSION[URL_HOME]["email_u"] = $row["email"];
            $_SESSION[URL_HOME]["status_u"] = $row["status"];
            $_SESSION[URL_HOME]["address_u"] = $row["address"];
            $_SESSION[URL_HOME]["city_u"] = $row["city"];
            $_SESSION[URL_HOME]["district_u"] = $row["district"];

            return $row;
        } else {
            return false;
        }
    }

    // hien thi thong tin user
    function show_member_id($userid)
    {
        global $db;
        $sql = "SELECT *, (select t3.name from list_country t3 where t3.id = t1.country) as country_name FROM";
        $sql .= " coupons_users t1 ";
        $sql .= " left join coupons_users_info t2 on t1.userid = t2.user_id";
        $sql .= " WHERE t1.userid = '$userid' ";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    // hien thi thong tin chuyen vien
    function show_expert_user_id($userid)
    {
        global $db;
        $sql = "SELECT *,(select t4.name from list_languages t4 where t2.nativeLanguage = t4.id ) as native_language_name, (select t5.name from list_country t5 where t5.id = t1.country) as country_name, (select t6.name from list_experience t6 where t6.id = t2.experience) as experience_name FROM";
        $sql .= " coupons_users_cv t1 ";
        $sql .= " left join coupons_users_cv_info t2 on t1.userid = t2.user_id";
        $sql .= " WHERE t1.userid = '$userid' ";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }

    function show_language_name($id)
    {
        global $db;
        $sql = "SELECT name FROM";
        $sql .= " list_languages t1 ";
        $sql .= " WHERE t1.id = '$id' ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }

    function show_special_category_name($id)
    {
        global $db;
        $sql = "SELECT id,category_name FROM";
        $sql .= " coupons_special_category t1 ";
        $sql .= " WHERE t1.id = '$id' ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        return $rows;
    }


    // them thanh vien moi
    function check_email_register($email)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users WHERE email = '$email'";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        return $num;
    }

    // them thanh vien moi
    function check_email_register_cv($email)
    {
        global $db;
        $sql = "SELECT * FROM coupons_users_cv WHERE email = '$email'";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        return $num;
    }

    // kiem tra code order is valid
    function check_order_code_valid($codeId)
    {
        global $db;
        $sql = "SELECT * FROM coupons_orders WHERE coupon_code = '$codeId'";
        $rs = $db->db_query($sql);
        $num = $db->db_numrows($rs);

        return $num;
    }

    function insert_admin($firstname, $lastname, $mobile_code, $mobile, $password, $email, $country)
    {
        global $db;
        $created_date = date('y/m/d h:i:s', time());
        $name = $firstname . " " . $lastname;
        $sql = "INSERT INTO coupons_users(firstname,lastname,name,country,mobile_code,mobile,password,email,created_date) VALUES('$firstname','$lastname','$name','$country','$mobile_code','$mobile','$password','$email','$created_date');";
        //echo $sql;exit;
        $res = $db->db_query($sql);

        $user_id = $db->db_inserted_id();

        if (!empty($user_id)) {
            $subsql = "INSERT INTO coupons_users_info (user_id) VALUES($user_id);";
            $db->db_query($subsql);
        }

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    // end them thanh vien moi
    //sua thong tin ca nhan
    function edit_q_member($firstname, $password, $email, $mobile, $avata, $yahoochat, $facebook, $address)
    {
        global $db, $function;
        $userid = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);
        if ($password == "") {
            $sql = "update coupons_users set firstname='$firstname',email= '$email',mobile='$mobile', avata='$avata', yahoochat='$yahoochat', facebook='$facebook',address = '$address' where userid='$userid'";
        } else {
            $password = md5($password);
            $sql = "update coupons_users set firstname='$firstname',password ='$password',email = '$email',mobile ='$mobile', avata='$avata', yahoochat='$yahoochat', facebook='$facebook',address = '$address' where userid= '$userid'";
        }

        $res = $db->db_query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    //sua thong giao hang
    function edit_member_purchase($address, $city, $district)
    {
        global $db, $function;
        $userid = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);
        $sql = "update coupons_users set address='$address',city= '$city',district='$district' where userid='$userid'";
        $res = $db->db_query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    ////reset pass
    function show_users_email($email)
    {
        global $db;
        $sql = "select * from coupons_users where email = '$email'";
        $rs = $db->db_query($sql);
        $row = $db->db_fetchrow($rs);

        return $row;
    }

    function show_users_email_cv($email)
    {
        global $db;
        $sql = "select * from coupons_users_cv where email = '$email'";
        $rs = $db->db_query($sql);
        $row = $db->db_fetchrow($rs);

        return $row;
    }

    function check_userid_exist($email)
    {
        global $db;
        $sql_chk = "SELECT * FROM coupons_users WHERE email='$email';";
        $rs = $db->db_query($sql_chk);
        $num = $db->db_numrows($rs);

        return $num;
    }

    function check_userid_exist_cv($email)
    {
        global $db;
        $sql_chk = "SELECT * FROM coupons_users_cv WHERE email='$email';";
        $rs = $db->db_query($sql_chk);
        $num = $db->db_numrows($rs);

        return $num;
    }


    function reset_password($password, $email)
    {
        global $db;
        $sql = "UPDATE coupons_users set password = '$password' WHERE email = '$email';";
        //echo $sql;
        if ($db->db_query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function reset_password_cv($password, $email)
    {
        global $db;
        $sql = "UPDATE coupons_users_cv set password = '$password' WHERE email = '$email';";
        //echo $sql;
        if ($db->db_query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function update_payment_order($codeId)
    {
        global $db;
        $sql = "UPDATE coupons_orders set order_status = 1 WHERE coupon_code = '$codeId';";
        if ($db->db_query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function cancel_payment_order($codeId)
    {
        global $db;
        $sql = "UPDATE coupons_orders set order_status = 4 WHERE coupon_code = '$codeId';";
        if ($db->db_query($sql)) {
            return true;
        } else {
            return false;
        }
    }


    function update_final_order($codeId)
    {
        global $db;
        $sql = "UPDATE coupons_orders set order_status = 3 WHERE coupon_code = '$codeId';";
        if ($db->db_query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function active_account($confirmAccount, $confirmActive)
    {
        global $db;
        $sql = "UPDATE coupons_users set status = '$confirmActive' WHERE email = '$confirmAccount';";
        //echo $sql;
        if ($db->db_query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function active_account_cv($confirmAccount, $confirmActive)
    {
        global $db;
        $sql = "UPDATE coupons_users_cv set status = '$confirmActive' WHERE email = '$confirmAccount';";
        //echo $sql;
        if ($db->db_query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    // Quan ly don hang cua thanh vien XXXUPXXX25-07
    function show_coupon_purchaseid_member($page, $per_page, $coupon_status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);
        if ($coupon_status != "0") {
            $sr .= " and cp.coupon_status = $coupon_status";
        } else {
            $sr .= "";
        }

        $sql = "SELECT cp.*, cs.*, cty.cityname, cw.district_name 
		FROM coupons_purchase cp, coupons_products pro, coupons_cities cty, coupons_district cw, coupons_status cs 
		where cty.cityid =cp.city and cw.district_id =cp.district and pro.news_id = cp.coupon_id and cp.coupon_userid = '$userid_u' 
		and cs.coupon_status=cp.coupon_status and cs.language='$language'
		and cp.language ='$language' ORDER BY cp.coupon_purchaseid desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {

            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 80);
            $rows[$i]["gia_ban"] = number_format($rows[$i]["money"]);
            $rows[$i]["tong_tien"] = number_format($rows[$i]["money"] * $rows[$i]["quality"]);

        }

        return $rows;
    }

    // function delete_payment_history ($id) {
    //   global $db;
    //   $sql = "Delete From coupons_purchase where coupon_purchaseid = '$id'";
    //   $res = $db->db_query($sql);

    //   return 1;
    // }

    function remove_purchaseid($id)
    {
        global $db;
        $sql = "Delete From coupons_purchase where coupon_purchaseid = '$id'";
        $res = $db->db_query($sql);

        return 1;
    }

    function status_purchaseid($id, $status)
    {
        global $db;
        $sql = "Update coupons_purchase set coupon_status ='$status' where coupon_purchaseid = $id";
        $res = $db->db_query($sql);

        return 1;
    }

    // Kiem tra don hang da mua
    function show_coupons_orders_status($id)
    {
        global $db;
        $sql = "Select cp.*, cp.coupon_purchaseid as id_tem, ct.cityname, ct.cityid, cw.district_name from coupons_orders cp, coupons_district cw, coupons_cities ct  
		where cp.coupon_code = '$id' and cp.city = ct.cityid and cw.district_id = cp.district";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        $rows["total"] = number_format(round($rows["money"] + $rows["shipping"] + $rows["cod"] - $rows["voucher_price"],
            -3));
        $rows["voucher_price"] = number_format($rows["voucher_price"]);
        $rows["money"] = number_format($rows["money"]);
        $rows["shipping"] = number_format($rows["shipping"]);
        $rows["cod"] = number_format($rows["cod"]);
        $db->db_freeresult($res);

        return $rows;
    }

    function views_orders_detail($coupon_code)
    {
        global $db, $function;
        $sql = "SELECT t1.*, FROM_UNIXTIME(t2.coupon_date,'%d/%m/%Y') as ngay_mua,(select t3.name from list_languages t3 where t3.id =t1.translate_from) as from_translate_name
     FROM coupons_orders_detail t1 inner join coupons_orders t2 where t1.coupon_code=t2.coupon_code and t1.coupon_code  = '$coupon_code'";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        return $rows;
    }


    function show_coupons_status()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT coupon_status, status_name, status_color FROM coupons_status where language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function show_numer_accept_active($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_orders t1 join coupons_orders_detail t2 where t1.coupon_code = t2.coupon_code and t1.translater_id = " . $userid . " and t1.order_status=2 and t1.language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function show_all_number_order($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_orders t1 join coupons_orders_detail t2 where t1.coupon_code = t2.coupon_code and t1.coupon_userid = $userid and t1.language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }


    function show_numer_accept_finalize($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_orders t1 join coupons_orders_detail t2 where t1.coupon_code = t2.coupon_code and t1.translater_id = " . $userid . " and t1.order_status=3 and t1.language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function show_numer_order_complete($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_orders t1 join coupons_orders_detail t2 where t1.coupon_code = t2.coupon_code and  t1.coupon_status = 2 and t1.translater_id > 0 and t1.coupon_userid = $userid and t1.order_status=1 and t1.language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function show_numer_order_active($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_orders t1 join coupons_orders_detail t2 where t1.coupon_code = t2.coupon_code and  t1.coupon_status = 2 and t1.coupon_userid = $userid and t1.order_status=2 and t1.language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function show_numer_order_cancel($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_orders t1 join coupons_orders_detail t2 where t1.coupon_code = t2.coupon_code and t1.coupon_userid = $userid and t1.order_status=4 and t1.language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function show_numer_order_final($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_orders t1 join coupons_orders_detail t2 where t1.coupon_code = t2.coupon_code and  t1.coupon_status = 2 and t1.order_status=3 and t1.translater_id > 0 and t1.coupon_userid = $userid and t1.language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function coupons_orders_pay($id, $code_pay, $code_banking)
    {
        global $db;
        $sql = "Update coupons_orders set code_pay ='$code_pay', code_banking ='$code_banking'  where coupon_code = $id";
        $res = $db->db_query($sql);

        return 1;
    }

    function show_all_coupons_order_notices($userid, $limit)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_notices where user_id = $userid and language = '$language' order by id desc limit 0, $limit";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function show_all_coupons_trans_notices($userid, $limit)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_translater_notices where translater_id = $userid and language = '$language' order by id desc limit 0, $limit";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function update_notices($user_id)
    {
        global $db;
        $sql = "Update coupons_notices set is_readed=1 where user_id = $user_id";
        $res = $db->db_query($sql);
        return 1;
    }


    function update_trans_notices($user_id)
    {
        global $db;
        $sql = "Update coupons_translater_notices set is_readed=1 where translater_id = $user_id";
        $res = $db->db_query($sql);
        return 1;
    }

    function show_number_order_notices($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_notices where user_id = $userid and is_readed=0 and language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

    function show_number_trans_notices($userid)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_translater_notices where translater_id = $userid and is_readed=0 and language = '$language'";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }


    function check_delete($id)
    {
        global $db;
        $sql = "Select coupon_purchaseid from coupons_orders where coupon_purchaseid = '$id' and coupon_status !='2'";
        //echo $sql;
        $res = $db->db_query($sql);
        $nums = $db->db_numrows($res);
        return $nums;
    }

    function delete_order($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Delete from coupons_orders t1 where coupon_purchaseid='$id' and coupon_status ='2'";
        $db->db_query($sql);
        return false;
    }

    function delete_orders_detail($id)
    {
        global $db;
        $id = intval($id);
        $sql = "Delete from coupons_orders_detail where coupon_code='$id'";
        $db->db_query($sql);
        return false;
    }

    function get_id($id)
    {
        global $db;
        $sql = "Select *, coupon_purchaseid as id_tem from coupons_orders where coupon_purchaseid = $id";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);
        $db->db_freeresult($res);
        return $rows;
    }

    function show_all_coupons_orders($page, $per_page, $coupon_status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);
        if ($coupon_status != "0") {
            $sr .= " and cp.coupon_status = $coupon_status";
        } else {
            $sr .= "";
        }

        $sql = "SELECT cp.*, cs.* ,cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua 
    FROM  coupons_orders cp,coupons_orders_detail cod,coupons_status cs 
    where cod.coupon_code=cp.coupon_code and cp.language='$language' and cp.coupon_userid = '$userid_u' 
    and cs.coupon_status=cp.coupon_status and cs.language='$language' $sr 
    group by cp.coupon_purchaseid
    ORDER BY coupon_purchaseid desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
        }

        return $rows;
    }

    function show_all_translate_orders($page, $per_page, $coupon_status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*,cod.*,cu.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua 
		FROM  
    coupons_orders cp
    inner join 
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code 
    left join 
    coupons_users_cv cu on cu.userid=cp.translater_id 
		where 
    cp.language='$language' 
    and cp.coupon_userid = '$userid_u' 
    and cp.order_status in (1,2,3,4)
    group by cp.coupon_purchaseid
		ORDER BY ngay_mua desc Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
        }
        return $rows;
    }

    function show_all_accept_translate_history($page, $per_page, $translater_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cu.avatar, cu.name, cp.*, cs.*, cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.order_date,'%d/%m/%Y') as ngay_order ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name
    FROM  coupons_orders cp,coupons_orders_detail cod, coupons_status cs , coupons_users cu
    where cod.coupon_code=cp.coupon_code and cu.userid=cp.coupon_userid and cp.language='$language' and cp.translater_id = " . $translater_id . " and cp.order_status in (1,2)
    and cs.coupon_status=cp.coupon_status and cp.coupon_status = 2
    group by cp.coupon_purchaseid
    ORDER BY cp.coupon_purchaseid desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["percentPrice"] = number_format(($rows[$i]["price"] * 55) / 100, 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
        }

        return $rows;
    }

    function show_all_accept_translate_active($page, $per_page, $translater_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cu.avatar, cu.name, cp.*, cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.order_date,'%d/%m/%Y') as ngay_order ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name
    FROM  
    coupons_orders cp
    inner join 
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code 
    left join 
    coupons_translate_files tf on tf.user_id = cp.coupon_userid 
    inner join 
    coupons_users cu on cu.userid=cp.coupon_userid
    where 
    cp.language='$language'
    and cp.translater_id = " . $translater_id . " 
    and cp.order_status = 2
    and cp.coupon_status = 2
    group by cp.coupon_purchaseid
    ORDER BY ngay_order desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["percentPrice"] = number_format(($rows[$i]["price"] * 55) / 100, 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
        }

        return $rows;
    }

    function show_all_accept_translate_finalize($page, $per_page, $translater_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cu.avatar, cu.name, cp.*, cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.order_date,'%d/%m/%Y') as ngay_order ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name
    FROM  
    coupons_orders cp
    inner join 
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code 
    inner join 
    coupons_users cu on cu.userid=cp.coupon_userid
    where 
    cp.language='$language' 
    and cp.translater_id = " . $translater_id . " 
    and cp.order_status = 3
    and cp.coupon_status = 2
    group by cp.coupon_purchaseid
    ORDER BY cp.coupon_purchaseid desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["file_translate"] = $function->cutnchar($rows[$i]["file_translate"], 100);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["percentPrice"] = number_format(($rows[$i]["price"] * 55) / 100, 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
        }

        return $rows;
    }

    function show_all_latest_order($page, $per_page)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userAccount = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cust.avatar as avatar_cust, cust.name as name_cust, cp.*, cod.*, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_order, (select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  
    coupons_orders cp
    inner join
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code
    inner join
    coupons_users cust on cust.userid=cp.coupon_userid
    where 
    cp.language='$language' 
    and cp.coupon_status = 2
    group by cp.coupon_purchaseid
    ORDER BY cp.coupon_purchaseid desc Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
        }

        return $rows;
    }


    function show_latest_translate_final($page, $per_page)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userAccount = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cu.avatar, cu.name, cp.*,  cod.*, FROM_UNIXTIME(cp.order_date,'%d/%m/%Y') as ngay_order ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name, (select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field, tf.file_name as file_name
    FROM  
    coupons_orders cp
    inner join 
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code 
    left join 
    coupons_translate_files tf on tf.user_id = cp.coupon_userid 
    inner join 
    coupons_users_cv cu on cu.userid=cp.translater_id 
    where 
    cp.language='$language' 
    and cp.order_status = 3
    and cp.coupon_status = 2
    group by cp.coupon_purchaseid
    ORDER BY ngay_order desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
        }

        return $rows;
    }

    function show_all_translate_final($page, $per_page)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userAccount = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cu.avatar, cu.name, ctf.send_date, cp.*, cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.order_date,'%d/%m/%Y') as ngay_order ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name
    FROM     
    coupons_orders cp 
    inner join
    coupons_orders_detail cod on cod.coupon_code = cp.coupon_code 
    inner join 
    coupons_users_cv cu on cu.userid = cp.translater_id 
    left join 
    coupons_translate_files ctf on ctf.user_id = cp.coupon_userid
    where 
    cp.language='$language' 
    and cp.coupon_userid = " . $userAccount . " 
    and cp.order_status = 3
    group by cp.coupon_purchaseid
    ORDER BY ngay_order desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
        }

        return $rows;
    }

    function show_latest_accept_translate_active($page, $per_page, $translater_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cu.avatar, cu.name, cp.*, cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.order_date,'%d/%m/%Y') as ngay_order ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name, (select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM 
    coupons_orders cp
    inner join 
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code 
    left join 
    coupons_translate_files tf on tf.user_id = cp.coupon_userid 
    inner join 
    coupons_users cu on cu.userid=cp.coupon_userid
    where 
    cp.language='$language'
    and cp.translater_id = " . $translater_id . " 
    and cp.order_status = 2
    and cp.coupon_status = 2
    group by cp.coupon_purchaseid
    ORDER BY ngay_order desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["percentPrice"] = number_format(($rows[$i]["price"] * 55) / 100, 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
        }

        return $rows;
    }

    function show_all_accept_orders($page, $per_page, $coupon_status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*, cuc.avatar, cuc.name, cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.order_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name, (select t4.name from list_country t4 where t4.id = cuc.country) as country_name, (select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  
    coupons_orders cp
    inner join
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code 
    left join
    coupons_users_cv cuc on cuc.userid=cp.translater_id 
    where 
     cp.language='$language' 
    and cp.translater_id > 0
    and cp.coupon_status = 2 
    and cp.order_status  in (2,3)
    GROUP BY cp.coupon_purchaseid 
    ORDER BY ngay_mua desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["file_translate"] = $function->cutnchar($rows[$i]["file_translate"], 200);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
        }

        return $rows;
    }

    function show_all_coupons_orders_complete($page, $per_page, $coupon_status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);
        if ($coupon_status != "0") {
            $sr .= " and cp.coupon_status = $coupon_status";
        } else {
            $sr .= "";
        }

        $sql = "SELECT cp.*, cs.*, cuc.*, cuv.* ,cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name, (select t4.name from list_country t4 where t4.id = cuc.country) as country_name, (select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field, (select t6.name from list_experience t6 where t6.id = cuv.experience) as experience_name
    FROM  coupons_orders cp,coupons_orders_detail cod, coupons_status cs ,  coupons_users_cv cuc,  coupons_users_cv_info cuv
    where cod.coupon_code=cp.coupon_code and cp.language='$language' and cp.translater_id > 0
    and cs.coupon_status=cp.coupon_status and cs.language='$language' and cuc.userid = cp.translater_id and cuv.user_id = cuc.userid and cp.coupon_status = 2 $sr 
    GROUP BY  cp.coupon_purchaseid 
    ORDER BY ngay_mua desc, cp.coupon_purchaseid desc Limit $page, $per_page";

        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["file_translate"] = $function->cutnchar($rows[$i]["file_translate"], 200);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
        }

        return $rows;
    }

    function show_all_coupons_orders_active($page, $per_page, $coupon_status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*, cod.*,cuc.*, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name, (select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  
    coupons_orders cp
    inner join
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code 
    left join
    coupons_users_cv cuc on cuc.userid=cp.translater_id 
    where 
    cp.language='$language'
    and cp.coupon_status = 2 
    and cp.order_status = 2 
    and cp.coupon_userid = $userid_u
    GROUP BY  cp.coupon_purchaseid 
    ORDER BY ngay_mua desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["file_translate"] = $function->cutnchar($rows[$i]["file_translate"], 200);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
        }

        return $rows;
    }

    function show_all_coupons_orders_cancel($page, $per_page, $coupon_status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*, cod.*,cuc.*, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name, (select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  
    coupons_orders cp
    inner join
    coupons_orders_detail cod on cod.coupon_code=cp.coupon_code 
    left join
    coupons_users_cv cuc on cuc.userid=cp.translater_id 
    where 
     cp.language='$language'
     and cp.order_status = 4 
     and cp.coupon_userid = $userid_u
    GROUP BY  cp.coupon_purchaseid 
    ORDER BY ngay_mua desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["file_translate"] = $function->cutnchar($rows[$i]["file_translate"], 200);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
        }

        return $rows;
    }

    function show_coupons_accept_active_by_id($translater_id, $coupon_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*, cod.*,cust.avatar,cust.name, (select t4.name from list_country t4 where t4.id = cp.country) as country_name, (select name from coupons_users_cv cuc where cuc.userid=$translater_id) as translater_name, (select address from coupons_users_cv cuc where cuc.userid=$translater_id) as address, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name,(select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  coupons_orders cp, coupons_orders_detail cod, coupons_users cust
    where cp.coupon_code = '$coupon_id' and cp.coupon_code=cod.coupon_code and cust.userid = cp.coupon_userid
    and cp.language='$language'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["percentPrice"] = number_format(($rows[$i]["price"] * 55) / 100, 2, ',', '.');
            $rows[$i]["total_prices"] = number_format($rows[$i]["total_prices"], 2, ',', '.');

            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);

        }

        return $rows;
    }

    function show_order_active_by_translater_id($translater_id, $coupon_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*, cod.*,cv.avatar,cv.name, (select t4.name from list_country t4 where t4.id = cp.country) as country_name, (select name from coupons_users_cv cuc where cuc.userid=$translater_id) as translater_name, (select address from coupons_users_cv cuc where cuc.userid=$translater_id) as address, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name,(select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  coupons_orders cp, coupons_orders_detail cod, coupons_users_cv cv
    where cp.coupon_code = '$coupon_id' and cp.coupon_code=cod.coupon_code and cv.userid = cp.translater_id
    and cp.language='$language'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["total_prices"] = number_format($rows[$i]["total_prices"], 2, ',', '.');

            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);

        }

        return $rows;
    }

    function show_coupons_orders_active_by_id($translater_id, $coupon_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*, cod.*,cv.avatar,cv.name, (select t4.name from list_country t4 where t4.id = cp.country) as country_name, (select name from coupons_users_cv cuc where cuc.userid=$translater_id) as translater_name, (select address from coupons_users_cv cuc where cuc.userid=$translater_id) as address, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name,(select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  coupons_orders cp, coupons_orders_detail cod, coupons_users_cv cv
    where cp.coupon_code = '$coupon_id' and cp.coupon_code=cod.coupon_code ";
        if ($translater_id > 0) {
            $sql .= "and cv.userid = cp.translater_id";
        }
        $sql .= "and cp.language='$language'";
        $sql .= "group by coupon_purchaseid";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["total_prices"] = number_format($rows[$i]["total_prices"], 2, ',', '.');

            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);

        }

        return $rows;
    }

    function show_final_detail_order_by_id($translater_id, $coupon_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*, cod.*,cu.avatar,cu.name, ctf.file_name, ctf.send_date, (select name from coupons_users_cv cuc where cuc.userid=$translater_id) as translater_name, (select address from coupons_users_cv cuc where cuc.userid=$translater_id) as address, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name,(select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM    
    coupons_orders cp 
    inner join
    coupons_orders_detail cod on cod.coupon_code = cp.coupon_code 
    inner join 
    coupons_users_cv cu on cu.userid = cp.translater_id 
    left join 
    coupons_translate_files ctf on ctf.user_id = cp.coupon_userid
    where 
    cp.coupon_code = '$coupon_id' 
    and 
    ctf.order_id = '$coupon_id' 
    and 
    cp.language='$language'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
        }
        return $rows;
    }


    function show_coupons_orders_by_id($translater_id, $coupon_id)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cp.*, cod.*,cu.avatar,cu.name, (select name from coupons_users_cv cuc where cuc.userid=$translater_id) as translater_name, (select address from coupons_users_cv cuc where cuc.userid=$translater_id) as address, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name,(select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  coupons_orders cp, coupons_orders_detail cod, coupons_users cu
    where cp.coupon_code = '$coupon_id' and cp.coupon_code=cod.coupon_code and cu.userid = cp.coupon_userid
    and cp.language='$language'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"]);
            $rows[$i]["percentPrice"] = number_format(($rows[$i]["price"] * 55) / 100, 2, ',', '.');
            $rows[$i]["total_prices"] = number_format($rows[$i]["total_prices"], 2, ',', '.');
        }

        return $rows;
    }

    function show_coupons_orders_detail_by_id($orderId)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_u"]);

        $sql = "SELECT cu.avatar, cu.name, cp.*, cod.*, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua ,(select t2.name from list_languages t2 where cod.translate_from = t2.id ) as from_language_name,(select t2.name from list_languages t2 where cod.translate_to = t2.id ) as to_language_name,(select t3.category_name from coupons_special_category t3 where cod.special_category = t3.id ) as subject_field
    FROM  coupons_orders cp, coupons_orders_detail cod , coupons_users cu
    where cp.coupon_purchaseid = '$orderId' and cp.coupon_code=cod.coupon_code and cu.userid=cp.coupon_userid and cp.language='$language'";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["file_translate"] = $function->cutnchar($rows[$i]["file_translate"], 50);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"], 0, ',', '.');
        }

        return $rows;
    }

    function show_all_orders_cv_by_category($page, $per_page, $categoryId)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_cv_u"]);


        $sql = "SELECT cu.avatar, cu.name, cp.*, cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua , (select t1.category_name from coupons_special_category t1 where t1.id = cod.special_category) as subject_field, (select t2.name from list_languages t2 where t2.id = cod.translate_from) as from_language_name, (select t2.name from list_languages t2 where t2.id = cod.translate_to) as to_language_name
    FROM  coupons_orders cp,coupons_orders_detail cod,coupons_status cs , coupons_users cu
    where cod.coupon_code=cp.coupon_code and cp.language='$language' 
    and cp.coupon_status = 2 and cod.special_category = $categoryId and cu.userid=cp.coupon_userid
    group by cp.coupon_purchaseid
    ORDER BY cp.coupon_status asc, cp.coupon_purchaseid desc Limit $page, $per_page";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["message"] = $function->cutnchar($rows[$i]["message"], 200);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
        }

        return $rows;
    }

    function show_all_coupons_orders_cv_active($page, $per_page, $coupon_status)
    {
        global $db, $function;
        $language = LANG_AUGE;
        $userid_u = $function->sql_injection($_SESSION[URL_HOME]["userid_cv_u"]);
        if ($coupon_status != "0") {
            $sr .= " and cp.coupon_status = $coupon_status";
        } else {
            $sr .= "";
        }

        $sql = "SELECT cu.name, cu.avatar, cp.*, cs.* ,cod.*,cp.shipping as shipping_cart, FROM_UNIXTIME(cp.coupon_date,'%d/%m/%Y') as ngay_mua , (select t1.category_name from coupons_special_category t1 where t1.id = cod.special_category) as subject_field, (select t2.name from list_languages t2 where t2.id = cod.translate_from) as from_language_name, (select t2.name from list_languages t2 where t2.id = cod.translate_to) as to_language_name
    FROM  coupons_orders cp,coupons_orders_detail cod, coupons_status cs , coupons_users cu
    where cod.coupon_code=cp.coupon_code and cp.language='$language' 
    and cs.coupon_status=cp.coupon_status and cu.userid=cp.coupon_userid and cp.coupon_status = 2 $sr 
    group by cp.coupon_purchaseid
    ORDER BY cp.coupon_status asc, cp.coupon_purchaseid desc Limit $page, $per_page";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);
        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["news_name"] = $function->cutnchar($rows[$i]["news_name"], 50);
            $rows[$i]["message"] = $function->cutnchar($rows[$i]["message"], 200);
            $rows[$i]["price"] = number_format($rows[$i]["price"], 2, ',', '.');
            $rows[$i]["count_text"] = number_format($rows[$i]["count_text"], 0, ',', '.');
        }

        return $rows;
    }

    function show_info_language($id)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT img_flag FROM list_languages where language=$language and id=$id order by id asc ";
        //echo $sql;
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrow($res);

        return $rows;
    }

    function show_all_language()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM list_languages where language=$language order by id asc ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function show_all_subject_field()
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT * FROM coupons_special_category where language=$language order by id asc ";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        return $rows;
    }

    function show_all_industry($limited)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT t1.* FROM coupons_special_category t1 where t1.language=$language order by t1.id asc limit $limited";
        $res = $db->db_query($sql);
        $rows = $db->db_fetchrowset($res);

        for ($i = 0; $i < count($rows); $i++) {
            $rows[$i]["count_order"] = $this->show_industry_order($rows[$i]['id']);
        }
        $db->db_freeresult($res);
        return $rows;
    }

    function show_industry_order($specialCategory)
    {
        global $db;
        $language = LANG_AUGE;
        $sql = "SELECT special_category FROM coupons_orders_detail where special_category=$specialCategory";
        $res = $db->db_query($sql);
        $rows = $db->db_numrows($res);
        return $rows;
    }

}

?>
