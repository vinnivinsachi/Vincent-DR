			<table width="100%;">
                
                {foreach from=$itemsSold item=order key=Key}
                <tr style='border-bottom:3px solid #999;'><td style='width:100px;'>{$order->buyer_name}<br />
                        {$order->shippingAddress->address_one}<br />
                        {if $order->shippingAddress->address_two!=''}
                            {$order->shippingAddress->address_two}<br />
                        {/if}
                        {$order->shippingAddress->city} {$order->shippingAddress->state}, {$order->shippingAddress->zip}<br />
                        {$order->shippingAddress->country}<br/><br/>
                        Order ID: <br/>#{$order->order_unique_id}
                        </td>
                	<td>
                	<table>
                    {foreach from=$order->products item=product key=productKey}
                    <tr>
                    	<td style="padding-top: 10px;">
	                       	 	{assign var='orderStatusTemplate' value=$product.order_status}
	                       	 	{include file="ordermanager/_soldOrders/_$orderStatusTemplate.tpl"}		
                        </td>    
                    </tr>
                    {/foreach}
                    </table>	
                </td>
                </tr>
				{/foreach}
            </table>
            

{literal}
<script type="text/javascript">
$j(".tooltipControl").tooltip({position: 'bottom center'});
</script>
{/literal}