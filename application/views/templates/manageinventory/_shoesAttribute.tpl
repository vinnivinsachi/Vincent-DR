	<label>Size selection:</label>

	<select name='sys_shoe_metric' class='inputShiftOne'>
		{if $product.0.purchase_type=='Customizable'}
		<option value='{$product.systemColorAndShoesAttributes.shoes.0.shoes_metric}'>{$product.systemColorAndShoesAttributes.shoes.0.shoes_metric}</option>
		{else}
		<option value='EU'>Euro Size</option>
		<option value='US'>US Size</option>
		<option value='BR'>British Size</option>
		{/if}
	</select>
	<select name="sys_shoe_size">
		{foreach from=$measurements item=measurement}
		<option value='{$measurement}'>{$measurement}</option>
		{/foreach}
	</select><br/>
	<label>Heel size:</label>
	<select name="sys_shoe_heel" class='inputShiftOne'>
		{if $product.0.purchase_type=='Customizable'}
			{foreach from=$heels item=item}
			<option value='{removeunderscore phrase=$item}'>{removeunderscore phrase=$item}</option>
			{/foreach}
		{else}
			<option value='1 inch'>1 inch</option>
			<option value='1.5 inch'>1.5 inch</option>
			<option value='2 inch'>2 inch</option>
			<option value='2.5 inch'>2.5 inch</option>
			<option value='3 inch'>3 inch</option>
			<option value='50 mm'>50 mm</option>
			<option value='70 mm'>70 mm</option>
			<option value='90 mm'>90 mm</option>
		{/if}
	</select>