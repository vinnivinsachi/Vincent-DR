<div class="productMainDiv" style="width:100%; float:left; border-bottom:1px solid #069; margin-bottom:5px; {if $product->product_absolute_latest_delivery_date|date_format < $smarty.now|date_format && $product->product_order_status=='unshipped'} background:#FF3;{/if}">
                        <div class="productTopDiv" style="width:100%; float:left;">
                        
                            <div class="orderProductDetails" style="width:50%; float:left">
                                Seller:  <span style="color:#069; font-weight:bold;">{$product->product_Username}</span>/{if $product->product_market=='generalSeller'}User product{else if $product->product_market=='storeSeller'}Custom product{/if}<br />
                                <span style="font-weight:bold;">{$product->product_name}<span style="font-weight:bold; {if $product->product_order_status=='shipped'}color:#069;{elseif $product->product_order_status=='return shipped' || $product->product_absolute_latest_delivery_date|date_format < $smarty.now|date_format}color:#F30;{elseif $product->product_order_status=='order completed' || $product->product_order_status=='order return completed'}color:#0C0;{else} color:#F90;{/if} font-size:12px;">{$product->product_order_status}</span></span>
                               
                            </div>
                            <div class="orderProductQuanitty" style="width:15%; float:left">1</div>
                            <div class="orderProductPrice" style="width:15%; float:left;">{$product->product_price}</div>
                            <div class="orderProductRewardPoints" style="width:15%; float:left;">{$product->reward_points}</div>
                        </div>
                        <div class="productShippingBody">
                            <div class="productSellerInfo" style="float:left; width:50%;">
                           <span style="font-style:italic; color:#F90;">Ship by: {$product->product_latest_delivery_date|date_format:"%D"}</span>
                            </div>
                            <div class="productOrderQuantity" style="float:left;; width:15%;">Shipping:</div>
                            <div class="productOrderPrice" style="float:left; width:15%;">
                            ${$product->shipping_costs}
                            </div>
                        </div>
                        <div class="orderProductAttributes" style="width:80%; float:left;padding-left:20px;">
                            
                        </div>
                        {if $product->product_order_status=='Cancelled by buyer'}
						<div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            
                            The seller failed to delivery the product before the absolute deadline of {$product->product_absolute_latest_delivery_date|date_format}.
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                            You have cancelled the order for the following reason: "{$product->cancellation_reason}"<br />
							You will be refunded in full in the next 2 business days. 
                            </div>
                        </div>
					
                        {elseif $product->product_order_status=='unshipped'}
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            {if $product->product_absolute_latest_delivery_date|date_format < $smarty.now|date_format}
                            <span style="color:#F30;">The seller failed to deliver this product. You may now CANCEL you order and be refunded.</span>
                           		
                            {elseif $product->product_latest_delivery_date|date_format < $smarty.now|date_format}
                            <span style="color:#F90;">Please allow 2 additional days for delivery. If seller fails to ship by {$product->product_absolute_latest_delivery_date|date_format}, then you will be able to cancel this order and be refunded.</span>
                            {/if}
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                                
                                {if $product->product_absolute_latest_delivery_date|date_format < $smarty.now|date_format}
                                <span style="color:#F30;">
                                The seller will still be able to ship this item to you. Please contact the seller before you cancel this order.</span>
                                {else}
                                <span style="color:#F90;">
                                Waiting for seller to ship this item by prefered date: {$product->product_latest_delivery_date|date_format} or absolute latest shipping date: {$product->product_absolute_latest_delivery_date|date_format}</span>
                                {/if}
                            </div>
                        </div>
                        {elseif $product->product_order_status=='shipped'}
                     	<div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left;">
                            Tracking: {$product->product_tracking}<br />
                            Carrier: {$product->product_tracking_carrier}<br />
							Date shipped: {$product->product_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
							<a href="{geturl controller='ordermanager' action='completeorder'}?orderProductId={$product->order_profile_id}" class="submitInputButton">Received &amp; complete Order</a><br />
                            <div style="width:100%; float:left;"></div>
                            </div>
                            
                        </div>
                        {elseif $product->product_order_status=='return shipped'}
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left;">
                            Tracking: {$product->product_tracking}<br />
                            Carrier: {$product->product_tracking_carrier}<br />
							Date shipped: {$product->product_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                       	 	</div>
                        </div>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left; color:#F90;">
                            Return Tracking: {$product->product_returned_tracking}<br />
                            Return Carrier: {$product->product_returned_tracking_carrier}<br />
							Return Date shipped: {$product->product_returned_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                            <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for seller to complete order by comfirm returned delivery...</span>
                        	</div>
                        </div>
                        {elseif $product->product_order_status=='order completed'}
                             <div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left;">
                                Tracking: {$product->product_tracking}<br />
                                Carrier: {$product->product_tracking_carrier}<br />
                                Date shipped: {$product->product_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                {if $product->product_returned==0}
                                <span style="font-size:12px; font-style:italic; color:#090;">You have comfirmed the order and payment will be transfered to this seller.</span>
                                {/if}
                                </div>
                            </div>
                        {elseif $product->product_order_status=='order return completed'}
                        	<div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left;">
                                Tracking: {$product->product_tracking}<br />
                                Carrier: {$product->product_tracking_carrier}<br />
                                Date shipped: {$product->product_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                {if $product->product_returned==0}
                                <span style="font-size:12px; font-style:italic; color:#090;">You have comfirmed the order and payment will be transfered to this seller.</span>
                                {/if}
                                </div>
                            </div>
                            <div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left; color:#F90;">
                                Return tracking: {$product->product_returned_tracking}<br />
                                Return carrier: {$product->product_returned_tracking_carrier}<br />
                                Return date shipped: {$product->product_returned_tracking_shipping_date|date_format:"%D, %I:%M %p"}
                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                {if $product->refund_to_buyer=='0'}
                                <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for payment to be refunded to you...</span>
                                {else}
                                <span style="font-size:12px; font-style:italic; color:#090;">Payments refunded to you.</span>
                                {/if}
                                </div>
                            </div>          
                       {/if}
           </div>