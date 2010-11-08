{include file="layouts/$layout/header.tpl" lightbox=true}

<div id="leftContainer" style="width:22%; float:left;">	
<a href="{geturl controller='adminaccount' action='managetransfers'}">Transfer requests</a><br />

<a href="{geturl controller='adminaccount' action='transferhistory'}">Transfer Approved</a>

</div>

<div id="rightColumn" style="width:77%; float:right;">
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
    <td>Unique id: </td>
    <td>From:</td>
    <td>To:</td>
    <td>Balance:</td>
    <td>Status:</td>
    <td>Actions:</td>
</tr>
{foreach from=$transfers item=transfer}
<tr>
	<td>{$transfer.date_of_request}</td>
    <td>{$transfer.balance_transfer_unique_id}</td>
    <td>{$transfer.username}</td>
    <td>{$transfer.to_user.0.username}</td>
    <td>${$transfer.balance_transfer_amount}</td>
    <td>{$transfer.message}</td>
    <td>
    <form action="{geturl controller='adminaccount' action='processtransfers'}" method="post">
    	<input type="hidden" name="transferId" value="{$transfer.user_account_balance_transfer_tracking_id}"/>
        <input type="submit" value="Process transfer request" />
    </form>	
   </td>
</tr>
{/foreach}
</table>


</div>
{include file="layouts/$layout/footer.tpl"}