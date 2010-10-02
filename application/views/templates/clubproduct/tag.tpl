{include file='header.tpl'}

<div id="leftContainer">

Product Category: {$tag}
	{if $posts|@count ==0}
		<p>
			No Product were found for this category.
		</p>
	{else}
		{foreach from=$posts item=post name=posts}
			{include file='clubproduct/lib/blog-post-summary.tpl' post=$post}
			
			{if $smarty.foreach.posts.last}
				{assign var=date value=$post->ts_created}
			{/if}
			
		{/foreach}
	{/if}
</div>

<div id="rightContainer">
{include file='clubproduct/lib/left-column.tpl'}
</div>
	
{include file='footer.tpl' leftcolumn='clubproduct/lib/left-column.tpl' products=$cartObject}