<?php

class Application_Model_Mapper_Products_ProductColorsMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Products_ProductColors';
	protected $_modelClass = 'Application_Model_Products_ProductColor';

		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
	
	
	public function save(Application_Model_Products_ProductColor $productColor) {
		//pre save
		
		echo 'presave';
		return parent::save($productColor);
		
	} 
}
?>