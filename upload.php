<?php include_once 'include.php';?>
<div class="container-fluid">
    <?php
    session_start(); /* Starts the session */

    echo "Welcome " . $_SESSION['Username'] . " To Your Panel";

    ?>
    <!--   add csrf later -->
    <br><br>
    <a href="logout.php">Click here</a> to Logout.

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
    //$content = scandir('.');
    //print_r($content);

//    $dir = scandir('./'.$_SESSION['Username'].'/');
    $dirPath = './'.$_SESSION['Username'];

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
