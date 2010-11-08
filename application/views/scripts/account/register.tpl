{include file="layouts/$layout/header.tpl"}

{include file="account/css/registerCSS.tpl"}

<div id='content-wide'>

	{$this->flashMessenger()}
		
	{include file='account/forms/registerForm.tpl'}
	
	{include file='account/js/registerJS.tpl'}

</div>

{include file="layouts/$layout/footer.tpl"}