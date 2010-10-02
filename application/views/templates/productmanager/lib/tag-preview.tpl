
<h2>Category: {$tag}</h2>


{if $products|@count==0}
	<p>
		No products found currently.
	</p>
{else}
	<dl>
		{foreach from=$products item=product}
		<dt>
			{$product->ts_created|date_format:'%a, %e %b'}:
			<a href="{geturl action='preview'}?id={$product->getId()}">
				{$product->profile->name|escape}
			</a>
			
			<span class="status button"><a href="{geturl action='productstat' controller='ordermanager'}?ID={$product->getId()}&name={$product->profile->name|escape}&type=product">View Product Statistics</a></span>
		
			{if !$product->isLive()}
				<span class="status draft">not published</span>
			{/if}
			
		</dt>
		
		<dd>
			{$product->getTeaser(100)|escape}
		</dd>
		{/foreach}
	</dl>
{/if}

