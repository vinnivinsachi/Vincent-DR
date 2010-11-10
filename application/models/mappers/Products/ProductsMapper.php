<?php

class Application_Model_Mapper_Products_ProductsMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Products_Products';
	protected $_modelClass = 'Application_Model_Products_Product';
	
	public $profile=null;
	public $images = array();
		//inventory is actually buy now. 
	public $inventory = array();
	public $image_table;
		//public $product_id;
	public $username;
	public $inventoryTable = '';
		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
	const PRODUCT_STATUS_DRAFT = 'Unlisted';
	const PRODUCT_STATUS_LIVE = 'Listed';
	const PRODUCT_FLAGGED = 'FLAGGED';
	const PRODUCT_STATUS_UNLIST = 'Unlisted';
		
	
	public function save(Application_Model_Products_Product $product) {
		//pre save
		parent::save($product);
		//post save
	}
	
	
	
	
	
}