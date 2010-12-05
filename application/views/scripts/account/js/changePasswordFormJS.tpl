
{literal}
<script type='text/javascript'>
	//form validation
	$j('#change-password-form').validate({submitHandler: function(form){
		$j('#change-password-form').ajaxSubmit(function(data, status){
			// show status message
				if(status == 'success') flashMessage(data.jsFlashMessage);
				else flashMessage('Something went wrong!');
			// erase password fields
				$j('#change-password-form #password, #change-password-form #password-confirm, #change-password-form #old-password').val('');
		});
	}});
	
</script>
{/literal}