{if $isXmlHttpRequest}
	{if $tagProducts}
			{include file='productmanager/lib/tag-preview.tpl products=$tagProducts}
	{elseif $month}
			{include file='productmanager/lib/month-preview.tpl month=$monthPost posts=$recentPosts}
	{else}
			<span class="contentTip">Please select from your categories and archives to view exisitng products</div>
	{/if}
{else}


{include file='header.tpl' section='products'}

<div id="leftContainer">
{if $totalProducts ==1}
		<p>
			There is currently <strong class="style1">1</strong> products in your club.
		</p>
	{else}
		<p>
			There are currenlty <strong class="style1">{$totalProducts}</strong> products. 
		</p>
{/if}

<form action="/productmanager/edit" method="get">
	<div class="submit">
	<input type="submit" value="Create a new product" />
	</div>
</form>

<div id="month-preview">
		{if $tagProducts}
			{include file='productmanager/lib/tag-preview.tpl products=$tagProducts}
		{elseif $month}
			{include file='productmanager/lib/month-preview.tpl month=$monthPost posts=$recentPosts}
		{else}
			<span class="contentTip">Please select from your categories and archives to view exisitng products</span>
		{/if}
		
</div>

</div>

<div id="rightContainer">

{include file='productmanager/lib/left-column.tpl'}
</div>

{include file='footer.tpl' leftcolumn='productmanager/lib/left-column.tpl'}

{/if}