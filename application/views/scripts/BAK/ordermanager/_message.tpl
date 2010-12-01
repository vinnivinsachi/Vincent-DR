<div class="{$order->order_unique_id}_{$product.order_profile_id}" id="DivIDmessageForm-{$order->order_unique_id}_{$product.order_profile_id}" style="display:none;">
  <form action="{geturl controller='communication' action='privatemessage'}" method="post" class="account-privatemessage-form">
     <label style="width:50%;">Current time:</label>
     <span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span>
     <div>
     <label  style="width:50%;">Message:</label>
     <textarea name="sender_message"></textarea>
     {include file='partials/error.tpl' error=''}
     </div>
  
     <input name="sender_name" type="hidden" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
     <input name="sender_email" type="hidden" value="{$signedInUser->generalInfo->email}" readonly="readonly" />
     <input type="hidden" name="product_id" value="{$product.product_id}"/>
     <input type="hidden" name="receiver_User_id" value="{$product.buyer_id}"/>
     <input type="hidden" name="receiver_Username" value="{$product.buyer_username}"/>
     <input type="hidden" name='receiver_name' value="{$product.buyer_name}"/>
     <input type="hidden" name="sender_subject" value="orderID: {$product.order_unique_id}" />
     <input type="hidden" name="sender_user_id" value="{$signedInUser->generalInfo->userID}" />
     <input type="hidden" name="sender_username" value="{$signedInUser->generalInfo->username}" />
                                    
     <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
    </form>
     {foreach from=$product.messageThreads item=message}
     <div class="PrivateMessage" style="float:left; width:100%; padding:0px; border-bottom:none;">
        <div class="leftColumnShoutOut" style="width:20%; float:left;">
            <div class="publicProductName" >
            {if $message.product_type_seller=='generalSeller'}
                        
            <a href="{geturl controller='userproductpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$message.product_name}</a>
            {else}
            <a href="{geturl controller='productpreview' action='details'}?id={$shoutmessage.product_id}&tag={$shoutmessage.product_tag}">{$message.product_name}</a>
                                            
            {/if}
                                                
            </div>
                                            <!--<div class="publicProductType">
                                                {$shoutmessage.product_category}
                                            </div>-->
            </div>
            <div class="rightColumnShoutOut" style="width:75%; float:left;">
                 <div class="publicProductShoutOutMessageName" >
                       {$message.sender_name} to {$message.receiver_name}
                 </div>
                 <div class="privateMessageSubject">
                       <span style="font-style:italic;">{$message.sender_subject}</span>
                 </div>
                 <div class="publicProductShoutOutMessageContent" >
                       {$message.sender_message}
                 </div>
                 <div class="publicProductShoutOutMessageTime" >
                       {$message.ts_created|date_format:"%D, %I:%M %p"}
                 </div>
             </div>
             <div style="float:right;">
                  {if $message.product_type_seller=='generalSeller'}
                  <a href="{geturl controller='userproductpreview' action='details'}?id={$message.product_id}&tag={$message.product_tag}">View Product</a>
                  {else $message.product_type_seller=='storeSeller'}
                  <a href="{geturl controller='productpreview' action='details'}?id={$message.product_id}&tag={$message.product_tag}">View Product</a>
                  {/if}
              </div>
           </div>
        {/foreach}
     </div>