<?php /* Smarty version 2.6.19, created on 2010-08-13 17:53:52
         compiled from manageinventory/_shoesAttribute.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'manageinventory/_shoesAttribute.tpl', 21, false),)), $this); ?>
	<label>Size selection:</label>

	<select name='sys_shoe_metric' class='inputShiftOne'>
		<?php if ($this->_tpl_vars['product']['0']['purchase_type'] == 'Customizable'): ?>
		<option value='<?php echo $this->_tpl_vars['product']['systemColorAndShoesAttributes']['shoes']['0']['shoes_metric']; ?>
'><?php echo $this->_tpl_vars['product']['systemColorAndShoesAttributes']['shoes']['0']['shoes_metric']; ?>
</option>
		<?php else: ?>
		<option value='EU'>Euro Size</option>
		<option value='US'>US Size</option>
		<option value='BR'>British Size</option>
		<?php endif; ?>
	</select>
	<select name="sys_shoe_size">
		<?php $_from = $this->_tpl_vars['measurements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['measurement']):
?>
		<option value='<?php echo $this->_tpl_vars['measurement']; ?>
'><?php echo $this->_tpl_vars['measurement']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select><br/>
	<label>Heel size:</label>
	<select name="sys_shoe_heel" class='inputShiftOne'>
		<?php if ($this->_tpl_vars['product']['0']['purchase_type'] == 'Customizable'): ?>
			<?php $_from = $this->_tpl_vars['heels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<option value='<?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['item']), $this);?>
'><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['item']), $this);?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<option value='1 inch'>1 inch</option>
			<option value='1.5 inch'>1.5 inch</option>
			<option value='2 inch'>2 inch</option>
			<option value='2.5 inch'>2.5 inch</option>
			<option value='3 inch'>3 inch</option>
			<option value='50 mm'>50 mm</option>
			<option value='70 mm'>70 mm</option>
			<option value='90 mm'>90 mm</option>
		<?php endif; ?>
	</select>