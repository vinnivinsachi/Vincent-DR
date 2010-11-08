<?php /* Smarty version 2.6.26, created on 2010-11-08 08:14:06
         compiled from layouts/default/accountMenu.tpl */ ?>
<div id='account_menu'>
	<?php if ($this->_tpl_vars['loggedInUser']): ?>
        Welcome <?php echo $this->_tpl_vars['loggedInUser']->username; ?>
!<br />
        <a href='<?php echo $this->_tpl_vars['siteRoot']; ?>
/account'>My Account</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
        <a href='<?php echo $this->_tpl_vars['siteRoot']; ?>
/authentication/logout'>Logout</a>
	<?php else: ?>
		<a href='<?php echo $this->_tpl_vars['siteRoot']; ?>
/authentication/login'>Login</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
		<a href='<?php echo $this->_tpl_vars['siteRoot']; ?>
/account/register'>Register</a>
	<?php endif; ?>
</div>