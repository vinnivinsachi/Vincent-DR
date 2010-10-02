{include file="layouts/$layout/header.tpl" lightbox=true}
	<div id="leftContainer" style="width:100%;">
    	<div class='titleBarBig'>{$fp->product_tag} details {if $fp->product_id!='' && $fp->product_id!=0}
       	<span style='float:right; font-weight:normal;'><a href="{geturl controller='manageattribute' action='editproductattribute'}?id={$fp->product_id}" style='margin-right:20px;'>Edit product attribute ></a>
        <a href="{geturl controller='manageinventory' action='addinventory'}?id={$fp->product_id}">Manage product inventory ></a></span>
    	{/if}
    	</div>
       	<div class='formContent'>
   
    	<form id="generalDetailForm" enctype="multipart/form-data" method="post" action="{geturl controller='productlisting' action='editcustomproduct'}?purchase_type={$fp->purchase_type}&category={$fp->product_category}&type={$fp->product_type}&tag={$fp->product_tag}&id={$fp->product_id}">
	    	<div class='formLeftDivision'>
	    		<div class='box' >
					<div class='titleBarMid'><strong>Basic info</strong></div>
				</div>
		        <label>Name:</label>
		        <input type="text" value="{$fp->name}" name="name" class='inputShiftOne'/><br>
		    	{include file='partials/error.tpl' error=$fp->getError('name')}
				
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
		        {include file='partials/error.tpl' error=$fp->getError('brand')}
				
				
				<div>
		        	<label style="height:30px;">Product use:</label>
		        	<input type="checkbox" name="social_usage" {if $fp->social_usage=='on'}checked=checked{/if} class='inputShiftOne'/>Social/practice<br/>
		        	<input type="checkbox" name="competition_usage" {if $fp->competition_usage=='on'}checked=checked{/if} class='inputShiftOne'/>Competition<br/>
				</div>
		
				<div>
		        <label>Price:</label>
		        $<input type="text" value="{$fp->price}" name="price"><br>
		        {include file='partials/error.tpl' error=$fp->getError('price')}
				</div>
		        <div>
		        <label>Sale price (optional):</label>
		        $<input type="text" value="{$fp->sales_price}" name="sales_price" /><br />
		        </div>
		        <div>
		        <label>Domestic shipping:</label>
		        $<input type="text" value="{$fp->domestic_shipping_rate}" name="domesticShippingRate" /><br />
		        {include file='partials/error.tpl' error=$fp->getError('domesticShippingRate')}
		        </div>
		        <div>
		        <label>International shipping:</label>
		        $<input type="text" value="{$fp->international_shipping_rate}" name="internationalShippingRate" /><br />
		        {include file='partials/error.tpl' error=$fp->getError('internationalShippingRate')}
		        </div>
		        <div>
		        <label><a class='guide' title='The time it takes to deliver the product, if it is not in stock.'>Backorder time:</a></label>
		        <select name="backorder_time" class='inputShiftOne'>
		        	<option value="NA" {if $fp->backorder_time=='NA'}selected =selected{/if}>NA</option>
		        	<option value="1 week" {if $fp->backorder_time=='1 week'}selected=selected{/if}>1 week</option>
		            <option value="2 weeks" {if $fp->backorder_time=='2 weeks'}selected=selected{/if}>2 weeks</option>
		            <option value="3 weeks" {if $fp->backorder_time=='3 weeks'}selected=selected{/if}>3 weeks</option>
		            <option value="4 weeks" {if $fp->backorder_time=='4 weeks'}selected=selected{/if}>4 weeks</option>
		            <option value="5 weeks" {if $fp->backorder_time=='5 weeks'}selected=selected{/if}>5 weeks</option>
		            <option value="6 weeks" {if $fp->backorder_time=='6 weeks'}selected=selected{/if}>6 weeks</option>
		            <option value="7 weeks" {if $fp->backorder_time=='7 weeks'}selected=selected{/if}>7 weeks</option>
		            <option value="8 weeks" {if $fp->backorder_time=='8 weeks'}selected=selected{/if}>8 weeks</option>
		        </select></div>
		        
		        <div style='margin: 5px 0px 10px 0px; width:100%;'>
				<label>Returnable:</label>
				<input type="radio" name='return' value='1' checked="checked" class='inputShiftOne'/>yes
				<input type="radio" name='return' value='0' {if $fp->return_allowed=='0'}checked="checked"{/if}/>no
				</div>
				
		        <label>Youtube Video (optional):</label>
		        <input type='text' value="{$fp->video_youtube}" name="video_youtube" class='inputShiftOne'/><br />
		        <br/>
	        </div>
        
	        <div class='formRightDivision'>
		        <div style='margin-bottom:10px;'>
				<div class='box' >
					<div class='fullTitleBarMid'><strong>Description</strong></div>
				</div>		       
				{wysiwyg name='description' value=$fp->description}
				</div>
		        <input type="hidden" name="id" value="{$fp->product_id}" />
		        <input type="hidden" name="product" value="{$fp->product_type}" />
		        <input type="hidden" name="tag" value="{$fp->product_tag}" />
		        
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
			<div class='box marginTop20'>
				<input type='submit' name='save' value='Save and proceed to product attributes >' onclick=showloadingImage() class='largeSubmit'/>
			</div>
        </form>
        </div>
        
        <div class='box'>
			<div class='fullTitleBarMid'><strong>Product sample images</strong></div>
			<div class='boxContent'>
			{if $fp->product->images|@count>0}
	            <ul id="post_images">
	                {foreach from=$fp->product->images item=image}
	                    <li >
	                        <img src="/public/resources/userdata/tmp/thumbnails/{$signedInUser->generalInfo->username}/{$fp->product->product_tag}/{$image.image_id}.W150_homeFrontFour.jpg" alt="{$image.filename}" />
	                        
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