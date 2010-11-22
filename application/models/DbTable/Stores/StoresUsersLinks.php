<?php

class Application_Model_DbTable_Stores_StoresUsersLinks extends Zend_Db_Table_Abstract
{

    protected $_name = 'storesUsersLinks';
	protected $_primary = 'linkID';
	public $firstIDColumn = 'storeID';
	public $secondIDColumn = 'userID';

}

