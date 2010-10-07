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
		                        <span style="font-weight:bold; color:#F90; font-size:12px; ">{removeunderscore phrase=$product.order_status}</span> 
		                        
		                        | 
		                        <span style=''><a>Cancel this order</a></span> 
		                        | Ordered on: {$product.ts_created|date_format:"%D"}
		                        </div>
		                        
                        </div>
    
    {if ($product.product_latest_delivery_date|date_format:"%Y-%m-%d")<($smarty.now|date_format:"%Y-%m-%d")}
    
    <div class='tooltipControl' style="width:100px; float:right;"><img src="/public/resources/css/images/exclamation_mark.jpg"/></div>
	<div class='tooltip' style='width:300px;'>
    
    <div class="trackingStatusInfo" style="width:100%; float:left;">
        <span style="color:#F30; ">Please ship this order ASAP and submit a tracking info! Message this buyer to prevent any miscommunications. <br/>The buyer is now able to cancel this order and be refunded. <br/>
        Once the order is cancelled by the buyer, you will not be able to submit a tracking info and be paid.</span>
    </div>
    
    	{/if}
    
    
    </div>
    
    </div>
    
    
     <div class="productMainDiv box" style=" float:left; padding-top: 10px;  margin-bottom:5px; ">
		                       <div class="productShippingBody">
			                        <div class='orderStatus bigFont box' style='padding:5px 0px 5px 0px; background-color:#FFE877;'>
			                        <div class="productSellerInfo" style="float:left; padding-left:10px; width:40%;">
			                           Please make shipment by: {$product.product_warning_delivery_date|date_format:"%D"}
			                            </div>
			                            <div class='box' style='width:25%;'>
			                            Status: {$product.order_status}
			                            </div>
			                            <div class='productShippingInfo' style='float:left; width:30%; text-align:right; width:33%;'>Shipping: <span class='price'>${$product.current_shipping_rate}</span>
			                            </div>
			                        </div>  
		                        </div>
                       			
	                        	
	                        	
	                       
                   	 		</div>
                   	 		
    
    <div class="trackingInfo" style="width:100%; float:left; padding:5px 0px 5px 0px;">
								    <div class="trackingInfoDetails box" >
								    {if $product.product_warning_delivery_date|date_format:"%Y-%m-%d"<$smarty.now|date_format:"%Y-%m-%d" && $product.product_latest_delivery_date|date_format:"%Y-%m-%d"<$smarty.now|date_format:"%Y-%m-%d"}
								    	<span style="color:#F30; font-size:1.2em; padding-left:10px;">This product is now past due. The buyer will be able to cancel this order and be refunded. If the order is cancelled, you will no longer be able to provide any tracking information.</span>
								    {else}
								        <span style="padding-left:10px;"> Please submit a tracking info! The buyer will be able to cancel this order if this order is not shipped before {$product.product_latest_delivery_date|date_format:"%D"}.</span>
								    {/if}
								    </div>
									<div class="trackingActions" style="width:50%; float:right;">
								    </div>
								</div>
								
								<div class="orderProductFormSection" style="width:100%; float:left; ">
								<a class="anchorOrderMessageSeller" id="anchorID-DivIDmessageForm-{$order->order_unique_id}_{$product.order_profile_id}" >Message buyer: {$product.buyer_name}</a>
								                            
								<div style="float:right;"><a class="anchorTrackingForm" id="anchorID-DivIDtrackingForm-{$order->order_unique_id}_{$product.order_profile_id}">Submit tracking info</a></div>
								
								    <div class="TrackingForm {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDtrackingForm-{$order->order_unique_id}_{$product.order_profile_id}" style="width:100%; float:left; display:none;">
								        <form method="post" action="{geturl controller='ordermanager' action='addtrackingtoproduct'}">
								            <label style="width:50%;">Tracking #:</label>
								            <input type="text" name="productTracking" value=""/><br />
								            <label style="width:50%;">Tracking Carrier:</label>
								            <select name="productCarrier">
								                <option value="USPS">USPS</option>
								                <option value="FEDEX">FEDEX</option>
								                <option value="UPS">UPS</option>
								            </select>
								            <input type="hidden" name="productId" value="{$product.order_profile_id}" />
								            <input type="submit" value="Add tracking info" />
								        </form>
								    </div>  
								    
								        {include file='ordermanager/_soldOrders/_message.tpl'}
								            
								 </div>
						