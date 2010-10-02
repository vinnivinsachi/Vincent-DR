{include file='header.tpl' lightbox=true}

	<div id="leftContainer" style="width:60%;">
    	here at productlisting->editproduct
        <form method="post" action="{geturl controller='userproductlisting' action='editproduct'}" id="userProductEdit">
            <fieldset>
                <legend>{$fp->product_tag} Details</legend>
                <label>Name:</label>
                <input type="text" value="{$fp->name}" name="name"><br>
                {include file='lib/error.tpl' error=$fp->getError('name')}
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
                <div>
                <label>Quantity:</label>
                <select name="quantity">
                <option value="1" {if $fp->quantity==1}selected=selected{/if}>1</option>
                <option value="2" {if $fp->quantity==2}selected=selected{/if}>2</option>
                <option value="3" {if $fp->quantity==3}selected=selected{/if}>3</option>
                <option value="4" {if $fp->quantity==4}selected=selected{/if}>4</option>
                <option value="5" {if $fp->quantity==5}selected=selected{/if}>5</option>
                <option value="6" {if $fp->quantity==6}selected=selected{/if}>6</option>
                <option value="7" {if $fp->quantity==7}selected=selected{/if}>7</option>
                <option value="8" {if $fp->quantity==8}selected=selected{/if}>8</option>
                <option value="9" {if $fp->quantity==9}selected=selected{/if}>9</option>
                <option value="10" {if $fp->quantity==10}selected=selected{/if}>10</option>	
                </select>
                
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
        
               
                
                <label>Youtube Video:</label>
                <input name="video_youtube" value="{$fp->video_youtube}" name="video_youtube" />
                
                <label>Description:</label><br>
                {wysiwyg name='description' value=$fp->description}
                
                <input type="hidden" name="id" value="{$fp->product_id}" />
                <input type="hidden" name="product" value="{$fp->product_type}" />
                <input type="hidden" name="tag" value="{$fp->product_tag}" />
                
                
                {foreach from=$productTypeAttributes item=attribute key=AttributeKey}
                   {if $AttributeKey=='measurement'}
                        {foreach from=$attribute item=detailAttribute key=measurementKey}
                        <label>{$measurementKey}</label>
                            <select name="{$measurementKey}">
                                {foreach from=$detailAttribute item=measurementAttribute}
                                <option value="{$measurementAttribute}" {if $fp->$measurementKey==$measurementAttribute}selected = selected{/if}>{$measurementAttribute}</option>
                                {/foreach}
                            </select>
                        {/foreach}
                    {/if}
                {/foreach}
                </div>
                
                <input type="submit" value="proceed">
                <a href="{geturl controller='productlisting' action='index'}">Back</a>
            </fieldset>
        </form>
        
        
        <a href="{geturl controller='productlisting' action='index'}">Reset current listing</a>
	</div>



{include file='footer.tpl'}