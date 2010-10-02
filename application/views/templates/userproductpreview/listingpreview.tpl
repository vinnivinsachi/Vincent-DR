{include file='header.tpl' lightbox=true}
{include file='lib/leftColumnProductPreview.tpl product=$product}

<div id="rightContainer" style="width:75%;">
    <div id="productpreviewTitleBar">
        <div id="productName">
        {$product->name}
        </div>
    
        <div id="productActions">
            <a href="{geturl controller='productlisting' action='productlistingpreview'}?id={$product->getId()}&product={$product->product_type}">Back to product listing preview</a><br />
        </div>
	</div>
    
    <div id="productPreviewSecondLevelArea">
    
        <div id="productpreviewImageArea">
            {if $product->video_youtube !=''}
                <a href="#"><img src="www.youtube.com/img/{$product->video_youtube}" alt="{$product->name}" title="{$product->name}" /></a>
            {else}
                {assign var=image value=$product->images|@current}
                    <a href="#" >
                    <img src="/data/tmp/thumbnails/{$product->Username}/{$product->product_type}/{$image.image_id}.W150_homeFrontFour" alt="{$image.filename}" />
                            
                    </a>
            {/if}
        </div>
        
        <div id="productpreviewDescriptionArea">
        Description: {$product->profile->description}<br />
        Market price: <span class='productPrice'>${$product->price}</span><br />
        Our price:<span class='discountPrice'> ${$product->discount_price}</span><br />
        Reward point: +{$product->reward_point}<br />
        </div>
    
    </div>

	<fieldset id="preview-images">
        <legend>Addition Media</legend>
        
        {if $product->images|@count>0}
            <ul id="post_images">
                {foreach from=$product->images item=image}
                    <li>
                        <img src="/data/tmp/thumbnails/{$product->Username}/{$product->product_type}/{$image.image_id}.W150_homeFrontFour" alt="{$image.filename}" height="80" />
                        
                    </li>
                {/foreach}
            </ul>
        {else}
        no images
        {/if}
    </fieldset>
    
    <fieldset id="inventoryListings">
    	<legend>Available inventory items</legend>
        <table>
        	<tr>
            	<td>name:</td>
                <td>description:</td>
                <td>price:</td>
                <td>quantity:</td>
                <td>image:</td>
                <td>media:</td></tr>
        {foreach from=$inventoryItems item=inventoryProduct}
        		<tr>
                <td>{$inventoryProduct.inventory_name}<a href="{geturl controller='inventorymanager' action='removefrominventory'}?user={$product->Username}&id={$product->getId()}&product={$product->product_type}&inventory={$inventoryProduct.inventory_products_id}"><img src="/htdocs/css/images/delete.png" height="20" /></a></td>
                <td>{$inventoryProduct.description}</td>
                <td>${$inventoryProduct.price}</td>
                <td>{$inventoryProduct.quantity}</td>
                <td>{if $inventoryProduct.filename!=''}<img src="/data/tmp/thumbnails/{$product->Username}/{$product->product_type}/{$product->getId()}/InventoryProducts/{$inventoryProduct.inventory_products_id}.W80_Attribute.jpg" height='24'/>{/if}</td>
            	<td>{if $inventoryProduct.video!=''}yahoo video{/if}</td></tr>
           	<tr>
            	<td colspan="6" style="font-size:12px;">
				{foreach from=$inventoryProduct.profileAttributes item=productAttributes}
            	{$productAttributes.profile_key}: {$productAttributes.profile_value}
            {	/foreach}
        		</td>
                </tr>
        {/foreach}
        </table>
      	
    </fieldset>
    
    
    <form method="post" action="{geturl controller='inventorymanager' action='addproducttoinventory}" enctype="multipart/form-data">

    <fieldset id="productOrdering">
        <legend>Add to Inventory</legend>
        
        {foreach from=$attributeArray item=attribute key=Key}
        <fieldset>
        <legend>{$attribute.attribute_name} Options:</legend>
        <div id="imageAttributeCategory_{$Key}" class="imageAttributeDivContainer">
            {foreach from=$imageAttribute item=imageAttributes key=ImageKey}
            {if $imageAttributes.attribute_name == $attribute.attribute_name}

                <div id="imageAttributeCategoryElement_{$ImageKey}" class="imageAttributeDivContainerElement">
                <img src="/data/tmp/thumbnails/{$product->Username}/{$product->product_type}/{$product->getId()}/ImageAttribute/{$attribute.attribute_name}/{$imageAttributes.image_attribute_id}.W80_{$attribute.attribute_name}Attribute_{$imageAttributes.image_name}.jpg" />
                <div class="imageAttributeElementName">{$imageAttributes.image_name}</div>
                <div class="imageAttributeElementPriceAdjustment">${$imageAttributes.price_adjustment}</div>
                <input type="radio" name="{$attribute.attribute_name}" value="{$imageAttributes.image_name}"/>
                <input type="hidden" name="{$attribute.attribute_name}_{$imageAttributes.image_name}_price_adjustment" value="{$imageAttributes.price_adjustment}" />
                </div>
            {/if}
            {/foreach}
        </div>
            
        </fieldset>
    
        {/foreach}
        
        <fieldset>
         <legend>Measurement Options:</legend>
         	<table>
            	<tr>
                	<td>Name</td>
                    <td>Options</td>
                    <td>Video</td>
                    <td>Image</td>
                    <td>Description</td>
                </tr>
            {foreach from=$measurementAttribute item=Measurement key=Key}
            <tr><td>
              {$Measurement.measurement_name}:</td>
              <td> 
                <select name="{$Measurement.measurement_name}_measurement">
                    {section name=measurement start=$Measurement.beginning_measurement loop=$Measurement.ending_measurement step=$Measurement.incremental_measurement}
                     <option value="{$smarty.section.measurement.index}">{$smarty.section.measurement.index} cm</option>
                    {/section}
    
                </select>
               </td>
               <td>{$Measurement.video_youtube}</td>
               <td>
                    {if $Measurement.filename!=''}
                    <img src="/data/tmp/thumbnails/{$product->Username}/{$product->product_type}/{$product->getId()}/MeasurementImageAttribute/{$Measurement.measurement_name}/{$Measurement.measurement_attribute_id}.W80_{$Measurement.measurement_name}Attribute.jpg" height='20'/>
                    {/if}</td>
               <td>{$Measurement.description}</td>
                <input type="hidden" name="{$Measurement.measurement_name}_price_adjustment" value="{$Measurement.price_adjustment}" />
            </tr>
            {/foreach}
            </table>
            
        </fieldset>

        
        {foreach from=$sizeAttributeArray item=sizeAttributeArray key=Key}
        <fieldset>
        <legend>{$sizeAttributeArray.attribute_name} Options:</legend>
        <div id="sizeAttributeCategory_{$Key}" class="sizeAttributeDivContainer">
            {foreach from=$sizeAttribute item=size key=SizeKey}
            {if $size.attribute_name == $sizeAttributeArray.attribute_name}
                <div id="SizeAttributeCategoryElement_{$ImageKey}" class="imageAttributeDivContainerElement">

            	<div style="float:left;"> {$size.size_name}</div> 
                <input type="radio" name="{$sizeAttributeArray.attribute_name}" value="{$size.size_name}" />
                <input type="hidden" name="{$sizeAttributeArray.attribute_name}_{$size.size_name}_price_adjustment" value="{$size.price_adjustment}" />
                </div>
            {/if}
            {/foreach}
        </div>
        </fieldset>
        {/foreach}
     <fieldset>
            <legend>Inventory Options:</legend>
            Name: <input type="text" name="inventory_name" value="" />
            Quantity: <input type="text" name="inventory_quantity" value="1" />
            Price: <input type="text" name="inventory_price" value="" /><br />
            video:<input type="text" name="inventory_video" />
            Description:<input type="text" name="inventory_description" />
            Image:<input type="file" name="image" />
            <input type="hidden" name='product' value="{$product->product_type}" />
            <input type="hidden" name='id' value="{$product->getId()}" />
            <input type="hidden" name='User_id' value="{$product->User_id}" />
            <input type="hidden" name="Username" value="{$product->Username}" /> 
            <input type="submit" name="add" value="Add to inventory" />
        </fieldset>
        </fieldset>
    </form>
</div>
{include file='footer.tpl'}