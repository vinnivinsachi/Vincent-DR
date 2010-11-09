<h2>{$month|date_format:'%B %Y'}</h2>

{if $posts|@count==0}
	<p>
		No posts found for this month.
	</p>
{else}
	<dl>
		{foreach from=$posts item=post}
		<dt>
			{$post->ts_created|date_format:'%a, %e %b'}:
			<a href="{geturl action='preview'}?id={$post->getId()}">
				{$post->profile->name|escape}
			</a>
			
			<span class="status button"><a  href="{geturl action='productstat' controller='ordermanager'}?ID={$post->getId()}&name={$post->profile->name}&type=product">View Product Statistics</a></span>
			
			
			{if !$post->isLive()}
				<span class="status draft">not published</span>
			{/if}
		</dt>
		
		<dd>
			{$post->getTeaser(100)|escape}
		</dd>
		{/foreach}
	</dl>
{/if}