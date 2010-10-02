<?php /* Smarty version 2.6.19, created on 2010-08-10 15:57:43
         compiled from partials/account/publicShoutBoxMessages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'partials/account/publicShoutBoxMessages.tpl', 13, false),array('modifier', 'date_format', 'partials/account/publicShoutBoxMessages.tpl', 24, false),)), $this); ?>
<div id="accountPublicShoutBox" style="float:left; overflow-y:scroll; max-height:800px; width:100%;">
        <?php $_from = $this->_tpl_vars['allShoutBoxMessages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shoutmessage']):
?>
            <div class="publicProductShoutOutMessage" style="float:left; width:98%;">
            	<div class="leftColumnShoutOut" style="width:20%; float:left;">
                	<div class="publicProductName" >
                    	<?php echo $this->_tpl_vars['shoutmessage']['shoutout_name']; ?>

                    </div>
                </div>
                <div class="rightColumnShoutOut" style="width:75%; float:left;">
                    <div class="publicProductShoutOutMessageName" >
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
                    <div class="publicProductShoutOutMessageContent" >
                        <?php echo $this->_tpl_vars['shoutmessage']['shoutout_message']; ?>

        
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
                <div class="accountDetailShoutOutForm" style="float:left; width:100%; display:none;">
                	<form action="<?php echo smarty_function_geturl(array('controller' => 'communication','action' => 'postshoutout'), $this);?>
" method="post" class="account-shoutbox-form">
                	<label>Current time:</label>
                   	<span style="float:left; width:40%;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>
</span><br/>
                    <div>
					<label>Message:</label>
                    <textarea name="shoutout_message"></textarea>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
                    <input name="shoutout_name" type="hidden" value="<?php echo $this->_tpl_vars['user']->generalInfo->username; ?>
" readonly="readonly" />
                    <input name="shoutout_email" type="hidden" value="<?php echo $this->_tpl_vars['user']->generalInfo->email; ?>
" readonly="readonly" />
                    
                    <input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['shoutmessage']['product_id']; ?>
"/>
                    <input type="hidden" name="product_category" value="<?php echo $this->_tpl_vars['shoutmessage']['product_category']; ?>
"/>
                    <input type="hidden" name="product_type" value="<?php echo $this->_tpl_vars['shoutmessage']['product_type_seller']; ?>
"/>
                    <input type="hidden" name="User_id" value="<?php echo $this->_tpl_vars['shoutmessage']['User_id']; ?>
"/>
                    <input type="hidden" name="Username" value="<?php echo $this->_tpl_vars['shoutmessage']['Username']; ?>
"/>
                    <input type="hidden" name="product_name" value="<?php echo $this->_tpl_vars['shoutmessage']['product_name']; ?>
" />
                    <input type="hidden" name="product_tag" value="<?php echo $this->_tpl_vars['shoutmessage']['product_tag']; ?>
" />

                    <input type="hidden" name="product_image_id" value="<?php echo $this->_tpl_vars['shoutmessage']['product_image_id']; ?>
"/>
                    <?php if ($this->_tpl_vars['authenticated']): ?>
                    <input type="hidden" name="shoutout_user_id" value="<?php echo $this->_tpl_vars['user']->generalInfo->userID; ?>
" />
                    <input type="hidden" name="shoutout_username" value="<?php echo $this->_tpl_vars['user']->generalInfo->username; ?>
" />
                    <?php endif; ?>
                    
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:200px; float:left;"value="Shout!"/>
                    </form>
                </div>
            </div>
        <?php endforeach; endif; unset($_from); ?>
        </div>
             <?php echo '
     <script type="text/javascript">
new toggleClass(\'accountPublicShoutBox\', \'accountDetailShoutOutForm\', \'accountDetailShoutOutFromRespond\', \'publicProductShoutOutMessage\' );
</script>
'; ?>