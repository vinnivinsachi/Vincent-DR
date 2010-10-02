<?php /* Smarty version 2.6.19, created on 2010-08-28 21:06:14
         compiled from partials/checkout/_basketInformation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'partials/checkout/_basketInformation.tpl', 12, false),array('function', 'geturl', 'partials/checkout/_basketInformation.tpl', 30, false),)), $this); ?>
<div id="basketInformation">
			<div id="productOrderTopTile" class='box'>
				<table class='box marginTop10'>
					<tr class='trTitle'><td>Product</td>
					<td style='text-align:center;'>Details</td>
					<td style='text-align: right;'>Quantity</td>
					<td style='text-align: right;'>Price</td>
					<td style='text-align: right;'>Reward Points</td>
					<td style='text-align: right;'></td></tr>
					
					<?php $_from = $this->_tpl_vars['shoppingCartProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cartKey'] => $this->_tpl_vars['product']):
?>
					<tr><td><br/><strong><?php echo $this->_tpl_vars['product']['product_name']; ?>
</strong><br/><?php echo $this->_tpl_vars['product']['uploader_username']; ?>
 / <?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['purchase_type']), $this);?>
<br/><br/><img src='/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
/<?php echo $this->_tpl_vars['product']['product_tag']; ?>
/<?php echo $this->_tpl_vars['product']['product_image_id']; ?>
.W150_homeFrontFour.jpg'/></td>
						<td ><table width="100%;">
							<?php $_from = $this->_tpl_vars['product']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['attributes']):
?>
	                            <tr>
	                            <td style='text-align:right; width:60%;'><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['Key']), $this);?>
: </td>
	                            <td style='text-align:left; width:40%;'><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['attributes']), $this);?>
</td>
	                            </tr>
                            <?php endforeach; endif; unset($_from); ?>
                            </table>
		                </td>
		                <td style='text-align: right;'>1</td>
		                <td style='text-align: right;' class='price'>
							$<?php echo $this->_tpl_vars['product']['product_price']; ?>

		                </td>
		                <td style='text-align: right; width:100px;'>
							+ <?php echo $this->_tpl_vars['product']['reward_points_awarded']; ?>
 points
		                </td>
		                <td style='text-align: right; width:100px;'>
		                <a href="<?php echo smarty_function_geturl(array('controller' => 'shoppingcart','action' => 'removeitemsfromshoppingcart'), $this);?>
?cartProductId=<?php echo $this->_tpl_vars['cartKey']; ?>
"><img src="/public/resources/css/images/Crosses.png" style="margin-bottom:-10px;"/></a>
		                </td>
					</tr>
					<tr style='border-bottom: 1px solid #666; '><td colspan='2'></td>
                    <td style='padding-bottom:5px; text-align:right;'>Shipping:</td>
                    <td style='padding-bottom:5px; text-align:right;'>
                    <span class='price' >$<?php echo $this->_tpl_vars['product']['current_shipping_rate']; ?>
</span>
                	</td><td colspan='2' style='text-align:right;'> <?php if ($this->_tpl_vars['product']['product_type_added_to_shopping_cart'] == 'Inventory'): ?>
                    Ship with in 3-5 days.
                    <?php elseif ($this->_tpl_vars['product']['product_type_added_to_shopping_cart'] == 'Customize'): ?>
                    Ship with in <?php echo $this->_tpl_vars['product']['backorder_time']; ?>

                    <?php endif; ?></td></tr>
					<?php endforeach; endif; unset($_from); ?>
				</table>
				
			</div>
</div>