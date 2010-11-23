<form id='store-basic-info-form' enctype='application/x-www-form-urlencoded' action='{$siteRoot}/store/editbasicinfo/format/json' method='post'>
<input type='hidden' name='storeName' value='{$store->storeName}' />

	<table>
	
		<tr>
			<td><label>Store Name:</label></td>
			<td>{$store->storeDisplayName}</td>
		</tr>
		
		<tr>
			<td><label>Store URL Name:</label></td>
			<td>{$store->storeName}</td>
		</tr>
		
		<tr>
			<td><label for='storeEmail'>Store Email:</label></td>
			<td><input type='text' name='storeEmail' value='{$store->storeEmail}' class='email'></td>
		</tr>
		
		<tr>
			<td><label for='storePhone'>Store Phone:</label></td>
			<td><input type='text' name='storePhone' value='{$store->storePhone}' minlength='10' maxlength='20'></td>
		</tr>
		
		<tr>
			<td><label for='storeFax'>Store Fax:</label></td>
			<td><input type='text' name='storeFax' value='{$store->storeFax}' minlength='10', maxlength='20'></td>
		</tr>
		
		<tr>
			<td><a href='{$siteRoot}/store/details?storeName={$store->storeName}'>Cancel</a></td>
			<td><input type='submit' value='Save'></td>
		</tr>
	
	</table>

</form>
