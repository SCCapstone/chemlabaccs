<div class="row">
    <div class="col-md-4">
        <h2>Add Accident Report</h2>
        <p>Add an accident report.</p>
        <p><?php echo anchor("accident/add", "Go &raquo;", array("class" => "btn btn-primary", "role" => "button")); ?></p>
    </div>
    <div class="col-md-4">
        <h2>View Accident Reports</h2>
        <p>View a list of accident reports and details.</p>
        <p><?php echo anchor("accident/all", "Go &raquo;", array("class" => "btn btn-primary", "role" => "button")); ?></p>
    </div>
    <div class="col-md-4">
        <h2>Search Accident Reports</h2>
        <p>Search for accident reports.</p>
        <p><?php echo anchor("accident/search", "Go &raquo;", array("class" => "btn btn-primary", "role" => "button")); ?></p>
    </div>
</div>