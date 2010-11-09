{include file='header.tpl' lightbox=true section='orders' section='order'}

<h3 {if $order->status=='complete'}class="background1"{elseif $order->status=='pending'}class="background2"{/if}>{if $orderType=='seller'}
		Order From: <br/>
	{else}
		Order To: <br/>
	{/if}
	
	{if $guest=='true'}
		{$oppositeUser->first_name} {$oppositeUser->last_name}<br/>
		{$oppositeUser->address}<br/>
		{$oppositeUser->city}<br/>
		{$oppositeUser->state}<br/>
		{$oppositeUser->zip}<br/>
		{$oppositeUser->email}<br/>
	{else}
		{$oppositeUser->profile->first_name} {$oppositeUser->last_name}<br/>
		{$oppositeUser->profile->address}<br/>
		{$oppositeUser->profile->city}<br/>
		{$oppositeUser->profile->state}<br/>
		{$oppositeUser->profile->zip}<br/>
		{$oppositeUser->profile->email}<br/>
		{$oppositeUser->universityName}<br/>
	{/if}
		
	{if $order->status=='complete'}  (processed, order will be shipped immediately, allow one week for delivery) {elseif $order->status=='pending'}   (this order is currently being verified, once verified, it will be shown as processed.) {/if}	</h3>
<h3>Order ID: {$order->url}</h3>
<h3>Order Time: {$order->ts_created|date_format:'%b %e,%Y %l:%M %p'}</h3>

<table class="shoppingcart">
		<tr class="title">
			<td>Product Name:</td>
			<td>Product Type:</td>
			<td>Unit Price: </td>
			<td>Quantity: </td>
			{if $orderType=='seller'}
			<td>Action: </td>
			{/if}
		</tr>
		
		
		{foreach from=$orderProfile item=profile}
			{include file='ordermanager/lib/order-details.tpl'}
		
		{/foreach}
		
	
		<tr class="total">
			<td colspan="{if $orderType=='seller'}4{else}3{/if}">Total:</td>
			<td>$ {$order->total_amount}</td>
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
<br/>



{include file='footer.tpl' products=$cartObject  leftcolumn='lib/ProductList.tpl'}