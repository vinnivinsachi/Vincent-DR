{include file="layouts/$layout/header.tpl" lightbox=true}
<div id="leftContainer" style="width:210px; float:left;">
{include file='partials/leftColumnIndex.tpl'}
</div>

<div id="rightContainer" style='width:750px; float:left; padding:20px;'>
	{include file='partials/indexTagHeader.tpl' indexTagHeaderTitleName="Checkout"}
	<div id="accordion" style="margin-top:20px;">
        <h3><a href="#">Cart information: Step 1
        	<div id="currentOrderTime" style="float:right;">
            12/2/10 14:23:45
            </div></a></h3>
        <div>
           {include file='partials/shoppingcart/_basketInformation.tpl}
            <div id="proceedShoppingCart" style="width:100%; float:left; text-align:right;">
        	
        	<a id="proceedToShippingInfoAnchor" style="float:right; margin-top:10px;"><img src="/public/resources/css/images/nextToShipping.gif" style="margin-right:-9px;"/></a>
        	</div>
       </div>
        
        <h3><a href="#">Shipping Information: Step 2 
        	</a></h3>
        <div>
               <div style="padding:10px; border-bottom:1px solid #069; width:98%; float:left;">
                    <div id="allShippingAddresses" style="width:100%; float:left;">
                    {foreach from=$user->generalInfo->shippingAddress item=Item key=Key}
                    <div class="shippingAddressBox" id="shippingAddress_{$Key}">
                        {$user->generalInfo->shippingAddress[$Key]->address_one}<br />
                         {if $user->generalInfo->shippingAddress[$Key]->address_two !=''}
                        {$user->generalInfo->shippingAddress[$Key]->address_two}<br />
                        {/if}
                        {$user->generalInfo->shippingAddress[$Key]->city}, {$user->generalInfo->shippingAddress[$Key]->state} {$user->generalInfo->shippingAddress[$Key]->zip}<br />
                        {$user->generalInfo->shippingAddress[$Key]->country}<br />
                       
                        <a id="deleteShippingAddress_{$Key}" class='deleteShippingAddressAnchor' href="{geturl controller='account' action='deleteshipping'}?editAddress={$Key}">Delete</a><br />
                        
                        {if $defaultShippingKey!=$Key}
                        <a id="makeShippingAddress_{$Key}" class='makeShippingAddressAnchor' href="{geturl controller='account' action='makedefaultshipping}?editAddress={$Key}"><img src="/public/resources/css/images/ShippingButton.gif" /></a><br />
                        {/if}
                    </div>
                    {/foreach}
                    </div>
                    <div style="float:left; width:100%; padding-top:10px;"><a id="toggleAddShipping" style='font-weight:bold;'>Add a shipping address</a></div>
                    <div id="editShippingForm" style=" width:100%; float:left; display:none;">
                    
                        <form method="post" action="{geturl controller='account' action='editshipping'}?editAddress={$addressID}" id="shippingAddressForm">
                                <div>
                                <label>Address One: </label>
                                <input type="text" value="{$fp->address_one}" name="address_one"/><br />
                                {include file='partials/error.tpl' error=''}
                                </div>
                                <label>Address Two:</label>
                                <input type="text" value="{$fp->address_two}" name="address_two"/><br />
                                <div>
                                <label>City: </label>
                                <input type="text" value="{$fp->city}" name="city"/><br />
                                {include file='partials/error.tpl' error=''}
                                </div>
                                <div>
                                <label>State:</label>
                                <input type="text" value="{$fp->state}" name="state"/><br />
                                {include file='partials/error.tpl' error=''}
                                </div>
                                <div>
                                <label>Country:</label>
                                <input type="text" value="{$fp->country}" name="country"/><br />
                                {include file='partials/error.tpl' error=''}
                                </div>
                                <div>
                                <label>Zip:</label>
                                <input type="text" value="{$fp->zip}" name="zip" /><br />
                                {include file='partials/error.tpl' error=''}
                                </div>
                                <input type="checkbox" name="defaultShipping" />Ship to this address<br />
                                <input type="submit" value="save"/>
                        </form>
                    </div>
                </div>
                
              	<div style="float:right; width:282px; padding:10px; text-align:left;">
                    Ship to: <br /><br/>
                    <div id="finalUserOrderShippingInfo" style=" line-height:1.3em;">
                    {if $defaultShippingKey}
                    
                    {$user->generalInfo->first_name} {$user->generalInfo->last_name}<br />
                    {$user->generalInfo->shippingAddress[$defaultShippingKey]->address_one}<br />
                    {if $user->generalInfo->shippingAddress[$defaultShippingKey]->address_two !=''}
                        {$user->generalInfo->shippingAddress[$defaultShippingKey]->address_two !=''}<br />
                    {/if}
                    {$user->generalInfo->shippingAddress[$defaultShippingKey]->city}, {$user->generalInfo->shippingAddress[$defaultShippingKey]->state} {$user->generalInfo->shippingAddress[$defaultShippingKey]->zip}<br />
                    {$user->generalInfo->shippingAddress[$defaultShippingKey]->country}<br />
                    
                    {else}
                    Please add or select a delivery address from above.
                    {/if}
                    </div>
                </div>
                <div style="float:left; width:98%; padding:0px 10px 10px 10px;">
                	<a id="backToCartInfo" style="float:left;"><img src="/public/resources/css/images/backToCart.gif" style="margin-left:-13px;"/></a>
                	<a  id="nextToRewardPointAnchor" style="float:right;{if !$defaultShippingKey}
display:none;{/if}"><img src="/public/resources/css/images/nextToRewardPointsAndPromotions.gif"/></a>
                </div>
        </div>
        <h3><a href="#">Reward points and promotions: Step 3
        	</a></h3>
        <div>
            <div id="orderRewardsDetails" style="width:100%; float:left;">
           
                <div id="orderRewardMotherDiv" style="width:98%; float:left; padding:10px; border-bottom:1px solid #069;">
                    <div id="rewardPointNotice" style="width:50%; float:left;">
                    You have <span class="bigFont">{$userRewardPoint}</span> reward point(s) available. <br />
                    <span>4 points = $1</span><br />
                    </div>
                    <div id="rewardPointSelectionTitle" style="width:20%; float:left; text-align:right;">
                        Apply: 
                    </div>
                    <div id='rewardPointSelection' style='width:30%; float:left; '>
                        <select id="rewardPointSelection" class='inputShiftOne'>
                        {foreach from=$incrementalRewardNumber item=number key=Key}
                        <option value="{$number}">{$number} points/{$Key} dollars </option>
                        {/foreach}
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

{literal}
<script type="text/javascript">
new checkOutEnhancer('shippingAddressForm');


new simpleToggle('toggleAddShipping', 'editShippingForm', 'selectionOn');

$j(document).ready(function(){
							$j("#accordion").accordion({ autoHeight: false,disabled:true, collapsible:true});
});

var AccordionObject = $j("#accordion");

$("proceedToShippingInfoAnchor").observe('click', function(event){
														  // alert('hi');
														  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 1);
														  AccordionObject.accordion("option", "disabled",true);

														   //alert('hei');
														   });
$("nextToRewardPointAnchor").observe('click', function(event){	
													   
													   	  AccordionObject.accordion("option", "disabled", false);	
													   	  AccordionObject.accordion("option", "active", 2);
														  AccordionObject.accordion("option", "disabled",true);
												
														   });
														
$("backToShippingInfoAnchor").observe('click', function(event){
														  // alert('hi');
														  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 1);
														  AccordionObject.accordion("option", "disabled",true);
														   });
$("backToCartInfo").observe('click', function(event){
														  // alert('hi');
														  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 0);
														  AccordionObject.accordion("option", "disabled",true);
														   });

</script>


{/literal}
{include file="layouts/$layout/footer.tpl"}