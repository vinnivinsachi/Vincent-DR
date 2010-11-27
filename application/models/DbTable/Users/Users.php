<?php

class Application_Model_DbTable_Users_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
	protected $_primary = 'userID';
//	protected $_dependentTables = array('Application_Model_DbTable_Users_ShippingAddresses', 'Application_Model_DbTable_Stores_StoresUsersLinks');
	
	public $uniqueIDColumn = 'userUniqueID';
	
}

