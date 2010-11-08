<form id='login-form' enctype='application/x-www-form-urlencoded' action='{$siteRoot}/authentication/login' method='post'>

	<table>
	
		<tr>
			<td><label for='username' class='required'>Username:</label></td>
			<td>
				<input type='text' name='username' id='username' class='required' maxlength='20'> 
				<span id='username-check'></span>
			</td>
		</tr>
		
		<tr>
			<td><label for='password' class='required'>Password:</label></td>
			<td><input type='password' name='password' id='password' class='required' maxlength='20'></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='login' id='login' value='Login'></td>
		</tr>
	
	</table>

</form> 
