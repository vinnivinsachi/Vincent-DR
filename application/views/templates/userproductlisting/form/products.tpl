<form method="post" action="{geturl controller='userproductlisting' action='editproduct'}">
	<fieldset>
    	<legend>{$fp->product_type} Details</legend>
        <div>
        <label>Name:</label>
        <input type="text" value="{$fp->name}" name="name"><br>
    	{include file='lib/error.tpl' error=$fp->getError('name')}
        </div>
		
        <div>
        <label>price:</label>
        <input type="text" value="{$fp->price}" name="price"><br>
        {include file='lib/error.tpl' error=$fp->getError('price')}
        </div>
        <div>
        <label>Shipping rate:</label>
        <input type="text" value="{$fp->shipping_rate}" name="shippingRate" /><br />
        {include file='lib/error.tpl' error=$fp->getError('shippingRate')}
        </div>
        <label>brand:</label>
        <select name="brand">
            <option value="BDdance">BDdance</option>
            <option value="SDUSA">SoulDancerUSA</option>
            <option value="STP">StephanieProfessional</option>
            <option value="DN">DanceNaturals</option>
            <option value="Chrissane">Chrissane</option>
            <option value="Other">Other</option>
        </select><br>
        {include file='lib/error.tpl' error=$fp->getError('brand')}

		<label>Reward Point:</label>
        <input name="reward_point" value="{$fp->reward_point}" name="reward_point" />
		
        <label>Youtube Video:</label>
        <input name="video_youtube" value="{$fp->video_youtube}" name="video_youtube" />
        
        <label>Description:</label><br>
        
        <input type="hidden" name="id" value="{$fp->product_id}" />
        <input type="hidden" name="product" value="{$fp->product_type}" />
        <textarea name='description' rows="5" cols="20">{$fp->description}</textarea><br>
        <input type="submit" value="proceed">
        <a href="{geturl controller='productlisting' action='index'}">Back</a>
    </fieldset>
</form>