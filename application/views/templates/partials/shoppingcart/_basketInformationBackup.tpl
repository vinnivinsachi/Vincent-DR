<div id="basketInformation">
            <div id="productOrderTopTile" style="float:left;; width:100%;">
            <div class='box'><div class='titleBarBig'>Cart information</div></div>
                <div class="productSellerInfo" style="float:left; width:55%;">.
                </div>
                <div class="productOrderQuantity" style="float:left;; width:15%; text-align: right;">
                Quantity
                </div>
                <div class="productOrderPrice" style="float:left; width:15%; text-align: right;">
                Price
                </div>
                <div class="productOrderRewardPoints" style="float:left; width:15%; text-align: right;">
                Reward Points
                </div>
            </div>
            
            <!--foreach loop begins-->
            {foreach from=$shoppingCartProducts item=product key=cartKey}
            <div class="productOrderIndividualProduct" style="float:left;; width:100%; padding-top: 10px; padding-bottom: 5px; border-bottom:1px solid #666;">
                <div class="productOrderBody">
                    <div class="productSellerInfo" style="float:left; width:55%;">
                    	<strong>{$product.uploader_username} / {removeunderscore phrase=$product.purchase_type}</strong><br />
                        <a href="{geturl controller='shoppingcart' action='removeitemsfromshoppingcart'}?cartProductId={$cartKey}"><img src="/public/resources/css/images/deleteFromShoppingFlattened.png" style="margin-bottom:-10px;"/></a>Product name: {$product.product_name}<br />
                        
                            <div class="productOrderAttributes" style="padding-left:20px;">
                            <table>
                            {foreach from=$product.attribute item=attributes key=Key}
                            <tr>
                            <td style='width:200px;'>{removeunderscore phrase=$Key}: </td>
                            <td>{removeunderscore phrase=$attributes}</td>
                            </tr>
                            {/foreach}
                             </table>
                            </div>
                    </div>
                    <div id="productOrderQuantity" style="float:left; width:15%; text-align: right;">
                    1
                    </div>
                    <div id="productOrderPrice" class='price' style="float:left; width:15%; text-align: right;">
					${$product.product_price}
                    </div>
                    <div id="productOrderRewardPoints" style="float:left; width:15%; text-align: right;">
					+ {$product.reward_point} points
                    </div>
                </div>
                <div class="productShippingBody">
                    <div class="productSellerInfo" style="float:left; width:55%;">
                    {if $product.productTypeAddedToShoppingCart=='Inventory'}
                    Shipping Information: Ship with in 4 days.
                    {elseif $product.productTypeAddedToShoppingCart=='Customize'}
                    Shipping Information: Ship with in {$product.backorder_time}
                    {/if}
                    </div>
                   
                </div>
            </div>
            {/foreach}
        </div>
          
        <div id="cartCost" style="width:100%; float:left; padding-top: 10px;">
                <div class="productSellerInfo" style="float:left; width:55%;">Cart Costs</div>
                <div id="productOrderQuantity" style="float:left;; width:15%;">.</div>
                <div id="productOrderPrice" class='price' style="float:left; width:15%; text-align: right;">${$shoppingCartInfo->tempTotalCost}</div>
                <div id="productOrderRewardPoints" style="float:left; width:15%; text-align: right;">+ {$shoppingCartInfo->totalRewardPoints} points</div>
        </div>