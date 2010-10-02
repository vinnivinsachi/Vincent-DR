<?php /* Smarty version 2.6.19, created on 2010-08-13 20:32:44
         compiled from manageinventory/_addCustomizableInventory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'manageinventory/_addCustomizableInventory.tpl', 4, false),array('function', 'removeunderscore', 'manageinventory/_addCustomizableInventory.tpl', 24, false),array('function', 'cycle', 'manageinventory/_addCustomizableInventory.tpl', 144, false),array('modifier', 'cat', 'manageinventory/_addCustomizableInventory.tpl', 146, false),)), $this); ?>
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
		
			<div class='titleBarMid'><strong>Basic information</strong></div>
			<div class="inventoryName">
				<label>Name:</label>
				<input type='text' name='sys_name' value='<?php echo $this->_tpl_vars['product']['0']['name']; ?>
' class='inputShiftOne'/>
			</div>
			
			<div class="systemColorSelection">
	        	<label>Color:</label>
				<select name='sys_color' class='inputShiftOne'>
				<?php $_from = $this->_tpl_vars['product']['systemColorAndShoesAttributes']['colors']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['sysColor']):
?>
					<?php if ($this->_tpl_vars['sysColor'] == '1' && $this->_tpl_vars['Key'] != 'product_id'): ?>
						<option value=<?php echo $this->_tpl_vars['Key']; ?>
><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['Key']), $this);?>
</option>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</div>
			
			<div class="systemInventoryConditions">
				<label>Condition:</label>
				<select name='sys_conditions' class='inputShiftOne'>
					<option value='New'>New</option>
					<option value='Like new'>Like new</option>
					<option value='good'>Good</option>
				</select>
			</div>
			
			<div class="sys_price_div">
				<label>Price:</label>
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
				<div class="colorFabricAttributes box">
					<div class='fullTitleBarMid'><strong>Custom color/fabric options</strong><span style='float:right; padding-right:10px;'><a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'editproductattribute'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
">Edit</a></span></div>
					<?php $_from = $this->_tpl_vars['product']['existingFabricSet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['existingFabricSet']):
?>
						<div class='box'>
						<label>Color/fabric <?php echo $this->_tpl_vars['Key']+1; ?>
 <?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['existingFabricSet']['name']), $this);?>
:</label>
						<select name='Attr_color__<?php echo $this->_tpl_vars['Key']+1; ?>
_<?php echo $this->_tpl_vars['existingFabricSet']['name']; ?>
'>
							<?php $_from = $this->_tpl_vars['existingFabricSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['details']):
?>
								<option value='<?php echo $this->_tpl_vars['details']['details_name']; ?>
'><?php echo $this->_tpl_vars['details']['details_name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select></div>
					<?php endforeach; endif; unset($_from); ?>
				</div><!-- Color_fabric_option_$Key_$existingFabricSet.name -->
				
				<div class="customAttributes box marginTop20">
					<div class='fullTitleBarMid'><strong>Custom attribute options</strong> <span style='float:right; padding-right:10px;'><a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'editproductattribute'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
">Edit</a></span></div>
					<?php $_from = $this->_tpl_vars['product']['existingAttributeSet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['existingAttributeSet']):
?>
						<div class='box'>
					
						<label>Custom option <?php echo $this->_tpl_vars['Key']+1; ?>
 <?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['existingAttributeSet']['name']), $this);?>
:</label>
						<select name='Attr_<?php echo $this->_tpl_vars['Key']+1; ?>
_<?php echo $this->_tpl_vars['existingAttributeSet']['name']; ?>
'>
							<?php $_from = $this->_tpl_vars['existingAttributeSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['details']):
?>
								<option value="<?php echo $this->_tpl_vars['details']['details_name']; ?>
"><?php echo $this->_tpl_vars['details']['details_name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select></div>
					<?php endforeach; endif; unset($_from); ?>
				</div><!-- Custom_option_$Key+1_$existingAttributeSet.name -->
				
				<div class='box marginTop20' >
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
			
				<button class='marginTop10' type='button' id='addAnotherImage' onclick='addNewImageBlock()'>Add another image</button>
			
				<br/>
			</div>
			
		</div>
		<div class='box'>
		<input type='submit' onclick=showloadingImage() value='Save' class='largeSubmit'/>
		</div>
	</form>
</div>


<div id='existingInventoryProductsMainDiv' style='width:100%; float:left;'>
	<div class='titleBarBig'>Current inventory - <?php echo $this->_tpl_vars['product']['0']['name']; ?>
</div>
	<div class='box'>
	<form action='<?php echo smarty_function_geturl(array('controller' => 'manageinventory','action' => 'updateinventoryquantity'), $this);?>
'>
		<div id='inventoryDetail'>
			<table class='inventoryTable'>
		
				<tr class='trTitle'>
					<td>Name</td>
					<td>Price</td>
					<td>Color</td>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manageinventory/".($this->_tpl_vars['inventoryPartialTitle']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_from = $this->_tpl_vars['mostInventoryProfile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['profile']):
?>
					<td><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['profile']['profile_key']), $this);?>
</td>
					<?php endforeach; endif; unset($_from); ?>
					<td>Quantity</td>
					<td></td>
				</tr>
				<tr style='height:10px;'>
					
				</tr>
				<?php $_from = $this->_tpl_vars['inventories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['inventoryKey'] => $this->_tpl_vars['inventory']):
?>
					 <?php echo smarty_function_cycle(array('values' => 'colorOdd,colorEven','assign' => 'class'), $this);?>
 
			         <?php if (($this->_foreach['menu_items']['iteration'] <= 1)): ?> 
			            <?php $this->assign('class', ((is_array($_tmp=$this->_tpl_vars['class'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' first') : smarty_modifier_cat($_tmp, ' first'))); ?> 
			         <?php elseif (($this->_foreach['menu_items']['iteration'] == $this->_foreach['menu_items']['total'])): ?> 
			            <?php $this->assign('class', ((is_array($_tmp=$this->_tpl_vars['class'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' last') : smarty_modifier_cat($_tmp, ' last'))); ?> 
			         <?php endif; ?> 
				<tr class='trDetails <?php echo $this->_tpl_vars['class']; ?>
' id='inventoryID_<?php echo $this->_tpl_vars['inventory']['basic']['product_inventory_id']; ?>
'>
					<td><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['inventory']['basic']['sys_name']), $this);?>
</td>
					<td>$<?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['inventory']['basic']['sys_price']), $this);?>
</td>
					<td><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['inventory']['basic']['sys_color']), $this);?>
</td>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manageinventory/".($this->_tpl_vars['inventoryPartial']), 'smarty_include_vars' => array('inventory' => $this->_tpl_vars['inventory'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_from = $this->_tpl_vars['mostInventoryProfile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['profile']):
?>
						<td>
							<?php $_from = $this->_tpl_vars['inventory']['profile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['profile2']):
?>
								<?php if ($this->_tpl_vars['profile2']['profile_key'] == $this->_tpl_vars['profile']['profile_key']): ?>
								<?php echo $this->_tpl_vars['profile2']['profile_value']; ?>

								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						</td>
					<?php endforeach; endif; unset($_from); ?>
					<td><input type='text' name='quantity[<?php echo $this->_tpl_vars['inventory']['basic']['product_inventory_id']; ?>
]' value='<?php echo $this->_tpl_vars['inventory']['basic']['sys_quantity']; ?>
' style='width:50px;'/></td>
					<td><a href="<?php echo smarty_function_geturl(array('controller' => 'manageinventory','action' => 'deleteinventory'), $this);?>
?id=<?php echo $this->_tpl_vars['inventory']['basic']['product_inventory_id']; ?>
">Delete</a></td>
				</tr>
				<tr>
					<td colspan="4">
					<?php $_from = $this->_tpl_vars['inventory']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
					<div style='border:1px solid gray; margin-right:3px; float:left;'>
					<img src='/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
/inventory/<?php echo $this->_tpl_vars['image']['image_id']; ?>
.W30_productSmallPreview.jpg'/>
					<a href="<?php echo smarty_function_geturl(array('controller' => 'manageinventory','action' => 'image'), $this);?>
?id=<?php echo $this->_tpl_vars['image']['Product_id']; ?>
&image=<?php echo $this->_tpl_vars['image']['image_id']; ?>
&delete=true"><img src="/public/resources/css/images/Crosses.png" /></a>
					</div> 
					<?php endforeach; endif; unset($_from); ?>
					</td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
			</table>
		</div>
		<input class='marginTop20' style='float:right;' type='submit' onclick=showloadingImage() value='Update inventory'/>
	</form>
	</div>
</div>
	
<?php echo '
<script type="text/javascript">


</script>
'; ?>
