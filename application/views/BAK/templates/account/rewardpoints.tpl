{include file="layouts/$layout/header.tpl" lightbox=true}

<div id="leftContainer" style="width:21%; float:left;">	

<ul id="qm0" class="qmmc" style="width:100%;">
            <li><a class="qmparent" href="javascript:void(0)">My reward points ({$userRewardPoint})</a>
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
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}


</div>

<div id="rightColumn" style="width:78%; float:right;">
	
{if $user->generalInfo->user_type =='generalSeller' ||$user->generalInfo->user_type =='storeSeller'} 

	<fieldset >
    	<legend>Customer Reviews</legend>
    	{include file='partials/account/customerReview.tpl'}
    </fieldset>
{/if}
	<fieldset>
    <legend>My reward point</legend>

    	{include file='partials/account/rewardPoint.tpl' RewardPoint=$userRewardPoint}
    </fieldset>  
      
</div>

{literal}
<script type="text/javascript">
new individualToggle('rewardPointTracking', 'trackRewardPointDiv', 'currentSelection', Array('pruchaseRewardPointDiv'), Array('rewardPointPurchase'));

new individualToggle('rewardPointPurchase', 'pruchaseRewardPointDiv', 'currentSelection', Array('trackRewardPointDiv'), Array('rewardPointTracking'));		
new individualToggle('referalMessageSelection', 'referalForm', 'currentSelection', Array('referalTracking'), Array('referalViewFriends'));
new individualToggle('referalViewFriends', 'referalTracking', 'currentSelection', Array('referalForm'), Array('referalMessageSelection'));	

</script>

{/literal}


{include file="layouts/$layout/footer.tpl"}