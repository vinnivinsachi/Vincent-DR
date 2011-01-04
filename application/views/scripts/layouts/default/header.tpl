<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
		
<!-- JAVASCRIPT -->
	{include file="layouts/$layout/js.tpl"}

<!-- CSS -->
	{include file="layouts/$layout/css.tpl"}

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
		
