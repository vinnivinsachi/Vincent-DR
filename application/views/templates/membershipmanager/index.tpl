{if $isXmlHttpRequest}
	{if $tagProducts}
			{include file='membershipmanager/lib/tag-preview.tpl products=$tagProducts}
	{elseif $month}
			{include file='membershipmanager/lib/month-preview.tpl month=$monthPost posts=$recentPosts}
	{else}
			<span class="contentTip">Please select from your categories and archives to view exisitng membership dues</span>
	{/if}
{else}


{include file='header.tpl' section='membershipmanager'}

<div id="leftContainer">

	{if $totalProducts ==1}
			<p>
				There is currently <strong class="style1">1</strong> dues in your club.
			</p>
		{else}
			<p>
				There are currenlty <strong class="style1">{$totalProducts}</strong> dues. 
			</p>
	{/if}


<form action="/membershipmanager/edituniversaldue" method="get">
	<div class="submit">
	<input type="submit" value="Create a general club due" />
	</div>
</form>

<form action="/membershipmanager/memberlist" method="get">
	<div class="submit">
	<input type="hidden" name="action" value="confirmed" />
	<input type="submit" value="View Existing Members" />
	</div>
</form>

<form action="/membershipmanager/memberlist" method="get">
	<div class="submit">
	<input type="hidden" name="action" value="pending" />
	<input type="submit" value="View Pending Affiliations" />
	</div>
</form>

<div id="month-preview">
		{if $tagProducts}
			{include file='membershipmanager/lib/tag-preview.tpl products=$tagProducts}
		{elseif $month}
		
			{include file='membershipmanager/lib/month-preview.tpl month=$monthPost posts=$recentPosts}
		{else}
			<span class="contentTip">Please select from your categories and archives to view exisitng products</span>
		{/if}
		
</div>

</div>

<div id="rightContainer">
{include file='membershipmanager/lib/left-column.tpl'}

</div> 
	
{include file='footer.tpl' }

{/if}