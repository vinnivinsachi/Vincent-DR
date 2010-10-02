{include file="layouts/$layout/header.tpl" lightbox=true}

Your order should be created, please check your database.

<a href="{geturl action='orderconfirmed'}?orderId={$orderUniqueId}">Proceed to order creation</a>
{include file="layouts/$layout/footer.tpl"}