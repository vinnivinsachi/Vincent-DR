{if $messages|@count>0}
		<div id="messages" class="messageBox">
			{if $messages|@count==1}
				<strong>Status Message:</strong>
				{$messages.0|escape}
			{else}
				<strong>Status Messages:</strong>
				<ul>
					{foreach from=$messages item=row}
						<li>{$row|escape}</li>
					{/foreach}
				</ul>
			{/if}
		</div>
		
	{else}
		<div id="messages" class="box" style="display:none"></div>
	{/if}
	
 