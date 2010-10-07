{$user->first_name}, ORDER notice

Dear {$user->last_name},


Order from: 

{$member->first_name} {$member->last_name} 
{$member->address}
{$member->city}
{$member->state}
{$member->zip}
{$member->email}

Car available: 				{$member->car}
Boombox available: 			{$member->boombox}
Ethnicity: 					{$member->ethnicity}
How did you hear about us? 	{$member->hear_about_us}
School: 					{$member->school}


^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Date:{$dateTime}
invoice ID: {$invoice}

Check your order status at: 
http://www.visachidesign.com/guestorder?ID={$invoice}&orderType=buyer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


			
{foreach from=$productsProfile item=profile}	
-----------------------------------------------------------------------------
{$profile->product_name}
{if $profile->orderAttribute->size != ''}
size: {$profile->orderAttribute->size}
{/if}
quantity: {$profile->quantity}
unit cost:	{$profile->unit_cost}
-----------------------------------------------------------------------------
{/foreach}

			
************
Total:
$ {$finalTotal}
************

	
Sincerely,

Ballroom-exec Administrator

