<!doctype html>
<html lang="en">
<title><?= APP_TITLE ?></title>

<?php include_once 'Include/header.php'; ?>
<?php
// If logged in then redirecting to upload page
if (isset($_SESSION['Username']))
    header('Location:' . 'http://' .$_SERVER['HTTP_HOST']. '/'. APP_TITLE . '/upload.php' );

?>

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
