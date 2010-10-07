{include file="layouts/$layout/header.tpl" lightbox=true}

<div id='addInventoryFormMainDiv' style='padding-bottom:10px; float:left; width:100%;'>
		<div class='titleBarBig'>Add an inventory product - {$product.0.name}
		<span style='float:right; font-weight:normal;'>
		<a href="{geturl controller='productlisting' action='editcustomproduct'}?purchase_type={$product.0.purchase_type}&category={$product.0.product_category}&type={$product.0.product_type}&tag={$product.0.product_tag}&id={$product.0.product_id}" style='margin-right:20px;'>< Edit basic information</a>
		<a href="{geturl controller='manageattribute' action='editproductattribute'}?id={$product.0.product_id}">< Edit product attribute</a></span>
		</div><!--
		
		<button type='button' style='float:left;' onClick="this.hide(); Effect.BlindDown('addProductInventory');">Add an inventory product</button>
		--><form id='addProductInventory' enctype="multipart/form-data" action='{geturl controller="manageinventory" action="addinventory"}?id={$product.0.product_id}' method='post' >
		<div class="manageInventoryMainDiv" >
			<div class='formLeftDivision'>
		
			<div class='titleBarMid'><strong>Basic information</strong></div>
			<div class="inventoryName">
				<label>Name:</label>
				<input type='text' name='sys_name' value='{$product.0.name}' class='inputShiftOne'/>
			</div>
			
			<div class="systemColorSelection">
	        	<label>Color:</label>
				<select name='sys_color' class='inputShiftOne'>
				{foreach from=$product.systemColorAndShoesAttributes.colors.0 item=sysColor key=Key}
					{if $sysColor=='1' && $Key!='product_id'}
						<option value={$Key}>{removeunderscore phrase=$Key}</option>
					{/if}
				{/foreach}
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
				$<input type="text" value="{$product.0.price}" name="sys_price"/>
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
				{include file="manageinventory/$attributePartial" colorsAndShoesAttributes=$product.systemColorAndShoesAttributes}
			</div>
			
			
			
			<div class="inventoryDescription">
			<label>Description: </label><textarea name='sys_description' rows='4' cols="29" class='inputShiftOne'></textarea>
			</div>
			</div>
			<div class='formRightDivision'>
				<div class="colorFabricAttributes box">
					<div class='fullTitleBarMid'><strong>Custom color/fabric options</strong><span style='float:right; padding-right:10px;'><a href="{geturl controller='manageattribute' action='editproductattribute'}?id={$product.0.product_id}">Edit</a></span></div>
					{foreach from=$product.existingFabricSet item=existingFabricSet key=Key}
						<div class='box'>
						<label>Color/fabric {$Key+1} {removeunderscore phrase=$existingFabricSet.name}:</label>
						<select name='Attr_color__{$Key+1}_{$existingFabricSet.name}'>
							{foreach from=$existingFabricSet.details item=details}
								<option value='{$details.details_name}'>{$details.details_name}</option>
							{/foreach}
						</select></div>
					{/foreach}
				</div><!-- Color_fabric_option_$Key_$existingFabricSet.name -->
				
				<div class="customAttributes box marginTop20">
					<div class='fullTitleBarMid'><strong>Custom attribute options</strong> <span style='float:right; padding-right:10px;'><a href="{geturl controller='manageattribute' action='editproductattribute'}?id={$product.0.product_id}">Edit</a></span></div>
					{foreach from=$product.existingAttributeSet item=existingAttributeSet key=Key}
						<div class='box'>
					
						<label>Custom option {$Key+1} {removeunderscore phrase=$existingAttributeSet.name}:</label>
						<select name='Attr_{$Key+1}_{$existingAttributeSet.name}'>
							{foreach from=$existingAttributeSet.details item=details}
								<option value="{$details.details_name}">{$details.details_name}</option>
							{/foreach}
						</select></div>
					{/foreach}
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
				<input type="hidden" name='id' value="{$product.0.product_id}" />
			
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
	<div class='titleBarBig'>Current inventory - {$product.0.name}</div>
	<div class='box'>
	<form action='{geturl controller="manageinventory" action="updateinventoryquantity"}'>
		<div id='inventoryDetail'>
			<table class='inventoryTable'>
		
				<tr class='trTitle'>
					<td>Name</td>
					<td>Price</td>
					<td>Color</td>
					{include file="manageinventory/$inventoryPartialTitle"}
					{foreach from=$mostInventoryProfile item=profile}
					<td>{removeunderscore phrase=$profile.profile_key}</td>
					{/foreach}
					<td>Quantity</td>
					<td></td>
				</tr>
				<tr style='height:10px;'>
					
				</tr>
				{foreach from=$inventories item=inventory key=inventoryKey}
					 {cycle values='colorOdd,colorEven' assign='class'} 
			         {if $smarty.foreach.menu_items.first} 
			            {assign var='class' value=$class|cat:' first'} 
			         {elseif $smarty.foreach.menu_items.last} 
			            {assign var='class' value=$class|cat:' last'} 
			         {/if} 
				<tr class='trDetails {$class}' id='inventoryID_{$inventory.basic.product_inventory_id}'>
					<td>{removeunderscore phrase=$inventory.basic.sys_name}</td>
					<td>${removeunderscore phrase=$inventory.basic.sys_price}</td>
					<td>{removeunderscore phrase=$inventory.basic.sys_color}</td>
					{include file="manageinventory/$inventoryPartial" inventory=$inventory}
					{foreach from=$mostInventoryProfile item=profile key=Key}
						<td>
							{foreach from=$inventory.profile item=profile2}
								{if $profile2.profile_key==$profile.profile_key}
								{$profile2.profile_value}
								{/if}
							{/foreach}
						</td>
					{/foreach}
					<td><input type='text' name='quantity[{$inventory.basic.product_inventory_id}]' value='{$inventory.basic.sys_quantity}' style='width:50px;'/></td>
					<td><a href="{geturl controller='manageinventory' action='deleteinventory'}?id={$inventory.basic.product_inventory_id}">Delete</a></td>
				</tr>
				<tr>
					<td colspan="4">
					{foreach from=$inventory.images item=image}
					<div style='border:1px solid gray; margin-right:3px; float:left;'>
					<img src='/public/resources/userdata/tmp/thumbnails/{$product.0.uploader_username}/inventory/{$image.image_id}.W50_productSmallPreview.jpg'/>
					<a href="{geturl controller='manageinventory' action='image'}?id={$image.Product_id}&image={$image.image_id}&delete=true"><img src="/public/resources/css/images/Crosses.png" /></a>
					</div> 
					{/foreach}
					</td>
				</tr>
				{/foreach}
			</table>
		</div>
		<input class='marginTop20' style='float:right;' type='submit' onclick=showloadingImage() value='Update inventory'/>
	</form>
	</div>
</div>
	
{literal}
<script type="text/javascript">


</script>
{/literal}
{include file="layouts/$layout/footer.tpl"}
