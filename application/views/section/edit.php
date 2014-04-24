<?php


$sectionName = array(
    "id" => "sectionName",
    "name" => "sectionName",
    "placeholder" => "Section Name",
    "class" => "form-control",
    "value" => $name
);

$sectionPassword = array(
    "id" => "sectionPassword",
    "name" => "sectionPassword",
    "placeholder" => "Section Password",
    "class" => "form-control",
    "value" => $password
);

$secTerm = array(
    "id" => "secTerm",
    "name" => "secTerm",
    "placeholder" => "Term",
    "class" => "form-control",
    "value" => $Term
    );

$secYear = array(
    "id" => "secYear",
    "name" => "secYear",
    "placeholder" => "Year",
    "class" => "form-control",
    "value" => $Year,
    );

$building = array(
    "id" => "building",
    "name" => "building",
    "placeholder" => "Building Name",
    "class" => "form-control",
    "value" => $building_name
    );

$room = array(
    "id" => "room",
    "name" => "room",
    "placeholder" => "Room #",
    "class" => "form-control",
    "value" => $room_num
    );


$years = get_years();

while($yr = current($years)) {
    
    if ($yr == $Year) {
        $yearIndex = key($years);
    }
    
    next($years);
 
}


$terms = get_terms();
$j = 0;
$termIndex = 0;
foreach($terms as $t) {
    
    if ($t == $Term) {
        $termIndex = $j;
    }
    
    $j = $j +1;
    
}





?>


<?php echo form_open_multipart("sections/edit/" . $id, array("class" => "form-horizontal", "role" => "form","encytype" =>"multipart/form-data")); ?>

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
    <label for="<?php echo $secTerm["id"]; ?>" class="col-sm-2 control-label"><?php echo $secTerm["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($secTerm["name"]); ?>
        <?php echo form_dropdown($secTerm["name"], get_terms(), $termIndex, 'class="form-control" id="section"'); ?>
    </div>
</div>

<div class="form-group">
    <label for="<?php echo $secYear["id"]; ?>" class="col-sm-2 control-label"><?php echo $secYear["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($secYear["name"]); ?>
        <?php echo form_dropdown($secYear["name"], get_years(), $Year, 'class="form-control" id="section"'); ?>
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
        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-ok"></span> Update Section')); ?>
        </div>
    </div>
</div>



<?php echo form_close(); ?>