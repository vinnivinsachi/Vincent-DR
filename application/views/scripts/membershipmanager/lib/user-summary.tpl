
{if $action=='confirmed'}

	<tr class="row">
		<td class="name">
			<a href="{geturl memberusername=$post->username  route='memberpreview'} " class="entry-title" rel="bookmark">
				{$post->profile->first_name} {$post->profile->last_name}
			</a>
		</td>
	
		<td>
		
		
		<form action="{geturl memberusername=$post->username route='membershipmanager' action='setmemberdues'}" method="post">
			<input type="submit" name="IndividualDues" value="Set Dues" />
		</form>
		</td>
		<td>
		
		<form action="{geturl memberusername=$post->username route='membershipmanager' action='individualpreviewlist'}" method="post" >
			<input type="submit" name="IndividualDues" value="View Dues" />
		</form>
		
		</td>
		<td>
		<form action="{geturl action='removeaffiliate' method='post'}" method="post">
			<input type="hidden" name="id" value="{$post->getId()}" />
			<input type="submit" id="affiliateDelete" value="Remove Member" />
		</form>
		</td>
		
		
		<td><a href="{geturl username=$post->username action='write' route='message'}"> SEND MESSAGES</a></td>
	</tr>

{elseif $action=='pending'}
	
	<tr class="row">
		<td class="name">
			<a href="{geturl memberusername=$post->username route='membershipmanager'} " class="entry-title" rel="bookmark">
				{$post->profile->first_name} {$post->profile->last_name}
			</a>
		</td>
		<td class="name">
			Pending
		</td>
	
		<td>
		<form action="{geturl action='confirmaffiliation' controller='membershipmanager'}" method="post">
			<input type="hidden" name="id" value="{$post->getId()}"
			<input type="submit" name="confirm" value="Confirm Affiliation" />
		</form>
		</td>
		
		<td><a href="{geturl username=$post->username action='write' route='message'}"> SEND MESSAGES</a></td>
	</tr>

{/if}
