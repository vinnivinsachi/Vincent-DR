<?php

class Application_Model_Stores_ShippingAddress extends Custom_Model_Abstract
{
	// setup
	protected $_primaryIDColumn = 'shippindAddressID';
	protected $_mapperClass = 'Application_Model_Mapper_Stores_ShippindAddressesMapper';
	
	// columns
	public $shippingAddressID;
	public $storeID;
	public $addressOne;
	public $addressTwo;
	public $city;
	public $state;
	public $country;
	public $zip;
	public $dateCreated;
	public $dateUpdated;

}

