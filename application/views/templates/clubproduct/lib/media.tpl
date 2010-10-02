<div class="ListBanner">
	<div class="ListBannerImage"></div>
	<strong class="ListBannerTitle">Product Information</strong>
</div>

<div class="media">

	<div class="video">
	
		{assign var=image value=$post->images|@current}
		<div class="teaser-image">
			<a href="{imagefilename id=$image->getId() username='uofmballroom'}" rel="lightbox[{$title|escape}]" title="{$post->profile->name}" >
			<img src="{imagefilename id=$image->getId() h=100 username='uofmballroom'}" />
		</a>
		</div>
	
	</div>
	
	<div class="video-caption">
		<div class="indexDescription">
		
			<div class="post-title">
				{$post->profile->name}
			</div>
			<div class="post-content">
				{$post->profile->description}
			</div>
	
			<div class="post-price">
			$ {$post->profile->price}
			</div>
		
		</div>    
	</div>

</div>

