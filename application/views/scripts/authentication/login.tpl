{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>

	{$this->flashMessenger()}

	{include file='authentication/forms/loginForm.tpl'}
	
	{include file='authentication/js/loginJS.tpl'}

</div>

{include file="layouts/$layout/footer.tpl"}