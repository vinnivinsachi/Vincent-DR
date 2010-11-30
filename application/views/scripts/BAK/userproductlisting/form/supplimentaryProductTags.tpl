 <fieldset id="preview-tags" style="padding:20px;">
	<legend>Categories</legend>
		Categories will display your units under the correct links on the leftside panel of the main navigational bar. 
	<ul>
	
		{foreach from=$tags item=tag}
			<li>
				<form method="post" action="{geturl action='tags'}">
				<div>
					{$tag.tag|escape}
					<input type="hidden" name="id" value="{$product->getId()}" />
					<input type="hidden" name="product" value="{$product->product_type}" />
                    <input type="hidden" name="tagid" value="{$tag.tag_id}" />
					<input type="submit" name="delete" value="delete" />
				</div>
                Your product will be displayed under the following tag links:<br />
                <a href="{geturl controller='userproductpreview' action='tag'}?tag={$tag.tag}">view your product here</a>
				</form>
			</li>
		{foreachelse} 
			No categories for this product
		{/foreach}
	</ul>
	
	<br/>
	
	<form method="post" action="{geturl action ='tags'}">
		<div>
			<input type="hidden" name="id" value="{$product->getId()}" />
            <input type="hidden" name="product" value="{$product->product_type}" />
			<select name="tag">
            	<option value="Latin pants">Latin Pants</option>
                <option value="Vests">vests</option>
				<option value="Standard skirts">Standard skirts</option>
                <option value="Latin skirts">Latin skirts</option>
                <option value="Latin dresses">Latin dresses</option>
                <option value="Standard dresses">Standard dresses</option>
                <option value="Latin women shoes">Latin women shoes</option>
                <option value="Latin men shoes">Latin men shoes</option>
                <option value="Standard women shoes">Standard women shoes</option>
                <option value="Standard men shoes">Standard men shoes</option>
                <option value="Tails">Tails</option>
            </select>
			<input type="submit" name="add" value="Add To Category" />
		</div>
	</form>
	
	
	</fieldset>