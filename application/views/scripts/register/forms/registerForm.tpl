<form id='register-form' enctype='application/x-www-form-urlencoded' action='{$siteRoot}/register' method='post'>

	<table>
	
		<tr>
			<td><label for='username' class='required'>Desired Username:</label></td>
			<td>
				<input type='text' name='username' id='username' class='required' minlength='4' maxlength='20'> 
				<span id='username-check'></span>
			</td>
		</tr>
		
		<tr>
			<td><label for='email' class='required'>Email:</label></td>
			<td>
				<input type='text' name='email' id='email' class='required email' /> 
				<span id='email-check'></span>
			</td>
		</tr>
		
		<tr>
			<td><label for='password' class='required'>Password:</label></td>
			<td><input type='password' name='password' id='password' class='required' minlength='6' maxlength='20'></td>
		</tr>
		
		<tr>
			<td><label for='passwordConfirm' class='required'>Confirm Password:</label></td>
			<td><input type='password' name='passwordConfirm' id='password-confirm' equalTo='#password'></td>
		</tr>
		
		<tr>
			<td>ADD HOW DID YOU HEAR ABOUT US HERE...</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' loading-text='registering...' value='Register'></td>
		</tr>
	
	</table>

</form> 
