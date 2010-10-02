<?php /* Smarty version 2.6.19, created on 2010-08-27 13:47:21
         compiled from partials/indexTagHeader.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'partials/indexTagHeader.tpl', 4, false),)), $this); ?>
<div id="productTagHeader" style='width:100%;'>
   <a class="productTagHeaderButton currentSelection"><?php echo $this->_tpl_vars['indexTagHeaderTitleName']; ?>
</a>
  
    <a class="shoppingCartIcon" style="float:right; margin-top:3px;" href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'index'), $this);?>
"><img src="/public/resources/css/images/shoppingcart_flattened.png" width="35" /></a>
    <span style="float:right; margin-top:9px;"><?php echo $this->_tpl_vars['shoppingCartInfo']->totalItems; ?>
 item in your <a href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'index'), $this);?>
" style="font-size:14px;">cart</a></span>
     <!--<div id="currentOrderTime" class='bigFont' style="float:right; padding:10px 10px 0px 0px;">
            12/2/10 14:23:45
            </div>
--></div>

<div id="breadcrumbs">
</div>