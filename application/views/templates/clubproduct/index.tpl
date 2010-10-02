{include file='header.tpl'  toplink='true'}

<div id="leftContainer">
	{if $posts|@count ==0}
		<p>
			No products were found for this club. 
		</p>
	{else}
		{foreach from=$posts item=post name=Posts}
			{include file='clubproduct/lib/blog-post-summary.tpl' post=$post}
		{/foreach}
	{/if}
</div>

<did id="rightContainer">
{include file='clubproduct/lib/left-column.tpl'}
</div>
	
{include file='footer.tpl' leftcolumn='clubproduct/lib/left-column.tpl' products=$cartObject}