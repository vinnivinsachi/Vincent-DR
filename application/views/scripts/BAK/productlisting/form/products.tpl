<form method="post" action="{geturl controller='productlisting' action='editproduct'}">
	<fieldset>
    	<legend>{$fp->product_tag} Details</legend>
        <label>Name:</label>
        <input type="text" value="{$fp->name}" name="name"><br>
    	{include file='lib/error.tpl' error=$fp->getError('name')}

		<div>
        <label>price:</label>
        <input type="text" value="{$fp->price}" name="price"><br>
        {include file='partials/error.tpl' error=$fp->getError('price')}
		</div>
        <div>
        <label>discount price (optional):</label>
        <input type="text" value="{$fp->discount_price}" name="discount_price" /><br />
        </div>
        <div>
        <label>Shipping rate:</label>
        <input type="text" value="{$fp->shipping_rate}" name="shippingRate" /><br />
        {include file='partials/error.tpl' error=$fp->getError('shippingRate')}
        </div>
        <div>
        <label>backorder time(this keeps track of latest shipping date)</label>
        <select name="backorder_time">
        	<option value="1 week" {if $fp->backorder_time=='1 week'}selected=selected{/if}>1 week</option>
            <option value="2 weeks" {if $fp->backorder_time=='2 weeks'}selected=selected{/if}>2 weeks</option>
            <option value="3 weeks" {if $fp->backorder_time=='3 weeks'}selected=selected{/if}>3 weeks</option>
            <option value="4 weeks" {if $fp->backorder_time=='4 weeks'}selected=selected{/if}>4 weeks</option>
            <option value="5 weeks" {if $fp->backorder_time=='5 weeks'}selected=selected{/if}>5 weeks</option>
            <option value="6 weeks" {if $fp->backorder_time=='6 weeks'}selected=selected{/if}>6 weeks</option>
            <option value="7 weeks" {if $fp->backorder_time=='7 weeks'}selected=selected{/if}>7 weeks</option>
            <option value="8 weeks" {if $fp->backorder_time=='8 weeks'}selected=selected{/if}>8 weeks</option>
        </select></div><br />
        
        <label>brand:</label>
        <select name="brand">
       		<option value="Supadance">Supadance</option>
            <option value="International">International</option>
            <option value="Rayrose">Rayrose</option>
            <option value="DN">DanceNaturals</option>
            <option value="STP">StephanieProfessional</option>
            <option value="BDdance">BDdance</option>
            <option value="SDUSA">SoulDancer</option>
            <option value="Chrissane">Chrissane</option>
            <option value="Other">Other</option>
        </select><br>
        {include file='partials/error.tpl' error=$fp->getError('brand')}

	
		
        <label>Youtube Video:</label>
        <input name="video_youtube" value="{$fp->video_youtube}" name="video_youtube" /><br />
        
        <label>Description:</label><br>
        {wysiwyg name='description' value=$fp->description}

        <input type="hidden" name="id" value="{$fp->product_id}" />
        <input type="hidden" name="product" value="{$fp->product_type}" />
        <input type="hidden" name="tag" value="{$fp->product_tag}" />
        <input type="submit" value="proceed">
        <a href="{geturl controller='productlisting' action='index'}">Back</a>
    </fieldset>
</form>