{capture assign='url'}{geturl username=$user->username url=$post->url route='clubproductview'}{/capture}


<div class="bucketPanel">
	<div class="inside">
	
	
		
		<div class="panel_top_mid">
		
				<div class="title text5">
				<a href="{$url|escape}" class="entry-title" rel="bookmark">
				{$post->profile->name}
				</a>
				
                </div>
        </div>
        
				
				
				
				
				
		
		<div class="panel_top_right">
        	<div class="edit_pen">
                				{if $authenticated==1}

                        {$post->ts_created|date_format:'%b %e,%Y'}

						<a href="{geturl controller='eventmanager' action='edit'}?id={$post->getId()}"><img src="/data/images/edit_pen.png" /><!--<img src="/data/images/button_design_examples.jpg" />--></a>
                        				{/if}

				</div>
		</div>
		
		<div class="panel_content">
	
			
		
		
			{if $post->images|@count >0}
				{assign var=image value=$post->images|@current}
				<div class="teaser-image">
					<a href="{$url|escape}">
						<img src="{imagefilename id=$image->getId() w=100 username=$user->username}" align=""  />
					</a>
				</div>
			{/if}
		
	
			<div class="teaser-content summary">
				{$post->profile->description}
			<!--	{$post->getTeaser(150)}-->
			</div>
			
			<br/>
			<div class="teaser-price">
				Price:  {if $post->profile->price==0}FREE{else} ${$post->profile->price}{/if}
			</div>
			
			{if $post->profile->price>0}
			
			<a href="{$url|escape}">More Info</a>
			
			{/if}

		</div>
	
		
		
		<div class="panel_bottom_center">
		
	
		
			<div class="bucket-bottom-row">
		
			
				<div class="teaser-links">
					<a href="{$url|escape}">More...<!--<img src="/data/images/button_design_examples.jpg" />--></a>
					
				</div>
				
				
				
			</div>
		
		</div>
		
	</div>
</div>
