<?php

class Application_Model_Mapper_Users_ShippingAddressesMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_ShippingAddresses';
	protected $_modelClass = 'Application_Model_Users_ShippingAddress';

	public function getShippingAddressesForUser(Application_Model_Users_User $user, array $options = null) {
		return $this->fetchByColumn('userID', $user->userID, $options);
	}
	
}

