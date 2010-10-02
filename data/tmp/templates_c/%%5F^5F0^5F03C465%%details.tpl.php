<?php /* Smarty version 2.6.19, created on 2010-10-01 23:15:08
         compiled from account/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'account/details.tpl', 51, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="leftContainer" style="width:21%; float:left;">	

<ul id="qm0" class="qmmc" style="width:100%;">
            <li><a class="qmparent" href="javascript:void(0)">Account info</a>
                <ul>
                	<li><a>Edit your account info</a></li>
                </ul>
            </li>
            <li><a class="qmparent" href="javascript:void(0)">Current address</a>
            	<ul>
                	<li><a>Edit your current address</a></li>
                </ul>
            </li>
            <li><a class="qmparent" href="javascript:void(0)">All Shipping address</a>
            	<ul>
                	<li><a>Add a shipping address</a></li>
                </ul>
            </li>
            <li><a class="qmparent" href="javascript:void(0)">Account actions</a>
            	<ul>
                	<li><a>Sell your dancewear</a></li>
                    <li><a>List yourself as a dance instructor</a></li>
                    <li><a>List yourself for partner search</a></li>
                </ul>	
            </li>
</ul>
           
<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>


</div>

<div id="rightColumn" style="width:78%; float:right;">
	
    <fieldset> 	
	<legend>Account-Info</legend>
    First name: <?php echo $this->_tpl_vars['user']->generalInfo->first_name; ?>
<br />
	Last name: <?php echo $this->_tpl_vars['user']->generalInfo->last_name; ?>
<br />
    username: <?php echo $this->_tpl_vars['user']->generalInfo->username; ?>
<br />
    usertype:	<?php echo $this->_tpl_vars['user']->generalInfo->user_type; ?>
 <br />
    password: XXXXXXX<br />
    Email: <?php echo $this->_tpl_vars['user']->generalInfo->email; ?>
<br />
    Gender: <?php echo $this->_tpl_vars['user']->generalInfo->sex; ?>
<br />
    ---Optional info---<br />
    Affilitions: <?php echo $this->_tpl_vars['user']->generalInfo->affiliation; ?>
<br />
	Dance experience: <?php echo $this->_tpl_vars['user']->generalInfo->experience; ?>
<br />
    <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'editbasicinfo'), $this);?>
">Edit</a>
	</fieldset>  
    
    <?php if ($this->_tpl_vars['user']->generalInfo->user_type == 'generalSeller' || $this->_tpl_vars['user']->generalInfo->user_type == 'storeSeller'): ?> 
    <fieldset>
    	<legend>Sellers Information</legend>
        Paypal Email: <?php echo $this->_tpl_vars['user']->sellerInfo->paypal_email; ?>
<br />
        
        Status: <?php if ($this->_tpl_vars['user']->sellerInfo->verified == '0' || ! isset ( $this->_tpl_vars['user']->sellerInfo->verified )): ?>Need to verify! <a href="<?php echo smarty_function_geturl(array('action' => 'verifyselleraccount'), $this);?>
?sUqid=<?php echo $this->_tpl_vars['user']->sellerInfo->unique_identifier; ?>
">Send Verification Email</a><?php else: ?>VERIFIED<?php endif; ?><br />
		Phone number: <?php echo $this->_tpl_vars['user']->sellerInfo->phone_number; ?>
<br />
		<?php echo $this->_tpl_vars['user']->sellerInfo->address_one; ?>
<br />
        <?php if ($this->_tpl_vars['user']->sellerInfo->address_two != ''): ?>
		<?php echo $this->_tpl_vars['user']->sellerInfo->address_two; ?>
<br />
        <?php endif; ?>
        <?php echo $this->_tpl_vars['user']->sellerInfo->city; ?>
, <?php echo $this->_tpl_vars['user']->sellerInfo->state; ?>
 <?php echo $this->_tpl_vars['user']->sellerInfo->zip; ?>
<br />
        <?php echo $this->_tpl_vars['user']->sellerInfo->country; ?>
<br />
        <?php if ($this->_tpl_vars['user']->generalInfo->user_type == 'generalSeller'): ?>
        <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'upgradegeneralseller'), $this);?>
">Edit</a><br />
        <?php elseif ($this->_tpl_vars['user']->generalInfo->user_type == 'storeSeller'): ?>
        <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'upgradestoreseller'), $this);?>
">Edit</a><br />
        <?php endif; ?>
  	</fieldset>
    <?php endif; ?>
    
    
    <fieldset>
        <legend>Current Address</legend>
        <?php if ($this->_tpl_vars['defaultShippingKey']): ?>
        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->address_one; ?>
<br />
         <?php if ($this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->address_two != ''): ?>
        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->address_two; ?>
<br />
        <?php endif; ?>
        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->city; ?>
, <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->state; ?>
 <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->zip; ?>
 <br />
        <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['defaultShippingKey']]->country; ?>
<br />
        <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'editshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['defaultShippingKey']; ?>
">Edit</a> | 
        <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'deleteshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['defaultShippingKey']; ?>
">Delete</a><br />
		<?php else: ?>
        There is no Default Shipping Address
        <?php endif; ?>
    </fieldset>
    <fieldset>
     	<legend>All Shipping Addresses</legend><br />
        <?php $_from = $this->_tpl_vars['user']->generalInfo->shippingAddress; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['Item']):
?>
        <div class="shippingAddressBox">
            <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->address_one; ?>
<br />
            <?php if ($this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->address_two != ''): ?>
            Address Two: <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->address_two; ?>
<br />
            <?php endif; ?>
           <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->city; ?>
, <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->state; ?>
 <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->zip; ?>

           <?php echo $this->_tpl_vars['user']->generalInfo->shippingAddress[$this->_tpl_vars['Key']]->country; ?>
<br />
            <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'editshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['Key']; ?>
">Edit</a> | 
            <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'deleteshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['Key']; ?>
">Delete</a> 
            <?php if ($this->_tpl_vars['defaultShippingKey'] != $this->_tpl_vars['Key']): ?>
            | <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'makedefaultshipping'), $this);?>
?editAddress=<?php echo $this->_tpl_vars['Key']; ?>
">Make Default</a><br />
            <?php else: ?>
            <br />
            <?php endif; ?>
        </div>
        <?php endforeach; endif; unset($_from); ?>
        <div style="float:left; width:100%;"><a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'editshipping'), $this);?>
">Add a shipping address</a></div>
    </fieldset>
     
     <fieldset>
    	<legend>Account Actions</legend>
    		<?php if ($this->_tpl_vars['user']->generalInfo->user_type == 'member'): ?>
            <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'upgradegeneralseller'), $this);?>
">Sell some of your dancewear!</a><br />
            <?php endif; ?>
            <?php if ($this->_tpl_vars['user']->generalInfo->is_instructor == 0): ?>
            <a href="#">List yourself as a dance instructor</a><br />
            <?php else: ?>
            <a href="#">Remove yourself as a dance instructor</a><br />
            <?php endif; ?>
            <?php if ($this->_tpl_vars['user']->generalInfo->finding_partner == 0): ?>
            <a href="#">List yourself for partner search</a><br />
            <?php else: ?>
            <a href="#">Remove yourself from partner search</a><br />
            <?php endif; ?>
         </form>
    </fieldset>
            
      
</div>

<?php echo '
<script type="text/javascript">
new individualToggle(\'rewardPointTracking\', \'trackRewardPointDiv\', \'currentSelection\', Array(\'pruchaseRewardPointDiv\'), Array(\'rewardPointPurchase\'));

new individualToggle(\'rewardPointPurchase\', \'pruchaseRewardPointDiv\', \'currentSelection\', Array(\'trackRewardPointDiv\'), Array(\'rewardPointTracking\'));		
new individualToggle(\'referalMessageSelection\', \'referalForm\', \'currentSelection\', Array(\'referalTracking\'), Array(\'referalViewFriends\'));
new individualToggle(\'referalViewFriends\', \'referalTracking\', \'currentSelection\', Array(\'referalForm\'), Array(\'referalMessageSelection\'));	

</script>

'; ?>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>