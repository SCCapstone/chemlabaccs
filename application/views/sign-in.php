<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo APP_NAME ?> | <?php echo $title ?></title>
        <link rel="shortcut icon" href="<?php echo base_url("img/favicon.png") ?>">
        <?php echo $_styles ?>
        <?php echo $_scripts ?>
        <style type="text/css">
            body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	overflow: hidden;
            }
            .form-signin {
	/* [disabled]max-width: 330px; */
	padding: 5px;
	margin: 0 auto;
	width: 300px;
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
			     #sign_in_body_wrapper {
	background-position: center center !important;
	/* [disabled]background-repeat: no-repeat !important; */
	background-size: cover !important;
	left: 0px !important;
	overflow: hidden !important;
	/* [disabled]position: fixed !important; */
	/* [disabled]top: 100px !important; */
	width: 100% !important;
	background: url(../chemlab_graphics/home_blur_accent.jpg) no-repeat fixed 0% 0% transparent;
	padding-top: 100px;
	min-height: 768px;
	height: 100%;
	/* [disabled]min-width: 1000px; */
	margin-top: -20px;
}
        #lars_logo {
	width: 140px;
	height: 53px;
	margin: 0 auto;
}
        .white_text {
	font-size: 22px;
	font-family: helvetica, arial, san-serif;
	line-height: 22.7px;
	color: #ffffff;
	text-align: center;
}
        </style>
  
        </style>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url() ?>/js/html5shiv.js"></script>
          <script src="<?php echo base_url() ?>/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <div id="sign_in_body_wrapper">
      <div class="container">
        <p><?php echo form_open('users/authenticate', array('class' => 'form-signin')); ?></p>
        <div id="lars_logo"><img src="../chemlab_graphics/chemlab_logo.png" width="140" height="53" alt="lars logo">
        </div>
<h3 class="form-signin-heading white_text">Please sign-in or register</h3>
        <p><?php echo $flash ?>
          <?php
                    echo form_input(array(
                        'name' => 'user_name',
                        'id' => 'user_name',
                        'class' => 'form-control',
                        'placeholder' => 'Username',
                        'autofocus' => 'autofocus',
                        'type' => 'email'
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
                        'class' => 'btn btn-lg btn-success btn-block',
                        'value' => 'Sign In'                     
                    ));
                ?>
          
          
          <?php echo anchor("users/register", "Register", array("class" => "btn btn-lg btn-primary btn-block")); ?>
          
          
          <?php echo form_close(); ?>
        </p>
        <p>&nbsp;</p>
  </div>
    </div>
</body>
</html>
