<?php

class Application_Model_DbTable_Users_PasswordResets extends Zend_Db_Table_Abstract
{

    protected $_name = 'usersPasswordResets';
	protected $_primary = 'resetID';
	
	public $uniqueIDColumn = 'resetUniqueID';
	
}

