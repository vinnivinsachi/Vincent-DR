<?php

class Application_Model_Users_ShippingAddress extends Custom_Model_Abstract implements Zend_Acl_Resource_Interface
{
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

	
	public function getResourceId() {
		return 'userShippingAddressModel';
	}
}

