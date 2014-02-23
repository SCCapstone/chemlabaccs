<?php

$start_date = array(
    "id" => "start_date",
    "name" => "start_date",
    "placeholder" => "Start Date",
    "class" => "form-control",
    "value" => set_value("start_date"),
    "type" => "date"
);

$end_date = array(
    "id" => "end_date",
    "name" => "end_date",
    "placeholder" => "End Date",
    "class" => "form-control",
    "value" => set_value("end_date"),
    "type" => "date"
);

$start_time = array(
    "id" => "start_time",
    "name" => "start_time",
    "placeholder" => "Start Time",
    "class" => "form-control",
    "value" => set_value("start_time"),
    "type" => "time"
);

$end_time = array(
    "id" => "end_time",
    "name" => "end_time",
    "placeholder" => "End Time",
    "class" => "form-control",
    "value" => set_value("end_time"),
    "type" => "time"
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

<?php echo form_open("accidents/results", array("class" => "form-horizontal", "role" => "form")); ?>

<div class="form-group">
    <label for="<?php echo $start_date["id"]; ?>" class="col-sm-2 control-label"><?php echo $start_date["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($start_date["name"]); ?>
        <?php echo form_input($start_date); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $end_date["id"]; ?>" class="col-sm-2 control-label"><?php echo $end_date["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($end_date["name"]); ?>
        <?php echo form_input($end_date); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $start_time["id"]; ?>" class="col-sm-2 control-label"><?php echo $start_time["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($start_time["name"]); ?>
        <?php echo form_input($start_time); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $end_time["id"]; ?>" class="col-sm-2 control-label"><?php echo $end_time["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($end_time["name"]); ?>
        <?php echo form_input($end_time); ?>
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
        <div class="checkbox">
            <label>
                <input type="checkbox" name="severity[]" id="severity_<?php echo $severity; ?>" value="<?php echo $severity; ?>" <?php echo $selected; ?>>
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
        <div class="well">
        <?php echo form_button(array(
            "type" => "submit",
            "class" => "btn btn-success",
            "content" => '<span class="glyphicon glyphicon-search"></span> Search'
        )); ?>
        </div>
    </div>
</div>

<?php echo form_close(); ?>