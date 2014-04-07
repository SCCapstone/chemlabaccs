<?php

$sections = array("All of My Sections", get_sections());

$section = array(
    "id" => "section",
    "name" => "section",
    "placeholder" => "Section",
    "class" => "form-control"
    );

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


?>

<?php echo form_open("accidents/results", array("class" => "form-horizontal", "role" => "form")); ?>

<div class="form-group">
    <label for="<?php echo $section["id"]; ?>" class="col-sm-2 control-label"><?php echo $section["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($section["name"]); ?>
        <?php echo form_dropdown($section["name"], $sections, CI()->input->post($section["name"]), 'class="form-control" id="section"'); ?>
    </div>
</div>

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
    <label class="col-sm-2 control-label">Severity</label>
    <div class="col-sm-10">
        <?php echo form_error("severity"); ?>
        <?php $i = 0; foreach(array("Low", "Medium", "High") as $severity): ?>
        <?php
        
        $selected = "";
        if ($this->input->post("severity") == $severity) {
            $selected = 'checked="checked"';
        }
        
        ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="severity[]" id="severity_<?php echo $severity; ?>" value="<?php echo $severity; ?>" <?php echo $selected; ?>>
                <?php echo $severity; ?>
            </label>
        </div>
        <?php endforeach; ?>
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