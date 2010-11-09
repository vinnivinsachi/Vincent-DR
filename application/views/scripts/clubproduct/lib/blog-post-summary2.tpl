{capture assign='url'}{geturl username=vedancewear url=$post->url route='clubproductview'}{/capture}


<tr>
		<td>
			<a href="{$url|escape}" class="entry-title" rel="bookmark">
				{$post->profile->name}
			</a>
	
			{if $post->profile->price>0}
			<a href="{geturl username=$user->username producttype='product'  action ='addproduct' route='shoppingcart'}/?productID={$post->getId()}&cartID={$cartID}" class="addToCart">Add to cart</a>
			{/if}
		
			
			{if $post->profile->price == 0}
		
				PRICE: FREE
			{else}
				PRICE:  ${$post->profile->price}
			{/if}
			
	
			{if $post->images|@count >0}
				{assign var=image value=$post->images|@current}
				<div class="teaser-image">
					<a href="{$url|escape}">
						<img src="{imagefilename id=$image->getId() w=100 username=$user->username}" align=""  />
					</a>
				</div>
			{/if}
	
		<div class="teaser-content summary">
		{$post->getTeaser(150)}
		</div>
	
	
		<div class="teaser-links">
		<a href="{$url|escape}">Read More...</a>
		</div>
		</td>
</tr>
