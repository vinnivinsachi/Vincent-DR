<?php /* Smarty version 2.6.19, created on 2010-08-14 20:56:51
         compiled from productlisting/_actions/_Removed.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/_actions/_Removed.tpl', 1, false),)), $this); ?>
<a href="<?php echo smarty_function_geturl(array('action' => 'sendproductlive'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['product_id']; ?>
&product=<?php echo $this->_tpl_vars['product']['product_type']; ?>
&tag=<?php echo $this->_tpl_vars['product']['product_tag']; ?>
"><img src="/public/resources/css/images/list.png" alt="List" title="List" /></a>
<?php if ($this->_tpl_vars['product']['purchase_type'] == 'Customizable'): ?>
<a href="<?php echo smarty_function_geturl(array('controller' => 'manageinventory','action' => 'addinventory'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['product_id']; ?>
" title='Edit details'><img src="/public/resources/css/images/inventory.png" alt="inventory" title="Manage inventory" /></a> 
<?php endif; ?>
<?php if ($this->_tpl_vars['product']['purchase_type'] == 'Customizable'): ?>
<a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'editproductattribute'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['product_id']; ?>
"><img src="/public/resources/css/images/details.png" alt="Edit Attributes" title="Edit Attributes"></a>
<?php endif; ?>