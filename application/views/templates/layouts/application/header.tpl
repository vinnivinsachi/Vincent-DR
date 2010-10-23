<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" type="text/css" href="{$siteRoot}/public/resources/css/index.css"/>
<link rel="stylesheet" type="text/css" href="{$siteRoot}/public/resources/css/slidemenu.css" />
<script src="{$siteRoot}/public/resources/javascripts/prototype.js" type="text/javascript"></script>
<script src="{$siteRoot}/public/resources/javascripts/scriptaculous/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
<script src="{$siteRoot}/public/resources/global.js" type="text/javascript"></script>
<script src="{$siteRoot}/public/resources/jquery/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="{$siteRoot}/public/resources/jquery/js/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<link rel='stylesheet' type='text/css' href="{$siteRoot}/public/resources/jquery/js/colorbox/colorbox.css" />
<script src="{$siteRoot}/public/resources/jquery/js/jquery.tools.min.js" type="text/javascript"></script>
<script>
     var $j = jQuery.noConflict();
</script>

<script src="{$siteRoot}/public/resources/jquery/js/jquery-ui-1.8.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="{$siteRoot}/public/resources/jquery/css/start/jquery-start.custom.css"/>

<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/accountDetailEnhancement.js"></script>
<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/universalToggle.js"></script> 
<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/simpleToggle.js"></script>
<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/orderToggle.js"></script>
<script type="text/javascript" src="{$siteRoot}/public/resources/javascripts/adminOrderToggle.js"></script>
<script src="{$siteRoot}/public/resources/javascripts/formEnhancer/formEnhancer.js" type="text/javascript"></script>
<script src="{$siteRoot}/public/resources/javascripts/formEnhancer/checkOutEnhancer.js" type="text/javascript"></script>
<script src="{$siteRoot}/public/resources/javascripts/productPreview/productImagePreviews.js" type="text/javascript"></script>
<script src="{$siteRoot}/public/resources/javascripts/slidemenu.js" type="text/javascript"></script>
</head>

<body>
	<div id="DancewearRialtoTitle">D<span style="font-style:italic;">ancewear</span>R<span style="font-style:italic;">ialto</span></div>
    <div id="DancewearRialtoTitleLine"></div>
	<div id="content">
		<div id="wrapper"> 
        
            <div id="nav">
            	<a href="{geturl controller='registration' action='newmember'}">[Register]</a><br />
                <a href="{geturl controller='index' action='index'}">[Index]</a>
                <a href="{geturl controller='index' action='test'}">[Test]</a>
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
                <a href="{geturl controller='accountbalance' action='index'}">[Account balance]</a>
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
            