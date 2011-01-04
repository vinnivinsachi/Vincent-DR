{include file='layouts/popup/header.tpl'}

<div id='content-popup'>

	{include file='authentication/forms/loginForm.tpl'}
	
	{include file='authentication/js/loginJS.tpl'}
	
	<p></p><a href='{$siteRoot}/register/resetpassword'>I forgot my password</a></p>

</div>

{include file='helpers/linksTargetTop.tpl'}

{include file='layouts/popup/footer.tpl'}