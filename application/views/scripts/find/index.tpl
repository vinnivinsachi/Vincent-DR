{include file="layouts/$layout/header.tpl"}

<!-- MENUES -->
<div id='content-left'>

	{include file='find/categories.tpl'}

	{include file='find/criteria.tpl'}


	<!-- TESTING -->
	<br /><br />
	<button onclick='addProducts();'>ADD PRODUCTS</button>
	{literal}
	<script type='text/javascript'>
		var loading = false;
	
		$j(document).ready(function(){
			$j(window).scroll(checkScroll);

			addProducts();
		});

		// see if the page is full of products, if not, add more
		function checkPage() {
			if($j(window).height() >= ($j(document).height() - 150)) addProducts();
		}
		
		function checkScroll() {
			// exit if still loading
				if(loading) return;
			
			// IF scrolled 95% down the page AND NOT still loading products
				if($j(window).scrollTop() > 0.95*($j(document).height() - $j(window).height())) {
					// load more products
						addProducts();
				}
		} // END checkScroll()
		
		function addProducts() {
			loading = true;
			$j.post('{/literal}{$siteRoot}{literal}/find/fetchmoreproducts/format/json', function(data){
				$j('#product-preview-small-template').tmpl(data.products).appendTo('#product-grid');
				loading = false;
				checkPage();
			});
		} // END addProducts()
	</script>
	
	<!-- the template for a single product preview -->
	<script id='product-preview-small-template' type='text/x-jquery-tmpl'>
    	{/literal}{include file='find/templates/product-preview-small-template.tpl'}{literal}
	</script>
	
	{/literal}

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

</div>

{include file="layouts/$layout/footer.tpl"}
