{include file='header.tpl' section='membershipmanager'}
<script type="text/javascript" src="/htdocs/js_plugin/blogPreview.js"></script>
<script type="text/javascript" src="/htdocs/js_plugin/BlogImageManager.class.js"></script>


<form method="post" action="{geturl action='setstatus'}">

	<div class="prview-status">
		<input type="hidden" name="id" value="{$product->getId()}" />
		{if $product->isLive()}
			<div class="status live">
				This product IS published. To unpublish it click the <strong>Unpublish Product</strong> button below.
				<div>
					<input type="submit" value="Unpublish Due" name="unpublish" id="status-unpublish" />
					<input type="submit" value="Edit Due" name="edit" id="status-edit" />
					<input type="submit" value="Delete Due" name="delete" id="status-delete" />
				</div>
			</div>
		{else}
			<div class="status draft">
				This product is NOT published. To publish it click the <strong>Publish Product</strong> button below.
				<div>
					<input type="submit" value="Publish Due" name="publish" id="status-publish" />

					<input type="submit" value="Edit Due" name="edit" id="status-edit" >
					<input type="submit" value="Delete Due" name="delete" id="status-delete" />
				</div>
			</div>
		{/if}
	
	</div>
</form>



<fieldset id="preview-tags">
	<legend>Categories</legend>
	
	<ul>
	
		{foreach from=$tags item=tag}
			<li>
	
				<form method="post" action="{geturl action='tags'}">
				<div>
					{$tag|escape}
					<input type="hidden" name="id" value="{$product->getId()}" />
					<input type="hidden" name="tag" value="{$tag|escape}" />
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
			<input type="text" name="tag" />
			<input type="submit" name="add" value="Add To Category" />
		</div>
	</form>
</fieldset>


<fieldset id="preview-images">
	<legend>Images</legend>
	
	{if $product->images|@count>0}
		<ul id="post_images">
			{foreach from=$product->images item=image}
				<li id="image_{$image->getId()}">
					<img src="{imagefilename id=$image->getId() w=200 h=65}" alt="{$image->filename|escape}" />
					
					<form method="post" action="{geturl action='images'}">
						<div>
							<input type="hidden" name="id" value="{$product->getId()}" />
							<input type="hidden" name="image" value="{$image->getId()}" />
							<input type="submit" name="delete" value="delete" />
						</div>
					</form>
				</li>
			{/foreach}
		</ul>
	{/if}
	
	
	<form method="post" action="{geturl action='images'}" enctype="multipart/form-data">
		<div>
			<input type="hidden" name="id" value="{$product->getId()}" />
			<input type="file" name="image" />
			<input type="submit" value="Upload Image" name="upload" />		
		</div>
	</form>
</fieldset>




<div class="product-name">
{$product->profile->name}
</div></span>

<div class="preview-date">
	Start Time: {$product->ts_created|date_format:'%x %X'}<br/>
</div>

<br/>


<div class="product-price">
{if $product->profile->price ==0}
FREE
{else}
${$product->profile->price}
{/if}
</div>

 <div class="product-description">
{$product->profile->content}
</div>



{include file='footer.tpl' leftcolumn='membershipmanager/lib/left-column.tpl'}