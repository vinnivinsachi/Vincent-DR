{capture assign='url'}{geturl username=uofmballroom url=$post->url route='clubpostview'}{/capture}

<div class="bucketPanel">
	<div class="inside">
	
		<!--<div class="panel_top_left">
		</div>
		-->
		
		
		<div class="panel_top_mid">
		
				<div class="title text5">
				<a href="{$url|escape}" class="entry-title" rel="bookmark">
				{$post->profile->title}
				</a>
						

				</div>		
	
</div>
		
		<div class="panel_top_right">
		
				<div class="edit_pen">
				
								{$post->ts_created|date_format:'%b %e,%Y'}
						{if $authenticated==1}

						<a href="{geturl controller='blogmanager' action='edit'}?id={$post->getId()}"><img src="/data/images/edit_pen.png" /></a>
						{/if}
				</div>
		
		</div>
		
		<div class="panel_content">
		
			{if $post->images|@count >0}
			{assign var=image value=$post->images|@current}
			<div class="teaser-image">
				<a href="{imagefilename id=$image->getId() username='uofmballroom'}" rel="lightbox[{$title|escape}]" title="{$post->profile->title}" >
				<img src="{imagefilename id=$image->getId() w=140 username='uofmballroom'}" />
			</a>
			</div>
			{/if}	
			

						
			{$post->getTeaser(500)}
		
		
		
		</div>
		
		
		<!--<div class="panel_bottom_left">
		</div>-->
		
		<div class="panel_bottom_center">
		
	
		
			<div class="bucket-bottom-row">
		
			
			<!--	<div class="teaser-links">
					<a href="{$url|escape}">More...</a>
					
				</div>-->
				
				
				
			</div>
		
		</div>	
		<!--<div class="panel_bottom_right">
		</div>-->
	</div>
</div>
