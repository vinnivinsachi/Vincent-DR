<?php /* Smarty version 2.6.19, created on 2010-08-26 17:54:48
         compiled from productdisplay/_orderAttribute/_basic.tpl */ ?>
 <table>
  <tr height="350px;">
  <td align="left">
     <label style="font-weight:bold; font-size:1.2em; margin-bottom:20px;"><?php echo $this->_tpl_vars['product']['name']; ?>
<br/><br/><span style='font-weight:normal; font-size:1em; '><?php echo $this->_tpl_vars['product']['product_tag']; ?>
</span></label>
     
  	 <div class='box' style='padding-top:10px;'>
  	 <label class='mid'>Color:</label>More available<br/></div>
  	 <div class='box' style='padding-top:10px;'>
  	 <label class='mid'>Size:</label>More available<br/></div>
  	 <div class='box' style='padding-top:10px;'>
  	 <label class='mid'>Brand:</label><?php echo $this->_tpl_vars['product']['brand']; ?>
</div>
  	 <div class='box' style='margin-top:10px;'>
     		<label class='mid'>Price:</label>
                 <?php if ($this->_tpl_vars['product']['discount_price'] == '' || $this->_tpl_vars['product']['discount_price'] == 0): ?>
                  <div class="discountBoxPrice">
                     $<?php echo $this->_tpl_vars['product']['price']; ?>

                  </div>
                 <?php elseif ($this->_tpl_vars['product']['discount_price'] > 0): ?>
                  <div class="productBoxPrice">
                      $<?php echo $this->_tpl_vars['product']['price']; ?>

                   </div>

               <div class="discountBoxPrice">
                $<?php echo $this->_tpl_vars['product']['discount_price']; ?>

               </div>
               <?php endif; ?>
       </div>         <br/>
  	 <div class='box marginTop30'>
  	 Please use the side panel to narrow down your search.
  	 </div>
  </td>
  </tr>
 </table>