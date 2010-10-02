<?php /* Smarty version 2.6.19, created on 2010-08-31 22:59:30
         compiled from productdisplay/_productDetails/_productsDetails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'productdisplay/_productDetails/_productsDetails.tpl', 10, false),array('modifier', 'date_format', 'productdisplay/_productDetails/_productsDetails.tpl', 95, false),array('function', 'geturl', 'productdisplay/_productDetails/_productsDetails.tpl', 69, false),)), $this); ?>
<div id='page' class='box'>
<div id='productDetailLeftColumn' class='box' style='padding-left:5px; width:320px;'>
 	<div class="productBox2 box marginTop20" style="width:320px; height:100%;">
						<table>
		         		<tr style='height:350px; '><td style='padding:0px; margin:0px; width:320px;'>
		         		<div class="productFirstImage">
		                	<div class="productDescription">
		                       
		                    </div>
		                	<?php if (count($this->_tpl_vars['product']['images']) > 0): ?>
		                	<img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['0']['product_tag']; ?>
/<?php echo $this->_tpl_vars['product']['images'][0]['image_id']; ?>
.W300_productDetailImage.jpg"/>
		                	<?php else: ?>
		                        No image
		                    <?php endif; ?>
		                </div>
		         		
		         		</td></tr>
		                
		               </table>
		                <div class="productDetails box">
	                    <div class="productMedia">
	                        <div class="productImages">
	                            <?php $_from = $this->_tpl_vars['product']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
	                                <div class="productIndividualImage">
	                                <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['0']['product_tag']; ?>
/<?php echo $this->_tpl_vars['image']['image_id']; ?>
.W50_productSmallPreview.jpg" />
	                                <span class="imageLargeAddress" style="display:none">
	                                <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['0']['product_tag']; ?>
/<?php echo $this->_tpl_vars['image']['image_id']; ?>
.W300_productDetailImage.jpg""/></span>					
	                                </div>
	                            <?php endforeach; endif; unset($_from); ?>
	                            <?php $_from = $this->_tpl_vars['product']['inventoryImages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['inventoryImage']):
?>
	                            	<div class="productIndividualImage">
	                                <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
/inventory/<?php echo $this->_tpl_vars['inventoryImage']['image_id']; ?>
.W50_productSmallPreview.jpg" />
	                                <span class="imageLargeAddress" style="display:none">
	                                <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
/inventory/<?php echo $this->_tpl_vars['inventoryImage']['image_id']; ?>
.W300_productDetailImage.jpg""/></span>					
	                                </div>
	                            <?php endforeach; endif; unset($_from); ?>
	                        </div>
	                    </div>
						</div>
						
	</div>
	<div class='box marginTop20'>
		<div class='titleBarMid'>
			<a id='shippingInfoAnchor' class='currentTab tabSelections' style='float:left; padding:4px;'>Shipping</a> <a id='returnsAndServiceFeeAnchor' class='tabSelections' style='float:left; padding:4px; margin-left:5px;'>Returns and service fee</a>
		</div>
		<div class='box' style='width:310px; padding-left:10px;'>
			<div id='shippingInfo'>
			<div class='box' style='padding-top:10px;'>
			 <label>Domestic shipping:</label>
			 $<?php echo $this->_tpl_vars['product']['0']['domestic_shipping_rate']; ?>

			</div>
			<div class='box' style='padding-top:10px;'>
			 <label>International shipping:</label>
			 $<?php echo $this->_tpl_vars['product']['0']['international_shipping_rate']; ?>

			</div></div>
			<div id='returnsAndServiceFee'></div>
		</div>
	</div>
</div>
<div id="productDetailRightSidePanel" class='box' style='float:right; width: 410px; padding-right:10px;'>
	<div class='box marginTop20' style='width:405px;'>	<div class='titleBarBig'><?php echo $this->_tpl_vars['product']['0']['name']; ?>
<span style='float:right;'><?php echo $this->_tpl_vars['product']['0']['product_tag']; ?>
</span></div>
	</div>
	<div class='productDetailTop box'>
	<div class='titleBarMid'>Description </div>
	Seller: <?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
<br/>
	<div class='box' style='padding:10px; width:390px;'><?php echo $this->_tpl_vars['product']['profile']['0']['profile_value']; ?>
</div>
	</div>
    <div class="productProfiles box marginTop20" style='text-align: left; width:100%;'>
    	<form method='post' action="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'additemtoshoppingcart'), $this);?>
">
    	<input type='hidden' name='attribute[brand]' value='<?php echo $this->_tpl_vars['product']['0']['brand']; ?>
'/>
    	
        <?php $this->assign('orderAttribute', $this->_tpl_vars['product']['0']['inventory_attribute_table']); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "productdisplay/_productCustomizableAttribute/_".($this->_tpl_vars['orderAttribute']).".tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		                 
	 	<div class='quickOrderActions' style='float:left; width:100%;'>
	  		<input type='submit' style='float:left; padding:10px;' value='Add to cart'/>
	 	</div>
	 	<input type='hidden' name='product' value='Customize'/>
	 	<input type='hidden' name='id' value='<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
'/>
  		</form>
    </div>
    
    
    <div class="box marginTop20">
    	<div class='titleBarMid' style='margin-bottom:0px;'>
    	<a id='askAndAnswerAnchor' class='currentTab tabSelections' style='float:left; padding:4px;' onclick="$('sendAPrivateMessage').hide(); $('sendAPrivateMessageAnchor').removeClassName('currentTab'); $('askAndAnswer').show(); $('askAndAnswerAnchor').addClassName('currentTab');" >Ask and Answer</a><a id='sendAPrivateMessageAnchor' class='tabSelections' style='float:left; padding:4px; margin-left:5px;' onclick="$('askAndAnswer').hide(); $('askAndAnswerAnchor').removeClassName('currentTab'); $('sendAPrivateMessage').show(); $('sendAPrivateMessageAnchor').addClassName('currentTab'); ">Send a message</a>
    	</div>
    	
    	<div class='box'>
			<div id='askAndAnswer' class='box'>
				<div id='askAndAnswerForm' class='box' style='background-color:#eee; padding:10px; width:390px;'>
					<form action="<?php echo smarty_function_geturl(array('controller' => 'communication','action' => 'postshoutout'), $this);?>
" method="post" id="shoutbox-form">
					<div class='box'>
                	<label>Date:</label>
                   	<span style="float:left; width:40%;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</span>
                   	</div>
                    <div class='marginTop10 box'>
                	<label>Name: </label>
                    <?php if ($this->_tpl_vars['authenticated']): ?>
                    <input name="shoutout_name" type="text" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->username; ?>
" readonly="readonly" />
                    <?php else: ?>
                    <input name="shoutout_name" type="text" />
                    <?php endif; ?>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
                    <div class=' box'>
                    <label>Contact email (not displayed):</label>
					<?php if ($this->_tpl_vars['authenticated']): ?>
                    <input name="shoutout_email" type="text" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->email; ?>
" readonly="readonly" />
                    <?php else: ?>
                    <input name="shoutout_email" type="text" />
                    <?php endif; ?>                    
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </div>
                    <div class=' box'>
					<label style='width:199px;' title="Please do not post personal information, such as phone numbers and addresses here. Use 'Send a message' instead.">Message:</label>
                    <textarea name="shoutout_message"></textarea>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
					<input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
"/>
					<input type='hidden' name='uploader_id' value="<?php echo $this->_tpl_vars['product']['0']['uploader_id']; ?>
"/>
					
					
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:200px; float:left;"value="Ask!"/>
                    </form>
				</div>
				<div id='askAndAnswerContent'>
					<?php $_from = $this->_tpl_vars['shoutboxMessages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shoutboxMessage']):
?>
						<div class='askAndAnswerPost'>
							<div class='askAndAnswerName'>
							<?php echo $this->_tpl_vars['shoutboxMessage']['shoutout_name']; ?>

							</div>
							<div class='askAndAnswerTime'>
							<?php echo ((is_array($_tmp=$this->_tpl_vars['shoutboxMessage']['ts_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>

							</div>
							<div class='askAndAnswerContent'>	
							<?php echo $this->_tpl_vars['shoutboxMessage']['shoutout_message']; ?>

							</div>
						</div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
			
			</div>
			<div id='sendAPrivateMessage' style='display:none'>
				<div id='sendAPrivateMessageForm' class='box' style='background-color:#eee; padding:10px; width:390px;'>
					<form action="<?php echo smarty_function_geturl(array('controller' => 'communication','action' => 'privatemessage'), $this);?>
" method="post" id="privateMessage-form">
						<div class='box'>
                        <label>Date:</label>
                        <span style="float:left; width:40%;">2010-03-31 9:43 PM</span>
                        </div>
                        <div class='marginTop10 box'>
                        <label>Name: </label>
                        <?php if ($this->_tpl_vars['authenticated']): ?>
                        <input name="sender_name" type="text" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->username; ?>
" readonly="readonly" />
                        <?php else: ?>
                        <input name="sender_name" type="text" />
                        <?php endif; ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>
                        <div class='box'>
                        <label>Contact email (not displayed):</label>
                        <?php if ($this->_tpl_vars['authenticated']): ?>
                        <input name="sender_email" type="text" value="<?php echo $this->_tpl_vars['signedInUser']->generalInfo->email; ?>
" readonly="readonly"/>
                        <?php else: ?>
                        <input name="sender_email" type="text" />
                        <?php endif; ?> 
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>
                        <div class='box'>
                        <label>Subject:</label>
                        <input name="sender_subject" type="text" />
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>
                        <div class='box'>
                        <label style='width:199px;'>Message:</label>
                        <textarea name="sender_message"></textarea>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>
                        
                        <input type='hidden' name='receiver_User_id' value='<?php echo $this->_tpl_vars['product']['0']['uploader_id']; ?>
'/>
                        <input type='hidden' name='receiver_Username' value='<?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
'/>
                        <input type='hidden' name='product_id' value='<?php echo $this->_tpl_vars['product']['0']['product_id']; ?>
'/>
                        <input type='hidden' name='receiver_name' value='<?php echo $this->_tpl_vars['product']['0']['first_name']; ?>
 <?php echo $this->_tpl_vars['product']['0']['last_name']; ?>
'/>
                       	<input type="submit" name="sendPrivateMessage" class="submitInputButton" style="margin-left:200px; float:left;"value="Send message"/>
                    </form>
				</div>
			
			</div>
    	</div>
    	
	</div>
    
    </div>
    
   
    
</div>    

<?php echo '
<script type="text/javascript">
new productPreviewImage(\'productDetailLeftColumn\');
new formEnhancerShoutoutMessage(\'shoutbox-form\');
new formEnhancerPrivateMessage(\'privateMessage-form\');
</script>
'; ?>