<?php /* Smarty version 2.6.19, created on 2010-08-09 20:44:35
         compiled from account/editshipping.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'account/editshipping.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'editshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['addressID']; ?>
">

	<fieldset>
    	<?php if ($this->_tpl_vars['fp']->addShipping == 'true'): ?>
        <legend>Add new shipping Address</legend>
        <?php else: ?>
        <legend>Edit Shipping</legend>
		<?php endif; ?>
        
        <label>Address One: </label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->address_one; ?>
" name="address_one"/><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('address_one'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <label>Address Two:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->address_two; ?>
" name="address_two"/><br />
        <label>City: </label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->city; ?>
" name="city"/><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('city'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <label>State:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->state; ?>
" name="state"/><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('state'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <label>Country:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->country; ?>
" name="country"/><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('country'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <label>Zip:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->zip; ?>
" name="zip" /><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('zip'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <input type="checkbox" name="defaultShipping" />Set as default shipping<br />
        <input type="submit" value="save"/>
        <a href="<?php echo $this->_tpl_vars['returnAddress']; ?>
">Cancel</a>
        
    </fieldset>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>