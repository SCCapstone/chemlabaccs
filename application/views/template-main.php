<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo APP_NAME ?> | <?php echo $title ?></title>
        <link rel="shortcut icon" href="<?php echo base_url("img/favicon.png") ?>">
        <?php echo $_styles ?>
        <?php echo $_scripts ?>
        <style type="text/css">
           body {
	padding-top: 80px;
}
div.error {
	color: #f00;
}
/* 
    Document   : chemlab.css
    Created on : Feb 21, 2014, 5:14:44 PM
    Author     : IAWS_BUSINESS
    Description:
        Purpose of the stylesheet follows.
*/

.modal-content {
	width: 642;
	min-width: 642px;
	padding: 0px;
}
.modal-dialog {
	min-width: 642px;
}
.modal-body {
	padding: 0px !important;
}
.dropdown-menu {
	left: -90px;
}
.img-thumbnail {
	cursor: pointer;
}
pre {
	height: 75px;
}
.dl-horizontal dt {
	text-align: center;
}
.modal-content {
	width: 642;
	min-width: 642px;
	padding: 0px;
}
.modal-dialog {
	min-width: 642px;
}
.modal-body {
	padding: 0px !important;
}
.dropdown-menu {
	left: -90px;
}
.img-thumbnail {
	cursor: pointer;
}
pre {
	height: 75px;
}
.dl-horizontal dt {
	text-align: center;
}
textarea.form-control {
	height: auto;
}
textarea.form-control:focus {
}
.comment_container {
	max-width: 820px;
	padding-left: 15px;
}
.container_content {
	max-width: 860px;
}
.list-group-item {
	min-height: 80px;
	padding: 15px;
}
#image-description {
	font-size: 15px !important;
}
  #photoview{
        max-width: 815px;
        margin:0 auto;
        margin-bottom:50px;
        height:auto;
        width:auto !important;

        padding-left:15px;
    }
    .equamargins{
        width: 90% !important;
    }
    /*************************************************************/
    /* tables */
table.tablesorter {
    font-family:arial;
    background-color: #CDCDCD;
    margin:10px 0pt 15px;
    font-size: 8pt;
    width: 100%;
    text-align: left;
}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {
    background-color: #e6EEEE;
    border: 1px solid #FFF;
    font-size: 8pt;
    padding: 4px;
}
table.tablesorter thead tr .header {
    background-image: url(bg.gif);
    background-repeat: no-repeat;
    background-position: center right;
    cursor: pointer;
}
table.tablesorter tbody td {
    color: #3D3D3D;
    padding: 4px;
    background-color: #FFF;
    vertical-align: top;
}
table.tablesorter tbody tr.odd td {
    background-color:#F0F0F6;
}
table.tablesorter thead tr .headerSortUp {
    background-image: url(asc.gif);
}
table.tablesorter thead tr .headerSortDown {
    background-image: url(desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
background-color: #8dbdd8;
}
table .header {
    cursor: pointer;
}

table .header:after {
  content: "";
  float: right;
  margin-top: 7px;
  border-width: 0 4px 4px;
  border-style: solid;
  border-color: #000000 transparent;
  visibility: hidden;
}

table .headerSortUp, table .headerSortDown {
  background-color: #f7f7f9;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
}

table .header:hover:after {
  visibility: visible;
}

table .headerSortDown:after, table .headerSortDown:hover:after {
  visibility: visible;
  filter: alpha(opacity=60);
  -moz-opacity: 0.6;
  opacity: 0.6;
}

table .headerSortUp:after {
  border-bottom: none;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #000000;
  visibility: visible;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  filter: alpha(opacity=60);
  -moz-opacity: 0.6;
  opacity: 0.6;
}
   
</style>
        </style>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url("/js/html5shiv.js") ?>"></script>
          <script src="<?php echo base_url("/js/respond.min.js") ?>"></script>
        <![endif]-->
        <script>
            $(function() {

                function easyDateTimeInputs() {

                    if ($(window).width() > 768) {

                        $("#date, #start_date, #end_date").calendricalDate({
                            usa: true
                        }).attr("type", "text");
                        $("#time, #start_time, #end_time").calendricalTime().attr("type", "text");

                    }

                }
                
                easyDateTimeInputs();
                1
                $(window).resize(function() {
                    easyDateTimeInputs();
                });

            });
        </script>      
        
    <!-- Tablesorter -->
 
    <script type="text/javascript" src="<?php echo base_url(); ?>tablesorter/jquery-latest.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>tablesorter/jquery.tablesorter.js"></script>
    <script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#resultsTable").tablesorter({

            // customize header HTML
            onRenderHeader: function(index) {
                // the span wrapper is added by default
                this.wrapInner('<span class="icons"></span>');
            }

        }); 
        
    } 
    ); 
    </script>
    <!--// Tablesorter -->
        
    </head>
    <body>
        <div class="navbar <?php echo $theme; ?> navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php echo anchor('', APP_NAME, array('class' => 'navbar-brand', 'title' => APP_DESC)); ?>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php if (CI()->auth->is_authenticated()): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Accidents <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor("accidents/add", '<span class="glyphicon glyphicon-plus"></span> Add'); ?></li>
                                    <li><?php echo anchor("accidents/search", '<span class="glyphicon glyphicon-search"></span> Search'); ?></li>
									<li><?php echo anchor("charts", '<span class="glyphicon glyphicon-stats"></span> Data'); ?></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reporting <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor("reports/mine", '<span class="glyphicon glyphicon-book"></span> My Reports'); ?></li>
                                    <li><?php echo anchor("reports/export", '<span class="glyphicon glyphicon-th"></span> Export to CSV'); ?></li>
                                    <li><?php # echo anchor("reports/user", '<span class="glyphicon glyphicon-book"></span> Reports By User'); ?></li>
                                </ul>
                            </li>
                        <?php else: ?>
							<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Accidents <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor("users/signin", '<span class="glyphicon glyphicon-plus"></span> Add - <p style="color:red;display:inline">Sign in</p>'); ?></li>
                                    <li><?php echo anchor("users/signin", '<span class="glyphicon glyphicon-search"></span> Search - <p style="color:red;display:inline">Sign in</p>'); ?></li>
									<li><?php echo anchor("charts", '<span class="glyphicon glyphicon-stats"></span> Data'); ?></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reporting <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><?php echo anchor("users/signin", '<span class="glyphicon glyphicon-book"></span> My Reports - <p style="color:red;display:inline">Sign in</p>'); ?></li>
                                    <li><?php echo anchor("users/signin", '<span class="glyphicon glyphicon-th"></span> Export to CSV - <p style="color:red;display:inline">Sign in</p>'); ?></li>
                                    <li><?php # echo anchor("reports/user", '<span class="glyphicon glyphicon-book"></span> Reports By User'); ?></li>
                                </ul>
                            </li>
						
                        <?php endif; ?>
                    </ul>
                    <?php if (CI()->auth->is_authenticated()): ?>
                        <?php echo $navbar_signed_in ?>
                    <?php else: ?>
                        <?php echo $navbar_sign_in ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <?php echo $flash; ?>
            <?php echo @$error; ?>
            <?php if ($heading): ?>
                <div class="page-header">
                    <h2><?php echo $heading; ?></h2>
                </div>
            <?php endif; ?>
            <?php print $content ?>
            <hr />
            <footer style="clear:both">
                <p>&copy; <?php echo APP_NAME ?> <em>(<?php echo APP_DESC; ?>)</em> <?php echo date("Y"); ?>. All Rights Reserved.</p>
            </footer>
        </div>
    </body>
</html>