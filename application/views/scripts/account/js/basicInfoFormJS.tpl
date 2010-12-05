
{literal}
<script type='text/javascript'>
	//form validation
	$j('#basic-info-form').validate({submitHandler: function(form){
		$j('#basic-info-form').ajaxSubmit(function(data, status){
			// show status message
				if(status == 'success') flashMessage(data.jsFlashMessage);
				else flashMessage('Something went wrong!');
		});
	}});

</script>
{/literal}