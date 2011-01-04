<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>
		
<!-- JAVASCRIPT -->
	{include file='layouts/default/js.tpl'}

<!-- CSS -->
	{include file='layouts/default/css.tpl'}
	<!-- POPUP SPECIFIC CSS -->
		<link rel="stylesheet" href="{$cssDir}/popup.css" type="text/css" media="screen"/>

</head>

<body>

<div id='page'>
	
	
<!-- OTHER STUFF -->
	{$this->flashMessenger()}<!-- PHP FLASH MESSENGER -->
		
	{include file='layouts/default/loadingImage.tpl'}<!-- LOADING IMAGE -->
	
	{include file='layouts/default/jsFlashMessage.tpl'}<!-- JS FLASH MESSAGE -->
