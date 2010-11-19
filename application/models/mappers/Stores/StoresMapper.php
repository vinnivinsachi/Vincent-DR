<?php

class Application_Model_Mapper_Stores_StoresMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Stores_Stores';
	protected $_modelClass = 'Application_Model_Stores_Store';
	
	
	public function save(Application_Model_Stores_Store $store) {
		if(is_array($store)) throw new Exception('Saving an array of stores is not yet supported');
				
		// new store defaults
		if(($uniqueID = $store->storeUniqueID) === null) {
			$store->storeUniqueID = $this->createUniqueID();
		}
		
		// create a nice store name for urls
			if(!isset($store->storeName)) $store->storeName = $this->createStoreName($store->storeDisplayName);			
		
		parent::save($store);
	}
	
	// is this storeName availabe to use?
	public function storeNameAvailable($storeName) {
		if($this->findByStoreName($storeName, array('include', array('storeName')))) return false;
		else return true;
	}
	
	// find a store by it's dashed storeName
	public function findByStoreName($storeName, array $options = null) {
		$stores = $this->findByColumn('storeName', $storeName, $options);
		if(count($stores) == 0) return null;
		if(count($stores) > 1) throw new Exception('More than one store found with the storeName: '.$storeName);
		return $stores[0];
	}
	
	// turn a nice display name into a url friendly and database indexible name
	public function createStoreName($displayName) {
		$displayName = strtolower($displayName);
		$displayName = trim($displayName);
		$displayName = str_replace('-', ' ', $displayName);
		while(strpos($displayName, '  ')) $displayName = str_replace('  ', ' ', $displayName);
		$displayName = str_replace(' ', '-', $displayName);
		
		return $displayName;
	}

}

