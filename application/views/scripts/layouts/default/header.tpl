<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<!-- CSS -->
	<!-- BLUEPRINT -->
		<link rel="stylesheet" href="{$cssDir}/blueprint/screen.css" type="text/css" media="screen, projection"/>
		<link rel="stylesheet" href="{$cssDir}/blueprint/print.css" type="text/css" media="print"/>
		<!--[if lt IE 8]>
		  <link rel="stylesheet" href="{$cssDir}/blueprint/ie.css" type="text/css" media="screen, projection"/>
		<![endif]-->
		
	<!-- CUSTOM -->
		<link rel="stylesheet" href="{$cssDir}/main.css" type="text/css" media="screen"/>
		
<!-- JAVASCRIPT -->
	<!-- JQUERY -->
		<script type='text/javascript' src='{$jsDir}/jquery/jquery-1.4.2.min.js'></script>
		<script type='text/javascript' src='{$jsDir}/jquery/configureAjax.jquery.js'></script>
		<script type='text/javascript'>var $j = jQuery.noConflict();</script>
		
	<!-- JQUERY PLUGINS -->
		<script type='text/javascript' src='{$jsDir}/jquery/plugins/rolloverImage.jquery.js'></script>
		<script type='text/javascript' src='{$jsDir}/jquery/plugins/preload.jquery.js'></script>
		<script type='text/javascript' src='{$jsDir}/jquery/plugins/validate.jquery.js'></script>
		<script type='text/javascript' src='{$jsDir}/jquery/plugins/form.jquery.js'></script>
		
	<!-- JQUERY CUSTOM METHODS -->
		<script type='text/javascript' src='{$jsDir}/jquery/customMethods.jquery.js'></script>

</head>

<body>

<div id='page'>

<!-- HEADER -->
	<div id='header'>

		{include file="layouts/$layout/topMenu.tpl"}<!-- TOP MENU -->
		

		{include file="layouts/$layout/logo.tpl"}<!-- LOGO -->
		
		
		{include file="layouts/$layout/accountMenu.tpl"}<!-- ACCOUNT MENU -->
		
		
		{include file="layouts/$layout/miniCart.tpl"}<!-- MINI CART -->

	</div>
	
	
<!-- OTHER STUFF -->
	{$this->flashMessenger()}<!-- PHP FLASH MESSENGER -->
		
	{include file="layouts/$layout/loadingImage.tpl"}<!-- LOADING IMAGE -->
	
	{include file="layouts/$layout/jsFlashMessage.tpl"}<!-- JS FLASH MESSAGE -->
		
