{include file='header.tpl' lightdox=true}
	{include file='lib/leftColumnIndex.tpl'}
    <div id="rightContainer" style="width:788px; float:left;">
		{include file='lib/productTagHeader.tpl' currentPage='productPreview'}
        
        <div id="productTagSecondHeader">
        	Brand:<select name="brand"><option value="">All</option></select>
        </div>
        
        
        <div id="productTagBody"><!--productTagBody is meant for products gathered by tags-->
        	{foreach from=$products item=product}
        	<div class="productBox" style="width:191px;">
            	<div class="productName">
                	<a href="{geturl controller='productpreview' action='details'}?id={$product.products_id}&tag={$tag}" style="color:#FC0;">{$product.name}</a>
            	</div>
                <div class="productFirstImage">
                	<div class="productDescription">
                        {foreach from=$product.profile item=profile}
                            {if $profile.profile_key=='description'}
                            {$profile.profile_value}
                            {/if}
                        {/foreach}
                    </div>
                	<a href="{geturl controller='productpreview' action='details'}?id={$product.products_id}&tag={$tag}">
                	<img src="/data/tmp/thumbnails/{$product.Username}/storeSeller/{$product.product_type}/{$product.images[0].image_id}.W200_productFirstImage.jpg" width="191px;"/></a>
                </div>
                <div class="productDetails">
                    <div class="productMedia">
                        <div class="productImages">
                            {foreach from=$product.images item=image}
                                <div class="productIndividualImage">
                                <img src="/data/tmp/thumbnails/{$product.Username}/storeSeller/{$product.product_type}/{$image.image_id}.W30_productSmallPreview.jpg" height="20" />
                                <span class="imageLargeAddress" style="display:none"><a href="{geturl controller='productpreview' action='details'}?id={$product.products_id}&tag={$tag}">
                                <img src="/data/tmp/thumbnails/{$product.Username}/storeSeller/{$product.product_type}/{$image.image_id}.W200_productFirstImage.jpg" width='191px;'/></a></span>					
                                </div>
                            {/foreach}
                        </div>
                        <div class="productVideo">
                            {if $product.video_youtube!=''}
                                <img src="/htdocs/css/images/video_flat.png" width=37/>
                            {/if}
                        </div>
                    </div>
                    
                    <div class="priceBlock">
                       {if $product.discount_price=='' || $product.discount_price==0}
                                <div class="discountBoxPrice">
                                    ${$product.price}
                                </div>
                                {elseif $product.discount_price>0}
                                <div class="productBoxPrice">
                                    ${$product.price}
                                </div>

                                <div class="discountBoxPrice">
                                    ${$product.discount_price}
                                </div>
                        {/if}
                    </div>
                    <div class="quickLook">
                        <button id="quickLook">Quick Look</button>
                    </div>	
                </div>
            </div>
            {/foreach}
        </div>
    </div>

{literal}
<script src="/htdocs/javascripts/productPreview/productImagePreviews.js" type="text/javascript"></script>

<script type="text/javascript">
new productPreviewImage('productTagBody');
</script>
{/literal}
{include file='footer.tpl'}