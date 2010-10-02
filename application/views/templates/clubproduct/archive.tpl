{include file='header.tpl' toplink='true'}


<div id="leftContainer">
Product Archive: {$archiveTime}

	{if $posts|@count ==0}
		<p>
			No Products were found for this month.
		</p>
	{else}
		{foreach from=$posts item=post name=posts}
			{include file='clubproduct/lib/blog-post-summary.tpl' post=$post}
		{/foreach}
	{/if}
</div>

<div id="rightContainer">

{include file='clubproduct/lib/left-column.tpl'}
</div>	
{include file='footer.tpl' products=$cartObject}