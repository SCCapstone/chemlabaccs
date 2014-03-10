<?php

$sections = get_sections();

$section = array(
    "id" => "section",
    "name" => "section",
    "placeholder" => "Section",
    "class" => "form-control"
    );

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
<!------------------------------------------------------------------------------------------------->
<script>
    function PreviewImage() {
         // This function creates a dynamic preview of images that are present in a files input buffer.
         // This function depends on Bootstrap 3.0 for styling of the thumbnail images. 
         // Created by Demetrious Cooper 2/12/2014 for Chemlabaccs USC Capstone Project
         
         // Initialize a variable "container" which contains the image preview area.
         var container = document.getElementById("preview_area");
         // ubound is the maximum amount of photos allowed to be upload. 
         // This bound can be set dynamically by using the function definition 
         // function PreviewImage(size);
      
         var ubound = 10;

        /**************************************************************/
        // Check to ensure that the length is less than of equal to our upper bound.
     
         var size = document.getElementById('filefield');
         if(size.files.length>ubound)
           {
           // If the link doesn't satisfy the bound constraints, then alert the user.
           alert("You May Select only 10 photos.");
           
           return false;
           
           }
       /**************************************************************/
       
        else  
        
        // we have satisfied the condtion ["size"]<=["upper bound"]
        //var previewbox = document.getElementById('preview_area');
        
         // Hide our button to prevent interruption from the user
         // Show our loader to show the user that the photos are preparing to show a preview
                   $(".btn").hide(10);
        $('#uploadbtn').hide(10);
        $('#linear_loader').show(10);

         
       // previewbox.removeAttribute("style");
         
        // Remove the style attribute to show the preview area.  
        // The preview area is set to hidden by default.
        
        container.removeAttribute("style");
        
        // Remove the inner HTML of our container to show the new 
        // elements in the file input buffer. 
        
        container.innerHTML = "";
        
        
        // Loop thru each element in the file input buffer and 
        // create a new "img" element.
        
        for(var i = 0;i<size.files.length;i++)
        {
        
        // Use the FileReader for html5 to read the contents of our input field. 
        
            var oFReader = new FileReader();
        
        // Reads the URL data for the input element. 
            oFReader.readAsDataURL(document.getElementById("filefield").files[i]);
                
        // On each load, the function will construct a new preview image.    
            oFReader.onload = function (oFREvent) {
                var new_div = document.createElement('div');
                new_div.setAttribute("id","dynamic_comment" );
                new_div.setAttribute("style","max-width:150px; margin-left:5px; margin-top:5px;");
                new_div.setAttribute("class","col-sm-4");

                var new_img = document.createElement('img');
                //new_img.setAttribute('id', 'img_preview');
                new_img.setAttribute('class', 'constrained_preview img-thumbnail row');
                //new_img.setAttribute('id',getElementById("filefield").files[i]);
                new_img.src = oFREvent.target.result;
                 
                // document.getElementById("imgpreview").src = oFREvent.target.result;
                var check = new_img.src;
                check = check.substr(5,9);
                
              if(check=="image/jpe" || check=="image/png" || check=="image/gif" || check=="image/jpeg")
            
             /*{
                container.appendChild(new_img);
             }*/
                {
                    var description_field = document.createElement('textarea');
                           description_field.setAttribute('placeholder',"Say Something!");
                            description_field.setAttribute('name',"dymanic_comment[]");
                            description_field.setAttribute('class',"row dynamic_comment");
                            description_field.setAttribute('type',"text");


                    
                    new_div.appendChild(new_img);
                    new_div.appendChild(description_field);
                    container.appendChild(new_div);
                }
             
           
            };                      
        }
         
         // Once the new image elements have been created, the upload button can be show again.
         // The linear loader is hidden
         //  again.  
        $('#uploadbtn').show(10);
        $('#linear_loader').hide(10);
        $(".btn").show(10);
   
    };// EOF PreviewImage(); 
</script>
<!------------------------------------ Javascript for custom upload area -------------------------->
<!------------------------------------------------------------------------------------------------->

<style>
    .formcs{
            width: auto !important;
            max-width: 980px;
                    margin:0 auto;

       
        }
    .constrained_preview{

        max-width: 150px;
        min-width: 150px;
        max-height: 150px !important;
        min-height: 150px !important;

        margin-bottom:5px;

    }
    .dynamic_comment{
        
       width: auto;
       min-width:150px;
       max-width: 150px;
       min-height:100px;
       padding:5px;
       max-height:200px !important;
       font-size: 12px;
       line-height:1.4em;
       font-color:#333;
       border-style: solid;
       border-color: #DDD;
       background-color: #f8f8f8;
       border-width: 1px;
       padding-bottom:5px;
       
        
    }
    textarea:focus
{
background-color:#fff;
} 
    #dymanic_comment{
       max-height:200px !important;
       width: 200px;
       margin-left: 10px;
        
    }
    #filefield{
        visibility: none;

    }
    
    .well{
        overflow:auto !important;
        padding:15px 12px;
        width:auto;
        min--width: 600px !important;
        
    }



</style>

<!------------------------------------------------------------------------------------------------->
<?php echo form_open_multipart("accidents/add/save", array("class" => "form-horizontal formcs", "role" => "form","encytype" =>"multipart/form-data")); ?>

<div class="form-group">
    <label for="<?php echo $section["id"]; ?>" class="col-sm-2 control-label"><?php echo $section["placeholder"]; ?></label>
    <div class="col-sm-10">
        <?php echo form_error($section["name"]); ?>
        <?php echo form_dropdown($section["name"], $sections, CI()->input->post($section["name"]), 'class="form-control" id="section"'); ?>
    </div>
</div>

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
        <?php $i = 0;
        foreach (array("Low", "Medium", "High") as $severity):
            ?>
            <?php
            $selected = "";
            if ($this->input->post("severity") == $severity) {
                $selected = 'checked="checked"';
            }
            ?>
            <div class="radio">
                <label>
                    <input type="radio" name="severity" id="severity_<?php echo $severity; ?>" value="<?php echo $severity; ?>" <?php echo $selected; ?>>
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

        <!------------------------------------------------Desktop Preview Area------------------------------------------------------------->
        <label>You may add up to 10 photos of the accident.</label>
        <div class="well" id="preview_area" style="display:none;" >

        </div>
        <span style="visibility:hidden;"><input type="file" name="filefield[]" id="filefield"  onchange="PreviewImage();" multiple="" accept="image/*"></span>



        <!------------------------------------------------------------------------------------------------------------------------>
        <!-------------------Custom Upload Button-------------------------->
        <div class="well well-sm">
            <div id ="uploadbtn" class="btn btn-primary"><span class="glyphicon glyphicon-camera" type="" method=""></span> Add Photos</div><div id="linear_loader" style="display:none;"><img src="../img/linear_loader.GIF"/></div>
            <!----------------------------------------------------------------->


            <script>

                document.querySelector('#uploadbtn').addEventListener('click', function(e) {
                    var fileInput = document.querySelector('#filefield');
                    //click(fileInput); // Simulate the click with a custom event.
                    fileInput.click(); // Or, use the native click() of the file input.
                }, false);

            </script>

        </div>
        <div class="row">
            <span style="float: right;"> <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-plus"></span> Add Report')); ?></span>
        </div>


<?php echo form_close(); ?>