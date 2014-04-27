
<?php
$section = array(
    "id" => "section",
    "name" => "section",
    "placeholder" => "Section ID #",
    "class" => "form-control",
    "value" => set_value("section", $details->section_id)
);

$sectionName = array(
    "id" => "sectionName",
    "name" => "sectionName",
    "placeholder" => "Section Name",
    "class" => "form-control",
    "value" => set_value("Name", $sectionInfo->name)
);

$term = array(
    "id" => "term",
    "name" => "term",
    "placeholder" => "Term",
    "class" => "form-control",
    "value" => set_value("term", $sectionInfo->Term)
);

$year = array(
    "id" => "year",
    "name" => "year",
    "placeholder" => "Year",
    "class" => "form-control",
    "value" => set_value("year", $sectionInfo->Year)
);

$building = array(
    "id" => "building",
    "name" => "building",
    "placeholder" => "building",
    "class" => "form-control",
    "value" => set_value("building", $sectionInfo->building_name)
);

$room = array(
    "id" => "room",
    "name" => "room",
    "placeholder" => "room",
    "class" => "form-control",
    "value" => set_value("roomg", $sectionInfo->room_num)
);

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
<script type="text/javascript">
    
    /*************************************************************************************************/
     
    // Function for deleting comments  
    function rmcomment (id) 
    // $(".delcmt").click(function()
    {
			  
        var comid =  id;
        var prompt=confirm('Are you sure you want to delete this comment?') ;
        if(prompt==true)
        {
            var thisuser = <?php echo get_userID(); ?>;
            var post_data = { 'thisuser': thisuser,'id': comid };
               
                
                
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>accidents/deletecomment",
                data: post_data,
                   
                success: function(){
                    var deletedcomment = document.getElementById('box'+comid);
                    var list = document.getElementById("comment_list");
                    list.removeChild(deletedcomment);
                }
            });
                      
        }
                      
        return false;
    }
    
    /*************************************************************************************************/
    



</script>
<script>
    // Created by D. Cooper 
    // Modified of 4/17/2014
    $(document).ready(function(){
     $('#dynamic_comments').load('<?php echo base_url() ?>accidents/getcomment/<?php echo $details->id ?>');
	   
        var auto_refresh = setInterval(
        function ()
        {
            $('#dynamic_comments').load('<?php echo base_url() ?>accidents/getcomment/<?php echo $details->id ?>').fadeIn("slow");
        }, 10000); // refresh every 10000 milliseconds

        /***********************************************************************/
        $("#post_button").click(function(){
            // The content in the comment box
            
            var comCon = $("#comment_content").val();
            var newblock = document.createElement('a');
            var delprompt = '<br/><span class="delcmt" comment-id="temp"><a href="#">Delete</a></span>';
            
            newblock.setAttribute("class", "list-group-item")
            newblock.innerHTML= '<h5 class="list-group-item-heading"><b><?php echo array_shift(explode('@', get_email())); ?></b>\n\
      <small- Just Now</small></h5><p class="list-group-item-text"></p>'+'<br/>'+comCon+'<br/>'+delprompt;
                  var refid = $("#refid").val();
            
                  var post_data = {
                      'comment_content': comCon,'id': refid };



                  // Serializing the comment content for posting comments 

                  if(!comCon  ||0=== comCon.length)
                  {
                      // If the comment box is empty, then a modal notification is displayed.  
                      $('#notifyModal').modal('show'); 
                  }



                  else{
            

                      $.ajax({
                          type: "POST",
                          url: "<?php echo base_url(); ?>accidents/comment",
                          data: post_data,
                   
                          success: function(data){
                              /* document.getElementById('comment_content').value=' ';
                              var commentlist = document.getElementById('comment_list');
                              commentlist.insertBefore(newblock,commentlist.childNodes[0])*/
                              $('#dynamic_comments').load('<?php echo base_url() ?>accidents/getcomment/<?php echo $details->id ?>');
                              document.getElementById('comment_content').value=' ';

                              
                          }
                      });
                  } 
                  return false;
              });
    
              $('.cancel_btn').click(function(){

                  $('.edit_form').hide();
                  $('.detail_form').show();

                  return false;

              });

              $('.edit_btn').click(function(){

                  $('.edit_form').show();
                  $('.detail_form').hide();

                  return false;

              }); 
   
              /*************************************************************************************************/

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
    .float-right{
        float:right;
        margin-top:-20px;
    } 
    .float-left{
        float:left;

    }
    clear-both{
        clear:both;
    }
</style>


<!-----------------Edit Button---------------------->
<div class ="container formcs container_content detail_form">
    <div class="row mar20 text-right"><p><?php echo anchor('accidents/edit/' . $details->id , '<span class="glyphicon glyphicon-pencil"></span> Edit', array("class" => "btn btn-primary btn-sm", "role" => "button")); ?>
                                         <?php echo anchor('accidents/delete/' . $details->id , '<span class="glyphicon glyphicon-remove-circle"></span> Delete', array('onClick' => "return confirm('Are you sure you want to delete this Accident Report?');", 'class' => "btn btn-danger btn-sm", 'role' => "button")); ?></p></div> 


    <!-------Section Information ----->
    <div class="panel panel-default" id = "section_info">
        <div class="panel-heading">
            <h4>General</h4>
        </div>

        <div class="panel-body">
            <b> Section ID #: </b> <?php echo $section['value']; ?>
            <p></p>
            <b>Section Name: </b> <?php echo $sectionName['value']; ?>
            <p></p>
            <p></p>
            <b>Term: </b> <?php echo $term['value']; ?> - <?php echo $year['value']; ?>
            <p></p>
            <p></p>
            <b>Building: </b> <?php echo $building['value']; ?>
            <p></p>
            <p></p>
            <b>Room: </b> <?php echo $room['value']; ?>
            <p></p>

        </div>
    </div>



    <!-------Time Information ----->
    <div class="panel panel-default" id = "time_info">
        <div class="panel-heading">
            <h4>Time</h4>
        </div>

        <div class="panel-body"> <b> Date: </b> <?php echo $date['value']; ?>
            <p></p>
            <b>Time:</b> <?php echo $time['value']; ?>
            <p></p>






        </div>
    </div>



    <!---- Accident Details---->

    <div class="panel panel-default" id = "accident_info">
        <div class="panel-heading">
            <h4>Accident Details</h4>
        </div>
        <div class="panel-body"> <b>Description: </b> <?php echo $description['value']; ?>
            <p></p>
            <b>Severity:  </b> <?php echo $details->severity; ?>
            <p></p>
            <b>Root Cause:  </b> <?php echo $root['value']; ?>
            <p></p>
            <b>Prevention:  </b> <?php echo $prevention['value']; ?>
            <p></p>
        </div>
    </div>
    <div class =" panel panel-default" id="photos">
        <div class="panel-heading">
            <h4>Accident Photos</h4>
        </div>
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
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!--------------------------------------------------------------Modal---------------------------------------------->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center>
                    <h2><small> Photo Management</small></h2>
                </center>
            </div>
            <div class="modal-body" id="modal-body"> </div>
            <div class="modal-footer">
                <div class="content" id="image-description" style="float:left;">Our Description here.  This will go under the photos</div>
                <div class="hidden">
                    <textarea class="form-control" rows="3" placeholder="" value="Our Description here.  This will go under the photos"></textarea>
                    <br/>
                    <input class="btn btn-primary" type="submit" value="Submit Changes" >
                </div>
                <br/>
                <!----------------------------------------------------Toggle Edit Button-------------------------------------------------------------------> 

                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle hidden" data-toggle="dropdown"> <span class="glyphicon glyphicon-cog"></span><span class="caret"></span> </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" id="edit-description"><span class="" ></span> Edit Description</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Remove Photo</a></li>
                    </ul>
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
/* $accidentid = $details->id;

  $params = array('accidentid' => $accidentid,
  'cmd' => 'print');

  $this->load->library('commentmodule', $params);
 */
?>
<div id = "dynamic_comments"></div>

    </div>
</div>

