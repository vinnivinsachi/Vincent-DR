<?php /* Smarty version 2.6.19, created on 2010-08-13 20:48:41
         compiled from manageinventory/_addBuy_nowInventory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'manageinventory/_addBuy_nowInventory.tpl', 1, false),array('modifier', 'cat', 'manageinventory/_addBuy_nowInventory.tpl', 115, false),array('function', 'geturl', 'manageinventory/_addBuy_nowInventory.tpl', 5, false),array('function', 'removeunderscore', 'manageinventory/_addBuy_nowInventory.tpl', 104, false),array('function', 'cycle', 'manageinventory/_addBuy_nowInventory.tpl', 113, false),)), $this); ?>
<?php if (count($this->_tpl_vars['inventories']) == 0): ?>

<div id='addInventoryFormMainDiv' style="padding-bottom:10px; float:left; width:100%;"> 
		<div class='titleBarBig'>Step 2:  &nbsp;&nbsp;&nbsp;Edit listing details - <?php echo $this->_tpl_vars['product']['0']['name']; ?>

		<span style='float:right; font-weight:normal;'><a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'editproduct'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product']['0']['purchase_type']; ?>
&category=<?php echo $this->_tpl_vars['product']['0']['product_category']; ?>
&type=<?php echo $this->_tpl_vars['product']['0']['product_type']; ?>
&tag=<?php echo $this->_tpl_vars['product']['0']['product_tag']; ?>
&id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
">< Edit basic information</a></span>
		
		</div>
			<form id='addProductInventory' enctype="multipart/form-data" action='<?php echo smarty_function_geturl(array('controller' => 'manageinventory','action' => 'addbuynowinventory'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
' method='post'>
			<div class="manageInventoryMainDiv" >
		
			<div class='formLeftDivision'>
		
			<div class='titleBarMid'><strong>Search criteria</strong></div>
		
			<input type='hidden' name='sys_name' value='<?php echo $this->_tpl_vars['product']['0']['name']; ?>
' class='inputShiftOne'/>
			
			<div class="systemColorSelection" >
	        	<label>Color:</label>
				<select name='sys_color' class='inputShiftOne'>
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
			
			
			<input type="hidden" value="<?php echo $this->_tpl_vars['product']['0']['price']; ?>
" name="sys_price"/>
			
			
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
				<div class='box'>
					<div class='fullTitleBarMid'><strong>Upload product image</strong></div>
					<div id="imageBlock">
			        	<div id="image_0" class="imageInput">
				        <label style='width:185px;'>Image :</label>
						<input type="file" name="generalImages[0]" />
						<a onclick='	this.up().remove();' style='float:right; padding-right:10px;'>Delete</a>
						</div>
					</div>
				</div>
			</div>
			
			<input type="hidden" name='id' value="<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
" />
			<button type='button' id='addAnotherImage' onclick='addNewImageBlock()' style='margin-top:10px;'>Add another inventory image</button>
			<br/>
		</div>
			
		<div class='box'>
		<input type='submit' onclick=showloadingImage() value='Create this listing' class='largeSubmit'/>
		</div>
		
		</form>
	
</div>
<?php endif; ?>

<div id='existingInventoryProductsMainDiv' style='width:100%; float:left;'>
	<div class='titleBarBig'>Current listings of <?php echo $this->_tpl_vars['product']['0']['name']; ?>
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
