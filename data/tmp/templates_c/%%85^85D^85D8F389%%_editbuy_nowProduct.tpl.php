<?php /* Smarty version 2.6.19, created on 2010-08-14 20:14:29
         compiled from productlisting/_editbuy_nowProduct.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/_editbuy_nowProduct.tpl', 9, false),array('function', 'wysiwyg', 'productlisting/_editbuy_nowProduct.tpl', 73, false),array('modifier', 'count', 'productlisting/_editbuy_nowProduct.tpl', 161, false),)), $this); ?>
	<div id="leftContainer" style="width:100%;">
    	
    	<div class='titleBarBig'>Step 1: &nbsp;&nbsp;&nbsp;List a product - <?php echo $this->_tpl_vars['fp']->product_tag; ?>
  <?php if ($this->_tpl_vars['fp']->product_id != '' && $this->_tpl_vars['fp']->product_id != 0): ?>
        
    <?php endif; ?>
    	</div>
    	<div class='formContent'>
   
    	<form id="generalDetailForm" enctype="multipart/form-data" method="post" action="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'editbuynowproduct'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['fp']->purchase_type; ?>
&category=<?php echo $this->_tpl_vars['fp']->product_category; ?>
&type=<?php echo $this->_tpl_vars['fp']->product_type; ?>
&tag=<?php echo $this->_tpl_vars['fp']->product_tag; ?>
&id=<?php echo $this->_tpl_vars['fp']->product_id; ?>
">
	    	<div class='formLeftDivision'>
	    	<div class='box' >
					<div class='titleBarMid'><strong>Basic information</strong></div>
				</div>
		        <label>Name:</label>
		        <input type="text" value="<?php echo $this->_tpl_vars['fp']->name; ?>
" name="name" class='inputShiftOne'/><br>
		    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('name'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				
				<label>Brand:</label>
		        <select name="brand" class='inputShiftOne'>
		       		<option value="Supadance">Supadance</option>
		            <option value="International">International</option>
		            <option value="Rayrose">Rayrose</option>
		            <option value="DN">DanceNaturals</option>
		            <option value="STP">StephanieProfessional</option>
		            <option value="BDdance">BDdance</option>
		            <option value="SDUSA">SoulDancer</option>
		            <option value="Chrissane">Chrissane</option>
		            <option value="Other">Other</option>
		        </select><br>
		        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('brand'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				
				
				<div>
		        	<label style="height:30px;">Product use:</label>
		        	<input type="checkbox" name="social_usage" <?php if ($this->_tpl_vars['fp']->social_usage == 'on'): ?>checked=checked<?php endif; ?> class='inputShiftOne'/>Social/practice<br/>
		        	<input type="checkbox" name="competition_usage" <?php if ($this->_tpl_vars['fp']->competition_usage == 'on'): ?>checked=checked<?php endif; ?> class='inputShiftOne'/>Competition<br/>
				</div>
		
				<div>
		        <label>Price:</label>
		        $<input type="text" value="<?php echo $this->_tpl_vars['fp']->price; ?>
" name="price"><br>
		        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('price'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
		        
		        <div>
		        <label>Domestic shipping:</label>
		        $<input type="text" value="<?php echo $this->_tpl_vars['fp']->domestic_shipping_rate; ?>
" name="domesticShippingRate" /><br />
		        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('domesticShippingRate'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		        </div>
		        <div>
		        <label>International shipping:</label>
		        $<input type="text" value="<?php echo $this->_tpl_vars['fp']->international_shipping_rate; ?>
" name="internationalShippingRate" /><br />
		        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('internationalShippingRate'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		        </div>
		        <input type='hidden' name="backorder_time" value='NA'/>
		        
		        <div style='margin: 5px 0px 10px 0px; width:100%;'>
				<label>Returnable:</label>
				<input type="radio" name='return' value='1' checked="checked" class='inputShiftOne'/>yes
				<input type="radio" name='return' value='0' <?php if ($this->_tpl_vars['fp']->return_allowed == '0'): ?>checked="checked"<?php endif; ?>/>no
				</div>
				
		        <label>Youtube video (optional):</label>
		        <input type='text' value="<?php echo $this->_tpl_vars['fp']->video_youtube; ?>
" name="video_youtube" class='inputShiftOne'/><br />
		        <br/>
	        </div>
        
	        <div class='formRightDivision'>
		        <div style='margin-bottom:10px;'>
		        <div class='box' >
					<div class='fullTitleBarMid'><strong>Description</strong></div>
				</div>
		        <?php echo smarty_function_wysiwyg(array('name' => 'description','value' => $this->_tpl_vars['fp']->description), $this);?>

				</div>
		        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['fp']->product_id; ?>
" />
		        <input type="hidden" name="product" value="<?php echo $this->_tpl_vars['fp']->product_type; ?>
" />
		        <input type="hidden" name="tag" value="<?php echo $this->_tpl_vars['fp']->product_tag; ?>
" />
		        
		        <div class='box marginTop20'>
					<div class='fullTitleBarMid'><strong>Upload sample image</strong></div>
		        <div id="imageBlock" >
		        	<div id="image_0" class="imageInput">
			        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[0]" />
						<a onclick='this.up().remove();' style='float:right; padding-right:10px;'>Delete</a>
					</div>
				</div>
				</div>
				
				<button type='button' id='addAnotherImage' onclick='addNewImageBlock()'>Add another image</button>
				
				<br/>
			</div>
			
        
        <!-- Listing details (One inventory) -->
        
        <div id='addInventoryFormMainDiv' style="padding-bottom:10px; float:left; width:100%;"> 
		<div class='titleBarBig marginTop20'>Step 2:  &nbsp;&nbsp;&nbsp;Edit listing details - 
		
		</div>
			<div class="manageInventoryMainDiv" >
		
			<div class='formLeftDivision'>
		
			<div class='titleBarMid'><strong>Search criteria</strong></div>
		
			<input type='hidden' name="inventory[sys_name]'"value='<?php echo $this->_tpl_vars['fp']->name; ?>
' class='inputShiftOne'/>
			
			<div class="systemColorSelection" >
	        	<label>Color:</label>
				<select name='inventory[sys_color]' class='inputShiftOne'>
					<option value='Black' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Black'): ?>selected="selected"<?php endif; ?>>Black</option>
					<option value='Pin_stripe' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Pin_stripe'): ?>selected="selected"<?php endif; ?>>Pin stripe</option>
					<option value='Light_tan' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Light_tan'): ?>selected="selected"<?php endif; ?>>Light tan</option>
					<option value='Dark_tan' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Dark_tan'): ?>selected="selected"<?php endif; ?>>Dark tan</option>
					<option value='Brown' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Brown'): ?>selected="selected"<?php endif; ?>>Brown</option>
					<option value='Silver' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Silver'): ?>selected="selected"<?php endif; ?>>Silver</option>
					<option value='Gold' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Gold'): ?>selected="selected"<?php endif; ?>>Gold</option>
					<option value='Gray' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Gray'): ?>selected="selected"<?php endif; ?>>Gary</option>
					<option value='White' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'White'): ?>selected="selected"<?php endif; ?>>White</option>
					<option value='Red' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Red'): ?>selected="selected"<?php endif; ?>>Red</option>
					<option value='Pink' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Pink'): ?>selected="selected"<?php endif; ?>>Pink</option>
					<option value='Orange' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Orange'): ?>selected="selected"<?php endif; ?>>Orange</option>
					<option value='Yellow' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Yellow'): ?>selected="selected"<?php endif; ?>>Yellow</option>
					<option value='Green' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Green'): ?>selected="selected"<?php endif; ?>>Green</option>
					<option value='Cyan' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Cyan'): ?>selected="selected"<?php endif; ?>>Cyan</option>
					<option value='Blue' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Blue'): ?>selected="selected"<?php endif; ?>>Blue</option>
					<option value='Magenta' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Magenta'): ?>selected="selected"<?php endif; ?>>Magenta</option>
					<option value='Purple' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Purple'): ?>selected="selected"<?php endif; ?>>Purple</option>
				</select>
			</div>
			
			<div class="systemInventoryConditions">
				<label>Condition:</label>
				<select name='inventory[sys_conditions]' class='inputShiftOne'>
					<option value='New' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'New'): ?>selected="selected"<?php endif; ?>>New</option>
					<option value='Like new' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'Like new'): ?>selected="selected"<?php endif; ?>>Like new</option>
					<option value='good' <?php if ($this->_tpl_vars['inventory']['basic']['sys_color'] == 'good'): ?>selected="selected"<?php endif; ?>>Good</option>
				</select>
			</div>
			
			
			<input type="hidden" value="<?php echo $this->_tpl_vars['fp']->price; ?>
" name="inventory[sys_price]"/>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "productlisting/_attributes/".($this->_tpl_vars['attributePartial']), 'smarty_include_vars' => array('colorsAndShoesAttributes' => $this->_tpl_vars['product']['systemColorAndShoesAttributes'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</div>
	
		</div>
		</div>
		
		<div class='box marginTop20'>
				<input type='submit' name='save' value='Save and list this item >' onclick=showloadingImage() class='largeSubmit'/>
			</div>
        </form>
        </div>
        
        <div class='box'>
			<div class='fullTitleBarMid'><strong>Product images</strong></div>
			<div class='boxContent'>
			<?php if (count($this->_tpl_vars['fp']->product->images) > 0): ?>
	            <ul id="post_images">
	                <?php $_from = $this->_tpl_vars['fp']->product->images; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
	                    <li >
	                        <img src="/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['signedInUser']->generalInfo->username; ?>
/<?php echo $this->_tpl_vars['fp']->product->product_tag; ?>
/<?php echo $this->_tpl_vars['image']['image_id']; ?>
.W150_homeFrontFour.jpg" alt="<?php echo $this->_tpl_vars['image']['filename']; ?>
" />
	                        
	                        <form id='imageForm' method="post" action="<?php echo smarty_function_geturl(array('action' => 'images'), $this);?>
">
	                            <div>
	                                <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['fp']->product->getId(); ?>
" />
	                                <input type="hidden" name="tag" value="<?php echo $this->_tpl_vars['fp']->product->product_tag; ?>
" />
	                                <input type="hidden" name='image_type' value="product_images" />
	                                <input type="hidden" name="image" value="<?php echo $this->_tpl_vars['image']['image_id']; ?>
" />
	                                <input type='submit' name='delete' value='delete' onclick=showloadingImage() />
	                            </div>
	                        </form>
	                    </li>
	                <?php endforeach; endif; unset($_from); ?>
	            </ul>
	        <?php endif; ?>
	        </div>
        </div>
        
        
        
        
	</div>