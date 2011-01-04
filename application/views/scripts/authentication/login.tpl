{include file='layouts/popup/header.tpl'}

<div id='content-popup'>

	{include file='authentication/forms/loginForm.tpl'}
	
	{include file='authentication/js/loginJS.tpl'}
	
	<p></p><a href='{$siteRoot}/register/resetpassword'>I forgot my password</a></p>

</div>

{literal}
<script type='text/javascript'>
	$j('a').attr('target', '_top');
</script>
{/literal}

{include file='layouts/popup/footer.tpl'}