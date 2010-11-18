<?php

class Application_Model_Mapper_Products_ProductsMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Products_Products';
	protected $_modelClass = 'Application_Model_Products_Product';

		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
	
	
	public function save(Application_Model_Products_Product $product) {
		//pre save
		parent::save($product);
		//post save
	} 
	
	
}