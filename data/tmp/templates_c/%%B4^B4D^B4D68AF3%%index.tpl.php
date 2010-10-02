<?php /* Smarty version 2.6.19, created on 2010-08-27 13:50:33
         compiled from shoppingcart/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'shoppingcart/index.tpl', 9, false),array('function', 'geturl', 'shoppingcart/index.tpl', 17, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="leftContainer" style="width:210px; float:left;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/leftColumnIndex.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="rightContainer" style='width:750px; float:left; padding:20px;'>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/indexTagHeader.tpl', 'smarty_include_vars' => array('indexTagHeaderTitleName' => 'Shopping cart')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div id="orderMainDiv" style="float:left; width:100%;">
    	            <?php if (count($this->_tpl_vars['shoppingCartProducts']) > 0): ?>
    	
        	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/shoppingcart/_basketInformation.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
         <?php else: ?>
            Your shopping cart is empty.
            <?php endif; ?>
       	<!-- end of product forloop-->
        <div id="proceedShoppingCart" style="width:100%; float:left; text-align:right;">
         	<a href="<?php echo smarty_function_geturl(array('action' => 'resetshoppingcart'), $this);?>
" style="float:left; margin-top:10px;"><img src="/public/resources/css/images/empty Cart.gif" /></a>
            <?php if ($this->_tpl_vars['shoppingCartInfo']->totalItems > 0): ?>
        	<a href="<?php echo smarty_function_geturl(array('controller' => 'checkout','action' => 'index'), $this);?>
" style="float:right; margin-top:10px;"><img src="/public/resources/css/images/nextToCheckout.gif" /></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>