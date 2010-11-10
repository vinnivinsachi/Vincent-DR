{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>

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
	</div>
	
	
	<div id="rightColumn" style="width:78%; float:right;">
		
	    <fieldset> 	
			<legend>Account Info</legend>
		    First name: {$user->firstName}<br />
			Last name: {$user->lastName}<br />
		    username: {$user->username}<br />
		    usertype:	{$user->userType} <br />
		    password: XXXXXXX<br />
		    Email: {$user->email}<br />
		    Gender: {$user->sex}<br />
		    ---Optional info---<br />
		    Affilitions: {$user->affiliation}<br />
			Dance experience: {$user->experience}<br />
		    <a href='{$siteRoot}/account/editbasicinfo'>Edit</a>
		</fieldset>  
	    
	    
	    <!-- If user is a general seller -->
	    {if $user->userType =='generalSeller' ||$user->userType =='storeSeller'} 
	    <fieldset>
	    	<legend>Sellers Information</legend>
	        Paypal Email: {$user->sellerInfo->paypal_email}<br />
	        
	        Status: {if $user->sellerInfo->verified =='0' || !isset($user->sellerInfo->verified)}Need to verify! <a href='{$siteRoot}/account/verifyselleraccount?sUqid={$user->sellerInfo->unique_identifier}'>Send Verification Email</a>{else}VERIFIED{/if}<br />
			Phone number: {$user->sellerInfo->phone_number}<br />
			{$user->sellerInfo->address_one}<br />
	        {if $user->sellerInfo->address_two!=''}
			{$user->sellerInfo->address_two}<br />
	        {/if}
	        {$user->sellerInfo->city}, {$user->sellerInfo->state} {$user->sellerInfo->zip}<br />
	        {$user->sellerInfo->country}<br />
	        {if $user->user_type =='generalSeller'}
	        <a href='{$siteRoot}/account/upgradegeneralseller'>Edit</a><br />
	        {elseif $user->user_type =='storeSeller'}
	        <a href='{$siteRoot}/account/upgradestoreseller'>Edit</a><br />
	        {/if}
	  	</fieldset>
	    {/if}
	    
	    
	    <!-- Addresses -->
	    <fieldset>
	        <legend>Current Address</legend>
	        {if $defaultShippingKey}
	        {$user->shippingAddress[$defaultShippingKey]->address_one}<br />
	         {if $user->shippingAddress[$defaultShippingKey]->address_two!=''}
	        {$user->shippingAddress[$defaultShippingKey]->address_two}<br />
	        {/if}
	        {$user->shippingAddress[$defaultShippingKey]->city}, {$user->shippingAddress[$defaultShippingKey]->state} {$user->shippingAddress[$defaultShippingKey]->zip} <br />
	        {$user->shippingAddress[$defaultShippingKey]->country}<br />
	        <a href='{$siteRoot}/account/editshipping?editAddress={$defaultShippingKey}'>Edit</a> | 
	        <a href='{$siteRoot}/account/deletshipping?editAddress={$defaultShippingKey}'>Delete</a><br />
			{else}
	        There is no Default Shipping Address
	        {/if}
	    </fieldset>
	    
	    <fieldset>
	     	<legend>All Shipping Addresses</legend><br />
	        {foreach from=$user->shippingAddresses item=address}
	        <div class="shippingAddressBox">
	            {$address->addressOne}<br />
	            {if $address->addressTwo}
	            	Address Two: {$address->addressTwo}<br />
	            {/if}
	           {$address->city}, {$address->state} {$address->zip}
	           {$address->country}<br />
	            <a href='{$siteRoot}/account/editshipping?editAddress={$address->addressID}'>Edit</a> | 
	            <a href='{$siteRoot}/account/deletshipping?editAddress={$address->addressID}'>Delete</a> 
	            {if $defaultShippingKey!=$Key}
	            | <a href='{$siteRoot}/account/makedefaultshipping?editAddress={$Key}'>Make Default</a><br />
	            {else}
	            <br />
	            {/if}
	        </div>
	        <br />
	        {/foreach}
	        <div style="float:left; width:100%;"><a href='{$siteRoot}/account/editshipping'>Add a shipping address</a></div>
	    </fieldset>
	     
	     
	     
	     <!-- Account actions -->
	     <fieldset>
	    	<legend>Account Actions</legend>
	    		{if $user->user_type =='member'}
	            <a href='{$siteRoot}/account/upgradegeneralseller'>Sell some of your dancewear!</a><br />
	            {/if}
	            {if $user->is_instructor == 0}
	            <a href="#">List yourself as a dance instructor</a><br />
	            {else}
	            <a href="#">Remove yourself as a dance instructor</a><br />
	            {/if}
	            {if $user->finding_partner == 0}
	            <a href="#">List yourself for partner search</a><br />
	            {else}
	            <a href="#">Remove yourself from partner search</a><br />
	            {/if}
	         </form>
	    </fieldset>
	            
	      
	</div>


</div>

{include file="layouts/$layout/footer.tpl"}