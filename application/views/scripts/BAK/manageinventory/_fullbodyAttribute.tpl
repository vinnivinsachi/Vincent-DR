<label>Size:</label>
<select name='sys_fullbody_size' class='inputShiftOne'>
		<option value='XS'>XS (0-2)</option>
		<option value='S'>S (3-4)</option>
		<option value='M'>M (5-6)</option>
		<option value='L'>L (7-8)</option>
		<option value='XL'>XL (9-10)</option>
</select><br/>

<div class='titleBarMid marginTop20'><strong>Product Details</strong></div>
{foreach from=$measurements item=measurement key=Key}
<label>{$Key}</label>
	<select name='{$Key}' class='inputShiftOne'>
		{foreach from=$measurement item=value}
		<option value='{$value} cm'>{$value} cm</option>
		{/foreach}
	</select><br/>
{/foreach}

<div class='sys_quantity_div'>
			<label>Quantity:</label>
			<select name='sys_quantity' class='inputShiftOne'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
			<option value='6'>5</option>
			<option value='7'>7</option>
			<option value='8'>8</option>
			<option value='9'>9</option>
			<option value='10'>10</option>
			</select>
			</div>