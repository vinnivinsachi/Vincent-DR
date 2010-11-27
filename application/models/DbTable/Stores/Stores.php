<?php

class Application_Model_DbTable_Stores_Stores extends Zend_Db_Table_Abstract
{

    protected $_name = 'stores';
	protected $_primary = 'storeID';
//	protected $_dependentTables = array('Application_Model_DbTable_Stores_StoresUsersLinks');
	
	public $uniqueIDColumn = 'storeUniqueID';

}

