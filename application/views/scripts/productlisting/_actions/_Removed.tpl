<a href="{geturl action='sendproductlive'}?id={$product.product_id}&product={$product.product_type}&tag={$product.product_tag}"><img src="{$siteRoot}/public/resources/css/images/list.png" alt="List" title="List" /></a>
{if $product.purchase_type=='Customizable'}
<a href="{geturl controller='manageinventory' action='addinventory'}?id={$product.product_id}" title='Edit details'><img src="{$siteRoot}/public/resources/css/images/inventory.png" alt="inventory" title="Manage inventory" /></a> 
{/if}
{if $product.purchase_type=='Customizable'}
<a href="{geturl controller='manageattribute' action='editproductattribute'}?id={$product.product_id}"><img src="{$siteRoot}/public/resources/css/images/details.png" alt="Edit Attributes" title="Edit Attributes"></a>
{/if}