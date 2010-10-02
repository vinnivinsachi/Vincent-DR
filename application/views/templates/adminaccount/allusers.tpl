{include file="header.tpl" section='account'}
Here at all the users

<div id="leftContainer" style="width:22%; float:left;">	

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
</div>
{include file="footer.tpl"}