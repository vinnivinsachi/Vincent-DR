<?php /* Smarty version 2.6.19, created on 2010-06-22 14:02:32
         compiled from productlisting/_shoesAttribute.tpl */ ?>
	<br/>
	<br/>
	<strong style="font-size:1.5em;">Shoes Attribute Selection</strong><br/><br/>
	Type of metric<select name="shoes_metric">
		<option value="US">US size</option>
		<option value="EU">Euro Size</option>
		<option value="BR">British Size</option>
	</select>
	<br/>
	Minimum available size<select name="min_size">
		<?php $_from = $this->_tpl_vars['measurement']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
			<option value="<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
	Max availabe size
	<select name="max_size">
		<?php $_from = $this->_tpl_vars['measurement']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
			<option value="<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
	Size interval
	<select name="size_interval">
		<option value="0.5">0.5</option>
		<option value="1">1</option>
	</select>