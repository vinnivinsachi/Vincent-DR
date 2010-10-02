<?php /* Smarty version 2.6.19, created on 2010-10-01 23:16:13
         compiled from partials/account/customerReview.tpl */ ?>
<div style="width:100%; float:left;">
Total reviews: <?php echo $this->_tpl_vars['numberOfReview']; ?>
<br />
Average rating: <?php echo $this->_tpl_vars['averageRating']; ?>
<br />
</div>
<div style="width:100%; float:left;height:200px; overflow-y:scroll;">

    <table>
        <tr>
            <td>Order ID:</td>
            <td>Product Name:</td>
            <td>Rating:</td>
            <td>Review:</td>
        </tr>
    <?php $_from = $this->_tpl_vars['userReviews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Key'] => $this->_tpl_vars['userReview']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['userReview']['order_unique_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['userReview']['order_product_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['userReview']['rating']; ?>
</td>
            <td><?php echo $this->_tpl_vars['userReview']['description']; ?>
</td>
        <tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>

</div>