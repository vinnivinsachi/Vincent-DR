<?php /* Smarty version 2.6.19, created on 2010-08-09 20:40:21
         compiled from account/editbasicinfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'account/editbasicinfo.tpl', 6, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="leftContainer" style="width:49%; float:left;">	

</div>
<div id="rightContainer" style="width:49%; float:left;">
<form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'editbasicinfo'), $this);?>
">

	<fieldset>
    	<legend>Basic Info</legend>
        <label>Username: </label> <?php echo $this->_tpl_vars['fp']->username; ?>
<br />
        <label>Usertype: </label> <?php echo $this->_tpl_vars['fp']->user_type; ?>
<br />
        <label>Email: </label> <?php echo $this->_tpl_vars['fp']->email; ?>
<br />
        <label><strong style="color:#003366; font-size:1.7em;">*</strong>Password:</label>
        <input <?php if ($this->_tpl_vars['edit'] == 'false'): ?>disabled="disabled"<?php endif; ?>  type="password" id="form_password" name="password"/><br /><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('password'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <label><strong style="color:#003366; font-size:1.7em;">*</strong>Retype Password: </label>
        <input <?php if ($this->_tpl_vars['edit'] == 'false'): ?>disabled="disabled"<?php endif; ?> type="password" id="form_confirm_password" name="confirm_password" /><br /><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('confirm_password'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <label>First name: </label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->first_name; ?>
" name="first_name" /><br />
		<label>Last name: </label>
   		<input type="text" value="<?php echo $this->_tpl_vars['fp']->last_name; ?>
" name="last_name" /><br />
        <label>Gender:</label><?php echo $this->_tpl_vars['fp']->sex; ?>
<br />
        <label>Affiliations:</label>
    	<input type="text" value="<?php echo $this->_tpl_vars['fp']->affiliation; ?>
" name="affiliation" /><br />
		<label>Dance experience:</label>
		<select name="experience">
            <option value="social" <?php if ($this->_tpl_vars['fp']->experience == 'social'): ?> selected="selected"<?php endif; ?>>Social</option>
            <option value="beginner" <?php if ($this->_tpl_vars['fp']->experience == 'beginner'): ?> selected="selected"<?php endif; ?>>Beginner</option>
            <option value="collegiate" <?php if ($this->_tpl_vars['fp']->experience == 'collegiate'): ?> selected="selected"<?php endif; ?>>Collegiate</option>
            <option value="amature" <?php if ($this->_tpl_vars['fp']->experience == 'amature'): ?> selected="selected"<?php endif; ?>>Amature</option>
            <option value="professional" <?php if ($this->_tpl_vars['fp']->experience == 'professional'): ?> selected="selected"<?php endif; ?>>Professional</option>
        </select>  <br />
        <label>Hear about us: </label> <?php echo $this->_tpl_vars['fp']->hear_about_us; ?>
<br />
       		
        <input type="submit" value="save"/>
        <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'details'), $this);?>
">Cancel</a>
        
    </fieldset>
</form>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>