<div class="productOrderInfo box" style="padding-bottom:15px;">
<div class='titleBarBig'>Order ID: {$product.0.order_unique_id} on date: {$product.0.ts_created|date_format} </div>
    <div class="box" style="padding-bottom:15px;">
{$product.0.buyer_name}<br/>
{$product.orderInfo->shippingAddress->address_one}<br/>
{if $product.orderInfo->shippingAddress->address_two!=''}
{$product.orderInfo->shippingAddress->address_two}<br/>
{/if}
{$product.orderInfo->shippingAddress->city},
{$product.orderInfo->shippingAddress->state} {$product.orderInfo->shippingAddress->zip}<br/>
{$product.orderInfo->shippingAddress->country}<br/>


</div>

<div class="productUserInformation box" style="padding-bottom:15px;">
<div style='width:49%; float:left'>
<div class='titleBarMid'>Buyer information</div>
<a href="#to adminacocunt user"><strong>{$product.buyer_info->first_name} {$product.buyer_info->first_name}</strong></a><br />
{$product.0.buyer_email}<br />

</div>

<div style='width:49%; float:right'>
<div class='titleBarMid'>Seller information</div>
<a href="#to adminacocunt user"><strong>{$product.uploader_info->first_name} {$product.uploader_info->first_name}</strong></a><br />

{$product.uploader_info->sellerInformation->paypal_email}<br />
{$product.uploader_info->sellerInformation->phone_number}<br />
<strong>Seller type:</strong> {$product.uploader_info->sellerInformation->type}<br />
<strong>Seller address: </strong><br />

{$product.uploader_info->sellerInformation->address_one}<br/>
{if $product.uploader_info->sellerInformation->address_two!=''}
{$product.uploader_info->sellerInformation->address_two}<br/>
{/if}
{$product.uploader_info->sellerInformation->city},
{$product.uploader_info->sellerInformation->state} {$product.uploader_info->sellerInformation->zip}<br/>
{$product.uploader_info->sellerInformation->country}<br/>
</div>
</div>
</div>

<div class="productProfileBox box" style="padding-bottom:15px;">
<div class='titleBarBig'>Profile status: ***{$product.0.order_status}***</div>
     <div class='box' style='width:100%;'>
		<div style="font-weight:bold; width:500px; float:left;">
                    {$product.0.product_name}
                    </div>
		                    		
                        <table width="100%;" style='border:none;'>
                        <tr>
                        <td width="200px;"><img src='/public/resources/userdata/tmp/thumbnails/{$product.0.uploader_username}/{$product.0.product_tag}/{$product.0.product_image_id}.W150_homeFrontFour.jpg'/></td>
                        <td width="400px;">
                        <table width='100%;'>
                        {foreach from=$product.attributes item=attribute key=attributeKey}
                        <tr width="400px;">
                        <td style='width:60%; text-align:right;'>{removeunderscore phrase=$attribute.profile_key}: </td>
                        <td style='width:40%; text-align:left;'>{removeunderscore phrase=$attribute.profile_value}</td>
                        </tr>
                        {/foreach}
                        <tr>
                        <td style='width:60%; text-align:right;'>Quantity: 1</td>  
                        <td style='width:40%; text-align:left;' class='price'> ${$product.0.product_price}</td> 
                        </tr>
                        
                        <tr>
                        <td style='width:60%; text-align:right;'>Shipping: </td>  
                        <td style='width:40%; text-align:left;' class='price'>${$product.0.current_shipping_rate}</td> 
                        </tr>
                        
                        </table>
                        </td>
                        </tr>
                        </table>
		                           
    </div>
</div>   
<div class="productStatusTracking box" style="padding-bottom:15px;">
<div class='titleBarBig'>Status Tracking</div>
<table>
<tr>
	<td>Date</td>
	<td>Status</td>
	<td>Message</td>
</tr>
{foreach from=$product.statusTracking item=tracking}
<tr>
	<td>{$tracking.status_changed_date}</td>
	<td>{$tracking.status}</td>
	<td>{$tracking.message}</td>
</tr>
{/foreach}
</table>
</div>

<div class="productMessage box" style="padding-bottom:15px;">
<div class='titleBarBig'>Message Tracking</div>
<table>
<tr>
	<td>Date</td>
	<td>Sender</td>
	<td>Receiver</td>
    <td>Message</td>
</tr>
{foreach from=$product.sender_message item=message}
<tr>
	<td>{$message.ts_created}</td>
	<td>{$message.sender_name}</td>
	<td>{$message.receiver_name}</td>
    <td>{$message.sender_message}</td>
</tr>
{/foreach}
</table>
<div class='adminMessageBox box' style='padding-top:15px;'>
<div style='width:49%; float:left'>
<div class='titleBarMid'>Message buyer</div>
<form action="{geturl controller='communication' action='privatemessage'}" method="post" class="account-privatemessage-form">
                    <label style="width:50%;">Current time:</label>
                    <span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span>
                    <div>
                    <label  style="width:50%;">To {$product.0.buyer_username}:</label>
                    <textarea name="sender_message" rows="3"></textarea>
                    {include file='partials/error.tpl' error=''}
                    </div>
                    
                    <input name="sender_name" type="hidden" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
                    <input name="sender_email" type="hidden" value="{$signedInUser->generalInfo->email}" readonly="readonly" />
                    <input type="hidden" name="product_id" value="{$product.0.product_id}"/>
                    <input type="hidden" name="product_category" value="{$product.0.purchase_type}"/>
                    <input type="hidden" name="product_type" value="{$product.0.product_type}"/>
                    <input type="hidden" name="receiver_User_id" value="{$product.0.buyer_id}"/>
                    <input type="hidden" name="receiver_Username" value="{$product.0.buyer_username}"/>
                    <input type="hidden" name="receiver_name" value="{$product.0.buyer_username}" />
                    <input type="hidden" name="product_name" value="{$product.0.product_name}" />
                    <input type="hidden" name="product_tag" value="{$product.0.product_tag}" />
                    <input type="hidden" name="sender_subject" value="orderID: {$product.0.order_unique_id}" />
                    <input type="hidden" name="product_image_id" value="{$product.0.product_image_id}"/>
                    <input type="hidden" name="sender_user_id" value="{$signedInUser->generalInfo->userID}" />
                    <input type="hidden" name="sender_username" value="{$signedInUser->generalInfo->username}" />
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
                </form>
</div>

<div style='width:49%; float:right'>
<div class='titleBarMid'>Message seller</div>
<form action="{geturl controller='communication' action='privatemessage'}" method="post" class="account-privatemessage-form">
                    <label style="width:50%;">Current time:</label>
                    <span style="float:left; width:40%;">{$smarty.now|date_format:"%D, %I:%M %p"}</span>
                    <div>
                    <label style="width:50%;">To {$product.0.uploader_username}:</label>
                    <textarea name="sender_message" rows="3"></textarea>
                    {include file='partials/error.tpl' error=''}
                    </div>
                    <input name="sender_name" type="hidden" value="{$signedInUser->generalInfo->username}" readonly="readonly" />
                    <input name="sender_email" type="hidden" value="{$signedInUser->generalInfo->email}" readonly="readonly" />
                    <input type="hidden" name="product_id" value="{$product.0.product_id}"/>
                    <input type="hidden" name="product_category" value="{$product.0.purchase_type}"/>
                    <input type="hidden" name="product_type" value="{$product.0.product_type}"/>
                    <input type="hidden" name="receiver_User_id" value="{$product.0.uploader_id}"/>
                    <input type="hidden" name="receiver_Username" value="{$product.0.uploader_username}"/>
                    <input type="hidden" name="receiver_name" value="{$product.0.uploader_username}" />
                    <input type="hidden" name="product_name" value="{$product.0.product_name}" />
                    <input type="hidden" name="product_tag" value="{$product.0.product_tag}" />
                    <input type="hidden" name="sender_subject" value="orderID: {$product.0.order_unique_id}" />
                    <input type="hidden" name="product_image_id" value="{$product.0.product_image_id}"/>
                    <input type="hidden" name="sender_user_id" value="{$signedInUser->generalInfo->userID}" />
                    <input type="hidden" name="sender_username" value="{$signedInUser->generalInfo->username}" />
                    
                    <input type="submit" name="sendPublicShoutOut" class="submitInputButton" style="margin-left:50%; float:left;"value="Send message!"/>
                </form>
</div>
</div>

</div>


<div id="adminOrderActions box" >
<div class='titleBarBig'>Adminitration actions</div>

{if $product.0.order_status == 'ORDER_COMPLETED'}
<form action="{geturl controller='orderadministration' action='markorderasupdatedorcancelled'}" method="post">
<input type="hidden" name="id" value="{$product.0.order_profile_id}" />
<input type="submit" value="Mark Balance Updated" />
</form>
{elseif $product.0.order_status == 'RETURN_COMPLETED' || $product.0.order_status == 'CANCELLED_BY_SELLER' || $product.0.order_status == 'CANCELLED_BY_BUYER'}
<form action="{geturl controller='orderadministration' action='markorderasupdatedorcancelled'}" method="post">
<input type="hidden" name="id" value="{$product.0.order_profile_id}" />
<input type="submit" value="Mark Balance Refunded" />
</form>
{/if}
</div>