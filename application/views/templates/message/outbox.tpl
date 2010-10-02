{include file='header.tpl' lightbox=true toplink='true' section='message'}
<script type="text/javascript" src="/htdocs/js_plugin/messageDelete.js"></script>


{include file='message/navprofile.tpl' section='outbox'}

	{if $outboxMessages|@count==0}
		<p>
			Sorry, you currently do not have any messages. 
		</p>
	{else}
		{foreach from=$outboxMessages item=message name=message}
		
			{include file='message/lib/message-summary.tpl' inboxMessage=$message}
		
		{/foreach}
		
	{/if}
{include file='footer.tpl' products=$cartObject toplink='true'}