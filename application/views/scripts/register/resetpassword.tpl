{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>
		
	<!-- IF a new password was set -->
		{if $newPasswordSet}
			A NEW PASSWORD HAS BEEN SET AND A CONFIRMATION EMAIL HAS BEEN SENT
		
	<!-- ELSE IF the reset link was clicked -->
		{elseif $resetLinkClicked}
			{include file='register/forms/newPasswordForm.tpl'}
			{include file='register/js/newPasswordJS.tpl'}
		
	<!-- ELSE IF the reset email was sent -->
		{elseif $resetEmailSent}
			<p>An email has been sent to: {$resetEmail}</p>
			<p>Please check your email for a link to reset your password.</p>
		
	<!-- ELSE IF nothing has been clicked or submitted -->
		{else}
			{include file='register/forms/resetPasswordForm.tpl'}
			{include file='register/js/resetPasswordJS.tpl'}
		{/if}

</div>

{include file="layouts/$layout/footer.tpl"}
