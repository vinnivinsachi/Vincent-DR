{include file="layouts/$layout/header.tpl" lightbox=true}

<form method="post" action="{geturl controller='account' action='editshipping'}?editAddress={$addressID}">

	<fieldset>
    	{if $fp->addShipping=='true'}
        <legend>Add new shipping Address</legend>
        {else}
        <legend>Edit Shipping</legend>
		{/if}
        
        <label>Address One: </label>
        <input type="text" value="{$fp->address_one}" name="address_one"/><br />
        {include file='partials/error.tpl' error=$fp->getError('address_one')}
        <label>Address Two:</label>
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
        <input type="checkbox" name="defaultShipping" />Set as default shipping<br />
        <input type="submit" value="save"/>
        <a href="{$returnAddress}">Cancel</a>
        
    </fieldset>
</form>
{include file="layouts/$layout/footer.tpl"}