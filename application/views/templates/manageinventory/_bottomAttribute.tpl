<label>Waist:</label>
<select name='sys_bottom_size' class='inputShiftOne'>
		<option value='50 cm'>50 cm</option>
		<option value='53 cm'>53 cm</option>
		<option value='56 cm'>56 cm</option>
		<option value='59 cm'>59 cm</option>
		<option value='62 cm'>62 cm</option>
		<option value='65 cm'>65 cm</option>
		<option value='68 cm'>68 cm</option>
		<option value='71 cm'>71 cm</option>
		<option value='74 cm'>74 cm</option>
		<option value='77 cm'>77 cm</option>
		<option value='80 cm'>80 cm</option>
		<option value='83 cm'>83 cm</option>
		<option value='86 cm'>86 cm</option>
		<option value='89 cm'>89 cm</option>
		<option value='92 cm'>92 cm</option>
		<option value='95 cm'>95 cm</option>
		<option value='98 cm'>98 cm</option>
		<option value='101 cm'>101 cm</option>
		<option value='104 cm'>104 cm</option>
		<option value='107 cm'>107 cm</option>
		<option value='110 cm'>110 cm</option>
		<option value='113 cm'>113 cm</option>
		<option value='116 cm'>116 cm</option>
		<option value='119 cm'>119 cm</option>
</select><br/>

<div class='titleBarMid marginTop20'><strong>Product details</strong></div>
{foreach from=$measurements item=measurement key=Key}
<label>{$Key}:</label>
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
