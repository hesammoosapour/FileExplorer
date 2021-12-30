<?php include_once 'Include/header.php';?>
<div class="container-fluid">
    <?php
    session_start(); /* Starts the session */

    echo "Welcome " . $_SESSION['Username'] . " To Your Panel";

    ?>
    <!--   add csrf later -->
    <br><br>
    <form action="uploadfiles.php" method="post" enctype="multipart/form-data">
        Select File to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-light">
        <input type="submit" value="Upload File" name="submit" class="btn btn-success">
    </form>

    <!--    <div class="col-4">-->
    <!--        <form action="myfunctions.php" method="post">-->
    <!--            <p class="mt-3"><label for="newfilename"></label></p>-->
    <!--            <input type="text" name="newfilename" id="newfilename" value="" placeholder="Enter New File Name" class="form-control">-->
    <!--            <br>-->
    <!--            <input type="submit" class="btn btn-success" value="Create New File" name="submit_create_new_file">-->
    <!--        </form>-->
    <!--    </div>-->
    <br>
    <?php
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    ?>
    <?php
    //$content = scandir('.');
    //print_r($content);

    //    $dir = scandir('./'.$_SESSION['Username'].'/');
    //    echo strlen(strpos($CurPageURL, 'p=') + 2);
    //echo    $sub_dir = substr($CurPageURL , 0,);


    if (!empty(strpos($CurPageURL, 'p=') ))
    {
        $sub_dir = substr($CurPageURL , strpos($CurPageURL, 'p=') + 2);


        $dirPath = './'.$_SESSION['Username'].'/'.$sub_dir;

        $string_lenght_supper_path = strlen($CurPageURL) - strlen($sub_dir) - 3;
        $higher_path =  substr($CurPageURL, 0, $string_lenght_supper_path);

        echo   "<a href=$higher_path   class='btn btn-primary'>" . "Back" . "</a>";

    }else
        $dirPath = './'.$_SESSION['Username'].'';

//
//    $index = strpos($dirPath, "p=") + strlen($prefix);
//    $result = substr($string, $index);

    //    if (!empty(strpos($dirPath, '/') )) {
//        throw  new Exception('Wrong URL');
//    }

    if (isset($_GET['p']))
    {
        if (strpos($_GET['p'], '/') !== false || strpos($_GET['p'], '../') !== false ||
         strpos($_GET['p'], '..') !== false )
        {
            die("<br><h4 class=' badge-danger'>Wrong Request</h4>");

//            throw new Exception('Wrong URL');
        }

    }

    $dir = scandir($dirPath);

    foreach($dir as $index => $item)
    {
        if(is_dir($dirPath. '/' . $item))
        {
            $directories[] = $dir[$index];
            unset($dir[$index]);
        }
    }


    unset($directories[0], $directories[1]);

    foreach ( $directories as $directory){

//    foreach (glob('./'.$_SESSION['Username'].'/', GLOB_ONLYDIR) as $dir) {
//        $dirname = basename($dir);

//        $dir = substr($dir, 2);
        ?>
        <br>
        <a href="?p=<?= $directory ?>"  >
            <i class="fa fa-folder-o"></i> <?= $directory ?>
        </a>
        <!--        <br>-->
        <!--        <a href="?p=--><?//= $dir ?><!--"  >-->
        <!--            <i class="fa fa-folder-o"></i> --><?//= $dir ?>
        <!--        </a>-->

    <?php }  ?>


    <?php


    $files = array_values($dir);

    $base_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    foreach ($files as $file) { ?>
        <br>

        <?php
//        $url_file = $base_url .  "?p=&view=".$file;

        if(isset($_GET['view']) && $_GET['view'] == $file && !isset($_GET['p']))
        {
            //Define header information
            include 'Include/download-code.php';
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Length: ' . filesize($file));

//Clear system output buffer
//            flush();

//Read the size of the file
//            readfile($file);
        }
        if(isset($_GET['view']) && $_GET['view'] == $file && isset($_GET['p']) && $_GET['p']== $sub_dir)
        {
//            $file =   "personal_guest/" . $file;
            include 'Include/download-code.php';
//            header("Location: ".$CurPageURL);

//            $file = preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1);

//            fopen(urldecode($file));
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Length: ' . filesize($file));

        }?>
        <br>
        <?php
        if (!empty(strpos($CurPageURL, 'p=') )) {  ?>
            <a href="?view=<?= urlencode($file) ?>&amp;p=<?= urlencode($sub_dir) ?>"  name="link_file_<?=$file ?>" >
                <i class="fa fa-file"></i> <?= $file ?>
            </a>
        <?php }else { ?>
            <a href="?view=<?= $file ?>"  name="link_file_<?=$file ?>"  >
                <i class="fa fa-file"></i> <?= $file ?>
            </a>
        <?php } ?>

    <?php }  ?>


</div>


<footer class="footer text-center" style="top: 50px;right: 20px;position: absolute" >
    <a href="logout.php">Click here</a> to Logout.

</footer>
