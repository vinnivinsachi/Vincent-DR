<?php /* Smarty version 2.6.19, created on 2010-08-29 20:04:24
         compiled from layouts/application/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'layouts/application/header.tpl', 41, false),array('modifier', 'count', 'layouts/application/header.tpl', 71, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" type="text/css" href="/public/resources/css/index.css"/>
<link rel="stylesheet" type="text/css" href="/public/resources/css/slidemenu.css" />
<script src="/public/resources/javascripts/prototype.js" type="text/javascript"></script>
<script src="/public/resources/javascripts/scriptaculous/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
<script src="/public/resources/global.js" type="text/javascript"></script>
<script src="/public/resources/jquery/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="/public/resources/jquery/js/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<link rel='stylesheet' type='text/css' href="/public/resources/jquery/js/colorbox/colorbox.css" />
<script src="/public/resources/jquery/js/jquery.tools.min.js" type="text/javascript"></script>
<script>
     var $j = jQuery.noConflict();
</script>

<script src="/public/resources/jquery/js/jquery-ui-1.8.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="/public/resources/jquery/css/start/jquery-start.custom.css"/>

<script type="text/javascript" src="/public/resources/javascripts/accountDetailEnhancement.js"></script>
<script type="text/javascript" src="/public/resources/javascripts/universalToggle.js"></script> 
<script type="text/javascript" src="/public/resources/javascripts/simpleToggle.js"></script>
<script type="text/javascript" src="/public/resources/javascripts/orderToggle.js"></script>
<script type="text/javascript" src="/public/resources/javascripts/adminOrderToggle.js"></script>
<script src="/public/resources/javascripts/formEnhancer/formEnhancer.js" type="text/javascript"></script>
<script src="/public/resources/javascripts/formEnhancer/checkOutEnhancer.js" type="text/javascript"></script>
<script src="/public/resources/javascripts/productPreview/productImagePreviews.js" type="text/javascript"></script>
<script src="/public/resources/javascripts/slidemenu.js" type="text/javascript"></script>
</head>

<body>
	<div id="DancewearRialtoTitle">D<span style="font-style:italic;">ancewear</span>R<span style="font-style:italic;">ialto</span></div>
    <div id="DancewearRialtoTitleLine"></div>
	<div id="content">
		<div id="wrapper"> 
        
            <div id="nav">
            	<a href="<?php echo smarty_function_geturl(array('controller' => 'registration','action' => 'newmember'), $this);?>
">[Register]</a><br />
                <a href="<?php echo smarty_function_geturl(array('controller' => 'index','action' => 'index'), $this);?>
">[Index]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productdisplay','action' => 'index'), $this);?>
">[Product display]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'logout'), $this);?>
">[Logout]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'login'), $this);?>
">[Login]</a><br />
                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'index'), $this);?>
">[Account index]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'messages'), $this);?>
">[Messages]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'orders'), $this);?>
">[Bought orders]</a>
               <?php if ($this->_tpl_vars['signedInUser']->generalInfo->user_type == 'storeSeller' || $this->_tpl_vars['signedInUser']->generalInfo->user_type == 'generalSeller'): ?>
               	<a href="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'soldorders'), $this);?>
">[Sold orders]</a>
               <?php endif; ?>

                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'details'), $this);?>
">[acocunt details]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'rewardpoints'), $this);?>
">[your reward points]</a><br />
                
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'index'), $this);?>
">[view products live!]</a><br />
                
               
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'uploadbuynowproduct'), $this);?>
">[List a BUY NOW product]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'uploadcustomizeproduct'), $this);?>
">[List a customer order product]</a>
                
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'viewpendingproduct'), $this);?>
">[My listings]</a>
                <?php if ($this->_tpl_vars['signedInUser']->generalInfo->user_type == 'admin'): ?>
                <br />
				------------------------------------------------------<br />
				Adminaccount management<br />
                <a href="<?php echo smarty_function_geturl(array('controller' => 'adminaccount','action' => 'index'), $this);?>
">account/index</a>
                <?php endif; ?>   
          	</div>
            
            <?php if (count($this->_tpl_vars['messages']) > 0): ?>

            <div id="messages" class="ui-widget">
            	<div class="ui-state-highlight ui-corner-all" style="padding: 0pt 0.7em; margin-top: 20px;">
                	<p>
                    	<span class="ui-icon ui-icon-info" style="float: left; margin-right: 0.3em;"></span>	
                        <?php if (count($this->_tpl_vars['messages']) == 1): ?>
                            <strong></strong>
                            <?php echo $this->_tpl_vars['messages']['0']; ?>

                        <?php else: ?>
                            <strong></strong>
                            <ul>
                                <?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
                                    <li><?php echo $this->_tpl_vars['row']; ?>
</li>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <?php else: ?>
                <div id="messages" class="ui-widget" style="display:none"></div>
            <?php endif; ?>
            