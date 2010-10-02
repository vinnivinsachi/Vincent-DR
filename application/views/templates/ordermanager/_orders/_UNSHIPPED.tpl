    <div class='box' style='width:100%;'>
                    <div style="font-weight:bold; width:500px; float:left;">
                    <div class='tooltipControl' style='float:left; font-size:1.4em; cursor: pointer;'>{$product.product_name}</div>
                    
                    <div class='tooltip' style='background-color:white; border:none;'> 
		                    		
									<table width="600px;" style='border:none;'>
		                            <tr>
		                            <td><img src='/public/resources/userdata/tmp/thumbnails/{$product.uploader_username}/{$product.product_tag}/{$product.product_image_id}.W150_homeFrontFour.jpg'/></td>
		                            <td>
		                            <table>
		                            {foreach from=$product.profile item=attribute key=attributeKey}
		                            <tr>
		                            <td style='width:60%; text-align:right;'>{removeunderscore phrase=$attribute.profile_key}: </td>
		                            <td style='width:40%; text-align:left;'>{removeunderscore phrase=$attribute.profile_value}</td>
		                            </tr>
		                            {/foreach}
		                            </tr>
		                             <tr>
		                      		<td>Quantity: 1</td>  
									<td class='price'>Price: ${$product.product_price}</td> 
									</tr>
		                            </table>
		                            </td>
		                        	</table>
		                           
		                        </div> 
		                        <div class='box'> 
		                        <span style="font-weight:bold; {if $product.product_order_status=='shipped'}color:#069;{elseif $product.product_order_status=='return shipped' || $product.product_absolute_latest_delivery_date|date_format < $smarty.now|date_format}color:#F30;{elseif $product.product_order_status=='order completed' || $product.product_order_status=='order return completed'}color:#0C0;{else} color:#F90;{/if} font-size:12px; ">{removeunderscore phrase=$product.order_status}</span> 
		                        
		                        {if ($product.product_latest_delivery_date|date_format:"%Y-%m-%d")<($smarty.now|date_format:"%Y-%m-%d")}
		                        
		                        | 
		                        <span style=''><a>Cancel this order</a></span>
		                        {/if} 
		                        | Ordered on: {$product.ts_created|date_format:"%D"}
		                        </div>
		                        
                        </div>

    </div>
    
    
     <div class="productMainDiv box" style=" float:left; padding-top: 10px;  margin-bottom:5px; ">
		                       <div class="productShippingBody">
			                        <div class='orderStatus bigFont box' style='padding:5px 0px 5px 0px; background-color:#FFE877;'>
			                        <div class="productSellerInfo" style="float:left; padding-left:10px; width:40%;">
			                           Waiting for shipment by: {$product.product_warning_delivery_date|date_format:"%D"}
			                            </div>
			                            <div class='box' style='width:25%;'>
			                            Status: {removeunderscore phrase=$product.order_status}
			                            </div>
			                            <div class='productShippingInfo' style='float:left; width:30%; text-align:right; width:33%;'>Shipping: <span class='price'>${$product.current_shipping_rate}</span>
			                            </div>
			                        </div>  
		                        </div>
                       			
                   	 		</div>
                   	 		
    
    							<div class="trackingInfo" style="width:100%; float:left; padding:5px 0px 5px 0px;">
								    <div class="trackingInfoDetails box" >
								    {if $product.product_warning_delivery_date|date_format:"%Y-%m-%d"<$smarty.now|date_format:"%Y-%m-%d" && $product.product_latest_delivery_date|date_format:"%Y-%m-%d"<$smarty.now|date_format:"%Y-%m-%d"}
								    	<span style="color:#F30; font-size:1.2em; padding-left:10px;">The seller has yet to ship this item. Please contact the seller to avoid any misunderstanding. You are now able to cancel this order and be fully refunded.</span>
								    {else}
								        <span style="color:#F90; padding-left:10px;">The seller has yet to ship this item. Please contact this seller to avoid any misunderstanding.</span>
								    {/if}
								    </div>
									<div class="trackingActions" style="width:50%; float:right;">
								    </div>
								</div>
								
								<div class="orderProductFormSection" style="width:100%; float:left; ">
								[<a class="anchorOrderMessageSeller" id="anchorID-DivIDmessageForm-{$order->order_unique_id}_{$product.order_profile_id}" >Message buyer: {$product.uploader_username}</a>]
								    
								{include file='ordermanager/_orders/_message.tpl'}
								
								 </div>
						