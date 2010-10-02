<?php /* Smarty version 2.6.19, created on 2010-08-23 15:28:35
         compiled from partials/account/rewardPoint.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'partials/account/rewardPoint.tpl', 78, false),)), $this); ?>
<span style="font-weight:bold; font-size:18px;">My Reward Points: <?php echo $this->_tpl_vars['RewardPoint']; ?>
</span><br />
<strong>4 reward point = $1</strong><br /><br />
You can increase your reward point by:<br />
<div id="accountDetailRewardpoints">

<ul>
    <li><a href="#">Write a review for a completed order</a>
        <ul>
            <li>Earn 8 reward point for every review you write on a completed order purchase</li>
        </ul></li>
    <div class="invidteFriendToJoinFormDiv" >

    <li>
   	 	<a class="referalToggle">Invite friends to join</a>
        <ul>
            <li>Earn 4 reward point for every friend that you have invited that joined! <a href="#">Friends that you have invited</a>
            When you use the recommender below, people who visits the website through that email and joins will be recommended by you.</li>
        </ul></li>
    </div>
    <li>Purchase items
        <ul>
            <li>Every purchase increases your reward points based on the item.</li>
        </ul></li>
    <li><a href="#">Purchase reward points</a>
        <ul>
            <li>You can purchase reward points for you or your friends and earn EXTRA reward points!</li>
        </ul>
    </li>
</ul>

<div id="rewardpointTrackingAndPruchase">

	<div id="rewardPointNavigation" class="navigation">
    	<a class="productTagHeaderButton currentSelection" id="rewardPointTracking">Track reward points</a>
        <a class="productTagHeaderButton" id="rewardPointPurchase">purchase reward points</a>
    </div>
    
    <div id="trackRewardPointDiv" style="height:150px; overflow-y:scroll; float:left; width:100%;">
		<?php $_from = $this->_tpl_vars['rewardPointTracking']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pointTracking']):
?>
        <div class="individualTrackingSection">
            <div class="pointTrackingNumber <?php if ($this->_tpl_vars['pointTracking']['point'] >= 0): ?>backgroundGreen<?php elseif ($this->_tpl_vars['pointTracking']['point'] < 0): ?>backgroundRed<?php endif; ?>" style="width:20%; float:left; text-align:center; height:100%;">
            <?php echo $this->_tpl_vars['pointTracking']['point']; ?>
 
            </div>
            <div class="pointTrackingReason" style="width:60%; float:left;">
            <?php echo $this->_tpl_vars['pointTracking']['name_of_event']; ?>
<br />
            User: <?php echo $this->_tpl_vars['pointTracking']['user_caused_Username']; ?>

            </div>
            <div class="pointTrackingTime" style="width:20%; float:left;">
            <?php echo $this->_tpl_vars['pointTracking']['time']; ?>

            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    
    <div id="pruchaseRewardPointDiv" style="display:none; height:150px; ">
    	<form>
        <label>please select a reward point purchase</label>
        <select name="rewardPointPurchase">
        <option value="100">100 reward points / 25 dollars</option>
        <option value="300">300 reward points / 75 dollars</option>
        <option value="1200">1200 reward points / 300 dollars</option>
        </select>
        </form>
    </div>
</div>

<div id="referralTrackingAndInvite">

    <div id="referalNavigation" class="navigation">
        <a class="productTagHeaderButton currentSelection" id="referalMessageSelection">Refer a friend</a>
        <a class="productTagHeaderButton" id="referalViewFriends">View referrals</a>
    </div>
    
    <div id="referalForm" style="float:left; width:100%;">
    <span style="font-weight:bold;">Earn 4 reward point for every friend that you have invited that joined!</span>
        <form action="" method="post" class="account-shoutbox-form">
            <label style="width:50%;">Current time:</label>
            <span style="float:left; width:40%;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D, %I:%M %p") : smarty_modifier_date_format($_tmp, "%D, %I:%M %p")); ?>
</span>
            <div>
            <label style="width:50%;">Email:</label>
            <input type="text" name="referalEmail" value="" />
            </div>
            <div>
            <label style="width:50%;">Message:</label>
            <textarea name="shoutout_message"></textarea>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send Invitation!"/>
        </form>
    </div>
    
    <div id="referalTracking" style="display:none;">
    	Friends who you invited that joined!
    </div>
</div>
</div>