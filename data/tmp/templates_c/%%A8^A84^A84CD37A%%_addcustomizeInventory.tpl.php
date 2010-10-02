<?php /* Smarty version 2.6.19, created on 2010-08-11 21:34:24
         compiled from manageinventory/_addcustomizeInventory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'manageinventory/_addcustomizeInventory.tpl', 4, false),array('function', 'removeunderscore', 'manageinventory/_addcustomizeInventory.tpl', 25, false),array('modifier', 'count', 'manageinventory/_addcustomizeInventory.tpl', 22, false),)), $this); ?>
<div id='addInventoryFormMainDiv' style='padding-bottom:10px; float:left; width:100%;'>
		<div class='titleBarBig'>Add an inventory product - <?php echo $this->_tpl_vars['product']['0']['name']; ?>

		<span style='float:right; font-weight:normal;'>
		<a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'editproduct'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product']['0']['purchase_type']; ?>
&category=<?php echo $this->_tpl_vars['product']['0']['product_category']; ?>
&type=<?php echo $this->_tpl_vars['product']['0']['product_type']; ?>
&tag=<?php echo $this->_tpl_vars['product']['0']['product_tag']; ?>
&id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
" style='margin-right:20px;'>< Edit basic information</a>
		<a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'editproductattribute'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
">< Edit product attribute</a></span>
		</div>
		
		<button type='button' style='float:left;' onClick="this.hide(); Effect.BlindDown('addProductInventory');">Add an inventory product</button>
		<form id='addProductInventory' enctype="multipart/form-data" action='<?php echo smarty_function_geturl(array('controller' => 'manageinventory','action' => 'addinventory'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
' method='post' style='display:none;'>
		<div class="manageInventoryMainDiv" >
			<div class='formLeftDivision'>
		
			<div class='titleBarMid'><strong>Basic info</strong></div>
			<div class="inventoryName">
				<label>Name of inventory product:</label>
				<input type='text' name='sys_name' value='<?php echo $this->_tpl_vars['product']['0']['name']; ?>
' class='inputShiftOne'/>
			</div>
			
			<div class="systemColorSelection">
	        	<label>Color selection:</label>
				<select name='sys_color' class='inputShiftOne'>
				<?php if (count($this->_tpl_vars['product']['systemColorAndShoesAttributes']['colors']['0']) > 0): ?>
				<?php $_from = $this->_tpl_vars['product']['systemColorAndShoesAttributes']['colors']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['sysColor']):
?>
					<?php if ($this->_tpl_vars['sysColor'] == '1'): ?>
						<option value=<?php echo $this->_tpl_vars['Key']; ?>
><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['Key']), $this);?>
</option>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				<?php else: ?>
					<option value='Black'>Black</option>
					<option value='Pin_stripe'>Pin stripe</option>
					<option value='Light_tan'>Light tan</option>
					<option value='Dark_tan'>Dark tan</option>
					<option value='Brown'>Brown</option>
					<option value='Silver'>Silver</option>
					<option value='Gold'>Gold</option>
					<option value='Gray'>Gary</option>
					<option value='White'>White</option>
					<option value='Red'>Red</option>
					<option value='Pink'>Pink</option>
					<option value='Orange'>Orange</option>
					<option value='Yellow'>Yellow</option>
					<option value='Green'>Green</option>
					<option value='Cyan'>Cyan</option>
					<option value='Blue'>Blue</option>
					<option value='Magenta'>Magenta</option>
					<option value='Purple'>Purple</option>
				<?php endif; ?>
				</select>
			</div>
			
			<div class="systemInventoryConditions">
				<label>Inventory condition:</label>
				<select name='sys_conditions' class='inputShiftOne'>
					<option value='New'>New</option>
					<option value='Like new'>Like new</option>
					<option value='good'>Good</option>
				</select>
			</div>
			
			<div class="sys_price_div">
				<label>Inventory price:</label>
				$<input type="text" value="<?php echo $this->_tpl_vars['product']['0']['price']; ?>
" name="sys_price"/>
			</div>
			
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
			<div class="danceWearPartials">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manageinventory/".($this->_tpl_vars['attributePartial']), 'smarty_include_vars' => array('colorsAndShoesAttributes' => $this->_tpl_vars['product']['systemColorAndShoesAttributes'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			
			
			
			<div class="inventoryDescription">
			<label>Description: </label><textarea name='sys_description' rows='4' cols="29" class='inputShiftOne'></textarea>
			</div>
			</div>
			<div class='formRightDivision'>
				<div class="colorFabricAttributes" style='float:left; width:100%;'>
					<div class='fullTitleBarMid'><strong>Custom color and fabric selections</strong><span style='float:right; padding-right:10px;'><a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'editproductattribute'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
">Edit</a></span></div>
					<?php $_from = $this->_tpl_vars['product']['existingFabricSet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['existingFabricSet']):
?>
						<label>Color fabric option <?php echo $this->_tpl_vars['Key']+1; ?>
 <?php echo $this->_tpl_vars['existingFabricSet']['name']; ?>
:</label>
						<select name='Color_fabric_option_<?php echo $this->_tpl_vars['Key']+1; ?>
_<?php echo $this->_tpl_vars['existingFabricSet']['name']; ?>
'>
							<?php $_from = $this->_tpl_vars['existingFabricSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['details']):
?>
								<option value='<?php echo $this->_tpl_vars['details']['details_name']; ?>
'><?php echo $this->_tpl_vars['details']['details_name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select><br/>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				
				<div class="customAttributes" style='float:left; width:100%;'>
					<div class='fullTitleBarMid'><strong>Custom attribute selections</strong> <span style='float:right; padding-right:10px;'><a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'editproductattribute'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
">Edit</a></span></div>
					<?php $_from = $this->_tpl_vars['product']['existingAttributeSet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['existingAttributeSet']):
?>
						<label>Custom option <?php echo $this->_tpl_vars['Key']+1; ?>
 <?php echo $this->_tpl_vars['existingAttributeSet']['name']; ?>
:</label>
						<select name='Custom_option_<?php echo $this->_tpl_vars['Key']+1; ?>
_<?php echo $this->_tpl_vars['existingAttributeSet']['name']; ?>
'>
							<?php $_from = $this->_tpl_vars['existingAttributeSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['details']):
?>
								<option value="<?php echo $this->_tpl_vars['details']['details_name']; ?>
"><?php echo $this->_tpl_vars['details']['details_name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select><br/>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				
				<div class='box' >
					<div class='fullTitleBarMid'><strong>Upload inventory image</strong></div>
					<div id="imageBlock">
			        	<div id="image_0" class="imageInput">
				        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[0]"/>
						<a onclick='this.up().remove();' style='float:right; padding-right:10px;'>Delete</a>
						</div>
					</div>
				</div>
				<input type="hidden" name='id' value="<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
" />
			
				<button type='button' id='addAnotherImage' onclick='addNewImageBlock()'>Add another inventory image</button>
			
				<br/>
			</div>
			
		</div>
		<div class='box'>
		<input type='submit' onclick=showloadingImage() value='Save' class='largeSubmit'/>
		</div>
	</form>
</div>