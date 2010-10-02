<?php /* Smarty version 2.6.19, created on 2010-06-11 17:30:17
         compiled from account/orders.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'account/orders.tpl', 5, false),array('modifier', 'date_format', 'account/orders.tpl', 10, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('section' => 'account')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="leftContainer" style="width:22%; float:left;">	
<ul id="qm0" class="qmmc" style="width:100%;">
            <li><a class="qmparent qmactive" href="javascript:void(0)">Bought Items (<?php echo count($this->_tpl_vars['orders']); ?>
)</a>
            	<?php if (count($this->_tpl_vars['orders']) > 0): ?>
                <ul>
                	<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
                
                <li><a ><span style="font-weight:bold; <?php if ($this->_tpl_vars['product']['product_order_status'] == 'shipped'): ?>color:#069;<?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'return shipped' || ((is_array($_tmp=$this->_tpl_vars['product']['product_absolute_latest_delivery_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : date_format($_tmp)) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : date_format($_tmp))): ?>color:#F30;<?php elseif ($this->_tpl_vars['product']['product_order_status'] == 'completed' || $this->_tpl_vars['product']['product_order_status'] == 'order return completed'): ?>color:#0C0;<?php else: ?> color:#F90;<?php endif; ?> font-size:12px; fon"><?php echo $this->_tpl_vars['product']['product_order_status']; ?>
</span> <?php echo ((is_array($_tmp=$this->_tpl_vars['order']->ts_created)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : date_format($_tmp, "%D")); ?>
<br />
                Items(<?php echo count($this->_tpl_vars['order']->products); ?>
), Total: $<?php echo $this->_tpl_vars['order']->final_total_costs; ?>
<br />
                <br />								
								</a>
                         <ul>       
                         <?php $_from = $this->_tpl_vars['order']->products; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['productKey'] => $this->_tpl_vars['product']):
?>
                                <li><a href="<?php echo $_SERVER['request_uri']; ?>
#orderMainDiv-<?php echo $this->_tpl_vars['order']->order_unique_id; ?>
">
                               <?php echo $this->_tpl_vars['product']['product_name']; ?>
 <br />Order ID: <?php echo $this->_tpl_vars['order']->order_unique_id; ?>

                                </a></li>
                    	<?php endforeach; endif; unset($_from); ?>
                        </ul></li>
                	<?php endforeach; endif; unset($_from); ?>
                </ul>
                <?php endif; ?></li>
</ul>
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>


</div>

<div id="rightColumn" style="width:77%; float:right;">

        <div id="orderHistoryBox" style=" max-height:800px; overflow-y:scroll; width:100%; color:black;">
        	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/ordermanager/boughtOrder.tpl', 'smarty_include_vars' => array('orders' => $this->_tpl_vars['orders'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
</div>

<?php echo '
<script type="text/javascript">

new orderToggle(\'.anchorOrderMessageSeller\', \'.anchorTrackingStatus\',\'.anchorReturnTrackingStatus\',\'.anchorReturnItem\',\'.anchorTrackingForm\', \'.anchorOrderCancelled\',\'.anchorProductReview\', \'currentSelection\');

																										
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array('leftcolumn' => 'lib/ProductList.tpl','products' => $this->_tpl_vars['cartObject'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>