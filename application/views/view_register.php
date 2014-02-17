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
        <div class="well">
        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-ok"></span> Register')); ?>
        </div>
    </div>
</div>



<?php echo form_close(); ?>