<?php /* Smarty version 2.6.19, created on 2010-07-21 18:09:45
         compiled from manageattribute/uploadattribute.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'manageattribute/uploadattribute.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<br/>
	Name of attribute: <?php echo $this->_tpl_vars['attribute']['name']; ?>
<br/>
	<div>
		<form method='post' action="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'uploadattribute'), $this);?>
?actioncall=3&paramSet=<?php echo $this->_tpl_vars['attribute']['table']; ?>
">
			<!--<a href="<?php echo smarty_function_geturl(array('controller' => 'manageattribute','action' => 'uploadattribute'), $this);?>
?actioncall=3&paramSet=<?php echo $this->_tpl_vars['attribute']['table']; ?>
&id=<?php echo $this->_tpl_vars['detail']['id']; ?>
">delete</a>-->
			<?php $_from = $this->_tpl_vars['attribute']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['detail']):
?>
			<input type="checkbox" name='image_id[<?php echo $this->_tpl_vars['detail']['id']; ?>
]' value='<?php echo $this->_tpl_vars['detail']['id']; ?>
' />
			<?php echo $this->_tpl_vars['detail']['details_name']; ?>
 / <?php echo $this->_tpl_vars['detail']['price_offset']; ?>
 
				<?php if ($this->_tpl_vars['detail']['filename'] != NULL): ?>
					<img src='/public/resources/userdata/tmp/thumbnails/<?php echo $this->_tpl_vars['detail']['username']; ?>
/<?php echo $this->_tpl_vars['attribute']['attributeTable']; ?>
/<?php echo $this->_tpl_vars['attribute']['name']; ?>
/<?php echo $this->_tpl_vars['detail']['id']; ?>
.W30_miniDetailImage.jpg'>
				<?php endif; ?>
				<br/>
			<?php endforeach; endif; unset($_from); ?>
			<button onclick="showloadingImage()">Delete selected color/fabric(s)</button>
		</form>
	</div>
	
	<div>
		<div id="customAttributeSetsCreationMainDiv">
	
		</div>
		<div id='createNewAttributeDivControls'>
			Name of new color/fabric set: <input type="text" value='<?php echo $this->_tpl_vars['attribute']['name']; ?>
' id='newAttributeSetNameInputID' style='display:none';/><button type='button' onclick="createNewAttributeSet('newAttributeSetNameInputID', 'customAttributeSetsCreationMainDiv', 'createNewAttributeDivControls', '2', '<?php echo $this->_tpl_vars['attribute']['table']; ?>
','<?php echo $this->_tpl_vars['attribute']['id']; ?>
')">Add more colors to this color/fabric set</button>
		</div>
	</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>