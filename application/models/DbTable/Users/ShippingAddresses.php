<?php

class Application_Model_DbTable_Users_ShippingAddresses extends Zend_Db_Table_Abstract
{

    protected $_name = 'usersShippingAddresses';
	protected $_primary = 'shippingAddressID';
	
	// table relationships
//	protected $_referenceMap = array(
//		'User' => array(
//			'columns'		=> 'userID',
//			'refTableClass'	=> 'Application_Model_DbTable_Users_Users',
//			'refColumns'	=> 'userID'
//		)
//	);

}

