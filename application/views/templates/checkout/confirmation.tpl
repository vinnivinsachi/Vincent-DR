{include file="layouts/$layout/header.tpl" lightbox=true}
<div id="leftContainer" style="width:210px; float:left;">
{include file='partials/leftColumnIndex.tpl'}
</div>

<div id="rightContainer" style='width:750px; float:left;'>
	{include file='partials/indexTagHeader.tpl' indexTagHeaderTitleName="Confirmation"}

	<div id="orderMainDiv" style="float:left; width:100%;">
    	
       
        {include file='partials/checkout/_basketInformation.tpl'}
       	<!-- end of product forloop-->
        <div id="orderShippingDetails" style="width:100%; float:left; margin-top:15px;">
                <div class='box'><div class='titleBarBig'>Shipping information</div></div>
                Please ship it to: <br />
                <div id="finalUserOrderShippingInfo" style="margin-left:45px; padding:10px; margin:0px; font-weight:bold; font-size:14px; line-height:1.3em;">
                {if $defaultShippingKey}
                {$user->generalInfo->first_name} {$user->generalInfo->last_name}<br />
                {$user->generalInfo->shippingAddress[$defaultShippingKey]->address_one}<br />
                {if $user->generalInfo->shippingAddress[$defaultShippingKey]->address_two !=''}
                	{$user->generalInfo->shippingAddress[$defaultShippingKey]->address_two !=''}<br />
                {/if}
                {$user->generalInfo->shippingAddress[$defaultShippingKey]->city}, {$user->generalInfo->shippingAddress[$defaultShippingKey]->state} {$user->generalInfo->shippingAddress[$defaultShippingKey]->zip}<br />
                {$user->generalInfo->shippingAddress[$defaultShippingKey]->country}<br />   
                {else}
               	Please select a shipping address from above
                {/if}
                </div>
                <a href="{geturl action='index'}"><img src="{$siteRoot}/public/resources/css/images/backToShipping.gif" /></a><br />
        </div>
        
        <div id="orderRewardsDetails" style="width:100%; float:left;margin-top:15px;">
        	 <div class='box'><div class='titleBarBig'>Reward points and promotions</div></div>
            <div id="orderRewardMotherDiv" style="width:730px; float:left; padding:10px; border-bottom:1px solid #069;">
                    <div id="rewardPointNotice" style="width:50%; float:left;">
                    <span class="bigFont">{$shoppingCartInfo->rewardPointsUsed}</span> reward points used<br />
                    4 points = $1<br />
                    </div>
                   
                </div>
                <div id="orderPromotionsMotherDiv" style="width:730px; float:left; padding:10px;">
                    
                    <div id="promotionInputTitle" style="width:50%; float:left;">
                   	 Promotion code used: {$shoppingCartInfo->promotionCodeUsed}                  
                   	 
                   	</div>
                   	
                </div>
            
            
            
            
           <a href="{geturl action='index'}"><img src="{$siteRoot}/public/resources/css/images/backToRewardPoint.gif" style="margin-left:-3px;"/></a>
        
        
		</div>
        
        <div class="totalCartPriceAfterRecalc" style="width:100%; float:left;margin-top:15px;">
            <div class='box'><div class='titleBarBig'>Summary</div></div>
        	<div class="totalCartMotherDiv" style="width:730px; float:left; padding:10px; border-bottom:1px solid #069;">
            
            <div class="cartCost box">
                <div class="productSellerInfo" style="float:left; width:70%;">Cart costs:</div>
                <div class="productOrderPrice price" style="float:left; width:15%;">${$shoppingCartInfo->tempTotalCost}</div>
                <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
        	</div>	
        	<div class="cartCost box">
                <div class="productSellerInfo" style="float:left; width:70%;">Shipping costs:</div>
                <div class="productOrderPrice price" style="float:left; width:15%;">${$shoppingCartInfo->totalShippingCosts}</div>
        	</div>
                
                <div class="cartCost box" >
                    <div class="productSellerInfo" style="float:left; width:55%;">Reward points:</div>
                    <div class="productOrderQuantity" style="float:left;; width:15%;">{$shoppingCartInfo->rewardPointsUsed} points used</div>
                    <div class="productOrderPrice price" style="float:left; width:15%; color:#F60;">-${$shoppingCartInfo->rewardAmountDeducted}</div>
                    <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
                </div>
            	<div class="cartCost box">
            		{if $shoppingCartInfo->promotionCodeUsed!=''}
                    <div class="productSellerInfo" style="float:left; width:55%;">Promostions:</div>
                    <div class="productOrderQuantity" style="float:left;; width:15%;">{$shoppingCartInfo->promotionCodeUsed}</div>
                    {else}
                    <div class="productSellerInfo" style="float:left; width:70%;">Promostions:</div>
                    {/if}
                    <div class="productOrderPrice price" style="float:left; width:15%; color:#F60;">-${$shoppingCartInfo->promotionAmountDeducted}</div>
                    <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
                </div>
            </div>
            <div class="totalCartMotherPrice box" style="width:730px; float:left; padding:10px; font-weight:bold;">
                <div class="cartCost" style="width:100%; float:left;" >
                    <div class="productSellerInfo" style="float:left; width:70%;">Total:</div>
                    <div class="productOrderPrice price" style="float:left; width:10%;">${$shoppingCartInfo->totalCost}</div>
                    <div class="productOrderRewardPoints" style="float:left; width:20%;">{$shoppingCartInfo->rewardPointsAwarded} points awarded</div>
                </div>
            </div>
        </div>
        <a href="{geturl action='createorder'}" style="float:right;"><img src="{$siteRoot}/public/resources/css/images/next to paypal.gif" style="margin-bottom:-1px;"/></a>
    </div>
</div>

{include file="layouts/$layout/footer.tpl"}