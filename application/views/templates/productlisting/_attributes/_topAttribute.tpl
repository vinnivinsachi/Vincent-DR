<label>Size:</label>
<select name='inventory[sys_top_size]' class='inputShiftOne'>
		<option value='XS' {if $inventory.basic.sys_fullbody_size=='XS'} selected="selected"{/if}>XS (0-2)</option>
		<option value='S' {if $inventory.basic.sys_fullbody_size=='S'} selected="selected"{/if}>S (3-4)</option>
		<option value='M' {if $inventory.basic.sys_fullbody_size=='M'} selected="selected"{/if}>M (5-6)</option>
		<option value='L' {if $inventory.basic.sys_fullbody_size=='L'} selected="selected"{/if}>L (7-8)</option>
		<option value='XL' {if $inventory.basic.sys_fullbody_size=='XL'} selected="selected"{/if}>XL (9-10)</option>
</select>
		
</div>

<div class='formRightDivision'>
			<div class="danceWearPartials">

<div class='titleBarMid '><strong>Product Details</strong></div>
{foreach from=$measurements item=measurement key=Key}
<label>{$Key}</label>
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