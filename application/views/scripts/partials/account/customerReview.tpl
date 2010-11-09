<div style="width:100%; float:left;">
Total reviews: {$numberOfReview}<br />
Average rating: {$averageRating}<br />
</div>
<div style="width:100%; float:left;height:200px; overflow-y:scroll;">

    <table>
        <tr>
            <td>Order ID:</td>
            <td>Product Name:</td>
            <td>Rating:</td>
            <td>Review:</td>
        </tr>
    {foreach from=$userReviews item=userReview key=Key}
        <tr>
            <td>{$userReview.order_unique_id}</td>
            <td>{$userReview.order_product_name}</td>
            <td>{$userReview.rating}</td>
            <td>{$userReview.description}</td>
        <tr>
    {/foreach}
    </table>

</div>