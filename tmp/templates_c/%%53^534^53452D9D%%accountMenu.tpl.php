<?php /* Smarty version 2.6.26, created on 2011-01-04 12:32:49
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
		<a id='login-link' href='<?php echo $this->_tpl_vars['siteRoot']; ?>
/authentication/login'>Login</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
		<a href='<?php echo $this->_tpl_vars['siteRoot']; ?>
/register'>Register</a>
	<?php endif; ?>
</div>

<?php echo '
<script type=\'text/javascript\'>
	$j(\'a#login-link\').fancybox({content: \'<object width="300" height="300" data="'; ?>
<?php echo $this->_tpl_vars['siteRoot']; ?>
/authentication/login<?php echo '">???</object>\'});
</script>
'; ?>
