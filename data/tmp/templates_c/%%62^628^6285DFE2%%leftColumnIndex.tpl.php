<?php /* Smarty version 2.6.19, created on 2010-08-23 18:10:14
         compiled from partials/leftColumnIndex.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'partials/leftColumnIndex.tpl', 6, false),)), $this); ?>
	<!--<fieldset id="rewardLeftColumn" style="width:90%;">
	<legend>Earn reward points!</legend>
    	<span style="font-size:14px; font-weight:bold;">4 reward points = $1</span>
        <ul>
        <?php if (! $this->_tpl_vars['authenticated']): ?>
        <li><a href="<?php echo smarty_function_geturl(array('controller' => 'registration','action' => 'newmember'), $this);?>
"><span style="font-size:16px;">Register</span></a> and earn 16 reward points!</li><?php endif; ?>
        <li>
        	<a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'uploadmeasurement'), $this);?>
">update your measurements</a> and speed up your future purchase! + 24 reward points!
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
                    	<li><a href="/productdisplay/index?tag=Ladies latin shoes<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Ladies latin shoes</a></li>
                    	<li><a href="/productdisplay/index?tag=Ladies standard shoes<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Ladies standard shoes</a></li>
                    	<li><a href="/productdisplay/index?tag=Ladies practice shoes<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Ladies practice shoes</a></li>
                    </ul>
                </li>
                <li><a  id="menLatinShoes" class="qmparent productTagAnchor">Dresses</a>
                	<ul>
                    	<li><a href="/productdisplay/index?tag=Latin competition dress<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Latin competition dress</a></li>
                    	<li><a href="/productdisplay/index?tag=Standard competition dress<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Standard competition dress</a></li>
                    	<li><a href="/productdisplay/index?tag=Social and practice dress<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Social and practice dress</a></li>
                    </ul>
                </li>
                <li><a class="qmparent productTagAnchor">Skirts</a>
                	<ul>
                    	<li><a href="/productdisplay/index?tag=Latin skirt<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Latin skirt</a></li>
                    	<li><a href="/productdisplay/index?tag=Standard skirt<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Standard skirt</a></li>
                    </ul>
                </li>
                <li><a class="qmparent productTagAnchor" href="/productdisplay/index?tag=Ladies top<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Ladies tops</a></li>
                </ul>
            </li>
            <li><a class="qmparent" style='font-size:1.2em;'>MEN</a>
                <ul>
                <li><a class="productTagAnchor qmparent">Shoes</a>
                	<ul>
                		<li><a href="/productdisplay/index?tag=Men latin shoes<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Men latin shoes</a></li>
                		<li><a href="/productdisplay/index?tag=Men standard shoes<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Men standard shoes</a></li>
                    	<li><a href="/productdisplay/index?tag=Men practice shoes<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Men practice shoes</a></li>    
                    </ul>
                </li>
                <li><a class="qmparent" >Sets</a>
                	<ul>
                    	<li><a href="/productdisplay/index?tag=Suit<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Suits</a></li>
                    	<li><a href="/productdisplay/index?tag=Suit<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Tailsuits</a></li>
                    	<li><a href="/productdisplay/index?tag=Men costume<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Costumes</a></li>
		            </ul>
		        </li>
                <li><a href="/productdisplay/index?tag=Shirt<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Shirts</a></li>
                <li><a href="/productdisplay/index?tag=Pants<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Pants</a></li>
                <li><a href="/productdisplay/index?tag=Vest<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Vests</a></li>
                <li><a href="/productdisplay/index?tag=Jacket<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Jackets</a></li>
            	</ul></li>
            <li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'>JEWELRY</a>
            	<ul>
                
                <li><a href="/productdisplay/index?tag=Jewelry set<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Jewelry sets</a></li>
                <li><a href="/productdisplay/index?tag=Hair accessory<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Hair accessories</a></li>
                <li><a href="/productdisplay/index?tag=Earring<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Earing</a></li>
                <li><a href="/productdisplay/index?tag=Necklace<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Necklace</a></li>
               	<li><a href="/productdisplay/index?tag=Bracelet<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Bracelets</a></li>
               	<li><a href="/productdisplay/index?tag=Brooch<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Brooches</a></li>
            	</ul></li>
            <li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'>ACCESSORIES</a>
            	<ul>
                
                <li><a href="/productdisplay/index?tag=Shoe brush<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Shoe brushes</a></li>
                <li><a href="/productdisplay/index?tag=Heel protector<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Heel protectors</a></li>
                <li><a href="/productdisplay/index?type=Accessories&tag=Sole<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Soles</a></li>
                <li><a href="/productdisplay/index?type=Accessories&tag=Bag<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Bags</a></li>
               	<li><a href="/productdisplay/index?type=Accessories&tag=Robe<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Robes</a></li>
               	<li><a href="/productdisplay/index?tag=Belt<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>&purchaseType=<?php echo $this->_tpl_vars['purchaseType']; ?>
<?php endif; ?>">Belts</a></li>
            	</ul></li>
           
        </ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>


	</div>
	<div class='box' style="width:95%;">
    	<div class='titleBarBig marginTop20'>My compare list</div>
    	<a class='largeAnchorButton' href="<?php echo smarty_function_geturl(array('controller' => 'comparechart'), $this);?>
">View my compare list</a>
    </div>