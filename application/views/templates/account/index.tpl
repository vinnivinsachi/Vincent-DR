{include file="layouts/$layout/header.tpl" lightbox=true}

<div id="nav">
            	<a href="{geturl controller='registration' action='newmember'}">[Register]</a><br />
                <a href="{geturl controller='index' action='index'}">[Index]</a>
                <a href="{geturl controller='productdisplay' action='index'}">[Product display]</a>
                <a href="{geturl controller='account' action='logout'}">[Logout]</a>
                <a href="{geturl controller='account' action='login'}">[Login]</a><br />
                <a href="{geturl controller='account' action='index'}">[Account index]</a>
                <a href="{geturl controller='account' action='messages'}">[Messages]</a>
                <a href="{geturl controller='ordermanager' action='orders}">[Bought orders]</a>
               {if $signedInUser->generalInfo->user_type=='storeSeller' || $signedInUser->generalInfo->user_type=='generalSeller'}
               	<a href="{geturl controller='ordermanager' action='soldorders'}">[Sold orders]</a>
               {/if}

                <a href="{geturl controller='account' action='details'}">[acocunt details]</a>
                <a href="{geturl controller='account' action='rewardpoints'}">[your reward points]</a><br />
                
                <a href="{geturl controller='productpreview' action='index'}">[view products live!]</a><br />
                
               
                <a href="{geturl controller='productlisting' action='uploadbuynowproduct'}">[List a BUY NOW product]</a>
                <a href="{geturl controller='productlisting' action='uploadcustomizeproduct'}">[List a customer order product]</a>
                
                <a href="{geturl controller='productlisting' action='viewpendingproduct'}">[My listings]</a>
                {if $signedInUser->generalInfo->user_type=='admin'}
                <br />
				------------------------------------------------------<br />
				Adminaccount management<br />
                <a href="{geturl controller='adminaccount' action='index'}">account/index</a>
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
            

<div id="leftContainer" style="width:20%; float:left;">	


</div>

<div id="rightColumn" style="width:79%; float:right;">
</div>

{include file="layouts/$layout/footer.tpl"}