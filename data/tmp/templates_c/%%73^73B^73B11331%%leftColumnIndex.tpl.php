<?php /* Smarty version 2.6.19, created on 2010-06-09 18:08:01
         compiled from lib/leftColumnIndex.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'lib/leftColumnIndex.tpl', 7, false),)), $this); ?>
<div id="leftContainer" style="width:210px; float:left;">
	<fieldset id="rewardLeftColumn" style="width:90%;">
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
   
    <fieldset style="width:90%;">
    	<legend>Rialto Products</legend>
        <ul id="qm0" class="qmmc">
            <li><a class="qmparent" href="javascript:void(0)">Men&acute;s dance shoes</a>
                <ul>
                <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Mens standard shoes">Men&acute;s standard shoes</a></li>
                <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Mens latin shoes">Men&acute;s latin shoes</a></li>
                </ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Women&acute;s dance shoes</a>
                <ul>
                <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Practice womens dance shoes">Practice women&acute;s dance shoes</a></li>
                <li><a class="qmparent" href="javascript:void(0)">Women&acute;s standard shoes</a>
                	<ul>
                    	<li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Competition womens standard shoes">Competition women&acute;s standard shoes </a></li>
                        <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Social and showcase womens standard shoes">Social and showcase women&acute;s standard shoes</a></li>
                    </ul></li>
                <li><a class="qmparent" href="javascript:void(0)">Women&acute;s latin shoes</a>
                	<ul>
                    	<li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Competition womens latin shoes">Competition women&acute;s latin shoes </a></li>
                        <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Social and showcase womens latin shoes">Social and showcase women&acute;s latin shoes</a></li>
                    </ul></li>
                </ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Skirts</a>
                <ul>
                <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Standard skirts">Standard skirts</a></li>
                <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Latin skirts">Latin skirts</a></li>
                </ul></li>
            <li><a class="qmparent" href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Mens standard shoes">Women&acute;s tops</a></li>
            <li><a class="qmparent" href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Latin dresses">Latin dresses</a>
                </li>
            <li><a class="qmparent" href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Standard dresses">Standard dresses</a>
        
                </li>
            <li><a class="qmparent" href="javascript:void(0)">Pants</a>
                <ul>
                <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Standard pants">Standard pants</a></li>
                <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Latin pants">Latin pants</a></li>
                </ul></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Vests">Vests</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Jackets">Jackets</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Suits">Suits</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Tailsuits">Tailsuits</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Latin shirts">Latin shirts</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=Mens latin coordinates">Men&acute;s latin coordinates</a></li>
        	<li class="qmclear">&nbsp;</li>
        </ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>


    </fieldset>
</div>