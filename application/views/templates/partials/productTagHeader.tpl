<div id="productTagHeader">
    <a class="productTagHeaderButton {if $page=='Customizable'}currentSelection{/if}" href="/productdisplay/index?purchaseType=Customizable{if isset($tag)}&tag={$tag}{/if}">Customizables</a>
    <a class="productTagHeaderButton {if $page=='Buy_now'}currentSelection{/if}" href="/productdisplay/index?purchaseType=Buy_now{if isset($tag)}&tag={$tag}{/if}">Buy it now</a>
    <a class="shoppingCartIcon" style="float:right; margin-top:3px;" href="{geturl controller='shoppingcart' action='index'}"><img src="{$siteRoot}/public/resources/css/images/shoppingcart_flattened.png" width="35" /></a>
    <span style="float:right; margin-top:9px;">{$shoppingCartInfo->totalItems} item in your <a href="{geturl controller='shoppingcart' action='index'}" style="font-size:14px;">cart</a></span>
</div>

<div id='controllerMessage'>
	{if !$authenticated}
		{if isset($controllerMessage)}{$controllerMessage}{/if}
	{/if}
	{if !$authenticated AND $controller=='Comparechart'}
		<a class='largeAnchorButton' href="{geturl controller='comparechart' action='savecomparelist'}">Save compare chart</a>
	{elseif $controller=='Comparechart'}
		<span class='bigBoldFont'>Compare chart</span>
	{/if}
</div>

<div id="breadcrumbs" style='padding-top:10px; padding-bottom:10px;'>
    <span style="font-size:1.2em; float:left; font-weight:bold;">{$tag}</span>
	<span style='font-size:1.2em; float:right;'><a>1</a></span>
</div>

<!-- href="/productdisplay/index?purchaseType=Customizable{if isset($tag)}&tag={$tag}{/if}" -->
<!-- href="/productdisplay/index?purchaseType=Buy_now{if isset($tag)}&tag={$tag}{/if}" -->