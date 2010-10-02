{foreach from=$itemsSold item=order key=Key}
            	<div class="orderMainDiv" id="orderMainDiv-{$order->order_unique_id}" style=" background-color:#F0F0F0; width:99%; float:left; margin-bottom:10px;">
                	<div class="orderHistoryTitle" style=" width:100%; float:left; background-color:#666; color:#FFF;">
                        <div class="orderId" style="width:50%; float:left;">Order id: {$order->order_unique_id}</div>
                        <div class="orderId" style="width:50%; float:right; text-align:right;">Created time: {$order->ts_created|date_format:"%D, %I:%M %p"}</div>
                    </div>
                    <div class="orderDeliveryAddress" style="width:100%; float:right; text-align:right; font-style:italic;">
                        Deliver to: {$order->buyer_name}<br />
                        {$order->shippingAddress->address_one}<br />
                        {if $order->shippingAddress->address_two!=''}
                            {$order->shippingAddress->address_two}<br />
                        {/if}
                        {$order->shippingAddress->city} {$order->shippingAddress->state}, {$order->shippingAddress->zip}<br />
                        {$order->shippingAddress->country}<br />
                    </div>
                    <div style="width:50%; float:left">Product details</div>
                    <div style="width:15%; float:left">Quantity</div>
                    <div style="width:15%; float:left">Price</div>
                    <div style="width:20%; float:left">+ Reward points</div>
                    
                    {foreach from=$order->products item=product key=productKey}
                    <div class="productMainDiv" style="width:100%; float:left; border-bottom:1px solid #069; margin-bottom:5px; {if $product.product_absolute_latest_delivery_date|date_format<$smarty.now|date_format}background:#FF0;{/if}">
                        <div class="productTopDiv" style="width:100%; float:left;">
                            <div class="orderProductDetails" style="width:50%; float:left">
                                Buyer: <span style="color:#069; font-weight:bold;">{$order->buyer_name}</span>/{if $product.product_market=='generalSeller'}User product{else if $product.product_market=='storeSeller'}Custom product{/if}<br />
                                <span style="font-weight:bold;">{$product.product_name} <span style="font-weight:bold; {if $product.product_order_status=='shipped'}color:#069;{elseif $product.product_order_status=='return shipped' || $product.product_absolute_latest_delivery_date|date_format < $smarty.now|date_format}color:#F30;{elseif $product.product_order_status=='order completed' || $product.product_order_status=='order return completed'}color:#0C0;{else} color:#F90;{/if} font-size:12px; fon">{$product.product_order_status}</span></span>
                            </div>
                            <div class="orderProductQuanitty" style="width:15%; float:left">1</div>
                            <div class="orderProductPrice" style="width:15%; float:left;">{$product.product_price}</div>
                            <div class="orderProductRewardPoints" style="width:15%; float:left;">{$product.reward_points}</div>
                        </div>
                        <div class="productShippingBody">
                            <div class="productSellerInfo" style="float:left; width:50%;">
                           <span style="font-style:italic; color:#F90;">Ship by: {$product.product_latest_delivery_date|date_format:"%D"}</span>
                            </div>
                            <div class="productOrderQuantity" style="float:left;; width:15%;">Shipping:</div>
                            <div class="productOrderPrice" style="float:left; width:15%;">
                            ${$product.shipping_costs}
                            </div>
                        </div>
                        <div class="orderProductAttributes" style="width:80%; float:left;padding-left:20px;">
                            {foreach from=$product.profile item=attribute key=attributeKey}
                            <label style="width:150px;">{$attribute.profile_key}: </label>
                            <span>{$attribute.profile_value}</span><br />
                            {/foreach}
                        </div>
                        
                        {if $product.product_order_status=='Cancelled by buyer'}
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:49%; float:left; margin-right:5px;">
                           
                              <span style="color:#F90;">We are sorry, this product was late for delivery and the buyer had cancelled the order. </span>
                            </div>
							<div class="trackingActions" style="width:49%; float:left;">
                            	<span style="color:#F90; font-size:12px;">Reasons for cancellation: "{$product.cancellation_reason}" </span>
                            </div>
                        </div>
                        
                        {elseif $product.product_order_status=='unshipped'}
                     	<div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                           {if $product.product_latest_delivery_date|date_format<$smarty.now|date_format && $product.product_absolute_latest_delivery_date|date_format > $smarty.now|date_format}
                            <span style="color:#F30;">This product is now past due. The buyer will be able to cancel this order and be refunded. If the order is cancelled, you will no longer be able to provide any tracking information.</span>
                           {else}
                          <span style="color:#F90;"> Please submit a tracking info! The buyer will be able to cancel this order if this order is not shipped before {$product.product_absolute_latest_delivery_date|date_format}.</span>
                           {/if}
                            </div>
							<div class="trackingActions" style="width:50%; float:right;">
                            </div>
                        </div>
                        <div class="trackingStatusInfo" style="width:100%; float:left;">
                        	{if $product.product_absolute_latest_delivery_date|date_format<$smarty.now|date_format}
                            <span style="color:#F30;">Please ship this order ASAP and submit a tracking info! Message this buyer to prevent any miscommunications. The buyer is now able to cancel this order and be refunded. Once the order is cancelled by the buyer, you will not be able to submit a tracking info and be paid.</span>
							{/if}
                        	
                        </div>
                        {elseif $product.product_order_status=='shipped'}
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            Tracking: {$product.product_tracking}<br />
                            Carrier: {$product.product_tracking_carrier}<br />
							Date shipped: {$product.product_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                            </div>
							<div class="trackingActions" style="width:50%; float:right;">
                             <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for {$order->buyer_name} to complete order by comfirming delivery...</span>
                            </div>
                        </div>
                        <div class="trackingStatusInfo">
                        
                        </div>
                        {elseif $product.product_order_status=='return shipped'}
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            Tracking: {$product.product_tracking}<br />
                            Carrier: {$product.product_tracking_carrier}<br />
							Date shipped: {$product.product_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                            </div>
							<div class="trackingActions" style="width:50%; float:right;">
                            </div>
                        </div>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left; color:#F90;">
                            Return tracking: {$product.product_returned_tracking}<br />
                            Return carrier: {$product.product_returned_tracking_carrier}<br />
							Return date shipped: {$product.product_returned_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                            </div>
							<div class="trackingActions" style="width:50%; float:right;">
                            <a href="{geturl controller='ordermanager' action='completeorder'}?orderProductId={$product.order_profile_id}" class="submitInputButton">Received &amp; complete Order</a><br />
                            </div>
                        </div>                        
                        {elseif $product.product_order_status=='order completed'}
                             <div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left;">
                                Tracking: {$product.product_tracking}<br />
                                Carrier: {$product.product_tracking_carrier}<br />
                                Date shipped: {$product.product_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                </div>
                                {if $product.payment_to_seller=='0' && $product.product_returned==0}
                                <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for payment to be transfered to you...</span>
                                {elseif $product.payment_to_seller=='1' && $product.product_returned==0}
                                 <span style="font-size:12px; font-style:italic; color:#090;">Payments transfered to you.</span>
                                {/if}
                            </div>
                        {elseif $product.product_order_status=='order return completed'}
                        	<div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left;">
                                Tracking: {$product.product_tracking}<br />
                                Carrier: {$product.product_tracking_carrier}<br />
                                Date shipped: {$product.product_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                </div>
                                {if $product.payment_to_seller=='0' && $product.product_returned==0}
                                <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for payment to be transfered to you...</span>
                                {elseif $product.payment_to_seller=='1' && $product.product_returned==0}
                                 <span style="font-size:12px; font-style:italic; color:#090;">Payments transfered to you.</span>
                                {/if}
                            </div>
                            <div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left; color:#F90;">
                                Return tracking: {$product.product_returned_tracking}<br />
                                Return carrier: {$product.product_returned_tracking_carrier}<br />
                                Return date shipped: {$product.product_returned_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                <span style="font-size:12px; font-style:italic; color:#090;">You have comfirmed this returned order and payment will be refunded to {$order->buyer_name}.</span>
                                </div>
                            </div>          
                        {/if}
                        
                        
                        <div class="orderProductFormSection" style="width:100%; float:left;">
                        	[<a class="anchorOrderMessageSeller" id="anchorID-DivIDmessageForm-{$order->order_unique_id}_{$product.order_profile_id}" >Message buyer: {$product.buyer_name}</a>]
                            
         					{if $product.product_order_status=='unshipped'}
                            <div style="float:right;">[<a class="anchorTrackingForm" id="anchorID-DivIDtrackingForm-{$order->order_unique_id}_{$product.order_profile_id}">Submit tracking info</a>]</div>
                            
                            {elseif $product.product_order_status=='shipped'}
                            [<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" title="{$product.product_tracking}">Tracking status</a>]
                            {elseif $product.product_order_status=='return shipped' ||($product.product_order_status=='order return completed' && $product.product_returned==1)}
                            [<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" title="{$product.product_tracking}">Tracking status</a>][<a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" title="{$product.product_tracking}">Return tracking status</a>]
                            
                            {elseif $product.product_order_status=='order completed' && $product.product_returned==0}
                            [<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" title="{$product.product_tracking}" >Tracking status</a>]
                            {/if}
                            
                            <div class="{$order->order_unique_id}_{$product.order_profile_id}" id="DivIDmessageForm-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none;">
                             	<form action="{geturl controller='communication' action='privatemessage'}" method="post" class="account-privatemessage-form">
                                    <label style="width:50%;">Current time:</label>
                                    <span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span>
                                    <div>
                                    <label  style="width:50%;">Message:</label>
                                    <textarea name="sender_message"></textarea>
                                    {include file='lib/error.tpl' error=''}
                                    </div>
                                    <input name="sender_name" type="hidden" value="{$user->generalInfo->username}" readonly="readonly" />
                                    <input name="sender_email" type="hidden" value="{$user->generalInfo->email}" readonly="readonly" />
                                    <input type="hidden" name="product_id" value="{$product.product_id}"/>
                                    <input type="hidden" name="product_category" value="{$product.product_type}"/>
                                    <input type="hidden" name="product_type" value="{$product.product_market}"/>
                                    <input type="hidden" name="receiver_User_id" value="{$product.buyer_UserID}"/>
                                    <input type="hidden" name="receiver_Username" value="{$product.buyer_Username}"/>
                                    
                                    
									<input type="hidden" name="receiver_name" value="{$product.buyer_Username}" />
                                    <input type="hidden" name="product_name" value="{$product.product_name}" />
                                    <input type="hidden" name="product_tag" value="{$product.product_tag}" />
                                    <input type="hidden" name="sender_subject" value="orderID: {$product.order_unique_id}" />
                                    <input type="hidden" name="product_image_id" value="{$product.product_image_id}"/>
                                    <input type="hidden" name="sender_user_id" value="{$user->generalInfo->userID}" />
                                    <input type="hidden" name="sender_username" value="{$user->generalInfo->username}" />
                                    
                                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
                                </form>
                                {foreach from=$product.messageThreads item=message}
                                    <div class="PrivateMessage" style="float:left; width:100%; padding:0px; border-bottom:none;">
                                        <div class="leftColumnShoutOut" style="width:20%; float:left;">
                                            <div class="publicProductName" >
                                            {if $message.product_type_seller=='generalSeller'}
                        
                                            <a href="{geturl controller='userproductpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$message.product_name}</a>
                                            {else}
                                            <a href="{geturl controller='productpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$message.product_name}</a>
                                            
                                            {/if}
                                                
                                            </div>
                                            <!--<div class="publicProductType">
                                                {$shoutmessage.product_category}
                                            </div>-->
                                        </div>
                                        <div class="rightColumnShoutOut" style="width:75%; float:left;">
                                            <div class="publicProductShoutOutMessageName" >
                                                {$message.sender_name} to {$message.receiver_name}
                                            </div>
                                            <div class="privateMessageSubject">
                                                <span style="font-style:italic;">{$message.sender_subject}</span>
                                            </div>
                                            <div class="publicProductShoutOutMessageContent" >
                                               {$message.sender_message}
                                
                                            </div>
                                            <div class="publicProductShoutOutMessageTime" >
                                                {$message.ts_created|date_format:"%D, %I:%M %p"}
                                            </div>
                                        </div>
                                        <div style="float:right;">
                                            {if $message.product_type_seller=='generalSeller'}
                                            <a href="{geturl controller='userproductpreview' action='details'}?id={$message.product_id}&tag={$message.product_tag}">View Product</a>
                                            {else $message.product_type_seller=='storeSeller'}
                                            <a href="{geturl controller='productpreview' action='details'}?id={$message.product_id}&tag={$message.product_tag}">View Product</a>
                                            {/if}
                                        </div>
                                    </div>
                                {/foreach}
                            </div>
                            {if $product.product_order_status=='unshipped'}
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
                            
                            {elseif $product.product_order_status=='shipped'}
                                 <div class="trackingStatusInfo {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none;"></div>
                                
                            {elseif $product.product_order_status=='return shipped' || ($product.product_order_status=='order return completed')}
                               <div class="trackingStatusInfo {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none;">
								
                                </div>
                                <div class="returnTrackingStatusInfo {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDreturnTrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none;">
                              
                                </div>
                            {elseif $product.product_order_status=='order completed'}
                                <div class="trackingStatusInfo {$order->order_unique_id}_{$product.order_profile_id}" id="DivIDtrackingStatusInfo-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none;">
                                </div>
                            {/if}
						</div>
                    </div>
                    {/foreach}
                   
                </div>
            {/foreach}