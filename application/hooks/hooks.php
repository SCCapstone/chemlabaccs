<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function hook_bootstrap() {
    
    $CI =& get_instance();
    
    $CI->template->add_css('bootstrap/css/bootstrap.css');
    $CI->template->add_css('css/style.css');
    $CI->template->add_js('js/jquery-2.0.3.min.js');
    $CI->template->add_js('bootstrap/js/bootstrap.min.js');
    
    $CI->template->write('user_name', $CI->auth->get_user_name());
    
}