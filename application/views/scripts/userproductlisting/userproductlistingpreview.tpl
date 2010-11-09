{include file='header.tpl' lightbox=true}
<br />
<br />
<br />

id: {$product->getId()}<br />
type: {$product->product_type}<br />
name: {$product->name}<br />
price: {$product->price}<br />
brand: {$product->brand}<br />
reward point: {$product->reward_point}<br />
video youtube: {$product->video_youtube}<br />

Description: {$product->profile->description}<br />

{foreach from=$specificProductMeasurementAttribute item=detailAttribute key=Key}
	{foreach from=$detailAttribute item=detail key=attributeKey}
    	{$attributeKey}: {$product->$attributeKey}<br />
    {/foreach}
{/foreach}

<a href="{geturl action='editproduct'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}">Edit</a>
<a href="{geturl action='listingpreview'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}">Preview this listing</a>
	<fieldset id="preview-images" style="padding:20px;">
        <legend>General Product Images</legend>
        
        {if $product->images|@count>0}
            <ul id="post_images">
                {foreach from=$product->images item=image}
                    <li >
                        <img src="/data/tmp/thumbnails/{$signedInUser->generalInfo->username}/generalSeller/{$product->product_type}/{$image.image_id}.W150_homeFrontFour.jpg" alt="{$image.filename}" />
                        
                        <form method="post" action="{geturl action='images'}">
                            <div>
                                <input type="hidden" name="id" value="{$product->getId()}" />
                				<input type="hidden" name="product" value="{$product->product_type}" />
                                <input type="hidden" name="image" value="{$image.image_id}" />
                                <input type="hidden" name="tag" value="{$product->product_tag}" />
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
                <input type="hidden" name="product" value="{$product->product_type}" />
                <input type="hidden" name="tag" value="{$product->product_tag}" />
                <input type="file" name="image" />
                <input type="submit" value="Upload Image" name="upload" />		
            </div>
        </form>
    </fieldset>
    
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
                    	<a href="{geturl action='editproduct'}?id={$product->getId()}&product={$product->product_type}"><img src="/htdocs/css/images/edit.png" alt="edit" title="edit"/></a>
                     
                        <a href="{geturl action='listingpreview'}?id={$product->getId()}&product={$product->product_type}&tag={$product->product_tag}"><img src="/htdocs/css/images/inventory.gif" alt="preview" title="preview"/></a>
                        <a href="#"><img src="/htdocs/css/images/facebook-icon.jpg" alt="preview" height="24" title="facebook"/></a>
                        <a href="#"><img src="/htdocs/css/images/twittericon.png"  alt="twitter"height="24" title="twitter"/></a>

{include file='footer.tpl'}