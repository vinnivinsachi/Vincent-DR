{if $memberUser|@count>0}
	{include file='header.tpl' section='membershipmanager' lightbox=true}
<script type="text/javascript" src="/htdocs/js_plugin/messageDelete.js"></script>
	
	

	{include file='navprofile.tpl' section='preview'}


		<div class="post-userTitle">
			{$memberUser->profile->first_name} {$memberUser->profile->last_name}
		</div>

		
		<ul class="indexLink">
			<li><a href="#"> Send Message</a>
		</ul>
		
		<div class="post-contact">
			contact Email: {$memberUser->profile->email}<br/>
		</div>
	
		{foreach from=$images item=image}
			<div class="post-image">
				<a href="{imagefilename id=$image->getId() username=$memberUser->username}" rel="lightbox[{$title|escape}]" >
					<img src="{imagefilename id=$image->getId() w=100 username=$memberUser->username}" />
				</a>
			</div>
		{/foreach}

{else}
	{if $users|@count>0 && $action=='confirmed'}
		{include file='header.tpl' section='membershipmanager' }
<script type="text/javascript" src="/htdocs/js_plugin/messageDelete.js"></script>


<form action="/membershipmanager/edituniversaldue" method="get">
	<div class="submit">
	<input type="submit" value="Create a general club due" />
	</div>
</form>

<form action="/membershipmanager/memberlist" method="get">
	<div class="submit">
	<input type="hidden" name="action" value="pending" />
	<input type="submit" value="View Pending Affiliations" />
	</div>
</form>

	<table class="shoppingcart">
		<tr class="title">
			<td>Member Name</td>
			<td>Set Dues</td>
			<td>View Dues</td>
			<td>Action</td>
			<td>Messages</td>
		</tr>
				
			
		{foreach from=$users item=user name=Users}
		
			{include file='membershipmanager/lib/user-summary.tpl' post=$user action=$action}
		
		{/foreach}
		
	{elseif $users|@count>0 && $action=='pending'}
		{include file='header.tpl' section='membershipmanager' }
		
<form action="/membershipmanager/edituniversaldue" method="get">
	<div class="submit">
	<input type="submit" value="Create a general club due" />
	</div>
</form>

<form action="/membershipmanager/memberlist" method="get">
	<div class="submit">
	<input type="hidden" name="action" value="confirmed" />
	<input type="submit" value="View Existing Members" />
	</div>
</form>

	<table class="shoppingcart">
		<tr class="title">
			<td>Member Name</td>
			<td>Status</td>
			<td>Action</td>
			<td>Messages</td>
		</tr>
				
			
		{foreach from=$users item=user name=Users}
		
			{include file='membershipmanager/lib/user-summary.tpl' post=$user action=$action}
		
		{/foreach}
			
	{else}
		{include file='header.tpl' section='membershipmanager'}
		
			You currently do not have any affiliations. 
	
	{/if}
	
	</table>

{/if}
{include file='footer.tpl' leftcolumn='membershipmanager/lib/left-column.tpl'}