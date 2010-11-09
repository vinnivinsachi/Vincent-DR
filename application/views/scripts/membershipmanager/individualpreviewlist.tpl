
{if $dues|@count>0}
		{include file='header.tpl' section='membershipmanager' toplink='true'}
		
<form action="/membershipmanager/edituniversaldue" method="get">
	<div class="submit">
	<input type="submit" value="Create a general club due" />
	</div>
</form>


<h1>viewing dues from {$secondMember->profile->first_name} {$secondMember->profile->last_name} </h1>

	<table class="shoppingcart">
		<tr class="title">
			<td>Name of due</td>
			<td>Due amount</td>
			<td>Due Details</td>
			<td>Payment Status</td>
			<td>Details</td>
		</tr>
				
			
		{foreach from=$dues item=due name=due}
		
			{include file='membershipmanager/lib/due-summary.tpl' post=$due}
		
		{/foreach}
	</table>
{else}
	{include file='header.tpl' section='membershipmanager'}
	
		This person currently do not have any individual dues. 
{/if}
	


{include file='footer.tpl' leftcolumn='membershipmanager/lib/left-column.tpl'}