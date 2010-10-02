{include file='header.tpl'}

	Current Available product types:<br />
    
{literal}
	<script src="/htdocs/javascripts/productAttributeSelector/attributeSelector.js" type="text/javascript"></script>
{/literal}
<div class="productDetailsRightAttributeSelection">
    {foreach from=$productConfig item=productType key=Key}
    	<fieldset>
        
        <legend >{$Key}</legend>
        <div id="{$Key}_selection">
		{foreach from=$productType item=attribute key=AttributeKey}
        	{if $AttributeKey=='color'}
                 Color

            	<div id="{$Key}_colorSelection" class="colorSelection">

                	<ul>
         				{foreach from=$attribute item=detailAttribute}
                        <li id="{$Key}_colorSelection_{$detailAttribute}">{$detailAttribute}</li>
                        {/foreach}
            		</ul>
                </div>
            
            {elseif $AttributeKey=='measurement'}
            	<div id="measurementSelection">
         				{foreach from=$attribute item=detailAttribute key=measurementKey}
                        	{$measurementKey}
                            <div id='{$Key}_measurementAttribute_{$measurementKey}' class="measurementAttribute">
                            	<ul>
                                	{foreach from=$detailAttribute item=measurementAttribute}
                                    <li id="{$Key}_measurementAttribute_{$measurementKey}_{$measurementAttribute}">{$measurementAttribute}</li>
                                    {/foreach}
                                </ul>
                            </div>
                        {/foreach}
                </div>
            {/if}
            
        {/foreach}
                    <button class='addToCart' disabled="disabled">Add to cart</button>

        </div>
        </fieldset>
      
        {literal}
            
            <script type="text/javascript">
                new MeasurementAttribute('{/literal}{$Key}{literal}_selection');
            </script>
        
        {/literal} 
    {/foreach}
    
</div>

  
{include file='footer.tpl'}