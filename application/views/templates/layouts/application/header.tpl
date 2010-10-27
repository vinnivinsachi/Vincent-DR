<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<!-- CSS -->
	<!-- BLUEPRINT -->
		<link rel="stylesheet" href="{$siteRoot}/public/resources/css/blueprint/screen.css" type="text/css" media="screen, projection"/>
		<link rel="stylesheet" href="{$siteRoot}/public/resources/css/blueprint/print.css" type="text/css" media="print"/>
		<!--[if lt IE 8]>
		  <link rel="stylesheet" href="{$siteRoot}/public/resources/css/blueprint/ie.css" type="text/css" media="screen, projection"/>
		<![endif]-->
		
	<!-- CUSTOM -->
<<<<<<< HEAD

<link rel="stylesheet" type="text/css" href="/public/resources/css/index.css"/>
<link rel="stylesheet" type="text/css" href="/public/resources/css/slidemenu.css" />
<script src="/public/resources/javascripts/prototype.js" type="text/javascript"></script>
						<script src="/public/resources/javascripts/scriptaculous/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
						<script src="/public/resources/global.js" type="text/javascript"></script>
						<script src="/public/resources/js/jquery/jquery-1.4.2.min.js" type="text/javascript"></script>
						<script src="/public/resources/js/jquery/js/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
						<link rel='stylesheet' type='text/css' href="/public/resources/js/jquery/js/colorbox/colorbox.css" />
						<script src="/public/resources/js/jquery/js/jquery.tools.min.js" type="text/javascript"></script>
						<script>
						     var $j = jQuery.noConflict();
						</script>
						
						<script src="/public/resources/js/jquery/js/jquery-ui-1.8.custom.min.js"></script>
						<link rel="stylesheet" type="text/css" href="/public/resources/js/jquery/css/start/jquery-start.custom.css"/>
						
						<script type="text/javascript" src="/public/resources/javascripts/accountDetailEnhancement.js"></script>
						<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/universalToggle.js"></script> 
						<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/simpleToggle.js"></script>
						<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/orderToggle.js"></script>
						<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/adminOrderToggle.js"></script>
						<script src="{$siteRoot}/public/resources/javascripts/formEnhancer/formEnhancer.js" type="text/javascript"></script>
						<script src="{$siteRoot}/public/resources/javascripts/formEnhancer/checkOutEnhancer.js" type="text/javascript"></script>
						<script src="{$siteRoot}/public/resources/javascripts/productPreview/productImagePreviews.js" type="text/javascript"></script>
						<script src="/public/resources/javascripts/slidemenu.js" type="text/javascript"></script>

=======
		<link rel="stylesheet" href="{$siteRoot}/public/resources/css/main.css" type="text/css" media="screen"/>
		
<!-- JAVASCRIPT -->
	<!-- JQUERY -->
		<script type='text/javascript' src='{$jsDir}/jquery/jquery-1.4.2.min.js'></script>
		<script type='text/javascript'>var $j = jQuery.noConflict();</script>
>>>>>>> 337557072d26d6b4743054988cf538aa21d43388

</head>

<body>

<<<<<<< HEAD



	<div id="DancewearRialtoTitle">D<span style="font-style:italic;">ancewear</span>R<span style="font-style:italic;">ialto</span></div>
    <div id="DancewearRialtoTitleLine"></div>
	<div id="content">
		<div id="wrapper"> 
        
            <div id="nav">
            	<a href="{geturl controller='registration' action='newmember'}">[Register]</a><br />
                <a href="{geturl controller='index' action='index'}">[Index]</a>
                <a href="{geturl controller='productdisplay' action='index'}">[Product display]</a>
                <a href="{geturl controller='account' action='logout'}">[Logout]</a>
                <a href="{geturl controller='account' action='login'}">[Login]</a><br />
                <a href="{geturl controller='account' action='index'}">[Account index]</a>
                <a href="{geturl controller='account' action='messages'}">[Messages]</a>
                <a href="{geturl controller='ordermanager' action='orders}">[Bought orders]</a>
               {if $signedInUser->generalInfo->user_type=='storeSeller' || $signedInUser->generalInfo->user_type=='generalSeller'}
               	<a href="{geturl controller='ordermanager' action='soldorders'}">[Sold orders]</a>
               {/if}

                <a href="{geturl controller='account' action='details'}">[acocunt details]</a>
                <a href="{geturl controller='accountbalance' action='index'}">[acocunt balance]</a>

                <a href="{geturl controller='account' action='rewardpoints'}">[your reward points]</a><br />
                
                <a href="{geturl controller='productpreview' action='index'}">[view products live!]</a><br />
                
               
                <a href="{geturl controller='productlisting' action='uploadbuynowproduct'}">[List a BUY NOW product]</a>
                <a href="{geturl controller='productlisting' action='uploadcustomizeproduct'}">[List a customer order product]</a>
                
                <a href="{geturl controller='productlisting' action='viewpendingproduct'}">[My listings]</a>
                {if $signedInUser->generalInfo->user_type=='admin'}
                <br />
				------------------------------------------------------<br />
				Adminaccount management<br />
                <a href="{geturl controller='adminaccount' action='index'}">account/index</a>
                {/if}   
          	</div>
            
            {if $messages|@count>0}

            <div id="messages" class="ui-widget">
            	<div class="ui-state-highlight ui-corner-all" style="padding: 0pt 0.7em; margin-top: 20px;">
                	<p>
                    	<span class="ui-icon ui-icon-info" style="float: left; margin-right: 0.3em;"></span>	
                        {if $messages|@count==1}
                            <strong></strong>
                            {$messages.0}
                        {else}
                            <strong></strong>
                            <ul>
                                {foreach from=$messages item=row}
                                    <li>{$row}</li>
                                {/foreach}
                            </ul>
                        {/if}
                    </p>
                </div>
            </div>
            {else}
                <div id="messages" class="ui-widget" style="display:none"></div>
            {/if}
            
=======<!--
<div id='page'>-->

<!-- TOP MENU --><!--
	<div id="top_menu">
		<div id='top_menu_bg_l'><img src="{$imagesDir}/top_menu/logo_dancers.jpg"/></div>
=======
<div id='page'>

<!-- HEADER -->
	<div id='header'>

		<!-- TOP MENU -->
			<div id="top_menu">
				<div id='top_menu_bg_l'><img src="{$imagesDir}/top_menu/logo_dancers.jpg"/></div>
				
				<div id='top_menu_items'>
					<a href='#' class='top_menu_item'><img class='rollover' src='{$imagesDir}/top_menu/top_menu_find_off.jpg'/></a>
					<img class='spacer' width='20' height='1' />
					<a href='#' class='top_menu_item'><img class='rollover' src='{$imagesDir}/top_menu/top_menu_list_off.jpg'/></a>
				</div>
				
				<div id='top_menu_bg_r'><img src='{$imagesDir}/top_menu/top_menu_bg_r.jpg'/></div>
			</div>
>>>>>>> 337557072d26d6b4743054988cf538aa21d43388
		
		
<<<<<<< HEAD
		<div id='top_menu_bg_r'><img src='{$imagesDir}/top_menu/top_menu_bg_r.jpg'/></div>
	</div>

-->
<!-- LOGO -->
<!--	<div id='logo'><img src='{$imagesDir}/layout/logo_title.jpg'/></div>
-->

<!-- ACCOUNT MENU --><!--
	<div id='account_menu'>
		<a href='#'>Account</a> &nbsp;|&nbsp; <a href='#'>Logout</a>
	</div>

-->
<!-- MINI CART -->
	<!--<a id='mini_cart_link' href='#'>
		<div id='mini_cart'>
			<span id='mini_cart_number'>0</span>
			 &nbsp;&nbsp;&nbsp;&nbsp;items in your cart
		</div>
	</a>
-->







<!-- HIDDEN -->

<!--<div style="display:none;">

<div id="bg">
</div>
<div class="Txt_Logout">
=======
		<!-- LOGO -->
			<div id='logo'><a href='{$siteRoot}'><img src='{$imagesDir}/layout/logo_title.jpg'/></a></div>
		
		
		<!-- ACCOUNT MENU -->
			<div id='account_menu'>
				<a href='#'>Account</a> &nbsp;|&nbsp; <a href='#'>Logout</a>
			</div>
		
		
		<!-- MINI CART -->
			<a id='mini_cart_link' href='#'>
				<span id='mini_cart'>
					<span id='mini_cart_number'>0</span>
					 &nbsp;&nbsp;&nbsp;&nbsp;items in your cart
				</span>
			</a>

	</div>
>>>>>>> 337557072d26d6b4743054988cf538aa21d43388
	
	
<<<<<<< HEAD
		<p class="lastNode">Account
	</p>
</div>
<div class="Txt_">
	
		<p class="lastNode">|
	</p>
</div>
<div class="Txt_items">
	
		<p class="lastNode">items in your cart
	</p>
</div>
<div id="Div">
</div>
<div id="Div2">
</div>
<div id="Div3">
</div>
<div id="Div4">
</div>
<div id="Div5">
</div>
<div id="Div6">
</div>
<div id="Div7">
</div>
<div id="menu_bar_bg">
</div>
<div id="Div8">
</div>
<div id="Div9">
</div>
<div id="Div10">
</div>
<img src="images/logo_dancers.jpg" id="logo_dancers" alt="" />
<img src="images/logo_title.jpg" id="logo_title" alt="" />
<img src="images/menu_find.jpg" id="menu_find" alt="" />
<img src="images/menu_list.gif" id="menu_list" alt="" />
<img src="images/cart.jpg" id="cart" alt="" />
<img src="images/menu_bar_right.gif" id="menu_bar_right" alt="" />


</div>-->
=======
<!-- JAVASCRIPTS -->
<script type='text/javascript' src='{$jsDir}/custom/rollover.js'></script>
<script type='text/javascript' src='{$jsDir}/custom/folding.js'></script>
>>>>>>> 337557072d26d6b4743054988cf538aa21d43388
