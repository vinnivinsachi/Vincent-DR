<form method='get' action="{geturl controller='adminorders' action='vieworderprofiledetails'}">
	<label>Profile id:</label>
	<input type='text' name='profileId' />
	<input type='submit' value='sumit profile id'>
</form>

<form method='get' action="{geturl controller='adminorders' action='vieworderprofiledetails'}">
	<label>Order id:</label>
	<input type='text' name='orderId' />
	<input type='submit' value='sumit order id'>
</form>
<div id="orderTabs" style="width:99%;">
    	  <ul>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=UNSHIPPED">Unshipped ({$orderProfiles->unshippedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=SHIPPED">Shipped ({$orderProfiles->shippedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=DELIVERED">Delivered ({$orderProfiles->deliveredOrders|@count})</a></li>
            
            
			<li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=RETURN_SHIPPED">Returned ({$orderProfiles->returnShippedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=RETURN_DELIVERED">Return Delivered ({$orderProfiles->returnDeliveredOrders|@count})</a></li>
            
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=ORDER_COMPLETED">Order completed ({$orderProfiles->orderCompletedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=RETURN_COMPLETED">Return completed ({$orderProfiles->returnCompletedOrders|@count})</a></li>
            
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=CANCELLED_BY_BUYER">B Cancelled ({$orderProfiles->cancelledByBuyerOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=CANCELLED_BY_SELLER">S Cancelled ({$orderProfiles->cancelledBySellerOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=HELD_BY_BUYER_FOR_ARBITRATION">Held by buyer for arb  ({$orderProfiles->heldByBuyerForArbitrationOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=HELP_BY_SELLER_FOR_ARBITRATION">Held by seller for arb  ({$orderProfiles->heldBySellerForArbitrationOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=SELLER_CLAIM_APPROVED_UNSHIPPED">S claim approved unshipped ({$orderProfiles->sellerClaimApprovedUnshippedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=SELLER_CLAIM_APPROVED_RESHIPPED">S claim approved reshipped ({$orderProfiles->sellerClaimApprovedReshippedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=SELLER_CLAIM_APPROVED_DELIVERED">S claim approved delivered ({$orderProfiles->sellerClaimApprovedDeliveredOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=BALANCE_UPDATED">Balance updated ({$orderProfiles->balanceUpdatedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=BALANCE_REFUNDED">Balance returned ({$orderProfiles->balanceRefundedOrders|@count})</a></li>
            
         </ul>
    	<!--{foreach from=$orderProfiles->unshippedOrders item=unshippedOrder}
        	{$unshippedOrder.product_name}
        {/foreach}-->
</div>