<?php /* Smarty version 2.6.19, created on 2010-08-15 04:52:03
         compiled from productlisting/editcustomproduct.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/editcustomproduct.tpl', 4, false),array('function', 'wysiwyg', 'productlisting/editcustomproduct.tpl', 89, false),array('modifier', 'count', 'productlisting/editcustomproduct.tpl', 119, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div id="leftContainer" style="width:100%;">
    	<div class='titleBarBig'><?php echo $this->_tpl_vars['fp']->product_tag; ?>
 details <?php if ($this->_tpl_vars['fp']->product_id != '' && $this->_tpl_vars['fp']->product_id != 0): ?>
       	<span style='float:right; font-weight:normal;'><a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'editproductattribute'), $this);?>
?id=<?php echo $this->_tpl_vars['fp']->product_id; ?>
" style='margin-right:20px;'>Edit product attribute ></a>
        <a href="<?php echo smarty_function_geturl(array('controller' => 'manageinventory','action' => 'addinventory'), $this);?>
?id=<?php echo $this->_tpl_vars['fp']->product_id; ?>
">Manage product inventory ></a></span>
    	<?php endif; ?>
    	</div>
       	<div class='formContent'>
   
    	<form id="generalDetailForm" enctype="multipart/form-data" method="post" action="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'editcustomproduct'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['fp']->purchase_type; ?>
&category=<?php echo $this->_tpl_vars['fp']->product_category; ?>
&type=<?php echo $this->_tpl_vars['fp']->product_type; ?>
&tag=<?php echo $this->_tpl_vars['fp']->product_tag; ?>
&id=<?php echo $this->_tpl_vars['fp']->product_id; ?>
">
	    	<div class='formLeftDivision'>
	    		<div class='box' >
					<div class='titleBarMid'><strong>Basic info</strong></div>
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
		        <label>Sale price (optional):</label>
		        $<input type="text" value="<?php echo $this->_tpl_vars['fp']->sales_price; ?>
" name="sales_price" /><br />
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
		        <div>
		        <label><a class='guide' title='The time it takes to deliver the product, if it is not in stock.'>Backorder time:</a></label>
		        <select name="backorder_time" class='inputShiftOne'>
		        	<option value="NA" <?php if ($this->_tpl_vars['fp']->backorder_time == 'NA'): ?>selected =selected<?php endif; ?>>NA</option>
		        	<option value="1 week" <?php if ($this->_tpl_vars['fp']->backorder_time == '1 week'): ?>selected=selected<?php endif; ?>>1 week</option>
		            <option value="2 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '2 weeks'): ?>selected=selected<?php endif; ?>>2 weeks</option>
		            <option value="3 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '3 weeks'): ?>selected=selected<?php endif; ?>>3 weeks</option>
		            <option value="4 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '4 weeks'): ?>selected=selected<?php endif; ?>>4 weeks</option>
		            <option value="5 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '5 weeks'): ?>selected=selected<?php endif; ?>>5 weeks</option>
		            <option value="6 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '6 weeks'): ?>selected=selected<?php endif; ?>>6 weeks</option>
		            <option value="7 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '7 weeks'): ?>selected=selected<?php endif; ?>>7 weeks</option>
		            <option value="8 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '8 weeks'): ?>selected=selected<?php endif; ?>>8 weeks</option>
		        </select></div>
		        
		        <div style='margin: 5px 0px 10px 0px; width:100%;'>
				<label>Returnable:</label>
				<input type="radio" name='return' value='1' checked="checked" class='inputShiftOne'/>yes
				<input type="radio" name='return' value='0' <?php if ($this->_tpl_vars['fp']->return_allowed == '0'): ?>checked="checked"<?php endif; ?>/>no
				</div>
				
		        <label>Youtube Video (optional):</label>
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
			<div class='box marginTop20'>
				<input type='submit' name='save' value='Save and proceed to product attributes >' onclick=showloadingImage() class='largeSubmit'/>
			</div>
        </form>
        </div>
        
        <div class='box'>
			<div class='fullTitleBarMid'><strong>Product sample images</strong></div>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>