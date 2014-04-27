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

<style>
.mar20 {
	margin-bottom: 20px;
	margin-right:5px;
}
.mar10left{
	margin-left:10px;
}
.edit_form{
	display:none;
}
</style>




  

    <div >
      <p><b>ID #: </b> <?php echo $sectionInfo->id; ?></p>
      
      <p><b>Name: </b> <?php echo $sectionInfo->name; ?></p>
      
      <p><b>Password: </b> <?php echo $sectionInfo->password; ?></p>
      
      <p><b>Term: </b> <?php echo $sectionInfo->Term; ?> - <?php echo $sectionInfo->Year; ?></p>
      
      <p><b>Building: </b> <?php echo $sectionInfo->building_name; ?></p>
      
      <p><b>Room: </b> <?php echo $sectionInfo->room_num; ?></p>


<p><?php echo anchor('sections/edit/' . $sectionInfo->id , '<span class="glyphicon glyphicon-pencil"></span> Edit', array("class" => "btn btn-primary btn-sm", "role" => "button")); ?> </p>
<p><?php echo anchor('sections/delete/' . $sectionInfo->id , '<span class="glyphicon glyphicon-remove-circle"></span> Delete', array('onClick' => "return confirm('Are you sure you want to delete this Section?');", "class" => "btn btn-danger btn-sm", "role" => "button")); ?> </p>

    </div>
  