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