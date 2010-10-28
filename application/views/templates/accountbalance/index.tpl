{include file="layouts/$layout/header.tpl" lightbox=true}
{include file="layouts/vinceTemp/header.tpl"}

<div id="leftContainer" style="width:210px; float:left;">
<div class="titleBarBig">Reward and Balance Actions</div>
<a>Withdraw from availble balance</a>
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

<div class='titleBarBig'>Account reward points and balance details</div>

<table >
	<tr class='trTitle'>
    <td>Status:</td>
    <td>Description:</td>
    <td>Reward deduction</td>
    <td>Reward addition</td>
    <td>Balance deduction</td>
    <td>Balance addition</td>
    <td width="80px;">Created</td>
    <td width="80px;">Updated</td>
    </tr>
    
    {foreach from=$rewardPointsAndBalanceRecords item=record}
    <tr class="{if $record.status=='PENDING'}Unlisted{elseif $record.status=='POSTED'}Listed{/if}" style="{if $record.status=='CANCELLED'}	background-color:#EFEFEF;{/if}">
    	<td style="text-align:center;">{removeunderscore phrase=$record.status}</td>
        <td style="text-align:center;">{$record.description}</td>
        <td style="text-align:center;">{if $record.deducted_reward_points!=''} - {$record.deducted_reward_points}{/if}</td>
        <td style="text-align:center;">{if $record.added_reward_points!=''}+ {$record.added_reward_points}{/if}</td>
        <td style="text-align:center;">{if $record.deducted_dollar_amount!=''}- ${$record.deducted_dollar_amount}{/if}</td>
        <td style="text-align:center;">{if $record.added_dollar_amount!=''}+ ${$record.added_dollar_amount}{/if}</td>
        <td style="text-align:center;">{$record.date|date_format}</td>
        <td style="text-align:center;">{$record.ts_updated|date_format}</td>
    </tr>
    {/foreach}

</table>
</div>
</div>
{include file="layouts/$layout/footer.tpl"}