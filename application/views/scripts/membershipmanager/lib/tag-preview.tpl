
<h2>Category: {$tag}</h2>


{if $products|@count==0}
	<p>
		No dues found currently.
	</p>
{else}
	<dl>
		{foreach from=$products item=product}
		<dt>
			{$product->ts_created|date_format:'%a, %e %b'}:
			<a href="{geturl action='universalduepreview'}?id={$product->getId()}">
				{$product->profile->name|escape}
			</a>
			
			<a style="background:#00FFCC; margin-left:50px;" href="{geturl action='productstat' controller='ordermanager'}?ID={$product->getId()}&name={$product->profile->name|escape}&type=due">View Product Statistics</a>
			
			
			{if !$product->isLive()}
				.....<span class="status draft">not published</span>
			{/if}
		</dt>
		
		<dd>
			{$product->getTeaser(100)|escape}
		</dd>
		{/foreach}
	</dl>
{/if}

