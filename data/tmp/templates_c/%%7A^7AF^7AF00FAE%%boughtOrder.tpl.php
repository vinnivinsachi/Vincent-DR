<?php /* Smarty version 2.6.19, created on 2010-08-29 17:06:07
         compiled from partials/ordermanager/boughtOrder.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'partials/ordermanager/boughtOrder.tpl', 5, false),array('function', 'geturl', 'partials/ordermanager/boughtOrder.tpl', 90, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['order']):
?>
            	<div class="orderMainDiv" id="orderMainDiv-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
" style=" background-color:#F0F0F0; width:99%; float:left; margin-bottom:10px;">
                	<div class="orderHistoryTitle" style=" width:100%; float:left; background-color:#666; color:#FFF;">
                        <div class="orderId" style="width:50%; float:left;">Order id: <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
</div>
                        <div class="orderId" style="width:50%; float:right; text-align:right;">Created time: <?php echo ((is_array($_tmp=$this->_tpl_vars['order']->ts_created)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>
</div>
                    </div>
                    <div class="orderDeliveryAddress" style="width:100%; float:right; text-align:right; font-style:italic;">
                        Deliver to: <?php echo $this->_tpl_vars['order']->buyer_name; ?>
<br />
                        <?php echo $this->_tpl_vars['order']->shippingAddress->address_one; ?>
<br />
                        <?php if ($this->_tpl_vars['order']->shippingAddress->address_two != ''): ?>
                            <?php echo $this->_tpl_vars['order']->shippingAddress->address_two; ?>
<br />
                        <?php endif; ?>
                        <?php echo $this->_tpl_vars['order']->shippingAddress->city; ?>
 <?php echo $this->_tpl_vars['order']->shippingAddress->state; ?>
, <?php echo $this->_tpl_vars['order']->shippingAddress->zip; ?>
<br />
                        <?php echo $this->_tpl_vars['order']->shippingAddress->country; ?>
<br />
                    </div>
                    <div style="width:50%; float:left">Product details</div>
                    <div style="width:15%; float:left">Quantity</div>
                    <div style="width:15%; float:left">Price</div>
                    <div style="width:20%; float:left">+ Reward points</div>
                    
                    <?php $_from = $this->_tpl_vars['order']->products; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['productKey'] => $this->_tpl_vars['product']):
?>
                    <div class="productMainDiv" style="width:100%; float:left; border-bottom:1px solid #069; margin-bottom:5px; <?php if (((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) && $this->_tpl_vars['product']['product_order_status'] == 'unshipped'): ?> background:#FF3;<?php endif; ?>">
                        <div class="productTopDiv" style="width:100%; float:left;">
                        
                            <div class="orderProductDetails" style="width:50%; float:left">
                                Seller:  <span style="color:#069; font-weight:bold;"><?php echo $this->_tpl_vars['product']['product_Username']; ?>
</span>/<?php if ($this->_tpl_vars['product']['product_market'] == 'generalSeller'): ?>User product<?php else: ?>Custom product<?php endif; ?><br />
                                <span style="font-weight:bold;"><?php echo $this->_tpl_vars['product']['product_name']; ?>
<span style="font-weight:bold; <?php if ($this->_tpl_vars['product']['product_order_status'] == 'shipped'): ?>color:#069;<?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'return shipped' || ((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>color:#F30;<?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'completed' || $this->_tpl_vars['product']['product_order_status'] == 'order return completed'): ?>color:#0C0;<?php else: ?> color:#F90;<?php endif; ?> font-size:12px;"><?php echo $this->_tpl_vars['product']['product_order_status']; ?>
</span></span>
                               
                            </div>
                            <div class="orderProductQuanitty" style="width:15%; float:left">1</div>
                            <div class="orderProductPrice" style="width:15%; float:left;"><?php echo $this->_tpl_vars['product']['product_price']; ?>
</div>
                            <div class="orderProductRewardPoints" style="width:15%; float:left;"><?php echo $this->_tpl_vars['product']['reward_points']; ?>
</div>
                        </div>
                        <div class="productShippingBody">
                            <div class="productSellerInfo" style="float:left; width:50%;">
                           <span style="font-style:italic; color:#F90;">Ship by: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</span>
                            </div>
                            <div class="productOrderQuantity" style="float:left;; width:15%;">Shipping:</div>
                            <div class="productOrderPrice" style="float:left; width:15%;">
                            $<?php echo $this->_tpl_vars['product']['shipping_costs']; ?>

                            </div>
                        </div>
                        <div class="orderProductAttributes" style="width:80%; float:left;padding-left:20px;">
                            <?php $_from = $this->_tpl_vars['product']['profile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attributeKey'] => $this->_tpl_vars['attribute']):
?>
                            <label style="width:150px;"><?php echo $this->_tpl_vars['attribute']['profile_key']; ?>
: </label>
                            <span><?php echo $this->_tpl_vars['attribute']['profile_value']; ?>
</span><br />
                            <?php endforeach; endif; unset($_from); ?>
                        </div>
                        <?php if ($this->_tpl_vars['product']['product_order_status'] == 'Cancelled by buyer'): ?>
						<div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            
                            The seller failed to delivery the product before the absolute deadline of <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
.
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                            You have cancelled the order for the following reason: "<?php echo $this->_tpl_vars['product']['cancellation_reason']; ?>
"<br />
							You will be refunded in full in the next 2 business days. 
                            </div>
                        </div>
					
                        <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'unshipped'): ?>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            <?php if (((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>
                            <span style="color:#F30;">The seller failed to deliver this product. You may now CANCEL you order and be refunded.</span>
                           		
                            <?php elseif (((is_array($_tmp=$this->_tpl_vars['product']['product_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>
                            <span style="color:#F90;">Please allow 2 additional days for delivery. If seller fails to ship by <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
, then you will be able to cancel this order and be refunded.</span>
                            <?php endif; ?>
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                                
                                <?php if (((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>
                                <span style="color:#F30;">
                                The seller will still be able to ship this item to you. Please contact the seller before you cancel this order.</span>
                                <?php else: ?>
                                <span style="color:#F90;">
                                Waiting for seller to ship this item by prefered date: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 or absolute latest shipping date: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'shipped'): ?>
                     	<div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left;">
                            Tracking: <?php echo $this->_tpl_vars['product']['product_tracking']; ?>
<br />
                            Carrier: <?php echo $this->_tpl_vars['product']['product_tracking_carrier']; ?>
<br />
							Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_tracking_shipping_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
							<a href="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'completeorder'), $this);?>
?orderProductId=<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" class="submitInputButton">Received &amp; complete Order</a><br />
                            <div style="width:100%; float:left;"></div>
                            </div>
                            
                        </div>
                        <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'return shipped'): ?>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left;">
                            Tracking: <?php echo $this->_tpl_vars['product']['product_tracking']; ?>
<br />
                            Carrier: <?php echo $this->_tpl_vars['product']['product_tracking_carrier']; ?>
<br />
							Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_tracking_shipping_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                       	 	</div>
                        </div>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left; color:#F90;">
                            Return Tracking: <?php echo $this->_tpl_vars['product']['product_returned_tracking']; ?>
<br />
                            Return Carrier: <?php echo $this->_tpl_vars['product']['product_returned_tracking_carrier']; ?>
<br />
							Return Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_returned_tracking_shipping_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                            <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for seller to complete order by comfirm returned delivery...</span>
                        	</div>
                        </div>
                        <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'completed'): ?>
                             <div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left;">
                                Tracking: <?php echo $this->_tpl_vars['product']['product_tracking']; ?>
<br />
                                Carrier: <?php echo $this->_tpl_vars['product']['product_tracking_carrier']; ?>
<br />
                                Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_tracking_shipping_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                <?php if ($this->_tpl_vars['product']['product_returned'] == 0): ?>
                                <span style="font-size:12px; font-style:italic; color:#090;">You have comfirmed the order and payment will be transfered to this seller.</span>
                                <?php endif; ?>
                                </div>
                            </div>
                        <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'order return completed'): ?>
                        	<div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left;">
                                Tracking: <?php echo $this->_tpl_vars['product']['product_tracking']; ?>
<br />
                                Carrier: <?php echo $this->_tpl_vars['product']['product_tracking_carrier']; ?>
<br />
                                Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_tracking_shipping_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                <?php if ($this->_tpl_vars['product']['product_returned'] == 0): ?>
                                <span style="font-size:12px; font-style:italic; color:#090;">You have comfirmed the order and payment will be transfered to this seller.</span>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left; color:#F90;">
                                Return tracking: <?php echo $this->_tpl_vars['product']['product_returned_tracking']; ?>
<br />
                                Return carrier: <?php echo $this->_tpl_vars['product']['product_returned_tracking_carrier']; ?>
<br />
                                Return date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_returned_tracking_shipping_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                <?php if ($this->_tpl_vars['product']['refund_to_buyer'] == '0'): ?>
                                <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for payment to be refunded to you...</span>
                                <?php else: ?>
                                <span style="font-size:12px; font-style:italic; color:#090;">Payments refunded to you.</span>
                                <?php endif; ?>
                                </div>
                            </div>          
                           
                        <?php endif; ?>
                  		<div class="orderProductFormSection" style="width:100%; float:left;">
                        	[<a class="anchorOrderMessageSeller" id="anchorID-DivIDmessageForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" >Message seller: <?php echo $this->_tpl_vars['product']['product_Username']; ?>
</a>]
                            <?php if ($this->_tpl_vars['product']['product_order_status'] == 'unshipped' && ( ((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) )): ?>
                            <div style="float:right;">[<a class="anchorOrderCancelled" id="anchorID-DivIDorderCancelledForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
">Cancel order</a>]</div>	
                            <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'shipped'): ?>
                            [<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" title="<?php echo $this->_tpl_vars['product']['product_tracking']; ?>
" >Tracking status</a>] <div style="float:right;">[<a class="anchorReturnItem" id="anchorID-DivIDreturnTrackingForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
">Return item</a>]</div>
                            <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'return shipped' || ( $this->_tpl_vars['product']['product_order_status'] == 'order return completed' && $this->_tpl_vars['product']['product_returned'] == 1 )): ?>
                            [<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" title="<?php echo $this->_tpl_vars['product']['product_tracking']; ?>
" >Tracking status</a>][<a class="anchorReturnTrackingStatus" id="anchorID-DivIDreturnTrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" title="<?php echo $this->_tpl_vars['product']['product_tracking']; ?>
">Return tracking status</a>]
                            <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'completed' && $this->_tpl_vars['product']['product_returned'] == 0): ?>
                            [<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" title="<?php echo $this->_tpl_vars['product']['product_tracking']; ?>
">Tracking status</a>]
                            	<?php if ($this->_tpl_vars['product']['seller_review_written'] == 0): ?>
                            <div style="float:right; color:#090;">[<a class="anchorProductReview" id="anchorID-DivIDproductReview-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
">Write a review (+8 reward points)</a>]</div><?php else: ?> <div style="float:right;">Review written</div><?php endif; ?>
                            
                            <?php endif; ?>
                           
                            <div class="<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDmessageForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none;">
                             	<form action="<?php echo smarty_function_geturl(array('controller' => 'communication','action' => 'privatemessage'), $this);?>
" method="post" class="account-privatemessage-form">
                                    <label style="width:50%;">Current time:</label>
                                    <span style="float:left; width:40%;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>
</span>
                                    <div>
                                    <label style="width:50%;">Message:</label>
                                    <textarea name="sender_message"></textarea>
                                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                    </div>
                                    <input name="sender_name" type="hidden" value="<?php echo $this->_tpl_vars['user']->generalInfo->username; ?>
" readonly="readonly" />
                                    <input name="sender_email" type="hidden" value="<?php echo $this->_tpl_vars['user']->generalInfo->email; ?>
" readonly="readonly" />
                                    <input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['product']['product_id']; ?>
"/>
                                    <input type="hidden" name="product_category" value="<?php echo $this->_tpl_vars['product']['product_type']; ?>
"/>
                                    <input type="hidden" name="product_type" value="<?php echo $this->_tpl_vars['product']['product_market']; ?>
"/>
                                    <input type="hidden" name="receiver_User_id" value="<?php echo $this->_tpl_vars['product']['product_UserId']; ?>
"/>
                                    <input type="hidden" name="receiver_Username" value="<?php echo $this->_tpl_vars['product']['product_Username']; ?>
"/>
                               
									<input type="hidden" name="receiver_name" value="<?php echo $this->_tpl_vars['product']['product_Username']; ?>
" />
                                    <input type="hidden" name="product_name" value="<?php echo $this->_tpl_vars['product']['product_name']; ?>
" />
                                    <input type="hidden" name="product_tag" value="<?php echo $this->_tpl_vars['product']['product_tag']; ?>
" />
                                    <input type="hidden" name="sender_subject" value="orderID: <?php echo $this->_tpl_vars['product']['order_unique_id']; ?>
" />
                                    <input type="hidden" name="product_image_id" value="<?php echo $this->_tpl_vars['product']['product_image_id']; ?>
"/>
                                    <input type="hidden" name="sender_user_id" value="<?php echo $this->_tpl_vars['user']->generalInfo->userID; ?>
" />
                                    <input type="hidden" name="sender_username" value="<?php echo $this->_tpl_vars['user']->generalInfo->username; ?>
" />
                                    
                                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
                                </form>
                                
                                <?php $_from = $this->_tpl_vars['product']['messageThreads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
                                    <div class="PrivateMessage" style="float:left; width:100%; padding:0px; border-bottom:none;">
                                        <div class="leftColumnShoutOut" style="width:20%; float:left;">
                                            <div class="publicProductName" >
                                            <?php if ($this->_tpl_vars['message']['product_type_seller'] == 'generalSeller'): ?>
                        
                                            <a href="<?php echo smarty_function_geturl(array('controller' => 'userproductpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
"><?php echo $this->_tpl_vars['message']['product_name']; ?>
</a>
                                            <?php else: ?>
                                            <a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
"><?php echo $this->_tpl_vars['message']['product_name']; ?>
</a>
                                            
                                            <?php endif; ?>
                                                
                                            </div>
                                            <!--<div class="publicProductType">
                                                <?php echo $this->_tpl_vars['shoutmessage']['product_category']; ?>

                                            </div>-->
                                        </div>
                                        <div class="rightColumnShoutOut" style="width:75%; float:left;">
                                            <div class="publicProductShoutOutMessageName" >
                                                <?php echo $this->_tpl_vars['message']['sender_name']; ?>
 to <?php echo $this->_tpl_vars['message']['receiver_name']; ?>

                                            </div>
                                            <div class="privateMessageSubject">
                                                <span style="font-style:italic;"><?php echo $this->_tpl_vars['message']['sender_subject']; ?>
</span>
                                            </div>
                                            <div class="publicProductShoutOutMessageContent" >
                                               <?php echo $this->_tpl_vars['message']['sender_message']; ?>

                                
                                            </div>
                                            <div class="publicProductShoutOutMessageTime" >
                                                <?php echo ((is_array($_tmp=$this->_tpl_vars['message']['ts_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                                            </div>
                                        </div>
                                        <div style="float:right;">
                                            <?php if ($this->_tpl_vars['message']['product_type_seller'] == 'generalSeller'): ?>
                                            <a href="<?php echo smarty_function_geturl(array('controller' => 'userproductpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['message']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['message']['product_tag']; ?>
">View Product</a>
                                            <?php else: ?>
                                            <a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['message']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['message']['product_tag']; ?>
">View Product</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; endif; unset($_from); ?> 
                            </div>
                            <?php if ($this->_tpl_vars['product']['product_order_status'] == 'unshipped' && ( ((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) )): ?>
                            	<div class="OrderCancelledForm <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDorderCancelledForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="width:100%; float:left; display:none;">
                                    <form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'ordercancellationbybuyer'), $this);?>
">
                                        <label style="width:50%;">Cancellation Reason:</label>
                                        <textarea name="cancellationReason"></textarea>                   
                                        <input type="hidden" name="productId" value="<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" />
                                        <input type="submit" class="submitInputButton" value="Cancel this order" style="margin-left:50%; float:left;" />
                                    </form>
                                </div>
                            <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'shipped'): ?>
                                 <div class="trackingStatusInfo <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none; width:100%;">
                                </div>
                                <div class="returnTrackingForm <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDreturnTrackingForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="width:100%; float:left; display:none;">
                                    <form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'addtrackingtoreturnproduct'), $this);?>
">
                                        <label style="width:50%;">Return Tracking #:</label>
                                        <input type="text" name="returnProductTracking" value=""/><br />
                                        <label style="width:50%;">Return Tracking Carrier:</label>
                                        <select name="returnProductCarrier">
                                            <option value="USPS">USPS</option>
                                            <option value="FEDEX">FEDEX</option>
                                            <option value="UPS">UPS</option>
                                        </select>
                                        <input type="hidden" name="returnProductId" value="<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" />
                                        <input type="submit" value="Add tracking info" />
                                    </form>
                                </div>
                            <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'return shipped' || ( $this->_tpl_vars['product']['product_order_status'] == 'order return completed' && $this->_tpl_vars['product']['product_returned'] == 1 )): ?>
                                <div class="trackingStatusInfo <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none;">
								
                                </div>
                                <div class="returnTrackingStatusInfo <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDreturnTrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none;">
                              
                                </div>
                            <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'completed' && $this->_tpl_vars['product']['product_returned'] == 0 && $this->_tpl_vars['product']['seller_review_written'] == 0): ?>
                                <div class="trackingStatusInfo <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none;">
                                </div>
                                <div class="productReviewForm <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDproductReview-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none;">
                                	<form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'writereview'), $this);?>
">
                                        <label style="width:50%;">Write a review: (+8 reward points)</label>
                                        <div style="float:left; width:49%; font-style:italic;"> Please describe your experience with the product and this seller:</div><br />
                                        <textarea name="productReview" style="margin-left:50%; float:left;"></textarea>      
                                        <select name="starRating" style="margin-left:50%; float:left;">
                                        <option value="5">5 stars</option>
                                        <option value="4.5">4.5 stars</option>
                                        <option value="4">4 stars</option>
                                        <option value="3.5">3.5 stars</option>
                                        <option value="3">3 stars</option>
                                        </select>             
                                        <input type="hidden" name="productId" value="<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" />
                                        <input type="submit" class="submitInputButton" value="Submit review" style="margin-left:50%; float:left;" />
                                    </form>
                                </div>
                            
                            <?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'completed'): ?>
                            	<div class="trackingStatusInfo <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php endforeach; endif; unset($_from); ?>
                    <div class="totalCartMotherDiv" style="width:100%; float:left; border-bottom:1px solid #069;">
                        <div class="cartCost" style="width:100%; float:left;">
                            <div class="productSellerInfo" style="float:left; width:50%;">Cart Costs</div>
                            <div class="productOrderQuantity" style="float:left;; width:15%;">.</div>
                            <div class="productOrderPrice" style="float:left; width:15%;">$<?php echo $this->_tpl_vars['order']->total_costs; ?>
</div>
                            <div class="productOrderRewardPoints" style="float:left; width:15%;">+ <?php echo $this->_tpl_vars['order']->total_reward_points; ?>
 point(s)</div>
                        </div>	
                            
                        <div class="cartCost" style="width:100%; float:left;" >
                            <div class="productSellerInfo" style="float:left; width:50%;">Reward points used:</div>
                            <div class="productOrderQuantity" style="float:left;; width:15%;">- <?php echo $this->_tpl_vars['order']->reward_points_used; ?>
 points</div>
                            <div class="productOrderPrice" style="float:left; width:15%; color:#F00;">-$<?php echo $this->_tpl_vars['order']->reward_amount_deducted; ?>
</div>
                            <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
                        </div>
                        <div class="cartCost" style="width:100%; float:left;" >
                            <div class="productSellerInfo" style="float:left; width:50%;">Promotions:</div>
                            <div class="productOrderQuantity" style="float:left;; width:15%;">Code:<?php echo $this->_tpl_vars['order']->promotion_code_used; ?>
</div>
                            <div class="productOrderPrice" style="float:left; width:15%; color:#F00;">-$<?php echo $this->_tpl_vars['order']->promotion_amount_deducted; ?>
</div>
                            <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
                        </div>
                    </div>
                    <div class="totalCartMotherPrice" style=" background-color:#999; color:#FFF; width:100%; float:left; border-bottom:1px solid #069; font-weight:bold;">
                        <div class="cartCost" style="width:100%; float:left;" >
                            <div class="productSellerInfo" style="float:left; width:50%;">Grand Total:</div>
                            <div class="productOrderQuantity" style="float:left;; width:15%;">Recalc:</div>
                            <div class="productOrderPrice" style="float:left; width:15%;">$<?php echo $this->_tpl_vars['order']->final_total_costs; ?>
</div>
                            <div class="productOrderRewardPoints" style="float:left; width:15%;">+ <?php echo $this->_tpl_vars['order']->total_reward_points; ?>
 points</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; unset($_from); ?>