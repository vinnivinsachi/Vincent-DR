<fieldset>
	{if isset($address->shippingAddressID) && $address->shippingAddressID != ''}<legend>Edit Shipping Address</legend>
	{else}<legend>Add new shipping Address</legend>{/if}
	
	<form id='shipping-address-form' enctype='application/x-www-form-urlencoded' action='{$siteRoot}/account/editshipping' method='post'>
	{if isset($address->shippingAddressID)}<input type='hidden' name='shippingAddressID' value='{$address->shippingAddressID}' />{/if}
	
		<table>

			<tr>
				<td><label for='addressOne' class='required'>Address One:</label></td>
				<td><input type='text' name='addressOne' class='required' value='{$address->addressOne}' /></td>
			</tr>
			
			<tr>
				<td><label for='addressTwo'>Address Two:</label></td>
				<td><input type='text' name='addressTwo' value='{$address->addressTwo}' /></td>
			</tr>
			
			<tr>
				<td><label for='city' class='required'>City:</label></td>
				<td><input type='text' name='city' class='required' value='{$address->city}' /></td>
			</tr>
			
			<tr>
				<td><label for='state' class='required'>State:</label></td>
				<td><input type='text' name='state' class='required' value='{$address->state}' /></td>
			</tr>
			
			<tr>
				<td><label for='country' class='required'>Country:</label></td>
				<td><input type='text' name='country' class='required' value='{$address->country}' /></td>
			</tr>
			
			<tr>
				<td><label for='zip' class='required'>ZIP:</label></td>
				<td><input type='text' name='zip' class='required' value='{$address->zip}' /></td>
			</tr>
			
			<tr>
				<td><label for='defaultShipping'>Set as default shipping address:</label></td>
				<td><input type='checkbox' name='defaultShipping' /></td>
			</tr>
			
			<tr>
				<td><a href='{$siteRoot}/account/details'>Cancel</a></td>
				<td><input type='submit' value='Save Address' /></td>
			</tr>
		
		</table>
	
	</form>
</fieldset>
