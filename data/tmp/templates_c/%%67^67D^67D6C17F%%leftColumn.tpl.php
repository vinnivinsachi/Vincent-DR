<?php /* Smarty version 2.6.19, created on 2010-02-24 23:11:15
         compiled from productpreview/lib/leftColumn.tpl */ ?>
<div id="leftContainer" style="width:25%">
	<fieldset>
    	<legend>Reviews</legend>
        <ul>
        <li>
        Write a review, + 12 reward point!</li>
        </ul>
    </fieldset>
    <fieldset>
    	<legend>Recommend to a friend</legend>
        <ul>
        <li>
        Recommend to a friend, + 8 reward point from registered friends!</li>
        </ul>
    </fieldset>
    <fieldset>
    	<legend>Purchase this item</legend>
        <ul>
        <li>
        Purchase this item, + <?php echo $this->_tpl_vars['product']->reward_point; ?>
 reward point towards future purchase!</li>
        </ul>
    </fieldset>
    <fieldset>
    	<legend>Related Products</legend>
    </fieldset>
    

</div>