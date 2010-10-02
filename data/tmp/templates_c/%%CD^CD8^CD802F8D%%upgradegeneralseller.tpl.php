<?php /* Smarty version 2.6.19, created on 2010-06-11 17:21:47
         compiled from account/upgradegeneralseller.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'account/upgradegeneralseller.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'upgradegeneralseller'), $this);?>
">

	<fieldset>
    	<legend>General Seller Information</legend>
        General sellers are able to post any items that they current have. Their items will show up under the users market<br />
   		
        <label>Paypal Email:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->paypal_email; ?>
" name="paypal_email" <?php if ($this->_tpl_vars['fp']->paypal_email != '' && $this->_tpl_vars['fp']->verified == '1'): ?>disabled=disabled<?php endif; ?>/><br />
        <span style="float:left;">Paypal email can NOT be changed once added AND verified</span><br />

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('paypal_email'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <label>Phone Number:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->phone_number; ?>
" name="phone_number" /><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('phone_number'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        This is the seller&acute;s address.<br />
        <label>Seller Address One: </label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->address_one; ?>
" name="address_one"/><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('address_one'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <label>Seller Address Two :</label>
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
        <input type="submit" value="Apply" name="apply"/>
        
        <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'details'), $this);?>
">Cancel</a>
    </fieldset>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>