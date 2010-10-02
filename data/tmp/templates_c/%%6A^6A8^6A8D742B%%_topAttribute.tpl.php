<?php /* Smarty version 2.6.19, created on 2010-08-24 14:36:44
         compiled from manageinventory/_topAttribute.tpl */ ?>
<label>Size:</label>
<select name='sys_top_size' class='inputShiftOne'>
		<option value='XS'>XS (0-2)</option>
		<option value='S'>S (3-4)</option>
		<option value='M'>M (5-6)</option>
		<option value='L'>L (7-8)</option>
		<option value='XL'>XL (9-10)</option>
</select><br/>

<div class='titleBarMid marginTop20'><strong>Product Details</strong></div>
<?php $_from = $this->_tpl_vars['measurements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['measurement']):
?>
<label><?php echo $this->_tpl_vars['Key']; ?>
</label>
	<select name='<?php echo $this->_tpl_vars['Key']; ?>
' class='inputShiftOne'>
		<?php $_from = $this->_tpl_vars['measurement']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
		<option value='<?php echo $this->_tpl_vars['value']; ?>
 cm'><?php echo $this->_tpl_vars['value']; ?>
 cm</option>
		<?php endforeach; endif; unset($_from); ?>
	</select><br/>
<?php endforeach; endif; unset($_from); ?>
<div class='sys_quantity_div'>
			<label>Quantity:</label>
			<select name='sys_quantity' class='inputShiftOne'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
			<option value='6'>5</option>
			<option value='7'>7</option>
			<option value='8'>8</option>
			<option value='9'>9</option>
			<option value='10'>10</option>
			</select>
			</div>