<?php /* Smarty version 2.6.19, created on 2010-06-13 15:38:02
         compiled from productlisting/selectmenproducttype.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/selectmenproducttype.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
Please select which category (men) you are uploading<br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=shoes&tag=men latin shoes">Mens latin shoes</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=shoes&tag=men standard shoes">Mens standard shoes</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=shoes&tag=men practice shoes">Mens practice shoes</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=sets&tag=men suits">Mens suits</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=tailsuits&tag=men tailsuits">Mens tailsuits</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=costumes&tag=men costumes">Mens costumes</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=shirts&tag=men shirts">Mens shirts</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=pants&tag=men pants">Mens pants</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=vests&tag=men vests">Mens vests</a><br/>
<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product_purchase_type']; ?>
&category=men&type=jackets&tag=men jackets">Mens jackets</a><br/>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>