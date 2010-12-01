{include file='header.tpl' lightbox=true}

	<div id="leftContainer">
    
            <!--{geturl controller="productlisting" action="index"}-->


    	<fieldset>
        <legend>Upload a specific product for sale</legend>

                <span style="font-size:14px; color:#069;">What kind of products would you like to upload? Please select the appropriate category.</span>
       <ul id="qm0" class="qmmc" style="float:left;">
            <li><a class="qmparent" >Men&acute;s dance shoes</a>
                <ul>
                <li><a class="qmparent productTagAnchor"  id="menStandardShoes" href="{geturl action='index'}?product=userShoes&tag=Mens standard shoes">Men&acute;s standard shoes</a></li>
                <li><a  id="menLatinShoes" class="qmparent productTagAnchor" href="{geturl action='index'}?product=userShoes&tag=Mens latin shoes">Men&acute;s latin shoes</a></li>
                </ul></li>
            <li><a class="qmparent" >Women&acute;s dance shoes</a>
                <ul>
                <li><a  id="womenPracticeShoes" class="productTagAnchor qmparent" href="{geturl action='index'}?product=userShoes&tag=Practice womens dance shoes">Practice women&acute;s dance shoes</a></li>
                <li><a class="qmparent" >Women&acute;s standard shoes</a>
                	<ul>
                    	<li><a  id="womenCompStandardShoes" class="qmparent productTagAnchor" href="{geturl action='index'}?product=userShoes&tag=Competition womens standard shoes">Competition women&acute;s standard shoes </a></li>
                        <li><a  id="womenSocialStandard" class="productTagAnchor qmparent" href="{geturl action='index'}?product=userShoes&tag=Social and showcase womens standard shoes">Social and showcase women&acute;s standard shoes</a></li>
                    </ul></li>
                <li><a class="qmparent" href="javascript:void(0)" >Women&acute;s latin shoes</a>
                	<ul>
                    	<li><a id="womenCompLatinShoes" class="productTagAnchor qmparent" href="{geturl action='index'}?product=userShoes&tag=Competition womens latin shoes">Competition women&acute;s latin shoes </a></li>
                        <li><a class="productTagAnchor qmparent" id="womenSocialLatin" href="{geturl action='index'}?product=userShoes&tag=Social and showcase womens latin shoes">Social and showcase women&acute;s latin shoes</a></li>
                    </ul></li>
                </ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Skirts</a>
                <ul>
                <li><a  class="productTagAnchor qmparent" id="standardSkirts" href="{geturl action='index'}?product=userSkirts&tag=Standard skirts">Standard skirts</a></li>
                <li><a  id="latinSkirts" class="productTagAnchor qmparent" href="{geturl action='index'}?product=userSkirts&tag=Latin skirts">Latin skirts</a></li>
                </ul></li>
            <li><a class="qmparent productTagAnchor" id="womenTop" href="{geturl action='index'}?product=userWomensTops&tag=Womens tops">Women&acute;s tops</a></li>
            <li><a class="qmparent productTagAnchor" href="{geturl action='index'}?product=userLatinDresses&tag=Latin dresses">Latin dresses</a>
                </li>
            <li><a class="qmparent" href="{geturl action='index'}?product=userStandardDresses&tag=Standard dresses">Standard dresses</a></li>
            <li><a class="qmparent" href="javascript:void(0)" >Pants</a>
                <ul>
                <li><a href="{geturl action='index'}?product=userPants&tag=Standard pants">Standard pants</a></li>
                <li><a href="{geturl action='index'}?product=userPants&tag=Latin pants">Latin pants</a></li>
                </ul></li>
            <li><a href="{geturl action='index'}?product=userVests&tag=Vests">Vests</a></li>
            <li><a href="{geturl action='index'}?product=userJackets&tag=Jackets">Jackets</a></li>
            <li><a href="{geturl action='index'}?product=userSuits&tag=Suits">Suits</a></li>
            <li><a href="{geturl action='index'}?product=userTailsuits&tag=Tailsuits">Tailsuits</a></li>
            <li><a href="{geturl action='index'}?product=userLatinShirts&tag=Latin shirts">Latin shirts</a></li>
            <li><a href="{geturl action='index'}?product=userLatinCoordinates&tag=Mens latin coordinates">Men&acute;s latin coordinates</a></li>
        	<li class="qmclear">&nbsp;</li>
        </ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}
	</fieldset>
	</div>
    
    <div id="rightContainer">
        <div id="productUploadTagImage" class="">
        </div>
    </div>
<script src="/htdocs/javascripts/productTagSelection.js" type="text/javascript"></script>
{include file='footer.tpl'}