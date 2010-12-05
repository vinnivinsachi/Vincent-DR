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
                <option value="vests">vests</option>
				<option value="standard skirts">Standard skirts</option>
                <option value="latin skirts">Latin skirts</option>
                <option value="latin women shoes">Latin women shoes</option>
                <option value="latin men shoes">Latin men shoes</option>
                <option value="standard women shoes">Standard women shoes</option>
                <option value="standard men shoes">Standard men shoes</option>
                <option value="tails">Tails</option>
            </select>
			<input type="submit" name="add" value="Add To Category" />
		</div>
	</form>
	
	
	</fieldset>
