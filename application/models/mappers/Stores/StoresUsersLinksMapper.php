<?php

class Application_Model_Mapper_Stores_StoresUsersLinksMapper extends Custom_Model_Mapper_Link_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Stores_StoresUsersLinks';
	protected $_modelClass = 'Application_Model_Stores_StoresUsersLink';
	protected $_firstMapperClass = 'Application_Model_Mapper_Stores_StoresMapper';
	protected $_secondMapperClass = 'Application_Model_Mapper_Users_UsersMapper';
	
	
	// overwrite the function so we can have variable names that make sense
	public function findLink($storeID, $userID, array $options = null) {
		return parent::findLink($storeID,$userID, $options);
	}
	
	// returns an array of userID => linkRole
	public function getUsersForStore($storeID, array $options = null) {
		// get links
			$links = $this->getLinksForFirstID($storeID, $options);
		
		// if userIDArray format
			if($options['format'] == 'userIDArray') {
				$userIDs = array();
				foreach($links as $link) $userIDs[] = $link->userID;
				return $userIDs;
			}
		
		return $links;
	}
	
	
	// fetch all stores and rolls for a user
	public function fetchStoreLinksForUserID($userID, array $options = null) {
		// get columns for link table and stores table
			$linkColumns = $this->getColumns($options);
			$storesMapper = new $this->_firstMapperClass;			
			$storeColumns = $storesMapper->getColumns($options);

		return $this->fetchAllFirstsForSecondID($userID, $linkColumns, $storeColumns);
	}
	
	// fetch all users for a store
	public function fetchUserLinksForStoreID($storeID, array $options = null) {
		// get columns for link table and users table
			$linkColumns = $this->getColumns($options);
			$usersMapper = new $this->_secondMapperClass;
			$userColumns = $usersMapper->getColumns($options);

		return $this->fetchAllSecondsForFirstID($storeID, $linkColumns, $userColumns);
	}
}
