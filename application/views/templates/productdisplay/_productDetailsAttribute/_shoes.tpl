<div class='productDetailTop' class='box'>
	<div class='titleBarMid'>Details </div>
	</div>
<div class='box' style='padding:10px; width:390px;'>
 {foreach from=$product.0 item=profile key=Key}
     {if $Key=='sys_shoe_metric'}
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Size system: </label>
     	{$profile}<br/>
     	</div>
     {elseif $Key=='sys_shoe_size'}
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Size: </label>
     	{$profile}<br/>
     	</div>
     {elseif $Key=='sys_shoe_heel'}
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Heel:</label>
     	{$profile}<br/>
     	</div>
     {elseif $Key=='sys_color'}
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Color:</label>
     	{removeunderscore phrase=$profile}<br/>
     	</div>
     {elseif $Key=='sys_conditions'}
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Conditions:</label>
     	{$profile}<br/>
     	</div>
    
     {/if}
 {/foreach}
 
 {if $product.inventory.profile|@count>0}
 	{foreach from=$product.inventory.profile item=inventoryProfile}
 	     	<div class='box' style='padding-top:10px;'>
 	
 		<label class='mid'>{removeunderscore phrase=$inventoryProfile.profile_key}:</label>
 		{removeunderscore phrase=$inventoryProfile.profile_value}<br/>
 		</div>
 	{/foreach}
 {/if}
 <div class='box' style='padding-top:10px;'>
     	<label class='mid'>Seller:</label>
     	{$product.0.uploader_username}<br/>
     	</div>
     	
 <div class='box' style='padding-top:20px;'>
  {if $product.0.discount_price=='' || $product.0.discount_price==0}
                  <div class="discountBoxPrice">
                     ${$product.0.price}
                  </div>
                 {elseif $product.discount_price>0}
                  <div class="productBoxPrice">
                      ${$product.0.price}
                   </div>

               <div class="discountBoxPrice">
                ${$product.0.discount_price}
               </div>
            {/if}
 </div>

 </div>
