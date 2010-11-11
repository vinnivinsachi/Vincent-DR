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
		    <table class='right-align-table'>
				<tr>
					<td>Username:</td>
					<td><b>{$user->username}</b></td>
				</tr>
				
				<tr>
					<td>User Type:</td>
					<td><b>{$user->role}</b></td>
				</tr>
				
				<tr>
					<td>Email:</td>
					<td><b>{$user->email}</b></td>
				</tr>
								
				<tr>
					<td>First Name:</td>
					<td><b>{$user->firstName}</b></td>
				</tr>
				
				<tr>
					<td>Last Name:</td>
					<td><b>{$user->lastName}</b></td>
				</tr>
				
				<tr>
					<td>Gender:</td>
					<td><b>{$user->sex}</b></td>
				</tr>
				
				<tr>
					<td>Affiliation:</td>
					<td><b>{$user->affiliation}</b></td>
				</tr>
				
				<tr>
					<td>Dance Experience:</td>
					<td><b>{$user->experience}</b></td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td><a href='{$siteRoot}/account/editbasicinfo'>Edit</a></td>
				</tr>
			</table>
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
	        <legend>Default Shipping Address</legend>
	        {if $user->defaultShippingAddress}
	        	{$user->defaultShippingAddress->addressOne}<br />
	            {if $user->defaultShippingAddress->addressTwo}
	            	{$user->defaultShippingAddress->addressTwo}<br />
	            {/if}
	        	{$user->defaultShippingAddress->city}, {$user->defaultShippingAddress->state} {$user->defaultShippingAddress->zip}
	        	{$user->defaultShippingAddress->country}<br />
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
		            	{$address->addressTwo}<br />
		            {/if}
		           {$address->city}, {$address->state} {$address->zip}
		           {$address->country}<br />
		            <a href='{$siteRoot}/account/editshipping?shippingAddressID={$address->shippingAddressID}'>Edit</a> | 
		            <a href='{$siteRoot}/account/deletshipping?shippingAddressID={$address->shippingAddressID}'>Delete</a> | 
		            <a href='{$siteRoot}/account/setdefaultshipping?shippingAddressID={$address->shippingAddressID}'>Make Default</a><br />
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