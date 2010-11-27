<?php

class Application_Model_DbTable_Stores_StoresUsersLinks extends Zend_Db_Table_Abstract
{

    protected $_name = 'storesUsersLinks';
	protected $_primary = 'linkID';
	
//	protected $_referenceMap = array(
//		'Stores' => array(
//			'columns'		=> 'storeID',
//			'refTableClass'	=> 'Application_Model_DbTable_Stores_Stores',
//			'refColumns'	=> 'storeID'
//		),
//		'Users' => array(
//			'columns'		=> 'userID',
//			'refTableClass'	=> 'Application_Model_DbTable_Users_Users',
//			'refColumns'	=> 'userID'
//		)
//	);
	
	public $firstIDColumn = 'storeID';
	public $secondIDColumn = 'userID';

}
