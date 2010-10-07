{include file="layouts/$layout/header.tpl" lightbox=true}
<table width="100%">
	<tr class='trTitle'>
    	<td>ID:</td>
    	<td>Product Name:</td>
    	<td>Status:</td>
        <td>Buyer:</td>
        <td>Seller:</td>
        <td>Price:</td>
        <td>Shipping:</td>
        <td>RP:</td>
        <td>Delivery date:</td>
        <td>Latest delivery date:</td>
        
     </tr>
{foreach from=$orderProfilesType item=orderProfile}
	<tr {if $orderProfile.product_absolute_latest_delivery_date|date_format < $smarty.now|date_format && $orderProfile.product_order_status=='unshipped'} bgcolor="#FF3300" {elseif $orderProfile.product_latest_delivery_date|date_format < $smarty.now|date_format && $orderProfile.product_order_status=='unshipped'} bgcolor="#FF9900" {elseif $orderProfile.product_order_status=='unshipped'} bgcolor="#009900"{/if}>
    	<td>{$orderProfile.order_profile_id}</td>
    	<td>{$orderProfile.product_name}</td>
    	<td>{$orderProfile.order_status}</td>
        <td>{$orderProfile.buyer_name}</td>
        <td>{$orderProfile.uploader_username}</td>
        <td>{$orderProfile.product_price}</td>
        <td>{$orderProfile.current_shipping_rate}</td>
        <td>{$orderProfile.reward_points_awarded}</td>
        <td>{$orderProfile.product_warning_delivery_date|date_format:"%D"}</td>
        <td>{$orderProfile.product_latest_delivery_date|date_format:"%D"}</td>
        
   </tr>
   {assign var='orderStatusControl' value=$orderProfile.order_status}
   {include file="adminorders/_orderStatusControls/_$orderStatusControl.tpl"}
   
   <tr id="AdminOrderProfile-{$orderProfile.order_unique_id}-supplimentary">
   		<td colspan="10">
				<div class="adminMessageBuyerDiv {$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="width:100%; float:left; display:none;" id="anchorOrderMessageBuyer-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="display:none;">
                <form action="{geturl controller='communication' action='privatemessage'}" method="post" class="account-privatemessage-form">
                    <label style="width:50%;">Current time:</label>
                    <span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span>
                    <div>
                    <label  style="width:50%;">Message to buyer:</label>
                    <textarea name="sender_message" rows="8"></textarea>
                    {include file='partials/error.tpl' error=''}
                    </div>
                    
                    <input name="sender_name" type="hidden" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
                    <input name="sender_email" type="hidden" value="{$signedInUser->generalInfo->email}" readonly="readonly" />
                    <input type="hidden" name="product_id" value="{$orderProfile.product_id}"/>
                    <input type="hidden" name="product_category" value="{$orderProfile.product_type}"/>
                    <input type="hidden" name="product_type" value="{$orderProfile.product_market}"/>
                    <input type="hidden" name="receiver_User_id" value="{$orderProfile.buyer_UserID}"/>
                    <input type="hidden" name="receiver_Username" value="{$orderProfile.buyer_Username}"/>
                    <input type="hidden" name="receiver_name" value="{$orderProfile.buyer_Username}" />
                    <input type="hidden" name="product_name" value="{$orderProfile.product_name}" />
                    <input type="hidden" name="product_tag" value="{$orderProfile.product_tag}" />
                    <input type="hidden" name="sender_subject" value="DancewearRialto message: {$orderProfile.order_unique_id}" />
                    <input type="hidden" name="product_image_id" value="{$orderProfile.product_image_id}"/>
                    <input type="hidden" name="sender_user_id" value="{$signedInUser->generalInfo->userID}" />
                    <input type="hidden" name="sender_username" value="{$signedInUser->generalInfo->username}" />
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
                </form>
    			</div>
                
                <div class="adminMessageSellerDiv {$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="width:100%; float:left; display:none;" id="anchorOrderMessageSeller-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="display:none;">
                    <form action="{geturl controller='communication' action='privatemessage'}" method="post" class="account-privatemessage-form">
                    <label style="width:50%;">Current time:</label>
                    <span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span>
                    <div>
                    <label style="width:50%;">Message to seller:</label>
                    <textarea name="sender_message" rows="8"></textarea>
                    {include file='partials/error.tpl' error=''}
                    </div>
                    <input name="sender_name" type="hidden" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
                    <input name="sender_email" type="hidden" value="{$signedInUser->generalInfo->email}" readonly="readonly" />
                    <input type="hidden" name="product_id" value="{$orderProfile.product_id}"/>
                    <input type="hidden" name="product_category" value="{$orderProfile.product_type}"/>
                    <input type="hidden" name="product_type" value="{$orderProfile.product_market}"/>
                    <input type="hidden" name="receiver_User_id" value="{$orderProfile.product_UserId}"/>
                    <input type="hidden" name="receiver_Username" value="{$orderProfile.product_Username}"/>
                    <input type="hidden" name="receiver_name" value="{$orderProfile.product_Username}" />
                    <input type="hidden" name="product_name" value="{$orderProfile.product_name}" />
                    <input type="hidden" name="product_tag" value="{$orderProfile.product_tag}" />
                    <input type="hidden" name="sender_subject" value="DancewearRialto message: {$orderProfile.order_unique_id}" />
                    <input type="hidden" name="product_image_id" value="{$orderProfile.product_image_id}"/>
                    <input type="hidden" name="sender_user_id" value="{$signedInUser->generalInfo->userID}" />
                    <input type="hidden" name="sender_username" value="{$signedInUser->generalInfo->username}" />
                    
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
                </form>
            </div>
            <div class="anchorMessageThread {$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="width:100%; float:left; display:none;" id="anchorMessageThread-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="display:none;">
            
            </div>
           	<div class="DivIDtrackingStatusInfo {$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" id="DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="display:none;"></div>
            </div>
            <div class="DivIDreturnTrackingStatusInfo {$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" id="DivIDreturnTrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="display:none;"></div>
        </td>
   </tr>
{/foreach}
</table>

{literal}
<script type="text/javascript">

new adminOrderToggle('.anchorOrderMessageBuyer', '.anchorOrderMessageSeller', '.anchorMessageThread', '.anchorTrackingStatus', '.anchorReturnTrackingStatus', 'currentStatus');

</script>
{/literal}
{include file="layouts/$layout/footer.tpl"}