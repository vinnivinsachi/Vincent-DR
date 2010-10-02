<?php /* Smarty version 2.6.19, created on 2010-04-22 20:34:30
         compiled from userproductlisting/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'userproductlisting/index.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div id="leftContainer">
    
            <!--<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
-->


    	<fieldset>
        <legend>Upload a specific product for sale</legend>

                <span style="font-size:14px; color:#069;">What kind of products would you like to upload? Please select the appropriate category.</span>
       <ul id="qm0" class="qmmc" style="float:left;">
            <li><a class="qmparent" >Men&acute;s dance shoes</a>
                <ul>
                <li><a class="qmparent productTagAnchor"  id="menStandardShoes" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?product=userShoes&tag=Mens standard shoes">Men&acute;s standard shoes</a></li>
                <li><a  id="menLatinShoes" class="qmparent productTagAnchor" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?product=userShoes&tag=Mens latin shoes">Men&acute;s latin shoes</a></li>
                </ul></li>
            <li><a class="qmparent" >Women&acute;s dance shoes</a>
                <ul>
                <li><a  id="womenPracticeShoes" class="productTagAnchor qmparent" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?product=userShoes&tag=Practice womens dance shoes">Practice women&acute;s dance shoes</a></li>
                <li><a class="qmparent" >Women&acute;s standard shoes</a>
                	<ul>
                    	<li><a  id="womenCompStandardShoes" class="qmparent productTagAnchor" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?product=userShoes&tag=Competition womens standard shoes">Competition women&acute;s standard shoes </a></li>
                        <li><a  id="womenSocialStandard" class="productTagAnchor qmparent" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?product=userShoes&tag=Social and showcase womens standard shoes">Social and showcase women&acute;s standard shoes</a></li>
                    </ul></li>
                <li><a class="qmparent" href="javascript:void(0)" >Women&acute;s latin shoes</a>
                	<ul>
                    	<li><a id="womenCompLatinShoes" class="productTagAnchor qmparent" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?product=userShoes&tag=Competition womens latin shoes">Competition women&acute;s latin shoes </a></li>
                        <li><a class="productTagAnchor qmparent" id="womenSocialLatin" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?product=userShoes&tag=Social and showcase womens latin shoes">Social and showcase women&acute;s latin shoes</a></li>
                    </ul></li>
                </ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Skirts</a>
                <ul>
                <li><a  class="productTagAnchor qmparent" id="standardSkirts">Standard skirts</a></li>
                <li><a  id="latinSkirts" class="productTagAnchor qmparent">Latin skirts</a></li>
                </ul></li>
            <li><a class="qmparent productTagAnchor" href="javascript:void(0)" id="womenTop">Women&acute;s tops</a></li>
            <li><a class="qmparent" href="javascript:void(0)">Latin dresses</a>
                <ul>
                <li><a href="javascript:void(0)">Satisfaction</a></li>
                <li><a href="javascript:void(0)">Our Goals</a></li>
                <li><a href="javascript:void(0)">Product Warranty</a></li>
                <li><a href="javascript:void(0)">Future Outlook</a></li>
                <li><a href="javascript:void(0)">Product Quality</a></li>
                <li><a href="javascript:void(0)">Continued Support</a></li>
                </ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Standard dresses</a>
        
                <ul>
                <li><a href="javascript:void(0)">Satisfaction</a></li>
                <li><a href="javascript:void(0)">Our Goals</a></li>
                <li><a href="javascript:void(0)">Product Warranty</a></li>
                <li><a href="javascript:void(0)">Future Outlook</a></li>
                <li><a href="javascript:void(0)">Product Quality</a></li>
                <li><a href="javascript:void(0)">Continued Support</a></li>
                </ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Pants</a>
                <ul>
                <li><a href="javascript:void(0)">Standard pants</a></li>
                <li><a href="javascript:void(0)">Latin pants</a></li>
                </ul></li>
            <li><a href="javascript:void(0)">Vests</a></li>
            <li><a href="#">Jackets</a></li>
            <li><a href="javascript:void(0)">Suits</a></li>
            <li><a href="javascript:void(0)">Tailsuits</a></li>
            <li><a href="javascript:void(0)">Latin shirts</a></li>
            <li><a href="javascript:void(0)">Men&acute;s latin coordinates</a></li>
        	<li class="qmclear">&nbsp;</li>
        </ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>

	</fieldset>
	</div>
    
    <div id="rightContainer">
        <div id="productUploadTagImage" class="">
        </div>
    </div>
<script src="/htdocs/javascripts/productTagSelection.js" type="text/javascript"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>