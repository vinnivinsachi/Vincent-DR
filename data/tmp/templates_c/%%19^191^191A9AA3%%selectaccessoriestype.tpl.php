<?php /* Smarty version 2.6.19, created on 2010-06-12 22:52:34
         compiled from productlisting/selectaccessoriestype.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/selectaccessoriestype.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
Please select product accessories types<br/>

<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=accessories&type=accessories&tag=shoe brushes">Shoe brushes</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=accessories&type=accessories&tag=heel protector">Heel protector</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=accessories&type=accessories&tag=soles">Soles</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=accessories&type=accessories&tag=bags">Bags</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=accessories&type=accessories&tag=robes">Robes</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=accessories&type=accessories&tag=belts">Belts</a><br/>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>