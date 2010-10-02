{include file='header.tpl' section='membershipmanager'}

*** Please be specific about naming your dues, see example for details ***

	<form method="post" action="{geturl action='edituniversaldue'}?id={$fp->universal_dues->getId()}">
		
		
		{if $fp->hasError}
		<div class="error">
			An error has occured in your submission, please make the correct changes.
		</div>
		{/if}
		
		<fieldset>
			<legend>Membership Dues</legend>
			
			<div class="row" id="form_universalDue_title_container">
				<label for="form_universalDue_name">Name: </label>
				<input type="text" name="name" value="{$fp->name}" /> <br/>(example: sept-dec 2007 general club membership dues)
				{include file="lib/error.tpl" error=$fp->getError('name')}

			</div>
			
			<div class="row" id="form_universalDue_price_container">
				<label for="form_universalDue_price">Due Amount: </label>
				
				{if $clubManager->profile->paypalEmail==""}
				<input type="text" name="price" value="FREE" disabled="disabled"/>
				{else}
				<input type="text" name="price" value="{$fp->price}" />
				{/if}
				
				{include file="lib/error.tpl" error=$fp->getError('price')}
			</div>
			
			
			<div class="wysiwyg">
				<div class="row">
				<label for="content">Description: </label>
				</div>
				{wysiwyg name='content' value=$fp->content}
				{include file="lib/error.tpl" error=$fp->getError('content')}

				
			</div>
		</fieldset>
		
		
		<div class="submit">
			{if $fp->universal_dues->isLive()}
				{assign var='label' value='Save Changes'}
			{elseif $fp->universal_dues->isSaved()}
				{assign var='label' value='Save Changes and Send Live'}
			{else}
				{assign var='label' value='Create Product'}
			{/if}
			
			<input type="submit" value="{$label|escape}" />
			{if $fp->universal_dues->isLive()}
				<input type="submit" value="preview" />
			{/if}
		</div>
		
	</form>
	
	
{if $identity->profile->paypalEmail ==''}
{include file='footer.tpl' leftcolumn='membershipmanager/lib/left-column.tpl' hint='noPaypalEmail'}
{else}
{include file='footer.tpl' leftcolumn='membershipmanager/lib/left-column.tpl'}
{/if}