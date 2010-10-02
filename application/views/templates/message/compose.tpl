{include file='header.tpl' section='message'}
{include file='message/navprofile.tpl' section='compose'}

<form method="post" action="{geturl action='compose' controller='message'}">
	
	
	<fieldset>
		<legend>Messaging</legend>
		
		<div class="row" id="form_To_container">
			<label for="form_to">To:</label>
				
				{if $receiverType=="clubAdmin"}
					<input id="form_to" type="button" disabled="disabled" value="VEdancewear" name="to"/>
		
				{elseif $receiverType=="member"}
				
				<select name="receiver_id">
				<option value="0" selected="selected">Please selected from your affiliations</option>
					{foreach from=$users item=user name=user}
						<option value="{$user->getId()}">{$user->profile->first_name} {$user->profile->last_name}</option>
					{/foreach}
				</select>
				{/if}
		</div>
		
		<div class="row" id="form_subject_container">
			<label for="form_subject">Subject:</label>
			<input type="text" id="form_subject" name="subject" value="{$fp->subject}"/>
			{include file='lib/error.tpl' error=$fp->getError('title')}
		</div>
		
		<div class="wysiwyg">
			{wysiwyg name='content' value=$fp->content}
			{include file='lib/error.tpl' error=$fp->getError('content')}
		</div>
		
		
		<div class="submit">
		<input type="submit" value="Send Message"/>
		</div>
		
	</fieldset>
	
</form>

{if $user|@count ==0}
{include file='footer.tpl' products=$cartObject hint="noAffiliatedSender"}
{else}
{include file='footer.tpl' products=$cartObject}
{/if}
