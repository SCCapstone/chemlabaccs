

<style type="text/css">
    /*************************************************************/
/* tables */
table.tablesorter {
	font-family:arial;
	background-color: #CDCDCD;
	margin:10px 0pt 15px;
	font-size: 10pt;
	width: 100%;
	text-align: left;
}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {
	background-color: #e6EEEE;
	border: 1px solid #FFF;
	font-size: 10pt;
	padding: 4px;
        text-align: left;
}
table.tablesorter .header {
	background-image: url(<?php echo base_url("tablesorter/themes/green/bg.png"); ?>);
	background-repeat: no-repeat;
	border-left: 1px solid #FFF;
	border-right: 1px solid #000;
	border-top: 1px solid #FFF;
	padding-left: 30px;
	padding-top: 8px;
	height: auto;
        cursor: pointer;
}
table.tablesorter tbody td {
	color: #3D3D3D;
	padding: 4px;
	background-color: #FFF;
	vertical-align: middle;
}
table.tablesorter tbody tr.odd td {
	background-color: #E0F8E6;
}
table.tablesorter thead tr .headerSortUp {
	background-image: url(<?php echo base_url("tablesorter/themes/green/asc.png"); ?>);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(<?php echo base_url("tablesorter/themes/green/desc.png"); ?>);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
background-color: #8dbdd8;
}


</style>




  <!-- Tablesorter -->
 
    <script type="text/javascript" src="<?php echo base_url(); ?>tablesorter/jquery-latest.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>tablesorter/jquery.tablesorter.js"></script>
   
    
    <script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#resultsTable").tablesorter({

            //theme: 'green',
              widgets: ['zebra'] ,
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
    
 