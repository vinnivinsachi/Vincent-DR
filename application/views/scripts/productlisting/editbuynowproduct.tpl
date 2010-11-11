{include file="layouts/$layout/header.tpl"}

	<div id="leftContainer" style="width:100%;">
    	
    	<div class='titleBarBig'>Step 1: &nbsp;&nbsp;&nbsp;List a product - {$fp->product_tag}  {if $fp->product_id!='' && $fp->product_id!=0}
        
    {/if}
    	</div>
    	<div class='formContent'>
   
    	<form id="generalDetailForm" enctype="multipart/form-data" method="post" action="{geturl controller='productlisting' action='editbuynowproduct'}?purchase_type={$fp->purchase_type}&category={$fp->product_category}&type={$fp->product_type}&tag={$fp->product_tag}&id={$fp->product_id}">
	    	<div class='formLeftDivision'>
	    	<div class='box' >
					<div class='titleBarMid'><strong>Basic information</strong></div>
				</div>
		        <label>Name:</label>
		        <input type="text" value="" name="name" class='inputShiftOne'/><br>
				
				<label>Brand:</label>
		        <select name="brand" class='inputShiftOne'>
		       		<option value="Supadance">Supadance</option>
		            <option value="International">International</option>
		            <option value="Rayrose">Rayrose</option>
		            <option value="DN">DanceNaturals</option>
		            <option value="STP">StephanieProfessional</option>
		            <option value="BDdance">BDdance</option>
		            <option value="SDUSA">SoulDancer</option>
		            <option value="Chrissane">Chrissane</option>
		            <option value="Other">Other</option>
		        </select><br>
				
				
				<div>
		        	<label style="height:30px;">Product use:</label>
		        	<input type="checkbox" name="social_usage" {if $fp->social_usage=='on'}checked=checked{/if} class='inputShiftOne'/>Social/practice<br/>
		        	<input type="checkbox" name="competition_usage" {if $fp->competition_usage=='on'}checked=checked{/if} class='inputShiftOne'/>Competition<br/>
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
				<input type="radio" name='return' value='1' checked="checked" class='inputShiftOne'/>yes
				<input type="radio" name='return' value='0' {if $fp->return_allowed=='0'}checked="checked"{/if}/>no
				</div>
				
		        <label>Youtube video (optional):</label>
		        <input type='text' value="" name="video_youtube" class='inputShiftOne'/><br />
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
					<option value='Black' {if $inventory.basic.sys_color=='Black'}selected="selected"{/if}>Black</option>
					<option value='Pin_stripe' {if $inventory.basic.sys_color=='Pin_stripe'}selected="selected"{/if}>Pin stripe</option>
					<option value='Light_tan' {if $inventory.basic.sys_color=='Light_tan'}selected="selected"{/if}>Light tan</option>
					<option value='Dark_tan' {if $inventory.basic.sys_color=='Dark_tan'}selected="selected"{/if}>Dark tan</option>
					<option value='Brown' {if $inventory.basic.sys_color=='Brown'}selected="selected"{/if}>Brown</option>
					<option value='Silver' {if $inventory.basic.sys_color=='Silver'}selected="selected"{/if}>Silver</option>
					<option value='Gold' {if $inventory.basic.sys_color=='Gold'}selected="selected"{/if}>Gold</option>
					<option value='Gray' {if $inventory.basic.sys_color=='Gray'}selected="selected"{/if}>Gray</option>
					<option value='White' {if $inventory.basic.sys_color=='White'}selected="selected"{/if}>White</option>
					<option value='Red' {if $inventory.basic.sys_color=='Red'}selected="selected"{/if}>Red</option>
					<option value='Pink' {if $inventory.basic.sys_color=='Pink'}selected="selected"{/if}>Pink</option>
					<option value='Orange' {if $inventory.basic.sys_color=='Orange'}selected="selected"{/if}>Orange</option>
					<option value='Yellow' {if $inventory.basic.sys_color=='Yellow'}selected="selected"{/if}>Yellow</option>
					<option value='Green' {if $inventory.basic.sys_color=='Green'}selected="selected"{/if}>Green</option>
					<option value='Cyan' {if $inventory.basic.sys_color=='Cyan'}selected="selected"{/if}>Cyan</option>
					<option value='Blue' {if $inventory.basic.sys_color=='Blue'}selected="selected"{/if}>Blue</option>
					<option value='Magenta' {if $inventory.basic.sys_color=='Magenta'}selected="selected"{/if}>Magenta</option>
					<option value='Purple' {if $inventory.basic.sys_color=='Purple'}selected="selected"{/if}>Purple</option>
				</select>
			</div>
			
			<div class="systemInventoryConditions">
				<label>Condition:</label>
				<select name='inventory[sys_conditions]' class='inputShiftOne'>
					<option value='New' {if $inventory.basic.sys_conditions=="New"}selected="selected"{/if}>New</option>
					<option value='Like new' {if $inventory.basic.sys_conditions=="Like new"}selected="selected"{/if}>Like new</option>
					<option value='Good' {if $inventory.basic.sys_conditions=="Good"}selected="selected"{/if}>Good</option>
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