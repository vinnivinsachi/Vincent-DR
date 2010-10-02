<?php /* Smarty version 2.6.19, created on 2010-04-13 17:41:26
         compiled from lib/indexTagHeader.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'lib/indexTagHeader.tpl', 4, false),array('function', 'breadcrumbs', 'lib/indexTagHeader.tpl', 9, false),)), $this); ?>
<div id="productTagHeader">
    
   
    <a class="shoppingCartIcon" style="float:right; margin-top:3px;" href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'index'), $this);?>
"><img src="/htdocs/css/images/shoppingcart_flattened.png" width="35" /></a>
    <span style="float:right; margin-top:9px;"><?php echo $this->_tpl_vars['shoppingCartInfo']->totalItems; ?>
 item in your <a href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'index'), $this);?>
" style="font-size:14px;">cart</a></span>
</div>

<div id="breadcrumbs">
    <?php echo smarty_function_breadcrumbs(array('trail' => $this->_tpl_vars['breadcrumbs']->getTrail()), $this);?>

</div>