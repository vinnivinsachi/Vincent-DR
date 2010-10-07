<?php /* Smarty version 2.6.19, created on 2010-10-02 18:22:30
         compiled from ordermanager/_soldOrders/_UNSHIPPED.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'ordermanager/_soldOrders/_UNSHIPPED.tpl', 14, false),array('function', 'geturl', 'ordermanager/_soldOrders/_UNSHIPPED.tpl', 94, false),array('modifier', 'date_format', 'ordermanager/_soldOrders/_UNSHIPPED.tpl', 33, false),)), $this); ?>
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
		                        <div class='box orderProductSecondHeader'> 
		                        <span style="font-weight:bold; color:#F90; font-size:12px; "><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['order_status']), $this);?>
</span> 
		                        
		                        | 
		                        <span style=''><a>Cancel this order</a></span> 
		                        | Ordered on: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['ts_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>

		                        </div>
		                        
                        </div>
    
    <?php if (( ((is_array($_tmp=$this->_tpl_vars['product']['product_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) ) < ( ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) )): ?>
    
    <div class='tooltipControl' style="width:100px; float:right;"><img src="/public/resources/css/images/exclamation_mark.jpg"/></div>
	<div class='tooltip' style='width:300px;'>
    
    <div class="trackingStatusInfo" style="width:100%; float:left;">
        <span style="color:#F30; ">Please ship this order ASAP and submit a tracking info! Message this buyer to prevent any miscommunications. <br/>The buyer is now able to cancel this order and be refunded. <br/>
        Once the order is cancelled by the buyer, you will not be able to submit a tracking info and be paid.</span>
    </div>
    
    	<?php endif; ?>
    
    
    </div>
    
    </div>
    
    
     <div class="productMainDiv box" style=" float:left; padding-top: 10px;  margin-bottom:5px; ">
		                       <div class="productShippingBody">
			                        <div class='orderStatus bigFont box' style='padding:5px 0px 5px 0px; background-color:#FFE877;'>
			                        <div class="productSellerInfo" style="float:left; padding-left:10px; width:40%;">
			                           Please make shipment by: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_warning_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>

			                            </div>
			                            <div class='box' style='width:25%;'>
			                            Status: <?php echo $this->_tpl_vars['product']['order_status']; ?>

			                            </div>
			                            <div class='productShippingInfo' style='float:left; width:30%; text-align:right; width:33%;'>Shipping: <span class='price'>$<?php echo $this->_tpl_vars['product']['current_shipping_rate']; ?>
</span>
			                            </div>
			                        </div>  
		                        </div>
                       			
	                        	
	                        	
	                       
                   	 		</div>
                   	 		
    
    <div class="trackingInfo" style="width:100%; float:left; padding:5px 0px 5px 0px;">
								    <div class="trackingInfoDetails box" >
								    <?php if (((is_array($_tmp=$this->_tpl_vars['product']['product_warning_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) && ((is_array($_tmp=$this->_tpl_vars['product']['product_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d"))): ?>
								    	<span style="color:#F30; font-size:1.2em; padding-left:10px;">This product is now past due. The buyer will be able to cancel this order and be refunded. If the order is cancelled, you will no longer be able to provide any tracking information.</span>
								    <?php else: ?>
								        <span style="padding-left:10px;"> Please submit a tracking info! The buyer will be able to cancel this order if this order is not shipped before <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
.</span>
								    <?php endif; ?>
								    </div>
									<div class="trackingActions" style="width:50%; float:right;">
								    </div>
								</div>
								
								<div class="orderProductFormSection" style="width:100%; float:left; ">
								<a class="anchorOrderMessageSeller" id="anchorID-DivIDmessageForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" >Message buyer: <?php echo $this->_tpl_vars['product']['buyer_name']; ?>
</a>
								                            
								<div style="float:right;"><a class="anchorTrackingForm" id="anchorID-DivIDtrackingForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
">Submit tracking info</a></div>
								
								    <div class="TrackingForm <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDtrackingForm-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="width:100%; float:left; display:none;">
								        <form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'addtrackingtoproduct'), $this);?>
">
								            <label style="width:50%;">Tracking #:</label>
								            <input type="text" name="productTracking" value=""/><br />
								            <label style="width:50%;">Tracking Carrier:</label>
								            <select name="productCarrier">
								                <option value="USPS">USPS</option>
								                <option value="FEDEX">FEDEX</option>
								                <option value="UPS">UPS</option>
								            </select>
								            <input type="hidden" name="productId" value="<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" />
								            <input type="submit" value="Add tracking info" />
								        </form>
								    </div>  
								    
								        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'ordermanager/_soldOrders/_message.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								            
								 </div>
						