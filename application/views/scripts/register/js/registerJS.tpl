
{literal}
<script type='text/javascript'>

	// validate the form
		$j('#register-form').validate({submitHandler: function(form){showLoadingAndSubmit();}}); // form validation

	
	// --------------------------------------- CHECK USERNAME ----------------------------
		var nameAvail = false;
		
		$j('#register-form #username').focus(function(){
			$j('#username-check').hide();
		});
	
		// prevent user from changing to unavailable username and submitting with 'return' key
		$j('#register-form #username').keyup(function(){nameAvail = false;});
		
		$j('#register-form #username').blur(function(){
			if($j('#register-form').validate().element('#username')) {
				username = $j('#register-form #username').val();
				$j.post('{/literal}{$siteRoot}{literal}/register/checkusername/format/json?username='+username, checkUsername);
			}
		});
	
		function checkUsername(data) {
			if(data.usernameAvailable) {
				nameAvail = true;
				$j('#username-check').html('Great, that username is available!');
				$j('#username-check').css('color', 'green');
				$j('#username-check').show();
			}
			else {
				nameAvail = false;
				$j('#username-check').html('Sorry, that username is not available.');
				$j('#username-check').css('color', 'red');
				$j('#username-check').show();
			}
		}

		
		// --------------------------------------- CHECK EMAIL ----------------------------
		var emailAvail = false;
		
		$j('#register-form #email').focus(function(){
			$j('#email-check').hide();
		});
	
		// prevent user from changing to unavailable email and submitting with 'return' key
		$j('#register-form #email').keyup(function(){emailAvail = false;});
		
		$j('#register-form #email').blur(function(){
			if($j('#register-form').validate().element('#email')) {
				email = $j('#register-form #email').val();
				$j.post('{/literal}{$siteRoot}{literal}/register/checkemail/format/json?email='+email, checkEmail);
			}
		});
	
		function checkEmail(data) {
			if(data.emailAvailable) {
				emailAvail = true;
				$j('#email-check').html('Great, that email is available!');
				$j('#email-check').css('color', 'green');
				$j('#email-check').show();
			}
			else {
				emailAvail = false;
				$j('#email-check').html('Sorry, that email is not available.');
				$j('#email-check').css('color', 'red');
				$j('#email-check').show();
			}
		}
</script>
{/literal}