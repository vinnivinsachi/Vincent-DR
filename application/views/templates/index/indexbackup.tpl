
{include file="header.tpl" section='home' lightbox='true'}

<div class="indexTitle">

	<p style="text-align:center; font-size:1.6em; font-weight:bold; color:#FFFF00">VEdancewear<br/> ...created by college dancers, for college dancers...</p>
</div>





<div class="indexDescription">

	<p><lable class="textcolor3">Whether you are <strong class="textcolor6">new to dancing</strong>, just recently joined a ballroom team at your school and currently don't have a pair of shoes, or an <strong class="textcolor6">experienced dancer</strong> looking to replace your old pair of practice shoes, or a <strong class="textcolor6">hardcore dancer</strong> looking for a showcase/professional line of shoes, we are here to get you equipped with the gear that best fit your needs.</label></p>
	
	
	<p><lable class="textcolor3">If you are looking for practice shoes, please consider our economic line<strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=Betty (Economic line)"> Betty</a></strong> or <strong class="textcolor6"><a href="/clubproduct/vedancewear/cat/?cat=Stephanie (Competition line)">Stephanie Ballroom</a></strong> for competition use or, if you are interested in making an even larger investment in the pro line shoes, then <strong class="textcolor6"> <a href="/clubproduct/vedancewear/cat/?cat=DanceNatural (Professional line)">Dance Natural</a></strong> is your option</lable></p>
	
	<p><lable class="textcolor3"><strong class="textcolor6"><a href="/clubproduct/vedancewear/cat?cat=Custom Men's Dancewear">Latin pants</a></strong> are custom made by BDdance with professional <strong class="textcolor6">heavy gabardine fabric</strong>. 
	</lable></p> 
	
	<p><lable class="textcolor3">We frequently run <strong class="textcolor6"><a href="{geturl controller='clubevent'}">competition promotions</a></strong> that are only available to collegiate dancers. Please register under your <strong class="textcolor6">university/organization</strong> so that you may take advantage of competition promotions</lable></p>
	
	<p><lable class="textcolor3">If you would just like to purchase the items and are not interested in registering, you may check out as an guest. However, you will not be eligible for promotional events.</lable></p>
	
	
</div>    


<br/>
<br/>

<p style="text-align:center"><strong class="textcolor3 textcolor6">FAVORITES</strong></p>

<table>
		{foreach from=$posts item=post name=Posts}
			{include file='clubproduct/lib/blog-post-summary.tpl' post=$post}
		{/foreach}
</table>

<!--
<div class="indexLi">


	<ul class="product">
		<li><img src="/data/images/Latin_Lace_web2.jpg" />Regular line pants</li>
		<li><img src="/data/images/Latin_Lace_web2.jpg" />Fine line pants</li>
	</ul>
	
	<ul class="product">
		<li><img src="/data/images/Latin_Lace_web2.jpg" />Regular gabardine pants</li>
		<li><img src="/data/images/Latin_Lace_web2.jpg" />Fine gabardine pants</li>
	</ul>
	
</div>

-->
{include file='footer.tpl' leftcolumn='lib/ProductList.tpl' products=$cartObject}