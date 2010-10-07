<div id="accountPublicShoutBox" style="float:left; overflow-y:scroll; max-height:800px; width:100%;">
        {foreach from=$allShoutBoxMessages item=shoutmessage}
            <div class="publicProductShoutOutMessage" style="float:left; width:98%;">
            	<div class="leftColumnShoutOut" style="width:20%; float:left;">
                	<div class="publicProductName" >
                    	{$shoutmessage.shoutout_name}
                    </div>
                </div>
                <div class="rightColumnShoutOut" style="width:75%; float:left;">
                    <div class="publicProductShoutOutMessageName" >
	                    {if $shoutmessage.product_type_seller=='generalSeller'}
	
	                    <a href="{geturl controller='userproductpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$shoutmessage.product_name}</a>
	                    {else}
	                    <a href="{geturl controller='productpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$shoutmessage.product_name}</a>
	                    
	                    {/if}
                    </div>
                    <div class="publicProductShoutOutMessageContent" >
                        {$shoutmessage.shoutout_message}
        
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
                <div class="accountDetailShoutOutForm" style="float:left; width:100%; display:none;">
                	<form action="{geturl controller='communication' action='postshoutout'}" method="post" class="account-shoutbox-form">
                	<label>Current time:</label>
                   	<span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span><br/>
                    <div>
					<label>Message:</label>
                    <textarea name="shoutout_message"></textarea>
                    {include file='partials/error.tpl' error=''}
					</div>
                    <input name="shoutout_name" type="hidden" value="{$user->generalInfo->username}" readonly="readonly" />
                    <input name="shoutout_email" type="hidden" value="{$user->generalInfo->email}" readonly="readonly" />
                    
                    <input type="hidden" name="product_id" value="{$shoutmessage.product_id}"/>
                    <input type="hidden" name="product_category" value="{$shoutmessage.product_category}"/>
                    <input type="hidden" name="product_type" value="{$shoutmessage.product_type_seller}"/>
                    <input type="hidden" name="User_id" value="{$shoutmessage.User_id}"/>
                    <input type="hidden" name="Username" value="{$shoutmessage.Username}"/>
                    <input type="hidden" name="product_name" value="{$shoutmessage.product_name}" />
                    <input type="hidden" name="product_tag" value="{$shoutmessage.product_tag}" />

                    <input type="hidden" name="product_image_id" value="{$shoutmessage.product_image_id}"/>
                    {if $authenticated}
                    <input type="hidden" name="shoutout_user_id" value="{$user->generalInfo->userID}" />
                    <input type="hidden" name="shoutout_username" value="{$user->generalInfo->username}" />
                    {/if}
                    
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:200px; float:left;"value="Shout!"/>
                    </form>
                </div>
            </div>
        {/foreach}
        </div>
             {literal}
     <script type="text/javascript">
new toggleClass('accountPublicShoutBox', 'accountDetailShoutOutForm', 'accountDetailShoutOutFromRespond', 'publicProductShoutOutMessage' );
</script>
{/literal}