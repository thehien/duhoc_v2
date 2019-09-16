<?php
include("general/class/class.phpmailer.php");
include("general/class/class.pop3.php");
include("general/class/class.smtp.php");

class Functions
{

  function rand_string($length)
  {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
      $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
  }


  function tim_so_ngay($date1, $date2)
  {
    if ($date1 < $date2) {
      $dates_range[] = $date1;
      $date1 = strtotime($date1);
      $date2 = strtotime($date2);
      $songay = 0;
      while ($date1 != $date2) {
        $date1 = mktime(0, 0, 0, date("m", $date1), date("d", $date1) + 1, date("Y", $date1));
        $dates_range[] = date('Y-m-d', $date1);
        $songay++;
      }
    }

    return $songay;
  }

  /* creates a compressed zip file */
  function create_zip($files = [], $destination = '', $overwrite = false)
  {
    //if the zip file already exists and overwrite is false, return false
    if (file_exists($destination) && !$overwrite) {
      return false;
    }
    //vars
    $valid_files = [];
    //if files were passed in...
    if (is_array($files)) {
      //cycle through each file
      foreach ($files as $file) {
        //make sure the file exists
        if (file_exists($file)) {
          $valid_files[] = $file;
        }
      }
    }
    //if we have good files...
    if (count($valid_files)) {
      //create the archive
      $zip = new ZipArchive();
      if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
        return false;
      }
      //add the files
      foreach ($valid_files as $file) {
        $zip->addFile($file, $file);
      }
      $zip->close();
      return file_exists($destination);
    } else {
      return false;
    }
  }

  function msg_box($str, $time, $link)
  {
    global $smarty;
    $smarty->assign("thongbao", $str);
    $smarty->assign("time", $time);
    $smarty->assign("goto", $link);

    return $smarty->fetch("msgbox.html");
  }

  function msg_box_new($str, $time, $link)
  {
    global $smarty;
    $smarty->assign("thongbao", $str);
    $smarty->assign("time", $time);
    $smarty->assign("goto", $link);

    return $smarty->fetch(THEMES . "/msgbox.html");
  }

  function msg_box_status($str, $time, $link, $type)
  {
    global $smarty;
    $smarty->assign("thongbao", $str);
    $smarty->assign("time", $time);
    $smarty->assign("goto", $link);
    $smarty->assign("type", $type);

    return $smarty->fetch("msgboxs.html");
  }

  function goto_url($url)
  {
    echo '
    <script language="javascript">
    window.location="' . $url . '";
    </script>
    ';
  }


  function debugPrint($params)
  {
    echo "<pre>";
    print_r($params);
    echo "</pre>";
  }

  // Detect mobile
  function isMobile()
  {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
        $_SERVER["HTTP_USER_AGENT"]);
  }

  function isIpad()
  {
    $isiPad = (bool)strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');

    return $isiPad;
  }

  // han che loi sql_injection
  function clean_syntax($value)
  {
    $ret = str_replace("drop", "", $value);
    $tukhoa = [
        'chr(',
        'chr=',
        'chr%20',
        '%20chr',
        'wget%20',
        '%20wget',
        'wget(',
        'cmd=',
        '%20cmd',
        'cmd%20',
        'rush=',
        '%20rush',
        'rush%20',
        'union%20',
        '%20union',
        'union(',
        'union=',
        'echr(',
        '%20echr',
        'echr%20',
        'echr=',
        'esystem(',
        'esystem%20',
        'cp%20',
        '%20cp',
        'cp(',
        'mdir%20',
        '%20mdir',
        'mdir(',
        'mcd%20',
        'mrd%20',
        'rm%20',
        '%20mcd',
        '%20mrd',
        '%20rm',
        'mcd(',
        'mrd(',
        'rm(',
        'mcd=',
        'mrd=',
        'mv%20',
        'rmdir%20',
        'mv(',
        'rmdir(',
        'chmod(',
        'chmod%20',
        '%20chmod',
        'chmod(',
        'chmod=',
        'chown%20',
        'chgrp%20',
        'chown(',
        'chgrp(',
        'locate%20',
        'grep%20',
        'locate(',
        'grep(',
        'diff%20',
        'kill%20',
        'kill(',
        'killall',
        'passwd%20',
        '%20passwd',
        'passwd(',
        'telnet%20',
        'vi(',
        'vi%20',
        'insert%20into',
        'select%20',
        'nigga(',
        '%20nigga',
        'nigga%20',
        'fopen',
        'fwrite',
        '%20like',
        'like%20',
        '$_request',
        '$_get',
        '$request',
        '$get',
        '.system',
        'HTTP_PHP',
        '&aim',
        '%20getenv',
        'getenv%20',
        'new_password',
        '&icq',
        '/etc/password',
        '/etc/shadow',
        '/etc/groups',
        '/etc/gshadow',
        'HTTP_USER_AGENT',
        'HTTP_HOST',
        '/bin/ps',
        'wget%20',
        'uname\x20-a',
        '/usr/bin/id',
        '/bin/echo',
        '/bin/kill',
        '/bin/',
        '/chgrp',
        '/chown',
        '/usr/bin',
        'g\+\+',
        'bin/python',
        'bin/tclsh',
        'bin/nasm',
        'perl%20',
        'traceroute%20',
        'ping%20',
        '.pl',
        '/usr/X11R6/bin/xterm',
        'lsof%20',
        '/bin/mail',
        '.conf',
        'motd%20',
        'HTTP/1.',
        '.inc.php',
        'config.php',
        'cgi-',
        '.eml',
        'file\://',
        'window.open',
        '<SCRIPT>',
        'javascript\://',
        'img src',
        'img%20src',
        '.jsp',
        'ftp.exe',
        'xp_enumdsn',
        'xp_availablemedia',
        'xp_filelist',
        'xp_cmdshell',
        'nc.exe',
        '.htpasswd',
        'servlet',
        '/etc/passwd',
        'wwwacl',
        '~root',
        '~ftp',
        '.js',
        '.jsp',
        'admin_',
        '.history',
        'bash_history',
        '.bash_history',
        '~nobody',
        'server-info',
        'server-status',
        'reboot%20',
        'halt%20',
        'powerdown%20',
        '/home/ftp',
        '/home/www',
        'secure_site, ok',
        'chunked',
        'org.apache',
        '/servlet/con',
        '<script',
        '/robot.txt',
        '/perl',
        'mod_gzip_status',
        'db_mysql.inc',
        '.inc',
        'select%20from',
        'select from',
        'drop%20',
        '.system',
        'getenv',
        'http_',
        '_php',
        'php_',
        'phpinfo()',
        '<?php',
        '?>',
        'sql='
    ];
    $ret = str_replace($tukhoa, "", $ret);
    $ret = str_replace("%20", "", $ret);
    $ret = str_replace("POST", "", $ret);
    $ret = str_replace("GET", "", $ret);
    $ret = str_replace("'", "", $ret);
    $ret = str_replace("|", "", $ret);
    $ret = str_replace("*", "", $ret);
    $ret = str_replace("=", "", $ret);
    $ret = str_replace("+", "", $ret);
    $ret = str_replace("      ", "", $ret);
    $ret = str_replace("     ", "", $ret);
    $ret = str_replace("    ", "", $ret);
    $ret = str_replace("   ", "", $ret);
    //$ret = str_replace("$","",$ret);
    //$ret = str_replace("&","",$ret);
    return $ret;
  }

  function clean_string($value)
  {
    if (get_magic_quotes_gpc()) {
      $value = stripslashes($value);
    }

    // escape things properly
    return mysql_real_escape_string($value);
  }

  function FixQuotes($what = "")
  {
    $what = ereg_replace("'", "''", $what);
    while (eregi("\\\\'", $what)) {
      $what = ereg_replace("\\\\'", "'", $what);
    }

    return $what;
  }

  function sql_injection($value)
  {

    $value = $this->clean_syntax($value);
    $value = $this->clean_string($value);
    $value = $this->FixQuotes($value);

    return $value;
  }
  // end sql_injection

  //bo tieng viet va phan cach = _
  function to_character($var)
  {

    $a = [
        'â',
        'ấ',
        'ầ',
        'ẩ',
        'ẫ',
        'ậ',
        'ă',
        'ắ',
        'ằ',
        'ẳ',
        'ẵ',
        'ặ',
        'á',
        'à',
        'ả',
        'ã',
        'ạ'
    ];
    $o = [
        'ô',
        'ố',
        'ồ',
        'ổ',
        'ỗ',
        'ộ',
        'ơ',
        'ớ',
        'ờ',
        'ở',
        'ỡ',
        'ợ',
        'ó',
        'ò',
        'ỏ',
        'õ',
        'ọ'
    ];
    $u = [
        'ư',
        'ứ',
        'ừ',
        'ử',
        'ữ',
        'ự',
        'ú',
        'ù',
        'ủ',
        'ũ',
        'ụ'
    ];
    $i_char = [
        'í',
        'ì',
        'ỉ',
        'ĩ',
        'ị'
    ];
    $e = [
        'ê',
        'ế',
        'ề',
        'ể',
        'ễ',
        'ệ',
        'é',
        'è',
        'ẻ',
        'ẽ',
        'ẹ'
    ];
    $y = [
        'ý',
        'ỳ',
        'ỷ',
        'ỹ',
        'ỵ'
    ];

    $A = [
        'Â',
        'Ấ',
        'Ầ',
        'Ẩ',
        'Ẫ',
        'Ậ',
        'Ă',
        'Ắ',
        'Ằ',
        'Ẳ',
        'Ẵ',
        'Ặ',
        'Á',
        'À',
        'Ả',
        'Ã',
        'Ạ'
    ];
    $O = [
        'Ô',
        'Ố',
        'Ồ',
        'Ổ',
        'Ỗ',
        'Ộ',
        'Ơ',
        'Ớ',
        'Ờ',
        'Ở',
        'Ỡ',
        'Ợ',
        'Ó',
        'Ò',
        'Ỏ',
        'Õ',
        'Ọ'
    ];
    $U = [
        'Ư',
        'Ứ',
        'Ừ',
        'Ử',
        'Ữ',
        'Ự',
        'Ú',
        'Ù',
        'Ủ',
        'Ũ',
        'Ụ'
    ];
    $I_char = [
        'Í',
        'Ì',
        'Ỉ',
        'Ĩ',
        'Ị'
    ];
    $E = [
        'Ê',
        'Ế',
        'Ề',
        'Ể',
        'Ễ',
        'Ệ',
        'É',
        'È',
        'Ẻ',
        'Ẽ',
        'Ẹ'
    ];
    $Y = [
        'Ý',
        'Ỳ',
        'Ỷ',
        'Ỹ',
        'Ỵ'
    ];

    for ($i = 0; $i < count($a); $i++) {
      $var = str_replace($a[$i], "a", $var);
    }
    for ($i = 0; $i < count($o); $i++) {
      $var = str_replace($o[$i], "o", $var);
    }
    for ($i = 0; $i < count($u); $i++) {
      $var = str_replace($u[$i], "u", $var);
    }
    for ($i = 0; $i < count($i_char); $i++) {
      $var = str_replace($i_char[$i], "i", $var);
    }
    for ($i = 0; $i < count($e); $i++) {
      $var = str_replace($e[$i], "e", $var);
    }
    for ($i = 0; $i < count($y); $i++) {
      $var = str_replace($y[$i], "y", $var);
    }

    for ($i = 0; $i < count($A); $i++) {
      $var = str_replace($A[$i], "a", $var);
    }
    for ($i = 0; $i < count($O); $i++) {
      $var = str_replace($O[$i], "o", $var);
    }
    for ($i = 0; $i < count($U); $i++) {
      $var = str_replace($U[$i], "u", $var);
    }
    for ($i = 0; $i < count($I_char); $i++) {
      $var = str_replace($I_char[$i], "i", $var);
    }
    for ($i = 0; $i < count($E); $i++) {
      $var = str_replace($E[$i], "e", $var);
    }
    for ($i = 0; $i < count($Y); $i++) {
      $var = str_replace($Y[$i], "y", $var);
    }
    $var = str_replace("đ", "d", $var);
    $var = str_replace("Đ", "d", $var);

    return str_replace(" ", "-", ereg_replace("[^A-Za-z0-9/ ]", "", strtolower($var)));
  }

  function to_character_conten($var)
  {

    $var = str_replace(".", "<br>", $var);

    return str_replace(",", "<br>", ereg_replace(".-,", "", strtolower($var)));
  }

  function to_character_price($var)
  {

    $var = str_replace(".", "", $var);

    return str_replace(",", "", ereg_replace(".-,", "", strtolower($var)));
  }

  //bo tieng viet va phan khong phac chach
  function to_character_search($var)
  {

    $a = [
        'â',
        'ấ',
        'ầ',
        'ẩ',
        'ẫ',
        'ậ',
        'ă',
        'ắ',
        'ằ',
        'ẳ',
        'ẵ',
        'ặ',
        'á',
        'à',
        'ả',
        'ã',
        'ạ'
    ];
    $o = [
        'ô',
        'ố',
        'ồ',
        'ổ',
        'ỗ',
        'ộ',
        'ơ',
        'ớ',
        'ờ',
        'ở',
        'ỡ',
        'ợ',
        'ó',
        'ò',
        'ỏ',
        'õ',
        'ọ'
    ];
    $u = [
        'ư',
        'ứ',
        'ừ',
        'ử',
        'ữ',
        'ự',
        'ú',
        'ù',
        'ủ',
        'ũ',
        'ụ'
    ];
    $i_char = [
        'í',
        'ì',
        'ỉ',
        'ĩ',
        'ị'
    ];
    $e = [
        'ê',
        'ế',
        'ề',
        'ể',
        'ễ',
        'ệ',
        'é',
        'è',
        'ẻ',
        'ẽ',
        'ẹ'
    ];
    $y = [
        'ý',
        'ỳ',
        'ỷ',
        'ỹ',
        'ỵ'
    ];

    $A = [
        'Â',
        'Ấ',
        'Ầ',
        'Ẩ',
        'Ẫ',
        'Ậ',
        'Ă',
        'Ắ',
        'Ằ',
        'Ẳ',
        'Ẵ',
        'Ặ',
        'Á',
        'À',
        'Ả',
        'Ã',
        'Ạ'
    ];
    $O = [
        'Ô',
        'Ố',
        'Ồ',
        'Ổ',
        'Ỗ',
        'Ộ',
        'Ơ',
        'Ớ',
        'Ờ',
        'Ở',
        'Ỡ',
        'Ợ',
        'Ó',
        'Ò',
        'Ỏ',
        'Õ',
        'Ọ'
    ];
    $U = [
        'Ư',
        'Ứ',
        'Ừ',
        'Ử',
        'Ữ',
        'Ự',
        'Ú',
        'Ù',
        'Ủ',
        'Ũ',
        'Ụ'
    ];
    $I_char = [
        'Í',
        'Ì',
        'Ỉ',
        'Ĩ',
        'Ị'
    ];
    $E = [
        'Ê',
        'Ế',
        'Ề',
        'Ể',
        'Ễ',
        'Ệ',
        'É',
        'È',
        'Ẻ',
        'Ẽ',
        'Ẹ'
    ];
    $Y = [
        'Ý',
        'Ỳ',
        'Ỷ',
        'Ỹ',
        'Ỵ'
    ];

    for ($i = 0; $i < count($a); $i++) {
      $var = str_replace($a[$i], "a", $var);
    }
    for ($i = 0; $i < count($o); $i++) {
      $var = str_replace($o[$i], "o", $var);
    }
    for ($i = 0; $i < count($u); $i++) {
      $var = str_replace($u[$i], "u", $var);
    }
    for ($i = 0; $i < count($i_char); $i++) {
      $var = str_replace($i_char[$i], "i", $var);
    }
    for ($i = 0; $i < count($e); $i++) {
      $var = str_replace($e[$i], "e", $var);
    }
    for ($i = 0; $i < count($y); $i++) {
      $var = str_replace($y[$i], "y", $var);
    }

    for ($i = 0; $i < count($A); $i++) {
      $var = str_replace($A[$i], "a", $var);
    }
    for ($i = 0; $i < count($O); $i++) {
      $var = str_replace($O[$i], "o", $var);
    }
    for ($i = 0; $i < count($U); $i++) {
      $var = str_replace($U[$i], "u", $var);
    }
    for ($i = 0; $i < count($I_char); $i++) {
      $var = str_replace($I_char[$i], "i", $var);
    }
    for ($i = 0; $i < count($E); $i++) {
      $var = str_replace($E[$i], "e", $var);
    }
    for ($i = 0; $i < count($Y); $i++) {
      $var = str_replace($Y[$i], "y", $var);
    }
    $var = str_replace("đ", "d", $var);
    $var = str_replace("Đ", "d", $var);

    return str_replace(" ", " ", ereg_replace("[^A-Za-z0-9/ ]", "", strtolower($var)));
  }

  //Doi link cho web
  function character_url($var)
  {

    $a = [
        'â',
        'ấ',
        'ầ',
        'ẩ',
        'ẫ',
        'ậ',
        'ă',
        'ắ',
        'ằ',
        'ẳ',
        'ẵ',
        'ặ',
        'á',
        'à',
        'ả',
        'ã',
        'ạ'
    ];
    $o = [
        'ô',
        'ố',
        'ồ',
        'ổ',
        'ỗ',
        'ộ',
        'ơ',
        'ớ',
        'ờ',
        'ở',
        'ỡ',
        'ợ',
        'ó',
        'ò',
        'ỏ',
        'õ',
        'ọ'
    ];
    $u = [
        'ư',
        'ứ',
        'ừ',
        'ử',
        'ữ',
        'ự',
        'ú',
        'ù',
        'ủ',
        'ũ',
        'ụ'
    ];
    $i_char = [
        'í',
        'ì',
        'ỉ',
        'ĩ',
        'ị'
    ];
    $e = [
        'ê',
        'ế',
        'ề',
        'ể',
        'ễ',
        'ệ',
        'é',
        'è',
        'ẻ',
        'ẽ',
        'ẹ'
    ];
    $y = [
        'ý',
        'ỳ',
        'ỷ',
        'ỹ',
        'ỵ'
    ];

    $A = [
        'Â',
        'Ấ',
        'Ầ',
        'Ẩ',
        'Ẫ',
        'Ậ',
        'Ă',
        'Ắ',
        'Ằ',
        'Ẳ',
        'Ẵ',
        'Ặ',
        'Á',
        'À',
        'Ả',
        'Ã',
        'Ạ'
    ];
    $O = [
        'Ô',
        'Ố',
        'Ồ',
        'Ổ',
        'Ỗ',
        'Ộ',
        'Ơ',
        'Ớ',
        'Ờ',
        'Ở',
        'Ỡ',
        'Ợ',
        'Ó',
        'Ò',
        'Ỏ',
        'Õ',
        'Ọ'
    ];
    $U = [
        'Ư',
        'Ứ',
        'Ừ',
        'Ử',
        'Ữ',
        'Ự',
        'Ú',
        'Ù',
        'Ủ',
        'Ũ',
        'Ụ'
    ];
    $I_char = [
        'Í',
        'Ì',
        'Ỉ',
        'Ĩ',
        'Ị'
    ];
    $E = [
        'Ê',
        'Ế',
        'Ề',
        'Ể',
        'Ễ',
        'Ệ',
        'É',
        'È',
        'Ẻ',
        'Ẽ',
        'Ẹ'
    ];
    $Y = [
        'Ý',
        'Ỳ',
        'Ỷ',
        'Ỹ',
        'Ỵ'
    ];

    for ($i = 0; $i < count($a); $i++) {
      $var = str_replace($a[$i], "a", $var);
    }
    for ($i = 0; $i < count($o); $i++) {
      $var = str_replace($o[$i], "o", $var);
    }
    for ($i = 0; $i < count($u); $i++) {
      $var = str_replace($u[$i], "u", $var);
    }
    for ($i = 0; $i < count($i_char); $i++) {
      $var = str_replace($i_char[$i], "i", $var);
    }
    for ($i = 0; $i < count($e); $i++) {
      $var = str_replace($e[$i], "e", $var);
    }
    for ($i = 0; $i < count($y); $i++) {
      $var = str_replace($y[$i], "y", $var);
    }

    for ($i = 0; $i < count($A); $i++) {
      $var = str_replace($A[$i], "a", $var);
    }
    for ($i = 0; $i < count($O); $i++) {
      $var = str_replace($O[$i], "o", $var);
    }
    for ($i = 0; $i < count($U); $i++) {
      $var = str_replace($U[$i], "u", $var);
    }
    for ($i = 0; $i < count($I_char); $i++) {
      $var = str_replace($I_char[$i], "i", $var);
    }
    for ($i = 0; $i < count($E); $i++) {
      $var = str_replace($E[$i], "e", $var);
    }
    for ($i = 0; $i < count($Y); $i++) {
      $var = str_replace($Y[$i], "y", $var);
    }
    $var = str_replace("đ", "d", $var);
    $var = str_replace("Đ", "d", $var);

    return str_replace(" ", "-", ereg_replace("[^A-Za-z0-9/ ]", "-", strtolower($var)));
  }

  //Doi ten hinh khong dau gach duoi
  function character_name_img($var)
  {

    $a = [
        'â',
        'ấ',
        'ầ',
        'ẩ',
        'ẫ',
        'ậ',
        'ă',
        'ắ',
        'ằ',
        'ẳ',
        'ẵ',
        'ặ',
        'á',
        'à',
        'ả',
        'ã',
        'ạ'
    ];
    $o = [
        'ô',
        'ố',
        'ồ',
        'ổ',
        'ỗ',
        'ộ',
        'ơ',
        'ớ',
        'ờ',
        'ở',
        'ỡ',
        'ợ',
        'ó',
        'ò',
        'ỏ',
        'õ',
        'ọ'
    ];
    $u = [
        'ư',
        'ứ',
        'ừ',
        'ử',
        'ữ',
        'ự',
        'ú',
        'ù',
        'ủ',
        'ũ',
        'ụ'
    ];
    $i_char = [
        'í',
        'ì',
        'ỉ',
        'ĩ',
        'ị'
    ];
    $e = [
        'ê',
        'ế',
        'ề',
        'ể',
        'ễ',
        'ệ',
        'é',
        'è',
        'ẻ',
        'ẽ',
        'ẹ'
    ];
    $y = [
        'ý',
        'ỳ',
        'ỷ',
        'ỹ',
        'ỵ'
    ];

    $A = [
        'Â',
        'Ấ',
        'Ầ',
        'Ẩ',
        'Ẫ',
        'Ậ',
        'Ă',
        'Ắ',
        'Ằ',
        'Ẳ',
        'Ẵ',
        'Ặ',
        'Á',
        'À',
        'Ả',
        'Ã',
        'Ạ'
    ];
    $O = [
        'Ô',
        'Ố',
        'Ồ',
        'Ổ',
        'Ỗ',
        'Ộ',
        'Ơ',
        'Ớ',
        'Ờ',
        'Ở',
        'Ỡ',
        'Ợ',
        'Ó',
        'Ò',
        'Ỏ',
        'Õ',
        'Ọ'
    ];
    $U = [
        'Ư',
        'Ứ',
        'Ừ',
        'Ử',
        'Ữ',
        'Ự',
        'Ú',
        'Ù',
        'Ủ',
        'Ũ',
        'Ụ'
    ];
    $I_char = [
        'Í',
        'Ì',
        'Ỉ',
        'Ĩ',
        'Ị'
    ];
    $E = [
        'Ê',
        'Ế',
        'Ề',
        'Ể',
        'Ễ',
        'Ệ',
        'É',
        'È',
        'Ẻ',
        'Ẽ',
        'Ẹ'
    ];
    $Y = [
        'Ý',
        'Ỳ',
        'Ỷ',
        'Ỹ',
        'Ỵ'
    ];

    for ($i = 0; $i < count($a); $i++) {
      $var = str_replace($a[$i], "a", $var);
    }
    for ($i = 0; $i < count($o); $i++) {
      $var = str_replace($o[$i], "o", $var);
    }
    for ($i = 0; $i < count($u); $i++) {
      $var = str_replace($u[$i], "u", $var);
    }
    for ($i = 0; $i < count($i_char); $i++) {
      $var = str_replace($i_char[$i], "i", $var);
    }
    for ($i = 0; $i < count($e); $i++) {
      $var = str_replace($e[$i], "e", $var);
    }
    for ($i = 0; $i < count($y); $i++) {
      $var = str_replace($y[$i], "y", $var);
    }

    for ($i = 0; $i < count($A); $i++) {
      $var = str_replace($A[$i], "a", $var);
    }
    for ($i = 0; $i < count($O); $i++) {
      $var = str_replace($O[$i], "o", $var);
    }
    for ($i = 0; $i < count($U); $i++) {
      $var = str_replace($U[$i], "u", $var);
    }
    for ($i = 0; $i < count($I_char); $i++) {
      $var = str_replace($I_char[$i], "i", $var);
    }
    for ($i = 0; $i < count($E); $i++) {
      $var = str_replace($E[$i], "e", $var);
    }
    for ($i = 0; $i < count($Y); $i++) {
      $var = str_replace($Y[$i], "y", $var);
    }
    $var = str_replace("đ", "d", $var);
    $var = str_replace("Đ", "d", $var);

    return str_replace(" ", "-", preg_replace("/.[[.s]{3,4}$/", "-", strtolower($var)));
  }

  function truncate($string, $length, $dots = "...")
  {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
  }

  function cutnchar($str, $n)
  {
    if (strlen($str) < $n) {
      return $str;
    }
    $html = substr($str, 0, $n);
    $html = substr($html, 0, strrpos($html, ' '));

    return $html . '...';
  }

  function cutnchar_date($str, $n)
  {
    if (strlen($str) < $n) {
      return $str;
    }
    $html = substr($str, 0, $n);
    $html = substr($html, 0, strrpos($html, ' '));

    return $html . '';
  }

  // phan trang new <<  1 2    >>
  function generate_page_news($base_url, $url_last, $num_items, $per_page, $start_item, $add_prevnext_text = true)
  {
    $total_pages = ceil($num_items / $per_page);
    if ($total_pages == 1) {
      return '';
    }

    @$on_page = floor($start_item / $per_page) + 1;
    $page_string = '';
    if ($total_pages > 10) {
      $init_page_max = ($total_pages > 3) ? 3 : $total_pages;
      for ($i = 1; $i < $init_page_max + 1; $i++) {
        $page_string .= ($i == $on_page) ? '<li><a href="#" class="current-page">' . $i . '</a></li>' : '<li><a href="' . $base_url . "/" . ($i - 1) * $per_page . "" . $url_last . '">' . $i . '</a></li>';
        if ($i < $init_page_max) {
          $page_string .= " ";
        }
      }
      if ($total_pages > 3) {
        if ($on_page > 1 && $on_page < $total_pages) {
          $page_string .= ($on_page > 5) ? ' ... ' : ' ';
          $init_page_min = ($on_page > 4) ? $on_page : 5;
          $init_page_max = ($on_page < $total_pages - 4) ? $on_page : $total_pages - 4;
          for ($i = $init_page_min - 1; $i < $init_page_max + 2; $i++) {
            $page_string .= ($i == $on_page) ? '<li><a href="#" class="current-page">' . $i . '</a></li>' : '<li><a  href="' . $base_url . "/" . ($i - 1) * $per_page . "" . $url_last . '">' . $i . '</a></li>';
            if ($i < $init_page_max + 1) {
              $page_string .= ' ';
            }
          }
          $page_string .= ($on_page < $total_pages - 4) ? ' ... ' : ' ';
        } else {
          $page_string .= ' ... ';
        }

        for ($i = $total_pages - 2; $i < $total_pages + 1; $i++) {
          $page_string .= ($i == $on_page) ? '<li><a href="#" class="current-page">' . $i . '</a></li>' : '<li><a  href="' . $base_url . "/" . ($i - 1) * $per_page . "" . $url_last . '">' . $i . '</a></li>';
          if ($i < $total_pages) {
            $page_string .= " ";
          }
        }
      }
    } else {
      for ($i = 1; $i < $total_pages + 1; $i++) {

        $page_string .= ($i == $on_page) ? '<li><a href="#" class="current-page">' . $i . '</a></li>' : '<li><a href="' . $base_url . "/" . ($i - 1) * $per_page . "" . $url_last . '">' . $i . '</a></li>';

        if ($i < $total_pages) {
          $page_string .= ' ';
        }
      }
    }
    if ($add_prevnext_text) {
      if ($on_page == 1) {
      }
      if ($on_page > 1) {
        $page_string = '<li><a href="' . $base_url . "/" . ($on_page - 2) * $per_page . "" . $url_last . '">&laquo;</a></li>' . $page_string;
      }
      if ($on_page < $total_pages) {
        $page_string .= '<li><a  href="' . $base_url . "/" . $on_page * $per_page . "" . $url_last . '">&raquo;</a></li>';
      } elseif ($on_page == $total_pages) {
        $page_string .= '<div><span><samp></samp></span></div>';
      }
    }

    return $page_string;

  }

  // phan trang admin
  function generate_page_cms($base_url, $url_last, $num_items, $per_page, $start_item, $add_prevnext_text = true)
  {
    $total_pages = ceil($num_items / $per_page);
    if ($total_pages == 1) {
      return '';
    }

    @$on_page = floor($start_item / $per_page) + 1;
    $page_string = '';
    if ($total_pages > 10) {
      $init_page_max = ($total_pages > 3) ? 3 : $total_pages;
      for ($i = 1; $i < $init_page_max + 1; $i++) {
        $page_string .= ($i == $on_page) ? '<b>' . $i . '</b>' : '<a href="' . $base_url . "&page=" . ($i - 1) * $per_page . "" . $url_last . '">' . $i . '</a>';
        if ($i < $init_page_max) {
          $page_string .= " ";
        }
      }
      if ($total_pages > 3) {
        if ($on_page > 1 && $on_page < $total_pages) {
          $page_string .= ($on_page > 5) ? ' ... ' : ' ';
          $init_page_min = ($on_page > 4) ? $on_page : 5;
          $init_page_max = ($on_page < $total_pages - 4) ? $on_page : $total_pages - 4;
          for ($i = $init_page_min - 1; $i < $init_page_max + 2; $i++) {
            $page_string .= ($i == $on_page) ? '<b>' . $i . '</b>' : '<a  href="' . $base_url . "&page=" . ($i - 1) * $per_page . "" . $url_last . '">' . $i . '</a>';
            if ($i < $init_page_max + 1) {
              $page_string .= ' ';
            }
          }
          $page_string .= ($on_page < $total_pages - 4) ? ' ... ' : ' ';
        } else {
          $page_string .= ' ... ';
        }

        for ($i = $total_pages - 2; $i < $total_pages + 1; $i++) {
          $page_string .= ($i == $on_page) ? '<b>' . $i . '</b>' : '<a  href="' . $base_url . "&page=" . ($i - 1) * $per_page . "" . $url_last . '">' . $i . '</a>';
          if ($i < $total_pages) {
            $page_string .= " ";
          }
        }
      }
    } else {
      for ($i = 1; $i < $total_pages + 1; $i++) {

        $page_string .= ($i == $on_page) ? '<b>' . $i . '</b>' : '<a href="' . $base_url . "&page=" . ($i - 1) * $per_page . "" . $url_last . '">' . $i . '</a>';

        if ($i < $total_pages) {
          $page_string .= ' ';
        }
      }
    }
    if ($add_prevnext_text) {
      if ($on_page == 1) {
      }
      if ($on_page > 1) {
        $page_string = '<a class="paging_news_truoc" href="' . $base_url . "&page=" . ($on_page - 2) * $per_page . "" . $url_last . '">&laquo;</a>' . $page_string;
      }
      if ($on_page < $total_pages) {
        $page_string .= '<a class="paging_news_sau"  href="' . $base_url . "&page=" . $on_page * $per_page . "" . $url_last . '">&raquo;</a>';
      } elseif ($on_page == $total_pages) {
        $page_string .= '<div><span><samp></samp></span></div>';
      }
    }

    return $page_string;

  }

  function chars_rand()
  {
    $keychars = "aAbBcCdDeEfFgGhHiIjJkKLmMnNpPqQrRsStTuUvVwWxXyYzZ23456789";
    $length = 6;
    $randkey = "";
    $randkey_space = "";
    for ($i = 0; $i < $length; $i++) {
      $a = substr($keychars, rand(1, strlen($keychars) - 1), 1);
      $randkey .= $a;
      $randkey_space .= " " . $a;
    }

    return $randkey . "/" . $randkey_space;
  }

  ////////////////////////gui mail
  function smtpmailer_cms($to, $from, $from_name, $subject, $body)
  {
    global $error;
    include("../../general/class/class.phpmailer.php");
    include("../../general/class/class.pop3.php");
    include("../../general/class/class.smtp.php");

    $mail = new PHPMailer();
    $mail->IsHTML(true);
    $mail->IsSMTP();
    $mail->CharSet = "utf-8";
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->SMTPSecure = 'TLS';
    $mail->Port = 25;

    $mail->Host = 'mail.ditacom.vn';
    $mail->Username = 'info@ditacom.vn';
    $mail->Password = '1qazxsw2@';

    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    $mail->Send();

  }

  function smtpmailer($to, $from, $from_name, $subject, $body)
  {
    global $error;

    $mail = new PHPMailer();
    $mail->IsHTML(true);
    $mail->IsSMTP();
    $mail->CharSet = "utf-8";
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'ngothehientg@gmail.com';
    $mail->Password = 'abc123.com';

    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    $mail->AddReplyTo($to, 'Reply to ' . $to);
    $mail->Send();
    // if(!$mail->Send()) {
    //   echo "Mailer Error: " . $mail->ErrorInfo;
    // }
    //exit;
  }

  // Send mail request order
  function smtpmailer_request($to, $from, $from_name, $subject, $body)
  {
    global $error;
    $mail = new PHPMailer();
    $mail->IsHTML(true);
    $mail->IsSMTP();
    $mail->CharSet = "utf-8";
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'ngothehientg@gmail.com';
    $mail->Password = 'abc123.com';

    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    $mail->AddReplyTo($to, 'Reply to ' . $to);

    if (!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    }

  }

}

?>
