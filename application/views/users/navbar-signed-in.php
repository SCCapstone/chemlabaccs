<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<ul class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search by keyword">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Signed in as <strong><?php echo CI()->auth->get_user_name(); ?></strong> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><?php echo anchor('users/signout', '<span class="glyphicon glyphicon-user"></span> Sign out') ?></li>
            <li><?php echo anchor('dashboard/switch_theme', '<span class="glyphicon glyphicon-transfer"></span> Switch theme') ?></li>
        </ul>
    </li>
     
</ul>