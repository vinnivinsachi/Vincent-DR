<?php /* Smarty version 2.6.19, created on 2010-08-16 17:25:19
         compiled from manageattribute/editproductattribute.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'manageattribute/editproductattribute.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id='customizableSection' class='box'>
		<div class='titleBarBig box ' ><strong>Custom color/fabric set(s) - optional</strong><span style='float:right; font-weight:normal;'><a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'editcustomproduct'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product']['0']['purchase_type']; ?>
&category=<?php echo $this->_tpl_vars['product']['0']['product_category']; ?>
&type=<?php echo $this->_tpl_vars['product']['0']['product_type']; ?>
&tag=<?php echo $this->_tpl_vars['product']['0']['product_tag']; ?>
&id=<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
" style='margin-right:20px;'>< Edit basic information</a><a href="#" style='padding-right:20px;'>Help</a>
		<a href="<?php echo smarty_function_geturl(array('controller' => 'manageinventory','action' => 'addinventory'), $this);?>
?id=<?php echo $this->_tpl_vars['productID']; ?>
">Manage product inventory ></a></span></div>
		<button style='float:left;' type='button' onclick="this.hide(); Effect.BlindDown('userFabricSet');">Edit custom color/fabric sets</button>
	<div id='userFabricSet' class='box' style='display:none;'>
		<div style="width:49%; float:left; ">
		
		<div class='box' style='margin-bottom:10px;'>
			<div class='fullTitleBarMid'><strong>Current product color/fabric sets</strong></div>
			<form id='removeFabricSet' action="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'removeattributefromproduct'), $this);?>
" method='post'>
				<div id='userSelectedFabricSet' class='box'>
					<?php $_from = $this->_tpl_vars['fp']->existingFabricSet; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['generalSet']):
?>
					<div class='existingFabricSetGeneral'>
						<input type='checkbox' name=removeProductAttributeSet[<?php echo $this->_tpl_vars['generalSet']['product_attribute_id']; ?>
] value='<?php echo $this->_tpl_vars['generalSet']['product_attribute_id']; ?>
'/><span class="tooltipControl"><?php echo $this->_tpl_vars['generalSet']['name']; ?>
</span>
						<div class='tooltip'>
							<table>
								
								<?php $_from = $this->_tpl_vars['generalSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['detail']):
?>
									<tr><td><?php echo $this->_tpl_vars['detail']['details_name']; ?>
</td>
										<td>$<?php echo $this->_tpl_vars['detail']['price_offset']; ?>
</td>
										<?php if ($this->_tpl_vars['detail']['filename'] != NULL): ?>
										<td><img src='/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['detail']['username']; ?>
/fabric_set_details/<?php echo $this->_tpl_vars['generalSet']['name']; ?>
/<?php echo $this->_tpl_vars['detail']['id']; ?>
.W30_miniDetailImage.jpg'></td>
										<?php else: ?>
										<td></td>
										<?php endif; ?>
									</tr>
								<?php endforeach; endif; unset($_from); ?>
							</table>
						</div>
					</div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				
				<input type="hidden" name='attributeType' value='fabric_set' />
				<input type="hidden" name='ID' value='<?php echo $this->_tpl_vars['productID']; ?>
' /><br/><br/>
				<button type="button" onclick="editProductAttributes('fabric_set', 'removeFabricSet', 'existingFabricSetGeneral', 'userSelectedFabricSet')">Remove selected color/fabric set from product</button>
			</form>
			
		</div>
			<div class='box' style='margin-top:20px;'>
			<div class='titleBarMid'><strong>Other color/fabric sets</strong></div>
			<form id='addFabricSet' action="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'addattributetoproduct'), $this);?>
" method='post'>
			
			<div id='userAvailableFabricSet' style='max-height:200px; overflow-y:scroll;'>
				<?php $_from = $this->_tpl_vars['fp']->fabric_set; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['generalSet']):
?>
					<div class='AvailabeFabricSetGeneral'>
						<input type='checkbox' name=addAttributeSet[<?php echo $this->_tpl_vars['generalSet']['id']; ?>
] value='<?php echo $this->_tpl_vars['generalSet']['id']; ?>
'/><span class="tooltipControl"><?php echo $this->_tpl_vars['generalSet']['name_of_set']; ?>
</span>
						<div class='tooltip'>
							<table>
								
								<?php $_from = $this->_tpl_vars['generalSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['detail']):
?>
									<tr><td><?php echo $this->_tpl_vars['detail']['details_name']; ?>
</td>
										<td>$<?php echo $this->_tpl_vars['detail']['price_offset']; ?>
</td>
										<?php if ($this->_tpl_vars['detail']['filename'] != NULL): ?>
										<td><img src='/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['detail']['username']; ?>
/fabric_set_details/<?php echo $this->_tpl_vars['generalSet']['name_of_set']; ?>
/<?php echo $this->_tpl_vars['detail']['id']; ?>
.W30_miniDetailImage.jpg'></td>
										<?php else: ?>
										<td></td>
										<?php endif; ?>
									</tr>
								<?php endforeach; endif; unset($_from); ?>
							</table>
						</div>
						<span style='float:right;'><a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'uploadattribute'), $this);?>
?actioncall=0&paramSet=fabric_set&id=<?php echo $this->_tpl_vars['generalSet']['id']; ?>
" style='padding-right:5px;'>Edit</a>
						<a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'removeattribute'), $this);?>
?type=fabric_set&id=<?php echo $this->_tpl_vars['generalSet']['id']; ?>
">Delete</a></span>
					</div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			<input type="hidden" name='attributeType' value='fabric_set'/>
			<input type="hidden" name='ID' value='<?php echo $this->_tpl_vars['productID']; ?>
' /><br/>
			<button type="button" onclick="editProductAttributes('fabric_set', 'addFabricSet', 'AvailabeFabricSetGeneral', 'userSelectedFabricSet'  )">Add selected color/fabric set to product</button>
			</form>
		</div>
		
	</div>
	<div style="width:50%; float:right; ">
		<div class='fullTitleBarMid'><strong>Create a new color/fabric set</strong></div>
		<div id="customAttributeSetsCreationMainDiv" class='box'>
	
		</div>
		<div id='createNewAttributeDivControls' class='box'>
		<label style='width:185px;'>Name of set:</label> <input type="text" id='newAttributeSetNameInputID'/><button type='button' onclick="createNewAttributeSet('newAttributeSetNameInputID','customAttributeSetsCreationMainDiv', 'createNewAttributeDivControls', '1', 'fabric_set','')">Create color/fabric set</button>
		</div>
	</div>
</div>
	
	<div class='box' style='width:100%;'>
	<div class='titleBarBig box' style='margin-top:30px;'><strong>Custom attribute set(s) - optional</strong><span class='right' style='font-weight:normal;'><a style='margin-right:5px;'>Help</a></span></div>
	<button type='button' style='float:left;' onclick="this.hide(); Effect.BlindDown('userCustomAttributeSet');">Edit custom attribute sets</button>
	
	<div id='userCustomAttributeSet' style='width:100%; float:left; display:none;'>
	
	 <div class='box' style='width:49%;'>
		<div class="box">
			<div class='titleBarMid'><strong>Current attribute sets</strong></div>
			<form id='removeAttributeSet' action="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'removeattributefromproduct'), $this);?>
" method='post'>
				<div id='userSelectedAttributeSet' >
					<?php $_from = $this->_tpl_vars['fp']->existingAttributeSet; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['generalSet']):
?>
					<div class='existingCustomSetGeneral'>
						<input type='checkbox' name=removeProductAttributeSet[<?php echo $this->_tpl_vars['generalSet']['product_attribute_id']; ?>
] value='<?php echo $this->_tpl_vars['generalSet']['product_attribute_id']; ?>
'/>
						<span class="tooltipControl"><?php echo $this->_tpl_vars['generalSet']['name']; ?>
</span>
						<div class='tooltip'>
							<table>
								
								<?php $_from = $this->_tpl_vars['generalSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['detail']):
?>
									<tr><td><?php echo $this->_tpl_vars['detail']['details_name']; ?>
</td>
										<td>$<?php echo $this->_tpl_vars['detail']['price_offset']; ?>
</td>
										<?php if ($this->_tpl_vars['detail']['filename'] != NULL): ?>
										<td><img src='/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['detail']['username']; ?>
/custom_attribute_details/<?php echo $this->_tpl_vars['generalSet']['name']; ?>
/<?php echo $this->_tpl_vars['detail']['id']; ?>
.W30_miniDetailImage.jpg'></td>
										<?php else: ?>
										<td></td>
										<?php endif; ?>
									</tr>
								<?php endforeach; endif; unset($_from); ?>
							</table>
						</div>
					</div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				<input type="hidden" name='attributeType' value='custom_attribute' />
				<input type="hidden" name='ID' value='<?php echo $this->_tpl_vars['productID']; ?>
' /><br/><br/>
				<button type="button" onclick="editProductAttributes('custom_attribute', 'removeAttributeSet', 'existingCustomSetGeneral', 'userSelectedAttributeSet')">Remove selected custom attribute set from product</button>
			</form>
		</div>
		
		<div class="box" style='padding-top:20px;'>
			<div class='titleBarMid'><strong>Other attribute sets</strong></div>
			<form id='addAttributeSet' action="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'addattributetoproduct'), $this);?>
" method='post'>
			
			<div id='userAvailableAttributeSet' style='max-height:200px; overflow-y:scroll;'>
				<?php $_from = $this->_tpl_vars['fp']->custom_attribute; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['generalSet']):
?>
					<div class='AvailabeCustomSetGeneral'>
						<input type='checkbox' name=addAttributeSet[<?php echo $this->_tpl_vars['generalSet']['id']; ?>
] value='<?php echo $this->_tpl_vars['generalSet']['id']; ?>
'/>
						<span class="tooltipControl"><?php echo $this->_tpl_vars['generalSet']['name_of_set']; ?>
</span>
						<div class='tooltip'>
							<table>
								
								<?php $_from = $this->_tpl_vars['generalSet']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['detail']):
?>
									<tr><td><?php echo $this->_tpl_vars['detail']['details_name']; ?>
</td>
										<td>$<?php echo $this->_tpl_vars['detail']['price_offset']; ?>
</td>
										<?php if ($this->_tpl_vars['detail']['filename'] != NULL): ?>
										<td><img src='/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['detail']['username']; ?>
/custom_attribute_details/<?php echo $this->_tpl_vars['generalSet']['name_of_set']; ?>
/<?php echo $this->_tpl_vars['detail']['id']; ?>
.W30_miniDetailImage.jpg'></td>
										<?php else: ?>
										<td></td>
										<?php endif; ?>
									</tr>
								<?php endforeach; endif; unset($_from); ?>
							</table>
						</div>
						<span style='float:right;'><a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'uploadattribute'), $this);?>
?actioncall=0&paramSet=custom_attribute&id=<?php echo $this->_tpl_vars['generalSet']['id']; ?>
" style='padding-right:5px;'>Edit</a>
						<a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'removeattribute'), $this);?>
?type=custom_attribute&id=<?php echo $this->_tpl_vars['generalSet']['id']; ?>
">Delete</a></span>
					</div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			<input type="hidden" name='attributeType' value='custom_attribute'/>
			<input type="hidden" name='ID' value='<?php echo $this->_tpl_vars['productID']; ?>
' />
			<button type="button" onclick="editProductAttributes('custom_attribute', 'addAttributeSet', 'existingCustomSetGeneral', 'userSelectedAttributeSet' )">Add selected custom attribute set to product</button>
			</form>
		</div>
	</div>
	
		<div style="width:50%; float:right; ">
			<div class='fullTitleBarMid'><strong>Create a new attribute set</strong></div>
			<div id="customAttributeMainDiv" class='box'>
			</div>
			<div id='createNewCustomAttributeDivControls' class='box'>
			<label style='width:185px;'>Name of set:</label>
			<input type="text" id='newCustomAttributeNameInputID'/>
			<button type="button" onclick="createNewAttributeSet('newCustomAttributeNameInputID','customAttributeMainDiv', 'createNewCustomAttributeDivControls', '1', 'custom_attribute','')">Create attribute set</button>
			</div>	
		</div>
	</div>
	</div>
</div>
	<div class='titleBarBig marginTop30'>
	Search criteria		
	</div>
	<form id='productAttributeMainForm' action="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'saveproductattribute'), $this);?>
" method='post'>
	<div class='box' style='width:50%;'>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manageattribute/".($this->_tpl_vars['attributePartial']), 'smarty_include_vars' => array('colorsAndShoesAttributes' => $this->_tpl_vars['fp']->systemColorAndShoesAttributes)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div class='box' style='width:50%;'>
		<div class='box'>
		Please select major color categories this product belongs to. <br/><br/>
		<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Black]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Black'] == '1'): ?>checked='checked'<?php endif; ?>/>Black
		</div>  <div style='float:left; width:20%'>
		<input type="checkbox" name="color[Pin_stripe]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Pin_stripe'] == '1'): ?>checked='checked'<?php endif; ?>/>Pin stripe
		</div>  <div style='float:left; width:20%'>
		<input type="checkbox" name="color[Light_tan]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Light_tan'] == '1'): ?>checked='checked'<?php endif; ?>/>Light tan
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Dark_tan]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Dark_tan'] == '1'): ?>checked='checked'<?php endif; ?>/>Dark tan
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Brown]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Brown'] == '1'): ?>checked='checked'<?php endif; ?>/>Brown
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Silver]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Silver'] == '1'): ?>checked='checked'<?php endif; ?>/>Silver
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Gold]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Gold'] == '1'): ?>checked='checked'<?php endif; ?>/>Gold
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Gray]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Gray'] == '1'): ?>checked='checked'<?php endif; ?>/>Gray
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[White]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['White'] == '1'): ?>checked='checked'<?php endif; ?>/>White
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Red]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Red'] == '1'): ?>checked='checked'<?php endif; ?>/>Red
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Pink]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Pink'] == '1'): ?>checked='checked'<?php endif; ?>/>Pink
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Orange]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Orange'] == '1'): ?>checked='checked'<?php endif; ?>/>Orange
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Yellow]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0Yellow'] == '1'): ?>checked='checked'<?php endif; ?>/>Yellow
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Green]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Green'] == '1'): ?>checked='checked'<?php endif; ?>/>Green
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Cyan]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Cyan'] == '1'): ?>checked='checked'<?php endif; ?>/>Cyan
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Blue]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Blue'] == '1'): ?>checked='checked'<?php endif; ?>/>Blue
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Magenta]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Magenta'] == '1'): ?>checked='checked'<?php endif; ?>/>Magenta
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Purple]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Purple'] == '1'): ?>checked='checked'<?php endif; ?>/>Purple
		</div><div style='float:left; width:20%'>
		<input type="checkbox" name="color[Multicolor]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Multicolor'] == '1'): ?>checked='checked'<?php endif; ?>/>Multicolor
		</div><div style='float:left; width:20%'>
		<input type="checkbox" name="color[Munocolor]" <?php if ($this->_tpl_vars['fp']->systemColorAndShoesAttributes['colors']['0']['Monocolor'] == '1'): ?>checked='checked'<?php endif; ?>/>Monocolor</div>
		<br/>
		<br/>
		<input type='hidden' name='id' value='<?php echo $this->_tpl_vars['productID']; ?>
'/>
		
		</div>
	</div>
	
	</form>

<!--<button type='button' onclick="showCustomizableSection('customizableSection')">Add fabric or custom attributes</button>-->


<div class='box' style='margin-top:20px;'>
	<button type='button' onclick="submitMainForm('productAttributeMainForm')" class='largeSubmit'>Save and proceed to manage product inventory</button>
	</div>
		
<?php echo '
<script type="text/javascript">
tooltipReset();
function editProductAttributes(attributeType, formID, attributeUnit, attributeContainer){
	//alert(\'here at form add selected fabic attribute\');
	alert(attributeType);
	alert(formID);
	var form = $(formID);

	var options={
			parameters: form.serialize(true),
			method: form.method,
			onLoaded: showloadingImage(), 
			onSuccess: function(transport){
						hideloadingImage();
						alert(\'here at added attributes successfull\');
						var json = transport.responseText.evalJSON(true);
						var htmlInjection=\'\';
						json.each(function(value){
							htmlInjection+= "<div class=\'"+attributeUnit+"\'>"
								+"<input type=\'checkbox\' name=removeProductAttributeSet["+value.product_attribute_id+"] value=\'"+value.product_attribute_id+"\'/>"
								+"<span class=\'tooltipControl\'>"+value.name+"</span>"
								+"<div class=\'tooltip\'><table><tr><td>Option names</td><td>Price offset</td>"
								+"<td>Image</td>"
								+"</tr>";

							value.details.each(function(detail){
								htmlInjection+="<tr><td>"+detail.details_name+"</td>"
											  +"<td>"+detail.price_offset+"</td>";
								  			if(detail.filename!=null){
								htmlInjection+="<td><img src=\'/public/resources/userdata/tmp/thumbnails/"+detail.username+"/"+attributeType+"_details/"+value.name+"/"+detail.id+".W30_miniDetailImage.jpg\'></td>";
								  			}else{
								htmlInjection+="<td></td>";
								  			}
								htmlInjection+="</tr>";		  
								});
							htmlInjection+="</table></div></div>";
							});
						alert(htmlInjection);
						$(attributeContainer).innerHTML=htmlInjection;
						//setTimeout("tooltipReset()", 3000);
						tooltipReset();

			}
		};

	//alert(\'here\');
	new Ajax.Request(form.action, options);
}

                           
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>