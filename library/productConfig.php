<?php
//product attributes and 

//product purchase main categories
$productConfig['purchase_type'] = array ('Buy_now', 'Customizable'); 
//product_categories is actually product_sex!
$productConfig['product_categories']=array('Women','Men', 'Jewelry','Accessories');
//product type categorizes the products for narrowing down selection
$productConfig['product_type']=array('Shoes','Dresses','Skirts','Tops','Sets','Shirts','Pants','Vests','Jackets','Jewelry','Accessories');
//product tags
$productConfig['product_tag']=array('Ladies latin shoes','Ladies standard shoes','Ladies practice shoes','Latin competition dress','Standard competition dress','Social and practice dress','Latin skirt','Standard skirt','Ladies top','Men latin shoes','Men standard shoes','Men practice shoes','Suit','Tailsuit','Men costume','Shirt','Pants','Vest','Jacket','Jewelry set','Hair accessory','Earring','Necklace','Bracelet','Brooch','Shoe brush','Heel protector','Sole','Bag','Robe','Belt');
//similar to product_categories...
$productConfig['attribute_categories'] = array ('shoes', 'fullbody','bottom','top', 'jewelry', 'accessories' );

//$productConfig['attributes']['details']['heel']=array('mens standard heel', 'mens latin heel', '50 mm', '70 mm', '90 mm', '2 inch', '2.5 inch', '3 inch');

$productConfig['upload_menu_item']['Buy_now']['Women']['Shoes']=array('Ladies latin shoes','Ladies standard shoes','Ladies practice shoes');
$productConfig['upload_menu_item']['Buy_now']['Women']['Dresses']=array('Latin competition dress','Standard competition dress', 'Social and practice dress');
$productConfig['upload_menu_item']['Buy_now']['Women']['Skirts']=array('Latin skirt', 'Standard skirt');
$productConfig['upload_menu_item']['Buy_now']['Women']['Tops']=array('Ladies top');
$productConfig['upload_menu_item']['Customizable']['Women']['Shoes']=array('Ladies latin shoes','Ladies standard shoes','Ladies practice shoes');
$productConfig['upload_menu_item']['Customizable']['Women']['Dresses']=array('Latin competition dress','Standard competition dress', 'Social and practice dress');
$productConfig['upload_menu_item']['Customizable']['Women']['Skirts']=array('Latin skirt', 'Standard skirt');
$productConfig['upload_menu_item']['Customizable']['Women']['Tops']=array('Ladies top');
$productConfig['upload_menu_item']['Buy_now']['Men']['Shoes']=array('Men latin shoes', 'Men standard shoes', 'Men practice shoes');
$productConfig['upload_menu_item']['Buy_now']['Men']['Sets']=array('Suit', 'Tailsuit', 'Men costume');
$productConfig['upload_menu_item']['Buy_now']['Men']['Shirts']=array('Shirt');
$productConfig['upload_menu_item']['Buy_now']['Men']['Pants']=array('Pants');
$productConfig['upload_menu_item']['Buy_now']['Men']['Vests']=array('Vest');
$productConfig['upload_menu_item']['Buy_now']['Men']['Jackets']=array('Jacket');
$productConfig['upload_menu_item']['Customizable']['Men']['Shoes']=array('Men latin shoes', 'Men standard shoes', 'Men practice shoes');
$productConfig['upload_menu_item']['Customizable']['Men']['Sets']=array('Suit', 'Tailsuit', 'Men costume');
$productConfig['upload_menu_item']['Customizable']['Men']['Shirts']=array('Shirt');
$productConfig['upload_menu_item']['Customizable']['Men']['Pants']=array('Pants');
$productConfig['upload_menu_item']['Customizable']['Men']['Vests']=array('Vest');
$productConfig['upload_menu_item']['Customizable']['Men']['Jackets']=array('Jacket');
$productConfig['upload_menu_item']['Buy_now']['Jewelry']['Jewelry']=array('Jewelry set','Hair accessory','Earring','Necklace','Bracelet','Brooch');
$productConfig['upload_menu_item']['Customizable']['Jewelry']['Jewelry']=array('Jewelry set','Hair accessory','Earring','Necklace','Bracelet','Brooch');
$productConfig['upload_menu_item']['Buy_now']['Accessories']['Accessories']=array('Shoe brush','Heel protector','Sole','Bag','Robe','Belt');
$productConfig['upload_menu_item']['Customizable']['Accessories']['Accessories']=array('Shoe brush','Heel protector','Sole','Bag','Robe','Belt');

$productConfig['inventory_attribute_table']['Ladies latin shoes']='shoes';
$productConfig['inventory_attribute_table']['Ladies standard shoes']='shoes';
$productConfig['inventory_attribute_table']['Ladies practice shoes']='shoes';
$productConfig['inventory_attribute_table']['Men latin shoes']='shoes';
$productConfig['inventory_attribute_table']['Men standard shoes']='shoes';
$productConfig['inventory_attribute_table']['Men practice shoes']='shoes';
$productConfig['inventory_attribute_table']['Latin competition dress']='fullbody';
$productConfig['inventory_attribute_table']['Standard competition dress']='fullbody';
$productConfig['inventory_attribute_table']['Social and practice dress']='fullbody';
$productConfig['inventory_attribute_table']['Latin skirt']='bottom';
$productConfig['inventory_attribute_table']['Standard skirt']='bottom';
$productConfig['inventory_attribute_table']['Ladies top']='top';
$productConfig['inventory_attribute_table']['Suit']='fullbody';
$productConfig['inventory_attribute_table']['Tailsuit']='fullbody';
$productConfig['inventory_attribute_table']['Men costume']='fullbody';
$productConfig['inventory_attribute_table']['Shirt']='top';
$productConfig['inventory_attribute_table']['Pants']='bottom';
$productConfig['inventory_attribute_table']['Vest']='top';
$productConfig['inventory_attribute_table']['Jacket']='top';
$productConfig['inventory_attribute_table']['Jewelry set']='jewelry';
$productConfig['inventory_attribute_table']['Hair accessory']='jewelry';
$productConfig['inventory_attribute_table']['Earring']='jewelry';
$productConfig['inventory_attribute_table']['Necklace']='jewelry';
$productConfig['inventory_attribute_table']['Bracelet']='jewelry';
$productConfig['inventory_attribute_table']['Brooche']='jewelry';
$productConfig['inventory_attribute_table']['Shoe brush']='accessories';
$productConfig['inventory_attribute_table']['Heel protector']='accessories';
$productConfig['inventory_attribute_table']['Sole']='accessories';
$productConfig['inventory_attribute_table']['Bag']='accessories';
$productConfig['inventory_attribute_table']['Robe']='accessories';
$productConfig['inventory_attribute_table']['Belt']='accessories';


/*$productConfig['inventory_menu_tag']['women latin shoes']=$inventoryMenu[];
$productConfig['inventory_menu_tag']['women standard shoes']='shoes';
$productConfig['inventory_menu_tag']['women practice shoes']='shoes';
$productConfig['inventory_menu_tag']['men latin shoes']='shoes';
$productConfig['inventory_menu_tag']['men standard shoes']='shoes';
$productConfig['inventory_menu_tag']['men practice shoes']='shoes';
$productConfig['inventory_menu_tag']['women latin competition dresses']='fullbody';
$productConfig['inventory_menu_tag']['women standard competition dresses']='fullbody';
$productConfig['inventory_menu_tag']['women social and practice dresses']='fullbody';
$productConfig['inventory_menu_tag']['short skirts']='bottom';
$productConfig['inventory_menu_tag']['long skirts']='bottom';
$productConfig['inventory_menu_tag']['women tops']='top';
$productConfig['inventory_menu_tag']['men suits']='fullbody';
$productConfig['inventory_menu_tag']['men tailsuits']='fullbody';
$productConfig['inventory_menu_tag']['men costumes']='fullbody';
$productConfig['inventory_menu_tag']['men shirts']='top';
$productConfig['inventory_menu_tag']['men pants']='bottom';
$productConfig['inventory_menu_tag']['men vests']='top';
$productConfig['inventory_menu_tag']['men jackets']='top';
$productConfig['inventory_menu_tag']['jewelry sets']='jewelry';
$productConfig['inventory_menu_tag']['hair']='jewelry';
$productConfig['inventory_menu_tag']['Earring']='jewelry';
$productConfig['inventory_menu_tag']['necklace']='jewelry';
$productConfig['inventory_menu_tag']['wrist']='jewelry';
$productConfig['inventory_menu_tag']['clothing']='jewelry';
$productConfig['inventory_menu_tag']['shoe brushes']='accessories';
$productConfig['inventory_menu_tag']['heel protectors']='accessories';
$productConfig['inventory_menu_tag']['soles']='accessories';
$productConfig['inventory_menu_tag']['bags']='accessories';
$productConfig['inventory_menu_tag']['robes']='accessories';
$productConfig['inventory_menu_tag']['belts']='accessories';*/


//These are system variables
$productConfig['attribute_categories_details']['shoes']=array('size','heel');
$productConfig['attribute_categories_details']['heel']=array('one_inch', 'one_half_inch', 'two_inch', 'two_half_inch', 'three_inch', 'three_half_inch', 'heel_50_mm', 'heel_70_mm', 'heel_90_mm');
$productConfig['attribute_categories_details']['color']=array('Black','Pin_stripe', 'Light_tan', 'Dark_tan', 'Brown', 'Silver', 'Gold', 'Gray', 'White', 'Red', 'Pink', 'Orange', 'Yellow', 'Green', 'Cyan', 'Blue', 'Magenta', 'Purple', 'Multicolor', 'MonoColor');
//these are system given variables to inventory dancewear
$productConfig['attribute_categories_details']['fullbody']=array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Shoulder'=>array('min'=>20, 'max'=>60,'interval'=>1),'Chest or bust'=>array('min'=>40, 'max'=>120,'interval'=>1),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1),'Hip'=>array('min'=>45,'max'=>120,'interval'=>1), 'Length of garment'=>array('min'=>45,'max'=>130,'interval'=>1));
$productConfig['attribute_categories_details']['bottom']=array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1),'Hip'=>(array('min'=>45,'max'=>120,'interval'=>1)), 'Length of garment'=>array('min'=>45,'max'=>130,'interval'=>1));
$productConfig['attribute_categories_details']['top']=array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Shoulder'=>array('min'=>20, 'max'=>60,'interval'=>1),'Chest or bust'=>array('min'=>40, 'max'=>120,'interval'=>1),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1));
$productConfig['attribute_categories_details']['jewelry']=array();
$productConfig['attribute_categories_details']['accessories']=array();

$productConfig['attribute_conversion_details']['heel_sizes']=array('one_inch'=>'1 inch', 'one_half_inch'=>'1.5 inch', 'two_inch'=>'2 inch', 'two_half_inch'=>'2.5 inch', 'three_inch'=>'3 inch', 'three_half_inch'=>'3.5 inch', 'heel_50_mm'=>'50 mm', 'heel_70_mm'=>'70 mm', 'heel_90_mm'=>'90 mm');

//these are measurements for customize orders
$productConfig['attribute_customize_details']['women']['body_measurement']=array();
$productConfig['attribute_customize_details']['men']['body_measurement']=array();

$productConfig['custom_attribute_detail_table']=array('fabric_set', 'custom_attribute');

$productConfig['allowedPurchaseType']['storeSeller']=array('Customizable', 'Buy_now');
$productConfig['allowedPurchaseType']['generalSeller']=array('Buy_now');

$productConfig['shoe_metric']=array('US','BR','EU');
$productConfig['price_category']=array('price_category_1','price_category_2','price_category_3','price_category_4','price_category_5');

$productConfig['searchOptions']=array('tag'=>$productConfig['product_tag'], 'purchasetype'=>$productConfig['purchase_type'], 'limit','page', 'social_usage','competition_usage', 'color'=>$productConfig['attribute_categories_details']['color'], 'heel'=>$productConfig['attribute_categories_details']['heel'], 'shoe_size', 'size','brand','origin','size_system'=>$productConfig['shoe_metric'],'pricecat'=>$productConfig['price_category']);

$productConfig['productDisplay']['search_table']=array('inventory','products');

$productConfig['customizeOrder']['fullbody']=array('body_height','neck','arm_length','wrist','armpit_circumference','shoulder','chest_or_bust','shoulder_to_chest_or_bust','waist','shoulder_to_waist','hip','thigh_circumference','waist_to_floor','inseam');
$productConfig['customizeOrder']['bottom']=array('body_height','waist','hip','waist_to_floor','inseam');
$productConfig['customizeOrder']['top']=array('body_height','neck','arm_length','wrist','armpit_circumference','shoulder','chest_or_bust','shoulder_to_chest_or_bust','waist','shoulder_to_waist');
$productConfig['customizeOrder']['shoes']=array('size_system','shoe_size','brand','dance_style');

$productConfig['orderStatis']=array('UNSHIPPED', 'SHIPPED', 'DELIVERED','RETURN_SHIPPED','RETURN_DELIVERED','ORDER_COMPLETED','RETURN_COMPLETED','BALANCE_UPDATED','BALANCE_REFUNDED','CANCELLED_BY_SELLER','CANCELLED_BY_BUYER', 'HELD_BY_BUYER_FOR_ARBITRATION','HELD_BY_BUYER_FOR_ARBITRATION_APPROVED','HELD_BY_BUYER_FOR_ARBITRATION_DENIED','HELD_BY_BUYER_FOR_ARBITRATION_DENIED_BY_SELLER', 'HELD_BY_SELLER_FOR_ARBITRATION','HELD_BY_SELLER_FOR_ARBITRATION_APPROVED','HELD_BY_SELLER_FOR_ARBITRATION_DENIED','SELLER_CLAIM_APPROVED_UNSHIPPED', 'SELLER_CLAIM_APPROVED_RESHIPPED', 'SELLER_CLAIM_APPROVED_DELIVERED');
?>