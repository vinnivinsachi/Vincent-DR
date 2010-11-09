  <table>
  <tr height="350px;">
  <td align="left">
   <label style="font-weight:bold; font-size:1.2em; margin-bottom:20px;">{$product.name}<br/><span style='font-weight:normal; font-size:1em; '>{$product.product_tag}</span></label>
 {foreach from=$product item=profile key=Key}
     {if $Key=='sys_bottom_size'}
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Size: </label>
     	{$profile}<br/>
     	</div>
	{elseif $Key=='uploader_username'}
     	<div class='box' style='padding-top:10px;'>
     	<label class='small'>Seller:</label>
     	{$profile}<br/>
     	</div>
     {/if}
 {/foreach}
 
 {if $product.inventoryProfile|@count>0}
 	{foreach from=$product.inventoryProfile item=inventoryProfile}
 	     	<div class='box' style='padding-top:10px;'>
 	
 		<label class='mid'>{removeunderscore phrase=$inventoryProfile.profile_key}:</label>
 		{removeunderscore phrase=$inventoryProfile.profile_value}<br/>
 		</div>
 	{/foreach}
 {/if}

<div class='box' style='padding-top:30px;'>
 <label class='mid'>Price:</label>
  {if $product.discount_price=='' || $product.discount_price==0}
                  <div class="discountBoxPrice">
                     ${$product.price}
                  </div>
                 {elseif $product.discount_price>0}
                  <div class="productBoxPrice">
                      ${$product.price}
                   </div>

               <div class="discountBoxPrice">
                ${$product.discount_price}
               </div>
            {/if}
             		</div> 
 </td>
 </tr>
 </table>