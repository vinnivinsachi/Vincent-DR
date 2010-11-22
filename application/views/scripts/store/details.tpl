{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>
	
		<!-- Basic Info -->
	    <fieldset> 	
			<legend>{$store->storeDisplayName} Details</legend>
		    <table class='right-align-table'>
				<tr>
					<td>Store URL Name:</td>
					<td><b>{$store->storeName}</b></td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td><a href='{$siteRoot}/store/editbasicinfo?storeName={$store->storeName}'>Edit</a></td>
				</tr>
			</table>
		</fieldset>
		
		
		<!-- Associated Users -->
		<fieldset> 	
			<legend>Users</legend>
		    <table>
				<tr>
					<th>Username</th>
					<th>Role</th>
				</tr>
				
				{foreach from=$store->members item=user}
					<tr>
						<td style='text-align:center'><a href='{$siteRoot}/account/profile?username={$user->username}'>{$user->username}</a></td>
						<td style='text-align:center'>&nbsp;</td>
					</tr>
				{/foreach}
				
			</table>
		</fieldset>  
	    
</div>

{include file="layouts/$layout/footer.tpl"}