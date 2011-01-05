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
		
		{foreach from=$products item=product}
			<img width='150' height='150' src='{$product->_images[0]->filename}' />
		{/foreach}
	</div>	

</div>

{include file="layouts/$layout/footer.tpl"}
