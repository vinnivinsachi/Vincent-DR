{literal}
<div class='product-preview-small'>
	<table width='150'><tbody>
		<tr>
			<td><a href='#product-preview-large-${productUniqueID}'><img width='150' height='150' src='${_images[0].filename}' /></a></td>
		</tr>
		<tr>
			<td class='product-price'>$${price}</td>
		</tr>
	</tbody></table>
	
	<!-- popup info -->
	<div style='display:none;'>
		<div id='product-preview-large-${productUniqueID}' class='product-preview-large'>
			<table><tbody>
				<tr>
					<td>
						<div><img class='large-img' src='${_images[0].filename}'/></div><br />
						<div>{{each _images}}<a href='javascript:;'><img class='mini-img' src='${$value.filename}' /></a>{{/each}}</div>
					</td>
					<td>
						<table><tbody>
							<tr>
								<td>LOTS OF MEASUREMENT INFO HERE...</td>
							</tr>
							<tr>
								<td><button loading-text='processing...'>Add To Cart</button></td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</div>
	</div>
</div>
{/literal}