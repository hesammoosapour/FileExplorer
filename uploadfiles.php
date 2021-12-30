<?php
include 'Include/header.php';
include 'myfunctions.php';
session_start();
if(isset($_FILES['fileToUpload'])){

    $errors= array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size =$_FILES['fileToUpload']['size'];
    $file_tmp =$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
//    $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));

    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $extensions= array("jpeg","jpg","png",'pdf','docx');

    if(in_array($file_ext,$extensions)=== false){
        $errors[]="Extension not allowed, please choose a JPEG , jpg, png, pdf, docx file.";
    }

    if($file_size > 2097152){
        $errors[]='File size must be less than 2 MB';
    }


//    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    $token = $_POST['token_upload'];

    if (!$token || $token !== $_SESSION['token_upload']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    } else {


        if(empty($errors)==true){
            move_uploaded_file($file_tmp,$_SESSION["Username"].'/'.$file_name);
            header("location: upload.php ") ;
        }else{
            foreach ($errors as $error) {
                echo "<h4 class=' badge-danger'>$error</h4>";
            }

            echo   "<a href=$upload_page_url   class='btn btn-primary'>" . "Back" . "</a>";

//        throw new Exception($errors );
        }
    }


}
?>