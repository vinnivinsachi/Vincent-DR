<?php /* Smarty version 2.6.19, created on 2010-10-04 19:58:16
         compiled from ordermanager/_orders/_DELIVERED.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'ordermanager/_orders/_DELIVERED.tpl', 14, false),array('function', 'geturl', 'ordermanager/_orders/_DELIVERED.tpl', 91, false),array('modifier', 'date_format', 'ordermanager/_orders/_DELIVERED.tpl', 30, false),)), $this); ?>
     <div class='box' style='width:100%;'>
<div style="font-weight:bold; width:500px; float:left;">
                    <div class='tooltipControl' style='float:left; font-size:1.4em; cursor: pointer;'><?php echo $this->_tpl_vars['product']['product_name']; ?>
</div>
                    
                    <div class='tooltip' style='background-color:white; border:none;'> 
		                    		
									<table width="600px;" style='border:none;'>
		                            <tr>
		                            <td><img src='/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['product_tag']; ?>
/<?php echo $this->_tpl_vars['product']['product_image_id']; ?>
.W150_homeFrontFour.jpg'/></td>
		                            <td>
		                            <table>
		                            <?php $_from = $this->_tpl_vars['product']['profile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attributeKey'] => $this->_tpl_vars['attribute']):
?>
		                            <tr>
		                            <td style='width:60%; text-align:right;'><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['attribute']['profile_key']), $this);?>
: </td>
		                            <td style='width:40%; text-align:left;'><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['attribute']['profile_value']), $this);?>
</td>
		                            </tr>
		                            <?php endforeach; endif; unset($_from); ?>
		                            </tr>
		                             <tr>
		                      		<td>Quantity: 1</td>  
									<td class='price'>Price: $<?php echo $this->_tpl_vars['product']['product_price']; ?>
</td> 
									</tr>
		                            </table>
		                            </td>
		                        	</table>
		                           
		                        </div> 
		                        <div class='box'> 
		                        <span style="font-weight:bold; font-size:12px; color:#B1FF91;"><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['order_status']), $this);?>
</span> 
		                        | Ordered on: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['ts_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>

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
			                            Status: <?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['order_status']), $this);?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_delivered_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

			                            </div>
			                            <div class='productShippingInfo' style='float:left; width:30%; text-align:right; width:33%;'>Shipping: <span class='price'>$<?php echo $this->_tpl_vars['product']['current_shipping_rate']; ?>
</span>
			                            </div>
			                        </div>  
		                        </div>
 
 <div class="trackingInfo" style="width:100%; float:left; padding:5px 0px 5px 0px;">
                            <div class="trackingInfoDetails" style="width:50%; float:left;">
                            Tracking: <?php echo $this->_tpl_vars['product']['product_tracking']; ?>
<br />
                            Carrier: <?php echo $this->_tpl_vars['product']['product_tracking_carrier']; ?>
<br />
							Date shipped: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_shipping_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>

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
<a class="anchorOrderMessageSeller" id="anchorID-DivIDmessageForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" >Message seller: <?php echo $this->_tpl_vars['product']['uploader_username']; ?>
 </a>|
								<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" title="<?php echo $this->_tpl_vars['product']['product_tracking']; ?>
">Tracking status</a>


								<?php if ($this->_tpl_vars['product']['return_allowed'] == '1'): ?>
								<div style="float:right;">
									<a class="anchorReturnItem" id="anchorID-DivIDreturnTrackingForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
">Return item</a> |
									<a >Satisfied and write a review</a>
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
                                       
                                        <input type="hidden" name="returnProductId" value="<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" />
                                        <input type="submit" style='margin-left:50%;' value="Return this item" />
                                    </form>
                                </div>    
                                <?php else: ?>
                                <div style="float:right;"><a class="anchorReturnItem" id="anchorID-DivIDreturnTrackingForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
">Wrong item?</a></div>
								<div class="returnTrackingForm <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDreturnTrackingForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="width:100%; float:left; display:none;">
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
                                        <input type="hidden" name="" value="<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" />
                                        <input type="submit" value="File this claim" />
                                    </form>
                                </div>   
                                <?php endif; ?>
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'ordermanager/_orders/_message.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								
								<div class="trackingStatusInfo <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none; float:left;"></div>
								           
								</div>
								
								