
   <tr>
   		 <td colspan="2"><a href="{geturl controller='ordermanager' action='vieworderprofiledetails'}?profileId={$orderProfile.adminorders}">View order details</a></td>
        <td colspan="8"><a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a> | 
       
        <a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_return_tracking}">Return tracking</a> | 
        
        <a href="{geturl controller='orderadministration' action='markorderasdelivered'}?id={$orderProfile.order_profile_id}">Mark as return delivered</a></td>
        
   </tr>
   