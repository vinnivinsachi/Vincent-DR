<?php

class Application_Model_Mapper_Products_ProductsMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Products_Products';
	public $_modelClass = 'Application_Model_Products_Product';

		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
	
	
	public function save(Application_Model_Products_Product $product) {
		//pre save
		
		echo 'presave';
		
		if(($uniqueID = $product->productUniqueID) === NULL) {
				$product->productUniqueID = $this->createUniqueID();
			}else{
				
				echo 'unique id is: '.$uniqueID;
			}
		return parent::save($product);
		//echo 'postsave';
		//post save
	} 
	
	
	
	
}
?>