<?php /* Smarty version 2.6.19, created on 2010-06-11 13:43:37
         compiled from lib/error.tpl */ ?>

<span class="error" <?php if (! ( ( $this->_tpl_vars['error'] | is_array ) || ( $this->_tpl_vars['error'] | strlen ) > 0 )): ?> style="display:none" <?php endif; ?> >
	<?php if ($this->_tpl_vars['error'] | @ is_array): ?>
		<ul>
			<?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str']):
?>
				<li><?php echo $this->_tpl_vars['str']; ?>
</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php else: ?>
		<?php echo $this->_tpl_vars['error']; ?>

	<?php endif; ?>
</span>