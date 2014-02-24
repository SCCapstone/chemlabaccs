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

<div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Your Account</h3>
      </div>
      <div class="panel-body">
          <p> <?php echo anchor("users/joinSection", '<span class="glyphicon glyphicon-ok"></span> Join a Section', array("class" => "btn btn-success", "role" => "button")); ?> With Section ID & Password.</p>
      </div>
    </div>
</div>    
     