{include file="layouts/$layout/header.tpl" lightbox=true}
Welcome to order management, {$signedInUser->generalInfo->first_name}.<br />

<a href="{geturl controller='ordermanager' action='automatedeliveryttocomplete'}">Automate [delivered/return delivered] to [complete/return complete]</a>
<br />


<div id="orderTabs" style="width:99%;">

    	  <ul>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=unshipped">Unshipped ({$orderProfiles->unshippedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=shipped">Shipped ({$orderProfiles->shippedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=delivered">Delivered</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=completed">Completed ({$orderProfiles->completedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=payment transfered">Payment Transfered ({$orderProfiles->paymentTransfered|@count})</a></li>
			<li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=return shipped">Returned ({$orderProfiles->returnShippedOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=return delivered">Return Delivered </a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=return completed">Return completed ({$orderProfiles->returnCompleteOrders|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=payment returned">Payment returned ({$orderProfiles->paymentReturned|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=cancelled by buyer">B Cancelled ({$orderProfiles->cancelledByBuyer|@count})</a></li>
            <li><a href="{geturl controller='adminorders' action='getorderprofiletype'}?type=cancelled by seller">S Cancelled ({$orderProfiles->cancelledBySeller|@count})</a></li>
         </ul>
    	<!--{foreach from=$orderProfiles->unshippedOrders item=unshippedOrder}
        	{$unshippedOrder.product_name}
        {/foreach}-->
</div>

{literal}
<!--<script type="text/javascript">
$j(document).ready(function(){
							
							$j('#orderTabs').tabs({
								load: function(event, ui) {
									$j('a', ui.panel).click(function() {
										$j(ui.panel).load(this.href);
										return false;
									});
								}
});
});
</script>-->
{/literal}
{include file="layouts/$layout/footer.tpl"}