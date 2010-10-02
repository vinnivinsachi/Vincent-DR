{include file="layouts/$layout/header.tpl" lightbox=true}

<table class="shoppingcart">
		<tr class="title2">
		{if $orderType=='seller'}
			<td>Order From:</td>
		{else}
			<td>Order To:</td>
		{/if}
			<td>Time:</td>
			<td>Total amount:</td>
			<td>Details:</td>
			<td>Feedback:</td>
			<td>Status:</td>
		</tr>
{foreach from=$orders item=order name=order}

	{include file='ordermanager/lib/order-list.tpl' order=$order}

{/foreach}

</table>


{include file="layouts/$layout/footer.tpl"}