<?php

class Application_Model_SysConst_Products extends Custom_Model_Abstract
{
	static public $productBrands = array('Superdance', 'International', 'Rayrose', 'DanceNatruals','Stephanie Professionals', 'BDdance', 'SouldancerUSA', 'Chrissane', 'Veryfine', 'GoGo', 'Other');
	
	static public $purchaseType = array('Buy_now', 'Customizable');
	
	static public $productMainCategory = array('Women','Men', 'Jewelry','Accessories');
	
	static public $productTag = array('Ladies latin shoes','Ladies standard shoes','Ladies practice shoes','Latin competition dress','Standard competition dress','Social and practice dress','Latin skirt','Standard skirt','Ladies top','Men latin shoes','Men standard shoes','Men practice shoes','Suit','Tailsuit','Men costume','Shirt','Pants','Vest','Jacket','Jewelry set','Hair accessory','Earring','Necklace','Bracelet','Brooch','Shoe brush','Heel protector','Sole','Bag','Robe','Belt');
	
	static public $priceCategory = array('price_category_1','price_category_2','price_category_3','price_category_4','price_category_5');
	
	//These are system variables
	
	
	static public $productOrderStatus =array('UNSHIPPED', 'SHIPPED', 'DELIVERED','RETURN_SHIPPED','RETURN_DELIVERED','ORDER_COMPLETED','RETURN_COMPLETED','BALANCE_UPDATED','BALANCE_REFUNDED','CANCELLED_BY_SELLER','CANCELLED_BY_BUYER', 'HELD_BY_BUYER_FOR_ARBITRATION','HELD_BY_BUYER_FOR_ARBITRATION_APPROVED','HELD_BY_BUYER_FOR_ARBITRATION_DENIED','HELD_BY_BUYER_FOR_ARBITRATION_DENIED_BY_SELLER', 'HELD_BY_SELLER_FOR_ARBITRATION','HELD_BY_SELLER_FOR_ARBITRATION_APPROVED','HELD_BY_SELLER_FOR_ARBITRATION_DENIED');
	
	static public $attributeTable = array('Ladies latin shoes'=>'shoes', 
								'Ladies standard shoes'=>'shoes',
								'Ladies practice shoes'=>'shoes',
								'Men latin shoes'=>'shoes',
								'Men standard shoes'=>'shoes',
								'Men practice shoes'=>'shoes',
								'Latin competition dress'=>'fullbody',
								'Standard competition dress'=>'fullbody',
								'Social and practice dress'=>'fullbody',
								'Latin skirt'=>'bottom',
								'Standard skirt'=>'bottom',
								'Ladies top'=>'top',
								'Suit'=>'fullbody',
								'Tailsuit'=>'fullbody',
								'Men costume'=>'fullbody',
								'Shirt'=>'top',
								'Pants'=>'bottom',
								'Vest'=>'top',
								'Jacket'=>'top',
								'Jewelry set'=>'jewelry',
								'Hair accessory'=>'jewelry',
								'Earring'=>'jewelry',
								'Necklace'=>'jewelry',
								'Bracelet'=>'jewelry',
								'Brooche'=>'jewelry',
								'Shoe brush'=>'accessories',
								'Heel protector'=>'accessories',
								'Sole'=>'accessories',
								'Bag'=>'accessories',
								'Robe'=>'accessories',
								'Belt'=>'accessories'
	);
	
	static public $attributeCategories = array('shoes', 'fullbody','bottom','top', 'jewelry', 'accessories');
	
	
	static public $defaultAttributeDetails = array('shoes'=>array('size','heel'), 
												   'heel'=>array('one_inch', 'one_half_inch', 'two_inch', 'two_half_inch', 'three_inch', 'three_half_inch', 'heel_50_mm', 'heel_70_mm', 'heel_90_mm'),
												   'color'=>array('Black','Pin_stripe', 'Light_tan', 'Dark_tan', 'Brown', 'Silver', 'Gold', 'Gray', 'White', 'Red', 'Pink', 'Orange', 'Yellow', 'Green', 'Cyan', 'Blue', 'Magenta', 'Purple'),
												   'fullbody'=>array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Shoulder'=>array('min'=>20, 'max'=>60,'interval'=>1),'Chest or bust'=>array('min'=>40, 'max'=>120,'interval'=>1),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1),'Hip'=>array('min'=>45,'max'=>120,'interval'=>1), 'Length of garment'=>array('min'=>45,'max'=>130,'interval'=>1)),
												   'bottom'=>array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1),'Hip'=>array('min'=>45,'max'=>120,'interval'=>1), 'Length of garment'=>array('min'=>45,'max'=>130,'interval'=>1)),
												   'top'=>array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Shoulder'=>array('min'=>20, 'max'=>60,'interval'=>1),'Chest or bust'=>array('min'=>40, 'max'=>120,'interval'=>1),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1)),
												   'jewelry'=>array(),
												   'accessories'=>array(),
											       'shoe_metric'=>array('US','BR','EU')
	);
	
	
	
	static public function uploadMenuArray(){
		$uploadMenuArray=array();
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
	
		return $uploadMenuArray;
	}
	
	static public function customizeOrderViews(){
	$customizeOrderView['fullbody']=array('body_height','neck','arm_length','wrist','armpit_circumference','shoulder','chest_or_bust','shoulder_to_chest_or_bust','waist','shoulder_to_waist','hip','thigh_circumference','waist_to_floor','inseam');
	$customizeOrderView['bottom']=array('body_height','waist','hip','waist_to_floor','inseam');
	$customizeOrderView['top']=array('body_height','neck','arm_length','wrist','armpit_circumference','shoulder','chest_or_bust','shoulder_to_chest_or_bust','waist','shoulder_to_waist');

		return $customizeOrderView;
	}
	
	
	static public $allowedPurchaseType = array('storeSeller'=>array('Customizable', 'Buy_now'),
											   'generalSeller'=>array('Buy_now')
	);
	
	
	
	static public function 	attributeConversionDetails(){
		$details['heel_sizes']=array('one_inch'=>'1 inch', 'one_half_inch'=>'1.5 inch', 'two_inch'=>'2 inch', 'two_half_inch'=>'2.5 inch', 'three_inch'=>'3 inch', 'three_half_inch'=>'3.5 inch', 'heel_50_mm'=>'50 mm', 'heel_70_mm'=>'70 mm', 'heel_90_mm'=>'90 mm');
		return $attributeConversionDetails=$details;
	}
	
}
?>