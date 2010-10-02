{include file="header.tpl" section='account'}
Welcome, {$signedInUser->generalInfo->first_name}.
<br />
This is the master admin page. this account is only for network admins only. <br/>
<ul>
	<li>View and manage users</li>
    <li>View and manage transactions</li>
    <li>View and manage products</li>
    <li>View and manage messages and shoutouts</li>
    <li>View and manage promotions</li>
</ul>


{include file="footer.tpl"}