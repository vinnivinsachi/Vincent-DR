<?php

class Application_Model_Stores_Store extends Custom_Model_Abstract implements Zend_Acl_Resource_Interface
{
	
	public $storeID;
	public $storeUniqueID;
	public $storeName;
	public $storeDisplayName;
	public $dateCreated;
	public $defaultShippingAddressID;
	public $dateUpdated;

	
	// private variables won't show up in SQL queries
	protected $shippingAddresses;
	protected $defaultShippingAddress;
	protected $members;
	
	public function getResourceId() {
		return 'storeModel';
	}
}
