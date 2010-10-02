{include file='header.tpl' section='messages'}
{include file='message/navprofile.tpl' section='compose'}


<form method="post" action="{geturl username=$receiver->username action='write' route='message'}">
	
	
	<fieldset>
		<legend>Messaging</legend>
		
		<div class="row" id="form_subject_container">
			<label for="form_to">To:</label>
			{if $receiverType =='clubAdmin'}
				<input type="button" id="form_to" name="to" value="{$receiver->profile->public_club_name}" disabled="disabled">
			{elseif $receiverType=='member'}
				<input type="button" id="form_to" name="to" value="{$receiver->profile->first_name} {$receiver->profile->last_name}" disabled="disabled">
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

{include file='footer.tpl' products=$cartObject}