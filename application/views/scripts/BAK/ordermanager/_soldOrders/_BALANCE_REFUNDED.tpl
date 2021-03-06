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
		                        <div class='box orderProductSecondHeader'> 
		                        <span style="font-weight:bold; color:#B1FF91; font-size:12px; ">{removeunderscore phrase=$product.order_status}</span> 
		                        
		                        | Ordered on: {$product.ts_created|date_format:"%D"}
		                        </div>
		                        
                        </div>
    
    
    
    </div>
    
    
     <div class="productMainDiv box" style=" float:left; padding-top: 10px; margin-bottom:5px; ">
 
 <div class="productShippingBody">
 
			                        <div class='orderStatus bigFont box' style='padding:5px 0px 5px 0px; background-color:#B1FF91;'>
			                        <div class="productSellerInfo" style="float:left; padding-left:10px; width:40%;">
This order is now return complete, and balance has been refunded to the buyer.			                            </div>
			                            <div class='box' style='width:25%;'>
			                            Status: {removeunderscore phrase=$product.order_status} on {$product.product_shipping_date|date_format}
			                            </div>
			                            <div class='productShippingInfo' style='float:left; width:30%; text-align:right; width:33%;'>Shipping: <span class='price'>${$product.current_shipping_rate}</span>
			                            </div>
			                        </div>  
		                        </div>
 
 						<div class="trackingInfo" style="width:100%; float:left; padding:5px 0px 5px 0px;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            Tracking: {$product.product_tracking}<br />
                            Carrier: {$product.product_tracking_carrier}<br />
							Date shipped: {$product.product_shipping_date|date_format:"%D"}
                            </div>
				<div class="trackingActions" style="width:50%; float:right;">
                            </div>
                        </div>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left;">
                            Return Tracking: {$product.product_return_tracking}<br />
                            Return Carrier: {$product.product_return_tracking_carrier}<br />
							Return Date shipped: {$product.product_return_shipping_date|date_format:"%D, %I:%M %p"}
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                        	</div>
                        </div>
                        
                        <div class="trackingInfo" style="width:100%; float:left; padding:5px 0px 5px 0px;">
								    <div class="trackingInfoDetails box" style=" color:#F90;" >

								    </div>
									<div class="trackingActions" style="width:50%; float:right;">
								    </div>
								</div>
								
                        <div class="trackingStatusInfo">
                        
                        </div>
</div>

<div class="trackingInfo" style="width:100%; float:left; padding:5px 0px 5px 0px;">
								    <div class="trackingInfoDetails box" >
								   
								    </div>
									<div class="trackingActions" style="width:50%; float:right;">
								    </div>
								</div>
								
								<div class="orderProductFormSection" style="width:100%; float:left;">
 <a class="anchorOrderMessageSeller" id="anchorID-DivIDmessageForm-{$order->order_unique_id}_{$product.order_profile_id}" >Message buyer: {$product.uploader_username}</a> |
								<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" title="{$product.product_tracking}">Tracking status</a> |
                            <a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" title="{$product.product_tracking}">Return tracking status</a>



								{include file='ordermanager/_orders/_message.tpl'}
				        
								
								 <div class="trackingStatusInfo {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none;">
								
                                </div>
                                <div class="returnTrackingStatusInfo {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDreturnTrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none;">
                              
                                </div>
                                </div>