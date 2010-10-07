{include file='header.tpl' lightdox=true}
{include file='lib/leftColumnIndex.tpl'}
<div id="rightContainer" style='width:790px; float:left;'>
        		{include file='lib/productTagHeader.tpl' currentPage='userProductPreview'}
	<div id="productLeftColumn">
		<div id='productTagBody'>
			<div class="productBox" style="width:290px; float:left;">
            	<div class="productName">
                	<span style="font-size:14px;">{$product->name}</span>
            	</div> 
                <div class="productDetails" style="background-color:transparent;">
                    <div class="productMedia">
                        <div class="productImages">
                            {foreach from=$product->images item=image}
                                <div class="productIndividualImage">
                                <img src="/data/tmp/thumbnails/{$product->Username}/generalSeller/{$product->product_type}/{$image.image_id}.W30_productSmallPreview.jpg" height="20"/>
                                <span class="imageLargeAddress" style="display:none">
                                <img src="/data/tmp/thumbnails/{$product->Username}/generalSeller/{$product->product_type}/{$image.image_id}.W300_productDetailImage.jpg" width="290" /></span>											</div>
                            {/foreach}
                        </div>
                        <div class="productVideo">
                            {if $product->video_youtube!=''}
                                <img src="/htdocs/css/images/video_flat.png" width=37/>
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="productFirstImage">
                	{assign var=firstImage value=$product->images|@current}
                	<img src="/data/tmp/thumbnails/{$product->Username}/generalSeller/{$product->product_type}/{$firstImage.image_id}.W300_productDetailImage.jpg" width="290"/>
                </div>
                
            </div>
       </div>
      </div>
      <div id="productRightColumn">
            <div class="productDetailRightSidePanel">
            	<div class="productDetailRightTitle">
                	<span style="font-size:14px;">Product Details [User: <span style="color:#F90;">{$product->Username}</span>]</span>
                    <a style="float:right; margin-top:-2px;"><img src="/htdocs/css/images/detailsIcon.png" width="17"/></a>
                </div>
                <div class="productDetailRightTop">
                	<div class="productDetailRightDescription">
                	{$product->profile->description}
                        <div class="productDetailRightReward">
                            Reward point for future purchases:<br />
                     +{$product->reward_point} points! ( 4 Reward point = $1)
                        </div>
                    </div>

                    <div class="productColorAttributeIndividualImage">

                    </div>
                </div>
                
                <div class="productDetailsRightAttributeSelection">
                    
                 	
                    {literal}
                        <script src="/htdocs/javascripts/productAttributeSelector/attributeSelector.js" type="text/javascript"></script>
                    {/literal}
                    
                   
                  <div class="messageFormMainDiv">
                   User: 
                    <span style="color:#F90;">{$product->Username}</span>
                    <a class="sendPrivateMessage" style="margin-left:130px; cursor:pointer; color:#F90;">Send private message</a><br />
                    <div class="productPrivateMessageForm" style="float:left; width:100%; display:none;">
                        <form action="{geturl controller='communication' action='privatemessage'}" method="post" id="privateMessage-form">
                        <label>Current time:</label>
                        <span style="float:left; width:40%;">2010-03-31 9:43 PM</span>
                        <div>
                        <label>Name: </label>
                        {if $authenticated}
                        <input name="sender_name" type="text" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
                        {else}
                        <input name="sender_name" type="text" />
                        {/if}
                        {include file='lib/error.tpl' error=''}
                        </div>
                        <div>
                        <label>Contact email (not displayed):</label>
                        {if $authenticated}
                        <input name="sender_email" type="text" value="{$signedInUser->generalInfo->email}" readonly="readonly"/>
                        {else}
                        <input name="sender_email" type="text" />
                        {/if} 
                        {include file='lib/error.tpl' error=''}
                        </div>
                        <div>
                        <label>Subject:</label>
                        <input name="sender_subject" type="text" />
                        {include file='lib/error.tpl' error=''}
                        </div>
                        <div>
                        <label>Message:</label>
                        <textarea name="sender_message"></textarea>
                        {include file='lib/error.tpl' error=''}
                        </div>
                        <input type="hidden" name="receiver_email" value="{$productSellerEmail}" />
                        <input type="hidden" name="receiver_name" value="{$product->Username}"/>
                        <input type="hidden" name="product_id" value="{$product->getId()}"/>
                        <input type="hidden" name="product_category" value="{$product->product_type}"/>
                        <input type="hidden" name="product_type" value="generalSeller"/>
                        <input type="hidden" name="receiver_User_id" value="{$product->User_id}"/>
                        <input type="hidden" name="receiver_Username" value="{$product->Username}"/>
                        <input type="hidden" name="product_name" value="{$product->url}" />
                        <input type="hidden" name="product_tag" value="{$tag}"/>
                        <input type="hidden" name="product_image_id" value="{$firstImage.image_id}"/>
                        {if $authenticated}
                        <input type="hidden" name="sender_user_id" value="{$signedInUser->generalInfo->user_id}" />
                        <input type="hidden" name="sender_username" value="{$signedInUser->generalInfo->username}" />
                        {/if}
                        
                        <input type="submit" name="sendPrivateMessage" class="submitInputButton" style="margin-left:200px; float:left;"value="Send message"/>
                        </form>
                        
                    </div>
                  </div>
                    
                   
                    <div id="{$product->product_type}_selection">
                    
                    	<div class="dividerLine"></div>
            
                         Please select all the measurements.

                                
                    {foreach from=$attributeArray item=attribute key=Key}
                            
                       {if $Key=='color'}
                             <div id="{$product->product_type}-colorSelection" class="colorSelection">
                              <span class='productDetailAttributeSelectionTitle'>Color</span>
                                <ul>
                                    <li>{$product->color}</li>
                                </ul>
                            </div>
                       {/if}          
                    {/foreach}
                           
                    {foreach from=$productType item=attribute key=AttributeKey}
                        {if $AttributeKey=='measurement'}
                            <div id="measurementSelection">
                                    {foreach from=$attribute item=detailAttribute key=measurementKey}
                                        <div id='{$product->product_type}-{$measurementKey}' class="measurementAttribute" style="width:100px; float:left;">
                                        <span class='productDetailAttributeSelectionTitle'>{$measurementKey}</span>

                                            <ul>
                                            	
                                                
                                                <li id="{$product->product_type}-{$measurementKey}-{$product->$measurementKey}">{$product->$measurementKey}</li>
                                               
                                            </ul>
                                        </div>
                                    {/foreach}
                            </div>
                       
                       
                        {/if}
                    {/foreach}
                    <div class="priceDetailRightPriceBlock">
                    	<div class="priceBlock">
                            {if $product->discount_price=='' || $product->discount_price==0}
                                <div class="discountBoxPrice">
                                    ${$product->price}
                                </div>
                            {elseif $product->discount_price>0}
                                <div class="productBoxPrice">
                                    ${$product->price}
                                </div>
                                
                                <div class="discountBoxPrice">
                                    ${$product->discount_price}
                                </div>
                            {/if}
                        </div>
						
                            
                            	<input type="submit" class='addToCart' disabled="disabled" value="Add to cart" style="float:right; text-align:right;"/>
                         
                    </div>
                 </div>
                    <div id="productAjaxInfoItems" style="display:none;">
                     	<div id="product_id_ajax" style="display:none;">{$product->getId()}</div>
                    	<div id="product_tag_ajax" style="display:none;">{$tag}</div>
                        <div id="product_name_ajax" style="display:none;">{$product->name}</div>
                        <div id="product_price_ajax" style="display:none;">{$product->price}</div>
                        <div id="product_discount_price_ajax" style="display:none;">{$product->discount_price}</div>
                        <div id="product_Username_ajax" style="display:none;">{$product->Username}</div>
                        <div id="product_UserId_ajax" style="display:none;">{$product->User_id}</div>
                        <div id="product_type_ajax" style="display:none;">{$product->product_type}</div>
                    	<div id="product_market_ajax" style="display:none;">generalSeller</div>
                        <div id="product_reward_points_ajax" style="display:none">{$product->reward_point}</div>
                        <div id="product_shipping_ajax" style="display:none">{$product->shipping_rate}</div>
                        <div id="product_backorder_time_ajax" style="display:none"></div>
                        <div id="product_image_id_ajax" style="display:none;">{$firstImage.image_id}</div>
                        <div id="product_user_name_ajax" style="display:none;">{$product->Username}</div>
                    </div>
                     {literal}
                        
                        <script type="text/javascript">
                            new MeasurementAttribute('{/literal}{$product->product_type}{literal}_selection');
                        </script>
                    
                    {/literal} 
  				</div>
            </div>
            
            {include file='lib/products/productUserReviews.tpl'}
            <div class="productDetailRightSidePanel">
            	<div class="productDetailRightTitle">
                	<span style="font-size:14px;">Public Shout Box [User: <span style="color:#F90;">{$product->Username}</span>]</span>
                    <a style="float:right; margin-top:-2px;"><img src="/htdocs/css/images/shoutboxFlattened.png" width="25"/></a>
                </div>
                <div id="productShoutBoxMainDiv" style="height:200px; overflow-y:scroll;">
                	{foreach from=$shoutboxMessages item=shoutmessage}
                	<div class="publicProductShoutOutMessage">
                    	<div class="publicProductShoutOutMessageName">
							{$shoutmessage.shoutout_name}
                        </div>
                        <div class="publicProductShoutOutMessageContent">
                        	{$shoutmessage.shoutout_message}

                        </div>
                        <div class="publicProductShoutOutMessageTime">
                        	{$shoutmessage.ts_created|date_format:"%D, %I:%M %p"}
                        </div>
                    </div>
                    {/foreach}
                	
  				</div>
                
                <div id="productPublicShoutBoxForm">
                
					<form action="{geturl controller='Communication' action='postshoutout'}" method="post" id="shoutbox-form">
                	<label>Current time:</label>
                   	<span style="float:left; width:40%;">2010-03-31 9:43 PM</span>
                    <div>
                	<label>Name: </label>
 					{if $authenticated}
                    <input name="shoutout_name" type="text" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
                    {else}
                    <input name="shoutout_name" type="text" />
                    {/if}
                    {include file='lib/error.tpl' error=''}
					</div>
                    <div>
                    <label>Contact email (not displayed):</label>
					{if $authenticated}
                    <input name="shoutout_email" type="text" value="{$signedInUser->generalInfo->email}" readonly="readonly"/>
                    {else}
                    <input name="shoutout_email" type="text" />
                    {/if} 
                    {include file='lib/error.tpl' error=''}
                    </div>
                    <div>
					<label>Message:</label>
                    <textarea name="shoutout_message"></textarea>
                    {include file='lib/error.tpl' error=''}
					</div>
                    <input type="hidden" name="product_id" value="{$product->getId()}"/>
                    <input type="hidden" name="product_category" value="{$product->product_type}"/>
                    <input type="hidden" name="product_type" value="generalSeller"/>
                    <input type="hidden" name="User_id" value="{$product->User_id}"/>
                    <input type="hidden" name="Username" value="{$product->Username}"/>
                    <input type="hidden" name="product_name" value="{$product->url}" />
                    <input type="hidden" name="product_tag" value="{$tag}"/>
                    <input type="hidden" name="product_image_id" value="{$firstImage.image_id}"/>
                    {if $authenticated}
                    <input type="hidden" name="shoutout_user_id" value="{$signedInUser->generalInfo->user_id}" />
                    <input type="hidden" name="shoutout_username" value="{$signedInUser->generalInfo->username}" />
                    {/if}
                    
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:200px; float:left;"value="Shout!"/>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

{literal}


<script type="text/javascript">
new productPreviewImage('productTagBody');

new formEnhancer('shoutbox-form');
new formEnhancer('privateMessage-form');

new toggleClass('productRightColumn', 'productPrivateMessageForm', 'sendPrivateMessage', 'messageFormMainDiv');

</script>
{/literal}


{include file='footer.tpl'}