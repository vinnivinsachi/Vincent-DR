{include file="layouts/$layout/header.tpl" lightbox=true}
<div id="leftContainer" style="width:210px; float:left;">
	
{include file='partials/leftColumnIndex.tpl'}
{include file="productdisplay/_searchCriteria/_basicCriteria.tpl"}

</div>
<div id="rightContainer" style='width:790px; float:left;'>
{include file='partials/productTagHeader.tpl' currentPage='userProductPreview'} 
{include file='productdisplay/_product/_basic.tpl} 
</div>
{include file="layouts/$layout/footer.tpl"}