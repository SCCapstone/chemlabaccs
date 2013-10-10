<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Signed in as <strong><?= CI()->auth->get_user_name(); ?></strong> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><?= anchor('users/signout', 'Sign out') ?></li>
        </ul>
    </li>
</ul>