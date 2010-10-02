<?php /* Smarty version 2.6.19, created on 2010-08-25 19:22:38
         compiled from productdisplay/_orderAttribute/_shoes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'productdisplay/_orderAttribute/_shoes.tpl', 27, false),array('modifier', 'count', 'productdisplay/_orderAttribute/_shoes.tpl', 43, false),)), $this); ?>
  <table>
  <tr height="350px;">
  <td align="left">
   <label style="font-weight:bold; font-size:1.2em; margin-bottom:20px; width:150px;"><?php echo $this->_tpl_vars['product']['name']; ?>
<br/><br/><span style='font-weight:normal; font-size:1em; '><?php echo $this->_tpl_vars['product']['product_tag']; ?>
</span></label>
  
					              
 		
 <?php $_from = $this->_tpl_vars['product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['profile']):
?>
     <?php if ($this->_tpl_vars['Key'] == 'sys_shoe_metric'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='small'>Size system: </label>
     	<?php echo $this->_tpl_vars['profile']; ?>
<br/>
     	</div>
     <?php elseif ($this->_tpl_vars['Key'] == 'sys_shoe_size'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='small'>Size: </label>
     	<?php echo $this->_tpl_vars['profile']; ?>
<br/>
     	</div>
     <?php elseif ($this->_tpl_vars['Key'] == 'sys_shoe_heel'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='small'>Heel:</label>
     	<?php echo $this->_tpl_vars['profile']; ?>
<br/>
     	</div>
     <?php elseif ($this->_tpl_vars['Key'] == 'sys_color'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='small'>Color:</label>
     	<?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['profile']), $this);?>
<br/>
     	</div>
     <?php elseif ($this->_tpl_vars['Key'] == 'sys_conditions'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='small'>Conditions:</label>
     	<?php echo $this->_tpl_vars['profile']; ?>
<br/>
     	</div>
     <?php endif; ?>
 <?php endforeach; endif; unset($_from); ?>
 <div class='box' style='padding-top:10px;'>
     	<label class='small'>Brand: </label>
     	<?php echo $this->_tpl_vars['product']['brand']; ?>
<br/>
     	</div>
 
 
 
 <?php if (count($this->_tpl_vars['product']['inventoryProfile']) > 0): ?>
 	<?php $_from = $this->_tpl_vars['product']['inventoryProfile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['inventoryProfile']):
?>
 	     	<div class='box' style='padding-top:10px;'>
 	
 		<label class='mid'><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['inventoryProfile']['profile_key']), $this);?>
:</label>
 		<?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['inventoryProfile']['profile_value']), $this);?>
<br/>
 		</div>
 	<?php endforeach; endif; unset($_from); ?>
 <?php endif; ?>
 <div class='box' style='padding-top:10px;'>
     	<label class='small'>Seller:</label>
     	<?php echo $this->_tpl_vars['product']['uploader_username']; ?>
<br/>
     	</div>
     	
  	     	<div class='box' style='padding-top:30px;'>
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
             		</div>
             		
            
 </td>
 </tr>
 </table>