{include file='header.tpl' lightbox=true}
{include file='navprofile.tpl' section='preview'}


	{if $user|@count ==0}
		<p>
			Sorry, this member does not exist. 
		</p>
	{else}
		<div class="post-userTitle">
			{$user->profile->first_name} {$user->profile->last_name}
		</div>

		
		<ul class="indexLink">
			<li><a href="#"> Send Message</a>
		</ul>
		
		<div class="post-contact">
			contact Email: {$user->profile->email}<br/>
		</div>
		
		<div class="address">
			<table>
				<tr>
					<td>
						
						Address:
					</td>
					<td> {$user->profile->address}
					</td>
				</tr>
				<tr>
					<td>	
						City: 	
					</td>
					<td>
						{$user->profile->city}
					</td>
				</tr>
				<tr>
					<td>
						State:  
					</td>
					<td>
						{$user->profile->state}
					</td>
				</tr>
				<tr>
					<td>
						Zip:
					</td>
					<td>
					     {$user->profile->zip}
					</td>
				</tr>
			</table>
		</div>
	
		{foreach from=$images item=image}
			<div class="post-image">
				<a href="{imagefilename id=$image->getId() username=$user->username}" rel="lightbox[{$title|escape}]" >
					<img src="{imagefilename id=$image->getId() w=100 username=$user->username}" />
				</a>
			</div>
		{/foreach}
		
		
	{/if}
	
{include file='footer.tpl' leftcolumn='lib/university-list.tpl' products=$cartObject}