{include file='header.tpl'}

{if $action =='confirm'}
	{if $errors|@count==0}
		<p>
			Your new password has now been activeated. 
		</p>
		<ul>
			<li><a href="/account/login">Log in to you account</a></li>
		</ul>
	{else}
		{foreach from=$errors item=error}
			{$error}
		{/foreach}
	
	
		<p>
			Your new password was not confirmed. Please double-check the link sent to you by e-mail, or try using the 
			<a href="/account/fetchpassword">Fetch Password</a> tool again. 
		</p>
	{/if}

{elseif $action=='complete'}
	<p>
		A password has been sent to your account email address containing your new password. You must click the link in this e-mail to activate the new password.
	</p>


{else}
	<form method="post" action="/account/fetchpassword">
	
	<fieldset>
		<legend>Fetch Your Password</legend>
		
		<div class="row" id="form_username_container">
		<label for="form_username">Username:</label>
		<input type="text" id="form_username" name="username" />
		
		{include file='lib/error.tpl' error=$errors.username}
		</div>
		
		<div class="submit">
			<input type="submit" value="Fetch Password">
		</div>
	</fieldset>
	
	</form>
{/if}

{include file='footer.tpl'}