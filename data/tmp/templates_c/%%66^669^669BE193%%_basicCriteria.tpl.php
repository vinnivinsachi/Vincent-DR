<?php /* Smarty version 2.6.19, created on 2010-08-22 18:26:48
         compiled from productdisplay/_searchCriteria/_basicCriteria.tpl */ ?>
 <div class='box' style="width:95%;">
 	<form id='searchCriteriaForm' action='/productdisplay/index' method="get">
 		<?php if (isset ( $this->_tpl_vars['tag'] )): ?>
 		<input type='hidden' name='tag' value='<?php echo $this->_tpl_vars['tag']; ?>
'/>
 		<?php endif; ?>
 		<?php if (isset ( $this->_tpl_vars['purchaseType'] )): ?>
 		<input type='hidden' name='purchaseType' value='<?php echo $this->_tpl_vars['purchaseType']; ?>
'/>
 		<?php endif; ?>
    	<div class='titleBarBig marginTop20' style='margin-bottom:0px;'>Search criteria</div>
    	<?php if ($this->_tpl_vars['searchCriteria'] != ''): ?>
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "productdisplay/_searchCriteria/".($this->_tpl_vars['searchCriteria']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    	<?php endif; ?>
    	<div class='fullTitleBarMid box marginTop20'>Color:</div>
    	
    	<div class='box'>
    		<div class='box' style='width:33%'>
    		<input class='searchInput' type='checkbox' name='color[Black]' value='1' <?php if ($this->_tpl_vars['color']['Black'] == 1): ?>checked='checked'<?php endif; ?>/>Black</div>
    		<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Brown]' value='1' <?php if ($this->_tpl_vars['color']['Brown'] == 1): ?>checked='checked'<?php endif; ?>>Brown</div>
        	<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Yellow]' value='1' <?php if ($this->_tpl_vars['color']['Yellow'] == 1): ?>checked='checked'<?php endif; ?>>Yellow</div>
        	<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Green]' value='1' <?php if ($this->_tpl_vars['color']['Green'] == 1): ?>checked='checked'<?php endif; ?>>Green</div>
        	<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Pink]' value='1' <?php if ($this->_tpl_vars['color']['Pink'] == 1): ?>checked='checked'<?php endif; ?>>Pink</div>
        	<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Red]' value='1' <?php if ($this->_tpl_vars['color']['Red'] == 1): ?>checked='checked'<?php endif; ?>>Red</div>
        	<div class='box' style='width:40%'>
        	<input class='searchInput' type='checkbox' name='color[Pin_stripe]' value='1' <?php if ($this->_tpl_vars['color']['Pin_stripe'] == 1): ?>checked='checked'<?php endif; ?>>Pin stripe</div>
    	</div>
    	<div class='fullTitleBarMid box marginTop20'>Condition:</div>
    	<div class='box'>
    		<div class='box' style='width:25%'>
    		<input type='checkbox' name='condition[New]' value=New <?php if ($this->_tpl_vars['condition']['New'] == 'New'): ?>checked=checked<?php endif; ?>/>New</div>
    		<div class='box' style='width:41%'><input type='checkbox' name='condition[Like_new]' value='Like new' <?php if ($this->_tpl_vars['condition']['Like_new'] == 'Like new'): ?>checked=checked<?php endif; ?>/>Like new</div>
    		<div class='box' style='width:33%'>
    		<input type='checkbox' name='condition[Good]' value='Good' <?php if ($this->_tpl_vars['condition']['Good'] == 'Good'): ?>checked=checked<?php endif; ?>/>Good</div>
    	</div>
    	
    	<div class='fullTitleBarMid box marginTop20'>Price:</div>
    	<div class='box'>
			<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_1]' value=1 <?php if ($this->_tpl_vars['pricecat']['price_category_1'] == 1): ?>checked="checked"<?php endif; ?>/>< $100</div>
			<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_2]' value=1 <?php if ($this->_tpl_vars['pricecat']['price_category_2'] == 1): ?>checked="checked"<?php endif; ?>/>$100 - $200</div>
    		<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_3]' value=1 <?php if ($this->_tpl_vars['pricecat']['price_category_3'] == 1): ?>checked="checked"<?php endif; ?>/>$200 - $500</div>
  			<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_4]' value=1 <?php if ($this->_tpl_vars['pricecat']['price_category_4'] == 1): ?>checked="checked"<?php endif; ?>/>$500 - $1000</div>
    		<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_5]' value=1 <?php if ($this->_tpl_vars['pricecat']['price_category_5'] == 1): ?>checked="checked"<?php endif; ?>/>$1000-$5000</div>
		</div>
		<button>Submit</button>
	</form>
 </div>
 

 <?php echo '
 <script type="text/javascript"><!--
 	var formElements = $(\'searchCriteriaForm\').getElementsByTagName(\'input\');
 	//alert(\'here\');
 	var nodes = $A(formElements);
 	var timer = 0;
 	nodes.each(function(node){
			node.observe(\'change\', function(){addTime(2000);});
 	 	}
 	);


	function addTime(sum){
		if(timer==0){
			timer+=sum;
			setTimeout("submitSearchCriteria(\'searchCriteriaForm\')", timer);
		 	//submitSearchCriteria(\'searchCriteriaForm\');
		}
	}
 	//submitSearchCriteria(\'searchCriteriaForm\')

 	function submitSearchCriteria(formID){
 		var form = $(formID);

 		/*var options={
 				parameters: form.serialize(true),
 				method: form.method,
 				onLoaded: showloadingImage(), 
 				onSuccess: function(transport){
 							hideloadingImage();
 							timer=0;
 							
 				}
 			};*/

 		//alert(\'here\');
 		showloadingImage();
 		form.submit();
 		//new Ajax.Request(form.action, options);
 	}

 --></script>
 '; ?>