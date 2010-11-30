{include file="layouts/$layout/header.tpl" lightbox=true}

<div id="leftContainer" style="width:20%; float:left;">	
	
<ul id="qm0" class="qmmc" style="width:100%;">
    <li><a class="qmparent" href="javascript:void(0)">Messages( )</a>
    	<ul>
        	<li><a>Inbox( )</a></li>
            <li><a>Sent </a></li>
        </ul>
    </li>
</ul>
    
 <!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top)--> 
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}
</div>
<div id="rightContainer" style="width:80%; float:right;">
     {if $user->generalInfo->user_type =='generalSeller' || $user->generalInfo->user_type =='storeSeller'} 
            <div class='titleBarBig'>My public shout box messages</div>
            {include file='partials/account/publicShoutBoxMessages.tpl'}
     {/if}
    <div class='titleBarBig'>My private messages</div>
        <div id="messageboxNavigation" class='box'>
        <a class="productTagHeaderButton currentSelection" id="anchorInboxSelection">Inbox</a>
            <a class="productTagHeaderButton" id="anchorOutboxSelection">Outbox</a>
<!--<a class="productTagHeaderButton" id="anchorComposeSelection">Compose</a>-->        
	</div>
       
    {include file='partials/account/privateMessages.tpl'}
</div>

{literal}
<script type="text/javascript">

new toggleClass('accountInboxMessage', 'privateMessageForm', 'accountDetailShoutOutFromRespond', 'PrivateMessage');

new individualToggle('anchorInboxSelection', 'accountInboxMessage', 'currentSelection', Array('accountOutboxMessage'), Array('anchorOutboxSelection'));

new individualToggle('anchorOutboxSelection', 'accountOutboxMessage', 'currentSelection', Array('accountInboxMessage'), Array('anchorInboxSelection'));

//new orderToggle('.anchorOrderMessageSeller', '.anchorTrackingStatus','.anchorReturnTrackingStatus','.anchorReturnItem','.anchorTrackingForm', '.anchorOrderCancelled','.anchorProductReview', 'currentSelection');

																										
</script>
{/literal}

{include file="layouts/$layout/footer.tpl"}