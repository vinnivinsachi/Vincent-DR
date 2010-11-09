<span style="font-weight:bold; font-size:18px;">My Reward Points: {$RewardPoint}</span><br />
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
		{foreach from=$rewardPointTracking item=pointTracking}
        <div class="individualTrackingSection">
            <div class="pointTrackingNumber {if $pointTracking.point>=0}backgroundGreen{elseif $pointTracking.point<0}backgroundRed{/if}" style="width:20%; float:left; text-align:center; height:100%;">
            {$pointTracking.point} 
            </div>
            <div class="pointTrackingReason" style="width:60%; float:left;">
            {$pointTracking.name_of_event}<br />
            User: {$pointTracking.user_caused_Username}
            </div>
            <div class="pointTrackingTime" style="width:20%; float:left;">
            {$pointTracking.time}
            </div>
        </div>
        {/foreach}
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
            <span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span>
            <div>
            <label style="width:50%;">Email:</label>
            <input type="text" name="referalEmail" value="" />
            </div>
            <div>
            <label style="width:50%;">Message:</label>
            <textarea name="shoutout_message"></textarea>
            {include file='lib/error.tpl' error=''}
            </div>
            <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send Invitation!"/>
        </form>
    </div>
    
    <div id="referalTracking" style="display:none;">
    	Friends who you invited that joined!
    </div>
</div>
</div>