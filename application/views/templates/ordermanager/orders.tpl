{include file="layouts/$layout/header.tpl" lightbox=true}

<div id="leftContainer" style="width:22%; float:left;">	
<ul id="qm0" class="qmmc" style="width:100%;">
            <li><a class="qmparent qmactive" href="javascript:void(0)">Bought Items ({$orders|@count})</a>
            	{if $orders|@count >0}
                <ul>
                	{foreach from=$orders item=order}
                
                <li><a ><span style="font-weight:bold; {if $product.product_order_status=='shipped'}color:#069;{elseif $product.product_order_status=='return shipped' || $product.product_absolute_latest_delivery_date|date_format < $smarty.now|date_format}color:#F30;{elseif $product.product_order_status=='completed' || $product.product_order_status=='order return completed'}color:#0C0;{else} color:#F90;{/if} font-size:12px; fon">{$product.product_order_status}</span> {$order->ts_created|date_format:"%D"}<br />
                Items({$order->products|@count}), Total: ${$order->final_total_costs}<br />
                <br />								
								</a>
                         <ul>       
                         {foreach from=$order->products item=product key=productKey}
                                <li><a href="{$smarty.server.request_uri}#orderMainDiv-{$order->order_unique_id}">
                               {$product.product_name} <br />Order ID: {$order->order_unique_id}
                                </a></li>
                    	{/foreach}
                        </ul></li>
                	{/foreach}
                </ul>
                {/if}</li>
</ul>
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}

</div>

<div id="rightColumn" style="width:77%; float:right;">

        <div id="orderHistoryBox" style="width:100%; color:black;">
        	{include file='ordermanager/_orders/boughtOrder.tpl' orders=$orders}
        </div>
</div>

{literal}
<script type="text/javascript">

new orderToggle('.anchorOrderMessageSeller', '.anchorTrackingStatus','.anchorReturnTrackingStatus','.anchorReturnItem','.anchorTrackingForm', '.anchorOrderCancelled','.anchorProductReview','.anchorSatisfiedOrder', 'currentSelection');

																										
</script>
{/literal}

{include file="layouts/$layout/footer.tpl"}