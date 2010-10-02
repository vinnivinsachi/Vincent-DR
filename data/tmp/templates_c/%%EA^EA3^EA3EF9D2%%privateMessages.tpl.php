<?php /* Smarty version 2.6.19, created on 2010-08-09 21:22:52
         compiled from partials/account/privateMessages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'partials/account/privateMessages.tpl', 8, false),array('modifier', 'date_format', 'partials/account/privateMessages.tpl', 31, false),)), $this); ?>
	<div id="accountInboxMessage" style="float:left; overflow-y:scroll; max-height:800px; width:100%;">
        <?php $_from = $this->_tpl_vars['inboxMessages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shoutmessage']):
?>
            <div class="PrivateMessage" style="float:left; width:98%;">
            	<div class="leftColumnShoutOut" style="width:20%; float:left;">
                	<div class="publicProductName" >
                    <?php if ($this->_tpl_vars['shoutmessage']['product_type_seller'] == 'generalSeller'): ?>

                    <a href="<?php echo smarty_function_geturl(array('controller' => 'userproductpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
"><?php echo $this->_tpl_vars['shoutmessage']['product_name']; ?>
</a>
                    <?php else: ?>
                    <a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
"><?php echo $this->_tpl_vars['shoutmessage']['product_name']; ?>
</a>
                    
                    <?php endif; ?>
                    	
                    </div>
                    <!--<div class="publicProductType">
                    	<?php echo $this->_tpl_vars['shoutmessage']['product_category']; ?>

                    </div>-->
                </div>
                <div class="rightColumnShoutOut" style="width:75%; float:left;">
                    <div class="publicProductShoutOutMessageName" >
                        <?php echo $this->_tpl_vars['shoutmessage']['sender_name']; ?>
 to you
                    </div>
                    <div class="privateMessageSubject">
                    	<span style="font-style:italic;"><?php echo $this->_tpl_vars['shoutmessage']['sender_subject']; ?>
</span>
                    </div>
                    <div class="publicProductShoutOutMessageContent" >
                       <?php echo $this->_tpl_vars['shoutmessage']['sender_message']; ?>

        
                    </div>
                    <div class="publicProductShoutOutMessageTime" >
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['shoutmessage']['ts_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                    </div>
                </div>
                <div style="float:right;">
                	<a class="accountDetailShoutOutFromRespond">Respond</a>
                    <?php if ($this->_tpl_vars['shoutmessage']['product_type_seller'] == 'generalSeller'): ?>
                	<a href="<?php echo smarty_function_geturl(array('controller' => 'userproductpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
">View Product</a>
                    <?php else: ?>
                    <a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
">View Product</a>
                    <?php endif; ?>
                </div>
                <div class="privateMessageForm" style="float:left; width:100%; display:none;">
                	<form action="<?php echo smarty_function_geturl(array('controller' => 'communication','action' => 'privatemessage'), $this);?>
" method="post" class="account-privatemessage-form">
                	<label style="width:50%;">Current time:</label>
                   	<span style="float:left; width:40%;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%D, %I:%M %p') : smarty_modifier_date_format($_tmp, '%D, %I:%M %p')); ?>
</span>
                    <div>
					<label style="width:50%;">Message:</label>
                    <textarea name="sender_message"></textarea>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
                    <input name="sender_name" type="hidden" value="<?php echo $this->_tpl_vars['user']->generalInfo->username; ?>
" readonly="readonly" />
                    <input name="sender_email" type="hidden" value="<?php echo $this->_tpl_vars['user']->generalInfo->email; ?>
" readonly="readonly" />
                    
                    <input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
"/>
                    <input type="hidden" name="product_category" value="<?php echo $this->_tpl_vars['shoutmessage']['product_category']; ?>
"/>
                    <input type="hidden" name="product_type" value="<?php echo $this->_tpl_vars['shoutmessage']['product_type_seller']; ?>
"/>
                    <input type="hidden" name="receiver_User_id" value="<?php echo $this->_tpl_vars['shoutmessage']['sender_user_id']; ?>
"/>
                    <input type="hidden" name="receiver_Username" value="<?php echo $this->_tpl_vars['shoutmessage']['sender_username']; ?>
"/>
                    <input type="hidden" name="receiver_email" value="<?php echo $this->_tpl_vars['shoutmessage']['sender_email']; ?>
" />
                    <input type="hidden" name="receiver_name" value="<?php echo $this->_tpl_vars['shoutmessage']['sender_name']; ?>
" />
                    <input type="hidden" name="product_name" value="<?php echo $this->_tpl_vars['shoutmessage']['product_name']; ?>
" />
                    <input type="hidden" name="product_tag" value="<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
" />
					<input type="hidden" name="sender_subject" value="<?php echo $this->_tpl_vars['shoutmessage']['sender_subject']; ?>
" />
                    <input type="hidden" name="product_image_id" value="<?php echo $this->_tpl_vars['shoutmessage']['product_image_id']; ?>
"/>
                    <?php if ($this->_tpl_vars['authenticated']): ?>
                    <input type="hidden" name="sender_user_id" value="<?php echo $this->_tpl_vars['user']->generalInfo->userID; ?>
" />
                    <input type="hidden" name="sender_username" value="<?php echo $this->_tpl_vars['user']->generalInfo->username; ?>
" />
                    <?php endif; ?>
                    
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send replay message!"/>
                    </form>
                </div>
            </div>
        <?php endforeach; endif; unset($_from); ?>
     </div>

     
     <div id="accountOutboxMessage" style="float:left; overflow-y:scroll; max-height:800px; width:100%; display:none;">
        <?php $_from = $this->_tpl_vars['outboxMessages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shoutmessage']):
?>
            <div class="PrivateMessage" style="float:left; width:95%;">
            	<div class="leftColumnShoutOut" style="width:20%; float:left;">
                	<div class="publicProductName" >
                    <?php if ($this->_tpl_vars['shoutmessage']['product_type_seller'] == 'generalSeller'): ?>

                    <a href="<?php echo smarty_function_geturl(array('controller' => 'userproductpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
"><?php echo $this->_tpl_vars['shoutmessage']['product_name']; ?>
</a>
                    <?php else: ?>
                    <a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
"><?php echo $this->_tpl_vars['shoutmessage']['product_name']; ?>
</a>
                    
                    <?php endif; ?>
                    	
                    </div>
                    <!--<div class="publicProductType">
                    	<?php echo $this->_tpl_vars['shoutmessage']['product_category']; ?>

                    </div>-->
                </div>
                <div class="rightColumnShoutOut" style="width:75%; float:left;">
                    <div class="publicProductShoutOutMessageName" >
                        Your message to <?php echo $this->_tpl_vars['shoutmessage']['receiver_name']; ?>

                    </div>
                    <div class="privateMessageSubject">
                    	<span style="font-style:italic;"><?php echo $this->_tpl_vars['shoutmessage']['sender_subject']; ?>
</span>
                    </div>
                    <div class="publicProductShoutOutMessageContent" >
                       <?php echo $this->_tpl_vars['shoutmessage']['sender_message']; ?>

        
                    </div>
                    <div class="publicProductShoutOutMessageTime" >
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['shoutmessage']['ts_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>

                    </div>
                </div>
                <div style="float:right;">
                    <?php if ($this->_tpl_vars['shoutmessage']['product_type_seller'] == 'generalSeller'): ?>
                	<a href="<?php echo smarty_function_geturl(array('controller' => 'userproductpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
">View Product</a>
                    <?php else: ?>
                    <a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
&tag=<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
">View Product</a>
                    <?php endif; ?>
                </div>
                
            </div>
        <?php endforeach; endif; unset($_from); ?>
     </div>