<?php

class Application_Model_Mapper_Stores_StoresUsersLinksMapper extends Custom_Model_Mapper_Link_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Stores_StoresUsersLinks';
	protected $_modelClass = 'Application_Model_Stores_StoresUsersLink';
	
	
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
	
	public function getStoresForUser($userID, array $options = null) {
		// get links
			$links = $this->getLinksForSecondID($userID, $options);
		
		// if storeIDArray format
			if($options['format'] == 'storeIDArray') {
				$storeIDs = array();
				foreach($links as $link) $storeIDs[] = $link->storeID;
				return $storeIDs;
			}
			
		return $links;
	}
}
