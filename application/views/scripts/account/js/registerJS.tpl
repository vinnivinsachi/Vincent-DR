
{literal}
<script type='text/javascript'>

	$j('#register-form').validate({submitHandler: function(form){if(nameAvail)showLoadingAndSubmit();}}); // form validation

	
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
			$j.post('{/literal}{$siteRoot}{literal}/account/checkusername/format/json?username='+username, checkUsername);
		}
	});

	function checkUsername(data) {
		if(data.available) {
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
</script>
{/literal}