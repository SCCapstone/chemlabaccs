<?php

$sectionID = array(
    "id" => "sectionID",
    "name" => "sectionID",
    "placeholder" => "Section ID #",
    "class" => "form-control",
    "value" => set_value("sectionID")
);

$sectionPassword = array(
    "id" => "sectionPassword",
    "name" => "sectionPassword",
    "placeholder" => "Section Password",
    "class" => "form-control",
    "value" => set_value("sectionPassword")
);

?>



<?php echo form_open_multipart("users/joinSection", array("class" => "form-horizontal", "role" => "form","encytype" =>"multipart/form-data")); ?>

 <div>
        <div class="well">
            <span><?php echo lang('cla_f_join'); ?></span>
        </div>
 </div>

<div class="form-group">
    <label for="<?php echo $sectionID["id"]; ?>" class="col-sm-2 control-label"><?php echo $sectionID["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($sectionID["name"]); ?>
        <?php echo form_input($sectionID); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $sectionPassword["id"]; ?>" class="col-sm-2 control-label"><?php echo $sectionPassword["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($sectionPassword["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_password($sectionPassword); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div>
        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-ok"></span> Join!')); ?>
        </div>
    </div>
</div>



<?php echo form_close(); ?>