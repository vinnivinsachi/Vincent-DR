<?php /* Smarty version 2.6.19, created on 2010-10-02 17:44:21
         compiled from ordermanager/_soldOrders/soldOrder.tpl */ ?>
			<table width="100%;">
                
                <?php $_from = $this->_tpl_vars['itemsSold']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['order']):
?>
                <tr style='border-bottom:3px solid #999;'><td style='width:100px;'><?php echo $this->_tpl_vars['order']->buyer_name; ?>
<br />
                        <?php echo $this->_tpl_vars['order']->shippingAddress->address_one; ?>
<br />
                        <?php if ($this->_tpl_vars['order']->shippingAddress->address_two != ''): ?>
                            <?php echo $this->_tpl_vars['order']->shippingAddress->address_two; ?>
<br />
                        <?php endif; ?>
                        <?php echo $this->_tpl_vars['order']->shippingAddress->city; ?>
 <?php echo $this->_tpl_vars['order']->shippingAddress->state; ?>
, <?php echo $this->_tpl_vars['order']->shippingAddress->zip; ?>
<br />
                        <?php echo $this->_tpl_vars['order']->shippingAddress->country; ?>

                        </td>
                	<td>
                	<table>
                    <?php $_from = $this->_tpl_vars['order']->products; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['productKey'] => $this->_tpl_vars['product']):
?>
                    <tr>
                    	<td style="padding-top: 10px;">
	                       	 	<?php $this->assign('orderStatusTemplate', $this->_tpl_vars['product']['order_status']); ?>
	                       	 	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ordermanager/_soldOrders/_".($this->_tpl_vars['orderStatusTemplate']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>		
                        </td>    
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                    </table>	
                </td>
                </tr>
				<?php endforeach; endif; unset($_from); ?>
            </table>
            

<?php echo '
<script type="text/javascript">
$j(".tooltipControl").tooltip({position: \'bottom center\'});
</script>
'; ?>