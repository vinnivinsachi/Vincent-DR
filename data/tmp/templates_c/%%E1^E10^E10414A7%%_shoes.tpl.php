<?php /* Smarty version 2.6.19, created on 2010-08-25 19:16:44
         compiled from productdisplay/_productDetailsAttribute/_shoes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'removeunderscore', 'productdisplay/_productDetailsAttribute/_shoes.tpl', 24, false),array('modifier', 'count', 'productdisplay/_productDetailsAttribute/_shoes.tpl', 35, false),)), $this); ?>
<div class='productDetailTop' class='box'>
	<div class='titleBarMid'>Details </div>
	</div>
<div class='box' style='padding:10px; width:390px;'>
 <?php $_from = $this->_tpl_vars['product']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['profile']):
?>
     <?php if ($this->_tpl_vars['Key'] == 'sys_shoe_metric'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Size system: </label>
     	<?php echo $this->_tpl_vars['profile']; ?>
<br/>
     	</div>
     <?php elseif ($this->_tpl_vars['Key'] == 'sys_shoe_size'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Size: </label>
     	<?php echo $this->_tpl_vars['profile']; ?>
<br/>
     	</div>
     <?php elseif ($this->_tpl_vars['Key'] == 'sys_shoe_heel'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Heel:</label>
     	<?php echo $this->_tpl_vars['profile']; ?>
<br/>
     	</div>
     <?php elseif ($this->_tpl_vars['Key'] == 'sys_color'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Color:</label>
     	<?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['profile']), $this);?>
<br/>
     	</div>
     <?php elseif ($this->_tpl_vars['Key'] == 'sys_conditions'): ?>
      	<div class='box' style='padding-top:10px;'>
     	<label class='mid'>Conditions:</label>
     	<?php echo $this->_tpl_vars['profile']; ?>
<br/>
     	</div>
    
     <?php endif; ?>
 <?php endforeach; endif; unset($_from); ?>
 
 <?php if (count($this->_tpl_vars['product']['inventory']['profile']) > 0): ?>
 	<?php $_from = $this->_tpl_vars['product']['inventory']['profile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
     	<label class='mid'>Seller:</label>
     	<?php echo $this->_tpl_vars['product']['0']['uploader_username']; ?>
<br/>
     	</div>
     	
 <div class='box' style='padding-top:20px;'>
  <?php if ($this->_tpl_vars['product']['0']['discount_price'] == '' || $this->_tpl_vars['product']['0']['discount_price'] == 0): ?>
                  <div class="discountBoxPrice">
                     $<?php echo $this->_tpl_vars['product']['0']['price']; ?>

                  </div>
                 <?php elseif ($this->_tpl_vars['product']['discount_price'] > 0): ?>
                  <div class="productBoxPrice">
                      $<?php echo $this->_tpl_vars['product']['0']['price']; ?>

                   </div>

               <div class="discountBoxPrice">
                $<?php echo $this->_tpl_vars['product']['0']['discount_price']; ?>

               </div>
            <?php endif; ?>
 </div>

 </div>