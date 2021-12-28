<?php
// Root path for file manager
// use absolute path of directory i.e: '/FileExplorer' or $_SERVER['DOCUMENT_ROOT'].'/folder'
$root_path = $_SERVER['DOCUMENT_ROOT'];

$root_path = rtrim($root_path, '\\/');
defined('FM_ROOT_PATH') || define('FM_ROOT_PATH', $root_path);


// get path
$p = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');

// clean path
//$p = fm_clean_path($p);


// Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
// Will not working if $root_path will be outside of server document root
$root_url = '';


define('FM_PATH', $p);

$is_https = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
    || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';


// Server hostname. Can set manually if wrong
$http_host = $_SERVER['HTTP_HOST'];


// private key and session name to store to the session
if ( !defined( 'FM_SESSION_ID')) {
    define('FM_SESSION_ID', 'filemanager');
}


defined('FM_SELF_URL') || define('FM_SELF_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . $_SERVER['PHP_SELF']);

if (isset($_POST['type']) && $_POST['type'] == "save") {
    // get current path
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }
    // check path
    if (!is_dir($path)) {
        fm_redirect(FM_SELF_URL . '?p=');
    }
    $file = $_GET['edit'];
//    $file = fm_clean_path($file);
    $file = str_replace('/', '', $file);
    if ($file == '' || !is_file($path . '/' . $file)) {
//        fm_set_msg(lng('File not found'), 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
    header('X-XSS-Protection:0');
    $file_path = $path . '/' . $file;

    $writedata = $_POST['content'];
    $fd = fopen($file_path, "w");
    $write_results = @fwrite($fd, $writedata);
    fclose($fd);
    if ($write_results === false){
        header("HTTP/1.1 500 Internal Server Error");
        die("Could Not Write File! - Check Permissions / Ownership");
    }
    die(true);
}


// Login user name
$auth_users = array(
    '456789123',// hesam
    '1234598712' // guest
);

if (empty($auth_users)) {
    $use_auth = false;
}

// logout
if (isset($_GET['logout'])) {
    unset($_SESSION[FM_SESSION_ID]['logged']);
    fm_redirect(FM_SELF_URL);
}

// update $root_url based on user specific directories
if (isset($_SESSION[FM_SESSION_ID]['logged']) && !empty($directories_users[$_SESSION[FM_SESSION_ID]['logged']])) {
    $wd = fm_clean_path(dirname($_SERVER['PHP_SELF']));
    $root_url =  $root_url.$wd.DIRECTORY_SEPARATOR.$directories_users[$_SESSION[FM_SESSION_ID]['logged']];
}


// clean $root_url
//$root_url = fm_clean_path($root_url);



// Auth with login
// set true/false to enable/disable it
// Is independent from IP white- and blacklisting
$use_auth = true;

if ($use_auth) {
    if (isset($_SESSION[FM_SESSION_ID]['logged'], $auth_users[$_SESSION[FM_SESSION_ID]['logged']])) {
        // Logged
    } elseif (isset($_POST['fm_usr'])) {
        // Logging In
        sleep(1);
        if (isset($auth_users[$_POST['fm_usr']])) {
            $_SESSION[FM_SESSION_ID]['logged'] = $_POST['fm_usr'];
            fm_set_msg(lng('You are logged in'));
            fm_redirect(FM_SELF_URL . '?p=');
        } else {
            ob_start(); // ensures anything dumped out will be caught

            // clear out the output buffer
            while (ob_get_status())
            {
                ob_end_clean();
            }
//            / no redirect
            header( "Location: http://localhost/FileExplorer" );
        }
    }
}
?>
