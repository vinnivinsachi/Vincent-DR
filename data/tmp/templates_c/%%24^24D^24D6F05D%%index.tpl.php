<?php /* Smarty version 2.6.19, created on 2010-06-13 15:52:25
         compiled from productlisting/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'productlisting/index.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <!--<?php echo smarty_function_geturl(array('controller' => 'productlisting','action' => 'index'), $this);?>
-->
    	<fieldset>
        <legend>Upload a specific product for sale</legend>

        <span style="font-size:14px; color:#069;">What kind of products would you like to upload? Please select the appropriate category.</span>
       <ul id="qm0" class="qmmc" style="float:left;">
            <li><a class="qmparent" >Men&acute;s dance shoes</a>
                <ul>
                <li><a class="qmparent"  id="menStandardShoes">Men&acute;s standard shoes</a>
                	<ul>
                    	<li><a style="text-decoration:none;">
                        	<form action="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
" method="post">
                            
                        	<label>Size category:</label>
                            <select name="size_category">
                            <option value="USsize">US sizes</option>
                            <option value="EuroSize">Euro sizes</option>
                            <option value="BRsize">Brititsh sizes</option>
                            </select>
                          <br />
                            <input type="hidden" name="sex" value="_men" />
                            <input type="hidden" name="type" value="_shoes" />
                            <input type="submit" value="Next" class="submit2"/>
                            <input type="hidden" name="productTag" value="Mens standard shoes" />
                            
                            </form></a>
                         </li>
                    </ul></li>
                <li><a  id="menLatinShoes" class="qmparent productTagAnchor">Men&acute;s latin shoes</a>
                	<ul>
                    	<li><a style="text-decoration:none;">
                        	<form action="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
" method="post">
                        	<label>Size category:</label>
                            <select name="size_category">
                            <option value="USsize">US sizes</option>
                            <option value="EuroSize">Euro sizes</option>
                            <option value="BRsize">Brititsh sizes</option>
                            </select><br />
                            <input type="hidden" name="sex" value="_men" />
                            <input type="hidden" name="type" value="_shoes" />
                            <input type="submit" value="Next" class="submit2"/>
                            <input type="hidden" name="productTag" value="Mens latin shoes" />
                            
                            </form></a>
                            </li>
                    </ul></li>
                </ul></li>
            <li><a class="qmparent" >Women&acute;s dance shoes</a>
                <ul>
                <li><a  id="womenPracticeShoes" class="productTagAnchor qmparent">Practice women&acute;s dance shoes</a>
                	<ul>
                    	<li><a style="text-decoration:none;"><form>
                        	<label>Size category:</label>
                            <select name="size_category">
                           <option value="USsize">US sizes</option>
                            <option value="EuroSize">Euro sizes</option>
                            <option value="BRsize">Brititsh sizes</option>
                            </select><br />
                            <input type="hidden" name="sex" value="_women" />
                            <input type="hidden" name="type" value="_shoes" />
                            <input type="submit" value="Next" class="submit2"/>
                            <input type="hidden" name="productTag" value="Practice womens dance shoes"/>
                            </form></a>
                         </li>
                    </ul></li>
                <li><a class="qmparent" >Women&acute;s standard shoes</a>
                	<ul>
                    	<li><a  id="womenCompStandardShoes" class="qmparent productTagAnchor">Competition women&acute;s standard shoes </a>
                        <ul>
                            <li><a style="text-decoration:none;">
                            	<form method="post" action="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
">
                                
                                    <label>Availabe size categories for custom orders:</label>
                                    <select name="size_category">
                                    <option value="USsize">US sizes</option>
                            		<option value="EuroSize">Euro sizes</option>
                            		<option value="BRsize">Brititsh sizes</option>
                                    </select><br />
                                    
                                    <label>Available heel heights for custom orders:</label>
                                    <select name="heel">
                                    <option value="_standard_inch">[2 inch, 2.5 inch]</option>
                                    <option value="_latin_inch">[2.5 inch, 3 inch]</option>
                                    <option value="_all_inch">[2 inch, 2.5 inch, 3 inch]</option>
                                    <option value="_standard_mm">[50 mm, 70 mm]</option>
                                    <option value="_latin_mm">[70 mm, 90 mm]</option>
                                    <option value="_all_mm">[50 mm, 70 mm, 90 mm]</option>	
                                    </select>
                                  
                                    <input type="hidden" name="sex" value="_women" />
                                    <input type="hidden" name="type" value="_shoes" />
                                    <input type="hidden" name="productTag" value="Competition womens standard shoes" />
                                    <input type="submit" value="Next" class="submit2"/>
                                </form></a>
                             </li>
                        </ul></li>
                        <li><a  id="womenSocialStandard" class="productTagAnchor qmparent">Social and showcase women&acute;s standard shoes</a>
                        <ul>
                            <li><a style="text-decoration:none;"><form method="post" action="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
">
                                    <label>Availabe size categories for custom orders:</label>
                                    <select name="size_category">
                                    <option value="USsize">US sizes</option>
                            		<option value="EuroSize">Euro sizes</option>
                            		<option value="BRsize">Brititsh sizes</option>
                                    </select><br />
                                    <label>Available heel heights for custom orders:</label>
                                    <select name="heel">
                                    <option value="_standard_inch">[2 inch, 2.5 inch]</option>
                                    <option value="_latin_inch">[2.5 inch, 3 inch]</option>
                                    <option value="_all_inch">[2 inch, 2.5 inch, 3 inch]</option>
                                    <option value="_standard_mm">[50 mm, 70 mm]</option>
                                    <option value="_latin_mm">[70 mm, 90 mm]</option>
                                    <option value="_all_mm">[50 mm, 70 mm, 90 mm]</option>	
                                    </select>
                                    <input type="hidden" name="sex" value="_women" />
                            		<input type="hidden" name="type" value="_shoes" />    
                                    <input type="submit" value="Next" class="submit2"/>
                                    <input type="hidden" name="productTag" value="Social and showcase womens standard shoes"/>
                                </form></a>
                             </li>
                        </ul></li>
                    </ul></li>
                <li><a class="qmparent" href="javascript:void(0)" >Women&acute;s latin shoes</a>
                	<ul>
                    	<li><a id="womenCompLatinShoes" class="productTagAnchor qmparent">Competition women&acute;s latin shoes </a>
                        	<ul>
                                <li><a style="text-decoration:none;"><form method="post" action="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
">
                                    <label>Availabe size categories for custom orders:</label>
                                    <select name="size_category">
                                    <option value="USsize">US sizes</option>
                            		<option value="EuroSize">Euro sizes</option>
                            		<option value="BRsize">Brititsh sizes</option>
                                    </select><br />
                                    <label>Available heel heights for custom orders:</label>
                                    <select name="heel">
                                    <option value="_standard_inch">[2 inch, 2.5 inch]</option>
                                    <option value="_latin_inch">[2.5 inch, 3 inch]</option>
                                    <option value="_all_inch">[2 inch, 2.5 inch, 3 inch]</option>
                                    <option value="_standard_mm">[50 mm, 70 mm]</option>
                                    <option value="_latin_mm">[70 mm, 90 mm]</option>
                                    <option value="_all_mm">[50 mm, 70 mm, 90 mm]</option>	
                                    </select>
                                    <input type="hidden" name="sex" value="_women" />
                                    <input type="hidden" name="type" value="_shoes" />
                                    <input type="hidden" name="productTag" value="Competition womens latin shoes" />
                                    <input type="submit" value="Next" class="submit2"/>
                                </form></a>
                                 </li>
                            </ul></li>
                        <li><a class="productTagAnchor qmparent" id="womenSocialLatin">Social and showcase women&acute;s latin shoes</a>
                            <ul>
                            <li><a style="text-decoration:none;"><form method="post" action="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
">
                                    <label>Availabe size categories for custom orders:</label>
                                    <select name="size_category">
                                    <option value="USsize">US sizes</option>
                            		<option value="EuroSize">Euro sizes</option>
                            		<option value="BRsize">Brititsh sizes</option>
                                    </select><br />
                                    <label>Available heel heights for custom orders:</label>
                                    <select name="heel">
                                    <option value="_standard_inch">[2 inch, 2.5 inch]</option>
                                    <option value="_latin_inch">[2.5 inch, 3 inch]</option>
                                    <option value="_all_inch">[2 inch, 2.5 inch, 3 inch]</option>
                                    <option value="_standard_mm">[50 mm, 70 mm]</option>
                                    <option value="_latin_mm">[70 mm, 90 mm]</option>
                                    <option value="_all_mm">[50 mm, 70 mm, 90 mm]</option>	
                                    </select>
                                    <input type="hidden" name="sex" value="_women" />
                                    <input type="hidden" name="type" value="_shoes" />
                                    <input type="hidden" name="productTag" value="Social and showcase womens latin shoes" />
                                    <input type="submit" value="Next" class="submit2"/>
                                </form></a>
                             </li>
                        </ul></li>
                    </ul></li>
                </ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Skirts</a>
                <ul>
                <li><a  class="productTagAnchor qmparent" id="standardSkirts" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Standard skirts">Standard skirts</a></li>
                <li><a  id="latinSkirts" class="productTagAnchor qmparent" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Latin skirts">Latin skirts</a></li>
                </ul></li>
            <li><a class="qmparent productTagAnchor" id="womenTop" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Womens tops">Women&acute;s tops</a></li>
            <li><a class="qmparent" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Latin dresses&product=LatinDresses&type=LatinDresses">Latin dresses</a>
                </li>
            <li><a class="qmparent" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Standard dresses&product=StandardDresses&type=StandardDresses">Standard dresses</a></li>
            <li><a class="qmparent" >Pants</a>
            	<ul>
                <li><a class="productTagAnchor" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Standard pants&type=Pants&product=Pants">Standard pants</a></li>
                <li><a class="productTagAnchor" href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Latin pants&type=Pants&product=Pants">Latin pants</a></li>
                </ul>
                </li>
            <li><a href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Vests&type=Vests&product=Vests">Vests</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Jackets&type=Jackets&product=Jackets">Jackets</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Suits&type=Suits&product=Suits">Suits</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Tailsuits&type=Suits&product=Suits">Tailsuits</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Latin shirts&type=LatinShirts&product=LatinShirts">Latin shirts</a></li>
            <li><a href="<?php echo smarty_function_geturl(array('action' => 'index'), $this);?>
?productTag=Mens latin coordinates&type=LatinCoordinates&product=LatinCoordinates">Men&acute;s latin coordinates</a></li>
        	<li class="qmclear">&nbsp;</li>
        </ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>

	</fieldset>
    
    <div id="rightContainer">
        <div id="productUploadTagImage" class="">
        </div>
    </div>
<script src="/htdocs/javascripts/productTagSelection.js" type="text/javascript"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>