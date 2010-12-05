<?php

class Application_Model_SysConst_Products
{
	static public $productCategoryStructure = array('Women'=>
														array('Shoes'=>array(
																	'Ladies Latin shoes',
																	'Ladies standard shoes', 
																	'Ladies practice shoes'), 
															  'Dresses'=>array(
																	'Latin competition dress',
																	'Standard competition dress', 
																	'Social and practice dress'),
															  'Skirts' =>array(
																	'Latin skirts',
																	'Standard skirts'),
															  'Ladies tops'=>array('Ladies tops')),
													'Men' =>
														array('Shoes'=>array(
																	'Men Latin shoes',
																	'Men standard shoes',
																	'Men practice shoes'),
															  'Sets'=>array(
																	'Suits',
																	'Tailsuits',
																	'Costumes'),
															  'Shirts'=>array('Shirts'), 
															  'Pants'=>array('Pants'),
															  'Vests'=>array('Vests'),
															  'Jackets'=>array('Jackets')),
													'Jewelry' =>
														array('Jewelry sets'=>array('Jewelry sets'),
															  'Hair accessories'=>array('Hair accessories'),
															  'Earings'=>array('Earings'),
															  'Necklaces'=>array('Necklaces'),
															  'Bracelets'=>array('Bracelets'),
															  'Brooches'=>array('Brooches')),
													'Accessories'=>
														array('Shoe brushes'=>array('Shoe brushes'),
															  'Heel protectors'=>array('Heel protectors'),
															  'Soles'=>array('Soles'),
															  'Bags'=>array('Bags'),
															  'Robes'=>array('Robes'),
															  'Belts'=>array('Belts')));
	
	static public $sysBrands = array('Superdance', 'International', 'Rayrose', 'DanceNatruals','Stephanie Professionals', 'VEdance', 'SouldancerUSA', 'Chrissane', 'Veryfine', 'GoGo', 'Other');
	static public $sysColors = array('Black','Pin_stripe', 'Light_tan', 'Dark_tan', 'Brown', 'Silver', 'Gold', 'Gray', 'White', 'Red', 'Pink', 'Orange', 'Yellow', 'Green', 'Cyan', 'Blue', 'Magenta', 'Purple');
	static public $sysConditions = array('New', 'Like_new', 'Good');
	
	static public $sysShoeSizes = array('0','0.5','1','1.5','2','2.5','3','3.5','4','4.5','5',
									   '5.5','6','6.5','7','7.5','8','8.5','9','9.5','10','10.5',
									   '11','11.5','12','12.5','13','13.5','14','14.5','15','15.5',
									   '16','16.5','17','17.5','18','18.5','19','19.5','20','20.5',
									   '21','21.5','22','22.5','23','23.5','24','24.5','25','25.5',
									   '26','26.5','27','27.5','28','28.5','29','29.5','30','30.5',
									   '31','31.5','32','32.5','33','33.5','34','34.5','35','35.5',
									   '36','36.5','37','37.5','38','38.5','39','39.5','40','40.5',
									   '41','41.5','42','42.5','43','43.5','44','44.5','45','45.5',
									   '46','46.5','47','47.5','48','48.5','49','49.5','50','50.5');
									   	
	
	
	
	static public $priceCategory = array('price_category_1','price_category_2','price_category_3','price_category_4','price_category_5');
	
	
	//These are system variables
	
	
	static public $productOrderStatus =array('UNSHIPPED', 'SHIPPED', 'DELIVERED','RETURN_SHIPPED','RETURN_DELIVERED','ORDER_COMPLETED','RETURN_COMPLETED','BALANCE_UPDATED','BALANCE_REFUNDED','CANCELLED_BY_SELLER','CANCELLED_BY_BUYER', 'HELD_BY_BUYER_FOR_ARBITRATION','HELD_BY_BUYER_FOR_ARBITRATION_APPROVED','HELD_BY_BUYER_FOR_ARBITRATION_DENIED','HELD_BY_BUYER_FOR_ARBITRATION_DENIED_BY_SELLER', 'HELD_BY_SELLER_FOR_ARBITRATION','HELD_BY_SELLER_FOR_ARBITRATION_APPROVED','HELD_BY_SELLER_FOR_ARBITRATION_DENIED');
	
	static public $attributeTable = array('Ladies Latin shoes'=>'shoes', 
								'Ladies standard shoes'=>'shoes',
								'Ladies practice shoes'=>'shoes',
								'Men Latin shoes'=>'shoes',
								'Men standard shoes'=>'shoes',
								'Men practice shoes'=>'shoes',
								'Latin competition dress'=>'fullbody',
								'Standard competition dress'=>'fullbody',
								'Social and practice dress'=>'fullbody',
								'Latin skirts'=>'bottom',
								'Standard skirts'=>'bottom',
								'Ladies tops'=>'top',
								'Suits'=>'fullbody',
								'Tailsuits'=>'fullbody',
								'Men costumes'=>'fullbody',
								'Shirts'=>'top',
								'Pants'=>'bottom',
								'Vests'=>'top',
								'Jackets'=>'top',
								'Jewelry sets'=>'jewelry',
								'Hair accessory'=>'jewelry',
								'Earrings'=>'jewelry',
								'Necklaces'=>'jewelry',
								'Bracelets'=>'jewelry',
								'Brooches'=>'jewelry',
								'Shoe brushes'=>'accessories',
								'Heel protectors'=>'accessories',
								'Soles'=>'accessories',
								'Bags'=>'accessories',
								'Robes'=>'accessories',
								'Belts'=>'accessories'
	);
	
	static public $attributeCategories = array('shoes', 'fullbody','bottom','top', 'jewelry', 'accessories');
	
	
	static public $sysAttributeDetails = array('shoes'=>array('size','heel'), 
												   'heel'=>array('one_inch', 'one_half_inch', 'two_inch', 'two_half_inch', 'three_inch', 'three_half_inch', 'heel_50_mm', 'heel_70_mm', 'heel_90_mm'),
												   'color'=>array('Black','Pin_stripe', 'Light_tan', 'Dark_tan', 'Brown', 'Silver', 'Gold', 'Gray', 'White', 'Red', 'Pink', 'Orange', 'Yellow', 'Green', 'Cyan', 'Blue', 'Magenta', 'Purple'),
												   'fullbody'=>array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Shoulder'=>array('min'=>20, 'max'=>60,'interval'=>1),'Chest or bust'=>array('min'=>40, 'max'=>120,'interval'=>1),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1),'Hip'=>array('min'=>45,'max'=>120,'interval'=>1), 'Length of garment'=>array('min'=>45,'max'=>130,'interval'=>1)),
												   'bottom'=>array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1),'Hip'=>array('min'=>45,'max'=>120,'interval'=>1), 'Length of garment'=>array('min'=>45,'max'=>130,'interval'=>1)),
												   'top'=>array('Height of wearer'=>array('min'=>75,'max'=>250,'interval'=>5),'Shoulder'=>array('min'=>20, 'max'=>60,'interval'=>1),'Chest or bust'=>array('min'=>40, 'max'=>120,'interval'=>1),'Waist'=>array('min'=>45,'max'=>120,'interval'=>1)),
												   'jewelry'=>array(),
												   'accessories'=>array(),
											       'shoesMetricType'=>array('US','BR','EU')
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