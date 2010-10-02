{include file="layouts/$layout/header.tpl" lightbox=true}

<div id='customizableSection' class='box'>
		<div class='titleBarBig box ' ><strong>Custom color/fabric set(s) - optional</strong><span style='float:right; font-weight:normal;'><a href="{geturl controller='productlisting' action='editcustomproduct'}?purchase_type={$product.0.purchase_type}&category={$product.0.product_category}&type={$product.0.product_type}&tag={$product.0.product_tag}&id={$product.0.product_id}" style='margin-right:20px;'>< Edit basic information</a><a href="#" style='padding-right:20px;'>Help</a>
		<a href="{geturl controller='manageinventory' action='addinventory'}?id={$productID}">Manage product inventory ></a></span></div>
		<button style='float:left;' type='button' onclick="this.hide(); Effect.BlindDown('userFabricSet');">Edit custom color/fabric sets</button>
	<div id='userFabricSet' class='box' style='display:none;'>
		<div style="width:49%; float:left; ">
		
		<div class='box' style='margin-bottom:10px;'>
			<div class='fullTitleBarMid'><strong>Current product color/fabric sets</strong></div>
			<form id='removeFabricSet' action="{geturl controller='manageattribute' action='removeattributefromproduct'}" method='post'>
				<div id='userSelectedFabricSet' class='box'>
					{foreach from=$fp->existingFabricSet item=generalSet}
					<div class='existingFabricSetGeneral'>
						<input type='checkbox' name=removeProductAttributeSet[{$generalSet.product_attribute_id}] value='{$generalSet.product_attribute_id}'/><span class="tooltipControl">{$generalSet.name}</span>
						<div class='tooltip'>
							<table>
								
								{foreach from=$generalSet.details item=detail}
									<tr><td>{$detail.details_name}</td>
										<td>${$detail.price_offset}</td>
										{if $detail.filename!=NULL}
										<td><img src='/public/resources/userdata/tmp/thumbnails/{$detail.username}/fabric_set_details/{$generalSet.name}/{$detail.id}.W30_miniDetailImage.jpg'></td>
										{else}
										<td></td>
										{/if}
									</tr>
								{/foreach}
							</table>
						</div>
					</div>
					{/foreach}
				</div>
				
				<input type="hidden" name='attributeType' value='fabric_set' />
				<input type="hidden" name='ID' value='{$productID}' /><br/><br/>
				<button type="button" onclick="editProductAttributes('fabric_set', 'removeFabricSet', 'existingFabricSetGeneral', 'userSelectedFabricSet')">Remove selected color/fabric set from product</button>
			</form>
			
		</div>
			<div class='box' style='margin-top:20px;'>
			<div class='titleBarMid'><strong>Other color/fabric sets</strong></div>
			<form id='addFabricSet' action="{geturl controller='manageattribute' action='addattributetoproduct'}" method='post'>
			
			<div id='userAvailableFabricSet' style='max-height:200px; overflow-y:scroll;'>
				{foreach from=$fp->fabric_set item=generalSet}
					<div class='AvailabeFabricSetGeneral'>
						<input type='checkbox' name=addAttributeSet[{$generalSet.id}] value='{$generalSet.id}'/><span class="tooltipControl">{$generalSet.name_of_set}</span>
						<div class='tooltip'>
							<table>
								
								{foreach from=$generalSet.details item=detail}
									<tr><td>{$detail.details_name}</td>
										<td>${$detail.price_offset}</td>
										{if $detail.filename!=NULL}
										<td><img src='/public/resources/userdata/tmp/thumbnails/{$detail.username}/fabric_set_details/{$generalSet.name_of_set}/{$detail.id}.W30_miniDetailImage.jpg'></td>
										{else}
										<td></td>
										{/if}
									</tr>
								{/foreach}
							</table>
						</div>
						<span style='float:right;'><a href="{geturl controller='manageattribute' action='uploadattribute'}?actioncall=0&paramSet=fabric_set&id={$generalSet.id}" style='padding-right:5px;'>Edit</a>
						<a href="{geturl controller='manageattribute' action='removeattribute'}?type=fabric_set&id={$generalSet.id}">Delete</a></span>
					</div>
				{/foreach}
			</div>
			<input type="hidden" name='attributeType' value='fabric_set'/>
			<input type="hidden" name='ID' value='{$productID}' /><br/>
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
			<form id='removeAttributeSet' action="{geturl controller='manageattribute' action='removeattributefromproduct'}" method='post'>
				<div id='userSelectedAttributeSet' >
					{foreach from=$fp->existingAttributeSet item=generalSet}
					<div class='existingCustomSetGeneral'>
						<input type='checkbox' name=removeProductAttributeSet[{$generalSet.product_attribute_id}] value='{$generalSet.product_attribute_id}'/>
						<span class="tooltipControl">{$generalSet.name}</span>
						<div class='tooltip'>
							<table>
								
								{foreach from=$generalSet.details item=detail}
									<tr><td>{$detail.details_name}</td>
										<td>${$detail.price_offset}</td>
										{if $detail.filename!=NULL}
										<td><img src='/public/resources/userdata/tmp/thumbnails/{$detail.username}/custom_attribute_details/{$generalSet.name}/{$detail.id}.W30_miniDetailImage.jpg'></td>
										{else}
										<td></td>
										{/if}
									</tr>
								{/foreach}
							</table>
						</div>
					</div>
					{/foreach}
				</div>
				<input type="hidden" name='attributeType' value='custom_attribute' />
				<input type="hidden" name='ID' value='{$productID}' /><br/><br/>
				<button type="button" onclick="editProductAttributes('custom_attribute', 'removeAttributeSet', 'existingCustomSetGeneral', 'userSelectedAttributeSet')">Remove selected custom attribute set from product</button>
			</form>
		</div>
		
		<div class="box" style='padding-top:20px;'>
			<div class='titleBarMid'><strong>Other attribute sets</strong></div>
			<form id='addAttributeSet' action="{geturl controller='manageattribute' action='addattributetoproduct'}" method='post'>
			
			<div id='userAvailableAttributeSet' style='max-height:200px; overflow-y:scroll;'>
				{foreach from=$fp->custom_attribute item=generalSet}
					<div class='AvailabeCustomSetGeneral'>
						<input type='checkbox' name=addAttributeSet[{$generalSet.id}] value='{$generalSet.id}'/>
						<span class="tooltipControl">{$generalSet.name_of_set}</span>
						<div class='tooltip'>
							<table>
								
								{foreach from=$generalSet.details item=detail}
									<tr><td>{$detail.details_name}</td>
										<td>${$detail.price_offset}</td>
										{if $detail.filename!=NULL}
										<td><img src='/public/resources/userdata/tmp/thumbnails/{$detail.username}/custom_attribute_details/{$generalSet.name_of_set}/{$detail.id}.W30_miniDetailImage.jpg'></td>
										{else}
										<td></td>
										{/if}
									</tr>
								{/foreach}
							</table>
						</div>
						<span style='float:right;'><a href="{geturl controller='manageattribute' action='uploadattribute'}?actioncall=0&paramSet=custom_attribute&id={$generalSet.id}" style='padding-right:5px;'>Edit</a>
						<a href="{geturl controller='manageattribute' action='removeattribute'}?type=custom_attribute&id={$generalSet.id}">Delete</a></span>
					</div>
				{/foreach}
			</div>
			<input type="hidden" name='attributeType' value='custom_attribute'/>
			<input type="hidden" name='ID' value='{$productID}' />
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
	<form id='productAttributeMainForm' action="{geturl controller='manageattribute' action='saveproductattribute'}" method='post'>
	<div class='box' style='width:50%;'>
	{include file="manageattribute/$attributePartial" colorsAndShoesAttributes=$fp->systemColorAndShoesAttributes}
	</div>
	<div class='box' style='width:50%;'>
		<div class='box'>
		Please select major color categories this product belongs to. <br/><br/>
		<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Black]" {if $fp->systemColorAndShoesAttributes.colors.0.Black=="1"}checked='checked'{/if}/>Black
		</div>  <div style='float:left; width:20%'>
		<input type="checkbox" name="color[Pin_stripe]" {if $fp->systemColorAndShoesAttributes.colors.0.Pin_stripe=="1"}checked='checked'{/if}/>Pin stripe
		</div>  <div style='float:left; width:20%'>
		<input type="checkbox" name="color[Light_tan]" {if $fp->systemColorAndShoesAttributes.colors.0.Light_tan=="1"}checked='checked'{/if}/>Light tan
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Dark_tan]" {if $fp->systemColorAndShoesAttributes.colors.0.Dark_tan=="1"}checked='checked'{/if}/>Dark tan
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Brown]" {if $fp->systemColorAndShoesAttributes.colors.0.Brown=="1"}checked='checked'{/if}/>Brown
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Silver]" {if $fp->systemColorAndShoesAttributes.colors.0.Silver=="1"}checked='checked'{/if}/>Silver
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Gold]" {if $fp->systemColorAndShoesAttributes.colors.0.Gold=="1"}checked='checked'{/if}/>Gold
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Gray]" {if $fp->systemColorAndShoesAttributes.colors.0.Gray=="1"}checked='checked'{/if}/>Gray
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[White]" {if $fp->systemColorAndShoesAttributes.colors.0.White=="1"}checked='checked'{/if}/>White
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Red]" {if $fp->systemColorAndShoesAttributes.colors.0.Red=="1"}checked='checked'{/if}/>Red
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Pink]" {if $fp->systemColorAndShoesAttributes.colors.0.Pink=="1"}checked='checked'{/if}/>Pink
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Orange]" {if $fp->systemColorAndShoesAttributes.colors.0.Orange=="1"}checked='checked'{/if}/>Orange
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Yellow]" {if $fp->systemColorAndShoesAttributes.colors.0Yellow=="1"}checked='checked'{/if}/>Yellow
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Green]" {if $fp->systemColorAndShoesAttributes.colors.0.Green=="1"}checked='checked'{/if}/>Green
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Cyan]" {if $fp->systemColorAndShoesAttributes.colors.0.Cyan=="1"}checked='checked'{/if}/>Cyan
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Blue]" {if $fp->systemColorAndShoesAttributes.colors.0.Blue=="1"}checked='checked'{/if}/>Blue
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Magenta]" {if $fp->systemColorAndShoesAttributes.colors.0.Magenta=="1"}checked='checked'{/if}/>Magenta
		</div>	<div style='float:left; width:20%'>
		<input type="checkbox" name="color[Purple]" {if $fp->systemColorAndShoesAttributes.colors.0.Purple=="1"}checked='checked'{/if}/>Purple
		</div><div style='float:left; width:20%'>
		<input type="checkbox" name="color[Multicolor]" {if $fp->systemColorAndShoesAttributes.colors.0.Multicolor=="1"}checked='checked'{/if}/>Multicolor
		</div><div style='float:left; width:20%'>
		<input type="checkbox" name="color[Munocolor]" {if $fp->systemColorAndShoesAttributes.colors.0.Monocolor=="1"}checked='checked'{/if}/>Monocolor</div>
		<br/>
		<br/>
		<input type='hidden' name='id' value='{$productID}'/>
		
		</div>
	</div>
	
	</form>

<!--<button type='button' onclick="showCustomizableSection('customizableSection')">Add fabric or custom attributes</button>-->


<div class='box' style='margin-top:20px;'>
	<button type='button' onclick="submitMainForm('productAttributeMainForm')" class='largeSubmit'>Save and proceed to manage product inventory</button>
	</div>
		
{literal}
<script type="text/javascript">
tooltipReset();
function editProductAttributes(attributeType, formID, attributeUnit, attributeContainer){
	//alert('here at form add selected fabic attribute');
	alert(attributeType);
	alert(formID);
	var form = $(formID);

	var options={
			parameters: form.serialize(true),
			method: form.method,
			onLoaded: showloadingImage(), 
			onSuccess: function(transport){
						hideloadingImage();
						alert('here at added attributes successfull');
						var json = transport.responseText.evalJSON(true);
						var htmlInjection='';
						json.each(function(value){
							htmlInjection+= "<div class='"+attributeUnit+"'>"
								+"<input type='checkbox' name=removeProductAttributeSet["+value.product_attribute_id+"] value='"+value.product_attribute_id+"'/>"
								+"<span class='tooltipControl'>"+value.name+"</span>"
								+"<div class='tooltip'><table><tr><td>Option names</td><td>Price offset</td>"
								+"<td>Image</td>"
								+"</tr>";

							value.details.each(function(detail){
								htmlInjection+="<tr><td>"+detail.details_name+"</td>"
											  +"<td>"+detail.price_offset+"</td>";
								  			if(detail.filename!=null){
								htmlInjection+="<td><img src='/public/resources/userdata/tmp/thumbnails/"+detail.username+"/"+attributeType+"_details/"+value.name+"/"+detail.id+".W30_miniDetailImage.jpg'></td>";
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

	//alert('here');
	new Ajax.Request(form.action, options);
}

                           
</script>
{/literal}

{include file="layouts/$layout/footer.tpl"}