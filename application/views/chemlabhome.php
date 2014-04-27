<?php $category = "Home"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LARS | Lab Accident Reporting System</title>
<link rel="shortcut icon" href="<?php echo base_url("img/favicon.png") ?>">

<!-- Additional meta -->

<!-- The OPEN GRAPH -->

<!------Cascading Style Sheets--------->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,600' rel='stylesheet' type='text/css'>
<link href="chemlab_graphics/css/chemlab_home.css" rel="stylesheet" type="text/css" />

<!----END Cascading Style Sheets------->

</head>

<body>
<div class="homeintro" id="intro_display">
  <div class="hidden-sm hidden-xs" id="clear_navigation">
    <div id="logo_wrapper_main"><img src="chemlab_graphics/chemlab_logo.png" width="137" height="53" alt="lars_logo" /></div>
    <div id="clear_navigation_quick_links">
      <a href="users/register"><div id="register_custom_btn">Register</div></a>
      <div id="quick_links_anchors"> <a href="charts">Statistics </a><a href="users/signin">Login</a></div>
    </div>
  </div>
  <div id="megatron_support_text_wrapper" class="hidden-sm hidden-xs">
    <div class="media-body" id="megatron_support_text"> <span class="intro_text_white">Lab Accident Reporting System </span>
      <p span class="white_text" >Keep track of, search and view reports all in one place. Create, analyze<br />
        and share accidents for all types of labs. </p>
        <a href="dashboard/about"><div id="register_custom_btn_solid"><b>Learn More</b></div></a>
      <p span class="white_text" >&nbsp;</p>
    </div>
    <div id="megatron_support_graphics" class="hidden-sm hidden-xs"><img src="chemlab_graphics/lars_iphone_display.png" width="350" height="523" /></div>
  </div>
  <!-----------------------------Alternative Views-------------------------------->
  <div id="tablet_mobile_navigation" class="hidden-lg hidden-md">
    <div id="tablet_mobile_logo_wrapper"><img src="chemlab_graphics/chemlab_logo.png" width="105" height="40" /></div>
    <br>
        <br>
    <div id="tablet_mobile_quick_links">
        <a href="users/register"><div id="register_custom_btn_small">Register</div></a>
        <div id="tablet_mobile_quick_link_wrapper"><a href="charts">Statistics</a> <a href="users/signin">Login</a> </div>
    </div>
  </div>
  <div id="tablet_mobile_megatron">
    <div id="tablet_mobile_intro_text" class="hidden-md hidden-lg">
      <p><img src="chemlab_graphics/lars_iphone_display.png" width="245" height="366" /></p>
      <div id="megatron_support_text_wrapper2">
        <div id="megatron_support_text2"> <span class="intro_text_white_tablet_mobile">Lab Accident Reporting System</span>
          <p class="white_text">Keep track of, search and view reports all in one place. Create, analyze<br />
            and share accidents for all types of labs. </p>
        </div>
      </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div>
  </div>
</div>
<div id="tablet_feature_spotlight" class="hidden-lg hidden-md">
  <div id="one-3-block" class="lars_green"><img src="chemlab_graphics/images/oqaue_badges_02.png" width="86" height="100" /></div>
  <div id="one-3-block" class="lars_blue"><img src="chemlab_graphics/images/oqaue_badges_04.png" width="93" height="101" /></div>
  <div id="one-3-block" class="lars_purple"><img src="chemlab_graphics/images/oqaue_badges_06.png" width="93" height="99" /></div>
</div>
<!------------------------------------------------------------------------------>

<div id="feature_spotlight" class="hidden-sm hidden-xs">
  <div id="feature_badges">
    <div class="feature_badges" id="badge_block">
      <p><img src="chemlab_graphics/report_badge.png" width="170" height="170" /></p>
      <p>Create detailed reports for many labs. Save paper! </p>
    </div>
    <div class="feature_badges" id="badge_block">
      <p><img src="chemlab_graphics/analyze_badge.png" width="170" height="170" /></p>
      <p>Analyze all of your reports from the LARS dashboard. </p>
    </div>
    <div class="feature_badges" id="badge_block">
      <p><img src="chemlab_graphics/badge_share.png" width="170" height="170" /></p>
      <p>Allow classmates to comment on lab reports and give their input as to what happened. </p>
    </div>
  </div>
</div>
<div id="featured_header_panel">
  <div id="featured_heading">Features</div>
</div>
<div id="accent_caret"> <img src="chemlab_graphics/feature_caret.png" width="50" height="26" /> </div>
<!----------------------------------------------------------------------------------------> 
<!---Alternative Feature Container---->
<div id="feature_container_tablet_mobile" class="hidden-lg hidden-md">
  <div id="sub_feature_block_tablet_mobile">
    <p><img src="chemlab_graphics/lar_icon_camera.png" width="101" height="101" class="lar_icon" />
    <p>&nbsp;</p>
    <p>Multiple Photo Upload</p>
    <p>&nbsp;</p>
  </div>
  <div id="sub_feature_block_tablet_mobile">
    <p><img src="chemlab_graphics/lar_icon_comment.png" width="101" height="101" class="lar_icon" /></p>
    <p>&nbsp;</p>
    <p>Commenting System</p>
    <p>&nbsp;</p>
  </div>
  <div id="sub_feature_block_tablet_mobile">
    <p><img src="chemlab_graphics/lar_icon_list.png" width="101" height="101" class="lar_icon" /></p>
    <p>&nbsp;</p>
    <p>CSV Exporting</p>
  </div>
  <div id="sub_feature_block_tablet_mobile">
    <p><img src="chemlab_graphics/lar_icon_analytics.png" width="101" height="101" class="lar_icon" /></p>
    <p>&nbsp;</p>
    <p>Analytics Dashboard</p>
  </div>
  <div id="sub_feature_block_tablet_mobile">
    <p><img src="chemlab_graphics/lar_icon_search.png" width="107" height="101" class="lar_icon" /> </p>
    <p>&nbsp;</p>
    <p>Keyword Search</p>
  </div>
  <div id="sub_feature_block_tablet_mobile">
    <p><img src="chemlab_graphics/lar_icon_mail.png" alt="" width="101" height="101" class="lar_icon" /></p>
    <p>&nbsp;</p>
    <p>Email Notification </p>
  </div>
</div>
<!---------------------------------------------------------------------------------------->
<div id="feature_container" class="hidden-sm hidden-xs">
  <div id="sub_feature_block">
    <p><img src="chemlab_graphics/lar_icon_camera.png" width="101" height="101" class="lar_icon" />Multiple Photo Upload
  </div>
  <div id="sub_feature_block">
    <p><img src="chemlab_graphics/lar_icon_comment.png" width="101" height="101" class="lar_icon" />Commenting System</p>
    <p>&nbsp;</p>
  </div>
  <div id="sub_feature_block">
    <p><img src="chemlab_graphics/lar_icon_list.png" width="101" height="101" class="lar_icon" /></p>
    <p>CSV Exporting</p>
  </div>
  <div id="sub_feature_block">
    <p><img src="chemlab_graphics/lar_icon_analytics.png" width="101" height="101" class="lar_icon" /></p>
    <p>Analytics Dashboard</p>
  </div>
  <div id="sub_feature_block">
    <p><img src="chemlab_graphics/lar_icon_search.png" width="107" height="101" class="lar_icon" /> </p>
    <p>Keyword Search</p>
  </div>
  <div id="sub_feature_block">
    <p><img src="chemlab_graphics/lar_icon_mail.png" alt="" width="101" height="101" class="lar_icon" /></p>
    <p>Email Notification </p>
  </div>
</div>
<div id="home_footer">
    <a href="charts"><p>Statistics  </p></a>
    <a href="users/signin"><p>Login</p></a>
    <a href="users/register"><p>Register</p></a>
</div>

<!-------------Tentative Accent Area---><!-------------End Footer Area---------><!-------------Javascript--------------> 
<script type="text/javascript" src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script> 
<!-----------END Javascript------------>
</body>
</html>