{include file='header.tpl'  lightbox=true section='product'}

{if $cat =='Betty (Economic line)'}


	<p style="text-align:center; font-size:1.6em; font-weight:bold; color:#003366">Betty/SD<br/> <br/><img src="/utility/image?id=61&w=200&h=0&hash=e23d99161ffa0c0dfdd679822514c735&username=vedancewear" /></p>
	

<div class="indexDescription">

	<p><lable class="textcolor3">This is the recommended beginner&acute;s shoe. All Betty shoes are constructed to deliver high-quality products and comfort at an unbeatable price. If you are new to dancing, on a tight budget, or need an extra pair of practice shoes, this is the pair to get.</lable></p>
	<p><lable class="textcolor3"> If, however, you would prefer to make a larger investment in the pair of shoes you purchase, consider <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=Stephanie (Competition line)">Stephanie Ballroom</a></strong> or <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=DanceNatural (Professional line)">Dance Natural.</a></strong></lable></p>

</div>
{elseif $cat == "Custom Men's Dancewear"}
<p style="text-align:center; font-size:1.6em; font-weight:bold; color:#003366">Custom Men&acute;s Dancewear<br/> <br/><img src="/utility/image?id=61&w=200&h=0&hash=e23d99161ffa0c0dfdd679822514c735&username=vedancewear" /></p>
	

<div class="indexDescription">

	<p><lable class="textcolor3">Men&acute;s Dancewear includes custom tailored latin pants. These pants are made out of professional heavy gaberdine material and the price for these latin pants is unbeatable. </lable></p>
	
	<p><lable class="textcolor3">If you are looking for shoes, please consider our economic line<strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=Betty (Economic line)"> Betty</a></strong> or our competition line <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=Stephanie (Competition line)">Stephanie Ballroom</a></strong> or, if you are interested to make an even larger investment in the pro line shoes, then <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=DanceNatural (Professional line)">Dance Natural</a></strong> is your option</lable></p>

</div>

{elseif $cat == 'Stephanie (Competition line)'}
<p style="text-align:center; font-size:1.6em; font-weight:bold; color:#003366">Stephanie Ballroom<br/> <br/><img src="	/utility/image?id=221&w=200&h=0&hash=b6087ffbfec3a92e15347990aae07c11&username=vedancewear
" /></p>
	

<div class="indexDescription">

	<p><lable class="textcolor3">This is the recommended competition shoe. Stephanie Ballroom has specially fabricated satin made for water/oil/dirt resistance, and memory padding which provides long lasting comfort and durability. <lable></p>
	
	<p><lable class="textcolor3">If, however, you would prefer to purchase a practice pair or a professional pair, please consider <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=Betty (Economic line)">Betty</a></strong> or <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=DanceNatural (Professional line)">Dance Natural</a></strong></lable></p>

</div>

{elseif $cat == 'DanceNatural (Professional line)'}
<p style="text-align:center; font-size:1.6em; font-weight:bold; color:#003366">Dance Natural<br/> <br/>

	<img id="BrandLogoSmall" height="59" border="0" width="115" src="http://www.danceshopper.com/images/brands/Dance%20Naturals-s.gif" alt="Dance Naturals"/></p>

<div class="indexDescription">

	<p><label class="textcolor3">This is our professional line. These shoes are the best hand made shoes in Itally. Every shoe is inspected to deliver the best in quality and craftmanship. For a thorough description of Dance Natural shoes, please <a href="/index/dancenatrual">click here</a>.</label></p>
	<p><lable class="textcolor3"> If you are looking for a economic line or a competition line of shoes, feel free to check into <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=Betty (Economic line)">Betty</a></strong> or consider <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=Stephanie (Competition line)">Stephanie Ballroom</a></strong> 

</div>



	
{/if}

<div id="catnav">
	<p style="text-align:center; font-size:1.2em"><lable class="textcolor6">For specific products, please select from the following categories</lable></p>
		{if $brand_cats|@count ==0}
		<p>
			No products were found for this category.
		</p>
		{else}<br/>
	<ul>
			{foreach from=$brand_cats item=tag}
				<li>
					<a href="{geturl route='clubproducttagspace' username=vedancewear tag=$tag.cat}" style="margin-right:10px;">
					{$tag.cat|escape}
					</a>
				  
					
				</li>
				{/foreach}
	</ul>
		{/if}

</div>

<br/><br/><br/>

<div class="ListBanner">
	<div class="ListBannerImage"></div>
	<strong class="ListBannerTitle">Category Hot Sellers</strong>
</div>

{foreach from=$objects item=objects name=objects}
			{include file='clubproduct/lib/blog-post-summary.tpl' post=$objects}
			
			{if $smarty.foreach.posts.last}
				{assign var=date value=$post->ts_created}
			{/if}
			
{/foreach}
	
	
	
	
	
	
{include file='footer.tpl' leftcolumn='lib/ProductList.tpl' brandCat='lib/brand-category.tpl' products=$cartObject}