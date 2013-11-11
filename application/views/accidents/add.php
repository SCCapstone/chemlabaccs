<?php

$date = array(
    "id" => "date",
    "name" => "date",
    "placeholder" => "Date"
);

$time = array(
    "id" => "time",
    "name" => "time",
    "placeholder" => "Time"
);

$building = array(
    "id" => "building",
    "name" => "building",
    "placeholder" => "Building"
);

$room = array(
    "id" => "room",
    "name" => "room",
    "placeholder" => "Room"
);

$description = array(
    "id" => "description",
    "name" => "description",
    "placeholder" => "Description"
);

$root = array(
    "id" => "root",
    "name" => "root",
    "placeholder" => "Root"
);

$prevention = array(
    "id" => "prevention",
    "name" => "prevention",
    "placeholder" => "Prevention"
);

?>

<?php echo form_open("accident/add/save", array("class" => "form-horizontal", "role" => "form")); ?>

<div class="form-group">
    <label for="<?php echo $date["id"]; ?>" class="col-sm-2 control-label"><?php echo $date["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($date["name"]); ?>
        <input type="text" class="form-control" id="<?php echo $date["id"]; ?>" name="<?php echo $date["id"]; ?>" placeholder="<?php echo $date["placeholder"]; ?>">
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $time["id"]; ?>" class="col-sm-2 control-label"><?php echo $time["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($time["name"]); ?>
        <input type="text" class="form-control" id="<?php echo $time["id"]; ?>" name="<?php echo $time["id"]; ?>" placeholder="<?php echo $time["placeholder"]; ?>">
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $building["id"]; ?>" class="col-sm-2 control-label"><?php echo $building["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($building["name"]); ?>
        <input type="text" class="form-control" id="<?php echo $building["id"]; ?>" name="<?php echo $building["id"]; ?>" placeholder="<?php echo $building["placeholder"]; ?>">
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $room["id"]; ?>" class="col-sm-2 control-label"><?php echo $room["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($room["name"]); ?>
        <input type="text" class="form-control" id="<?php echo $room["id"]; ?>" name="<?php echo $room["id"]; ?>" placeholder="<?php echo $room["placeholder"]; ?>">
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $description["id"]; ?>" class="col-sm-2 control-label"><?php echo $description["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($description["name"]); ?>
        <textarea class="form-control" id="<?php echo $description["id"]; ?>" name="<?php echo $description["id"]; ?>" placeholder="<?php echo $description["placeholder"]; ?>"></textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Severity</label>
    <div class="col-sm-10">
        <?php echo form_error("severity"); ?>
        <?php foreach(array("low", "medium", "high") as $severity): ?>
        <div class="radio">
        <label>
            <input type="radio" name="severity" id="severity_<?php echo $severity; ?>" value="<?php echo $severity; ?>">
            <?php echo $severity; ?>
        </label>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $root["id"]; ?>" class="col-sm-2 control-label"><?php echo $root["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($root["name"]); ?>
        <textarea id="<?php echo $root["id"]; ?>" name="<?php echo $root["id"]; ?>" placeholder="<?php echo $root["placeholder"]; ?>" class="form-control"></textarea>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $prevention["id"]; ?>" class="col-sm-2 control-label"><?php echo $prevention["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($prevention["name"]); ?>
        <textarea class="form-control" id="<?php echo $prevention["id"]; ?>" name="<?php echo $prevention["id"]; ?>" placeholder="<?php echo $prevention["placeholder"]; ?>"></textarea>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo form_submit(array("class" => "btn btn-default", "value" => "Add")); ?>
    </div>
</div>

<?php echo form_close(); ?>