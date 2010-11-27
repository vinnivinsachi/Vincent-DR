<?php

class Application_Model_Mapper_Stores_ShippingAddressesMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Stores_ShippingAddresses';
	protected $_modelClass = 'Application_Model_Stores_ShippingAddress';

	public function getShippingAddressesForStoreID($storeID, array $options = null) {
		return $this->findByColumn('storeID', $storeID, $options);
	}
	
}

