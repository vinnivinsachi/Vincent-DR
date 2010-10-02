{capture assign='url'}{geturl username=$user->username route='clubpreview'}{/capture}

{if $post->user_type=='clubAdmin'}

<div class="teaser">
	<h3>
		<a href="{$url|escape}" class="entry-title" rel="bookmark">
			{$post->profile->public_club_name}
		</a>
	</h3>
	
<table>
		<tr>
			<td>
				<span class="textcolor5">Admin:</span> {$post->profile->first_name} {$post->profile->last_name}
			</td>
			<td>
				<span class="textcolor5">Email:</span> {$post->profile->public_club_email}
			</td>
		</tr>
		<tr>
			<td>
				<span class="textcolor5">University:</span> {$post->universityName}
			</td>
			<td>
				<span class="textcolor5">Club Type:</span> {$post->typeName}
			</td>
		</tr>
	</table>
	<br/>
	
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
</div>
{/if}