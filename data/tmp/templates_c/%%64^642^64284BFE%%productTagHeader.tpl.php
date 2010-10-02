<?php /* Smarty version 2.6.19, created on 2010-06-09 18:47:08
         compiled from lib/productTagHeader.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'lib/productTagHeader.tpl', 4, false),array('function', 'breadcrumbs', 'lib/productTagHeader.tpl', 14, false),)), $this); ?>
<div id="productTagHeader">
    <span style="font-size:1.5em; font-weight:bold; float:left; margin: 10px 10px 0px 10px;"><?php echo $this->_tpl_vars['tag']; ?>
			    </span>
    <?php echo $this->_tpl_vars['seller']; ?>

    <a class="productTagHeaderButton <?php if ($this->_tpl_vars['currentPage'] == 'productPreview'): ?>currentSeller<?php endif; ?>" href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'tag'), $this);?>
?tag=<?php echo $this->_tpl_vars['tag']; ?>
&seller=dancewear rialto">DancewearRialto</a>
    <a class="productTagHeaderButton <?php if ($this->_tpl_vars['currentPage'] == 'userProductPreview'): ?>currentSeller<?php endif; ?>" href="<?php echo smarty_function_geturl(array('controller' => 'userproductpreview','action' => 'tag'), $this);?>
?tag=<?php echo $this->_tpl_vars['tag']; ?>
">Users market</a>
    
    
   
    <a class="shoppingCartIcon" style="float:right; margin-top:3px;" href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'index'), $this);?>
"><img src="/htdocs/css/images/shoppingcart_flattened.png" width="35" /></a>
    <span style="float:right; margin-top:9px;"><?php echo $this->_tpl_vars['shoppingCartInfo']->totalItems; ?>
 item in your <a href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'index'), $this);?>
" style="font-size:14px;">cart</a></span>
</div>

<div id="breadcrumbs">
    <?php echo smarty_function_breadcrumbs(array('trail' => $this->_tpl_vars['breadcrumbs']->getTrail()), $this);?>

</div>