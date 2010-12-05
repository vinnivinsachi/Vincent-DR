<?php

class Application_Model_Stores_Store extends Custom_Model_Abstract implements Zend_Acl_Resource_Interface
{
	// setup
	protected $_primaryIDColumn = 'storeID';
	protected $_mapperClass = 'Application_Model_Mapper_Stores_StoresMapper';
	
	
	// columns
	public $storeID;
	public $storeUniqueID;
	public $storeName;
	public $storeDisplayName;
	public $dateCreated;
	public $defaultShippingAddressID;
	public $dateUpdated;
	public $storePhone;
	public $storeFax;
	public $storeEmail;

	
	// protected variables won't show up in SQL queries
	protected $shippingAddresses;
	protected $defaultShippingAddress;
	protected $userLinks; // for listing users associated with a store
	
	// used in ACL
	public function getResourceId() {
		return 'storeModel';
	}
}