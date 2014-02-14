<?php

$email = array(
    "id" => "email",
    "name" => "email",
    "placeholder" => "Email",
    "class" => "form-control"
);

$password = array(
    "id" => "password",
    "name" => "password",
    "placeholder" => "Password",
    "class" => "form-control"
);

$passwordconf = array(
    "id" => "password",
    "name" => "password",
    "placeholder" => "Password Confirmation",
    "class" => "form-control"
);


?>


<?php echo form_open("users/register/save", array("class" => "form-horizontal", "role" => "form")); ?>

<div class="form-group">
    <label for="<?php echo $email["id"]; ?>" class="col-sm-2 control-label"><?php echo $email["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($email["name"],'<span class="help-inline error">', '</span>'); ?>
        <?php echo form_input($email); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $password["id"]; ?>" class="col-sm-2 control-label"><?php echo $password["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($password["name"]); ?>
        <?php echo form_input($password); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $passwordconf["id"]; ?>" class="col-sm-2 control-label"><?php echo $passwordconf["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($passwordconf["name"]); ?>
        <?php echo form_input($passwordconf); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div class="well">
        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-plus"></span> Register')); ?>
        </div>
    </div>
</div>

<?php echo form_close(); ?>