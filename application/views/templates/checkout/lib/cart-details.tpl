<tr class="row">
	<td>
			
		<div style="font-size: 1.2em; color:#0099CC">
		<!--//{if $profile->ProductAttribute->inv_id ==''}-->
		<a href="{geturl controller='shoppingcart' action='view'}?profileID={$profile->getId()}&cartID={$cartID}" >{$profile->product_name}</a></div>
		<!--{else}
		{$profile->product_name} (inventory)<br/>
		{/if}-->
		
		{if $profile->ProductAttribute->size != ''}
		
			Size: {$profile->ProductAttribute->size}
		
		{/if}
		
		
	</td>
	

	<td>
		{$profile->quantity}
	
	</td>
	<td>
		{$profile->unit_cost}
	</td>


	<td>
	<a href="/shoppingcart/uofmballroom/{$profile->product_type}/deleteproduct/?productID={$profile->product_id}&cartID={$cartID}&cart_profileID={$profile->getId()}" class="buttonLeft">Delete</a> 
	
	{if $profile->ProductAttribute->inv_id ==''}

<a  href="{geturl controller='shoppingcart' action='view'}?profileID={$profile->getId()}&cartID={$cartID}&edit=true" class="buttonRight2">Edit</a>
{/if}
	</td>
	
</tr>


	