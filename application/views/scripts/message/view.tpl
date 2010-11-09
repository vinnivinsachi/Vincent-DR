{include file='header.tpl' lightbox=true section='messages'}
{capture assign='url'}{geturl username=$user->username route='clubpreview'}{/capture}

	{if $error}
		{$error}
	{else}
		{if $images|@count >0}
			{assign var=image value=$images|@current}
			
			<div style="text-align:center;">
			
					<img src="{imagefilename id=$image->getId() w=80 username=$user->username}" align=""  />
			</div>
	
		{/if}
	
		<table id="message">
			<tr>
				<td class="messageHeader">		
					{if $messageType=="inbox"}
						From: 
					{else}
						To:   
					{/if}
				</td>
				<td>
					{$user->profile->first_name}
					{$user->profile->last_name}
					{$user->profile->public_club_name}
				</td>
			</tr>
			<tr>
				<td class="messageHeader">		
				Time:
				</td>
				<td>
				{$messageInfo->date_started|date_format:'%b %e,%Y %l:%M %p'}
				</td>
			</tr>
			<tr>
				<td class="messageHeader">		
				subject: 
				</td>
				<td>
				{$messageInfo->profile->subject}
				</td>
			</tr>
			<tr>
				<td class="messageHeader">		
				Content:
				</td>
				<td>
				{$messageInfo->profile->content}
				</td>
			</tr>
		</table>
	
		{if $box=='inbox'}
		
		<table>
			<tr>
				<td>
			<form method="get" action="{geturl username=$user->username action='write' route='message'}"><input type="submit" value="Reply" /></form>
				<td>
				<td>
			
			<form action="{geturl action='index' controller='message'}"><input type="submit" value="Back" /></form>
				</td>
			</td>
		</table>
		{elseif $box=='outbox'}		

			<form action="{geturl action='outbox' controller='message'}"><input type="submit" value="Back" /></form>
			
		{/if}
		
			
		
		
	
	{/if}

{include file='footer.tpl' products=$cartObject}