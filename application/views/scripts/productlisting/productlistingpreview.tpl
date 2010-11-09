{include file='header.tpl' lightbox=true}
<br />
<br />
<br />

id: {$product->getId()}<br />
type: {$product->product_type}<br />
product section: {$product->product_tag}<br />
name: {$product->name}<br />
price: {$product->price}<br />
discount price: {$product->discount_price}<br />
brand: {$product->brand}<br />
reward point: {$product->reward_point}<br />
video youtube: {$product->video_youtube}<br />
backorder time: {$product->backorder_time}<br />

Description: {$product->profile->description}<br />

<a href="{geturl action='editproduct'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}">Edit</a>
<a href="{geturl action='listingpreview'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}">Preview this listing</a>
<field>
	<fieldset id="preview-images" style="padding:20px;">
        <legend>General Product Images</legend>
        {if $product->images|@count>0}
            <ul id="post_images">
                {foreach from=$product->images item=image}
                    <li >
                        <img src="/data/tmp/thumbnails/{$signedInUser->generalInfo->username}/{$signedInUser->generalInfo->user_type}/{$product->product_type}/{$image.image_id}.W150_homeFrontFour.jpg" alt="{$image.filename}" />
                        
                        <form method="post" action="{geturl action='images'}">
                            <div>
                                <input type="hidden" name="id" value="{$product->getId()}" />
                				<input type="hidden" name="product" value="{$product->product_type}" />
                                <input type="hidden" name="tag" value="{$product->product_tag}" />
                                <input type="hidden" name="image" value="{$image.image_id}" />
                                <input type="submit" name="delete" value="delete" />
                            </div>
                        </form>
                    </li>
                {/foreach}
            </ul>
        {else}
        no images
        {/if}
        
        
        <form method="post" action="{geturl action='images'}" enctype="multipart/form-data">
            <div>
                <input type="hidden" name="id" value="{$product->getId()}" />
                <input type="hidden" name="tag" value="{$product->product_tag}" />
                <input type="hidden" name="product" value="{$product->product_type}" />
                <input type="file" name="image" />
                <input type="submit" value="Upload Image" name="upload" />		
            </div>
        </form>
    </fieldset>
    
    {foreach from=$attributeArray item=attribute key=Key}
    <fieldset style="padding:20px;">
    <legend>{$attribute.attribute_name} image attribute options:</legend>
    <div id="imageAttributeCategory_{$Key}" class="imageAttributeDivContainer">
    	{foreach from=$imageAttribute item=imageAttributes key=ImageKey}
        {if $imageAttributes.attribute_name == $attribute.attribute_name}
        	<div id="imageAttributeCategoryElement_{$ImageKey}" class="imageAttributeDivContainerElement">
            <img src="/data/tmp/thumbnails/{$product->username}/{$product->product_type}/{$product->getId()}/ImageAttribute/{$attribute.attribute_name}/{$imageAttributes.image_attribute_id}.W80_{$attribute.attribute_name}Attribute_{$imageAttributes.image_name}.jpg" />
            <div class="imageAttributeElementName">{$imageAttributes.image_name}</div>
            <div class="imageAttributeElementPriceAdjustment">${$imageAttributes.price_adjustment}</div>
            <div class="imageAttributeElementDelete"><a href="{geturl controller='productlisting' action='addimageattributetoproduct'}?image={$imageAttributes.image_attribute_id}&id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}&delete=true"><img src="/htdocs/css/images/Crosses.png" /></a></div>
            </div>
    	{/if}
        {/foreach}
    </div>
    
        
        <form method="post" action="{geturl action='addimageattributetoproduct'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}" enctype="multipart/form-data">
            <div>
            	<input type="hidden" name="attribute_name" value="{$attribute.attribute_name}" />
                name of attribute: <input type="text" name="image_name"/>
                <input type="hidden" name="id" value="{$product->getId()}" />
                <input type="hidden" name="product" value="{$product->product_type}" />
                <input type="hidden" name="tag" value="{$product->product_tag}" />

                Price adjustment:<input type="text" name="price_adjustment" /><br />
                <input type="file" name="image" />
                <input type="submit" value="Add another {$attribute.attribute_name} option" name="upload" />		
            </div>
        </form>
        
    </fieldset>

    {/foreach}
    
    {foreach from=$measurementAttribute item=Measurement key=Key}
    	<fieldset style="padding:20px;">
        	<legend>{$Measurement.measurement_name} Measurement Attribute Option</legend>
        	
            
            <form method="post" action="{geturl action='addmeasurementtoproduct'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}&delete=true">
            Beginning Measurement: {$Measurement.beginning_measurement} cm &nbsp; &nbsp; &nbsp; &nbsp; 
			Ending Measurement: {$Measurement.ending_measurement} cm &nbsp; &nbsp; &nbsp; &nbsp;
            Increment Measurement: {$Measurement.incremental_measurement} cm &nbsp; &nbsp; &nbsp; &nbsp;
            Video youtube: {$Measurement.video_youtube}
            {if $Measurement.filename!=''}
            <img src="/data/tmp/thumbnails/{$product->username}/{$product->product_type}/{$product->getId()}/MeasurementImageAttribute/{$Measurement.measurement_name}/{$Measurement.measurement_attribute_id}.W80_{$Measurement.measurement_name}Attribute.jpg" height='20'/>
            {/if}
            <input type="hidden" name="measurement" value="{$Measurement.measurement_attribute_id}" />
            <input type="hidden" name="tag" value="{$product->product_tag}" />
            <input type="submit" name="delete" value="Delete" />
            </form>
        </fieldset>
    {/foreach}
    
    
    {foreach from=$sizeAttributeArray item=sizeAttributeArray key=Key}
    <fieldset style="padding:20px;">
    <legend>{$sizeAttributeArray.attribute_name} Size Attribute Options:</legend>
    <div id="sizeAttributeCategory_{$Key}" class="sizeAttributeDivContainer">
    	{foreach from=$sizeAttribute item=size key=SizeKey}
        {if $size.attribute_name == $sizeAttributeArray.attribute_name}
           
           <div style="float:left;"> {$size.size_name}</div> <div class="CrossImage"><a href="{geturl action='addsizeattributetoproduct'}?size={$size.size_attribute_id}&id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}&delete=true"><img src="/htdocs/css/images/Crosses.png" /></a></div>
            
    	{/if}
        {/foreach}
    </div>
    
        
        <form method="post" action="{geturl action='addsizeattributetoproduct'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}" enctype="multipart/form-data">
            <div>
            	<input type="hidden" name="attribute_name" value="{$sizeAttributeArray.attribute_name}" />
                name of option: <input type="text" name="size_name"/>
                <input type="hidden" name="id" value="{$product->getId()}" />
                <input type="hidden" name="product" value="{$product->product_type}" />
                <input type="hidden" name="tag" value="{$product->product_tag}" />
                Price adjustment:<input type="text" name="price_adjustment" /><br />
                <input type="submit" value="Add another {$sizeAttributeArray.attribute_name} option" name="upload" />		
                
            
            </div>
        </form>
        
    </fieldset>

    {/foreach}
    
    
	{include file='productlisting/form/image_attribute.tpl' product=$product}    
    
<!--    {include file='productlisting/form/measurement_attribute.tpl' product=$product}
    
    {include file='productlisting/form/size_attribute.tpl' product=$product}
    
    {include file='productlisting/form/supplimentaryProductTags.tpl' product=$product}
-->
{if $product->status =='DRAFT'}
	                    <a href="{geturl action='sendproductlive'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}"><img src="/htdocs/css/images/list.png" alt="list" title="list"/></a>
	                        {elseif $product->status =='LIVE'}
	                    <a href="{geturl action='sendproductdraft'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}"><img src="/htdocs/css/images/unlist.png" alt="unlist" title="unlist"/></a>
	                        {/if}
						{if $product->new =='1'}
	                        <a href="{geturl action='removeproductasnew'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}"><img src="/htdocs/css/images/remove_from_new.png" alt="remove new" title="remove new" /></a>
	                        {else}
	                        <a href="{geturl action='markproductasnew'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}"><img src="/htdocs/css/images/New_product.png" alt="add to new" title="add new" /></a>
	                        {/if}
	                        <a href="{geturl action='userproductlistingpreview'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}"><img src="/htdocs/css/images/details.png" alt="details" title="details"/></a>
	                    <a href="{geturl action='editproduct'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}"><img src="/htdocs/css/images/edit.png" alt="edit" title="edit"/></a>
	                     
	                        <a href="{geturl action='listingpreview'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}"><img src="/htdocs/css/images/inventory.gif" alt="preview" title="preview"/></a>
	                        <a href="#"><img src="/htdocs/css/images/facebook-icon.jpg" alt="preview" height="24" title="facebook"/></a>
	                        <a href="#"><img src="/htdocs/css/images/twittericon.png"  alt="twitter"height="24" title="twitter"/></a>
{include file='footer.tpl'}