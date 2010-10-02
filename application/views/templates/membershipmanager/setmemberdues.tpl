{include file='header.tpl' section='membershipmanager'}

{if $newDue}
	<form method="post" action="{geturl memberusername=$memberUsername route='membershipmanager' action='setmemberdues'}">
		
		
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
				<input type="text" name="price" value="{$fp->price}" />
			</div>
			{include file="lib/error.tpl" error=$fp->getError('price')}

			
			<div class="wysiwyg">
				<div class="row">
				<label for="content">Description: </label>
				</div>
				{wysiwyg name='content' value=$fp->content}
				{include file="lib/error.tpl" error=$fp->getError('content')}

				
			</div>
		</fieldset>
		
		
		<div class="submit">
			{if $due->isLive()}
				{assign var='label' value='Save Changes'}
			{elseif $due->isSaved()}
				{assign var='label' value='Save Changes and Send Live'}
			{else}
				{assign var='label' value='Create Individual Due'}
			{/if}
			
			<input type="submit" value="{$label|escape}" />
			{if $due->isLive()}
				<input type="submit" value="preview" />
			{/if}
		</div>
		
	</form>
	
{else}

	<form method="post" action="{geturl memberusername=$memberUsername route='membershipmanager' action='setmemberdues'}?key={$fp->objects->individual_dues_key}">
		
		here2
	
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
				<input type="text" name="price" value="{$fp->price}" />
			</div>
			{include file="lib/error.tpl" error=$fp->getError('price')}
			
			
			<div class="wysiwyg">
				<div class="row">
				<label for="content">Description: </label>
				</div>
				{wysiwyg name='content' value=$fp->content}
				{include file="lib/error.tpl" error=$fp->getError('content')}

				
			</div>
		</fieldset>
		
		
		<div class="submit">
			{if $due->isLive()}
				{assign var='label' value='Save Changes'}
			{elseif $due->isSaved()}
				{assign var='label' value='Save Changes and Send Live'}
			{else}
				{assign var='label' value='Create Individual Due'}
			{/if}
			
			<input type="submit" value="{$label|escape}" />
			{if !$due->isLive()}
				<input type="submit" value="preview" />
			{/if}
		</div>
		
	</form>
{/if}








{include file='footer.tpl'}