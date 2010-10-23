
   <tr>
   		 <td colspan="2"><a href="{geturl controller='adminorders' action='vieworderprofiledetails'}?profileId={$orderProfile.order_profile_id}">View order details</a></td>
        <td colspan="2"><a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a> | </td>
        <td colspan="2">
        <a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_return_tracking}">Return tracking</a> </td>
        <td><a href="">Balance refunded</a></td>
                
   </tr>
   