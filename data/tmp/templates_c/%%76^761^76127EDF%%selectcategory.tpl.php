<?php /* Smarty version 2.6.19, created on 2010-06-12 19:32:33
         compiled from productlisting/selectcategory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/selectcategory.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
Please select which category you are uploading
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=women">Women</a>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men">Men</a>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=jewelry">Jewelry</a>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=accessories">Accessories</a>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>