<?php /* Smarty version 2.6.19, created on 2010-08-11 17:02:45
         compiled from partials/error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'partials/error.tpl', 1, false),array('modifier', 'strlen', 'partials/error.tpl', 1, false),array('modifier', 'escape', 'partials/error.tpl', 5, false),)), $this); ?>
<span class="error" <?php if (! ( ( ((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) ) || ( ((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) ) > 0 )): ?> style="display:none;" <?php endif; ?>>
	<?php if (is_array($this->_tpl_vars['error'])): ?>
		<ul>
			<?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str']):
?>
				<li><?php echo ((is_array($_tmp=$this->_tpl_vars['str'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php else: ?>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

	<?php endif; ?>
</span>