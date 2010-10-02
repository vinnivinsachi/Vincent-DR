<?php /* Smarty version 2.6.19, created on 2010-06-27 17:03:03
         compiled from productlisting/editproductattribute.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<fieldset><legend>
	Custom product attribute management</legend>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "productlisting/".($this->_tpl_vars['attributePartial']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php echo $this->_tpl_vars['attributePartial']; ?>

		
	
	<br/>
	<br/>
	<br/>
		<strong style="font-size:1.5em;">Color and fabric attribute selection</strong><br/>
	Please select what major color/fabric categories does this product belongs to. <br/>
	(if you have this product in a fabric or color that is not listed below, please select its closest cousing<br/>
	example: if you have this product in a shade of red like maroon, please select Red) <br/>
	<input type="checkbox" name="color['black']"/>Black
	<input type="checkbox" name="color['light tan']"/>Light tan
	<input type="checkbox" name="color['dark tan']"/>Dark tan
	<input type="checkbox" name="color['brown']"/>Brown
	<input type="checkbox" name="color['silver']"/>Silver
	<input type="checkbox" name="color['Gold']"/>Gold
	<input type="checkbox" name="color['gray']"/>Gray
	<input type="checkbox" name="color['white']"/>White
	<input type="checkbox" name="color['red']"/>Red
	<input type="checkbox" name="color['pink']"/>Pink
	<input type="checkbox" name="color['orange']"/>Orange
	<input type="checkbox" name="color['yellow']"/>Yellow
	<input type="checkbox" name="color['green']"/>Green
	<input type="checkbox" name="color['cyan']"/>Cyan
	<input type="checkbox" name="color['blue']"/>Blue
	<input type="checkbox" name="color['magenta']"/>Magenta
	<input type="checkbox" name="color['Purple']"/>Purple
	
	<br/>
	<br/>
	
	Your available Color/Fabric sets:
		If default system color selection is used, this product will be using the colors checked above for color selection during product purchase<br/> 
	
	<select name="customFabricSets">
	<option value="default">Default system color categories</option>
	</select>
	<br/>
	<br/>
	If you would like to create a color/fabric set for this product listing or future product listings, click below
	<br/>
	<div id="customFabricSetsCreationMainDiv">
	
	</div>
	<div id='createNewFabricDivControls'>
	Name of new color/fabric set: <input type="text" id='newFabricSetNameInputID'/><button type='button' onclick="createNewFabricSet()">Create this color/fabric set</button>
	</div>
	
	<br/><br/><br/>
	<strong style="font-size:1.5em;">Custom attribute selection</strong><br/>
	[Please drag your available custom attributes into this selection to add to this product]
	[two boxes, one with all available ones, one with none]
	If you would like to add an additional attribute selections for this product during product purchase,<br/> 
	You may create the custom attribute below<br/>
	(Example: if this product comes with 3 different amount of jewelry additions for different amount of extra charges to the product, <br/>
	You may create a custom attribute selection called 'Jewelry addition', and then add the 3 different selections with the name of selection,<br/>
	 an optional picture attachment to that selection, and optional addition extra charge accociated with that selection.<br/>
	
	<div id="customAttributeMainDiv">
		
	</div>
	Name of new attribute selection: <input type="text" id='newCustomAttributeNameInputID'/><button type="button" onclick='createNewCustomAttribute()'>Create this attribute selection</button>
	</fieldset>

<?php echo '
<script type="text/javascript">
function createNewFabricSet(){
	fabricSetNameOriginal=$(\'newFabricSetNameInputID\').value;
	
	//alert(\'count is: \'+fabricSetNameOriginal.length);
	if(fabricSetNameOriginal.length==0){
		alert(\'Please enter a name for this fabric set\');
	}else{
		fabricSetName=filterStringWithSymbol(fabricSetNameOriginal,\'_\');
		//alert(fabricSetName);
		fabricSetDivMain=$(\'customFabricSetsCreationMainDiv\');
		var timestamp = new Date();
		fabricSetDivMain.insert( { bottom: "<form method=\'post\' id=\'fabricSet-"+fabricSetName+"\' action=\'/productlisting/uploadattribute\' enctype=\'multipart/form-data\'>"
										  +"<div id=\'fabricSetForm-"+fabricSetName+"\' >"
										  +"<strong>Color/fabric set: "+fabricSetNameOriginal+"</strong><input type=\'hidden\' value=\'"+fabricSetName+"\' name=fabricSet["+fabricSetName+"]/>"
										  +"<div class=\'fabricSetDetail\'>"
										  +"Name: <input type=\'text\' class=\'formSetNameText\' name=fabricSet["+fabricSetName+"][name]["+timestamp.getTime()+"] />"
										  +"Price offset(optional): <input type=\'text\' class=\'formSetPriceOffsetNumeric\' name=fabricSet["+fabricSetName+"][price]["+timestamp.getTime()+"] />"
										  +"Image unpload(optional): <input type=\'file\' name=customAttributeDetailImage["+timestamp.getTime()+"] />"
										 
										  +"<button type=\'button\' onclick=\'this.up().remove();\'>Delete</button>"
										  +"<div class=\'fieldError\'>sd</div></div>"
										  +"</div><button type=\'button\' onclick=\'addDetailColorInSet(this)\'>Add another color in this set</button><button type=\'button\' onclick=verfityAndSubmitForm(\'fabricSet-"+fabricSetName+"\')>Save</button><input type=\'submit\' value=\'save\' onclick=\'showloadingImage()\'/></form>" } );
		//alert(\'here\');
		//alert(fabricSetDivMain.down().id);
		$(\'createNewFabricDivControls\').hide();
		alert(\'here\');
		//alert("\'fabricSet-"+fabricSetName+"\'"); 
		//new formEnhancer(\'fabricSet-\'+fabricSetName);
		alert(\'here2\');
	}
}

function addDetailColorInSet(element){
	alert(element.innerHTML);
	fabricSet=$(\'customFabricSetsCreationMainDiv\').down();
	fabricSetName=fabricSet.id.split("-")[1];
	alert(fabricSetName);
	fabricSetForm = $(\'fabricSetForm-\'+fabricSetName);

	var timestamp = new Date();
	fabricSetForm.insert( { bottom: "<div class=\'fabricSetDetail\'>"
		  							+"Name: <input type=\'text\' class=\'formSetNameText\' name=fabricSet["+fabricSetName+"][name]["+timestamp.getTime()+"]/>"
		  							+"Price offset(optional):<input type=\'text\'  class=\'formSetPriceOffsetNumeric\' name=fabricSet["+fabricSetName+"][price]["+timestamp.getTime()+"]/>"
		  							+"Image unpload(optional): <input type=\'file\' name=customAttributeDetailImage["+timestamp.getTime()+"] />"
		  							+"<button type=\'button\' onclick=\'this.up().remove();\'>Delete</button>"
		  							+"<div class=\'fieldError\'>sd</div></div>"
		  							});
	//alert(\'here at add new\');
	
}
function verfityAndSubmitForm(formName){
	//textFormFields= $A(\'formText\');
	alert(\'form name is: \'+formName);
	alert(\'here\');
	fabricSetDetails = $$(\'.fabricSetDetail\');
	alert(\'here2\');
	alert(fabricSetDetails.length);

	verifiedForm=true;
	fabricSetDetails.each(function(value){
		errorArray=\'\';
		hasError=false;
		setName = value.down(\'input.formSetNameText\');
		if(setName.value.length==0){
			alert(\'name is none can not process\');
			errorArray +=\'You must enter a name for this attribute. \';
			hasError=true;
		}
		priceOffset = value.down(\'input.formSetPriceOffsetNumeric\');
		alert(priceOffset.className);
		alert(\'here inside\');
		if(priceOffset.value.length==0){
			alert(\'settin value to zero\');
			priceOffset.value=0;
		}else if(isNaN(priceOffset.value)){
			alert(\'value is not zero\');
			errorArray+=\'Price offset is not a number value. \';
			hasError=true;
		}

		if(hasError){
			alert(\'displaying error message\');
			alert(\'fieldError existing \'+value.down(\'div.fieldError\').innerHTML);
			value.down(\'div.fieldError\').innerHTML = errorArray;
			verifiedForm=false;
		}else{
			value.down(\'div.fieldError\').innerHTML=\'\';
		}
	});

	if(verifiedForm){
		showloadingImage(); 
		$(formName).submit();
	}	
}

function showloadingImage(){
		
	$(\'loadingImage\').show();
	
}

function createNewCustomAttribute(){
	customAttributeNameOriginal=$(\'newCustomAttributeNameInputID\').value;
	
	//alert(fabricSetNameOriginal);
	//alert(\'count is: \'+fabricSetNameOriginal.length);
	if(customAttributeNameOriginal.length==0){
		alert(\'Please enter a name for this fabric set\');
	}else{
		customAttributeName=filterStringWithSymbol(customAttributeNameOriginal,\'_\');
		//alert(fabricSetName);
		customAttributeDivMain=$(\'customAttributeMainDiv\');
		var timestamp = new Date();
		customAttributeDivMain.insert( { bottom: "<div class=\'customAttributeForm\' id=\'customAttribute-"+customAttributeName+"\'>"
										  +"<strong>Custom Attribute name: "+customAttributeNameOriginal+"</strong><input type=\'hidden\' value=fabricSetName name=fabricSet["+customAttributeName+"]/>"
										  +"<div class=\'customAttributeDetails\'>"
										  +"Name: <input type=\'text\' name=customAttribute["+customAttributeName+"][name]["+timestamp.getTime()+"]/>"
										  +"Price offset(optional): <input type=\'text\' name=customAttribute["+customAttributeName+"][price]["+timestamp.getTime()+"]/>"
										  +"Image unpload(optional): <input type=\'file\' name=customAttribute["+customAttributeName+"][image]["+timestamp.getTime()+"]/>"
										 
										  +"<button type=\'button\' onclick=\'this.up().remove();\'>Delete</button>"
										  +"</div>"
										  +"</div><button type=\'button\' onclick=\'addDetailCustomAttribute(this)\'>Add another color in this set</button><button>Save</button>" } );
		//alert(\'here\');
		//alert(fabricSetDivMain.down().id);
	}
}

function addDetailCustomAttribute(){
 alert(\'here at add detail custom Attribute\');
//alert(element.innerHTML);
	customAttributeForm=$(\'customAttributeMainDiv\').down();
	alert(customAttributeForm.id);
	customAttributeName=customAttributeForm.id.split("-")[1];
	alert(customAttributeName);
	var timestamp = new Date();
	customAttributeForm.insert( { bottom: "<div class=\'customAttributeDetails\'>"
		  							+"Name: <input type=\'text\' name=customAttribute["+customAttributeName+"]["+timestamp.getTime()+"][\'name\']/>"
		  							+"Price offset(optional): <input type=\'text\' name=customAttribute["+customAttributeName+"]["+timestamp.getTime()+"][\'price\']/>"
		  							+"Image unpload(optional): <input type=\'file\' name=customAttribute["+customAttributeName+"][\'image\']["+timestamp.getTime()+"]/>"
		  							+"<button type=\'button\' onclick=\'this.up().remove();\'>Delete</button>"
		  							+"</div>"
		  							});
}
</script>
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>