<?php /* Smarty version 2.6.19, created on 2010-06-12 21:37:11
         compiled from productlisting/selectjewelrytype.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/selectjewelrytype.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
Please select which jewelry you are uploading<br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=jewelry&type=jewelry&tag=sets">Jewelry sets</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=jewelry&type=jewelry&tag=hair">Hair jewelry</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=jewelry&type=jewelry&tag=earing">Earing</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=jewelry&type=jewelry&tag=necklace">Necklace</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=jewelry&type=jewelry&tag=wrist">Wrist jewelry</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=jewelry&type=jewelry&tag=clothing">Jewelry for clothing</a><br/>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>