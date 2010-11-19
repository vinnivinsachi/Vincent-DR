<?php

class Application_Model_Stores_Store extends Custom_Model_Abstract
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
	
}
