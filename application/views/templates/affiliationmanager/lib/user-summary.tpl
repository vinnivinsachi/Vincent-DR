{capture assign='url'}{geturl username=$user->username route='clubpreview'}{/capture}

<div class="teaser">
	<h3>
		<a href="{$url|escape}" class="entry-title" rel="bookmark">
			{$post->profile->public_club_name}
		</a>
	</h3>
	
	<ul class="indexLink">
		<li><a href="{geturl username=$post->username route='clubpost'}"> view posts </a></li>
		<li><a href="{geturl username=$post->username route='clubproduct'}"> view products </a></li>
		<li><a href="{geturl username=$post->username route='clubevent'}"> view events </a></li>
		<li><a href="{geturl memberusername=$post->username route='clubmemberdue'}"> view memberships</a>
		<li><a href="{geturl username=$post->username action='write' route='message'}"> SEND MESSAGES</a>
	</ul>
	
	<br/>
		Admin: {$post->profile->first_name} {$post->profile->last_name}<br/>

		email: {$post->profile->public_club_email}<br/>
	<br/>
	
	
	<div class="teaser-links">
		<a href="{$url|escape}">Read More...</a>
	</div>
</div>