	<label>Size selection:</label>

	<select name='inventory[sys_shoe_metric]' class='inputShiftOne'>
		<option value='EU' {if $inventory.basic.sys_shoe_metric=='EU'} selected="selected"{/if}>Euro Size</option>
		<option value='US' {if $inventory.basic.sys_shoe_metric=='US'} selected="selected"{/if}>US Size</option>
		<option value='BR' {if $inventory.basic.sys_shoe_metric=='BR'} selected="selected"{/if}>British Size</option>
	</select>
	<select name="inventory[sys_shoe_size]">
		{foreach from=$measurements item=measurement}
		<option value='{$measurement}' {if $inventory.basic.sys_shoe_size==$measurement} selected="selected"{/if}>{$measurement}</option>
		{/foreach}
	</select><br/>
	<label>Heel size:</label>
	<select name="inventory[sys_shoe_heel]" class='inputShiftOne'>
			<option value='1 inch' {if $inventory.basic.sys_shoe_heel=='1 inch'} selected="selected"{/if}>1 inch</option>
			<option value='1.5 inch' {if $inventory.basic.sys_shoe_heel=='1.5 inch'} selected="selected"{/if}>1.5 inch</option>
			<option value='2 inch' {if $inventory.basic.sys_shoe_heel=='2 inch'} selected="selected"{/if}>2 inch</option>
			<option value='2.5 inch' {if $inventory.basic.sys_shoe_heel=='2.5 inch'} selected="selected"{/if}>2.5 inch</option>
			<option value='3 inch' {if $inventory.basic.sys_shoe_heel=='3 inch'} selected="selected"{/if}>3 inch</option>
			<option value='50 mm' {if $inventory.basic.sys_shoe_heel=='50 mm'} selected="selected"{/if}>50 mm</option>
			<option value='70 mm' {if $inventory.basic.sys_shoe_heel=='70 mm'} selected="selected"{/if}>70 mm</option>
			<option value='90 mm' {if $inventory.basic.sys_shoe_heel=='90 mm'} selected="selected"{/if}>90 mm</option>
	</select>
			
</div>

<div class='formRightDivision'>
			<div class="danceWearPartials">
			<div class='titleBarMid'><strong>Product Details</strong></div>
			
	