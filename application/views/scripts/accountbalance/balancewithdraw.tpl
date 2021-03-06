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

<div class='titleBarBig'>Balance withdraw form</div>
<p>
Funds will be transfered to you in the forms of a check. Checks are shipped within two business days after a withdraw is made. </p>
<form action="{geturl controller='accountbalance' action='balancewithdraw'}" method="post">
<label>From this balance</label> {$accountBalance->available_balance} USA Dollars<br /><br />

<label>Amount</label><input type='text' name="widthdrawAmount" /> USD
<input type="submit" value="Submit withdraw"/>
</form>
</div>

<div class='box'>
<div class='titleBarBig'>Current existing withdraws</div>
<table>
<tr>
	<td>Date:</td>
    <td>Unique id: </td>
    <td>Balance:</td>
    <td>Status:</td>
</tr>
{foreach from=$currentWithdraws item=withdraw}
<tr>
	<td>{$withdraw.date_of_request}</td>
    <td>{$withdraw.balance_withdraw_unique_id}</td>
    <td>{$withdraw.balance_withdraw_amount}</td>
    <td>{$withdraw.status}</td>
   
</tr>
{/foreach}
</table>
</div>
</div>
{include file="layouts/$layout/footer.tpl"}