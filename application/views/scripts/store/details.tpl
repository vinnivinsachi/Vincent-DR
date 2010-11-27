{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>
	
		<!-- Basic Info -->
	    <fieldset> 	
			<legend>{$store->storeDisplayName} Details</legend>
		    <table class='right-align-table'>
				<tr>
					<td>Store URL Name:</td>
					<td><b>{$store->storeName}</b></td>
				</tr>
				<tr>
					<td>Store Email:</td>
					<td><b>{$store->storeEmail}</b></td>
				</tr>
				<tr>
					<td>Store Phone:</td>
					<td><b>{$store->storePhone}</b></td>
				</tr>
				<tr>
					<td>Store Fax:</td>
					<td><b>{$store->storeFax}</b></td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td><a href='{$siteRoot}/store/editbasicinfo?storeName={$store->storeName}'>Edit</a></td>
				</tr>
			</table>
		</fieldset>
		
		 <!-- Addresses -->
	    <fieldset>
	        <legend>Default Shipping Address</legend>
	        {if $store->defaultShippingAddress}
	        	{$store->defaultShippingAddress->addressOne}<br />
	            {if $store->defaultShippingAddress->addressTwo}
	            	{$store->defaultShippingAddress->addressTwo}<br />
	            {/if}
	        	{$store->defaultShippingAddress->city}, {$store->defaultShippingAddress->state} {$store->defaultShippingAddress->zip}
	        	{$store->defaultShippingAddress->country}<br />
			{else}
	        	There is no Default Shipping Address
	        {/if}
	    </fieldset>
	    
	    <fieldset>
	     	<legend>All Shipping Addresses</legend>
	        {foreach from=$store->shippingAddresses item=address}
		        <div class="shippingAddressBox">
		            {$address->addressOne}<br />
		            {if $address->addressTwo}
		            	{$address->addressTwo}<br />
		            {/if}
		           {$address->city}, {$address->state} {$address->zip}
		           {$address->country}<br />
		            <a href='{$siteRoot}/store/editshipping?storeName={$store->storeName}&storeShippingAddressID={$address->shippingAddressID}'>Edit</a> | 
		            <a href='{$siteRoot}/store/deleteshipping?storeName={$store->storeName}&storeShippingAddressID={$address->shippingAddressID}' class='loading-image-link'>Delete</a> | 
		            <a href='{$siteRoot}/store/setdefaultshipping?storeName={$store->storeName}&storeShippingAddressID={$address->shippingAddressID}' class='loading-image-link'>Make Default</a><br />
		        </div>
		        <br />
	        {/foreach}
	        <div style="float:left; width:100%;"><a href='{$siteRoot}/store/editshipping?storeName={$store->storeName}&'>Add a shipping address</a></div>
	    </fieldset>
		
		
		<!-- Associated Users -->
		<fieldset> 	
			<legend>Users</legend>
		    <table>
				<tr>
					<th>Username</th>
					<th>Role</th>
				</tr>
				
				{foreach from=$store->userLinks item=link}
					<tr>
						<td style='text-align:center'><a href='{$siteRoot}/account/profile?username={$link->username}'>{$link->username}</a></td>
						<td style='text-align:center'>{$link->linkRole}</td>
					</tr>
				{/foreach}
				
			</table>
		</fieldset>  
	    
</div>

{include file="layouts/$layout/footer.tpl"}