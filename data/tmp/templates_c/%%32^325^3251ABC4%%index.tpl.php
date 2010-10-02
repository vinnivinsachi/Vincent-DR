<?php /* Smarty version 2.6.19, created on 2010-09-02 17:34:04
         compiled from ordermanager/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="shoppingcart">
		<tr class="title2">
		<?php if ($this->_tpl_vars['orderType'] == 'seller'): ?>
			<td>Order From:</td>
		<?php else: ?>
			<td>Order To:</td>
		<?php endif; ?>
			<td>Time:</td>
			<td>Total amount:</td>
			<td>Details:</td>
			<td>Feedback:</td>
			<td>Status:</td>
		</tr>
<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['order'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['order']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['order']):
        $this->_foreach['order']['iteration']++;
?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'ordermanager/lib/order-list.tpl', 'smarty_include_vars' => array('order' => $this->_tpl_vars['order'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; endif; unset($_from); ?>

</table>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>