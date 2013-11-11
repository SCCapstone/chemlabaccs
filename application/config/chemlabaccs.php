<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("APP_NAME", "ChemLabAccs");

$config['table_users'] = 'users';
$config['table_accidents'] = 'accidents';
$config['table_buildings'] = 'buildings';

function CI() {
    return get_instance();
}
