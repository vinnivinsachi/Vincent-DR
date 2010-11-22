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
					<td><a href='{$siteRoot}/account/editbasicinfo'>Edit</a></td>
				</tr>
			</table>
		</fieldset>
		
		
		<!-- Associated Users -->
		<fieldset> 	
			<legend>Users</legend>
		    <table class='right-align-table'>
				<tr>
					<th>Username</th>
					<th>Role</th>
				</tr>
				<!-- USERS GO HERE -->
			</table>
		</fieldset>  
	    
</div>

{include file="layouts/$layout/footer.tpl"}