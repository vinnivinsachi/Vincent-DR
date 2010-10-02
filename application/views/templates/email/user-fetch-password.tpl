{$user->first_name}, Your Account Password
Dear, {$user->first_name}

You recently requestd a password reset as you had forgotten your password.

Your new password is listed below. To activiate this password, click this link:

	Activate Password: http://www.visachidesign.com/account/fetchpassword?action=confirm&id={$user->getId()}&key={$user->profile->new_password_key}
	Username: {$user->username}
	New Password: {$user->_newPassword}
	
If you didn't request a password reset, please ignore this message and your password will remain unchanged. 

Sincerely,

Visachidesign Administrator