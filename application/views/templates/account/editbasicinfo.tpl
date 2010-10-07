{include file="layouts/$layout/header.tpl" lightbox=true}
<div id="leftContainer" style="width:49%; float:left;">	

</div>
<div id="rightContainer" style="width:49%; float:left;">
<form method="post" action="{geturl controller='account' action='editbasicinfo'}">

	<fieldset>
    	<legend>Basic Info</legend>
        <label>Username: </label> {$fp->username}<br />
        <label>Usertype: </label> {$fp->user_type}<br />
        <label>Email: </label> {$fp->email}<br />
        <label><strong style="color:#003366; font-size:1.7em;">*</strong>Password:</label>
        <input {if $edit=='false'}disabled="disabled"{/if}  type="password" id="form_password" name="password"/><br /><br />
        {include file='partials/error.tpl' error=$fp->getError('password')}
        <label><strong style="color:#003366; font-size:1.7em;">*</strong>Retype Password: </label>
        <input {if $edit=='false'}disabled="disabled"{/if} type="password" id="form_confirm_password" name="confirm_password" /><br /><br />
        {include file='partials/error.tpl' error=$fp->getError('confirm_password')}
        <label>First name: </label>
        <input type="text" value="{$fp->first_name}" name="first_name" /><br />
		<label>Last name: </label>
   		<input type="text" value="{$fp->last_name}" name="last_name" /><br />
        <label>Gender:</label>{$fp->sex}<br />
        <label>Affiliations:</label>
    	<input type="text" value="{$fp->affiliation}" name="affiliation" /><br />
		<label>Dance experience:</label>
		<select name="experience">
            <option value="social" {if $fp->experience=='social'} selected="selected"{/if}>Social</option>
            <option value="beginner" {if $fp->experience=='beginner'} selected="selected"{/if}>Beginner</option>
            <option value="collegiate" {if $fp->experience=='collegiate'} selected="selected"{/if}>Collegiate</option>
            <option value="amature" {if $fp->experience=='amature'} selected="selected"{/if}>Amature</option>
            <option value="professional" {if $fp->experience=='professional'} selected="selected"{/if}>Professional</option>
        </select>  <br />
        <label>Hear about us: </label> {$fp->hear_about_us}<br />
       		
        <input type="submit" value="save"/>
        <a href="{geturl controller='account' action='details'}">Cancel</a>
        
    </fieldset>
</form>
</div>
{include file="layouts/$layout/footer.tpl"}