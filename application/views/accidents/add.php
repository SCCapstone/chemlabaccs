<?php

$date = array(
    "id" => "date",
    "name" => "date",
    "placeholder" => "Date",
    "class" => "form-control",
    "value" => set_value("date"),
    "type" => "date"
);

$time = array(
    "id" => "time",
    "name" => "time",
    "placeholder" => "Time",
    "class" => "form-control",
    "value" => set_value("time"),
    "type" => "time"
);

$building = array(
    "id" => "building",
    "name" => "building",
    "placeholder" => "Building",
    "class" => "form-control"
);

$room = array(
    "id" => "room",
    "name" => "room",
    "placeholder" => "Room",
    "class" => "form-control",
    "value" => set_value("room")
);

$description = array(
    "id" => "description",
    "name" => "description",
    "placeholder" => "Description",
    "class" => "form-control",
    "rows" => 3,
    "value" => set_value("description")
);

$root = array(
    "id" => "root",
    "name" => "root",
    "placeholder" => "Root",
    "class" => "form-control",
    "rows" => 3,
    "value" => set_value("root")
);

$prevention = array(
    "id" => "prevention",
    "name" => "prevention",
    "placeholder" => "Prevention",
    "class" => "form-control",
    "rows" => 3,
    "value" => set_value("prevention")
);

?>

<?php echo form_open("accidents/add/save", array("class" => "form-horizontal", "role" => "form")); ?>

<div class="form-group">
    <label for="<?php echo $date["id"]; ?>" class="col-sm-2 control-label"><?php echo $date["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($date["name"]); ?>
        <?php echo form_input($date); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $time["id"]; ?>" class="col-sm-2 control-label"><?php echo $time["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($time["name"]); ?>
        <?php echo form_input($time); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $building["id"]; ?>" class="col-sm-2 control-label"><?php echo $building["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($building["name"]); ?>
        <?php echo form_dropdown($building["name"], get_buildings(true), CI()->input->post($building["name"]), 'class="form-control" id="building"'); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $room["id"]; ?>" class="col-sm-2 control-label"><?php echo $room["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($room["name"]); ?>
        <?php echo form_input($room); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $description["id"]; ?>" class="col-sm-2 control-label"><?php echo $description["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($description["name"]); ?>
        <?php echo form_textarea($description); ?>
        <span class="help-block"><?php echo lang('cla_f_description'); ?></span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Severity</label>
    <div class="col-sm-10">
        <?php echo form_error("severity"); ?>
        <?php $i = 0; foreach(array("low", "medium", "high") as $severity): ?>
        <?php
        
        $selected = "";
        if ($this->input->post("severity") == $severity) {
            $selected = 'checked="checked"';
        }
        
        ?>
        <div class="radio">
            <label>
                <input type="radio" name="severity" id="severity_<?php echo $severity; ?>" value="<?php echo $severity; ?>" <?php echo $selected; ?>>
                <?php echo severity_scale($severity); ?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $root["id"]; ?>" class="col-sm-2 control-label"><?php echo $root["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($root["name"]); ?>
        <?php echo form_textarea($root); ?>
        <span class="help-block"><?php echo lang('cla_f_root'); ?></span>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $prevention["id"]; ?>" class="col-sm-2 control-label"><?php echo $prevention["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($prevention["name"]); ?>
        <?php echo form_textarea($prevention); ?>
        <span class="help-block"><?php echo lang('cla_f_prevention'); ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-plus"></span> Add')); ?>
    </div>
</div>

<?php echo form_close(); ?>