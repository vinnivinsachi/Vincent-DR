<?php /* Smarty version 2.6.19, created on 2010-08-27 23:10:54
         compiled from productdisplay/_product/_basic.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productdisplay/_product/_basic.tpl', 13, false),array('function', 'removeunderscore', 'productdisplay/_product/_basic.tpl', 30, false),array('modifier', 'count', 'productdisplay/_product/_basic.tpl', 19, false),)), $this); ?>
 <div id='productTagBody' class='box' style="width:100%;">

 <?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
 	<div class="productBox box" style="width:30%; height:220px; margin-right: 3%; margin-bottom:30px; ">
         <div class='productBoxLeft box' style="width:191px; height:200px; border:1px solid #eee; z-index:0;" >
         		<table>
         		<tr height='200px;' ><td style='padding:0px; margin:0px; width:191px;' align="center">
         		<div class="productFirstImage">
                	<div class="productDescription">
                       
                    </div>
                    <?php if (isset ( $this->_tpl_vars['product']['product_inventory_id'] )): ?>
             			<a class='fullOrderDetailsColorBox' href="<?php echo smarty_function_geturl(array('controller' => 'productdisplay','action' => 'purchasedetails'), $this);?>
?number=<?php echo $this->_tpl_vars['product']['product_inventory_id']; ?>
&product=inventory" >
             		<?php elseif ($this->_tpl_vars['product']['purchase_type'] == 'Buy_now'): ?>
             			<a class='fullOrderDetailsColorBox' href="<?php echo smarty_function_geturl(array('controller' => 'productdisplay','action' => 'purchasedetails'), $this);?>
?number=<?php echo $this->_tpl_vars['product']['product_id']; ?>
&product=products" >
             		<?php else: ?>
             			<a class='fullOrderDetailsColorBox' href="<?php echo smarty_function_geturl(array('controller' => 'productdisplay','action' => 'purchasedetails'), $this);?>
?number=<?php echo $this->_tpl_vars['product']['product_id']; ?>
&product=products">
             		<?php endif; ?>
                	<?php if (count($this->_tpl_vars['product']['images']) > 0): ?>
                
                	<img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['product_tag']; ?>
/<?php echo $this->_tpl_vars['product']['images'][0]['image_id']; ?>
.W191_productFirstImage.jpg"/>
                	<?php else: ?>
                        No image
                    <?php endif; ?></a>
                </div>
         		</td></tr>
               </table>
                <div class="productDetails box" style='height:20px;'>
              
               <?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['purchase_type']), $this);?>

                    
               <div class="quickLook">
							<div class="priceBlock" style='padding-top:3px; font-weight:bold;'>
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
						</div>
                </div>
         </div>
         <div class='productBoxRight box' style="width:37px; height:100%;">
         	
            <table><tr height="220px;"><td style='padding:0px; margin:0px;'> 
            <?php if (isset ( $this->_tpl_vars['controller'] ) && $this->_tpl_vars['controller'] == 'Comparechart'): ?>
            <div class='box' style='height:35px; text-align: center;'>  
           	 <div class='removeFromCompareChartDIV' style='display:none'>
	           	 <form class='removeFromCompareChartForm' action="<?php echo smarty_function_geturl(array('controller' => 'comparechart','action' => 'removefromcomparelist'), $this);?>
">
				 	<input type='hidden' name='product' value="<?php if (isset ( $this->_tpl_vars['product']['product_inventory_id'] )): ?>inventory<?php else: ?>products<?php endif; ?>"/>
				 	<input type='hidden' name='number' value='<?php if (isset ( $this->_tpl_vars['product']['product_inventory_id'] )): ?><?php echo $this->_tpl_vars['product']['product_inventory_id']; ?>
<?php else: ?><?php echo $this->_tpl_vars['product']['product_id']; ?>
<?php endif; ?>'/>
				 </form>
			 </div>
			  <a onclick="removeFromCompareChart(this);"><img src='/public/resources/css/images/chart_minus.png' alt='Add to compare list' title='Remove from compare list'/></a>
            </div>
            <?php else: ?>
           	<div class='box' style='height:35px; text-align: center;'>  
           	 <div class='addToCompareChartDIV' style='display:none'>
	           	 <form class='addToCompareChartForm' action="<?php echo smarty_function_geturl(array('controller' => 'comparechart','action' => 'addtocomparelist'), $this);?>
">
				 	<input type='hidden' name='product' value="<?php if (isset ( $this->_tpl_vars['product']['product_inventory_id'] )): ?>inventory<?php else: ?>products<?php endif; ?>"/>
				 	<input type='hidden' name='number' value='<?php if (isset ( $this->_tpl_vars['product']['product_inventory_id'] )): ?><?php echo $this->_tpl_vars['product']['product_inventory_id']; ?>
<?php else: ?><?php echo $this->_tpl_vars['product']['product_id']; ?>
<?php endif; ?>'/>
				 </form>
			 </div>
			  <a onclick="addToCompareChart(this);"><img src='/public/resources/css/images/chart_add.png' alt='Add to compare list' title='Add to compare list'/></a>
            </div>
            <?php endif; ?>
            <div class='box' style='height:30px;'> 
				<a><img src='/public/resources/css/images/flags/flag_<?php echo $this->_tpl_vars['product']['uploader_network']; ?>
.png' alt='From <?php echo $this->_tpl_vars['product']['uploader_network']; ?>
' title='From <?php echo $this->_tpl_vars['product']['uploader_network']; ?>
' height='30'/></a>
            </div>
            
            
            
            <?php if ($this->_tpl_vars['product']['video_youtube'] != ''): ?>
            <div class='box' style='height:35px;'>               
                <a class='videoColorBox' href="http://www.youtube.com/v/<?php echo $this->_tpl_vars['product']['video_youtube']; ?>
"><img src="/public/resources/css/images/video_icon.png" width=37 alt='Product video' title='Product video'/></a>
            </div>    
            <?php endif; ?>
             
             <div class='productBox2' style='height:35px; text-align: center;'>
             	<span class="tooltipControl box" style='margin-top:5px;'><img src='/public/resources/css/images/add_to_compare_flattened.png'/></span>
				<div class='tooltip' style='width:600px; height:400px; background-color:white; border:1px solid #eee; z-index:10;'>
				<!-- now comes the partials -->
					<div class='box' style='width:300px; height:100%;'>
						<table>
		         		<tr style='height:350px;'><td style='padding:0px; margin:0px; width:300px;'>
		         		<div class="productFirstImage">
		                	<div class="productDescription">
		                       
		                    </div>
		                	<?php if (count($this->_tpl_vars['product']['images']) > 0): ?>
		                	<img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['product_tag']; ?>
/<?php echo $this->_tpl_vars['product']['images'][0]['image_id']; ?>
.W300_productDetailImage.jpg"/>
		                	<?php else: ?>
		                        No image
		                    <?php endif; ?>
		                </div>
		         		
		         		</td></tr>
		                
		               </table>
		                <div class="productDetails box">
	                    <div class="productMedia">
	                        <div class="productImages">
	                            <?php $_from = $this->_tpl_vars['product']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
	                                <div class="productIndividualImage">
	                                <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['product_tag']; ?>
/<?php echo $this->_tpl_vars['image']['image_id']; ?>
.W50_productSmallPreview.jpg" />
	                                <span class="imageLargeAddress" style="display:none">
	                                <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['product_tag']; ?>
/<?php echo $this->_tpl_vars['image']['image_id']; ?>
.W300_productDetailImage.jpg""/></span>					
	                                </div>
	                            <?php endforeach; endif; unset($_from); ?>
	                            <?php $_from = $this->_tpl_vars['product']['inventoryImages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['inventoryImage']):
?>
	                            	<div class="productIndividualImage">
	                                <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
/inventory/<?php echo $this->_tpl_vars['inventoryImage']['image_id']; ?>
.W50_productSmallPreview.jpg" />
	                                <span class="imageLargeAddress" style="display:none">
	                                <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
/inventory/<?php echo $this->_tpl_vars['inventoryImage']['image_id']; ?>
.W300_productDetailImage.jpg""/></span>					
	                                </div>
	                            <?php endforeach; endif; unset($_from); ?>
	                        </div>
	                    </div>
						</div>
						
				</div>
				<div class='productProfiles' style='width:260px; float:right; text-align: left; padding:0px 10px 0px 30px; background-color:#eee; height:100%;'>
	           
						<?php if (isset ( $this->_tpl_vars['product']['product_inventory_id'] )): ?>
	            		<?php $this->assign('orderAttribute', $this->_tpl_vars['product']['inventory_attribute_table']); ?>
	                  	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "productdisplay/_orderAttribute/_".($this->_tpl_vars['orderAttribute']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	                  	
	                  	<?php else: ?>
	                  	
	                  	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "productdisplay/_orderAttribute/_basic.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	                  	
	                  	<?php endif; ?>
	                  	
						 <div class='quickOrderActions' style='float:left; width:100%;'>
						 <?php if ($this->_tpl_vars['product']['purchase_type'] == 'Customizable'): ?>
						 
						 <a class='fullOrderDetailsColorBox largeAnchorButton'  style='float:left;' href="<?php echo smarty_function_geturl(array('controller' => 'productdisplay','action' => 'purchasedetails'), $this);?>
?number=<?php echo $this->_tpl_vars['product']['product_id']; ?>
&product=products">
Customize this</a>
						 <?php endif; ?>	
						 <?php if (isset ( $this->_tpl_vars['product']['product_inventory_id'] )): ?>
						  <a class='largeAnchorButton' style='float:left;' href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'additemtoshoppingcart'), $this);?>
?product=Inventory&id=<?php echo $this->_tpl_vars['product']['product_inventory_id']; ?>
">Add to cart</a>
						 <?php endif; ?>
						 
						 </div>
	            </div>
             </div>
             </div>
             
             </td></tr></table>
         </div>
    </div>
 <?php endforeach; endif; unset($_from); ?>
 </div>
<div class='box bottomPagination'>
<span style='font-size:1.2em; float:right;'><a>1</a></span>
</div>
 
<?php echo '
<script src="/public/resources/javascripts/productPreview/productImagePreviews.js" type="text/javascript"></script>

<script type="text/javascript">
new productPreviewImage(\'productTagBody\');
$j(".tooltipControl").tooltip({position: \'bottom center\'});
$j(\'a.fullOrderDetailsColorBox\').colorbox({width:\'800\', height:\'100%\'});
$j(\'a.videoColorBox\').colorbox({width:\'480\', height:\'385\', iframe:true});
</script>
'; ?>