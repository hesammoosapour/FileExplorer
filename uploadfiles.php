<?php
include 'include.php';
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

    if(empty($errors)==true){
        move_uploaded_file($file_tmp,$_SESSION["Username"].'/'.$file_name);
        header("location: upload.php ") ;
    }else{
        foreach ($errors as $error) {
            echo "<h4 class=' badge-danger'>$error</h4>";
        }
        $upload_page_url = 'http://localhost/FileExplorer/upload.php';

        echo   "<a href=$upload_page_url   class='btn btn-primary'>" . "Back" . "</a>";

//        throw new Exception($errors );
    }
}
?>