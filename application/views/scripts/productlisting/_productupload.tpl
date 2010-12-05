<div id="leftContainer">

<fieldset>
        <legend>Upload a {removeunderscore phrase=$purchase_type} product</legend>
        <div class='box marginBot20'>Please select appropriate product category:</div>
        
        <ul id="qm0" class="qmmc" style="float:left;">
       	{foreach from=$productCategoryStructure item=productCategory key=productCategoryKey}
 			<li>{$productCategoryKey}
                <ul>
                {foreach from=$productCategory item=productType key=productTypeKey}
                    {if $productType|@count>1}
                     <li>{$productTypeKey}
						<ul>
                        	{foreach from=$productType item=productTag}
                            <li>
                            <a href="{geturl route=$route storeName=$storeName}?category={$productCategoryKey}&type={$productTypeKey}&tag={$productTag}">{$productTag}</a>
                            </li>
                            {/foreach}
                        </ul>
                     </li>
                    {else}
                      <li> <a href="{geturl controller='productlisting' action=$editproductlink}?category={$productCategoryKey}&type={$productTypeKey}&tag={$productTypeKey}">{$productTypeKey}</a>
                      </li>
                    {/if}
                {/foreach} 
                </ul>
            </li>
        {/foreach}
        </ul>

</fieldset>