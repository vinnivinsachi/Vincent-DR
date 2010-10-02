{include file='header.tpl' section='membershipmanager'}


<form method="post" action="{geturl action='individualduesetstatus'}">

	<div class="prview-status">
		<input type="hidden" name="key" value="{$product->getId()}" />
		{if $product->isLive()}
			<div class="status live">
				This product IS published. To unpublish it click the <strong>Unpublish Product</strong> button below.
				<div>
					<input type="submit" value="Unpublish Due" name="unpublish" id="status-unpublish" />
					<input type="submit" value="Edit Due" name="edit" id="status-edit" />
					<input type="submit" value="Delete" name="delete" id="status-delete" />
				</div>
			</div>
		{else}
			<div class="status draft">
				This product is NOT published. To publish it click the <strong>Publish Product</strong> button below.
				<div>
					<input type="submit" value="Publish Due" name="publish" id="status-publish" />

					<input type="submit" value="Edit Due" name="edit" id="status-edit" >
					<input type="submit" value="Delete" name="delete" id="status-delete" />
				</div>
			</div>
		{/if}
	
	</div>
</form>


<table class="shoppingcart">
	<tr class="title">
		<td>Name of due</td>
		<td>Date</td>
		<td>Amount</td>
		<td>Description</td>
		<td>Payment status</td>
	</tr>
	
	<tr class="row">
		<td class="name">
			{$product->profile->name}
		</td>
		<td>
			{$product->date_set|date_format:'%x %X'}
		</td>

		<td>
			${$product->profile->price}
		</td>
		
		<td>
			{$product->profile->content}
		</td>
		<td>
			{$product->payment_status}
		</td>
		
	</tr>
</table>


{include file='footer.tpl' leftcolumn='membershipmanager/lib/left-column.tpl'}