{include file="layouts/$layout/header.tpl"}

<div id='content-popup'>

	{include file='authentication/forms/loginForm.tpl'}
	
	{include file='authentication/js/loginJS.tpl'}
	
	<p></p><a href='{$siteRoot}/register/resetpassword'>I forgot my password</a></p>

</div>

{include file="layouts/$layout/footer.tpl"}