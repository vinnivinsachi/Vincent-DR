{include file="layouts/$layout/header.tpl" lightbox=true}
Welcome, {$signedInUser->generalInfo->first_name}.
<br />
This is the master admin page. this account is only for network admins only. <br/>
<ul>
	<li>View and manage user requests</li>
    	<ul><li>such as message remove requests, shout out remove requests, review remove requests</li></ul>
	<li><a href="{geturl controller='adminaccount' action='allusers'}">View and manage users</a></li>
	<li><a href="{geturl controller='adminaccount' action='managewithdraws'}">Manage Withdraws {$withdraws}</a></li>
	<li><a href="{geturl controller='adminaccount' action='managetransfers'}">Manage Transfers {$transfers}</a></li>
    <li><a href="{geturl controller='adminorders' action='index'}">View and manage orders and transactions</a></li>
    <li>View and manage products</li>
    <li>View and manage messages and shoutouts</li>
    <li>View and manage promotions</li>
</ul>


{include file="layouts/$layout/footer.tpl"}