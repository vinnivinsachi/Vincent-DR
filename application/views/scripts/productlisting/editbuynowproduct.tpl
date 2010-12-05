{include file="layouts/$layout/header.tpl"}

	<div id="leftContainer" style="width:100%;">
    	
    	<div class='titleBarBig'>Step 1: &nbsp;&nbsp;&nbsp;List a product - {$productForm->productTag}  
    	</div>
    	<div class='formContent'>
   
    	<form id="generalDetailForm" enctype="multipart/form-data" method="post" action="{geturl route=$route storeName=$storeName}?category={$productCategory}&type={$productType}&tag={$productTag}&id={$productID}">
	    	<div class='formLeftDivision'>
	    	<div class='box' >
					<div class='titleBarMid'><strong>Basic information</strong></div>
				</div>
		        <label>Name:</label>
		        <input type="text" value="" name="name" class='inputShiftOne'/><br>
				
				<label>Brand:</label>
		        <select name="brand" class='inputShiftOne'>
                	{foreach from=$sysBrands item=brand}
		       		<option value="{$productForm->brand}">{$brand}</option>
                    {/foreach}
		        </select><br>
				
				
				<div>
		        	<label style="height:30px;">Product use:</label>
		        	<input type="checkbox" name="socialUsage" {if $fp->social_usage=='on'}checked=checked{/if} class='inputShiftOne'/>Social/practice<br/>
		        	<input type="checkbox" name="competitionUsage" {if $fp->competition_usage=='on'}checked=checked{/if} class='inputShiftOne'/>Competition<br/>
				</div>
		
				<div>
		        <label>Price:</label>
		        $<input type="text" value="" name="price"><br>
				</div>
		        
		        <div>
		        <label>Domestic shipping:</label>
		        $<input type="text" value="" name="domesticShippingRate" /><br />
		        </div>
		        <div>
		        <label>International shipping:</label>
		        $<input type="text" value="" name="internationalShippingRate" /><br />
			        </div>
		        <input type='hidden' name="backorder_time" value='NA'/>
		        
		        <div style='margin: 5px 0px 10px 0px; width:100%;'>
				<label>Returnable:</label>
				<input type="radio" name='returnAllowed' value='1' checked="checked" class='inputShiftOne'/>yes
				<input type="radio" name='returnAllowed' value='0' />no
				</div>
				
		        <label>Youtube video (optional):</label>
		        <input type='text' value="" name="videoYoutube" class='inputShiftOne'/><br />
		        <br/>
	        </div>
        
	        <div class='formRightDivision'>
		        <div style='margin-bottom:10px;'>
		        <div class='box' >
					<div class='fullTitleBarMid'><strong>Description</strong></div>
				</div>
                <textarea name="description"></textarea>
		       <!-- -->
				</div>
		        <input type="hidden" name="id" value="" />
		        <input type="hidden" name="product" value="" />
		        <input type="hidden" name="tag" value="" />
		        
		        <div class='box marginTop20'>
					<div class='fullTitleBarMid'><strong>Upload sample image</strong></div>
		        <div id="imageBlock" >
		        	<div id="image_0" class="imageInput">
			        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[0]" />
						<a onclick='this.up().remove();' style='float:right; padding-right:10px;'>Delete</a>
					</div>
				</div>
				</div>
				
				<button type='button' id='addAnotherImage' onclick='addNewImageBlock()'>Add another image</button>
				
				<br/>
			</div>
			
        
        <!-- Listing details (One inventory) -->
        
        <div id='addInventoryFormMainDiv' style="padding-bottom:10px; float:left; width:100%;"> 
		<div class='titleBarBig marginTop20'>Step 2:  &nbsp;&nbsp;&nbsp;Edit listing details
		
		</div>
			<div class="manageInventoryMainDiv" >
		
			<div class='formLeftDivision'>
		
			<div class='titleBarMid'><strong>Search criteria</strong></div>
		
			<input type='hidden' name="inventory[sys_name]'"value='' class='inputShiftOne'/>
			
			<div class="systemColorSelection" >
	        	<label>Color:</label>
				<select name='inventory[sys_color]' class='inputShiftOne'>
                	{foreach from=$sysColors item=color}
					<option value='{$color}' {if $inventory.basic.sys_color=='{$color}'}selected="selected"{/if}>{removeunderscore phrase=$color}</option>
                    {/foreach}
				</select>
			</div>
			
			<div class="systemInventoryConditions">
				<label>Condition:</label>
				<select name='inventory[sysConditions]' class='inputShiftOne'>
                	{foreach from=$sysConditions item=condition}
					<option value='{$condition}' {if $inventory.basic.sys_conditions=="{$condition}"}selected="selected"{/if}>{removeunderscore phrase=$condition}</option>
                    {/foreach}
				</select>
			</div>
			
			
				{include file="productlisting/_attributes/$attributePartial" colorsAndShoesAttributes=$product.systemColorAndShoesAttributes}
				<div class='inventory[sys_quantity_div]'>
			<label>Quantity:</label>
			<select name='inventory[sys_quantity]' class='inputShiftOne'>
			<option value='1' {if $inventory.basic.sys_quantity=='1'}selected="selected"{/if}>1</option>
			<option value='2' {if $inventory.basic.sys_quantity=='2'}selected="selected"{/if}>2</option>
			<option value='3' {if $inventory.basic.sys_quantity=='3'}selected="selected"{/if}>3</option>
			<option value='4' {if $inventory.basic.sys_quantity=='4'}selected="selected"{/if}>4</option>
			<option value='5' {if $inventory.basic.sys_quantity=='5'}selected="selected"{/if}>5</option>
			<option value='6' {if $inventory.basic.sys_quantity=='6'}selected="selected"{/if}>5</option>
			<option value='7' {if $inventory.basic.sys_quantity=='7'}selected="selected"{/if}>7</option>
			<option value='8' {if $inventory.basic.sys_quantity=='8'}selected="selected"{/if}>8</option>
			<option value='9' {if $inventory.basic.sys_quantity=='9'}selected="selected"{/if}>9</option>
			<option value='10' {if $inventory.basic.sys_quantity=='10'}selected="selected"{/if}>10</option>
			</select>
			</div>
			</div>
		</div>
	
		</div>
		</div>
		
		<div class='box marginTop20'>
				<input type='submit' name='save' value='Save and list this item >' onclick=showloadingImage() class='largeSubmit'/>
			</div>
        </form>
        </div>
        
        <div class='box'>
			<div class='fullTitleBarMid'><strong>Product images</strong></div>
			<div class='boxContent'>
			{if $fp->product->images|@count>0}
	            <ul id="post_images">
	                {foreach from=$fp->product->images item=image}
	                    <li >
	                        <img src="{$siteRoot}/public/resources/userdata/tmp/thumbnails/{$signedInUser->generalInfo->username}/{$fp->product->product_tag}/{$image.image_id}.W150_homeFrontFour.jpg" alt="{$image.filename}" />
	                        
	                        <form id='imageForm' method="post" action="{geturl action='images'}">
	                            <div>
	                                <input type="hidden" name="id" value="{$fp->product->getId()}" />
	                                <input type="hidden" name="tag" value="{$fp->product->product_tag}" />
	                                <input type="hidden" name='image_type' value="product_images" />
	                                <input type="hidden" name="image" value="{$image.image_id}" />
	                                <input type='submit' name='delete' value='delete' onclick=showloadingImage() />
	                            </div>
	                        </form>
	                    </li>
	                {/foreach}
	            </ul>
	        {/if}
	        </div>
        </div>
        
        
        
        
	</div>
{include file="layouts/$layout/footer.tpl"}