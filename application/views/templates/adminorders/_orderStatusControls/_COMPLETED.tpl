
   <tr>
   		 <td colspan="6">[<a class="anchorOrderMessageBuyer" id="anchorID-anchorOrderMessageBuyer-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" >Message buyer: {$orderProfile.buyer_name}</a>] [<a class="anchorOrderMessageSeller" id="anchorID-anchorOrderMessageSeller-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" >Message seller: {$orderProfile.product_Username}</a>] [<a class="anchorMessageThread" id="anchorID-anchorMessageThread-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}">Buyer and seller message thread</a>] [<a href="{geturl controller='ordermanager' action='vieworderprofiledetails'}?id={$orderProfile.order_profile_id}">View order details</a>]</td>
        <td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$orderProfile.order_unique_id}_{$orderProfile.order_profile_id}" title="{$orderProfile.product_tracking}">Tracking</a>]</td>
        <td>[<a href="{geturl controller='orderadministration' action='markorderpaymentstatus'}?id={$orderProfile.order_profile_id}">Payment transfered</a>]</td>
   </tr>
   