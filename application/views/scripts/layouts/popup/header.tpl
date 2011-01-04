{include file='layouts/popup/doctype.tpl'}

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>
		
<!-- JAVASCRIPT -->
	{include file='layouts/popup/js.tpl'}

<!-- CSS -->
	{include file='layouts/popup/css.tpl'}

</head>

<body>

<div id='page'>
	
	
<!-- OTHER STUFF -->
	{$this->flashMessenger()}<!-- PHP FLASH MESSENGER -->
		
	{include file='layouts/popup/loadingImage.tpl'}<!-- LOADING IMAGE -->
	
	{include file='layouts/popup/jsFlashMessage.tpl'}<!-- JS FLASH MESSAGE -->
