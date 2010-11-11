<form id='basic-info-form' enctype='application/x-www-form-urlencoded' action='{$siteRoot}/account/editbasicinfo/format/json' method='post'>

	<table>
	
		<tr>
			<td><label>Username:</label></td>
			<td>{$user->username}</td>
		</tr>
		
		<tr>
			<td><label>User Type:</label></td>
			<td>{$user->role}</td>
		</tr>
		
		<tr>
			<td><label>Email:</label></td>
			<td>{$user->email}</td>
		</tr>
		
		<tr>
			<td><label for='password'>Password:</label></td>
			<td><input type='password' name='password' id='password' minlength='6' maxlength='20'></td>
		</tr>
		
		<tr>
			<td><label for='passwordConfirm' class='required'>Confirm Password:</label></td>
			<td><input type='password' name='passwordConfirm' id='password-confirm' equalTo='#password'></td>
		</tr>
		
		<tr>
			<td><label for='firstName'>First Name:</label></td>
			<td><input type='text' name='firstName' id='first-name' maxlength='30' value='{$user->firstName}'></td>
		</tr>
		
		<tr>
			<td><label for='lastName'>Last Name:</label></td>
			<td><input type='text' name='lastName' id='last-name' maxlength='30' value='{$user->lastName}'></td>
		</tr>
		
		<tr>
			<td><label>Gender:</label></td>
			<td>{$user->sex}</td>
		</tr>
		
		<tr>
			<td><label for='affiliation'>Affiliation:</label></td>
			<td><input type='text' name='affiliation' id='affiliation' maxlength='100' value='{$user->affiliation}'></td>
		</tr>
		
		<tr>
			<td><label for='experience'>Dance Experience:</label></td>
			<td><select name='experience' id='experience'>
					<option value='Social' {if $user->experience == 'social'} selected='selected'{/if}>Social</option>
		            <option value='Beginner' {if $user->experience == 'beginner'} selected='selected'{/if}>Beginner</option>
		            <option value='Collegiate' {if $user->experience == 'collegiate'} selected='selected'{/if}>Collegiate</option>
		            <option value='Amature' {if $user->experience == 'amature'} selected='selected'{/if}>Amature</option>
		            <option value='Professional' {if $user->experience == 'professional'} selected='selected'{/if}>Professional</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td><a href='{$siteRoot}/account/details'>Cancel</a></td>
			<td><input type='submit' value='Register'></td>
		</tr>
	
	</table>

</form>
