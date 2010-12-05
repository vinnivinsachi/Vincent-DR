<label>Waist:</label>
<select name='inventory[sys_bottom_size]' class='inputShiftOne'>
		<option value='XS' {if $inventory.basic.sys_bottom_size=='XS'} selected="selected"{/if}>XS</option>
		<option value='S' {if $inventory.basic.sys_bottom_size=='S'} selected="selected"{/if}>S</option>
		<option value='M' {if $inventory.basic.sys_bottom_size=='M'} selected="selected"{/if}>M</option>
		<option value='L' {if $inventory.basic.sys_bottom_size=='L'} selected="selected"{/if}>L</option>
		<option value='XL' {if $inventory.basic.sys_bottom_size=='XL'} selected="selected"{/if}>XL</option>
		<option value='50 cm' {if $inventory.basic.sys_bottom_size=='50 cm'} selected="selected"{/if}>50 cm</option>
		<option value='53 cm' {if $inventory.basic.sys_bottom_size=='53 cm'} selected="selected"{/if}>53 cm</option>
		<option value='56 cm' {if $inventory.basic.sys_bottom_size=='56 cm'} selected="selected"{/if}>56 cm</option>
		<option value='59 cm' {if $inventory.basic.sys_bottom_size=='59 cm'} selected="selected"{/if}>59 cm</option>
		<option value='62 cm' {if $inventory.basic.sys_bottom_size=='62 cm'} selected="selected"{/if}>62 cm</option>
		<option value='65 cm' {if $inventory.basic.sys_bottom_size=='65 cm'} selected="selected"{/if}>65 cm</option>
		<option value='68 cm' {if $inventory.basic.sys_bottom_size=='68 cm'} selected="selected"{/if}>68 cm</option>
		<option value='71 cm' {if $inventory.basic.sys_bottom_size=='71 cm'} selected="selected"{/if}>71 cm</option>
		<option value='74 cm' {if $inventory.basic.sys_bottom_size=='74 cm'} selected="selected"{/if}>74 cm</option>
		<option value='77 cm' {if $inventory.basic.sys_bottom_size=='77 cm'} selected="selected"{/if}>77 cm</option>
		<option value='80 cm' {if $inventory.basic.sys_bottom_size=='80 cm'} selected="selected"{/if}>80 cm</option>
		<option value='83 cm' {if $inventory.basic.sys_bottom_size=='83 cm'} selected="selected"{/if}>83 cm</option>
		<option value='86 cm' {if $inventory.basic.sys_bottom_size=='86 cm'} selected="selected"{/if}>86 cm</option>
		<option value='89 cm' {if $inventory.basic.sys_bottom_size=='89 cm'} selected="selected"{/if}>89 cm</option>
		<option value='92 cm' {if $inventory.basic.sys_bottom_size=='92 cm'} selected="selected"{/if}>92 cm</option>
		<option value='95 cm' {if $inventory.basic.sys_bottom_size=='95 cm'} selected="selected"{/if}>95 cm</option>
		<option value='98 cm' {if $inventory.basic.sys_bottom_size=='98 cm'} selected="selected"{/if}>98 cm</option>
		<option value='101 cm' {if $inventory.basic.sys_bottom_size=='101 cm'} selected="selected"{/if}>101 cm</option>
		<option value='104 cm' {if $inventory.basic.sys_bottom_size=='104 cm'} selected="selected"{/if}>104 cm</option>
		<option value='107 cm' {if $inventory.basic.sys_bottom_size=='107 cm'} selected="selected"{/if}>107 cm</option>
		<option value='110 cm' {if $inventory.basic.sys_bottom_size=='110 cm'} selected="selected"{/if}>110 cm</option>
		<option value='113 cm' {if $inventory.basic.sys_bottom_size=='113 cm'} selected="selected"{/if}>113 cm</option>
		<option value='116 cm' {if $inventory.basic.sys_bottom_size=='116 cm'} selected="selected"{/if}>116 cm</option>
		<option value='119 cm' {if $inventory.basic.sys_bottom_size=='119 cm'} selected="selected"{/if}>119 cm</option>
</select>
		
</div>

<div class='formRightDivision'>
			<div class="danceWearPartials">


<div class='titleBarMid '><strong>Product details</strong></div>
{foreach from=$measurements item=measurement key=Key}
<label>{$Key}:</label>
	<select name='inventory[{$Key}]' class='inputShiftOne'>
		{foreach from=$inventory.profile item=profile}
			{if $Key==$profile.profile_key}
				<option value='{$profile.profile_value}'>{$profile.profile_value}</option>
			{/if}
		{/foreach}
		{foreach from=$measurement item=value}
		<option value='{$value} cm'>{$value} cm</option>
		{/foreach}
	</select><br/>
{/foreach}