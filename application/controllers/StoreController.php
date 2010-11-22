<?php

class StoreController extends Custom_Zend_Controller_Action
{

//	public function init() {
//    	parent::init();  // Because this is a custom controller class
//    	$this->_ajaxContext->addActionContext('checkusername', 'json')
//    					   ->addActionContext('editbasicinfo', 'json')
//			 			   ->initContext();
//    }
    
	// checks for a logged in user and
    // sets $this->userMapper and fetches the user from the database and
    // sets $this->user
    private function getStoreAndUser() {
    	if($this->_auth->hasIdentity()) {
			// get user info
				$this->usersMapper = new Application_Model_Mapper_Users_UsersMapper;
				$this->user = $this->usersMapper->findByUsername($this->loggedInUser->username);
				
			// get store info
				$storeName = $this->_request->getParam('storeName');
				if(!isset($storeName)) $this->errorAndRedirect('No store was provided to the store controller');
				$this->storesMapper = new Application_Model_Mapper_Stores_StoresMapper;
				$this->store = $this->storesMapper->findByStoreName($storeName);
		}
		else throw new Exception ('No user is logged in');
    }

    public function indexAction() {
    	// get all stores
    		$storesMapper = new Application_Model_Mapper_Stores_StoresMapper;
    		$stores = $storesMapper->fetchAll();
    		
    	// pass to the view
    		$this->view->stores = $stores;
    }
    
    
	public function profileAction() {
		$storeName = $this->_request->getQuery('storeName');
		
		// if no storeName is provided
			if(!isset($storeName) || $storeName == '') $this->errorAndRedirect('No storeName provided to view', 'index', 'index');
		
		// get store info
			$storesMapper = new Application_Model_Mapper_Stores_StoresMapper;
			$store = $storesMapper->findByStoreName($storeName);
			
		// check is store exists
			if(!$store) $this->errorAndRedirect('There is no store with that storeName', 'index', 'index');
						
		$this->view->store = $store;
	}
	
	public function detailsAction() {
		// set up the mappers and
		// get user and store info from database
			$this->getStoreAndUser();
			
		// send to the view
			$this->view->store = $this->store;
	}


}

