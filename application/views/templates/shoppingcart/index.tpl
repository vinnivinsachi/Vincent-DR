{include file="layouts/$layout/header.tpl" lightbox=true}
{include file="layouts/vinceTemp/header.tpl"}

<div id="leftContainer" style="width:210px; float:left;">
{include file='partials/leftColumnIndex.tpl'}
</div>
<div id="rightContainer" style='width:750px; float:left; padding:20px;'>
	{include file='partials/indexTagHeader.tpl' indexTagHeaderTitleName="Shopping cart"}

	<div id="orderMainDiv" style="float:left; width:100%;">
    	            {if $shoppingCartProducts|@count>0}
    	
        	{include file='partials/shoppingcart/_basketInformation.tpl'}
         {else}
            Your shopping cart is empty.
            {/if}
       	<!-- end of product forloop-->
        <div id="proceedShoppingCart" style="width:100%; float:left; text-align:right;">
         	<a href="{geturl action='resetshoppingcart'}" style="float:left; margin-top:10px;"><img src="{$siteRoot}/public/resources/css/images/OLD/empty Cart.gif" /></a>
            {if $shoppingCartInfo->totalItems >0}
        	<a href="{geturl controller='checkout' action='index'}" style="float:right; margin-top:10px;"><img src="{$siteRoot}/public/resources/css/images/OLD/nextToCheckout.gif" /></a>
            {/if}
        </div>
    </div>
</div>

{include file="layouts/$layout/footer.tpl"}