	<div class='titleBarMid'><strong>Basic product attributes</strong></div>
	<label>Size type</label><select name="shoes_metric">
		<option value="US" {if $colorsAndShoesAttributes.shoes.0.shoes_metric=='US'}selected='selected'{/if}>US size</option>
		<option value="EU" {if $colorsAndShoesAttributes.shoes.0.shoes_metric=='EU'}selected='selected'{/if}>Euro size</option>
		<option value="BR" {if $colorsAndShoesAttributes.shoes.0.shoes_metric=='BR'}selected='selected'{/if}>British size</option>
	</select>
	<br/>
	<label>Smallest available size</label><select name="min_size">
		{foreach from=$measurement item=value}
			<option value="{$value}" {if $colorsAndShoesAttributes.shoes.0.min_size==$value}selected='selected'{/if}>{$value}</option>
		{/foreach}
	</select><br/>
	<label>Largest available size</label>
	<select name="max_size">
		{foreach from=$measurement item=value}
			<option value="{$value}" {if $colorsAndShoesAttributes.shoes.0.max_size==$value}selected='selected'{/if}>{$value}</option>
		{/foreach}
	</select><br/>
	<label>Size interval</label>
	<select name="size_interval">
		<option value="0.5" {if $colorsAndShoesAttributes.shoes.0.size_interval==$value}selected='selected'{/if}>0.5</option>
		<option value="1" {if $colorsAndShoesAttributes.shoes.0.size_interval==$value}selected='selected'{/if}>1</option>
	</select><br/>
	<label>Heel size selections</label>
	<div style='float:left; width:58%;'>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[one_inch]" {if $fp->systemColorAndShoesAttributes.heels.0.one_inch=="1"}checked='checked'{/if}/>1 inch</div>  
	<div style='float:left; width:30%'><input type="checkbox" name="heel[one_half_inch]" {if $fp->systemColorAndShoesAttributes.heels.0.one_half_inch=="1"}checked='checked'{/if}/>1.5 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[two_inch]" {if $fp->systemColorAndShoesAttributes.heels.0.two_inch=="1"}checked='checked'{/if}/>2 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[two_half_inch]" {if $fp->systemColorAndShoesAttributes.heels.0.two_half_inch=="1"}checked='checked'{/if}/>2.5 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[three_inch]" {if $fp->systemColorAndShoesAttributes.heels.0.three_inch=="1"}checked='checked'{/if}/>3 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[three_half_inch]" {if $fp->systemColorAndShoesAttributes.heels.0.three_half_inch=="1"}checked='checked'{/if}/>3.5 inch</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[heel_50_mm]" {if $fp->systemColorAndShoesAttributes.heels.0.heel_50_mm=="1"}checked='checked'{/if}/>50 mm</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[heel_70_mm]" {if $fp->systemColorAndShoesAttributes.heels.0.heel_70_mm=="1"}checked='checked'{/if}/>70 mm</div>
	<div style='float:left; width:30%'><input type="checkbox" name="heel[heel_90_mm]" {if $fp->systemColorAndShoesAttributes.heels.0.heel_90_mm=="1"}checked='checked'{/if}/>90 mm</div>
	</div>