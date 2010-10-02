<?php /* Smarty version 2.6.19, created on 2010-06-16 14:39:40
         compiled from productlisting/form/products.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/form/products.tpl', 1, false),array('function', 'wysiwyg', 'productlisting/form/products.tpl', 55, false),)), $this); ?>
<form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'editproduct'), $this);?>
">
	<fieldset>
    	<legend><?php echo $this->_tpl_vars['fp']->product_tag; ?>
 Details</legend>
        <label>Name:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->name; ?>
" name="name"><br>
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('name'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<div>
        <label>price:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->price; ?>
" name="price"><br>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('price'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
        <div>
        <label>discount price (optional):</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->discount_price; ?>
" name="discount_price" /><br />
        </div>
        <div>
        <label>Shipping rate:</label>
        <input type="text" value="<?php echo $this->_tpl_vars['fp']->shipping_rate; ?>
" name="shippingRate" /><br />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('shippingRate'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
        <div>
        <label>backorder time(this keeps track of latest shipping date)</label>
        <select name="backorder_time">
        	<option value="1 week" <?php if ($this->_tpl_vars['fp']->backorder_time == '1 week'): ?>selected=selected<?php endif; ?>>1 week</option>
            <option value="2 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '2 weeks'): ?>selected=selected<?php endif; ?>>2 weeks</option>
            <option value="3 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '3 weeks'): ?>selected=selected<?php endif; ?>>3 weeks</option>
            <option value="4 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '4 weeks'): ?>selected=selected<?php endif; ?>>4 weeks</option>
            <option value="5 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '5 weeks'): ?>selected=selected<?php endif; ?>>5 weeks</option>
            <option value="6 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '6 weeks'): ?>selected=selected<?php endif; ?>>6 weeks</option>
            <option value="7 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '7 weeks'): ?>selected=selected<?php endif; ?>>7 weeks</option>
            <option value="8 weeks" <?php if ($this->_tpl_vars['fp']->backorder_time == '8 weeks'): ?>selected=selected<?php endif; ?>>8 weeks</option>
        </select></div><br />
        
        <label>brand:</label>
        <select name="brand">
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
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('brand'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	
		
        <label>Youtube Video:</label>
        <input name="video_youtube" value="<?php echo $this->_tpl_vars['fp']->video_youtube; ?>
" name="video_youtube" /><br />
        
        <label>Description:</label><br>
        <?php echo smarty_function_wysiwyg(array('name' => 'description','value' => $this->_tpl_vars['fp']->description), $this);?>


        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['fp']->product_id; ?>
" />
        <input type="hidden" name="product" value="<?php echo $this->_tpl_vars['fp']->product_type; ?>
" />
        <input type="hidden" name="tag" value="<?php echo $this->_tpl_vars['fp']->product_tag; ?>
" />
        <input type="submit" value="proceed">
        <a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
">Back</a>
    </fieldset>
</form>