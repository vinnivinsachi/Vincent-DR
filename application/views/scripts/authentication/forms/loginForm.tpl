<form id='login-form' enctype='application/x-www-form-urlencoded' action='' method='post'>

	<table>
	
		<tr>
			<td><label for='username' class='required'>Username:</label></td>
			<td>
				<input type='text' name='username' id='username' class='required' maxlength='20' tabindex='1'> 
				<span id='username-check'></span>
			</td>
		</tr>
		
		<tr>
			<td><label for='password' class='required'>Password:</label></td>
			<td><input type='password' name='password' id='password' class='required' maxlength='20' tabindex='2'></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' loading-text='processing...' tabindex='3' value='Login'></td>
		</tr>
	
	</table>

</form> 