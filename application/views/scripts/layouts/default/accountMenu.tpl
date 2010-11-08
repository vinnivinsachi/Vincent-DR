<div id='account_menu'>
	{if $loggedInUser}
        Welcome {$loggedInUser->username}!<br />
        <a href='{$siteRoot}/account'>My Account</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
        <a href='{$siteRoot}/authentication/logout'>Logout</a>
	{else}
		<a href='{$siteRoot}/authentication/login'>Login</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
		<a href='{$siteRoot}/account/register'>Register</a>
	{/if}
</div>
