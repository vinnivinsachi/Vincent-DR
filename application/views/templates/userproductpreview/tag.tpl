{include file='header.tpl' lightdox=true}
	{include file='lib/leftColumnIndex.tpl'}
    
    <div id="rightContainer" style="width:788px; float:left;">
		{include file='lib/productTagHeader.tpl' currentPage='userProductPreview'}
        
        <div id="productTagSecondHeader">
        <fieldset style="float:left; width:738px; margin-left:15px;">
        	<legend>Search by measurements</legend>
            <div style="padding:">
                Brand:<select id="productTagBrand"><option value="All">All</option>
                {foreach from=$brandCategories item=categories}
                    {foreach from=$categories item=detailCategories}
                    <option value="{$detailCategories}">{$detailCategories}</option>
                    {/foreach}
                {/foreach}</select>
                
                Price:<select id="productTagPrice"><option value="All">All</option>
                {foreach from=$priceCategories item=categories}
                    {foreach from=$categories item=detailCategories}
                    <option value="{$detailCategories}">{$GLOBALproductPriceRange.$detailCategories}</option>
                    {/foreach}
                {/foreach}</select>
                
                City: <select id="productTagCity"><option value="All">All</option>
                {foreach from=$cityCategories item=cityCategories}
                    {foreach from=$cityCategories item=detailCityCategories}
                    <option value="{$detailCityCategories}">{$detailCityCategories}</option>
                    {/foreach}
                {/foreach}
                </select>
            </div>
            <div id="productpreviewAttributeSelection">
            Available measurements: 
            {foreach from=$productTagTypeAttribute.$tag item=attributes key=TagAttributeKeys}
            	 <ul id="{$attributes}-productPreviewAttribute" class="productPreviewTagAttribute">{$attributes}:
                	
                    {foreach from=$productAttributeOverview.$attributes item=attributeCategories key=attributeCategoriesKey}
                    	{foreach from=$attributeCategories item=detailsAttributeCategories}
                    	<li id="{$attributes}-{$detailsAttributeCategories}" class="productAttribute {if $TagAttributeKeys==0}productAttributeAvailable{/if}">{$detailsAttributeCategories}</li>  
                        {/foreach}       	
                    {/foreach}
				</ul>
            {/foreach}
            
            <button id="showAllProductButton" style="float:left; width:20%; height:38px;">Show All</button>
<!--            <button id="matchingMineButton" style="float:left; width:20%; height:38px;">My matching products</button>
-->            	
            </div>
            
            
        </fieldset>
        </div>
        
        
        <div id="productTagBody"><!--productTagBody is meant for products gathered by tags-->
        	{foreach from=$products item=product}
        	<div class="productBox {$product.brand} {$product.user_city} {$product.product_price_range} {foreach from=$productTypeConfig[$product.product_type] item=attribute key=Key}
                        	{foreach from=$attribute item=details key=detailsKey}
                            	{$detailsKey}-{$product.$detailsKey}
                            {/foreach}
                        {/foreach} ">
            	<div class="productName">
                	<a href="{geturl controller='userproductpreview' action='details'}?id={$product.products_id}&tag={$tag}" style="color:#FC0">{$product.name}</a>
            	</div>
                <div class="productSeller">
                	<a href="#" style="color:#FC0;">{$product.Username}</a> /<!-- <a href="{geturl controller='userproductpreview' action='tag'}?tag={$tag}&network={$product.user_network}" style="color:#FC0;">{$product.user_network}</a>/--> <a href="{geturl controller='userproductpreview' action='tag'}?tag={$tag}&city={$product.user_city}" style="color:#FC0;">{$product.user_city}</a>
                </div>
                <div class="productFirstImage" style="width:200px; text-align:center; height:200px;">
                	<div class="productStatistics">
                    	{foreach from=$productTypeConfig[$product.product_type] item=attribute key=Key}
                        	{foreach from=$attribute item=details key=detailsKey}
                            	{$detailsKey}: {$product.$detailsKey}
                            {/foreach}
                        {/foreach}
						
                    </div>
                    <div class="productDescription" style="margin-top:28px;">
                        {foreach from=$product.profile item=profile}
                            {if $profile.profile_key=='description'}
                            {$profile.profile_value}
                            {/if}
                        {/foreach}
                    </div>
                
                	<a href="{geturl controller='userproductpreview' action='details'}?id={$product.products_id}&tag={$tag}">
                	<img src="/data/tmp/thumbnails/{$product.Username}/generalSeller/{$product.product_type}/{$product.images[0].image_id}.W200_productFirstImage.jpg" /></a>
                </div>
                <div class="productDetails">
                    <div class="productMedia">
                        <div class="productImages">
                            {foreach from=$product.images item=image}
                                <div class="productIndividualImage">
                                <img src="/data/tmp/thumbnails/{$product.Username}/generalSeller/{$product.product_type}/{$image.image_id}.W30_productSmallPreview.jpg" height="20"/>
                                <span class="imageLargeAddress" style="display:none">
                                <div class="productStatistics">
                                  {foreach from=$productTypeConfig[$product.product_type] item=attribute key=Key}
                                        {foreach from=$attribute item=details key=detailsKey}
                                            {$detailsKey}: {$product.$detailsKey}
                                        {/foreach}
                                    {/foreach}
                                
                                </div>
                                <div class="productDescription" style="margin-top:28px;">
                                    {foreach from=$product.profile item=profile}
                                        {if $profile.profile_key=='description'}
                                        {$profile.profile_value}
                                        {/if}
                                    {/foreach}
                                </div>
                    			<a href="{geturl controller='userproductpreview' action='details'}?id={$product.products_id}&tag={$tag}">
                                <img src="/data/tmp/thumbnails/{$product.Username}/generalSeller/{$product.product_type}/{$image.image_id}.W200_productFirstImage.jpg" /></a>
                                </span>					
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
                    	{if $product.discount_price==''}
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

<script src="/htdocs/javascripts/infoAttributeRetriver.js" type="text/javascript"></script>

<script type="text/javascript">
new productPreviewImage('productTagBody');

new infoAttributeRetriver('productTagSecondHeader', '{/literal}{$tag}{literal}');
</script>
{/literal}
{include file='footer.tpl'}