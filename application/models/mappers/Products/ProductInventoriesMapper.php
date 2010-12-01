<?php

class Application_Model_Mapper_Products_ProductInventoriesMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Products_ProductInventories';
	protected $_modelClass = 'Application_Model_Products_ProductInventory';

		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
	
	public function save(Application_Model_Products_ProductInventory $productInventory) {
		//pre save
		//public $inventoryReference;
		//public $uniqueIdentifierForJS; need to set unique id;
		echo 'presave';
		$productInventory->productInventoryUniqueID = $this->createUniqueID();
		return parent::save($productInventory);
		//echo 'postsave';
		//post save
	}
}
?>