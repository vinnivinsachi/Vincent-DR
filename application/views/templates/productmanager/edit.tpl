{include file='header.tpl' section='products'}
	
	<form method="post" action="{geturl action='edit'}?id={$fp->product->getId()}">
	
		{if $fp->hasError()}
			<div class="error">
				An error has occured in your submission, please make the correct changes.
			</div>
		{/if}
		
		<fieldset>
			<legend>Product Details</legend>
			
			<div class="row" id="form_product_title_container">
				<label for="form_product_name">Name: </label>
				<input type="text" name="form_product_name" value="{$fp->product_name}" />
				{include file="lib/error.tpl" error=$fp->getError('product_name')}
			</div>
			
			<div class="row" id="form_product_price_container">
				<label for="form_product_price">Price: </label>
				
				{if $clubManager->profile->paypalEmail==""}
				<input type="text" name="form_product_price" value="FREE" disabled="disabled"/>
				{else}
				<input type="text" name="form_product_price" value="{$fp->product_price}" />
				{/if}
				{include file="lib/error.tpl" error=$fp->getError('product_price')}
			</div>
			
			
			<div class="wysiwyg">
				<div class="row">
				<label for="content">Description: </label>
				</div>
				{wysiwyg name='product_description' value=$fp->product_description}
				{include file='lib/error.tpl' error=$fp->getError('product_description')}
			</div>
		</fieldset>
		
		<div class="submit">
			{if $fp->product->isLive()}
				{assign var='label' value='Save Changes'}
			{elseif $fp->product->isSaved()}
				{assign var='label' value='Save Changes and Send Live'}
			{else}
				{assign var='label' value='Create Product'}
			{/if}
			
			<input type="submit" value="{$label|escape}" />
			{if $fp->product->isLive()}
				<input type="submit" value="preview" />
			{/if}
		</div>
		
	</form>



{if $identity->profile->paypalEmail ==''}
{include file='footer.tpl' leftcolumn='productmanager/lib/left-column.tpl' hint='noPaypalEmail'}
{else}
{include file='footer.tpl' leftcolumn='productmanager/lib/left-column.tpl'}

{/if}