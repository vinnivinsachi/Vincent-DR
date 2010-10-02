<?php /* Smarty version 2.6.19, created on 2010-08-15 14:18:59
         compiled from productlisting/_attributes/_topAttribute.tpl */ ?>
<label>Size:</label>
<select name='inventory[sys_fullbody_size]' class='inputShiftOne'>
		<option value='XS' <?php if ($this->_tpl_vars['inventory']['basic']['sys_fullbody_size'] == 'XS'): ?> selected="selected"<?php endif; ?>>XS (0-2)</option>
		<option value='S' <?php if ($this->_tpl_vars['inventory']['basic']['sys_fullbody_size'] == 'S'): ?> selected="selected"<?php endif; ?>>S (3-4)</option>
		<option value='M' <?php if ($this->_tpl_vars['inventory']['basic']['sys_fullbody_size'] == 'M'): ?> selected="selected"<?php endif; ?>>M (5-6)</option>
		<option value='L' <?php if ($this->_tpl_vars['inventory']['basic']['sys_fullbody_size'] == 'L'): ?> selected="selected"<?php endif; ?>>L (7-8)</option>
		<option value='XL' <?php if ($this->_tpl_vars['inventory']['basic']['sys_fullbody_size'] == 'XL'): ?> selected="selected"<?php endif; ?>>XL (9-10)</option>
</select>
		
</div>

<div class='formRightDivision'>
			<div class="danceWearPartials">

<div class='titleBarMid '><strong>Product Details</strong></div>
<?php $_from = $this->_tpl_vars['measurements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['measurement']):
?>
<label><?php echo $this->_tpl_vars['Key']; ?>
</label>
	<select name='inventory[<?php echo $this->_tpl_vars['Key']; ?>
]' class='inputShiftOne'>
		<?php $_from = $this->_tpl_vars['inventory']['profile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['profile']):
?>
			<?php if ($this->_tpl_vars['Key'] == $this->_tpl_vars['profile']['profile_key']): ?>
				<option value='<?php echo $this->_tpl_vars['profile']['profile_value']; ?>
'><?php echo $this->_tpl_vars['profile']['profile_value']; ?>
</option>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php $_from = $this->_tpl_vars['measurement']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
		<option value='<?php echo $this->_tpl_vars['value']; ?>
 cm'><?php echo $this->_tpl_vars['value']; ?>
 cm</option>
		<?php endforeach; endif; unset($_from); ?>
	</select><br/>
<?php endforeach; endif; unset($_from); ?>