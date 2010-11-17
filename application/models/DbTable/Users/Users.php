<?php

class Application_Model_DbTable_Users_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
	protected $_primary = 'userID';
	public $uniqueIDColumn = 'userUniqueID';

}

