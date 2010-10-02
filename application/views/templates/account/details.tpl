{include file="layouts/$layout/header.tpl" lightbox=true}

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
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}

</div>

<div id="rightColumn" style="width:78%; float:right;">
	
    <fieldset> 	
	<legend>Account-Info</legend>
    First name: {$user->generalInfo->first_name}<br />
	Last name: {$user->generalInfo->last_name}<br />
    username: {$user->generalInfo->username}<br />
    usertype:	{$user->generalInfo->user_type} <br />
    password: XXXXXXX<br />
    Email: {$user->generalInfo->email}<br />
    Gender: {$user->generalInfo->sex}<br />
    ---Optional info---<br />
    Affilitions: {$user->generalInfo->affiliation}<br />
	Dance experience: {$user->generalInfo->experience}<br />
    <a href="{geturl controller='account' action='editbasicinfo'}">Edit</a>
	</fieldset>  
    
    {if $user->generalInfo->user_type =='generalSeller' ||$user->generalInfo->user_type =='storeSeller'} 
    <fieldset>
    	<legend>Sellers Information</legend>
        Paypal Email: {$user->sellerInfo->paypal_email}<br />
        
        Status: {if $user->sellerInfo->verified =='0' || !isset($user->sellerInfo->verified)}Need to verify! <a href="{geturl action='verifyselleraccount'}?sUqid={$user->sellerInfo->unique_identifier}">Send Verification Email</a>{else}VERIFIED{/if}<br />
		Phone number: {$user->sellerInfo->phone_number}<br />
		{$user->sellerInfo->address_one}<br />
        {if $user->sellerInfo->address_two!=''}
		{$user->sellerInfo->address_two}<br />
        {/if}
        {$user->sellerInfo->city}, {$user->sellerInfo->state} {$user->sellerInfo->zip}<br />
        {$user->sellerInfo->country}<br />
        {if $user->generalInfo->user_type =='generalSeller'}
        <a href="{geturl controller='account' action='upgradegeneralseller'}">Edit</a><br />
        {elseif $user->generalInfo->user_type =='storeSeller'}
        <a href="{geturl controller='account' action='upgradestoreseller'}">Edit</a><br />
        {/if}
  	</fieldset>
    {/if}
    
    
    <fieldset>
        <legend>Current Address</legend>
        {if $defaultShippingKey}
        {$user->generalInfo->shippingAddress[$defaultShippingKey]->address_one}<br />
         {if $user->generalInfo->shippingAddress[$defaultShippingKey]->address_two!=''}
        {$user->generalInfo->shippingAddress[$defaultShippingKey]->address_two}<br />
        {/if}
        {$user->generalInfo->shippingAddress[$defaultShippingKey]->city}, {$user->generalInfo->shippingAddress[$defaultShippingKey]->state} {$user->generalInfo->shippingAddress[$defaultShippingKey]->zip} <br />
        {$user->generalInfo->shippingAddress[$defaultShippingKey]->country}<br />
        <a href="{geturl controller='account' action='editshipping'}?editAddress={$defaultShippingKey}">Edit</a> | 
        <a href="{geturl controller='account' action='deleteshipping'}?editAddress={$defaultShippingKey}">Delete</a><br />
		{else}
        There is no Default Shipping Address
        {/if}
    </fieldset>
    <fieldset>
     	<legend>All Shipping Addresses</legend><br />
        {foreach from=$user->generalInfo->shippingAddress item=Item key=Key}
        <div class="shippingAddressBox">
            {$user->generalInfo->shippingAddress[$Key]->address_one}<br />
            {if $user->generalInfo->shippingAddress[$Key]->address_two!=''}
            Address Two: {$user->generalInfo->shippingAddress[$Key]->address_two}<br />
            {/if}
           {$user->generalInfo->shippingAddress[$Key]->city}, {$user->generalInfo->shippingAddress[$Key]->state} {$user->generalInfo->shippingAddress[$Key]->zip}
           {$user->generalInfo->shippingAddress[$Key]->country}<br />
            <a href="{geturl controller='account' action='editshipping'}?editAddress={$Key}">Edit</a> | 
            <a href="{geturl controller='account' action='deleteshipping'}?editAddress={$Key}">Delete</a> 
            {if $defaultShippingKey!=$Key}
            | <a href="{geturl controller='account' action='makedefaultshipping}?editAddress={$Key}">Make Default</a><br />
            {else}
            <br />
            {/if}
        </div>
        {/foreach}
        <div style="float:left; width:100%;"><a href="{geturl controller='account' action='editshipping'}">Add a shipping address</a></div>
    </fieldset>
     
     <fieldset>
    	<legend>Account Actions</legend>
    		{if $user->generalInfo->user_type =='member'}
            <a href="{geturl controller='account' action='upgradegeneralseller'}">Sell some of your dancewear!</a><br />
            {/if}
            {if $user->generalInfo->is_instructor == 0}
            <a href="#">List yourself as a dance instructor</a><br />
            {else}
            <a href="#">Remove yourself as a dance instructor</a><br />
            {/if}
            {if $user->generalInfo->finding_partner == 0}
            <a href="#">List yourself for partner search</a><br />
            {else}
            <a href="#">Remove yourself from partner search</a><br />
            {/if}
         </form>
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