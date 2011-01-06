{include file="layouts/$layout/header.tpl"}

<!-- MENUES -->
<div id='content-left'>

	{include file='find/categories.tpl'}

	{include file='find/criteria.tpl'}

</div>

<!-- PRODUCTS -->
<div id='content-center'>
	
	<div id='product-grid'>	
		<div class='product-grid-bg 'id='product-grid-bg-r'></div>
		<div class='product-grid-bg 'id='product-grid-bg-b'></div>
		<div class='product-grid-bg 'id='product-grid-bg-tr'></div>
		<div class='product-grid-bg 'id='product-grid-bg-bl'></div>
		<div class='product-grid-bg 'id='product-grid-bg-br'></div>
	</div>
	
	{include file='find/js/indexJS.tpl'}

</div>

{include file="layouts/$layout/footer.tpl"}
