<tr class="row">
	<td>{$inv->size}</td>
	<td>{$inv->heel}</td>
	<td>{$inv->color}</td>
	<td>{$inv->width}</td>
	<td>{$inv->price}</td>
	<td>{$inv->quantity}</td>
	<td>
	<form method="post" action="{geturl action='deleteinventory' controller='inventory'}">
				
		<input type="hidden" name="id" value="{$inv->getId()}" />
		<input type="hidden" name="product_id" value="{$product->getId()}" />
		<input type="submit" name="delete" value="delete" />
	
	</form>
	
	<td>
</tr>
	