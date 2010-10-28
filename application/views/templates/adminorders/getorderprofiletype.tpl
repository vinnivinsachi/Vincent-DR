{include file="layouts/$layout/header.tpl" lightbox=true}
{include file="layouts/vinceTemp/header.tpl"}

<div id="leftContainer" style="width:210px; float:left;">

{include file='adminorders/_orderStatusControls/_orderTabs.tpl'}

</div>

<div id="rightContainer" style='width:790px; float:left;'>
<div class='titleBarBig'>{$type}</div>
<table width="100%;" style="float:left;">
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
	<tr>
    	<td><div class='tooltipControl' >{$orderProfile.order_profile_id}</div>
        	<div class='tooltip' style='background-color:black; color:white; border:none;'> 
            <table width="500px;">
                <tr>
                    <td>Date</td>
                    <td>Status</td>
                    <td>Message</td>
                </tr>
                {foreach from=$orderProfile.statusTracking item=tracking}
                <tr>
                    <td>{$tracking.status_changed_date}</td>
                    <td>{$tracking.status}</td>
                    <td>{$tracking.message}</td>
                </tr>
                {/foreach}
                </table>
            </div>
        </td>
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
   <tr>
   	<td colspan="10">
           	<div class="DivIDtrackingStatusInfo {$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" id="DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="display:none;"></div>
            </div>
            <div class="DivIDreturnTrackingStatusInfo {$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" id="DivIDreturnTrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" style="display:none;"></div>
        </td>
   </tr>
{/foreach}
</table>


</div>

{literal}
<script type="text/javascript">
new adminOrderToggle('.anchorOrderMessageBuyer', '.anchorOrderMessageSeller', '.anchorMessageThread', '.anchorTrackingStatus', '.anchorReturnTrackingStatus', 'currentStatus');

$j(".tooltipControl").tooltip({position: 'bottom right'});
</script>
{/literal}
{include file="layouts/$layout/footer.tpl"}