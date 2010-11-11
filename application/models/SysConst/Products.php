<?php

class Application_Model_SysConst_Products extends Custom_Model_Abstract
{
	static public $productBrands = array('Superdance', 'International', 'Rayrose', 'DanceNatruals','Stephanie Professionals', 'BDdance', 'SouldancerUSA', 'Chrissane', 'Veryfine', 'GoGo', 'Other');
	
	static public $purchaseType = array('Buy_now', 'Customizable');
	
	static public $productMainCategory = array('Women','Men', 'Jewelry','Accessories');
	
	static public $productTag = array('Ladies latin shoes','Ladies standard shoes','Ladies practice shoes','Latin competition dress','Standard competition dress','Social and practice dress','Latin skirt','Standard skirt','Ladies top','Men latin shoes','Men standard shoes','Men practice shoes','Suit','Tailsuit','Men costume','Shirt','Pants','Vest','Jacket','Jewelry set','Hair accessory','Earring','Necklace','Bracelet','Brooch','Shoe brush','Heel protector','Sole','Bag','Robe','Belt');
	
	static public $priceCategory = array('price_category_1','price_category_2','price_category_3','price_category_4','price_category_5');
	
	static public $searchOptions=array('tag'=>self::$productTag, 'purchasetype'=>self::$purchaseType, 'limit','page', 'social_usage','competition_usage', 'color'=>self::$defaultAttributeDetails['color'], 'heel'=>self::$defaultAttributeDetails['color']['heel'], 'shoe_size', 'size','brand','origin','size_system'=>self::$defaultAttributeDetails['shoe_metric'],'pricecat'=>self::$priceCategory);
	
	//these are partials for attributes during display, customization, creation, and order;
	static public $attributeCategories = array ('shoes', 'fullbody','bottom','top', 'jewelry', 'accessories');
	
	$uploadMenuArray['Buy_now']['Women']['Shoes']=array('Ladies latin shoes','Ladies standard shoes','Ladies practice shoes');
	$uploadMenuArray['Buy_now']['Women']['Dresses']=array('Latin competition dress','Standard competition dress', 'Social and practice dress');
	$uploadMenuArray['Buy_now']['Women']['Skirts']=array('Latin skirt', 'Standard skirt');
	$uploadMenuArray['Buy_now']['Women']['Tops']=array('Ladies top');
	$uploadMenuArray['Customizable']['Women']['Shoes']=array('Ladies latin shoes','Ladies standard shoes','Ladies practice shoes');
	$uploadMenuArray['Customizable']['Women']['Dresses']=array('Latin competition dress','Standard competition dress', 'Social and practice dress');
	$uploadMenuArray['Customizable']['Women']['Skirts']=array('Latin skirt', 'Standard skirt');
	$uploadMenuArray['Customizable']['Women']['Tops']=array('Ladies top');
	$uploadMenuArray['Buy_now']['Men']['Shoes']=array('Men latin shoes', 'Men standard shoes', 'Men practice shoes');
	$uploadMenuArray['Buy_now']['Men']['Sets']=array('Suit', 'Tailsuit', 'Men costume');
	$uploadMenuArray['Buy_now']['Men']['Shirts']=array('Shirt');
	$uploadMenuArray['Buy_now']['Men']['Pants']=array('Pants');
	$uploadMenuArray['Buy_now']['Men']['Vests']=array('Vest');
	$uploadMenuArray['Buy_now']['Men']['Jackets']=array('Jacket');
	$uploadMenuArray['Customizable']['Men']['Shoes']=array('Men latin shoes', 'Men standard shoes', 'Men practice shoes');
	$uploadMenuArray['Customizable']['Men']['Sets']=array('Suit', 'Tailsuit', 'Men costume');
	$uploadMenuArray['Customizable']['Men']['Shirts']=array('Shirt');
	$uploadMenuArray['Customizable']['Men']['Pants']=array('Pants');
	$uploadMenuArray['Customizable']['Men']['Vests']=array('Vest');
	$uploadMenuArray['Customizable']['Men']['Jackets']=array('Jacket');
	$uploadMenuArray['Buy_now']['Jewelry']['Jewelry']=array('Jewelry set','Hair accessory','Earring','Necklace','Bracelet','Brooch');
	$uploadMenuArray['Customizable']['Jewelry']['Jewelry']=array('Jewelry set','Hair accessory','Earring','Necklace','Bracelet','Brooch');
	$uploadMenuArray['Buy_now']['Accessories']['Accessories']=array('Shoe brush','Heel protector','Sole','Bag','Robe','Belt');
	$uploadMenuArray['Customizable']['Accessories']['Accessories']=array('Shoe brush','Heel protector','Sole','Bag','Robe','Belt');
	static public $uploadMenuArrays = $uploadMenuArray;

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
	//
	$attributeTable['Ladies latin shoes']='shoes';
	$attributeTable['Ladies standard shoes']='shoes';
	$attributeTable['Ladies practice shoes']='shoes';
	$attributeTable['Men latin shoes']='shoes';
	$attributeTable['Men standard shoes']='shoes';
	$attributeTable['Men practice shoes']='shoes';
	$attributeTable['Latin competition dress']='fullbody';
	$attributeTable['Standard competition dress']='fullbody';
	$attributeTable['Social and practice dress']='fullbody';
	$attributeTable['Latin skirt']='bottom';
	$attributeTable['Standard skirt']='bottom';
	$attributeTable['Ladies top']='top';
	$attributeTable['Suit']='fullbody';
	$attributeTable['Tailsuit']='fullbody';
	$attributeTable['Men costume']='fullbody';
	$attributeTable['Shirt']='top';
	$attributeTable['Pants']='bottom';
	$attributeTable['Vest']='top';
	$attributeTable['Jacket']='top';
	$attributeTable['Jewelry set']='jewelry';
	$attributeTable['Hair accessory']='jewelry';
	$attributeTable['Earring']='jewelry';
	$attributeTable['Necklace']='jewelry';
	$attributeTable['Bracelet']='jewelry';
	$attributeTable['Brooche']='jewelry';
	$attributeTable['Shoe brush']='accessories';
	$attributeTable['Heel protector']='accessories';
	$attributeTable['Sole']='accessories';
	$attributeTable['Bag']='accessories';
	$attributeTable['Robe']='accessories';
	$attributeTable['Belt']='accessories';
	
	const public $attributeTables = $attributeTable;
	
	//These are system variables
	$defaultAttributeDetail['shoes']=array('size','heel');
	$defaultAttributeDetail['heel']=array('one_inch', 'one_half_inch', 'two_inch', 'two_half_inch', 'three_inch', 'three_half_inch', 'heel_50_mm', 'heel_70_mm', 'heel_90_mm');
	$defaultAttributeDetail['color']=array('Black','Pin_stripe', 'Light_tan', 'Dark_tan', 'Brown', 'Silver', 'Gold', 'Gray', 'White', 'Red', 'Pink', 'Orange', 'Yellow', 'Green', 'Cyan', 'Blue', 'Magenta', 'Purple');
	//these are system given variables to inventory dancewear
	$defaultAttributeDetail['fullbody']=array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Shoulder'=>array('min'=>20, 'max'=>60,'interval'=>1),'Chest or bust'=>array('min'=>40, 'max'=>120,'interval'=>1),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1),'Hip'=>array('min'=>45,'max'=>120,'interval'=>1), 'Length of garment'=>array('min'=>45,'max'=>130,'interval'=>1));
	$defaultAttributeDetail['bottom']=array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1),'Hip'=>(array('min'=>45,'max'=>120,'interval'=>1)), 'Length of garment'=>array('min'=>45,'max'=>130,'interval'=>1));
	$defaultAttributeDetail['top']=array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Shoulder'=>array('min'=>20, 'max'=>60,'interval'=>1),'Chest or bust'=>array('min'=>40, 'max'=>120,'interval'=>1),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1));
	$defaultAttributeDetail['jewelry']=array();
	$defaultAttributeDetail['accessories']=array();
	
	$defaultAttributeDetail['shoe_metric']=array('US','BR','EU');


	const public $defaultAttributeDetails=$defaultAttributeDetail;
	
	const public $attributeConversionDetails['heel_sizes']=array('one_inch'=>'1 inch', 'one_half_inch'=>'1.5 inch', 'two_inch'=>'2 inch', 'two_half_inch'=>'2.5 inch', 'three_inch'=>'3 inch', 'three_half_inch'=>'3.5 inch', 'heel_50_mm'=>'50 mm', 'heel_70_mm'=>'70 mm', 'heel_90_mm'=>'90 mm');
	
	const public $productOrderStatus =array('UNSHIPPED', 'SHIPPED', 'DELIVERED','RETURN_SHIPPED','RETURN_DELIVERED','ORDER_COMPLETED','RETURN_COMPLETED','BALANCE_UPDATED','BALANCE_REFUNDED','CANCELLED_BY_SELLER','CANCELLED_BY_BUYER', 'HELD_BY_BUYER_FOR_ARBITRATION','HELD_BY_BUYER_FOR_ARBITRATION_APPROVED','HELD_BY_BUYER_FOR_ARBITRATION_DENIED','HELD_BY_BUYER_FOR_ARBITRATION_DENIED_BY_SELLER', 'HELD_BY_SELLER_FOR_ARBITRATION','HELD_BY_SELLER_FOR_ARBITRATION_APPROVED','HELD_BY_SELLER_FOR_ARBITRATION_DENIED');
	
	$customizeOrderView['fullbody']=array('body_height','neck','arm_length','wrist','armpit_circumference','shoulder','chest_or_bust','shoulder_to_chest_or_bust','waist','shoulder_to_waist','hip','thigh_circumference','waist_to_floor','inseam');
	$customizeOrderView['bottom']=array('body_height','waist','hip','waist_to_floor','inseam');
	$customizeOrderView['top']=array('body_height','neck','arm_length','wrist','armpit_circumference','shoulder','chest_or_bust','shoulder_to_chest_or_bust','waist','shoulder_to_waist');

	const public $customizeOrderViews=$customizeOrderView;
	
}
?>