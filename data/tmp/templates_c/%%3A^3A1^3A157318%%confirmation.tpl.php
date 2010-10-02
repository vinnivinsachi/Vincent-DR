<?php /* Smarty version 2.6.19, created on 2010-09-28 21:03:27
         compiled from checkout/confirmation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'checkout/confirmation.tpl', 30, false),)), $this); ?>
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

<div id="rightContainer" style='width:750px; float:left;'>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/indexTagHeader.tpl', 'smarty_include_vars' => array('indexTagHeaderTitleName' => 'Confirmation')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div id="orderMainDiv" style="float:left; width:100%;">
    	
       
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/checkout/_basketInformation.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
       	<!-- end of product forloop-->
        <div id="orderShippingDetails" style="width:100%; float:left; margin-top:15px;">
                <div class='box'><div class='titleBarBig'>Shipping information</div></div>
                Please ship it to: <br />
                <div id="finalUserOrderShippingInfo" style="margin-left:45px; padding:10px; margin:0px; font-weight:bold; font-size:14px; line-height:1.3em;">
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
               	Please select a shipping address from above
                <?php endif; ?>
                </div>
                <a href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
"><img src="/public/resources/css/images/backToShipping.gif" /></a><br />
        </div>
        
        <div id="orderRewardsDetails" style="width:100%; float:left;margin-top:15px;">
        	 <div class='box'><div class='titleBarBig'>Reward points and promotions</div></div>
            <div id="orderRewardMotherDiv" style="width:730px; float:left; padding:10px; border-bottom:1px solid #069;">
                    <div id="rewardPointNotice" style="width:50%; float:left;">
                    <span class="bigFont"><?php echo $this->_tpl_vars['shoppingCartInfo']->rewardPointsUsed; ?>
</span> reward points used<br />
                    4 points = $1<br />
                    </div>
                   
                </div>
                <div id="orderPromotionsMotherDiv" style="width:730px; float:left; padding:10px;">
                    
                    <div id="promotionInputTitle" style="width:50%; float:left;">
                   	 Promotion code used: <?php echo $this->_tpl_vars['shoppingCartInfo']->promotionCodeUsed; ?>
                  
                   	 
                   	</div>
                   	
                </div>
            
            
            
            
           <a href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
"><img src="/public/resources/css/images/backToRewardPoint.gif" style="margin-left:-3px;"/></a>
        
        
		</div>
        
        <div class="totalCartPriceAfterRecalc" style="width:100%; float:left;margin-top:15px;">
            <div class='box'><div class='titleBarBig'>Summary</div></div>
        	<div class="totalCartMotherDiv" style="width:730px; float:left; padding:10px; border-bottom:1px solid #069;">
            
            <div class="cartCost box">
                <div class="productSellerInfo" style="float:left; width:70%;">Cart costs:</div>
                <div class="productOrderPrice price" style="float:left; width:15%;">$<?php echo $this->_tpl_vars['shoppingCartInfo']->tempTotalCost; ?>
</div>
                <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
        	</div>	
        	<div class="cartCost box">
                <div class="productSellerInfo" style="float:left; width:70%;">Shipping costs:</div>
                <div class="productOrderPrice price" style="float:left; width:15%;">$<?php echo $this->_tpl_vars['shoppingCartInfo']->totalShippingCosts; ?>
</div>
        	</div>
                
                <div class="cartCost box" >
                    <div class="productSellerInfo" style="float:left; width:55%;">Reward points:</div>
                    <div class="productOrderQuantity" style="float:left;; width:15%;"><?php echo $this->_tpl_vars['shoppingCartInfo']->rewardPointsUsed; ?>
 points used</div>
                    <div class="productOrderPrice price" style="float:left; width:15%; color:#F60;">-$<?php echo $this->_tpl_vars['shoppingCartInfo']->rewardAmountDeducted; ?>
</div>
                    <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
                </div>
            	<div class="cartCost box">
            		<?php if ($this->_tpl_vars['shoppingCartInfo']->promotionCodeUsed != ''): ?>
                    <div class="productSellerInfo" style="float:left; width:55%;">Promostions:</div>
                    <div class="productOrderQuantity" style="float:left;; width:15%;"><?php echo $this->_tpl_vars['shoppingCartInfo']->promotionCodeUsed; ?>
</div>
                    <?php else: ?>
                    <div class="productSellerInfo" style="float:left; width:70%;">Promostions:</div>
                    <?php endif; ?>
                    <div class="productOrderPrice price" style="float:left; width:15%; color:#F60;">-$<?php echo $this->_tpl_vars['shoppingCartInfo']->promotionAmountDeducted; ?>
</div>
                    <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
                </div>
            </div>
            <div class="totalCartMotherPrice box" style="width:730px; float:left; padding:10px; font-weight:bold;">
                <div class="cartCost" style="width:100%; float:left;" >
                    <div class="productSellerInfo" style="float:left; width:70%;">Total:</div>
                    <div class="productOrderPrice price" style="float:left; width:10%;">$<?php echo $this->_tpl_vars['shoppingCartInfo']->totalCost; ?>
</div>
                    <div class="productOrderRewardPoints" style="float:left; width:20%;"><?php echo $this->_tpl_vars['shoppingCartInfo']->rewardPointsAwarded; ?>
 points awarded</div>
                </div>
            </div>
        </div>
        <a href="<?php echo smarty_function_geturl(array('action' => 'createorder'), $this);?>
" style="float:right;"><img src="/public/resources/css/images/next to paypal.gif" style="margin-bottom:-1px;"/></a>
    </div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>