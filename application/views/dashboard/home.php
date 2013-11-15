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
        <p>View accident reports you've submitted.</p>
        <p><?php echo anchor("accidents/mine", '<span class="glyphicon glyphicon-list"></span> Go', array("class" => "btn btn-primary", "role" => "button")); ?></p>
    </div>
</div>