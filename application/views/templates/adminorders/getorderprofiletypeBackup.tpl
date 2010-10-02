{include file="layouts/$layout/header.tpl" lightbox=true}
<table width="100%">
	<tr>
    	<td>ID:</td>
    	<td>Product Name:</td>
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
        <td>{$orderProfile.buyer_name}</td>
        <td>{$orderProfile.uploader_username}</td>
        <td>{$orderProfile.product_price}</td>
        <td>{$orderProfile.current_shipping_rate}</td>
        <td>{$orderProfile.reward_points}</td>
        <td>{$orderProfile.product_latest_delivery_date|date_format:"%D"}</td>
        <td>{$orderProfile.product_absolute_latest_delivery_date|date_format:"%D"}</td>
        
   </tr>
   <tr>
   		 <td colspan="6">[<a class="anchorOrderMessageBuyer" id="anchorID-anchorOrderMessageBuyer-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" >Message buyer: {$orderProfile.buyer_name}</a>] [<a class="anchorOrderMessageSeller" id="anchorID-anchorOrderMessageSeller-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" >Message seller: {$orderProfile.product_Username}</a>] [<a class="anchorMessageThread" id="anchorID-anchorMessageThread-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}">Buyer and seller message thread</a>] [<a href="{geturl controller='ordermanager' action='vieworderprofiledetails'}?id={$orderProfile.order_profile_id}">View order details</a>]</td>
   {if $type=='shipped'}
        <td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a>]</td>
        <td>[<a href="{geturl controller='ordermanager' action='markorderasdelivered'}?id={$orderProfile.order_profile_id}">Mark as delivered</a>]</td>
   {elseif $type=='delivered'}
   		<td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a>]</td>
        <td>[<a href="{geturl controller='ordermanager' action='markorderascomplete'}?id={$orderProfile.order_profile_id}">Mark as completed</a>]</td>
   
   {elseif $type=='completed'}
        <td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a>]</td>
        <td>[<a href="{geturl controller='ordermanager' action='markorderpaymentstatus'}?id={$orderProfile.order_profile_id}">Payment transfered</a>]</td>
   {elseif $type=='return shipped'}
   		<td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a>]</td>
        <td colspan="2">[<a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Return Tracking</a>]</td>
        <td>[<a href="{geturl controller='ordermanager' action='markorderasdelivered'}?id={$orderProfile.order_profile_id}">Mark as delivered</a>]</td>
   {elseif $type=='return delivered'}
   		<td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a>]</td>
        <td colspan="2">[<a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Return Tracking</a>]</td>
        <td>[<a href="{geturl controller='ordermanager' action='markorderascomplete'}?id={$orderProfile.order_profile_id}" >Mark as completed</a>]</td>
   {elseif $type=='return completed'}
  		<td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a>]</td>
        <td colspan="2">[<a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Return Tracking</a>]</td>
        <td>[<a href="{geturl controller='ordermanager' action='markorderpaymentstatus'}?id={$orderProfile.order_profile_id}">Payment returned</a>]</td>
   
   {elseif $type=='anchorTrackingStatus'}
   		        <td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a>][<a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_returned_tracking}">Return Tracking</a>]</td>
        <td>[<a>Payment transfered</a>]</td>
   {else}
   		<td colspan="2"></td>
        <td></td>
   {/if}
   </tr>
   
   <tr id="AdminOrderProfile-{$orderProfile.order_unique_id}-supplimentary">
   		<td colspan="10">
				<div class="adminMessageBuyerDiv {$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="width:100%; float:left; display:none;" id="anchorOrderMessageBuyer-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="display:none;">
                <form action="{geturl controller='communication' action='privatemessage'}" method="post" class="account-privatemessage-form">
                    <label style="width:50%;">Current time:</label>
                    <span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span>
                    <div>
                    <label  style="width:50%;">Message to buyer:</label>
                    <textarea name="sender_message" rows="8"></textarea>
                    {include file='lib/error.tpl' error=''}
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
                    {include file='lib/error.tpl' error=''}
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