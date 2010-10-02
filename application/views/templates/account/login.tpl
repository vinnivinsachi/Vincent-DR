{include file="layouts/$layout/header.tpl" lightbox=true}
<div id="leftContainer">
<div class='box'>
<div class='titleBarBig'><strong>Log into your account</strong></div>
<form method="post" action="{geturl action='login' controller='account'}" id="login-form" style='width:100%; float:left'>

	<input type="hidden" name="redirect" value="{$redirect|escape}" />
	
    		<div>
                 <label for="form_username">Username:</label>
                 <input type="text" id="form_username" name="username" value="{$username|escape}"/>
                
                 {include file='partials/error.tpl' error=$errors.username}
               
			</div>
			<div>
              	<label for="form_password">Password:</label>
                <input type="password" id="form_password" name="password" value="{$password|escape}" AUTOCOMPLETE="off"/>
                {include file='partials/error.tpl' error=$errors.password}   
        	</div>
	
	<a href="/account/fetchpassword">Forgot your password?</a>
	
	
	
	<div class="submit">
		<input type="submit" value="Login" name="login"/>		
	</div>

</form>
</div>

<div class='box marginTop20'>
<div class='titleBarBig'><strong>Register an account</strong></div>
<form method="post" action="{geturl controller='registration' action='newmember'}" id="registration-form">
<div class="error" {if !$fp->hasError()} style="display: none"{/if}>
			An error has occured in the form below. Please check the highlighted fields and resubmit the form. 
		</div>

		{include file='partials/error.tpl' error=$fp->getError('university')}
		


	
		<div class="row" id="form_username_container">
			<label for="form_username"><strong style="color:#003366; font-size:1.7em;">*</strong>Username:</label>
			<input type="text" id="form_username" name="username" value="{$fp->username|escape}"/>
			{include file='partials/error.tpl' error=$fp->getError('username')}
		</div>
		
		<div class="row" id="form_password_container">
			<label for="form_password"><strong style="color:#003366; font-size:1.7em;">*</strong>Password:</label>
			<input {if $edit=='false'}disabled="disabled"{/if}  type="password" id="form_password" name="password"/>
			{include file='partials/error.tpl' error=$fp->getError('password')}
		</div>
		
		<div class="row" id="form_confirm_password_contrainer">
			<label for="form_confirm_password"><strong style="color:#003366; font-size:1.7em;">*</strong>Retype Password: </label>
			<input {if $edit=='false'}disabled="disabled"{/if} type="password" id="form_confirm_password" name="confirm_password" />
			{include file='partials/error.tpl' error=$fp->getError('confirm_password')}
		</div>
		
		<div class="row" id="form_email_container">
			<label for="form_email"><strong style="color:#003366; font-size:1.7em;">*</strong>Email Address:</label>
			<input type="text" id="form_email" name="email" value="{$fp->email|escape}"/>
			{include file='partials/error.tpl' error=$fp->getError('email')}
		</div>
		
		<div class="row" id="form_first_name_container">
			<label for="form_first_name"><strong style="color:#003366; font-size:1.7em;">*</strong>First Name:</label>
			<input type="text" id="form_first_name" name="first_name" value="{$fp->first_name|escape}" />
			{include file='partials/error.tpl' error=$fp->getError('first_name')}
		</div>
		
		<div class="row" id="form_last_name_container">
			<label for="form_last_name"><strong style="color:#003366; font-size:1.7em;">*</strong>Last Name:</label>
			<input type="text" id="form_last_name" name="last_name" value="{$fp->last_name|escape}" />
			{include file='partials/error.tpl' error=$fp->getError('last_name')}
		</div>
        
        <div class="row" id="form_gender_container">
			<label for="form_gender"><strong style="color:#003366; font-size:1.7em;">*</strong>Gender:</label>
			<select id="form_gender" name="sex">
            	<option value="woman">Woman</option>
                <option value="man">Man</option>
            </select>
			{include file='partials/error.tpl' error=$fp->getError('sex')}
			</div>
			<div class="row" id="form_dancing_experience">
        	<label for="dance_experience"><strong style="color:#003366; font-size:1.7em;">*</strong>Dancing experience:</label>
        	<select name="experience">
            	<option value="" {if $fp->experience==''} selected="selected"{/if}></option>
            	<option value="social" {if $fp->experience=='social'} selected="selected"{/if}>Social</option>
				<option value="beginner" {if $fp->experience=='beginner'} selected="selected"{/if}>Beginner</option>
                <option value="collegiate" {if $fp->experience=='collegiate'} selected="selected"{/if}>Collegiate</option>
                <option value="amature" {if $fp->experience=='amature'} selected="selected"{/if}>Amature</option>
                <option value="professional" {if $fp->experience=='professional'} selected="selected"{/if}>Professional</option>
            </select>
            {include file='partials/error.tpl' error=$fp->getError('experience')}

        </div>
        
        <div class="row" id="form_hear_about_us">
        	<label for="hear_about_us"><strong style="color:#003366; font-size:1.7em;">*</strong>Hear about us:</label>
        	<select name="hear_about_us">
                <option value="" {if $fp->hear_about_us==''} selected="selected"{/if}></option>
            	<option value="google" {if $fp->hear_about_us=='google'} selected="selected"{/if}>google</option>
				<option value="yahoo" {if $fp->hear_about_us=='yahoo'} selected="selected"{/if}>yahoo</option>
                <option value="friends" {if $fp->hear_about_us=='friends'} selected="selected"{/if}>friends</option>
                <option value="facebook" {if $fp->hear_about_us=='facebook'} selected="selected"{/if}>facebook</option>
                <option value="local ballroom community" {if $fp->hear_about_us=='local ballroom community'} selected="selected"{/if}>local ballroom community</option>
                <option value="other search engine" {if $fp->hear_about_us=='other search engine'} selected="selected"{/if}>other search engine</option>
				<option value="other" {if $fp->hear_about_us=='other'} selected="selected"{/if}>other</option>
            </select>
                        {include file='partials/error.tpl' error=$fp->getError('hear_about_us')}

        </div>
        
		<div class="row" id="form_university">
			<label for="form_university">Current Affiliations:</label>
				<select name="affiliation">
				<option value="Independent" {if $fp->affiliation=='Independent'} selected="selected"{/if}>Independent</option> 
				{foreach from=$fp->universities item=university}
				<option value="{$university.university_name}" {if $fp->affiliation==$university.university_name} selected="selected"{/if}>{$university.university_name}</option>
				{/foreach}				
                </select>
		</div>
		
		<!--<div class="captcha">
			<img src="../utility/captcha" alt="CAPTCHA image" />
		</div>-->
		
		<!--<div class="row" id="form_captcha_container">
			<label for="form_captcha"><strong style="color:#003366; font-size:1.7em;">*</strong>Enter Above Phrase:</label>
			<input type="text" id="form_captcha" name="captcha" value="{$fp->captcha|escape}" />
			{include file='partials/error.tpl' error=$fp->getError('captcha')}
		</div>-->
		
		<div class="submit">
			<input type="submit" value="Register" />
		</div>
</form>
</div>
</div>


{literal}
    
    <script type="text/javascript">
		new loginFormEnhancer('registration-form');
	</script>

{/literal}

{include file="layouts/$layout/footer.tpl"}