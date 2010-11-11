<?php /* Smarty version 2.6.26, created on 2010-11-10 20:18:01
         compiled from layouts/default/header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<!-- CSS -->
	<!-- BLUEPRINT -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['cssDir']; ?>
/blueprint/screen.css" type="text/css" media="screen, projection"/>
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['cssDir']; ?>
/blueprint/print.css" type="text/css" media="print"/>
		<!--[if lt IE 8]>
		  <link rel="stylesheet" href="<?php echo $this->_tpl_vars['cssDir']; ?>
/blueprint/ie.css" type="text/css" media="screen, projection"/>
		<![endif]-->
		
	<!-- CUSTOM -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['cssDir']; ?>
/main.css" type="text/css" media="screen"/>
		
<!-- JAVASCRIPT -->
	<!-- JQUERY -->
		<script type='text/javascript' src='<?php echo $this->_tpl_vars['jsDir']; ?>
/jquery/jquery-1.4.2.min.js'></script>
		<script type='text/javascript' src='<?php echo $this->_tpl_vars['jsDir']; ?>
/jquery/configureAjax.jquery.js'></script>
		<script type='text/javascript'>var $j = jQuery.noConflict();</script>
		
	<!-- JQUERY PLUGINS -->
		<script type='text/javascript' src='<?php echo $this->_tpl_vars['jsDir']; ?>
/jquery/plugins/rolloverImage.jquery.js'></script>
		<script type='text/javascript' src='<?php echo $this->_tpl_vars['jsDir']; ?>
/jquery/plugins/validate.jquery.js'></script>
		<script type='text/javascript' src='<?php echo $this->_tpl_vars['jsDir']; ?>
/jquery/plugins/form.jquery.js'></script>
		
	<!-- JQUERY CUSTOM METHODS -->
		<script type='text/javascript' src='<?php echo $this->_tpl_vars['jsDir']; ?>
/jquery/customMethods.jquery.js'></script>

</head>

<body>

<div id='page'>

<!-- HEADER -->
	<div id='header'>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/topMenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- TOP MENU -->
		

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/logo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- LOGO -->
		
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/accountMenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- ACCOUNT MENU -->
		
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/miniCart.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- MINI CART -->

	</div>
	
	
<!-- OTHER STUFF -->
	<?php echo $this->_tpl_vars['this']->flashMessenger(); ?>
<!-- PHP FLASH MESSENGER -->
		
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/loadingImage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- LOADING IMAGE -->
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/jsFlashMessage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- JS FLASH MESSAGE -->
		