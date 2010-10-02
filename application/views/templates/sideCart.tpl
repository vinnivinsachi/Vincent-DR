{if $cartObject|@count>0}
				<div class="box-top-middle"><p style="padding-top:10px;">Shopping Cart</p></div>
			
				<div class="box">
					<br/>
					<table class="shoppingcart">
						<tr class="title">
							<td>Name:</td>
							
							<td>Quantity:</td>
						</tr>
			
							{foreach from=$cartObject item=product}
							<tr class="row">
								<td>
								
								{$product->product_name}</td>
								
								
								<td>{$product->quantity}</td>
								
							</tr>
							{/foreach} 
						
						
						<tr class="total">
							<td >Total:</td>
							<td>${$total}</td>
						</tr>
						
					</table>
				
					<br/>
					<a href="{geturl controller='checkout' action='guest'}" class="cartButtonRight">Check Out</a>
					<a href="{geturl controller='shoppingcart' action='index'}" class="cartButtonRight">Review Cart</a>
					<div class="box-bottom"></div>
				</div>
			{/if}