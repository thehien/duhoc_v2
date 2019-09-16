<?php
if($_SERVER['SERVER_NAME']=="localhost") {
 define ("URL_HOME","http://localhost/newjob");
} else {
define ("URL_HOME","http://linkrica.com");
}
define ("URL_HOMEPAGE",URL_HOME."/");

if(isset($_REQUEST["file"])){
    // Get parameters
    $file = urldecode($_REQUEST["file"]); // Decode URL-encoded string
    $filepath = URL_HOMEPAGE."load/download/" . $file;

    // Process download
    if($filepath) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$filepath.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    }
}
?>