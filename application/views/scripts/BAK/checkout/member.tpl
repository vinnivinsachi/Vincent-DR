{include file='header.tpl' }


<br/>

<div>
	<fieldset>
		<legend>PLEASE VERIFY THAT THE FOLLOWING INFORMATION IS CORRECT</legend>
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
			
			
			{if $addPromo!='true'}
				<br/>
				<br/>
				<br/>
				<tr >
					<td colspan="3">PromotionCode:</td>
					<td># {$promoCode}</td>
				</tr>
				
				<tr>
					<td colspan="3">Discount amount</td>
					<td style="color:red"> {$discount} dollar</td>
				</tr>
				
				<tr class="total">
					<td colspan="3">Final amount charged:</td>
					<td >$ {$finalTotal}</td>
				</tr>
			{/if}
		</table>
		
		
			
		

		<br/>
		<a href="{geturl username=$club->username route='clubproduct'}" class="buttonLeft">Continue Shopping</a>
		<a href="{geturl controller='shoppingcart' action='emptycart'}/?cartID={$cartID}" class="buttonRight">Empty Cart</a>
		
		{if $addPromo=='true'}
		<a href="{geturl action='index'}" class="buttonRight">Add Promotion Code</a>
		{/if}
		<a href="{geturl controller='checkout' action='checkoutfinal'}" class="buttonHuge">Pay with Paypal</a>

	</fieldset>
	
			<br/>
			

</div>




{include file='footer.tpl' leftcolumn='lib/productList.tpl' product= $cartObject}