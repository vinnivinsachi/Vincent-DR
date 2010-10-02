<?php /* Smarty version 2.6.19, created on 2010-08-23 15:28:34
         compiled from account/rewardpoints.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="leftContainer" style="width:21%; float:left;">	

<ul id="qm0" class="qmmc" style="width:100%;">
            <li><a class="qmparent" href="javascript:void(0)">My reward points (<?php echo $this->_tpl_vars['userRewardPoint']; ?>
)</a>
                <ul>
                    <li><a>Track reward points</a></li>
                   	<li><a>Earn reward points</a>
                    	<ul>
                        	<li><a>Refer a dancer to join</a></li>
                        </ul></li>
                    <li><a>Purchase reward points</a></li>
                </ul>
            </li>
           
<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>



</div>

<div id="rightColumn" style="width:78%; float:right;">
	
<?php if ($this->_tpl_vars['user']->generalInfo->user_type == 'generalSeller' || $this->_tpl_vars['user']->generalInfo->user_type == 'storeSeller'): ?> 

	<fieldset >
    	<legend>Customer Reviews</legend>
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/account/customerReview.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </fieldset>
<?php endif; ?>
	<fieldset>
    <legend>My reward point</legend>

    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/account/rewardPoint.tpl', 'smarty_include_vars' => array('RewardPoint' => $this->_tpl_vars['userRewardPoint'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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