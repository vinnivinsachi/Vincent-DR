<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<!-- CSS -->
	<!-- BLUEPRINT -->
		<link rel="stylesheet" href="{$siteRoot}/public/resources/css/blueprint/screen.css" type="text/css" media="screen, projection"/>
		<link rel="stylesheet" href="{$siteRoot}/public/resources/css/blueprint/print.css" type="text/css" media="print"/>
		<!--[if lt IE 8]>
		  <link rel="stylesheet" href="{$siteRoot}/public/resources/css/blueprint/ie.css" type="text/css" media="screen, projection"/>
		<![endif]-->
		
	<!-- CUSTOM -->
		<link rel="stylesheet" href="{$siteRoot}/public/resources/css/main.css" type="text/css" media="screen"/>
		
<!-- JAVASCRIPT -->
	<!-- JQUERY -->
		<script type='text/javascript' src='{$jsDir}/jquery/jquery-1.4.2.min.js'></script>
		<script type='text/javascript'>var $j = jQuery.noConflict();</script>

</head>

<body>

<div id='page'>

<!-- HEADER -->
	<div id='header'>

		<!-- TOP MENU -->
			<div id="top_menu">
				<div id='top_menu_bg_l'><img src="{$imagesDir}/top_menu/logo_dancers.jpg"/></div>
				
				<div id='top_menu_items'>
					<a href='#' class='top_menu_item'><img class='rollover' src='{$imagesDir}/top_menu/top_menu_find_off.jpg'/></a>
					<img class='spacer' width='20' height='1' />
					<a href='#' class='top_menu_item'><img class='rollover' src='{$imagesDir}/top_menu/top_menu_list_off.jpg'/></a>
				</div>
				
				<div id='top_menu_bg_r'><img src='{$imagesDir}/top_menu/top_menu_bg_r.jpg'/></div>
			</div>
		

		<!-- LOGO -->
			<div id='logo'><a href='{$siteRoot}'><img src='{$imagesDir}/layout/logo_title.jpg'/></a></div>
		
		
		<!-- ACCOUNT MENU -->
			<div id='account_menu'>
				<a href='#'>Account</a> &nbsp;|&nbsp; <a href='#'>Logout</a>
			</div>
		
		
		<!-- MINI CART -->
			<a id='mini_cart_link' href='#'>
				<span id='mini_cart'>
					<span id='mini_cart_number'>0</span>
					 &nbsp;&nbsp;&nbsp;&nbsp;items in your cart
				</span>
			</a>

	</div>
	

<!-- JAVASCRIPTS -->
<script type='text/javascript' src='{$jsDir}/custom/rollover.js'></script>
<script type='text/javascript' src='{$jsDir}/custom/folding.js'></script>
