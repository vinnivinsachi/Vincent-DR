{include file='header.tpl' }


<div id="leftContainer">
<div>
	<fieldset>
		<legend>Checkout Cart: PLEASE VERIFY</legend>
		<h2 style="text-align:center;">Seller: {$club->profile->public_club_name}</h2>
		
		<table class="shoppingcart">
			<tr class="title">
				<td>Name:</td>
				
				
				<td>Quantity:</td>
				<td>Total: </td>
				<td>Action:</td>
			</tr>
			
			{foreach from=$productsProfile item=profile}
					{include file='checkout/lib/cart-details.tpl'}
		
				
				{/foreach}

			
			<tr class="total">
				<td colspan="3">Total:</td>
		
				<td>$ {$total}</td>
			</tr>
			
			
			
			
		</table>

		<br/>
		<a href="{geturl username=$club->username route='clubproduct'}" class="buttonLeft">Buy our apparel</a>
		<a href="{geturl controller='shoppingcart' action='emptycart'}/?cartID={$cartID}" class="buttonRight">Empty Cart</a>
		<a href="{geturl controller='checkout' action='checkoutfinal'}" class="buttonRight2">Proceed with Paypal</a>

	</fieldset>
	
	<br/>
			
</div>

</div>

{include file='footer.tpl' leftcolumn='lib/university-list.tpl' }