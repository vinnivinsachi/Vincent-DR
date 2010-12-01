<form id='change-password-form' enctype='application/x-www-form-urlencoded' action='{$siteRoot}/authentication/changepassword/format/json' method='post'>

	<table>
	
		<tr>
			<td><label for='old-password'>Old Password:</label></td>
			<td><input type='password' name='oldPassword' id='old-password' class='required' /></td>
		</tr>
		
		<tr>
			<td><label for='password'>New Password:</label></td>
			<td><input type='password' name='password' id='password' minlength='6' maxlength='20' class='required'></td>
		</tr>
		
		<tr>
			<td><label for='passwordConfirm' class='required'>Confirm New Password:</label></td>
			<td><input type='password' name='passwordConfirm' id='password-confirm' equalTo='#password'></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' value='Change'></td>
		</tr>
	
	</table>

</form>

{include file='account/js/changePasswordFormJS.tpl'}
