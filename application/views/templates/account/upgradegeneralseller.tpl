{include file="layouts/$layout/header.tpl" lightbox=true}

<form method="post" action="{geturl controller='account' action='upgradegeneralseller'}">

	<fieldset>
    	<legend>General Seller Information</legend>
        General sellers are able to post any items that they current have. Their items will show up under the users market<br />
   		
        <label>Paypal Email:</label>
        <input type="text" value="{$fp->paypal_email}" name="paypal_email" {if $fp->paypal_email!='' && $fp->verified=='1'}disabled=disabled{/if}/><br />
        <span style="float:left;">Paypal email can NOT be changed once added AND verified</span><br />

        {include file='partials/error.tpl' error=$fp->getError('paypal_email')}
        <label>Phone Number:</label>
        <input type="text" value="{$fp->phone_number}" name="phone_number" /><br />
        {include file='partials/error.tpl' error=$fp->getError('phone_number')}
        This is the seller&acute;s address.<br />
        <label>Seller Address One: </label>
        <input type="text" value="{$fp->address_one}" name="address_one"/><br />
        {include file='partials/error.tpl' error=$fp->getError('address_one')}
        <label>Seller Address Two :</label>
        <input type="text" value="{$fp->address_two}" name="address_two"/><br />
        <label>City: </label>
        <input type="text" value="{$fp->city}" name="city"/><br />
        {include file='partials/error.tpl' error=$fp->getError('city')}
        <label>State:</label>
        <input type="text" value="{$fp->state}" name="state"/><br />
        {include file='partials/error.tpl' error=$fp->getError('state')}
        <label>Country:</label>
        <input type="text" value="{$fp->country}" name="country"/><br />
        {include file='partials/error.tpl' error=$fp->getError('country')}
        <label>Zip:</label>
        <input type="text" value="{$fp->zip}" name="zip" /><br />
        {include file='partials/error.tpl' error=$fp->getError('zip')}
        <input type="submit" value="Apply" name="apply"/>
        
        <a href="{geturl controller='account' action='details'}">Cancel</a>
    </fieldset>
</form>
{include file="layouts/$layout/footer.tpl"}