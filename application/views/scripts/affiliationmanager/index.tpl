{if $users|@count>0}
{include file='header.tpl' section='affiliation'}

{foreach from=$users item=user name=Users}

	{include file='affiliationmanager/lib/user-summary.tpl' post=$user}

{/foreach}
{else}
{include file='header.tpl' section='affiliation'}

	You currently do not have any affiliations. 

{/if}
{include file='footer.tpl' products=$cartObject}