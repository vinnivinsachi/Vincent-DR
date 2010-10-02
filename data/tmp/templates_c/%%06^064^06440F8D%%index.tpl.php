<?php /* Smarty version 2.6.19, created on 2010-09-01 14:45:40
         compiled from adminaccount/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'adminaccount/index.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
Welcome, <?php echo $this->_tpl_vars['signedInUser']->generalInfo->first_name; ?>
.
<br />
This is the master admin page. this account is only for network admins only. <br/>
<ul>
	<li>View and manage user requests</li>
    	<ul><li>such as message remove requests, shout out remove requests, review remove requests</li></ul>
	<li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminaccount','action' => 'allusers'), $this);?>
">View and manage users</a></li>
    <li><a href="<?php echo smarty_function_geturl(array('controller' => 'adminorders','action' => 'index'), $this);?>
">View and manage orders and transactions</a></li>
    <li>View and manage products</li>
    <li>View and manage messages and shoutouts</li>
    <li>View and manage promotions</li>
</ul>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>