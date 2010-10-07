	<div id="accountInboxMessage" style="float:left; overflow-y:scroll; max-height:800px; width:100%;">
        {foreach from=$inboxMessages item=shoutmessage}
            <div class="PrivateMessage" style="float:left; width:98%;">
            	<div class="leftColumnShoutOut" style="width:20%; float:left;">
                	<div class="publicProductName" >
                    {if $shoutmessage.product_type_seller=='generalSeller'}

                    <a href="{geturl controller='userproductpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$shoutmessage.product_name}</a>
                    {else}
                    <a href="{geturl controller='productpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$shoutmessage.product_name}</a>
                    
                    {/if}
                    	
                    </div>
                    <!--<div class="publicProductType">
                    	{$shoutmessage.product_category}
                    </div>-->
                </div>
                <div class="rightColumnShoutOut" style="width:75%; float:left;">
                    <div class="publicProductShoutOutMessageName" >
                        {$shoutmessage.sender_name} to you
                    </div>
                    <div class="privateMessageSubject">
                    	<span style="font-style:italic;">{$shoutmessage.sender_subject}</span>
                    </div>
                    <div class="publicProductShoutOutMessageContent" >
                       {$shoutmessage.sender_message}
        
                    </div>
                    <div class="publicProductShoutOutMessageTime" >
                        {$shoutmessage.ts_created|date_format:"%D, %I:%M %p"}
                    </div>
                </div>
                <div style="float:right;">
                	<a class="accountDetailShoutOutFromRespond">Respond</a>
                    {if $shoutmessage.product_type_seller=='generalSeller'}
                	<a href="{geturl controller='userproductpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">View Product</a>
                    {else $shoutmessage.product_type_seller=='storeSeller'}
                    <a href="{geturl controller='productpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">View Product</a>
                    {/if}
                </div>
                <div class="privateMessageForm" style="float:left; width:100%; display:none;">
                	<form action="{geturl controller='communication' action='privatemessage'}" method="post" class="account-privatemessage-form">
                	<label style="width:50%;">Current time:</label>
                   	<span style="float:left; width:40%;">{$smarty.now|date_format:'%D, %I:%M %p'}</span>
                    <div>
					<label style="width:50%;">Message:</label>
                    <textarea name="sender_message"></textarea>
                    {include file='partials/error.tpl' error=''}
					</div>
                    <input name="sender_name" type="hidden" value="{$user->generalInfo->username}" readonly="readonly" />
                    <input name="sender_email" type="hidden" value="{$user->generalInfo->email}" readonly="readonly" />
                    
                    <input type="hidden" name="product_id" value="{$shoutmessage.product_id}"/>
                    <input type="hidden" name="product_category" value="{$shoutmessage.product_category}"/>
                    <input type="hidden" name="product_type" value="{$shoutmessage.product_type_seller}"/>
                    <input type="hidden" name="receiver_User_id" value="{$shoutmessage.sender_user_id}"/>
                    <input type="hidden" name="receiver_Username" value="{$shoutmessage.sender_username}"/>
                    <input type="hidden" name="receiver_email" value="{$shoutmessage.sender_email}" />
                    <input type="hidden" name="receiver_name" value="{$shoutmessage.sender_name}" />
                    <input type="hidden" name="product_name" value="{$shoutmessage.product_name}" />
                    <input type="hidden" name="product_tag" value="{$shoutmessage.product_tag}" />
					<input type="hidden" name="sender_subject" value="{$shoutmessage.sender_subject}" />
                    <input type="hidden" name="product_image_id" value="{$shoutmessage.product_image_id}"/>
                    {if $authenticated}
                    <input type="hidden" name="sender_user_id" value="{$user->generalInfo->userID}" />
                    <input type="hidden" name="sender_username" value="{$user->generalInfo->username}" />
                    {/if}
                    
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send replay message!"/>
                    </form>
                </div>
            </div>
        {/foreach}
     </div>

     
     <div id="accountOutboxMessage" style="float:left; overflow-y:scroll; max-height:800px; width:100%; display:none;">
        {foreach from=$outboxMessages item=shoutmessage}
            <div class="PrivateMessage" style="float:left; width:95%;">
            	<div class="leftColumnShoutOut" style="width:20%; float:left;">
                	<div class="publicProductName" >
                    {if $shoutmessage.product_type_seller=='generalSeller'}

                    <a href="{geturl controller='userproductpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$shoutmessage.product_name}</a>
                    {else}
                    <a href="{geturl controller='productpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$shoutmessage.product_name}</a>
                    
                    {/if}
                    	
                    </div>
                    <!--<div class="publicProductType">
                    	{$shoutmessage.product_category}
                    </div>-->
                </div>
                <div class="rightColumnShoutOut" style="width:75%; float:left;">
                    <div class="publicProductShoutOutMessageName" >
                        Your message to {$shoutmessage.receiver_name}
                    </div>
                    <div class="privateMessageSubject">
                    	<span style="font-style:italic;">{$shoutmessage.sender_subject}</span>
                    </div>
                    <div class="publicProductShoutOutMessageContent" >
                       {$shoutmessage.sender_message}
        
                    </div>
                    <div class="publicProductShoutOutMessageTime" >
                        {$shoutmessage.ts_created|date_format:"%D, %I:%M %p"}
                    </div>
                </div>
                <div style="float:right;">
                    {if $shoutmessage.product_type_seller=='generalSeller'}
                	<a href="{geturl controller='userproductpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">View Product</a>
                    {else $shoutmessage.product_type_seller=='storeSeller'}
                    <a href="{geturl controller='productpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">View Product</a>
                    {/if}
                </div>
                
            </div>
        {/foreach}
     </div>
