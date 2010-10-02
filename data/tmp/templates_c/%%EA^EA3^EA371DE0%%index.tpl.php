<?php /* Smarty version 2.6.19, created on 2010-08-28 21:07:07
         compiled from checkout/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'checkout/index.tpl', 35, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="leftContainer" style="width:210px; float:left;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/leftColumnIndex.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div id="rightContainer" style='width:750px; float:left; padding:20px;'>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/indexTagHeader.tpl', 'smarty_include_vars' => array('indexTagHeaderTitleName' => 'Checkout')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div id="accordion" style="margin-top:20px;">
        <h3><a href="#">Cart information: Step 1
        	<div id="currentOrderTime" style="float:right;">
            12/2/10 14:23:45
            </div></a></h3>
        <div>
           <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "partials/shoppingcart/_basketInformation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div id="proceedShoppingCart" style="width:100%; float:left; text-align:right;">
        	
        	<a id="proceedToShippingInfoAnchor" style="float:right; margin-top:10px;"><img src="/public/resources/css/images/nextToShipping.gif" style="margin-right:-9px;"/></a>
        	</div>
       </div>
        
        <h3><a href="#">Shipping Information: Step 2 
        	</a></h3>
        <div>
               <div style="padding:10px; border-bottom:1px solid #069; width:98%; float:left;">
                    <div id="allShippingAddresses" style="width:100%; float:left;">
                    <?php $_from = $this->_tpl_vars['user']->generalInfo->shippingAddress; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['Item']):
?>
                    <div class="shippingAddressBox" id="shippingAddress_<?php echo $this->_tpl_vars['Key']; ?>
">
                        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->address_one; ?>
<br />
                         <?php if ($this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->address_two != ''): ?>
                        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->address_two; ?>
<br />
                        <?php endif; ?>
                        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->city; ?>
, <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->state; ?>
 <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->zip; ?>
<br />
                        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->country; ?>
<br />
                       
                        <a id="deleteShippingAddress_<?php echo $this->_tpl_vars['Key']; ?>
" class='deleteShippingAddressAnchor' href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'deleteshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['Key']; ?>
">Delete</a><br />
                        
                        <?php if ($this->_tpl_vars['defaultShippingKey'] != $this->_tpl_vars['Key']): ?>
                        <a id="makeShippingAddress_<?php echo $this->_tpl_vars['Key']; ?>
" class='makeShippingAddressAnchor' href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'makedefaultshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['Key']; ?>
"><img src="/public/resources/css/images/ShippingButton.gif" /></a><br />
                        <?php endif; ?>
                    </div>
                    <?php endforeach; endif; unset($_from); ?>
                    </div>
                    <div style="float:left; width:100%; padding-top:10px;"><a id="toggleAddShipping" style='font-weight:bold;'>Add a shipping address</a></div>
                    <div id="editShippingForm" style=" width:100%; float:left; display:none;">
                    
                        <form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'editshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['addressID']; ?>
" id="shippingAddressForm">
                                <div>
                                <label>Address One: </label>
                                <input type="text" value="<?php echo $this->_tpl_vars['fp']->address_one; ?>
" name="address_one"/><br />
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                </div>
                                <label>Address Two:</label>
                                <input type="text" value="<?php echo $this->_tpl_vars['fp']->address_two; ?>
" name="address_two"/><br />
                                <div>
                                <label>City: </label>
                                <input type="text" value="<?php echo $this->_tpl_vars['fp']->city; ?>
" name="city"/><br />
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                </div>
                                <div>
                                <label>State:</label>
                                <input type="text" value="<?php echo $this->_tpl_vars['fp']->state; ?>
" name="state"/><br />
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                </div>
                                <div>
                                <label>Country:</label>
                                <input type="text" value="<?php echo $this->_tpl_vars['fp']->country; ?>
" name="country"/><br />
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                </div>
                                <div>
                                <label>Zip:</label>
                                <input type="text" value="<?php echo $this->_tpl_vars['fp']->zip; ?>
" name="zip" /><br />
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                </div>
                                <input type="checkbox" name="defaultShipping" />Ship to this address<br />
                                <input type="submit" value="save"/>
                        </form>
                    </div>
                </div>
                
              	<div style="float:right; width:282px; padding:10px; text-align:left;">
                    Ship to: <br /><br/>
                    <div id="finalUserOrderShippingInfo" style=" line-height:1.3em;">
                    <?php if ($this->_tpl_vars['defaultShippingKey']): ?>
                    
                    <?php echo $this->_tpl_vars['user']->generalInfo->first_name; ?>
 <?php echo $this->_tpl_vars['user']->generalInfo->last_name; ?>
<br />
                    <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->address_one; ?>
<br />
                    <?php if ($this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->address_two != ''): ?>
                        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->address_two; ?>
<br />
                    <?php endif; ?>
                    <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->city; ?>
, <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->state; ?>
 <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->zip; ?>
<br />
                    <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->country; ?>
<br />
                    
                    <?php else: ?>
                    Please add or select a delivery address from above.
                    <?php endif; ?>
                    </div>
                </div>
                <div style="float:left; width:98%; padding:0px 10px 10px 10px;">
                	<a id="backToCartInfo" style="float:left;"><img src="/public/resources/css/images/backToCart.gif" style="margin-left:-13px;"/></a>
                	<a  id="nextToRewardPointAnchor" style="float:right;<?php if (! $this->_tpl_vars['defaultShippingKey']): ?>
display:none;<?php endif; ?>"><img src="/public/resources/css/images/nextToRewardPointsAndPromotions.gif"/></a>
                </div>
        </div>
        <h3><a href="#">Reward points and promotions: Step 3
        	</a></h3>
        <div>
            <div id="orderRewardsDetails" style="width:100%; float:left;">
           
                <div id="orderRewardMotherDiv" style="width:98%; float:left; padding:10px; border-bottom:1px solid #069;">
                    <div id="rewardPointNotice" style="width:50%; float:left;">
                    You have <span class="bigFont"><?php echo $this->_tpl_vars['userRewardPoint']; ?>
</span> reward point(s) available. <br />
                    <span>4 points = $1</span><br />
                    </div>
                    <div id="rewardPointSelectionTitle" style="width:20%; float:left; text-align:right;">
                        Apply: 
                    </div>
                    <div id='rewardPointSelection' style='width:30%; float:left; '>
                        <select id="rewardPointSelection" class='inputShiftOne'>
                        <?php $_from = $this->_tpl_vars['incrementalRewardNumber']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['number']):
?>
                        <option value="<?php echo $this->_tpl_vars['number']; ?>
"><?php echo $this->_tpl_vars['number']; ?>
 points/<?php echo $this->_tpl_vars['Key']; ?>
 dollars </option>
                        <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </div>
                </div>
                <div id="orderPromotionsMotherDiv" style="width:98%; float:left; padding:10px;">
                    <div id="promotionsNotice" style="width:50%; float:left;">
                     If you have a promotion code, please enter your code in the left box.
                    </div>
                    <div id="promotionInputTitle" style="width:20%; float:left; text-align:right;">
                   	 Promotion code: 
                   	</div>
                   	<div id="promotionInput" style='width:30%; float:left;'>
                   	<input class='inputShiftOne' id="promotionCode" type="text" value=""/>
                    </div>
                </div>
            
             <a id="backToShippingInfoAnchor" style="float:left;"><img src="/public/resources/css/images/backToShipping.gif" /></a>
              <a id="proceedToComfirmation" style="float:right;"><img src="/public/resources/css/images/continueToConfirmation.gif" style="margin-bottom:-1px;"/></a>
            </div>
        </div>
    </div>
</div>

<?php echo '
<script type="text/javascript">
new checkOutEnhancer(\'shippingAddressForm\');


new simpleToggle(\'toggleAddShipping\', \'editShippingForm\', \'selectionOn\');

$j(document).ready(function(){
							$j("#accordion").accordion({ autoHeight: false,disabled:true, collapsible:true});
});

var AccordionObject = $j("#accordion");

$("proceedToShippingInfoAnchor").observe(\'click\', function(event){
														  // alert(\'hi\');
														  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 1);
														  AccordionObject.accordion("option", "disabled",true);

														   //alert(\'hei\');
														   });
$("nextToRewardPointAnchor").observe(\'click\', function(event){	
													   
													   	  AccordionObject.accordion("option", "disabled", false);	
													   	  AccordionObject.accordion("option", "active", 2);
														  AccordionObject.accordion("option", "disabled",true);
												
														   });
														
$("backToShippingInfoAnchor").observe(\'click\', function(event){
														  // alert(\'hi\');
														  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 1);
														  AccordionObject.accordion("option", "disabled",true);
														   });
$("backToCartInfo").observe(\'click\', function(event){
														  // alert(\'hi\');
														  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 0);
														  AccordionObject.accordion("option", "disabled",true);
														   });

</script>


'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>