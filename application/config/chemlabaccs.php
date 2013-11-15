<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("APP_NAME", "CLAR");
define("APP_DESC", "Chemisty Lab Accident Reporting");
define("FULL_RATING", '<span class="glyphicon glyphicon-star"></span>');
define("EMPTY_RATING", '<span class="glyphicon glyphicon-star-empty"></span>');
define("NUM_RATINGS", 3);

$config['table_users'] = 'users';
$config['table_accidents'] = 'accidents';
$config['table_buildings'] = 'buildings';

function CI() {
    return get_instance();
}
