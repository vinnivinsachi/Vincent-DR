<?php /* Smarty version 2.6.19, created on 2010-08-14 20:54:41
         compiled from productlisting/viewpendingproduct.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/viewpendingproduct.tpl', 7, false),array('function', 'removeunderscore', 'productlisting/viewpendingproduct.tpl', 120, false),array('modifier', 'count', 'productlisting/viewpendingproduct.tpl', 11, false),array('modifier', 'date_format', 'productlisting/viewpendingproduct.tpl', 121, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="leftContainer" style="width:190px; float:left;">
    
        	<div class='titleBarBig'>My listing categories</div>
        	
           	<ul id="qm0" class="qmmc" >
				<li><a href="<?php echo smarty_function_geturl(array('action' => 'viewpendingproduct'), $this);?>
?tag=all" style='font-size:1.2em;'>ALL LISTINGS</a></li>
				
				<?php $_from = $this->_tpl_vars['menuBars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['menubar']):
?>
                		<?php if ($this->_tpl_vars['Key'] == 'JEWELRY' || $this->_tpl_vars['Key'] == 'ACCESSORIES'): ?>
                			<?php if (count($this->_tpl_vars['menubar']) > 0): ?>
		                	    <li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'><?php echo $this->_tpl_vars['Key']; ?>
</a>
		                			<ul>
		                			<?php $_from = $this->_tpl_vars['menubar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ItemSetOne']):
?>
		                				<li><a href="<?php echo smarty_function_geturl(array('action' => 'viewpendingproduct'), $this);?>
?tag=<?php echo $this->_tpl_vars['ItemSetOne']; ?>
"><?php echo $this->_tpl_vars['ItemSetOne']; ?>
</a></li>
		                			<?php endforeach; endif; unset($_from); ?>
		                			</ul></li>
		                	<?php endif; ?>
                		<?php elseif ($this->_tpl_vars['Key'] == 'MEN'): ?>
                			<?php if (count($this->_tpl_vars['menubar']) > 0): ?>
		                		<li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'><?php echo $this->_tpl_vars['Key']; ?>
</a>
		                		    <ul>
		                			<?php $_from = $this->_tpl_vars['menubar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KeyTwo'] => $this->_tpl_vars['ItemSetTwo']):
?>
		                				<?php if ($this->_tpl_vars['KeyTwo'] == 'Shirts' || $this->_tpl_vars['KeyTwo'] == 'Pants' || $this->_tpl_vars['KeyTwo'] == 'Vests' || $this->_tpl_vars['KeyTwo'] == 'Jackets'): ?>
		                					<li><a href="<?php echo smarty_function_geturl(array('action' => 'viewpendingproduct'), $this);?>
?tag=<?php echo $this->_tpl_vars['ItemSetTwo']; ?>
"><?php echo $this->_tpl_vars['ItemSetTwo']; ?>
</a></li>
		                				<?php else: ?>
		                	    			<li><a class="qmparent" href="javascript:void(0)"><?php echo $this->_tpl_vars['KeyTwo']; ?>
</a>
		                	    				<ul>
		                					<?php $_from = $this->_tpl_vars['ItemSetTwo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ItemSetThree']):
?>
		                						<li><a href="<?php echo smarty_function_geturl(array('action' => 'viewpendingproduct'), $this);?>
?tag=<?php echo $this->_tpl_vars['ItemSetThree']; ?>
"><?php echo $this->_tpl_vars['ItemSetThree']; ?>
</a></li>
		                					<?php endforeach; endif; unset($_from); ?>
		                						</ul>
		                					</li>
		                				<?php endif; ?>
		                			<?php endforeach; endif; unset($_from); ?>
		                			</ul></li>
		                	<?php endif; ?>
                		<?php elseif ($this->_tpl_vars['Key'] == 'WOMEN'): ?>
                			<?php if (count($this->_tpl_vars['menubar']) > 0): ?>
								<li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'><?php echo $this->_tpl_vars['Key']; ?>
</a>
							         <ul>
	                			<?php $_from = $this->_tpl_vars['menubar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KeyTwo'] => $this->_tpl_vars['ItemSetTwo']):
?>
	                				<?php if ($this->_tpl_vars['KeyTwo'] == 'Ladies tops'): ?>
	                					<li><a href="<?php echo smarty_function_geturl(array('action' => 'viewpendingproduct'), $this);?>
?tag=<?php echo $this->_tpl_vars['ItemSetTwo']; ?>
"><?php echo $this->_tpl_vars['ItemSetTwo']; ?>
</a></li>
	                				<?php else: ?>
	                	    			<li><a class="qmparent" href="javascript:void(0)"><?php echo $this->_tpl_vars['KeyTwo']; ?>
</a>
	                	    				<ul>
	                					<?php $_from = $this->_tpl_vars['ItemSetTwo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ItemSetThree']):
?>
	                						<li><a href="<?php echo smarty_function_geturl(array('action' => 'viewpendingproduct'), $this);?>
?tag=<?php echo $this->_tpl_vars['ItemSetThree']; ?>
"><?php echo $this->_tpl_vars['ItemSetThree']; ?>
</a></li>
	                					<?php endforeach; endif; unset($_from); ?>
	                						</ul>
	                					</li>
	                				<?php endif; ?>
	                			<?php endforeach; endif; unset($_from); ?>
	                			      </ul>
	                			</li>
	                		<?php endif; ?>
                		<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
               	<li><a href="<?php echo smarty_function_geturl(array('action' => 'viewpendingproduct'), $this);?>
?status=removed" style='font-size:1.2em;'>REMOVED</a></li>
           </ul>
        
<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>

    
    </div>

<div id="rightContainer" style='width:790px; float:right;'>

        <div class='titleBarBig'>My listings<span style='float:right; font-weight:normal;'><a href="#" style='padding-right:5px;'>Help</a></span></div>
                <?php if (count($this->_tpl_vars['productList']) > 0): ?>
        
    	<table width="100%" id="productListTable">
            	<tr class='trTitle'>
                	<td>Name</td>
                    <td>Price</td><!--
                    <td>RP</td>
                    --><td>Category</td>
                   <td>
                    	<select id="productBrandJavascript">
                    	    <option value="All">Brand</option>
                        	<option value="All">All</option>
                        	<?php $_from = $this->_tpl_vars['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['brand']):
?>
                            <option value='<?php echo $this->_tpl_vars['brand']['brand']; ?>
'><?php echo $this->_tpl_vars['brand']['brand']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select></td>
                     <td>
                     	<select id="productStatusJavascript">
                     	    <option value="All">Status</option>
                        	<option value="All">All</option>
                        	<option value="Unlisted">Unlisted</option>
                            <option value="Listed">Listed</option>
                        </select></td>
                     <td>
                     	<select id="productTypeJavascript">
                    	    <option value="All">Type</option>
                        	<option value="All">All</option>
                        	<option value="Customizable">Customizable</option>
                            <option value="Buy_now">Buy now</option>
                        </select></td>
                    <td>Created</td>
                    
                    <td style='width:111px;'>Actions</td>
    	<?php $_from = $this->_tpl_vars['productList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
    		
        		<tr class="<?php echo $this->_tpl_vars['product']['product_type']; ?>
 <?php echo $this->_tpl_vars['product']['brand']; ?>
 <?php echo $this->_tpl_vars['product']['status']; ?>
 <?php echo $this->_tpl_vars['product']['purchase_type']; ?>
 itemRow" style='border-bottom: 2px solid white;'>
                	<td><?php if ($this->_tpl_vars['product']['purchase_type'] == 'Customizable'): ?>
 <a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'editcustomproduct'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product']['purchase_type']; ?>
&category=<?php echo $this->_tpl_vars['product']['product_category']; ?>
&type=<?php echo $this->_tpl_vars['product']['product_type']; ?>
&tag=<?php echo $this->_tpl_vars['product']['product_tag']; ?>
&id=<?php echo $this->_tpl_vars['product']['product_id']; ?>
"><?php echo $this->_tpl_vars['product']['name']; ?>
</a>
 						<?php elseif ($this->_tpl_vars['product']['purchase_type'] == 'Buy_now'): ?>
 						 <a href="<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'editbuynowproduct'), $this);?>
?purchase_type=<?php echo $this->_tpl_vars['product']['purchase_type']; ?>
&category=<?php echo $this->_tpl_vars['product']['product_category']; ?>
&type=<?php echo $this->_tpl_vars['product']['product_type']; ?>
&tag=<?php echo $this->_tpl_vars['product']['product_tag']; ?>
&id=<?php echo $this->_tpl_vars['product']['product_id']; ?>
"><?php echo $this->_tpl_vars['product']['name']; ?>
</a>
 						<?php endif; ?>
                	</td>
                    <td>$<?php echo $this->_tpl_vars['product']['price']; ?>
</td><!--
                    <td><?php echo $this->_tpl_vars['product']['reward_point']; ?>
</td>
                    --><td><?php echo $this->_tpl_vars['product']['product_tag']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['product']['brand']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['product']['status']; ?>
</td>
             		<td><?php echo smarty_function_removeunderscore(array('phrase' => $this->_tpl_vars['product']['purchase_type']), $this);?>
</td>
             		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['ts_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</td>
					<td>
                		<?php $this->assign('status', $this->_tpl_vars['product']['status']); ?>
                    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "productlisting/_actions/_".($this->_tpl_vars['status']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </td>
               	</tr>
                
        <?php endforeach; endif; unset($_from); ?>
        </table>
        <?php else: ?>
        There are no products here. 
        <?php endif; ?>
	</div>
    
    <?php echo '
		<script src="/public/resources/javascripts/inventorySelector/inventorySelector.js" type="text/javascript"></script>
        <script type="text/javascript">
			new productListing(\'productListTable\');
		</script>
    '; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>