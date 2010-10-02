<?php /* Smarty version 2.6.19, created on 2010-06-11 02:57:04
         compiled from productpreview/tag.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productpreview/tag.tpl', 15, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('lightdox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/leftColumnIndex.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <div id="rightContainer" style="width:788px; float:left;">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/productTagHeader.tpl', 'smarty_include_vars' => array('currentPage' => 'productPreview')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        
        <div id="productTagSecondHeader">
        	Brand:<select name="brand"><option value="">All</option></select>
        </div>
        
        
        <div id="productTagBody"><!--productTagBody is meant for products gathered by tags-->
        	<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
        	<div class="productBox" style="width:191px;">
            	<div class="productName">
                	<a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['products_id']; ?>
&tag=<?php echo $this->_tpl_vars['tag']; ?>
" style="color:#FC0;"><?php echo $this->_tpl_vars['product']['name']; ?>
</a>
            	</div>
                <div class="productFirstImage">
                	<div class="productDescription">
                        <?php $_from = $this->_tpl_vars['product']['profile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['profile']):
?>
                            <?php if ($this->_tpl_vars['profile']['profile_key'] == 'description'): ?>
                            <?php echo $this->_tpl_vars['profile']['profile_value']; ?>

                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>
                	<a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['products_id']; ?>
&tag=<?php echo $this->_tpl_vars['tag']; ?>
">
                	<img src="/data/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['Username']; ?>
/storeSeller/<?php echo $this->_tpl_vars['product']['product_type']; ?>
/<?php echo $this->_tpl_vars['product']['images'][0]['image_id']; ?>
.W200_productFirstImage.jpg" width="191px;"/></a>
                </div>
                <div class="productDetails">
                    <div class="productMedia">
                        <div class="productImages">
                            <?php $_from = $this->_tpl_vars['product']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
                                <div class="productIndividualImage">
                                <img src="/data/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['Username']; ?>
/storeSeller/<?php echo $this->_tpl_vars['product']['product_type']; ?>
/<?php echo $this->_tpl_vars['image']['image_id']; ?>
.W30_productSmallPreview.jpg" height="20" />
                                <span class="imageLargeAddress" style="display:none"><a href="<?php echo smarty_function_geturl(array('controller' => 'productpreview','action' => 'details'), $this);?>
?id=<?php echo $this->_tpl_vars['product']['products_id']; ?>
&tag=<?php echo $this->_tpl_vars['tag']; ?>
">
                                <img src="/data/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['Username']; ?>
/storeSeller/<?php echo $this->_tpl_vars['product']['product_type']; ?>
/<?php echo $this->_tpl_vars['image']['image_id']; ?>
.W200_productFirstImage.jpg" width='191px;'/></a></span>					
                                </div>
                            <?php endforeach; endif; unset($_from); ?>
                        </div>
                        <div class="productVideo">
                            <?php if ($this->_tpl_vars['product']['video_youtube'] != ''): ?>
                                <img src="/htdocs/css/images/video_flat.png" width=37/>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="priceBlock">
                       <?php if ($this->_tpl_vars['product']['discount_price'] == '' || $this->_tpl_vars['product']['discount_price'] == 0): ?>
                                <div class="discountBoxPrice">
                                    $<?php echo $this->_tpl_vars['product']['price']; ?>

                                </div>
                                <?php elseif ($this->_tpl_vars['product']['discount_price'] > 0): ?>
                                <div class="productBoxPrice">
                                    $<?php echo $this->_tpl_vars['product']['price']; ?>

                                </div>

                                <div class="discountBoxPrice">
                                    $<?php echo $this->_tpl_vars['product']['discount_price']; ?>

                                </div>
                        <?php endif; ?>
                    </div>
                    <div class="quickLook">
                        <button id="quickLook">Quick Look</button>
                    </div>	
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>
    </div>

<?php echo '
<script src="/htdocs/javascripts/productPreview/productImagePreviews.js" type="text/javascript"></script>

<script type="text/javascript">
new productPreviewImage(\'productTagBody\');
</script>
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>