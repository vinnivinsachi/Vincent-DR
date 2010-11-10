
{literal}
<script type='text/javascript'>

	//form validation
	$j('#basic-info-form').validate({submitHandler: function(form){
		$j('#basic-info-form').ajaxSubmit(function(data, status){
			if(status == 'success') flashMessage('Changes have been successfully saved!');
		});
	}});

</script>
{/literal}