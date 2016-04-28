<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?= $title ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?= assets_url() ?>metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= assets_url() ?>metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= assets_url() ?>metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= assets_url() ?>metronic/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?= assets_url() ?>metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<link href="<?= assets_url() ?>metronic/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="<?= assets_url() ?>metronic/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>

<!-- BEGIN THEME STYLES -->
<link href="<?= assets_url() ?>/metronic/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />

<link href="<?= assets_url() ?>metronic/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?= assets_url() ?>metronic/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
<link href="<?= assets_url() ?>metronic/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?= assets_url() ?>metronic/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css">
<?php if(!empty($css)): ?>
	<?php foreach($css as $href): ?>
<link href="<?= $href ?>" rel="stylesheet">	
	<?php endforeach ?>
<?php endif ?>
<link href="<?= assets_url() ?>metronic/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?= assets_url() ?>metronic/global/plugins/respond.min.js"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?= assets_url() ?>metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?= assets_url() ?>metronic/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="<?= assets_url() ?>metronic/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/global/scripts/app.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?= assets_url() ?>metronic/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
      });
   </script>
<!-- END JAVASCRIPTS -->
	<?php if(!empty($js)): ?>
		<?php foreach($js as $href): ?>
	<script src="<?= $href ?>"></script>	
		<?php endforeach ?>
	<?php endif ?>	
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-quick-sidebar-over-content page-boxed page-header-fixed">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner container">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="">
			<img style="width:31px" src="http://mcfloorplans.com/order/img/interactiv/product_5/options/ihrlogo.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		                <!-- BEGIN MEGA MENU -->
                <!-- DOC: Remove "hor-menu-light" class to have a horizontal menu with theme background instead of white background -->
                <!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) in the responsive menu below along with sidebar menu. So the horizontal menu has 2 seperate versions -->

		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- END TODO DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="<?= assets_url() ?>metronic/admin/layout/img/avatar3_small.jpg"/>
					<span class="username username-hide-on-mobile">
					<?= $user['full_name'] ?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li><a href="javascript:;"><i class="<?= $user['fullData']->group_icon ?>"></i> <strong><?= $user['group_name'] ?></strong></a><hr style="margin:0"></li>
						<li>
							<a href="">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="<?= $logoutURL ?>">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="<?= $logoutURL ?>" class="dropdown-toggle">
					<i class="icon-logout"></i>
					</a>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="container">
<div class="page-container">

	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<?= $menu ?>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR
		<?php if(!empty($modal)): ?>
		<div id="<?= $modal['id'] ?>" class="modal container fade" tabindex="-1">
			<?= $modal['modal_body'] ?>
		</div><!-- /.modal -->
		 
	<?php endif ?>
	