<div id="basketInformation">
			<div id="productOrderTopTile" class='box'>
				<table class='box marginTop10'>
					<tr class='trTitle'><td>Product</td>
					<td style='text-align:center;'>Details</td>
					<td style='text-align: right;'>Quantity</td>
					<td style='text-align: right;'>Price</td>
					<td style='text-align: right;'>Reward Points</td>
					<td style='text-align: right;'></td></tr>
					
					{foreach from=$shoppingCartProducts item=product key=cartKey}
					<tr><td><br/><strong>{$product.product_name}</strong><br/>{$product.uploader_username} / {removeunderscore phrase=$product.purchase_type}<br/><br/><img src='/public/resources/userdata/tmp/thumbnails/{$product.uploader_username}/{$product.product_tag}/{$product.product_image_id}.W150_homeFrontFour.jpg'/></td>
						<td ><table width="100%;">
							{foreach from=$product.attributes item=attributes key=Key}
	                            <tr>
	                            <td style='text-align:right; width:60%;'>{removeunderscore phrase=$Key}: </td>
	                            <td style='text-align:left; width:40%;'>{removeunderscore phrase=$attributes}</td>
	                            </tr>
                            {/foreach}
                            </table>
		                </td>
		                <td style='text-align: right;'>1</td>
		                <td style='text-align: right;' class='price'>
							${$product.product_price}
		                </td>
		                <td style='text-align: right; width:100px;'>
							+ {$product.reward_points_awarded} points
		                </td>
		                <td style='text-align: right; width:100px;'>
		                <a href="{geturl controller='shoppingcart' action='removeitemsfromshoppingcart'}?cartProductId={$cartKey}"><img src="{$siteRoot}/public/resources/css/images/Crosses.png" style="margin-bottom:-10px;"/></a>
		                </td>
					</tr>
					<tr style='border-bottom: 1px solid #666; '><td colspan='2'></td>
                    <td style='padding-bottom:5px; text-align:right;'>Shipping:</td>
                    <td style='padding-bottom:5px; text-align:right;'>
                    <span class='price' >${$product.current_shipping_rate}</span>
                	</td><td colspan='2' style='text-align:right;'> {if $product.product_type_added_to_shopping_cart=='Inventory'}
                    Ship with in 3-5 days.
                    {elseif $product.product_type_added_to_shopping_cart=='Customize'}
                    Ship with in {$product.backorder_time}
                    {/if}</td></tr>
					{/foreach}
				</table>
				
			</div>
</div>