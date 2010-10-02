<?php /* Smarty version 2.6.19, created on 2010-09-02 15:25:52
         compiled from adminorders/getorderprofiletype.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'adminorders/getorderprofiletype.tpl', 17, false),array('function', 'geturl', 'adminorders/getorderprofiletype.tpl', 36, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table width="100%">
	<tr class='trTitle'>
    	<td>ID:</td>
    	<td>Product Name:</td>
    	<td>Status:</td>
        <td>Buyer:</td>
        <td>Seller:</td>
        <td>Price:</td>
        <td>Shipping:</td>
        <td>RP:</td>
        <td>Delivery date:</td>
        <td>Latest delivery date:</td>
        
     </tr>
<?php $_from = $this->_tpl_vars['orderProfilesType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['orderProfile']):
?>
	<tr <?php if (((is_array($_tmp=$this->_tpl_vars['orderProfile']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) && $this->_tpl_vars['orderProfile']['product_order_status'] == 'unshipped'): ?> bgcolor="#FF3300" <?php elseif (((is_array($_tmp=$this->_tpl_vars['orderProfile']['product_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)) && $this->_tpl_vars['orderProfile']['product_order_status'] == 'unshipped'): ?> bgcolor="#FF9900" <?php elseif ($this->_tpl_vars['orderProfile']['product_order_status'] == 'unshipped'): ?> bgcolor="#009900"<?php endif; ?>>
    	<td><?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
</td>
    	<td><?php echo $this->_tpl_vars['orderProfile']['product_name']; ?>
</td>
    	<td><?php echo $this->_tpl_vars['orderProfile']['order_status']; ?>
</td>
        <td><?php echo $this->_tpl_vars['orderProfile']['buyer_name']; ?>
</td>
        <td><?php echo $this->_tpl_vars['orderProfile']['uploader_username']; ?>
</td>
        <td><?php echo $this->_tpl_vars['orderProfile']['product_price']; ?>
</td>
        <td><?php echo $this->_tpl_vars['orderProfile']['current_shipping_rate']; ?>
</td>
        <td><?php echo $this->_tpl_vars['orderProfile']['reward_points_awarded']; ?>
</td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['orderProfile']['product_warning_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['orderProfile']['product_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</td>
        
   </tr>
   <?php $this->assign('orderStatusControl', $this->_tpl_vars['orderProfile']['order_status']); ?>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "adminorders/_orderStatusControls/_".($this->_tpl_vars['orderStatusControl']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   
   <tr id="AdminOrderProfile-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
-supplimentary">
   		<td colspan="10">
				<div class="adminMessageBuyerDiv <?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" style="width:100%; float:left; display:none;" id="anchorOrderMessageBuyer-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" style="display:none;">
                <form action="<?php echo smarty_function_geturl(array('controller' => 'communication','action' => 'privatemessage'), $this);?>
" method="post" class="account-privatemessage-form">
                    <label style="width:50%;">Current time:</label>
                    <span style="float:left; width:40%;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>
</span>
                    <div>
                    <label  style="width:50%;">Message to buyer:</label>
                    <textarea name="sender_message" rows="8"></textarea>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </div>
                    
                    <input name="sender_name" type="hidden" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->username; ?>
" readonly="readonly" />
                    <input name="sender_email" type="hidden" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->email; ?>
" readonly="readonly" />
                    <input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['orderProfile']['product_id']; ?>
"/>
                    <input type="hidden" name="product_category" value="<?php echo $this->_tpl_vars['orderProfile']['product_type']; ?>
"/>
                    <input type="hidden" name="product_type" value="<?php echo $this->_tpl_vars['orderProfile']['product_market']; ?>
"/>
                    <input type="hidden" name="receiver_User_id" value="<?php echo $this->_tpl_vars['orderProfile']['buyer_UserID']; ?>
"/>
                    <input type="hidden" name="receiver_Username" value="<?php echo $this->_tpl_vars['orderProfile']['buyer_Username']; ?>
"/>
                    <input type="hidden" name="receiver_name" value="<?php echo $this->_tpl_vars['orderProfile']['buyer_Username']; ?>
" />
                    <input type="hidden" name="product_name" value="<?php echo $this->_tpl_vars['orderProfile']['product_name']; ?>
" />
                    <input type="hidden" name="product_tag" value="<?php echo $this->_tpl_vars['orderProfile']['product_tag']; ?>
" />
                    <input type="hidden" name="sender_subject" value="DancewearRialto message: <?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
" />
                    <input type="hidden" name="product_image_id" value="<?php echo $this->_tpl_vars['orderProfile']['product_image_id']; ?>
"/>
                    <input type="hidden" name="sender_user_id" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->userID; ?>
" />
                    <input type="hidden" name="sender_username" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->username; ?>
" />
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
                </form>
    			</div>
                
                <div class="adminMessageSellerDiv <?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" style="width:100%; float:left; display:none;" id="anchorOrderMessageSeller-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" style="display:none;">
                    <form action="<?php echo smarty_function_geturl(array('controller' => 'communication','action' => 'privatemessage'), $this);?>
" method="post" class="account-privatemessage-form">
                    <label style="width:50%;">Current time:</label>
                    <span style="float:left; width:40%;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>
</span>
                    <div>
                    <label style="width:50%;">Message to seller:</label>
                    <textarea name="sender_message" rows="8"></textarea>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </div>
                    <input name="sender_name" type="hidden" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->username; ?>
" readonly="readonly" />
                    <input name="sender_email" type="hidden" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->email; ?>
" readonly="readonly" />
                    <input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['orderProfile']['product_id']; ?>
"/>
                    <input type="hidden" name="product_category" value="<?php echo $this->_tpl_vars['orderProfile']['product_type']; ?>
"/>
                    <input type="hidden" name="product_type" value="<?php echo $this->_tpl_vars['orderProfile']['product_market']; ?>
"/>
                    <input type="hidden" name="receiver_User_id" value="<?php echo $this->_tpl_vars['orderProfile']['product_UserId']; ?>
"/>
                    <input type="hidden" name="receiver_Username" value="<?php echo $this->_tpl_vars['orderProfile']['product_Username']; ?>
"/>
                    <input type="hidden" name="receiver_name" value="<?php echo $this->_tpl_vars['orderProfile']['product_Username']; ?>
" />
                    <input type="hidden" name="product_name" value="<?php echo $this->_tpl_vars['orderProfile']['product_name']; ?>
" />
                    <input type="hidden" name="product_tag" value="<?php echo $this->_tpl_vars['orderProfile']['product_tag']; ?>
" />
                    <input type="hidden" name="sender_subject" value="DancewearRialto message: <?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
" />
                    <input type="hidden" name="product_image_id" value="<?php echo $this->_tpl_vars['orderProfile']['product_image_id']; ?>
"/>
                    <input type="hidden" name="sender_user_id" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->userID; ?>
" />
                    <input type="hidden" name="sender_username" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->username; ?>
" />
                    
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
                </form>
            </div>
            <div class="anchorMessageThread <?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" style="width:100%; float:left; display:none;" id="anchorMessageThread-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" style="display:none;">
            
            </div>
           	<div class="DivIDtrackingStatusInfo <?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" id="DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" style="display:none;"></div>
            </div>
            <div class="DivIDreturnTrackingStatusInfo <?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" id="DivIDreturnTrackingStatusInfo-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" style="display:none;"></div>
        </td>
   </tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php echo '
<script type="text/javascript">

new adminOrderToggle(\'.anchorOrderMessageBuyer\', \'.anchorOrderMessageSeller\', \'.anchorMessageThread\', \'.anchorTrackingStatus\', \'.anchorReturnTrackingStatus\', \'currentStatus\');

</script>
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>