 <table>
  <tr height="350px;">
  <td align="left">
     <label style="font-weight:bold; font-size:1.2em; margin-bottom:20px;">{$product.name}<br/><br/><span style='font-weight:normal; font-size:1em; '>{$product.product_tag}</span></label>
     
  	 <div class='box' style='padding-top:10px;'>
  	 <label class='mid'>Color:</label>More available<br/></div>
  	 <div class='box' style='padding-top:10px;'>
  	 <label class='mid'>Size:</label>More available<br/></div>
  	 <div class='box' style='padding-top:10px;'>
  	 <label class='mid'>Brand:</label>{$product.brand}</div>
  	 <div class='box' style='padding-top:10px;'>
  	 <label class='mid'>Seller:</label>{$product.uploader_username}</div>
  	 <div class='box' style='margin-top:10px;'>
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
       </div>         <br/>
  	 <div class='box marginTop30'>
  	 Please use the side panel to narrow down your search.
  	 </div>
  </td>
  </tr>
 </table>