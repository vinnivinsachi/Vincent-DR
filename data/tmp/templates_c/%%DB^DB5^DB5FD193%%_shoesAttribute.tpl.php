<?php /* Smarty version 2.6.19, created on 2010-08-13 03:33:04
         compiled from manageattribute/_shoesAttribute.tpl */ ?>
	<div class='titleBarMid'><strong>Basic product attributes</strong></div>
	<label>Size type</label><select name="shoes_metric">
		<option value="US" <?php if ($this->_tpl_vars['colorsAndShoesAttributes']['shoes']['0']['shoes_metric'] == 'US'): ?>selected='selected'<?php endif; ?>>US size</option>
		<option value="EU" <?php if ($this->_tpl_vars['colorsAndShoesAttributes']['shoes']['0']['shoes_metric'] == 'EU'): ?>selected='selected'<?php endif; ?>>Euro size</option>
		<option value="BR" <?php if ($this->_tpl_vars['colorsAndShoesAttributes']['shoes']['0']['shoes_metric'] == 'BR'): ?>selected='selected'<?php endif; ?>>British size</option>
	</select>
	<br/>
	<label>Smallest available size</label><select name="min_size">
		<?php $_from = $this->_tpl_vars['measurement']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
			<option value="<?php echo $this->_tpl_vars['value']; ?>
" <?php if ($this->_tpl_vars['colorsAndShoesAttributes']['shoes']['0']['min_size'] == $this->_tpl_vars['value']): ?>selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select><br/>
	<label>Largest available size</label>
	<select name="max_size">
		<?php $_from = $this->_tpl_vars['measurement']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
			<option value="<?php echo $this->_tpl_vars['value']; ?>
" <?php if ($this->_tpl_vars['colorsAndShoesAttributes']['shoes']['0']['max_size'] == $this->_tpl_vars['value']): ?>selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select><br/>
	<label>Size interval</label>
	<select name="size_interval">
		<option value="0.5" <?php if ($this->_tpl_vars['colorsAndShoesAttributes']['shoes']['0']['size_interval'] == $this->_tpl_vars['value']): ?>selected='selected'<?php endif; ?>>0.5</option>
		<option value="1" <?php if ($this->_tpl_vars['colorsAndShoesAttributes']['shoes']['0']['size_interval'] == $this->_tpl_vars['value']): ?>selected='selected'<?php endif; ?>>1</option>
	</select><br/>
	<label>Heel size selections</label>
	<div style='float:left; width:58%;'>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[one_inch]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['one_inch'] == '1'): ?>checked='checked'<?php endif; ?>/>1 inch</div>  
	<div style='float:left; width:30%'><input type="checkbox" name="heel[one_half_inch]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['one_half_inch'] == '1'): ?>checked='checked'<?php endif; ?>/>1.5 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[two_inch]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['two_inch'] == '1'): ?>checked='checked'<?php endif; ?>/>2 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[two_half_inch]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['two_half_inch'] == '1'): ?>checked='checked'<?php endif; ?>/>2.5 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[three_inch]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['three_inch'] == '1'): ?>checked='checked'<?php endif; ?>/>3 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[three_half_inch]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['three_half_inch'] == '1'): ?>checked='checked'<?php endif; ?>/>3.5 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[heel_50_mm]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['heel_50_mm'] == '1'): ?>checked='checked'<?php endif; ?>/>50 mm</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[heel_70_mm]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['heel_70_mm'] == '1'): ?>checked='checked'<?php endif; ?>/>70 mm</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[heel_90_mm]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['heels']['0']['heel_90_mm'] == '1'): ?>checked='checked'<?php endif; ?>/>90 mm</div>
	</div>