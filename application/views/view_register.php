<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo APP_NAME ?> | <?php echo $title ?></title>
        <link rel="shortcut icon" href="img/favicon.png">
        <?php echo $_styles ?>
        <?php echo $_scripts ?>
<style>
body{
	
	margin:0px;
	padding:0px;
	overflow:hidden;

}
h3{
	margin:10px;
	padding:0px;
}
.form-horizontal{
	margin-left:100px;
	
	}
.control-label{
	font-size:12px;
	color:#333;
	display:none;
}
.error{
	  color: #b94a48;
 // background-color: #f2dede;
  //border-color: #eed3d7;
  margin-bottom:10px;
  padding:2px;
  border-radius:3px;
  font-weight:600;
}
.btn{
	width:100%;
	margin-left:-100px;
}
.shadow{
	
	-webkit-transition:background 0.2s linear;
	transition:background 0.2s linear;
	border-radius:3px;
	box-shadow:0 0 1px rgba(0, 0, 0, 0.33) inset;
	bottom:0;
	left:0;
	position:absolute;
	right:0;
	top:0;
	z-index:100;

}
.container{
	width:100% !important;
}
        
		
		#lars_logo {
	width: 140px;
	height: 53px;
	margin: 0 auto;
	/* [disabled]margin-bottom:30px; */
}


.navbar
{
	display:none;
}
			     #register_body_wrapper {
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
	height: 100%;
	/* [disabled]min-width: 1000px; */
}
#registration_container {
	width: 50%;
	margin: 0 auto;
	padding: 30px 20px;
	background-color: #F9FAFB;
	border-radius: 4px;
	font-size:12px !important;
}
</style>
<?php

$email = array(
    "id" => "email",
    "name" => "email",
    "placeholder" => "Email",
    "class" => "form-control",
    "value" => set_value("email")
);

$password = array(
    "id" => "password",
    "name" => "password",
    "placeholder" => "Password",
    "class" => "form-control",
    "value" => set_value("password")
);

$passwordconf = array(
    "id" => "passwordconf",
    "name" => "passwordconf",
    "placeholder" => "Password Confirmation",
    "class" => "form-control",
    "value" => set_value("passwordconf")
);

$level = array(
    "id" => "level",
    "name" => "level",
    "placeholder" => "Account Type",
    "class" => "form-control",
    "value" => set_value("level")
);

?>
<body>

<div id="register_body_wrapper" class="shadow">
<br/>
<div id="registration_container">
  <h3>Register with Email </h3>
  <hr>

  
  <?php echo form_open_multipart("users/register", array("class" => "form-horizontal", "role" => "form","encytype" =>"multipart/form-data")); ?>
    
    <div class="form-group">
      <label for="<?php echo $email["id"]; ?>" class="col-sm-2 control-label"><?php echo $email["placeholder"]; ?></label>
      <div class="col-sm-10">
        <?php echo form_error($email["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_input($email); ?>
        </div>
    </div>
    
    <div class="form-group">
      <label for="<?php echo $password["id"]; ?>" class="col-sm-2 control-label"><?php echo $password["placeholder"]; ?></label>
      <div class="col-sm-10">
        <?php echo form_error($password["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_password($password); ?>
        </div>
    </div>
    
    <div class="form-group">
      <label for="<?php echo $passwordconf["id"]; ?>" class="col-sm-2 control-label"><?php echo $passwordconf["placeholder"]; ?></label>
      <div class="col-sm-10">
        <?php echo form_error($passwordconf["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_password($passwordconf); ?>
        </div>
    </div>
    
    
    <div class="form-group">
      <label for="<?php echo $level["id"]; ?>" class="col-sm-2 control-label"><?php echo $level["placeholder"]; ?></label>
      <div class="col-sm-10">
        <?php echo form_error($level["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_radio($level["name"], 'admin', false), ' <b>Administrator</b>  (create your own reporting system)'; ?>
        <?php echo "</br>"; ?>
        <?php echo form_radio($level["name"], 'user', false), ' <b>User</b>  (join an existing reporting system)'; ?>
        </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
          <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-ok"></span> Register')); ?>
        </div>
    </div>
    
    
    
    <?php echo form_close(); ?></div>
</div>
  </body>
  </html>

