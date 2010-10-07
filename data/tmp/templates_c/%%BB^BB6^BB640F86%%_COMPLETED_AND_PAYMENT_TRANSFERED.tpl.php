<?php /* Smarty version 2.6.19, created on 2010-10-02 17:57:20
         compiled from ordermanager/_soldOrders/_COMPLETED_AND_PAYMENT_TRANSFERED.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'ordermanager/_soldOrders/_COMPLETED_AND_PAYMENT_TRANSFERED.tpl', 14, false),array('modifier', 'date_format', 'ordermanager/_soldOrders/_COMPLETED_AND_PAYMENT_TRANSFERED.tpl', 29, false),)), $this); ?>
     <div class='box' style='width:100%;'>
<div style="font-weight:bold; width:500px; float:left;">
                    <div class='tooltipControl' style='float:left; font-size:1.4em; cursor: pointer; '><?php echo $this->_tpl_vars['product']['product_name']; ?>
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
		                        <span style="font-weight:bold; <?php if ($this->_tpl_vars['product']['product_order_status'] == 'SHIPPED'): ?>color:#069;<?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'RETURN_SHIPPED' || ((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp))): ?>color:#F30;<?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'order completed' || $this->_tpl_vars['product']['product_order_status'] == 'order return completed'): ?>color:#0C0;<?php else: ?> color:#F90;<?php endif; ?> font-size:12px; "><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['order_status']), $this);?>
</span> 
		                        
		                        | 
		                        <span style=''><a>Cancel this order</a></span> 
		                        | Ordered on: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['ts_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>

		                        </div>
		                        
                        </div>
    
    
    
    </div>
    
    
     <div class="productMainDiv box" style=" float:left; padding-top: 10px; margin-bottom:5px; ">
 
 <div class="productShippingBody">
 
			                        <div class='orderStatus bigFont box' style='padding:5px 0px 5px 0px; background-color:#ccc;'>
			                        <div class="productSellerInfo" style="float:left; padding-left:10px; width:20%;">
Completed		                            </div>
			                            <div class='box' style='width:58%;'>
			                            Status: <?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['order_status']), $this);?>
 <br/>on <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_fund_allocation_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

			                            </div>
			                            <div class='productShippingInfo' style='float:left; width:30%; text-align:right; width:20%;'>Shipping: <span class='price'>$<?php echo $this->_tpl_vars['product']['current_shipping_rate']; ?>
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
" >Message buyer: <?php echo $this->_tpl_vars['product']['buyer_name']; ?>
</a>
								                            
								
								    
								    
								        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'ordermanager/_soldOrders/_message.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								            
								 </div>