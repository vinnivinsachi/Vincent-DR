<table class="inbox">
	<tr>
		<td id="from">{if $messageType=='inbox'}
			<a href="{geturl username=$inboxMessage->sender->username action='write' route='message'}">{$inboxMessage->sender->first_name} {$inboxMessage->sender->last_name}</a>
			{else}<a href="{geturl username=$inboxMessage->sender->username action='write' route='message'}">{$inboxMessage->sender->first_name} {$inboxMessage->sender->last_name}</a></td>{/if}
		<td rowspan="2" id="subject">{$inboxMessage->profile->subject}</td>
		<td rowspan="2" {if $inboxMessage->status==unread}style="font-weight:bold;"{/if}><a href="{geturl action='view' controller='message'}?id={$inboxMessage->getId()}&type={$messageType}">Message:</a> <br/><span class="messageContent">{$inboxMessage->getTeaser(150)}</span></td>
	</tr>
	<tr>
		<td>{$inboxMessage->date_started|date_format:'%b %e,%Y %l:%M %p'}</td>
	</tr>
	<tr>
		
		{if $messageType=='inbox'}
		<td>
		<form method="get" action="{geturl username=$inboxMessage->sender->username action='write' route='message'}"><input type="submit" value="Reply" /></form></td>
	
		<td>
		<form method="post" action="{geturl username=$inboxMessage->sender->username action='delete' route='message'}">
			<input type="hidden" name="returnAddress" value="{$returnAddress}" />
			<input type="hidden" name="id" value="{$inboxMessage->getId()}" />
			<input type="hidden" name="messageType" value="{$messageType}" />
			<input type="submit" id="messageDelete" name="delete" value="Delete" /> 
		</form>
		</td>
	
		{else}
		<td>
		<form method="post" action="{geturl username=$inboxMessage->sender->username action='delete' route='message'}">
			<input type="hidden" name="returnAddress" value="{$returnAddress}" />
			<input type="hidden" name="id" value="{$inboxMessage->getId()}" />
			<input type="hidden" name="messageType" value="{$messageType}" />
			<input type="submit" id="messageDelete" name="delete" value="Delete" /> 
		</form>
		</td>
		{/if}
	</tr>
</table>