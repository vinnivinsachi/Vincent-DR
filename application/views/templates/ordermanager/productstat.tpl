{include file='header.tpl' lightbox=true section='orders'}

<h3>Product name: {$productName}</h3>
<h3>Product type: {$type}</h3>



<table class="shoppingcart">
		<tr class="title2">
		
			<td>Buyer:</td>
			<td>Purchase time:</td>
			<td>Order Details:</td>
			<td>Message:</td>
			<td>Status:</td>
		</tr>
		
		
{foreach from=$orders item=order name=order}

	{include file='ordermanager/lib/stat-list.tpl' order=$order}

{/foreach}

</table>

{include file='footer.tpl' products=$cartObject  leftcolumn='lib/ProductList.tpl'}