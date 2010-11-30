<div class='productDetailTop' class='box'>
	<div class='titleBarMid'>Customize order </div>
	</div>
	<label>Size selection:</label>
	<select name='attribute[sys_shoe_metric]' >
		<option value='{$product.systemColorAndShoesAttributes.shoes.0.shoes_metric}'>{$product.systemColorAndShoesAttributes.shoes.0.shoes_metric}</option>
	</select>
	<select name="attribute[sys_shoe_size]">
		{foreach from=$measurements item=measurement}
		<option value='{$measurement}'>{$measurement}</option>
		{/foreach}
	</select><br/>
	<label>Heel size:</label>
	<select name="attribute[sys_shoe_heel]" >
		{foreach from=$heels item=item}
		<option value='{removeunderscore phrase=$item}'>{removeunderscore phrase=$item}</option>
		{/foreach}
	</select>
	<div class='box'>
	<label class='mid'>Color:</label>
	<div class='box' style='width:250px;'>
	{foreach from=$product.systemColorAndShoesAttributes.colors.0 item=color key=colorKey}
		{if $colorKey!='product_id'}
			{if $color=='1'}
			<input type='radio' name='attribute[color]' value='{$colorKey}' />{removeunderscore phrase=$colorKey}
			{/if}
		{/if}
	{/foreach}
	</div>
	</div>
	{foreach from=$product.existingFabricSet item=fabricSet}
	<div class='box'>
	
	<label class='mid'>{removeunderscore phrase=$fabricSet.basicInfo.0.name_of_set}</label>
		<div class='box' style='width:250px;'>
		{foreach from=$fabricSet.details item=fabricSetDetail}
			<input type='radio' name='attribute[{$fabricSet.basicInfo.0.name_of_set}]' value='{$fabricSetDetail.details_name}'/>{removeunderscore phrase=$fabricSetDetail.details_name}
		{/foreach}
		</div>
	</div>
		
	{/foreach}
	
	{foreach from=$product.existingAttributeSet item=customSet}
	<div class='box'>
	<label class='mid'>{removeunderscore phrase=$customSet.basicInfo.0.name_of_set}</label>
			<div class='box' style='width:250px;'>
	
		{foreach from=$customSet.details item=customSetDetail}
			<input type='radio' name='attribute[{$customSet.basicInfo.0.name_of_set}]' value='{$customSetDetail.details_name}'/>{removeunderscore phrase=$customSetDetail.details_name}
		{/foreach}
		</div>
	</div>
	{/foreach}
	<div class='box'>
	<label>Backorder time:</label>
	{$product.0.backorder_time}
	</div>
	
	<div class='box' style='margin-top:5px;'>
	<label>Addtional instructions:</label>
 	<textarea rows="5" cols=20" name='attribute[additional_instructions]'></textarea>
 	</div>
 <div class='box' style='padding-top:20px;'>
  {if $product.discount_price=='' || $product.discount_price==0}
       <div class="discountBoxPrice">
         ${$product.0.price}
       </div>
  {elseif $product.discount_price>0}
       <div class="productBoxPrice">
         ${$product.0.price}
       </div>

       <div class="discountBoxPrice">
         ${$product.0.discount_price}
       </div>
   {/if}
 </div>
 
 
