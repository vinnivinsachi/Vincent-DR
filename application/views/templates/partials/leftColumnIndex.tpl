	<!--<fieldset id="rewardLeftColumn" style="width:90%;">
	<legend>Earn reward points!</legend>
    	<span style="font-size:14px; font-weight:bold;">4 reward points = $1</span>
        <ul>
        {if !$authenticated}
        <li><a href="{geturl controller='registration' action='newmember'}"><span style="font-size:16px;">Register</span></a> and earn 16 reward points!</li>{/if}
        <li>
        	<a href="{geturl controller='account' action='uploadmeasurement'}">update your measurements</a> and speed up your future purchase! + 24 reward points!
        </li>
        <li><a href="#">Tell us about your dancing!</a> + 12 reward points</li>

        <li>
        	<a href="#">Write a review on a completed order</a>, + 8 reward point!</li>

        <li>
        	<a href="#">Recommend a dancer</a>, + 4 reward point from registered friends!</li>

        <li>
        	Earn reward points from every purchase!</li>
        <li><a href="#">Purchase reward points</a> at discounts!</li>
	</ul>
    </fieldset>
    <fieldset style="width:90%;">
	<legend>Finders and discussion</legend>
        <ul>
       		<li><a href="#" title="Don't know your size? Find a shoe size to try on near you!">Size finder</a></li>
            <li><a href="#" title="Find a local dance instructor!">Instructor finder</a></li>
            <li><a href="#" title="Find a local dance studio to join!">Studio finder</a></li>
            <li><a href="#" title="Find a dance partner! List yourself if you are looking!">Partner finder</a></li>
            <li><a href="#" title="Discuss about your passion for dance to your hearts content!">Forum and discussion</a></li>
		</ul>
    </fieldset>
    -->
    <div class='box' style="width:95%;">
    	<div class='titleBarBig marginTop20'>Categories</div>
        <ul id="qm0" class="qmmc" style="float:left;">
            <li><a class="qmparent" style='font-size:1.2em;'>WOMEN</a>
                <ul>
                <li><a class="qmparent productTagAnchor"  id="menStandardShoes">Shoes</a>
                	<ul>
                    	<li><a href="/productdisplay/index?tag=Ladies latin shoes{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Ladies latin shoes</a></li>
                    	<li><a href="/productdisplay/index?tag=Ladies standard shoes{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Ladies standard shoes</a></li>
                    	<li><a href="/productdisplay/index?tag=Ladies practice shoes{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Ladies practice shoes</a></li>
                    </ul>
                </li>
                <li><a  id="menLatinShoes" class="qmparent productTagAnchor">Dresses</a>
                	<ul>
                    	<li><a href="/productdisplay/index?tag=Latin competition dress{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Latin competition dress</a></li>
                    	<li><a href="/productdisplay/index?tag=Standard competition dress{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Standard competition dress</a></li>
                    	<li><a href="/productdisplay/index?tag=Social and practice dress{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Social and practice dress</a></li>
                    </ul>
                </li>
                <li><a class="qmparent productTagAnchor">Skirts</a>
                	<ul>
                    	<li><a href="/productdisplay/index?tag=Latin skirt{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Latin skirt</a></li>
                    	<li><a href="/productdisplay/index?tag=Standard skirt{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Standard skirt</a></li>
                    </ul>
                </li>
                <li><a class="qmparent productTagAnchor" href="/productdisplay/index?tag=Ladies top{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Ladies tops</a></li>
                </ul>
            </li>
            <li><a class="qmparent" style='font-size:1.2em;'>MEN</a>
                <ul>
                <li><a class="productTagAnchor qmparent">Shoes</a>
                	<ul>
                		<li><a href="/productdisplay/index?tag=Men latin shoes{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Men latin shoes</a></li>
                		<li><a href="/productdisplay/index?tag=Men standard shoes{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Men standard shoes</a></li>
                    	<li><a href="/productdisplay/index?tag=Men practice shoes{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Men practice shoes</a></li>    
                    </ul>
                </li>
                <li><a class="qmparent" >Sets</a>
                	<ul>
                    	<li><a href="/productdisplay/index?tag=Suit{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Suits</a></li>
                    	<li><a href="/productdisplay/index?tag=Suit{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Tailsuits</a></li>
                    	<li><a href="/productdisplay/index?tag=Men costume{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Costumes</a></li>
		            </ul>
		        </li>
                <li><a href="/productdisplay/index?tag=Shirt{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Shirts</a></li>
                <li><a href="/productdisplay/index?tag=Pants{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Pants</a></li>
                <li><a href="/productdisplay/index?tag=Vest{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Vests</a></li>
                <li><a href="/productdisplay/index?tag=Jacket{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Jackets</a></li>
            	</ul></li>
            <li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'>JEWELRY</a>
            	<ul>
                
                <li><a href="/productdisplay/index?tag=Jewelry set{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Jewelry sets</a></li>
                <li><a href="/productdisplay/index?tag=Hair accessory{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Hair accessories</a></li>
                <li><a href="/productdisplay/index?tag=Earring{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Earing</a></li>
                <li><a href="/productdisplay/index?tag=Necklace{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Necklace</a></li>
               	<li><a href="/productdisplay/index?tag=Bracelet{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Bracelets</a></li>
               	<li><a href="/productdisplay/index?tag=Brooch{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Brooches</a></li>
            	</ul></li>
            <li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'>ACCESSORIES</a>
            	<ul>
                
                <li><a href="/productdisplay/index?tag=Shoe brush{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Shoe brushes</a></li>
                <li><a href="/productdisplay/index?tag=Heel protector{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Heel protectors</a></li>
                <li><a href="/productdisplay/index?type=Accessories&tag=Sole{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Soles</a></li>
                <li><a href="/productdisplay/index?type=Accessories&tag=Bag{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Bags</a></li>
               	<li><a href="/productdisplay/index?type=Accessories&tag=Robe{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Robes</a></li>
               	<li><a href="/productdisplay/index?tag=Belt{if isset($purchaseType)}&purchaseType={$purchaseType}{/if}">Belts</a></li>
            	</ul></li>
           
        </ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}

	</div>
	<div class='box' style="width:95%;">
    	<div class='titleBarBig marginTop20'>My compare list</div>
    	<a class='largeAnchorButton' href="{geturl controller='comparechart'}">View my compare list</a>
    </div>
