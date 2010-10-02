<?php /* Smarty version 2.6.19, created on 2010-06-11 14:13:01
         compiled from layouts/application_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'layouts/application_header.tpl', 40, false),array('modifier', 'count', 'layouts/application_header.tpl', 75, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" type="text/css" href="/resources/css/index.css">
<link rel="stylesheet" type="text/css" href="/resources/css/slidemenu.css" />
<script src="/resources/javascripts/prototype.js" type="text/javascript"></script>
<script src="/resources/javascripts/scriptaculous/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
<script src="/resources/global.js" type="text/javascript"></script>
<script src="/resources/jquery/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script>
     var $j = jQuery.noConflict();
</script>

<script src="/resources/jquery/js/jquery-ui-1.8.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="/resources/jquery/css/start/jquery-start.custom.css">



<script type="text/javascript" src="/resources/javascripts/accountDetailEnhancement.js"></script>
<script type="text/javascript" src="/resources/javascripts/universalToggle.js"></script> 
<script type="text/javascript" src="/resources/javascripts/simpleToggle.js"></script>
<script type="text/javascript" src="/resources/javascripts/orderToggle.js"></script>
<script type="text/javascript" src="/resources/javascripts/adminOrderToggle.js"></script>
<script src="/resources/javascripts/formEnhancer/formEnhancer.js" type="text/javascript"></script>
<script src="/resources/javascripts/formEnhancer/checkOutEnhancer.js" type="text/javascript"></script>
<script src="/resources/javascripts/productPreview/productImagePreviews.js" type="text/javascript"></script>
<script src="/resources/javascripts/slidemenu.js" type="text/javascript"></script>
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
               	<a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'soldorders'), $this);?>
">[Sold orders]</a>
               <?php endif; ?>

                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'details'), $this);?>
">[acocunt details]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'rewardpoints'), $this);?>
">[your reward points]</a><br />
                
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'index'), $this);?>
">[view products live!]</a><br />
                
                <a href="<?php echo smarty_function_geturl(array('controller' => 'userproductlisting','action' => 'index'), $this);?>
">[List a user product]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'userproductlisting','action' => 'viewpendingproduct'), $this);?>
">[view all my listings]</a>
                <a href="#">[Check order status]</a>
                
                <?php if ($this->_tpl_vars['signedInUser']->generalInfo->user_type == 'storeSeller'): ?>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productcategorymanager','action' => 'index'), $this);?>
">[product category attributes]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
">[List a product for custom order]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'viewpendingproduct'), $this);?>
">[View pending product]</a>
                <a href="<?php echo smarty_function_geturl(array('controller' => 'inventorymanager','action' => 'index'), $this);?>
">[Inventory Manager]</a>
				<?php endif; ?>
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
                            <strong>Status Message:</strong>
                        <?php else: ?>
                            <strong>Status Messages:</strong>
                            <ul>
                                <?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <?php else: ?>
                <div id="messages" class="ui-widget" style="display:none"></div>
            <?php endif; ?>
            
            