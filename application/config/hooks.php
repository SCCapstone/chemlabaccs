<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class' => '',
    'function' => 'hook_bootstrap',
    'filename' => 'hooks.php',
    'filepath' => 'hooks'
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */