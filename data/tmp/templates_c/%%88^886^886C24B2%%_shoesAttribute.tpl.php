<?php /* Smarty version 2.6.19, created on 2010-08-14 21:12:53
         compiled from productlisting/_attributes/_shoesAttribute.tpl */ ?>
	<label>Size selection:</label>

	<select name='inventory[sys_shoe_metric]' class='inputShiftOne'>
		<option value='EU' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_metric'] == 'EU'): ?> selected="selected"<?php endif; ?>>Euro Size</option>
		<option value='US' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_metric'] == 'US'): ?> selected="selected"<?php endif; ?>>US Size</option>
		<option value='BR' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_metric'] == 'BR'): ?> selected="selected"<?php endif; ?>>British Size</option>
	</select>
	<select name="inventory[sys_shoe_size]">
		<?php $_from = $this->_tpl_vars['measurements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['measurement']):
?>
		<option value='<?php echo $this->_tpl_vars['measurement']; ?>
' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_size'] == $this->_tpl_vars['measurement']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['measurement']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select><br/>
	<label>Heel size:</label>
	<select name="inventory[sys_shoe_heel]" class='inputShiftOne'>
			<option value='1 inch' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_heel'] == '1 inch'): ?> selected="selected"<?php endif; ?>>1 inch</option>
			<option value='1.5 inch' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_heel'] == '1.5 inch'): ?> selected="selected"<?php endif; ?>>1.5 inch</option>
			<option value='2 inch' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_heel'] == '2 inch'): ?> selected="selected"<?php endif; ?>>2 inch</option>
			<option value='2.5 inch' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_heel'] == '2.5 inch'): ?> selected="selected"<?php endif; ?>>2.5 inch</option>
			<option value='3 inch' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_heel'] == '3 inch'): ?> selected="selected"<?php endif; ?>>3 inch</option>
			<option value='50 mm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_heel'] == '50 mm'): ?> selected="selected"<?php endif; ?>>50 mm</option>
			<option value='70 mm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_heel'] == '70 mm'): ?> selected="selected"<?php endif; ?>>70 mm</option>
			<option value='90 mm' <?php if ($this->_tpl_vars['inventory']['basic']['sys_shoe_heel'] == '90 mm'): ?> selected="selected"<?php endif; ?>>90 mm</option>
	</select>
			
</div>

<div class='formRightDivision'>
			<div class="danceWearPartials">
			<div class='titleBarMid'><strong>Product Details</strong></div>
			
	