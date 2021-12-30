<?php include_once 'include.php';?>
<?php
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ?
    "https://" : "http://";

$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (isset($url))
{
    if (strpos($url, '/') !== false || strpos($url, '../') !== false ||
        strpos($url, '..') !== false )
    {

        die("<br><h4 class=' badge-danger'>Wrong Request</h4>
             <a href='index.php' type='button' class='btn btn-primary'>Back</a>");

//            throw new Exception('Wrong URL');
    }

}

?>

<?php define('APP_TITLE', 'My File Explorer'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My File Explorer</title>



</head>
<body>

<section class="h-100 mt-5">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="card fat ">
                    <div class="card-body">
                        <form class="form-signin" action="login.php" method="post" autocomplete="off">
                            <div class="form-group">
                                <div class="brand"></div>
                                <div class="text-center">
                                    <h1 class="card-title"><?php echo APP_TITLE; ?></h1>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="Username"></label>
                                <input type="text" class="form-control"  name="Username" placeholder="Username" required autofocus>
                            </div>

                            <div class="form-group">

                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block mt-4" role="button" value="Send" name="submit_login_form">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer text-center" style="bottom: 20px;position: absolute">
                    Powered By Hesam Moosapour
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
