
<script type="text/javascript">
      $(function() {
        
        $("#post_button").click(function(){
            // The content in the comment box
            
            var comCon = $("#comment_content").val();
              var newblock = document.createElement('a');
            
              newblock.setAttribute("class", "list-group-item")
              newblock.innerHTML= '<h5 class="list-group-item-heading"><b><?php echo $details->id; ?></b><small>      - Just Now</small></h5><p class="list-group-item-text"></p>'+comCon;
             var refid = $("#refid").val();
            
                var post_data = {
        'comment_content': comCon,'id': refid };



            // Serializing the comment content for posting comments 

            if(!comCon)
            {
              // If the comment box is empty, then a modal notification is displayed.  
             $('#notifyModal').modal('show'); 
            }



            else{
            

                $.ajax({
                     type: "POST",
                     url: "<?php echo base_url(); ?>accidents/comment",
                    data: post_data,
                   
                    success: function(){
             document.getElementById('comment_content').value=' ';
             var commentlist = document.getElementById('comment_list');
             commentlist.insertBefore(newblock,commentlist.childNodes[0])

             

                    }
                });
            } return false;
        });
    });

</script>

<script>
    $(document).ready(function(){
        // This function appends accident photos and their descrpitions to a modal component.  
       
        var showbox = document.getElementById('modal-body');

        $(".img-thumbnail").click(function(){
            
            var data = $(this).attr('data');
            var image_description = $(this).attr('data-description');
            var thumb_data = $(".img-thumbnail");
            var comment = document.getElementById('image-description');
            // thumb_data = document.getElementById("photobox").getAttribute("data");
            //var img = document.createElement("img");
            // img.src = thumbdata;
            showbox.innerHTML="<img src="+data+">";
            comment.innerHTML=image_description;
            

            $('#myModal').modal('show'); 
            //showbox.innerHTML="";

        });

        $('#edit-description').click(function(){
      
            var description = $(this).attr('id');
            var input=document.createElement("input");
    
            $('#image-description').hide();

 
  
        });
    });
</script>


<?php
$date = array(
    "id" => "date",
    "name" => "date",
    "placeholder" => "Date",
    "class" => "form-control",
    "value" => set_value("date", date_mysql2human($details->date))
);

$time = array(
    "id" => "time",
    "name" => "time",
    "placeholder" => "Time",
    "class" => "form-control",
    "value" => set_value("time", time_mysql2human($details->time))
);

<<<<<<< HEAD


=======
>>>>>>> 57e11cd6e9b036fe072fcbc1368ac72fa935ad57

$description = array(
    "id" => "description",
    "name" => "description",
    "placeholder" => "Description",
    "class" => "form-control",
    "rows" => 3,
    "value" => set_value("description", $details->description)
);

$root = array(
    "id" => "root",
    "name" => "root",
    "placeholder" => "Root",
    "class" => "form-control",
    "rows" => 3,
    "value" => set_value("root", $details->root)
);

$prevention = array(
    "id" => "prevention",
    "name" => "prevention",
    "placeholder" => "Prevention",
    "class" => "form-control",
    "rows" => 3,
    "value" => set_value("prevention", $details->prevention)
);
?>



<style>

  



</style>
<?php
/*
  $params = array($details->id);

  $this->load->library('gallerybuilder',$params);
 */
?>


<?php echo form_open("accidents/add/save", array("class" => "form-horizontal formcs hidden", "role" => "form")); ?>

<?php echo form_hidden("revision_of", $details->revision_of); ?>
<?php echo form_hidden("user", $details->user); ?>

<div class="form-group ">
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

<<<<<<< HEAD

=======
>>>>>>> 57e11cd6e9b036fe072fcbc1368ac72fa935ad57

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
foreach (array("low", "medium", "high") as $severity): ?>
    <?php
    $selected = "";
    if ($this->input->post("severity") == $severity || $details->severity == $severity) {
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
        <div class="well">
<?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => '<span class="glyphicon glyphicon-pencil"></span> Save')); ?>
        </div>
    </div>
</div>



*/
<?php echo form_close(); ?>


<!-----------------Detailed View---------------------->
<div class ="container formcs container_content">
    <!-------Time Information ----->
    <div class="panel panel-default" id = "time_info">
        <div class="panel-heading"><h4>Time</h4></div>
        <div class="panel-body">
            <b> Date: </b> <?php echo $date['value']; ?>
            <p></p>
            <b>Time:</b> <?php echo $time['value']; ?>
            <p></p>

        </div>
    </div>

<<<<<<< HEAD
    <!-----Building Information--->
=======
>>>>>>> 57e11cd6e9b036fe072fcbc1368ac72fa935ad57

    <!---- Accident Details---->

    <div class="panel panel-default" id = "accident_info">
        <div class="panel-heading"><h4>Accident Details</h4></div>
        <div class="panel-body">
            <b>Description: </b> <?php echo $description['value']; ?>
            <p></p>
            <b>Severity:</b> <?php echo severity_scale($severity); ?>
            <p></p>
            <b>Root Cause:</b> <?php echo $root['value']; ?>
            <p></p>
            <b>Prevention:</b> <?php echo $prevention['value']; ?>
            <p></p>
        </div>
    </div>

    <div class =" panel panel-default" id="photos">
        <div class="panel-heading"><h4>Accident Photos</h4></div>
        <div class="panel-body">

            <?php
            $params = array($details->id);

            $this->load->library('gallerybuilder', $params);
            ?>


        </div>
    </div>


</div>


<!-------------------------------------------------------------Notification Modal------------------------------>
<div class="modal fade" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="notifyModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Comment Box Is Empty</h4>
            </div>
            <div class="modal-body">
                <p>The comment box cannot be empty!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Got it!</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--------------------------------------------------------------Modal---------------------------------------------->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center> <h2><small> Photo Management</small></h2></center>

            </div>
            <div class="modal-body" id="modal-body">
            </div>
            <div class="modal-footer">
                <div class="content" id="image-description" style="float:left;">Our Description here.  This will go under the photos</div>
                <div class="hidden"> <textarea class="form-control" rows="3" placeholder="" value="Our Description here.  This will go under the photos"></textarea> <br/><input class="btn btn-primary" type="submit" value="Submit Changes" ></div><br/>
                <!----------------------------------------------------Toggle Edit Button------------------------------------------------------------------->

                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle hidden" data-toggle="dropdown">

                        <span class="glyphicon glyphicon-cog"></span><span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" id="edit-description"><span class="" ></span>  Edit Description</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Remove Photo</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------Modal Assets------------------------------------------------------------------->
<div class="comment_container container_content container">
    <h5><b>Accident Comments</b></h5>

    <!-----------------------------------------------Comments Area--------------------------------------------------------------------->
    <div class="comment_container_box" id ="comment_container_box" style="width:auto;padding:15px; background-color:#f5f5f5; border:1px solid #dddddd;">
      
        <form method="post" name="form" action="">
            <textarea class="form-control" rows="1" placeholder="What would you like to say?" id ="comment_content" onfocus="stateChange()" required></textarea>

    </div>
    <input type="submit" class="btn btn-primary" id="post_button" value="Post" style="margin-top:10px; float:right;  margin-bottom:10px;" />
    <input type="hidden" id="refid" name="refid" value="<?php echo $details->id ?>" />
</form>
<div class="horizontal_spacer" style="min-height:50px;"></div>
<?php
$accidentid = $details->id;

$params = array('accidentid' => $accidentid,
    'cmd' => 'print');

$this->load->library('commentmodule', $params);
?>  
</div>