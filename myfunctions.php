<?php
include_once 'Include/header.php';

function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST['createNewFile']))
{
    session_start();
    createNewFile();
}
function createNewFile()
{
    $token = $_POST['token_new_file'];

    if (!$token || $token !== $_SESSION['token_new_file']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    } else {
        if (!empty($_POST["new_file_name"])) {

            $new_file_name = test_input($_POST["new_file_name"]);
            fopen($_SESSION['Username'].'/'. $new_file_name, "w");
            header("location: upload.php");
            exit();
        }else
            echo   "<a href=$upload_page_url   class='btn btn-primary'>" . "Back" . "</a>";
    }
}

if (isset($_POST['createNewFolder']))
{
    session_start();
    createNewFolder();
}
function createNewFolder()
{

//        $token = filter_input(INPUT_POST, 'token_upload', FILTER_SANITIZE_STRING);
    $token = $_POST['token_new_folder'];

    if (!$token || $token !== $_SESSION['token_new_folder']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    } else {

        if (!empty($_POST["new_folder_name"])) {

            $new_folder_name = test_input($_POST["new_folder_name"]);
            mkdir($_SESSION['Username'].'/'.$new_folder_name ,0700,true); //permissions are ignored on Windows.

            header("location: upload.php");
            exit();
        }else
            echo   "<a href=$upload_page_url   class='btn btn-primary'>" . "Back" . "</a>";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}