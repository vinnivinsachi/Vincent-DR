{include file='header.tpl' lightbox=true}

<div id="leftContainer">
{include file='clubproduct/lib/media.tpl'}

<!--<div class="ListBanner">
	<div class="ListBannerImage"></div>
	<strong class="ListBannerTitle">Additional Media</strong>
</div>
<div class="addition-media">
<a class="lightwindow page-options"  title="YouTube: 300 Preview" params="lightwindow_width=340,lightwindow_height=285,lightwindow_loading_animation=false" href="http://www.youtube.com/v/uhi5x7V3WXE">How to measure your pants</a>

<a class="lightwindow page-options"  title="YouTube: 300 Preview" params="lightwindow_width=340,lightwindow_height=285,lightwindow_loading_animation=false" href="http://www.youtube.com/v/uhi5x7V3WXE">Women shoe fitting 101</a>

<a class="lightwindow page-options"  title="YouTube: 300 Preview" params="lightwindow_width=340,lightwindow_height=285,lightwindow_loading_animation=false" href="http://www.youtube.com/v/uhi5x7V3WXE">Men shoe fitting 101</a>

</div>-->


<div id="product-purchase"> 
<ul>
{foreach from=$post->images item=image}
	<li>
		
		<a href="{imagefilename id=$image->getId() }" rel="lightbox[{$title|escape}]">
			<img src="{imagefilename id=$image->getId() h=90 username='uofmballroom'}"/>
		</a>
</li>
{/foreach}
</ul>

<br/><br/><br/>

<strong class="textcolor6">Please select all the required information to custom your order</strong>

<!--form for add to card -->

<form method="get" action="{geturl username='uofmballroom' producttype='product'  action ='addproduct' route='shoppingcart'}">
<input type="hidden" name="productID" value="{$post->getId()}" />
<input type="hidden" name="cartID" value="{$cartID}" />
<table class="optionsBox" width="100%" cellspacing="1" cellpadding="3" border="0">
<tbody>
<tr>
<td class="optionsBoxHeading">Available Options:</td>
</tr>



<tr class="optionsBoxContent">
<td class="main" valign="top">Size:</td>
<td class="main" valign="top">
<select name="size">
<option value="0">Select your size</option>

<option value="Small">Small</option>
<option vlaue="Medium">Medium</option> 
<option value="Large">Large</option>
</select>
<br/>
</td>
</tr>
</tbody>
</table>

<input type="submit" value="Add to Cart"/>
</form>
<div class="ListBanner">
	<div class="ListBannerImage"></div>
	<strong class="ListBannerTitle">Related Products</strong>
</div>

{foreach from=$relatedProducts item=objects name=objects}
			{include file='clubproduct/lib/blog-post-summary.tpl' post=$objects}
			
			{if $smarty.foreach.posts.last}
				{assign var=date value=$post->ts_created}
			{/if}
			
{/foreach}

<!--end of adding to cart -->

</div>

{include file='footer.tpl' leftcolumn='lib/ProductList.tpl' brandCat='lib/brand-category.tpl' products=$cartObject}