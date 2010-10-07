<a href="{geturl action='sendproductdraft'}?id={$product.product_id}&product={$product.product_type}&tag={$product.product_tag}"><img src="/public/resources/css/images/unlist.png" alt="Unlist" title="Unlist"/></a>
{if $product.purchase_type=='Customizable'}
<a href="{geturl controller='manageinventory' action='addinventory'}?id={$product.product_id}" title='Edit details'><img src="/public/resources/css/images/inventory.png" alt="inventory" title="Manage inventory" /></a> 
{/if}
{if $product.purchase_type=='Customizable'}
<a href="{geturl controller='manageattribute' action='editproductattribute'}?id={$product.product_id}"><img src="/public/resources/css/images/details.png" alt="Edit Attributes" title="Edit Attributes"></a>
{/if}
<a href="{geturl action='removeproductfromlisting'}?id={$product.product_id}&tag={$product.product_tag}"><img src='/public/resources/css/images/crosses.png' alt='Remove' title='Remove' /></a>    