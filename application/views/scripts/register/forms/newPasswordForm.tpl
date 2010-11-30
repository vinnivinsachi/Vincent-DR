<form id='new-password-form' enctype='application/x-www-form-urlencoded' action='{$siteRoot}/register/resetpassword' method='post'>
<input type='hidden' name='resetUniqueID' value='{$reset->resetUniqueID}' />

	<table>
	
		<tr>
			<td><label for='email' class='required'>Verify Email:</label></td>
			<td><input type='text' name='email' class='required email'></td>
		</tr>
		
		<tr>
			<td><label for='password' class='required'>New Password:</label></td>
			<td><input type='password' name='password' id='password' class='required' minlength='6' maxlength='20'></td>
		</tr>
		
		<tr>
			<td><label for='passwordConfirm' class='required'>Confirm Password:</label></td>
			<td><input type='password' name='passwordConfirm' id='password-confirm' equalTo='#password'></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' value='Set New Password'></td>
		</tr>
	
	</table>

</form> 
