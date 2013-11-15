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
        "Building",
        "Room",
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
            $acc->name,
            $acc->room,
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