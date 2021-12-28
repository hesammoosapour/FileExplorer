<?php define('APP_TITLE', 'My File Explorer'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>



</head>
<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="card fat ">
                    <div class="card-body">
                        <form class="form-signin" action="" method="post" autocomplete="off">
                            <div class="form-group">
                                <div class="brand"></div>
                                <div class="text-center">
                                    <h1 class="card-title"><?php echo APP_TITLE; ?></h1>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="fm_usr"></label>
                                <input type="text" class="form-control" id="fm_usr" name="fm_usr" required autofocus>
                            </div>

<!--                            <div class="form-group">-->
<!--                                <label for="fm_pwd"></label>-->
<!--                                <input type="password" class="form-control" id="fm_pwd" name="fm_pwd" required>-->
<!--                            </div>-->

                            <div class="form-group">

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block mt-4" role="button">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer text-center">
                    Powered By Hesam Moosapour
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
