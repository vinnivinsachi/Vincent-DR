<?php

class Application_Model_DbTable_Examples extends Zend_Db_Table_Abstract
{

    protected $_name = 'exampleProfiles';
	protected $_primary = 'profileID';
	public $associatedObjectIDColumn = 'userID';

}

