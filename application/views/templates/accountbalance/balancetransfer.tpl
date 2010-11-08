{include file="layouts/$layout/header.tpl" lightbox=true}
{include file="layouts/vinceTemp/header.tpl"}

<div id="leftContainer" style="width:210px; float:left;">
<div class="titleBarBig">Reward and Balance Actions</div>
<a href="{geturl controller='accountbalance' action='index'}">Account balance and reward point summary</a><br />
<a href="{geturl controller='accountbalance' action='balancewithdraw'}">Withdraw from available balance</a><br />
<a href="{geturl controller='accountbalance' action='balancetransfer'}">Transfer from available balance</a><br />
</div>

<div id="rightContainer" style='width:780px; float:right;'>

<div class='box' style="padding-bottom:15px;">
<div class='titleBarBig'>Account reward points and balance summary</div>
<table width="100%;">
<tr class='trTitle' >
	<td>Available reward points</td>
	<td>Ledger reward points</td>
    <td>Available balance</td>
    <td>Ledger balance</td>
</tr>
<tr>
	<td>{$accountBalance->available_reward_points} Points</td>
    <td>{$accountBalance->ledger_reward_points} Points</td>
    <td>{$accountBalance->available_balance} USA Dollars</td>
    <td>{$accountBalance->ledger_balance} USA Dollars</td>
</tr>
</table>
</div>

<div class='box'>

<div class='titleBarBig'>Balance transfer form</div>
<form action="{geturl controller='accountbalance' action='balancetransfer'}" method="post">

<label>From this balance</label> {$accountBalance->available_balance} USA Dollars<br /><br />

<label>Amount</label><input type='text' name="transferAmount" /> USD<br/>
<label>To user with email: </label><input type='text' name="targetEmail" /><br/>
<label>Message:</label><textarea cols='10' rows='2' name='message'></textarea>
<input type="submit" value="Submit transfer"/>
</form>
</div>

<div class='box'>
<div class='titleBarBig'>Outgoing transfers</div>
<table>
	<tr>
    	<td>Date:</td>
        <td>Unique Id:</td>
        <td>To user account:</td>
        <td>Amount</td>
        <td>Status</td>
        <td>Message</td>
    </tr>
    
    {foreach from=$transfers.outgoing item=transfer}
    <tr>
    	<td>{$transfer.date_of_request}</td>
        <td>{$transfer.balance_transfer_unique_id}</td>
    	<td>{$transfer.to_user_email}</td>
    	<td>{$transfer.balance_transfer_amount}</td>
    	<td>{$transfer.status}</td>
    	<td>{$transfer.message}</td>
    </tr>
    {/foreach}
</table>
</div>

<div class='box'>
<div class='titleBarBig'>Incoming transfers</div>
<table>
	<tr>
    	<td>Date:</td>
        <td>Unique Id:</td>
        <td>To user account:</td>
        <td>Amount</td>
        <td>Status</td>
        <td>Message</td>
    </tr>
    
    {foreach from=$transfers.incoming item=transfer}
    <tr>
    	<td>{$transfer.date_of_request}</td>
        <td>{$transfer.balance_transfer_unique_id}</td>
    	<td>{$transfer.to_user_email}</td>
    	<td>{$transfer.balance_transfer_amount}</td>
    	<td>{$transfer.status}</td>
    	<td>{$transfer.message}</td>
    </tr>
    {/foreach}

</table>
</div>


</div>

{include file="layouts/$layout/footer.tpl"}