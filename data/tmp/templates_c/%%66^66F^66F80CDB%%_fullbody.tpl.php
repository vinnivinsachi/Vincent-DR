<?php /* Smarty version 2.6.19, created on 2010-08-25 19:39:31
         compiled from productdisplay/_productCustomizableAttribute/_fullbody.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'productdisplay/_productCustomizableAttribute/_fullbody.tpl', 38, false),)), $this); ?>
<div class='productDetailTop' class='box'>
	<div class='titleBarMid'>Customize order - please supply your required body measurements</div>
	</div>
	<label>Your height (cm):</label>
	<input type='text' name='attribute[Measurement_body_height]'/>cm
	<label>Neck circumference (cm):</label>
	<input type='text' name='attribute[Measurement_neck]'/>cm
	<label>Arm length (cm):</label>
	<input type='text' name='attribute[Measurement_arm_length]'/>cm
	<label>Wrist circumference (cm):</label>
	<input type='text' name='attribute[Measurement_wrist]'/>cm
	<label>Armpit circumference (cm):</label>
	<input type='text' name='attribute[Measurement_armpit_circumference]'/>cm
	<label>Shoulder width (cm):</label>
	<input type='text' name='attribute[Measurement_shoulder]'/>cm
	<label>Chest/bust (cm):</label>
	<input type='text' name='attribute[Measurement_chest_or_bust]'/>cm
	<label>Shoulder to chest/bust(cm)</label>
	<input type='text' name='attribute[Measurement_shoulder_to_chest_or_bust]'/>cm
	<label>Waist (cm):</label>
	<input type='text' name='attribute[Measurement_waist]'/>cm
	<label>Shoulder to waist (cm):</label>
	<input type='text' name='attribute[Measurement_shoulder_to_waist]'/>cm
	<label>Waist to floor (cm):</label>
	<input type='text' name='attribute[Measurement_waist_to_floor]'/>cm
	<label>Hip (cm):</label>
	<input type='text' name='attribute[Measurement_hip]'/>cm
	<label>Inseam (cm):</label>
	<input type='text' name='attribute[Measurement_inseam]'/>cm
	<label>Thigh circumference (cm):</label>
	<input type='text' name='attribute[Measurement_thigh_circumference]'/>cm
	<div class='box'>
	<label class='mid'>Color:</label>
	<div class='box' style='width:250px;'>
	<?php $_from = $this->_tpl_vars['product']['systemColorAndShoesAttributes']['colors']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['colorKey'] => $this->_tpl_vars['color']):
?>
		<?php if ($this->_tpl_vars['colorKey'] != 'product_id'): ?>
			<?php if ($this->_tpl_vars['color'] == '1'): ?>
			<input type='radio' name='attribute[color]' value='<?php echo $this->_tpl_vars['colorKey']; ?>
' /><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['colorKey']), $this);?>

			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</div>
	</div>
	<?php $_from = $this->_tpl_vars['product']['existingFabricSet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fabricSet']):
?>
	<div class='box'>
	
	<label class='mid'><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['fabricSet']['basicInfo']['0']['name_of_set']), $this);?>
</label>
			<div class='box' style='width:250px;'>
	
		<?php $_from = $this->_tpl_vars['fabricSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fabricSetDetail']):
?>
			<input type='radio' name='attribute[<?php echo $this->_tpl_vars['fabricSet']['basicInfo']['0']['name_of_set']; ?>
]' value='<?php echo $this->_tpl_vars['fabricSetDetail']['details_name']; ?>
'/><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['fabricSetDetail']['details_name']), $this);?>

		<?php endforeach; endif; unset($_from); ?>
		</div>
			</div>
		
	<?php endforeach; endif; unset($_from); ?>
	
	<?php $_from = $this->_tpl_vars['product']['existingAttributeSet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customSet']):
?>
	<div class='box'>
	<label class='mid'><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['customSet']['basicInfo']['0']['name_of_set']), $this);?>
</label>
			<div class='box' style='width:250px;'>
	
		<?php $_from = $this->_tpl_vars['customSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customSetDetail']):
?>
			<input type='radio' name='attribute[<?php echo $this->_tpl_vars['customSet']['basicInfo']['0']['name_of_set']; ?>
]' value='<?php echo $this->_tpl_vars['customSetDetail']['details_name']; ?>
'/><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['customSetDetail']['details_name']), $this);?>

		<?php endforeach; endif; unset($_from); ?>
		</div>
	</div>
	<?php endforeach; endif; unset($_from); ?>
	<div class='box'>
	<label>Backorder time:</label>
	<?php echo $this->_tpl_vars['product']['0']['backorder_time']; ?>

	</div>
	<div class='box' style='margin-top:5px;'>
	<label>Addtional instructions:</label>
 	<textarea rows="5" cols=20" name='attribute[additional_instructions]'></textarea>
 	</div>
	
 <div class='box' style='padding-top:20px;'>
  <?php if ($this->_tpl_vars['product']['discount_price'] == '' || $this->_tpl_vars['product']['discount_price'] == 0): ?>
                  <div class="discountBoxPrice">
                     $<?php echo $this->_tpl_vars['product']['0']['price']; ?>

                  </div>
                 <?php elseif ($this->_tpl_vars['product']['discount_price'] > 0): ?>
                  <div class="productBoxPrice">
                      $<?php echo $this->_tpl_vars['product']['0']['price']; ?>

                   </div>

               <div class="discountBoxPrice">
                $<?php echo $this->_tpl_vars['product']['0']['discount_price']; ?>

               </div>
            <?php endif; ?>
 </div>