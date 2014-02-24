<?php

$sectionName = array(
    "id" => "sectionName",
    "name" => "sectionName",
    "placeholder" => "Section Name",
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

$term = array(
    "id" => "term",
    "name" => "term",
    "placeholder" => "Term",
    "class" => "form-control",
    "value" => set_value("term")
    );

$year = array(
    "id" => "year",
    "name" => "year",
    "placeholder" => "Year",
    "class" => "form-control",
    "value" => set_value("year"),
    "type" => "year"
    );

$building = array(
    "id" => "building",
    "name" => "building",
    "placeholder" => "Building Name",
    "class" => "form-control",
    "value" => set_value("building")
    );

$room = array(
    "id" => "room",
    "name" => "room",
    "placeholder" => "Room #",
    "class" => "form-control",
    "value" => set_value("room")
    );

?>


<?php echo form_open_multipart("sections/createSection", array("class" => "form-horizontal", "role" => "form","encytype" =>"multipart/form-data")); ?>

<div class="form-group">
    <label for="<?php echo $sectionName["id"]; ?>" class="col-sm-2 control-label"><?php echo $sectionName["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($sectionName["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_input($sectionName); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $sectionPassword["id"]; ?>" class="col-sm-2 control-label"><?php echo $sectionPassword["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($sectionPassword["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_input($sectionPassword); ?>
        <div class="help-block"<p>For use by users when joining section.</p></div>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $term["id"]; ?>" class="col-sm-2 control-label"><?php echo $term["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($term["name"]); ?>
        <?php echo form_dropdown($term["name"], get_terms(), CI()->input->post($term["name"]), 'class="form-control" id="section"'); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $year["id"]; ?>" class="col-sm-2 control-label"><?php echo $year["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($year["name"]); ?>
        <?php echo form_dropdown($year["name"], get_years(), CI()->input->post($year["name"]), 'class="form-control" id="section"'); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $building["id"]; ?>" class="col-sm-2 control-label"><?php echo $building["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($building["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_input($building); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $room["id"]; ?>" class="col-sm-2 control-label"><?php echo $room["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($room["name"], '<div class="error">', '</div>'); ?>
        <?php echo form_input($room); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div class="well">
        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-ok"></span> Create Section')); ?>
        </div>
    </div>
</div>



<?php echo form_close(); ?>