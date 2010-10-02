<?php /* Smarty version 2.6.19, created on 2010-08-25 15:43:35
         compiled from partials/productTagHeader.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'partials/productTagHeader.tpl', 4, false),)), $this); ?>
<div id="productTagHeader">
    <a class="productTagHeaderButton <?php if ($this->_tpl_vars['page'] == 'Customizable'): ?>currentSelection<?php endif; ?>" href="/productdisplay/index?purchaseType=Customizable<?php if (isset ( $this->_tpl_vars['tag'] )): ?>&tag=<?php echo $this->_tpl_vars['tag']; ?>
<?php endif; ?>">Customizables</a>
    <a class="productTagHeaderButton <?php if ($this->_tpl_vars['page'] == 'Buy_now'): ?>currentSelection<?php endif; ?>" href="/productdisplay/index?purchaseType=Buy_now<?php if (isset ( $this->_tpl_vars['tag'] )): ?>&tag=<?php echo $this->_tpl_vars['tag']; ?>
<?php endif; ?>">Buy it now</a>
    <a class="shoppingCartIcon" style="float:right; margin-top:3px;" href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'index'), $this);?>
"><img src="/public/resources/css/images/shoppingcart_flattened.png" width="35" /></a>
    <span style="float:right; margin-top:9px;"><?php echo $this->_tpl_vars['shoppingCartInfo']->totalItems; ?>
 item in your <a href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'index'), $this);?>
" style="font-size:14px;">cart</a></span>
</div>

<div id='controllerMessage'>
	<?php if (! $this->_tpl_vars['authenticated']): ?>
		<?php if (isset ( $this->_tpl_vars['controllerMessage'] )): ?><?php echo $this->_tpl_vars['controllerMessage']; ?>
<?php endif; ?>
	<?php endif; ?>
	<?php if (! $this->_tpl_vars['authenticated'] && $this->_tpl_vars['controller'] == 'Comparechart'): ?>
		<a class='largeAnchorButton' href="<?php echo smarty_function_geturl(array('controller' => 'comparechart','action' => 'savecomparelist'), $this);?>
">Save compare chart</a>
	<?php elseif ($this->_tpl_vars['controller'] == 'Comparechart'): ?>
		<span class='bigBoldFont'>Compare chart</span>
	<?php endif; ?>
</div>

<div id="breadcrumbs" style='padding-top:10px; padding-bottom:10px;'>
    <span style="font-size:1.2em; float:left; font-weight:bold;"><?php echo $this->_tpl_vars['tag']; ?>
</span>
	<span style='font-size:1.2em; float:right;'><a>1</a></span>
</div>

<!-- href="/productdisplay/index?purchaseType=Customizable<?php if (isset ( $this->_tpl_vars['tag'] )): ?>&tag=<?php echo $this->_tpl_vars['tag']; ?>
<?php endif; ?>" -->
<!-- href="/productdisplay/index?purchaseType=Buy_now<?php if (isset ( $this->_tpl_vars['tag'] )): ?>&tag=<?php echo $this->_tpl_vars['tag']; ?>
<?php endif; ?>" -->