<div id='account_menu'>
	{if $loggedInUser}
        Welcome {$loggedInUser->username}!<br />
        <a href='{$siteRoot}/account'>My Account</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
        <a href='{$siteRoot}/authentication/logout'>Logout</a>
	{else}
		<a id='login-link' href='{$siteRoot}/authentication/login'>Login</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
		<a href='{$siteRoot}/register'>Register</a>
	{/if}
</div>

{literal}
<script type='text/javascript'>
	$j('a#login-link').fancybox({content: '<object width="300" height="300" data="{/literal}{$siteRoot}/account{literal}">???</object>'});
</script>
{/literal}
