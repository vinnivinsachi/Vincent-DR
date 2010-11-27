{include file="layouts/$layout/header.tpl" lightbox=true}

INDEX

<form enctype="multipart/form-data" method="post" action="/public/test/imagetest">

		<div class='formRightDivision'>
		        <div style='margin-bottom:10px;'>
                
               <div class='box' >
					<div class='titleBarMid'><strong>Basic information</strong></div>
				</div>
                <input type="hidden" name="purchaseType" value="CUSTIMIZE" />
                <input type="hidden" name="productCategory" value="WOMEN" />
                <input type="hidden" name="inventoryAttributeTable" value="shoes" />
                <input type="hidden" name="productTag" value="Ladies latin shoes" />
                <input type="hidden" name="productPriceRange" value="productPrice1" />
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
                
                
		        <div class='box' >
					<div class='fullTitleBarMid'><strong>Description:</strong></div>
				</div>
                    <textarea name="description">This is where product image description goes.</textarea>

		        <div class='box marginTop20'>
					<div class='fullTitleBarMid'><strong>Attributes</strong></div>
                </div>
                
                <!-- PRODUCT ATTRIBUTES -->
                <div>
                {include file="productlisting/_attributes/_shoesAttribute.tpl"}
                
                </div>
                
                
                
                
		        <div class='box marginTop20'>
					<div class='fullTitleBarMid'><strong>Upload sample image</strong></div>
                </div>

		        <div id="imageBlock" >
		        	<div id="image_0" class="imageInput">
			        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[0]" />
						
					</div>
                    <div id="image_1" class="imageInput">
			        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[1]" />
						
					</div>
                    <div id="image_2" class="imageInput">
			        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[2]" />
						
					</div>
				</div>
                <input type="submit" value="submit" />
				
                
				
				<br/>
			</div>
        </div>
        
        
            

</form>


{include file="layouts/$layout/footer.tpl"}
