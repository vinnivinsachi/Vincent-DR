{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>

	<div id="nav">
		<!-- FIXED -->
		
	
	
		<!-- NOT FIXED -->
		<a href='{$siteRoot}/account/details'>[account details]</a>
		
		
	                <a href='{$siteRoot}/productdisplay'>[Product display]</a>
	                <a href='{$siteRoot}/accountblanace'>[Account balance]</a>
	                <a href='{$siteRoot}/account/messages'>[Messages]</a>
	                <a href='{$siteRoot}/ordermanager/orders'>[Bought orders]</a>
	               {if $signedInUser->generalInfo->user_type=='storeSeller' || $signedInUser->generalInfo->user_type=='generalSeller'}
	               	<a href='{$siteRoot}/ordermanager/soldorders'>[Sold orders]</a>
	               {/if}
	
	                
	                <a href='{$siteRoot}/account/rewardpoints'>[your reward points]</a><br />
	                
	                <a href='{$siteRoot}/productpreview'>[view products live!]</a><br />
	                
	               
	                <a href='{$siteRoot}/productlisting/uploadbuynowproduct'>[List a BUY NOW product]</a>
	                <a href='{$siteRoot}/productlisting/uploadcustomizeproduct'>[List a customer order product]</a>
	                
	                <a href='{$siteRoot}/productlisting/viewpendingproduct'>[My listings]</a>
	                {if $signedInUser->generalInfo->user_type=='admin'}
	                <br />
					------------------------------------------------------<br />
					Adminaccount management<br />
	                <a href='{$siteRoot}/adminaccount'>account/index</a>
	                {/if}   
	          	</div>
	            
	            {if $messages|@count>0}
	
	            <div id="messages" class="ui-widget">
	            	<div class="ui-state-highlight ui-corner-all" style="padding: 0pt 0.7em; margin-top: 20px;">
	                	<p>
	                    	<span class="ui-icon ui-icon-info" style="float: left; margin-right: 0.3em;"></span>	
	                        {if $messages|@count==1}
	                            <strong></strong>
	                            {$messages.0}
	                        {else}
	                            <strong></strong>
	                            <ul>
	                                {foreach from=$messages item=row}
	                                    <li>{$row}</li>
	                                {/foreach}
	                            </ul>
	                        {/if}
	                    </p>
	                </div>
	            </div>
	            {else}
	                <div id="messages" class="ui-widget" style="display:none"></div>
	            {/if}
	            
	

</div>

{include file="layouts/$layout/footer.tpl"}
