<?php /* Smarty version 2.6.19, created on 2010-09-02 11:39:34
         compiled from adminorders/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'adminorders/index.tpl', 4, false),array('modifier', 'count', 'adminorders/index.tpl', 11, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
Welcome to order management, <?php echo $this->_tpl_vars['signedInUser']->generalInfo->first_name; ?>
.<br />

<a href="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'automatedeliveryttocomplete'), $this);?>
">Automate [delivered/return delivered] to [complete/return complete]</a>
<br />


<div id="orderTabs" style="width:99%;">

    	  <ul>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=unshipped">Unshipped (<?php echo count($this->_tpl_vars['orderProfiles']->unshippedOrders); ?>
)</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=shipped">Shipped (<?php echo count($this->_tpl_vars['orderProfiles']->shippedOrders); ?>
)</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=delivered">Delivered</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=completed">Completed (<?php echo count($this->_tpl_vars['orderProfiles']->completedOrders); ?>
)</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=payment transfered">Payment Transfered (<?php echo count($this->_tpl_vars['orderProfiles']->paymentTransfered); ?>
)</a></li>
			<li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=return shipped">Returned (<?php echo count($this->_tpl_vars['orderProfiles']->returnShippedOrders); ?>
)</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=return delivered">Return Delivered </a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=return completed">Return completed (<?php echo count($this->_tpl_vars['orderProfiles']->returnCompleteOrders); ?>
)</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=payment returned">Payment returned (<?php echo count($this->_tpl_vars['orderProfiles']->paymentReturned); ?>
)</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=cancelled by buyer">B Cancelled (<?php echo count($this->_tpl_vars['orderProfiles']->cancelledByBuyer); ?>
)</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'getorderprofiletype'), $this);?>
?type=cancelled by seller">S Cancelled (<?php echo count($this->_tpl_vars['orderProfiles']->cancelledBySeller); ?>
)</a></li>
         </ul>
    	<!--<?php $_from = $this->_tpl_vars['orderProfiles']->unshippedOrders; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['unshippedOrder']):
?>
        	<?php echo $this->_tpl_vars['unshippedOrder']['product_name']; ?>

        <?php endforeach; endif; unset($_from); ?>-->
</div>

<?php echo '
<!--<script type="text/javascript">
$j(document).ready(function(){
							
							$j(\'#orderTabs\').tabs({
								load: function(event, ui) {
									$j(\'a\', ui.panel).click(function() {
										$j(ui.panel).load(this.href);
										return false;
									});
								}
});
});
</script>-->
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>