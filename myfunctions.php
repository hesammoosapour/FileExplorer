<?php
function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createNewFile()
{
    if(isset($_POST['submit_create_new_file'])) {

    }
}

function createNewFolder()
{
    if(isset($_POST['createNewFolder'])) {

        $token = filter_input(INPUT_POST, 'token_upload', FILTER_SANITIZE_STRING);

        if (!$token || $token !== $_SESSION['token_upload']) {
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        } else {
            mkdir("test");
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}