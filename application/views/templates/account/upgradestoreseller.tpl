{include file="layouts/$layout/header.tpl" lightbox=true}

<form method="post" action="{geturl controller='account' action='upgradestoreseller'}">

	<fieldset>
    	<legend>General Seller Information</legend>
        <label>Paypal Email:</label>
        <input type="text" value="{$fp->paypal_email}" name="paypal_email" {if $fp->paypal_email!='' && $fp->verified=='1'}disabled=disabled{/if}/><br />
        <label>Phone Number:</label>
        <input type="text" value="{$fp->phone_number}" name="phone_number" /><br />
        <label>Please describe the items that you intend to sell:</label><br />
        <textarea value="" rows="5" cols="30" name="items_description">{$fp->items_description}</textarea><br />
        <label>Please describe your store:</label>
        <textarea value="" rows="5" cols="30" name="store_description">{$fp->store_description}</textarea><br />
        This is the seller&acute;s address.<br />
        <label>Seller Address One: </label>
        <input type="text" value="{$fp->address_one}" name="address_one"/><br />
        <label>Seller Address Two :</label>
        <input type="text" value="{$fp->address_two}" name="address_two"/><br />
        <label>City: </label>
        <input type="text" value="{$fp->city}" name="city"/><br />
        <label>State:</label>
        <input type="text" value="{$fp->state}" name="state"/><br />
        <label>Country:</label>
        <input type="text" value="{$fp->country}" name="country"/><br />
        <label>Zip:</label>
        <input type="text" value="{$fp->zip}" name="zip" /><br />
        type is: {$fp->type}<br />
        <input type="hidden" name="submitType" value="{$fp->type}" /><br />
        <input type="submit" value="Apply" name="apply"/>
        
        <a href="{geturl controller='account' action='details'}">Cancel</a>
    </fieldset>
</form>
{include file="layouts/$layout/footer.tpl"}