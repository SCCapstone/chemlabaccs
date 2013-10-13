<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= APP_NAME ?> | <?= $title ?></title>
        <link rel="shortcut icon" href="img/favicon.png">
        <?= $_styles ?>
        <?= $_scripts ?>
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #eee;
            }
            .form-signin {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin .checkbox {
                font-weight: normal;
            }
            .form-signin .form-control {
                position: relative;
                font-size: 16px;
                height: auto;
                padding: 10px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
            .form-signin .form-control:focus {
                z-index: 2;
            }
            .form-signin input[type="text"] {
                margin-bottom: -1px;
                border-bottom-left-radius: 0;
                border-bottom-right-radius: 0;
            }
            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
        </style>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?= base_url() ?>/js/html5shiv.js"></script>
          <script src="<?= base_url() ?>/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <?= form_open('users/authenticate', array('class' => 'form-signin')); ?>
                <h2 class="form-signin-heading">Please sign in</h2>
                <?= $flash ?>
                <?php
                    echo form_input(array(
                        'name' => 'user_name',
                        'id' => 'user_name',
                        'class' => 'form-control',
                        'placeholder' => 'Username'
                    ));
                ?>
                <?php
                    echo form_password(array(
                        'name' => 'password',
                        'id' => 'password',
                        'class' => 'form-control',
                        'placeholder' => 'Password'
                    ));
                ?>
                <?php
                    echo form_submit(array(
                        'name' => 'sign-in',
                        'id' => 'sign-in',
                        'class' => 'btn btn-lg btn-primary btn-block',
                        'value' => 'Sign in'
                    ));
                ?>
            <?= form_close(); ?>
        </div>
    </body>
</html>
