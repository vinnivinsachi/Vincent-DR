{include file="layouts/$layout/header.tpl" lightbox=true}

<div id="leftContainer" style="width:22%; float:left;">	
<ul id="qm0" class="qmmc" style="width:100%;">
			{if $itemsSold|@count>0}
            <li><a class="qmparent" href="javascript:void(0)">Sold Items ({$itemsSold|@count})</a>
                <ul>
                	{foreach from=$itemsSold item=order}
                
                    <li><a >Date: {$order->ts_created|date_format:"%D, %I:%M %p"}<br />
                    Items({$order->products|@count}) <br />
                    # {$order->order_unique_id}<br />
                  	
                    <ul>
                    	{foreach from=$order->products item=product key=productKey}
                    	<li><a href="{$smarty.server.request_uri}#orderMainDiv-{$order->order_unique_id}">
                       {$product.product_name} <br /><span style="font-weight:bold; {if $product.product_order_status=='shipped'}color:#069;{elseif $product.product_order_status=='return shipped' || $product.product_absolute_latest_delivery_date|date_format < $smarty.now|date_format}color:#F30;{elseif $product.product_order_status=='order completed' || $product.product_order_status=='order return completed'}color:#0C0;{else} color:#F90;{/if} font-size:12px; fon">{$product.product_order_status}</span>
                        </a></li>
                    
                    	{/foreach}
                    </ul>
                    </li>
                	{/foreach}                
                </ul>
            </li>
            
            {/if}
           
<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}

</div>

<div id="rightColumn" style="width:77%; float:right;">
    
{if $user->generalInfo->user_type =='generalSeller' ||$user->generalInfo->user_type =='storeSeller'} 
	<div class='box'>
		<div class='titleBarBig'>Sold orders</div>
	</div>
            <div id="orderHistorySold" style=" width:100%; float: left;">
             {include file='ordermanager/_soldOrders/soldOrder.tpl'}
             </div>
    {/if}
</div>

{literal}
<script type="text/javascript">

new orderToggle('.anchorOrderMessageSeller', '.anchorTrackingStatus','.anchorReturnTrackingStatus','.anchorReturnItem','.anchorTrackingForm', '.anchorOrderCancelled','.anchorProductReview', '.anchorFileAClaim', 'currentSelection');
					
</script>
{/literal}

{include file="layouts/$layout/footer.tpl"}