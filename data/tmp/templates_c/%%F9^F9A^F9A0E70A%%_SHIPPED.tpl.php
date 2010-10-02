<?php /* Smarty version 2.6.19, created on 2010-09-02 14:57:03
         compiled from adminorders/_orderStatusControls/_SHIPPED.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'adminorders/_orderStatusControls/_SHIPPED.tpl', 3, false),)), $this); ?>

   <tr>
   		 <td colspan="6">[<a class="anchorOrderMessageBuyer" id="anchorID-anchorOrderMessageBuyer-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" >Message buyer: <?php echo $this->_tpl_vars['orderProfile']['buyer_name']; ?>
</a>] [<a class="anchorOrderMessageSeller" id="anchorID-anchorOrderMessageSeller-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" >Message seller: <?php echo $this->_tpl_vars['orderProfile']['product_Username']; ?>
</a>] [<a class="anchorMessageThread" id="anchorID-anchorMessageThread-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
">Buyer and seller message thread</a>] [<a href="<?php echo smarty_function_geturl(array('controller' => 'ordermanager','action' => 'vieworderprofiledetails'), $this);?>
?id=<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
">View order details</a>]</td>
        <td colspan="2">[<a class="anchorTrackingStatus" id="anchorID-DivIDtrackingStatusInfo-<?php echo $this->_tpl_vars['orderProfile']['order_unique_id']; ?>
_<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
" title="<?php echo $this->_tpl_vars['orderProfile']['product_tracking']; ?>
">Tracking</a>]</td>
        <td>[<a href="<?php echo smarty_function_geturl(array('controller' => 'orderadministration','action' => 'markorderasdelivered'), $this);?>
?id=<?php echo $this->_tpl_vars['orderProfile']['order_profile_id']; ?>
">Mark as delivered</a>]</td>
   </tr>
   