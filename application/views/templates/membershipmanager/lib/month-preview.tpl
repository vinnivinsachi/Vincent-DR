<h2>{$month|date_format:'%B %Y'}</h2>

{if $posts|@count==0}
	<p>
		No dues found for this month.
	</p>
{else}

	<dl>
		{foreach from=$posts item=post}
		<dt>
			{$post->ts_created|date_format:'%a, %e %b'}:
			<a href="{geturl action='universalduepreview'}?id={$post->getId()}">
				{$post->profile->name|escape}
			</a>
			
			<a style="background:#00FFCC; margin-left:50px;" href="{geturl action='productstat' controller='ordermanager'}?ID={$post->getId()}&name={$post->profile->name}&type=due">View Product Statistics</a>
			
			{if !$post->isLive()}
				.....<span class="status draft">not published</span>
			{/if}
		</dt>
		
		<dd>
			{$post->getTeaser(100)|escape}
		</dd>
		{/foreach}
	</dl>
{/if}