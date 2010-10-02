<?php /* Smarty version 2.6.19, created on 2010-09-01 14:41:08
         compiled from account/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'account/login.tpl', 5, false),array('modifier', 'escape', 'account/login.tpl', 7, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="leftContainer">
<div class='box'>
<div class='titleBarBig'><strong>Log into your account</strong></div>
<form method="post" action="<?php echo smarty_function_geturl(array('action' => 'login','controller' => 'account'), $this);?>
" id="login-form" style='width:100%; float:left'>

	<input type="hidden" name="redirect" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['redirect'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	
    		<div>
                 <label for="form_username">Username:</label>
                 <input type="text" id="form_username" name="username" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['username'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
                
                 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['errors']['username'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
               
			</div>
			<div>
              	<label for="form_password">Password:</label>
                <input type="password" id="form_password" name="password" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" AUTOCOMPLETE="off"/>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['errors']['password'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>   
        	</div>
	
	<a href="/account/fetchpassword">Forgot your password?</a>
	
	
	
	<div class="submit">
		<input type="submit" value="Login" name="login"/>		
	</div>

</form>
</div>

<div class='box marginTop20'>
<div class='titleBarBig'><strong>Register an account</strong></div>
<form method="post" action="<?php echo smarty_function_geturl(array('controller' => 'registration','action' => 'newmember'), $this);?>
" id="registration-form">
<div class="error" <?php if (! $this->_tpl_vars['fp']->hasError()): ?> style="display: none"<?php endif; ?>>
			An error has occured in the form below. Please check the highlighted fields and resubmit the form. 
		</div>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('university'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		


	
		<div class="row" id="form_username_container">
			<label for="form_username"><strong style="color:#003366; font-size:1.7em;">*</strong>Username:</label>
			<input type="text" id="form_username" name="username" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->username)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('username'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<div class="row" id="form_password_container">
			<label for="form_password"><strong style="color:#003366; font-size:1.7em;">*</strong>Password:</label>
			<input <?php if ($this->_tpl_vars['edit'] == 'false'): ?>disabled="disabled"<?php endif; ?>  type="password" id="form_password" name="password"/>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('password'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<div class="row" id="form_confirm_password_contrainer">
			<label for="form_confirm_password"><strong style="color:#003366; font-size:1.7em;">*</strong>Retype Password: </label>
			<input <?php if ($this->_tpl_vars['edit'] == 'false'): ?>disabled="disabled"<?php endif; ?> type="password" id="form_confirm_password" name="confirm_password" />
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('confirm_password'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<div class="row" id="form_email_container">
			<label for="form_email"><strong style="color:#003366; font-size:1.7em;">*</strong>Email Address:</label>
			<input type="text" id="form_email" name="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->email)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('email'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<div class="row" id="form_first_name_container">
			<label for="form_first_name"><strong style="color:#003366; font-size:1.7em;">*</strong>First Name:</label>
			<input type="text" id="form_first_name" name="first_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('first_name'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<div class="row" id="form_last_name_container">
			<label for="form_last_name"><strong style="color:#003366; font-size:1.7em;">*</strong>Last Name:</label>
			<input type="text" id="form_last_name" name="last_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->last_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('last_name'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
        
        <div class="row" id="form_gender_container">
			<label for="form_gender"><strong style="color:#003366; font-size:1.7em;">*</strong>Gender:</label>
			<select id="form_gender" name="sex">
            	<option value="woman">Woman</option>
                <option value="man">Man</option>
            </select>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('sex'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			<div class="row" id="form_dancing_experience">
        	<label for="dance_experience"><strong style="color:#003366; font-size:1.7em;">*</strong>Dancing experience:</label>
        	<select name="experience">
            	<option value="" <?php if ($this->_tpl_vars['fp']->experience == ''): ?> selected="selected"<?php endif; ?>></option>
            	<option value="social" <?php if ($this->_tpl_vars['fp']->experience == 'social'): ?> selected="selected"<?php endif; ?>>Social</option>
				<option value="beginner" <?php if ($this->_tpl_vars['fp']->experience == 'beginner'): ?> selected="selected"<?php endif; ?>>Beginner</option>
                <option value="collegiate" <?php if ($this->_tpl_vars['fp']->experience == 'collegiate'): ?> selected="selected"<?php endif; ?>>Collegiate</option>
                <option value="amature" <?php if ($this->_tpl_vars['fp']->experience == 'amature'): ?> selected="selected"<?php endif; ?>>Amature</option>
                <option value="professional" <?php if ($this->_tpl_vars['fp']->experience == 'professional'): ?> selected="selected"<?php endif; ?>>Professional</option>
            </select>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('experience'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        </div>
        
        <div class="row" id="form_hear_about_us">
        	<label for="hear_about_us"><strong style="color:#003366; font-size:1.7em;">*</strong>Hear about us:</label>
        	<select name="hear_about_us">
                <option value="" <?php if ($this->_tpl_vars['fp']->hear_about_us == ''): ?> selected="selected"<?php endif; ?>></option>
            	<option value="google" <?php if ($this->_tpl_vars['fp']->hear_about_us == 'google'): ?> selected="selected"<?php endif; ?>>google</option>
				<option value="yahoo" <?php if ($this->_tpl_vars['fp']->hear_about_us == 'yahoo'): ?> selected="selected"<?php endif; ?>>yahoo</option>
                <option value="friends" <?php if ($this->_tpl_vars['fp']->hear_about_us == 'friends'): ?> selected="selected"<?php endif; ?>>friends</option>
                <option value="facebook" <?php if ($this->_tpl_vars['fp']->hear_about_us == 'facebook'): ?> selected="selected"<?php endif; ?>>facebook</option>
                <option value="local ballroom community" <?php if ($this->_tpl_vars['fp']->hear_about_us == 'local ballroom community'): ?> selected="selected"<?php endif; ?>>local ballroom community</option>
                <option value="other search engine" <?php if ($this->_tpl_vars['fp']->hear_about_us == 'other search engine'): ?> selected="selected"<?php endif; ?>>other search engine</option>
				<option value="other" <?php if ($this->_tpl_vars['fp']->hear_about_us == 'other'): ?> selected="selected"<?php endif; ?>>other</option>
            </select>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('hear_about_us'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        </div>
        
		<div class="row" id="form_university">
			<label for="form_university">Current Affiliations:</label>
				<select name="affiliation">
				<option value="Independent" <?php if ($this->_tpl_vars['fp']->affiliation == 'Independent'): ?> selected="selected"<?php endif; ?>>Independent</option> 
				<?php $_from = $this->_tpl_vars['fp']->universities; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['university']):
?>
				<option value="<?php echo $this->_tpl_vars['university']['university_name']; ?>
" <?php if ($this->_tpl_vars['fp']->affiliation == $this->_tpl_vars['university']['university_name']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['university']['university_name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>				
                </select>
		</div>
		
		<!--<div class="captcha">
			<img src="../utility/captcha" alt="CAPTCHA image" />
		</div>-->
		
		<!--<div class="row" id="form_captcha_container">
			<label for="form_captcha"><strong style="color:#003366; font-size:1.7em;">*</strong>Enter Above Phrase:</label>
			<input type="text" id="form_captcha" name="captcha" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->captcha)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('captcha'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>-->
		
		<div class="submit">
			<input type="submit" value="Register" />
		</div>
</form>
</div>
</div>


<?php echo '
    
    <script type="text/javascript">
		new loginFormEnhancer(\'registration-form\');
	</script>

'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>