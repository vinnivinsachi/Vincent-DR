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
        Phone: 				{$oppositeUser->phone}<br/>
       	Car available: 		{$oppositeUser->car}<br />
		Boombox available: 	{$oppositeUser->boombox}<br />
        Ethnicity: 			{$oppositeUser->ethnicity}<br />
        How did you hear about us?  {$oppositeUser->hear_about_us}<br />
        School: 			{$oppositeUser->school}<br />

	{else}
		{$oppositeUser->profile->first_name} {$oppositeUser->last_name}<br/>
		{$oppositeUser->profile->address}<br/>
		{$oppositeUser->profile->city}<br/>
		{$oppositeUser->profile->state}<br/>
		{$oppositeUser->profile->zip}<br/>
		{$oppositeUser->profile->email}<br/>
		{$oppositeUser->universityName}<br/>
	{/if}
		
  Thank you for your purchase	</h3>
<h3>Order ID: {$order->url}</h3>
<h3>Order Time: {$order->ts_created|date_format:'%b %e,%Y %l:%M %p'}</h3>

<table class="shoppingcart">
		<tr class="title2">
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
<table>
	<tr>
	{if $orderType=='seller'}
		<td>
			<form action="" ><input type="submit" value="Message to member buyer"></form>
		</td>
	{else}
		<td>
			<form action=""><input type="submit" value="Write a Feedback (tell us about your order!)"></form>
		</td>
	{/if}
	
	{if $orderType=='seller'}
		{if $order->status=='pending'}
		<td>
			<form method="post" action="{geturl action='verification' controller='ordermanager'}"><input type="hidden" name="orderID" value="{$order->url}" /><input type="hidden" name="action" value="verify" /><input type="submit" value="Verify this order"></form>
		</td>
		{elseif $order->status=='complete'}
		<td>
			<form method="post" action="{geturl action='verification' controller='ordermanager'}"><input type="hidden" name="orderID" value="{$order->url}" /><input type="hidden" name="action" value="unverify" /><input type="submit" value="Take back verification"></form>
		</td>
		{/if}
	{/if}
</table>


{include file='footer.tpl' products=$cartObject  leftcolumn='lib/ProductList.tpl'}