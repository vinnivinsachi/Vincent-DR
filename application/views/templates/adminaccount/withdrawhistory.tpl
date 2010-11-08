{include file="layouts/$layout/header.tpl" lightbox=true}
{include file="layouts/vinceTemp/header.tpl"}

<div id="leftContainer" style="width:210px; float:left;">	
<div class="titleBarBig">Withdraw actions</div>
<a href="{geturl controller='adminaccount' action='managewithdraws'}">Withdraw requests</a><br />

<a href="{geturl controller='adminaccount' action='withdrawhistory'}">Withdraws Approved</a>
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
    <td>Balance:</td>
    <td>Status:</td>
    <td>Actions:</td>
</tr>
{foreach from=$withdraws item=withdraw}
<tr>
	<td>{$withdraw.date_of_request}</td>
    <td>{$withdraw.balance_withdraw_unique_id}</td>
    <td>{$withdraw.first_name} {$withdraw.last_name}</td>
    <td>{$withdraw.balance_withdraw_amount}</td>
    <td>{$withdraw.status}</td>
    <td>
    
    <a>Print address</a></td>
</tr>
{/foreach}
</table>

</div>
{include file="layouts/$layout/footer.tpl"}