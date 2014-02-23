<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function date_human2mysql($date) {
    
    return date("Y-m-d", strtotime($date));
    
}

function time_human2mysql($time) {
    
    return date("H:i:s", strtotime("1970/01/01 " . $time));
    
}

function date_mysql2human($date) {
    
    return date("m/d/Y", strtotime($date));
    
}

function time_mysql2human($time) {
    
    return date("g:i a", strtotime("1970/01/01 " . $time));
    
}

function valid_date($date) {
    
    $date = trim($date);

    list($m, $d, $y) = explode("/", $date);

    return checkdate($m, $d, $y);
    
}

function valid_time($time) {
    
    $time = trim($time);
    
    return strtotime($time);
    
}

function get_buildings($extra = false) {
    
    return get_instance()->_buildings->all($extra);
    
}

function severity_scale($severity) {
    
    $rating = 0;
    
    switch ($severity) {
        case "low":
            $rating = 1;
            break;
        case "medium":
            $rating = 2;
            break;
        case "high":
            $rating = 3;
            break;
    }
    
    $scale = str_repeat(FULL_RATING, $rating) . str_repeat(EMPTY_RATING, NUM_RATINGS - $rating);
    
    return '<span title="' . ucfirst($severity) . ' severity">' . $scale . '</span>';
    
}

function format_accident_report_number($number) {
    
    return sprintf("%04d", $number);
    
}
    
function generate_accident_listing($accidents, $show = array()) {
    
    $CI =& get_instance();

    $show = array_merge(array(
        "show_report#" => false,
        "show_detail" => true,
        "show_revisions" => true,
    ), $show);

    $CI->table->set_template(array (
        "table_open" => '<table class="table table-striped">'
    ));

    $headings = array(
        "Date &amp; Time",
        "Severity",
        "Entered By",
        "Modified By",
        "Created On",
        "Actions"
    );

    if ($show["show_report#"]) {
        array_unshift($headings, "Report #");
    }

    $CI->table->set_heading($headings);

    foreach ($accidents as $acc) {

        $actions = array();

        if ($show["show_detail"]) {
            $actions[] = anchor("accidents/detail/" . $acc->id, '<span class="glyphicon glyphicon-eye-open"></span> Details', array(
                "class" => "btn btn-default"
            ));
        }
        
        if (isset($acc->count)) {

            if ($show["show_revisions"] && $acc->count - 1 > 0) {
                $actions[] = anchor("accidents/revisions/" . $acc->revision_of, '<span class="glyphicon glyphicon-list-alt"></span> Revisions (' . ($acc->count - 1) . ')', array(
                    "class" => "btn btn-default"
                ));
            }
        
        }

        $user = String($acc->email);
        $modified = String($acc->modified);

        $row = array(
            date_mysql2human($acc->date) . " " . time_mysql2human($acc->time),
            severity_scale($acc->severity),
            $user->substring(0, $user->indexOf("@")),
            (!$modified->equals("")) ? $modified->substring(0, $modified->indexOf("@")) : "-",
            date("m/d/Y g:i a", strtotime($acc->created)),
            implode(' ', $actions)
        );

        if ($show["show_report#"]) {
            array_unshift($row, '<span class="badge">' . format_accident_report_number($acc->revision_of) . '</span>');
        }

        $CI->table->add_row($row);

    }

    return $CI->table->generate();        

}

function span($text, $class) {
    
    return sprintf('<span class="%s">%s</span>', $class, $text);
    
}

//return reports that have not been revised, and the lastest revision for those that have been revised
function get_latest_reports($db) {
	$count = 0;
	$sql = 'SELECT * FROM accidents WHERE `id` <=> `revision_of`';
	$original_ids = $db->query($sql);
	
	foreach($original_ids->result() as $data)
	{
		$sql = 'SELECT * FROM accidents WHERE id = ( SELECT MAX(id) FROM accidents WHERE revision_of <=> ' . $data->id . ' )';
		$results[$count] = $db->query($sql)->result();
		$count++;
	}
	return $results;
}

//create an array for each building with the building counts set to 0
function initialize_building_count($buildings)
{
	$data = array();
	for($i = 1; $i < count($buildings); $i++)
	{
		$data[$i] = 0;
	}
	return $data;
}

//find the total number of accidents that occur in each building
function find_building_count($reports, $buildings)
{
	$building_count = initialize_building_count($buildings);
	foreach ($reports as $report) 
	{
		for($i = 1; $i < count($buildings); $i++)
		{
			if($report[0]->building == $i)
			{
				$building_count[$i]++;
			}
		}
	}
	return $building_count;
}

//create an array for each time period with each time count starting at 0
function initialize_time_count()
{
	$data = array();
	//change 6 to a variable for the number of time periods measured
	for($i = 0; $i < 6; $i++)
		$data[$i] = 0;
	return $data;
}

//find the percent of each accident that occur in each 4 hour block
function find_time_percents($reports)
{
	$data = initialize_time_count();
	foreach($reports as $report)
	{
		$hour = substr($report[0]->time, 0, 2);
		//change 6 to a variable for the number of time periods measured
		for($i = 1; $i <= 6; $i++)
		{
			//change 4 to a variable for 24 divided by the number of time periods measured
			if($hour >= ($i-1) * 4 && $hour < $i*4)
			{
				$data[$i-1]++;
				break;
			}
		}
	}
	$index = 0;
	foreach($data as $time)
	{
		$data[$index] = $time / count($reports) * 100;
		$index++;
	}
	return $data;
}

//create an array to hold the number of accidents for each severity level, and start each count at 0
function initialize_severity_count()
{
	$data = array();
	//change 3 to a variable for the number of severity ratings measured
	for($i = 0; $i < 3; $i++)
		$data[$i] = 0;
	return $data;
}

//returns the percent of the number of accidents that occur for each level of severity
function find_severity_percents($reports)
{
	$data = initialize_severity_count();
	foreach($reports as $report)
	{
		$severity = $report[0]->severity;
		if($severity == "low")
			$data[0]++;
		else if($severity == "medium")
			$data[1]++;
		else if($severity == "high")
			$data[2]++;
	}
	
	$index = 0;
	foreach($data as $sev)
	{
		//change 3 to a variable for the number of severity ratings measured
		$data[$index] = $sev / 3 * 100;
		$index++;
	}
	return $data;
}

//create an array to hold the number of accidents that occur per month, and set each count to 0
function initialize_month_count()
{
	$data = array();
	for($i = 0; $i < 12; $i++)
		$data[$i] = 0;
	return $data;
}

//returns the number of accidents that have occurred in each month for a specified year
//specified year is -1 when getting accidents for each month from all time
function find_month_count($reports, $accident_year)
{
	$data = initialize_month_count();
	foreach($reports as $report)
	{
		$month = substr($report[0]->date, 5, 2);
		$year = substr($report[0]->date, 0, 4);
		if($year == $accident_year || $accident_year == -1)
		{
			$data[$month-1]++;
		}
	}
	return $data;
}

//returns the number of accidents that have occurred in each month for a specified severity level
//data returned is for the current year
function find_month_sev_count($reports, $severity)
{
	$data = initialize_month_count();
	foreach($reports as $report)
	{
		$month = substr($report[0]->date, 5, 2);
		$year = substr($report[0]->date, 0, 4);
		$sev = $report[0]->severity;
		if($year == date('Y') && $sev == $severity)
		{
			$data[$month-1]++;
		}
	}
	return $data;
}