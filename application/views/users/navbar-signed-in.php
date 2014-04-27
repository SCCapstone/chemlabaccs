<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Signed in as <strong><?php echo CI()->auth->get_user_name(); ?></strong> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><?php echo anchor('dashboard/switch_theme', '<span class="glyphicon glyphicon-transfer"></span> Switch theme') ?></li>
            <li><?php echo anchor('dashboard/help', '<span class="glyphicon glyphicon-book"></span> Help!') ?></li>
            <li><?php echo anchor('dashboard/about', '<span class="glyphicon glyphicon-book"></span> About') ?></li>
            <li><?php echo anchor('users/signout', '<span class="glyphicon glyphicon-user"></span> Sign out') ?></li>
        </ul>
    </li>
     
</ul>