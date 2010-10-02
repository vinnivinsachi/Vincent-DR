{include file="header.tpl" section='clubs' toplink='true'}

	{if $users|@count ==0}
		<p>
			No clubs were currently found for this university. Be the FIRST to register your club! 
		</p>
	{else}		
		{foreach from=$users item=user name=Users}

			{include file='index/lib/user-summary.tpl' post=$user}

		{/foreach}
	{/if}

{include file='footer.tpl' leftcolumn='lib/university-list.tpl' products=$cartObject toplink='true'}