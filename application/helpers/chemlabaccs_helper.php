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