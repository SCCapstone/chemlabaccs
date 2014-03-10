<div class="row">
    <h3>
        <div class="label-danger">
            <div align="center">
                <font color ="white"><b>Admin Account</b></font>
            </div>
        </div>
    </h3>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Reporting</h3>
  </div>
  <div class="panel-body">

    <div class="row">
        <div class="col-md-4">
            <h2>Add Accident Report</h2>
            <p>Add an accident report.</p>
            <p><?php echo anchor("accidents/add", '<span class="glyphicon glyphicon-plus"></span> Go', array("class" => "btn btn-primary", "role" => "button")); ?></p>
        </div>
        <div class="col-md-4">
            <h2>Search Accident Reports</h2>
            <p>Search for accident reports.</p>
            <p><?php echo anchor("accidents/search", '<span class="glyphicon glyphicon-search"></span> Go', array("class" => "btn btn-primary", "role" => "button")); ?></p>
        </div>
        <div class="col-md-4">
            <h2>My Accident Reports</h2>
            <p>View accident reports you have submitted.</p>
            <p><?php echo anchor("reports/mine", '<span class="glyphicon glyphicon-list"></span> Go', array("class" => "btn btn-primary", "role" => "button")); ?></p>
        </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">Your Account</h3>
          </div>
          <div class="panel-body">
              <p> <?php echo anchor("sections/createSection", '<span class="glyphicon glyphicon-plus"></span> Create a Section', array("class" => "btn btn-success", "role" => "button")); ?> </p>
              <p> <?php echo anchor('users/signout', '<span class="glyphicon glyphicon-user"></span> Sign Out', array("class" => "btn btn-warning", "role" => "button")); ?></p>
          </div>
        </div>
    </div>    
    
    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Your Sections</h3>
          </div>
          <div class="panel-body">
              
              
              <div class="col-md-6">
                  <u><b>Name</b></u> <br>
                <?php 

               $row = $this->_section->get_sections();
               
               $ids = $this->_section->get_sections_ids();
               
               $curID = current($ids);

                      foreach($row as $sec) {
                          
                         echo '<a href="../accidents/sectionResults/'.$curID.'">' . $sec . '</a>  <br />';
                         
                         $curID = next($ids);
                         
                      } 


                       ?> 
              </div>
              
              <div class="col-md-2">
                  <u><b>ID</b></u> <br>
                <?php 

               $row = $this->_section->get_sections_ids();

                      foreach($row as $sec) {
                          
                       //  $this->set_value('section_id', $sec);
                          
                         echo $sec . ' <br />';
                      } 


                       ?> 
              </div>
              
              <div class="col-md-3">
                  <u><b>Password</b></u> <br>
                <?php 

               $row = $this->_section->get_sections_pass();

                      foreach($row as $sec) {
                         echo $sec . '<br />';
                      } 


                       ?> 
              </div>

          </div>
        </div>
    </div> 
    
</div> 
     