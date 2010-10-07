<?php /* Smarty version 2.6.19, created on 2010-10-04 18:46:16
         compiled from ordermanager/_orders/_SHIPPED.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'ordermanager/_orders/_SHIPPED.tpl', 14, false),array('modifier', 'date_format', 'ordermanager/_orders/_SHIPPED.tpl', 32, false),)), $this); ?>
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
Waiting for delivery confirmation			                            </div>
			                            <div class='box' style='width:25%;'>
			                            Status: <?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['order_status']), $this);?>
 <br/> on <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_shipping_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

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
</a> |
								<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" title="<?php echo $this->_tpl_vars['product']['product_tracking']; ?>
">Tracking status</a>



								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'ordermanager/_orders/_message.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				        
								<div class="trackingStatusInfo <?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" id="DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
_<?php echo $this->_tpl_vars['product']['order_profile_id']; ?>
" style="display:none; float:left;">
								</div>
								        
								            
								</div>