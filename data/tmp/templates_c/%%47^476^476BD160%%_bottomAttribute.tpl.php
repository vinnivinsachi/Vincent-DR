<?php /* Smarty version 2.6.19, created on 2010-08-17 15:29:37
         compiled from productlisting/_attributes/_bottomAttribute.tpl */ ?>
<label>Waist:</label>
<select name='inventory[sys_bottom_size]' class='inputShiftOne'>
		<option value='XS' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == 'XS'): ?> selected="selected"<?php endif; ?>>XS</option>
		<option value='S' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == 'S'): ?> selected="selected"<?php endif; ?>>S</option>
		<option value='M' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == 'M'): ?> selected="selected"<?php endif; ?>>M</option>
		<option value='L' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == 'L'): ?> selected="selected"<?php endif; ?>>L</option>
		<option value='XL' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == 'XL'): ?> selected="selected"<?php endif; ?>>XL</option>
		<option value='50 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '50 cm'): ?> selected="selected"<?php endif; ?>>50 cm</option>
		<option value='53 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '53 cm'): ?> selected="selected"<?php endif; ?>>53 cm</option>
		<option value='56 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '56 cm'): ?> selected="selected"<?php endif; ?>>56 cm</option>
		<option value='59 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '59 cm'): ?> selected="selected"<?php endif; ?>>59 cm</option>
		<option value='62 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '62 cm'): ?> selected="selected"<?php endif; ?>>62 cm</option>
		<option value='65 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '65 cm'): ?> selected="selected"<?php endif; ?>>65 cm</option>
		<option value='68 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '68 cm'): ?> selected="selected"<?php endif; ?>>68 cm</option>
		<option value='71 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '71 cm'): ?> selected="selected"<?php endif; ?>>71 cm</option>
		<option value='74 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '74 cm'): ?> selected="selected"<?php endif; ?>>74 cm</option>
		<option value='77 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '77 cm'): ?> selected="selected"<?php endif; ?>>77 cm</option>
		<option value='80 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '80 cm'): ?> selected="selected"<?php endif; ?>>80 cm</option>
		<option value='83 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '83 cm'): ?> selected="selected"<?php endif; ?>>83 cm</option>
		<option value='86 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '86 cm'): ?> selected="selected"<?php endif; ?>>86 cm</option>
		<option value='89 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '89 cm'): ?> selected="selected"<?php endif; ?>>89 cm</option>
		<option value='92 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '92 cm'): ?> selected="selected"<?php endif; ?>>92 cm</option>
		<option value='95 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '95 cm'): ?> selected="selected"<?php endif; ?>>95 cm</option>
		<option value='98 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '98 cm'): ?> selected="selected"<?php endif; ?>>98 cm</option>
		<option value='101 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '101 cm'): ?> selected="selected"<?php endif; ?>>101 cm</option>
		<option value='104 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '104 cm'): ?> selected="selected"<?php endif; ?>>104 cm</option>
		<option value='107 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '107 cm'): ?> selected="selected"<?php endif; ?>>107 cm</option>
		<option value='110 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '110 cm'): ?> selected="selected"<?php endif; ?>>110 cm</option>
		<option value='113 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '113 cm'): ?> selected="selected"<?php endif; ?>>113 cm</option>
		<option value='116 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '116 cm'): ?> selected="selected"<?php endif; ?>>116 cm</option>
		<option value='119 cm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_bottom_size'] == '119 cm'): ?> selected="selected"<?php endif; ?>>119 cm</option>
</select>
		
</div>

<div class='formRightDivision'>
			<div class="danceWearPartials">


<div class='titleBarMid '><strong>Product details</strong></div>
<?php $_from = $this->_tpl_vars['measurements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['measurement']):
?>
<label><?php echo $this->_tpl_vars['Key']; ?>
:</label>
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