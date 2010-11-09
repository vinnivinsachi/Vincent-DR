{include file="layouts/$layout/header.tpl" lightbox=true}

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
		<legend>Account-Info</legend>
	    First name: {$user->details->firstName}<br />
		Last name: {$user->details->lastName}<br />
	    username: {$user->username}<br />
	    usertype:	{$user->details->userType} <br />
	    password: XXXXXXX<br />
	    Email: {$user->details->email}<br />
	    Gender: {$user->details->sex}<br />
	    ---Optional info---<br />
	    Affilitions: {$user->details->affiliation}<br />
		Dance experience: {$user->details->experience}<br />
	    <a href='{$siteRoot}/account/editbasicinfo'>Edit</a>
		</fieldset>  
	    
	    {if $user->details->userType =='generalSeller' ||$user->details->userType =='storeSeller'} 
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
	        {if $user->details->user_type =='generalSeller'}
	        <a href='{$siteRoot}/account/upgradegeneralseller'>Edit</a><br />
	        {elseif $user->details->user_type =='storeSeller'}
	        <a href='{$siteRoot}/account/upgradestoreseller'>Edit</a><br />
	        {/if}
	  	</fieldset>
	    {/if}
	    
	    
	    <fieldset>
	        <legend>Current Address</legend>
	        {if $defaultShippingKey}
	        {$user->details->shippingAddress[$defaultShippingKey]->address_one}<br />
	         {if $user->details->shippingAddress[$defaultShippingKey]->address_two!=''}
	        {$user->details->shippingAddress[$defaultShippingKey]->address_two}<br />
	        {/if}
	        {$user->details->shippingAddress[$defaultShippingKey]->city}, {$user->details->shippingAddress[$defaultShippingKey]->state} {$user->details->shippingAddress[$defaultShippingKey]->zip} <br />
	        {$user->details->shippingAddress[$defaultShippingKey]->country}<br />
	        <a href='{$siteRoot}/account/editshipping?editAddress={$defaultShippingKey}'>Edit</a> | 
	        <a href='{$siteRoot}/account/deletshipping?editAddress={$defaultShippingKey}'>Delete</a><br />
			{else}
	        There is no Default Shipping Address
	        {/if}
	    </fieldset>
	    <fieldset>
	     	<legend>All Shipping Addresses</legend><br />
	        {foreach from=$user->details->shippingAddress item=Item key=Key}
	        <div class="shippingAddressBox">
	            {$user->details->shippingAddress[$Key]->address_one}<br />
	            {if $user->details->shippingAddress[$Key]->address_two!=''}
	            Address Two: {$user->details->shippingAddress[$Key]->address_two}<br />
	            {/if}
	           {$user->details->shippingAddress[$Key]->city}, {$user->details->shippingAddress[$Key]->state} {$user->details->shippingAddress[$Key]->zip}
	           {$user->details->shippingAddress[$Key]->country}<br />
	            <a href='{$siteRoot}/account/editshipping?editAddress={$Key}'>Edit</a> | 
	            <a href='{$siteRoot}/account/deletshipping?editAddress={$Key}'>Delete</a> 
	            {if $defaultShippingKey!=$Key}
	            | <a href='{$siteRoot}/account/makedefaultshipping?editAddress={$Key}'>Make Default</a><br />
	            {else}
	            <br />
	            {/if}
	        </div>
	        {/foreach}
	        <div style="float:left; width:100%;"><a href='{$siteRoot}/account/editshipping'>Add a shipping address</a></div>
	    </fieldset>
	     
	     <fieldset>
	    	<legend>Account Actions</legend>
	    		{if $user->details->user_type =='member'}
	            <a href='{$siteRoot}/account/upgradegeneralseller'>Sell some of your dancewear!</a><br />
	            {/if}
	            {if $user->details->is_instructor == 0}
	            <a href="#">List yourself as a dance instructor</a><br />
	            {else}
	            <a href="#">Remove yourself as a dance instructor</a><br />
	            {/if}
	            {if $user->details->finding_partner == 0}
	            <a href="#">List yourself for partner search</a><br />
	            {else}
	            <a href="#">Remove yourself from partner search</a><br />
	            {/if}
	         </form>
	    </fieldset>
	            
	      
	</div>


</div>

{include file="layouts/$layout/footer.tpl"}