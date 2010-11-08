{include file="layouts/$layout/header.tpl" lightbox=true}
{include file="layouts/vinceTemp/header.tpl"}

<div id="leftContainer" style="width:210px; float:left;">	
<div class="titleBarBig">Withdraw actions</div>
<a href="{geturl controller='adminaccount' action='managetransfers'}">Transfer requests</a><br />

<a href="{geturl controller='adminaccount' action='transferhistory'}">Transfer Approved</a>
</div>

<div id="rightContainer" style="width:780px; float:right;">
    {foreach from=$generalSellers item=generalSeller}
        {$generalSeller.first_name}
        {$generalSeller.last_name}<br />
    {/foreach}
    
    {foreach from=$storeSellers item=storeSellers}
    	{$storeSellers.first_name}
    	{$storeSellers.last_name}<br />
    {/foreach}


<table>
<tr>
	<td>Date:</td>
    <td>Unique id:</td>
    <td>User:</td>
    <td>To User:</td>
    <td>Balance:</td>
    <td>Message:</td>
    <td>Status:</td>
</tr>
{foreach from=$transfers item=transfer}
<tr>
	<td>{$transfer.date_of_request}</td>
    <td>{$transfer.balance_transfer_unique_id}</td>
    <td>{$transfer.username}</td>
    <td>{$transfer.to_user.0.username}</td>
    <td>${$transfer.balance_transfer_amount}</td>
    <td>{$transfer.message}</td>
    <td>{$transfer.status}</td>
   
</tr>
{/foreach}
</table>

</div>
{include file="layouts/$layout/footer.tpl"}