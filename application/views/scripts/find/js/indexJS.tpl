
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
			// add the products to the page using a template
				$j('#product-preview-small-template').tmpl(data.products).appendTo('#product-grid');
			// toggle the loading var (allow the next call for more products)
				loading = false;
			// apply fancybox to all product previews
				$j('.product-preview-small').find('a:first').fancybox();
			// setup all buttons in product previews
				$j('.product-preview-large').find('button').button().click(function(){$j(this).button('disable').text($j(this).attr('loading-text'));});
			// setup small image rollovers in large product previews
				$j('.product-preview-large img.mini-img').mouseover(function(){
					var smallImage = $j(this);
					smallImage.parents('.product-preview-large').find('img.large-img').attr('src', smallImage.attr('src'));
				});
			// check if the page is full of products
				checkPage();
		});
	} // END addProducts()
</script>

<!-- the template for a single product preview -->
<script id='product-preview-small-template' type='text/x-jquery-tmpl'>
    {/literal}{include file='find/templates/product-preview-small-template.tpl'}{literal}
</script>

{/literal}
