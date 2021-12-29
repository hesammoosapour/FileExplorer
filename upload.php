<?php include_once 'include.php';?>
<div class="container-fluid">
    <?php
    session_start(); /* Starts the session */

    echo "Welcome " . $_SESSION['Username'] . " To Your Panel";

    ?>
    <!--   add csrf later -->
    <br><br>

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
         $supper_path =  substr($CurPageURL, 0, $string_lenght_supper_path);

         echo   "<a href=$supper_path   class='btn btn-primary'>" . "Back" . "</a>";

     }else
         $dirPath = './'.$_SESSION['Username'].'';


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

    foreach ($files as $file) { ?>
        <br>
        <a href="?p=&view=<?= $file ?>"  >
            <i class="fa fa-file"></i> <?= $file ?>
        </a>

    <?php }  ?>


</div>


<footer class="footer text-center" style="top: 50px;right: 20px;position: absolute" >
    <a href="logout.php">Click here</a> to Logout.

</footer>
