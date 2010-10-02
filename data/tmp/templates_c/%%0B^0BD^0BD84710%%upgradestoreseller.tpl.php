<?php /* Smarty version 2.6.19, created on 2010-08-09 20:42:47
         compiled from account/upgradestoreseller.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'account/upgradestoreseller.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'upgradestoreseller'), $this);?>
">

	<fieldset>
    	<legend>General Seller Information</legend>
        <label>Paypal Email:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->paypal_email; ?>
" name="paypal_email" <?php if ($this->_tpl_vars['fp']->paypal_email != '' && $this->_tpl_vars['fp']->verified == '1'): ?>disabled=disabled<?php endif; ?>/><br />
        <label>Phone Number:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->phone_number; ?>
" name="phone_number" /><br />
        <label>Please describe the items that you intend to sell:</label><br />
        <textarea value="" rows="5" cols="30" name="items_description"><?php echo $this->_tpl_vars['fp']->items_description; ?>
</textarea><br />
        <label>Please describe your store:</label>
        <textarea value="" rows="5" cols="30" name="store_description"><?php echo $this->_tpl_vars['fp']->store_description; ?>
</textarea><br />
        This is the seller&acute;s address.<br />
        <label>Seller Address One: </label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->address_one; ?>
" name="address_one"/><br />
        <label>Seller Address Two :</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->address_two; ?>
" name="address_two"/><br />
        <label>City: </label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->city; ?>
" name="city"/><br />
        <label>State:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->state; ?>
" name="state"/><br />
        <label>Country:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->country; ?>
" name="country"/><br />
        <label>Zip:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->zip; ?>
" name="zip" /><br />
        type is: <?php echo $this->_tpl_vars['fp']->type; ?>
<br />
        <input type="hidden" name="submitType" value="<?php echo $this->_tpl_vars['fp']->type; ?>
" /><br />
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