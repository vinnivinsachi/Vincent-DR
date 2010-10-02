{include file="header.tpl" section='clubs' toplink='true'}

	{if $users|@count ==0}
		<p>
			No blog posts were found for this University. 
		</p>
	{else}		
		{foreach from=$users item=user name=Users}

			{include file='index/lib/user-summary.tpl' post=$user}

		{/foreach}
	{/if}

{include file='footer.tpl' leftcolumn='lib/university-list.tpl' products=$cartObject toplink='true'}
