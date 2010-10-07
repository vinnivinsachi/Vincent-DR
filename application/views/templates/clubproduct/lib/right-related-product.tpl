{capture assign='url'}{geturl username=vedancewear url=$post->url route='clubproductview'}{/capture}

<div class="title text5">
	<a href="{$url|escape}" class="entry-title" rel="bookmark">
	{$post->profile->name}
	</a>
</div>
{if $post->images|@count >0}
{assign var=image value=$post->images|@current}
<div class="teaser-image">
	<a href="{imagefilename id=$image->getId() username='vedancewear'}" rel="lightbox[{$title|escape}]" title="{$post->profile->name}" >
	<img src="{imagefilename id=$image->getId() w=110 username='vedancewear'}" />
</a><br/>
{if $post->profile->price == 0}
				
	PRICE: FREE
{else}
	${$post->profile->price}
{/if}<br/>
<br/>
</div>
{/if}	