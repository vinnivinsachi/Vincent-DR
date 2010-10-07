<div id='page' class='box'>
<div id='productDetailLeftColumn' class='box' style='padding-left:5px; width:320px;'>
 	<div class="productBox2 box marginTop20" style="width:320px; height:100%;">
						<table>
		         		<tr style='height:350px; '><td style='padding:0px; margin:0px; width:320px;'>
		         		<div class="productFirstImage">
		                	<div class="productDescription">
		                       
		                    </div>
		                	{if $product.images|@count>0}
		                	<img src="/public/resources/userdata/tmp/thumbnails/{$product.0.uploader_username}/{$product.0.product_tag}/{$product.images[0].image_id}.W300_productDetailImage.jpg"/>
		                	{else}
		                        No image
		                    {/if}
		                </div>
		         		
		         		</td></tr>
		                
		               </table>
		                <div class="productDetails box">
	                    <div class="productMedia">
	                        <div class="productImages">
	                            {foreach from=$product.images item=image}
	                                <div class="productIndividualImage">
	                                <img src="/public/resources/userdata/tmp/thumbnails/{$product.0.uploader_username}/{$product.0.product_tag}/{$image.image_id}.W50_productSmallPreview.jpg" />
	                                <span class="imageLargeAddress" style="display:none">
	                                <img src="/public/resources/userdata/tmp/thumbnails/{$product.0.uploader_username}/{$product.0.product_tag}/{$image.image_id}.W300_productDetailImage.jpg""/></span>					
	                                </div>
	                            {/foreach}
	                            {foreach from=$product.inventoryImages item=inventoryImage}
	                            	<div class="productIndividualImage">
	                                <img src="/public/resources/userdata/tmp/thumbnails/{$product.0.uploader_username}/inventory/{$inventoryImage.image_id}.W50_productSmallPreview.jpg" />
	                                <span class="imageLargeAddress" style="display:none">
	                                <img src="/public/resources/userdata/tmp/thumbnails/{$product.0.uploader_username}/inventory/{$inventoryImage.image_id}.W300_productDetailImage.jpg""/></span>					
	                                </div>
	                            {/foreach}
	                        </div>
	                    </div>
						</div>
						
	</div>
	<div class='box marginTop20'>
		<div class='titleBarMid'>
			<a id='shippingInfoAnchor' class='currentTab tabSelections' style='float:left; padding:4px;'>Shipping</a> <a id='returnsAndServiceFeeAnchor' class='tabSelections' style='float:left; padding:4px; margin-left:5px;'>Returns and service fee</a>
		</div>
		<div class='box' style='width:310px; padding-left:10px;'>
			<div id='shippingInfo'>
			<div class='box' style='padding-top:10px;'>
			 <label>Domestic shipping:</label>
			 ${$product.0.domestic_shipping_rate}
			</div>
			<div class='box' style='padding-top:10px;'>
			 <label>International shipping:</label>
			 ${$product.0.international_shipping_rate}
			</div></div>
			<div id='returnsAndServiceFee'></div>
		</div>
	</div>
</div>
<div id="productDetailRightSidePanel" class='box' style='float:right; width: 410px; padding-right:10px;'>
	<div class='box marginTop20' style='width:405px;'>	<div class='titleBarBig'>{$product.0.name}<span style='float:right;'>{$product.0.product_tag}</span></div>
	</div>
	<div class='productDetailTop box'>
	<div class='titleBarMid'>Description </div>
	Seller: {$product.0.uploader_username}<br/>
	<div class='box' style='padding:10px; width:390px;'>{$product.profile.0.profile_value}</div>
	</div>
    <div class="productProfiles box marginTop20" style='text-align: left; width:100%;'>
    	<form method='post' action="{geturl controller='shoppingcart' action='additemtoshoppingcart'}">
    	<input type='hidden' name='attribute[brand]' value='{$product.0.brand}'/>
    	
        {assign var='orderAttribute' value=$product.0.inventory_attribute_table}
		{include file="productdisplay/_productCustomizableAttribute/_$orderAttribute.tpl" product=$product}
		                 
	 	<div class='quickOrderActions' style='float:left; width:100%;'>
	  		<input type='submit' style='float:left; padding:10px;' value='Add to cart'/>
	 	</div>
	 	<input type='hidden' name='product' value='Customize'/>
	 	<input type='hidden' name='id' value='{$product.0.product_id}'/>
  		</form>
    </div>
    
    
    <div class="box marginTop20">
    	<div class='titleBarMid' style='margin-bottom:0px;'>
    	<a id='askAndAnswerAnchor' class='currentTab tabSelections' style='float:left; padding:4px;' onclick="$('sendAPrivateMessage').hide(); $('sendAPrivateMessageAnchor').removeClassName('currentTab'); $('askAndAnswer').show(); $('askAndAnswerAnchor').addClassName('currentTab');" >Ask and Answer</a><a id='sendAPrivateMessageAnchor' class='tabSelections' style='float:left; padding:4px; margin-left:5px;' onclick="$('askAndAnswer').hide(); $('askAndAnswerAnchor').removeClassName('currentTab'); $('sendAPrivateMessage').show(); $('sendAPrivateMessageAnchor').addClassName('currentTab'); ">Send a message</a>
    	</div>
    	
    	<div class='box'>
			<div id='askAndAnswer' class='box'>
				<div id='askAndAnswerForm' class='box' style='background-color:#eee; padding:10px; width:390px;'>
					<form action="{geturl controller='communication' action='postshoutout'}" method="post" id="shoutbox-form">
					<div class='box'>
                	<label>Date:</label>
                   	<span style="float:left; width:40%;">{$smarty.now|date_format:"%m/%d/%Y"}</span>
                   	</div>
                    <div class='marginTop10 box'>
                	<label>Name: </label>
                    {if $authenticated}
                    <input name="shoutout_name" type="text" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
                    {else}
                    <input name="shoutout_name" type="text" />
                    {/if}
                    {include file='partials/error.tpl' error=''}
					</div>
                    <div class=' box'>
                    <label>Contact email (not displayed):</label>
					{if $authenticated}
                    <input name="shoutout_email" type="text" value="{$signedInUser->generalInfo->email}" readonly="readonly" />
                    {else}
                    <input name="shoutout_email" type="text" />
                    {/if}                    
                    {include file='partials/error.tpl' error=''}
                    </div>
                    <div class=' box'>
					<label style='width:199px;' title="Please do not post personal information, such as phone numbers and addresses here. Use 'Send a message' instead.">Message:</label>
                    <textarea name="shoutout_message"></textarea>
                    {include file='partials/error.tpl' error=''}
					</div>
					<input type="hidden" name="product_id" value="{$product.0.product_id}"/>
					<input type='hidden' name='uploader_id' value="{$product.0.uploader_id}"/>
					
					
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:200px; float:left;"value="Ask!"/>
                    </form>
				</div>
				<div id='askAndAnswerContent'>
					{foreach from=$shoutboxMessages item=shoutboxMessage}
						<div class='askAndAnswerPost'>
							<div class='askAndAnswerName'>
							{$shoutboxMessage.shoutout_name}
							</div>
							<div class='askAndAnswerTime'>
							{$shoutboxMessage.ts_created|date_format:"%m/%d/%Y"}
							</div>
							<div class='askAndAnswerContent'>	
							{$shoutboxMessage.shoutout_message}
							</div>
						</div>
					{/foreach}
				</div>
			
			</div>
			<div id='sendAPrivateMessage' style='display:none'>
				<div id='sendAPrivateMessageForm' class='box' style='background-color:#eee; padding:10px; width:390px;'>
					<form action="{geturl controller='communication' action='privatemessage'}" method="post" id="privateMessage-form">
						<div class='box'>
                        <label>Date:</label>
                        <span style="float:left; width:40%;">2010-03-31 9:43 PM</span>
                        </div>
                        <div class='marginTop10 box'>
                        <label>Name: </label>
                        {if $authenticated}
                        <input name="sender_name" type="text" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
                        {else}
                        <input name="sender_name" type="text" />
                        {/if}
                        {include file='partials/error.tpl' error=''}
                        </div>
                        <div class='box'>
                        <label>Contact email (not displayed):</label>
                        {if $authenticated}
                        <input name="sender_email" type="text" value="{$signedInUser->generalInfo->email}" readonly="readonly"/>
                        {else}
                        <input name="sender_email" type="text" />
                        {/if} 
                        {include file='partials/error.tpl' error=''}
                        </div>
                        <div class='box'>
                        <label>Subject:</label>
                        <input name="sender_subject" type="text" />
                        {include file='partials/error.tpl' error=''}
                        </div>
                        <div class='box'>
                        <label style='width:199px;'>Message:</label>
                        <textarea name="sender_message"></textarea>
                        {include file='partials/error.tpl' error=''}
                        </div>
                        
                        <input type='hidden' name='receiver_User_id' value='{$product.0.uploader_id}'/>
                        <input type='hidden' name='receiver_Username' value='{$product.0.uploader_username}'/>
                        <input type='hidden' name='product_id' value='{$product.0.product_id}'/>
                        <input type='hidden' name='receiver_name' value='{$product.0.first_name} {$product.0.last_name}'/>
                       	<input type="submit" name="sendPrivateMessage" class="submitInputButton" style="margin-left:200px; float:left;"value="Send message"/>
                    </form>
				</div>
			
			</div>
    	</div>
    	
	</div>
    
    </div>
    
   
    
</div>    

{literal}
<script type="text/javascript">
new productPreviewImage('productDetailLeftColumn');
new formEnhancerShoutoutMessage('shoutbox-form');
new formEnhancerPrivateMessage('privateMessage-form');
</script>
{/literal}