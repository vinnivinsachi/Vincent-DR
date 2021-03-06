<?php

class Application_Model_Users_ShippingAddress extends Custom_Model_Abstract implements Zend_Acl_Resource_Interface
{
	// setup
	protected $_primaryIDColumn = 'shippingAddressID';
	protected $_mapperClass = 'Application_Model_Mapper_Users_ShippingAddressesMapper';
	
	// columns
	public $shippingAddressID;
	public $userID;
	public $addressOne;
	public $addressTwo;
	public $city;
	public $state;
	public $country;
	public $zip;
	public $dateUpdated;
	public $dateCreated;

	// used for ACL
	public function getResourceId() {
		return 'userShippingAddressModel';
	}
}

