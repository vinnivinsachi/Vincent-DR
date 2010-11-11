<script type='text/javascript' src='{$jsDir}/jquery/plugins/validate.jquery.js'></script>

{literal}
<script type='text/javascript'>

	$j('#login-form').validate({submitHandler: function(form){showLoadingAndSubmit(form);}}); // form validation

</script>
{/literal}