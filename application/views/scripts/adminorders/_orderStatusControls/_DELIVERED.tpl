
   <tr>
   		<td colspan="2">
   		 <a href="{geturl controller='adminorders' action='vieworderprofiledetails'}?profileId={$orderProfile.order_profile_id}">View order details</a> | </td>
        <td colspan="2"> <a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a> | </td>
        
        <td>Temporary <a href="{geturl controller='orderadministration' action='markorderascomplete'}?id={$orderProfile.order_profile_id}">Mark as completed</a></td>
   </tr>
   