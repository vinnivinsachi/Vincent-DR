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
		                        <span style="font-weight:bold; font-size:12px; color:#B1FF91;">{removeunderscore phrase=$product.order_status}</span> 
		                        | Ordered on: {$product.ts_created|date_format:"%D"}
		                        </div>
		                        
                        </div>
    
    
    
    </div>
    
    
     <div class="productMainDiv box" style=" float:left; padding-top: 10px; margin-bottom:5px; ">
 
 <div class="productShippingBody">
 
			                        <div class='orderStatus bigFont box' style='padding:5px 0px 5px 0px; background-color:#B1FF91;'>
			                        <div class="productSellerInfo" style="float:left; padding-left:10px; width:40%;">
										Delivered, waiting for 2 week return period or user satifactory notification before order completion. 		                            
										</div>
			                            <div class='box' style='width:25%;'>
			                            Status: {removeunderscore phrase=$product.order_status} on {$product.product_delivered_date|date_format}
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
<a class="anchorOrderMessageSeller" id="anchorID-DivIDmessageForm-{$order->order_unique_id}_{$product.order_profile_id}" >Message seller: {$product.uploader_username} </a>|
								<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" title="{$product.product_tracking}">Tracking status</a>


								{if $product.return_allowed=='1'}
								<div style="float:right;">
									<a class="anchorReturnItem" id="anchorID-DivIDreturnTrackingForm-{$order->order_unique_id}_{$product.order_profile_id}">Return item</a> |
								<a class='anchorSatisfiedOrder' id="anchorID-DivIDSatisfiedOrder-{$order->order_unique_id}_{$product.order_profile_id}">Satisfied and write a review</a>
								</div>
								<div class="returnTrackingForm {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDreturnTrackingForm-{$order->order_unique_id}_{$product.order_profile_id}" style="width:100%; float:left; display:none;">
                                   <p>Inorder for you to return this item, you MUST supply a return tracking number.</p>
                                    <form method="post" action="{geturl controller='ordermanager' action='addtrackingtoreturnproduct'}">
                                        <label style="width:50%;">Return Tracking #:</label>
                                        <input type="text" name="returnProductTracking" value=""/><br />
                                        <label style="width:50%;">Return Tracking Carrier:</label>
                                        <select name="returnProductCarrier">
                                            <option value="USPS">USPS</option>
                                            <option value="FEDEX">FEDEX</option>
                                            <option value="UPS">UPS</option>
                                        </select><br/>
                                        <label style="width:50%">Rate experience</label>
                                        <select name='buyerExperienceRating'>
                                        	<option value='5'>5</option>
                                        	<option value='4.5'>4.5</option>
                                        	<option value='4'>4</option>
                                        	<option value='3.5'>3.5</option>
                                        	<option value='3'>3</option>
                                        </select><br/>
                                        <label style="width:50%">Reason for return</label>
                                        <textarea name='returnReason' cols='20' rows='3'></textarea><br/>
                                       
                                        <input type="hidden" name="returnProductId" value="{$product.order_profile_id}" />
                                        <input type="submit" style='margin-left:50%;' value="Return this item" />
                                    </form>
                                </div> 
                                   
                                {else}
                                <div style="float:right;">
                                <a class="anchorReturnItem" id="anchorID-DivIDreturnTrackingForm-{$order->order_unique_id}_{$product.order_profile_id}">Wrong item?</a> |
								<a class='anchorSatisfiedOrder' id="anchorID-DivIDSatisfiedOrder-{$order->order_unique_id}_{$product.order_profile_id}">Satisfied and write a review</a>
                                </div>
								<div class="returnTrackingForm {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDreturnTrackingForm-{$order->order_unique_id}_{$product.order_profile_id}" style="width:100%; float:left; display:none;">
                                    You may not return this item because this item is not returnable specified by the seller during listing. <br/>
                                    If the item shipped is not the right item, you may <strong>file a claim</strong>. We will then investigate this order and approve your return request. After the return is approved, you may submit a return tracking information be full refunded for the item.
                                    <form>
                                    	
                                        <label style="width:50%;">Reason for claim:</label>
                                        <select name="orderClaimReason">
                                            <option value="Wrong item">Wrong item</option>
                                            <option value="Severely damaged">Severely damanged</option>
                                            <option value="Manufacturing defect">Manufacturing defect</option>
                                            <option value="Do not like it">Do not like it</option>
                                            <option value="Other">Other</option>
                                        </select><br/>
                                        <label style="width:50%;">Phone number:</label>
                                        <input type="text" name='claimBuyerPhoneNumber' />
                                        <input type="hidden" name="" value="{$product.order_profile_id}" />
                                        <input type="submit" value="File this claim" />
                                    </form>
                                </div>
                               
                                {/if}
								{include file='ordermanager/_orders/_message.tpl'}
								
								<div class="trackingStatusInfo {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none; float:left;"></div>
								    
								    
								<div class="satisfiedOrderForm {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDSatisfiedOrder-{$order->order_unique_id}_{$product.order_profile_id}" style=''>
								 <p>Please submit a review to provide this feedback for this seller. Because your feedback is much appreciated and would help other buyers make better purchasing decisions, you will be awarded 4 reward points towards your future purchase.</p>
                                	<form method="post" action="{geturl controller='ordermanager' action='completeorder'}">
                                        <label style="width:50%">Rate experience</label>
                                        <select name='buyerExperienceRating'>
                                        	<option value='5'>5</option>
                                        	<option value='4.5'>4.5</option>
                                        	<option value='4'>4</option>
                                        	<option value='3.5'>3.5</option>
                                        	<option value='3'>3</option>
                                        </select><br/>
                                        <label style="width:50%">Please write a review about this seller</label>
                                        <textarea name='returnReason' cols='20' rows='3'></textarea><br/>
                                       
                                        <input type="hidden" name="returnProductId" value="{$product.order_profile_id}" />
                                       
                                        <input type="submit" style='margin-left:50%;' value="Complete order and submit review" />
                                    </form>
                                
                                </div>       
								</div>
								 
								
								