
<div class="productDetailRightSidePanel">
    <div class="productDetailRightTitle">
        Product Details
    </div>
    <div class="productDetailRightTop">
        <div class="productDetailRightDescription">
        {$product->profile->description}
            <div class="productDetailRightReward">
                Reward point for future purchases:<br />
         +{$product->reward_point} points! ( 4 Reward point = $1)
            </div>
        </div>

        <div class="productColorAttributeIndividualImage">

        </div>
    </div>
    
    <div class="productDetailsRightAttributeSelection">
        
        
        {literal}
            <script src="/htdocs/javascripts/productAttributeSelector/attributeSelector.js" type="text/javascript"></script>
        {/literal}
        
        <a href="{geturl controller='account' action='uploadmeasurement'}">Upload your measurements</a> and earn 24 reward points! <br />
        speed up your order process your measurements!<br />
        <span style="color:#F90;">Please select all available options</span><br /><br />
        
       
        <div id="{$product->product_type}_selection">
        
             <input type="checkbox" class="useMyMeasurementForOrder" /> Use my measurements for this order <br />
        <div class="dividerLine"></div>

                <div id="{$product->product_type}_colorSelection" class="colorSelection">
                  <span class='productDetailAttributeSelectionTitle'>Color</span>
                    <ul>
                    
                    {foreach from=$attributeArray item=attribute key=Key}
                    
                        {if $Key=='color'}
                     
                            {foreach from=$imageAttribute item=imageAttributes key=ImageKey}
                            
                            <li id="{$product->product_type}_colorSelection_{$imageAttributes.image_name}">{$imageAttributes.image_name}
                                <span class="productImageColorAttributeHiddenSpan" style="display:none;"><img src="/data/tmp/thumbnails/{$product->Username}/{$product->product_type}/{$product->getId()}/ImageAttribute/color/{$imageAttributes.image_attribute_id}.W150_{$attribute.attribute_name}Attribute_{$imageAttributes.image_name}.jpg" /></span>
                                </li>
                            {/foreach}
                        {/if}
                        
                    {/foreach}
                    </ul>
                </div>
        {foreach from=$productType item=attribute key=AttributeKey}
            {if $AttributeKey=='measurement'}
                <div id="measurementSelection">
                        {foreach from=$attribute item=detailAttribute key=measurementKey}
                            <div id='{$product->product_type}_measurementAttribute_{$measurementKey}' class="measurementAttribute">
                            <span class='productDetailAttributeSelectionTitle'>{$measurementKey}</span>

                                <ul>
                                    {foreach from=$detailAttribute item=measurementAttribute}
                                    <li id="{$product->product_type}_measurementAttribute_{$measurementKey}_{$measurementAttribute}">{$measurementAttribute}</li>
                                    {/foreach}
                                </ul>
                            </div>
                        {/foreach}
                </div>
            {/if}
        {/foreach}
            <div class="priceDetailRightPriceBlock">
                <div class="productDetailRightPrice">
                    ${$product->price}
                </div>
                <div class="productDetailRightDiscountPrice">
                    Now: ${$product->discount_price}
                </div>
                
                

                <button class='addToCart' disabled="disabled">Add to cart</button>
            </div>
        </div>
        
        {literal}
            
            <script type="text/javascript">
                new MeasurementAttribute('{/literal}{$product->product_type}{literal}_selection');
            </script>
        
        {/literal} 
    </div>
</div>