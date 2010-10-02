<?php /* Smarty version 2.6.19, created on 2010-09-02 11:45:18
         compiled from ordermanager/vieworderprofiledetails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'ordermanager/vieworderprofiledetails.tpl', 1, false),array('function', 'geturl', 'ordermanager/vieworderprofiledetails.tpl', 66, false),)), $this); ?>
<div class="productMainDiv" style="width:100%; float:left; border-bottom:1px solid #069; margin-bottom:5px; <?php if (((is_array($_tmp=$this->_tpl_vars['product']->product_absolute_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) && $this->_tpl_vars['product']->product_order_status == 'unshipped'): ?> background:#FF3;<?php endif; ?>">
                        <div class="productTopDiv" style="width:100%; float:left;">
                        
                            <div class="orderProductDetails" style="width:50%; float:left">
                                Seller:  <span style="color:#069; font-weight:bold;"><?php echo $this->_tpl_vars['product']->product_Username; ?>
</span>/<?php if ($this->_tpl_vars['product']->product_market == 'generalSeller'): ?>User product<?php else: ?>Custom product<?php endif; ?><br />
                                <span style="font-weight:bold;"><?php echo $this->_tpl_vars['product']->product_name; ?>
<span style="font-weight:bold; <?php if ($this->_tpl_vars['product']->product_order_status == 'shipped'): ?>color:#069;<?php elseif ($this->_tpl_vars['product']->product_order_status == 'return shipped' || ((is_array($_tmp=$this->_tpl_vars['product']->product_absolute_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>color:#F30;<?php elseif ($this->_tpl_vars['product']->product_order_status == 'order completed' || $this->_tpl_vars['product']->product_order_status == 'order return completed'): ?>color:#0C0;<?php else: ?> color:#F90;<?php endif; ?> font-size:12px;"><?php echo $this->_tpl_vars['product']->product_order_status; ?>
</span></span>
                               
                            </div>
                            <div class="orderProductQuanitty" style="width:15%; float:left">1</div>
                            <div class="orderProductPrice" style="width:15%; float:left;"><?php echo $this->_tpl_vars['product']->product_price; ?>
</div>
                            <div class="orderProductRewardPoints" style="width:15%; float:left;"><?php echo $this->_tpl_vars['product']->reward_points; ?>
</div>
                        </div>
                        <div class="productShippingBody">
                            <div class="productSellerInfo" style="float:left; width:50%;">
                           <span style="font-style:italic; color:#F90;">Ship by: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</span>
                            </div>
                            <div class="productOrderQuantity" style="float:left;; width:15%;">Shipping:</div>
                            <div class="productOrderPrice" style="float:left; width:15%;">
                            $<?php echo $this->_tpl_vars['product']->shipping_costs; ?>

                            </div>
                        </div>
                        <div class="orderProductAttributes" style="width:80%; float:left;padding-left:20px;">
                            
                        </div>
                        <?php if ($this->_tpl_vars['product']->product_order_status == 'Cancelled by buyer'): ?>
						<div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            
                            The seller failed to delivery the product before the absolute deadline of <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_absolute_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
.
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                            You have cancelled the order for the following reason: "<?php echo $this->_tpl_vars['product']->cancellation_reason; ?>
"<br />
							You will be refunded in full in the next 2 business days. 
                            </div>
                        </div>
					
                        <?php elseif ($this->_tpl_vars['product']->product_order_status == 'unshipped'): ?>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            <?php if (((is_array($_tmp=$this->_tpl_vars['product']->product_absolute_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>
                            <span style="color:#F30;">The seller failed to deliver this product. You may now CANCEL you order and be refunded.</span>
                           		
                            <?php elseif (((is_array($_tmp=$this->_tpl_vars['product']->product_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>
                            <span style="color:#F90;">Please allow 2 additional days for delivery. If seller fails to ship by <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_absolute_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
, then you will be able to cancel this order and be refunded.</span>
                            <?php endif; ?>
                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                                
                                <?php if (((is_array($_tmp=$this->_tpl_vars['product']->product_absolute_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>
                                <span style="color:#F30;">
                                The seller will still be able to ship this item to you. Please contact the seller before you cancel this order.</span>
                                <?php else: ?>
                                <span style="color:#F90;">
                                Waiting for seller to ship this item by prefered date: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 or absolute latest shipping date: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_absolute_latest_delivery_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php elseif ($this->_tpl_vars['product']->product_order_status == 'shipped'): ?>
                     	<div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left;">
                            Tracking: <?php echo $this->_tpl_vars['product']->product_tracking; ?>
<br />
                            Carrier: <?php echo $this->_tpl_vars['product']->product_tracking_carrier; ?>
<br />
							Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_tracking_shipping_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
							<a href="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'completeorder'), $this);?>
?orderProductId=<?php echo $this->_tpl_vars['product']->order_profile_id; ?>
" class="submitInputButton">Received &amp; complete Order</a><br />
                            <div style="width:100%; float:left;"></div>
                            </div>
                            
                        </div>
                        <?php elseif ($this->_tpl_vars['product']->product_order_status == 'return shipped'): ?>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left;">
                            Tracking: <?php echo $this->_tpl_vars['product']->product_tracking; ?>
<br />
                            Carrier: <?php echo $this->_tpl_vars['product']->product_tracking_carrier; ?>
<br />
							Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_tracking_shipping_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                       	 	</div>
                        </div>
                        <div class="trackingInfo" style="width:100%; float:left;">
                            <div class="trackingInfoDetails" style=" width:50%; float:left; color:#F90;">
                            Return Tracking: <?php echo $this->_tpl_vars['product']->product_returned_tracking; ?>
<br />
                            Return Carrier: <?php echo $this->_tpl_vars['product']->product_returned_tracking_carrier; ?>
<br />
							Return Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_returned_tracking_shipping_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                            </div>
							<div class="trackingActions" style=" width:50%; float:right;">
                            <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for seller to complete order by comfirm returned delivery...</span>
                        	</div>
                        </div>
                        <?php elseif ($this->_tpl_vars['product']->product_order_status == 'order completed'): ?>
                             <div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left;">
                                Tracking: <?php echo $this->_tpl_vars['product']->product_tracking; ?>
<br />
                                Carrier: <?php echo $this->_tpl_vars['product']->product_tracking_carrier; ?>
<br />
                                Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_tracking_shipping_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                <?php if ($this->_tpl_vars['product']->product_returned == 0): ?>
                                <span style="font-size:12px; font-style:italic; color:#090;">You have comfirmed the order and payment will be transfered to this seller.</span>
                                <?php endif; ?>
                                </div>
                            </div>
                        <?php elseif ($this->_tpl_vars['product']->product_order_status == 'order return completed'): ?>
                        	<div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left;">
                                Tracking: <?php echo $this->_tpl_vars['product']->product_tracking; ?>
<br />
                                Carrier: <?php echo $this->_tpl_vars['product']->product_tracking_carrier; ?>
<br />
                                Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_tracking_shipping_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                <?php if ($this->_tpl_vars['product']->product_returned == 0): ?>
                                <span style="font-size:12px; font-style:italic; color:#090;">You have comfirmed the order and payment will be transfered to this seller.</span>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="trackingInfo" style="width:100%; float:left;">
                                <div class="trackingInfoDetails" style="width:50%; float:left; color:#F90;">
                                Return tracking: <?php echo $this->_tpl_vars['product']->product_returned_tracking; ?>
<br />
                                Return carrier: <?php echo $this->_tpl_vars['product']->product_returned_tracking_carrier; ?>
<br />
                                Return date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->product_returned_tracking_shipping_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                                </div>
                                <div class="trackingActions" style="width:50%; float:right;">
                                <?php if ($this->_tpl_vars['product']->refund_to_buyer == '0'): ?>
                                <span style="font-size:12px; font-style:italic; color:#F90;">Waiting for payment to be refunded to you...</span>
                                <?php else: ?>
                                <span style="font-size:12px; font-style:italic; color:#090;">Payments refunded to you.</span>
                                <?php endif; ?>
                                </div>
                            </div>          
                       <?php endif; ?>
           </div>