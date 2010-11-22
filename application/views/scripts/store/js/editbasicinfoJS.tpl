
{literal}
<script type='text/javascript'>

	//form validation
	$j('#store-basic-info-form').validate({submitHandler: function(form){
		$j('#store-basic-info-form').ajaxSubmit(function(data, status){
			if(status == 'success') flashMessage(data.jsFlashMessage);
			else flashMessage('Something went wrong!');
		});
	}});

</script>
{/literal}