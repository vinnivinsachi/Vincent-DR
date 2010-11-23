<?php

class StoreController extends Custom_Zend_Controller_Action
{

	public function init() {
    	parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('editbasicinfo', 'json')
			 			   ->initContext();
    }
    
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
				if(!$this->store) $this->errorAndRedirect('Cannot find a store by that name');
		}
		else $this->errorAndRedirect('You must login to view this page', 'login', 'authentication');
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
			if(!isset($storeName) || $storeName == '') $this->errorAndRedirect('No storeName provided to view');
		
		// get store info
			$storesMapper = new Application_Model_Mapper_Stores_StoresMapper;
			$store = $storesMapper->findByStoreName($storeName);
			
		// check is store exists
			if(!$store) $this->errorAndRedirect('There is no store with that storeName');
						
		$this->view->store = $store;
	}
	
	public function detailsAction() {
		// set up the mappers and
		// get user and store info from database
			$this->getStoreAndUser();
			
		// check priveleges
			if(!$this->_acl->isAllowed($this->user, $this->store, 'manage')) $this->errorAndRedirect('You do not have priveleges to manage that store');
			
		// get list of users for that store
			$linkMapper = new Application_Model_Mapper_Stores_StoresUsersLinksMapper;
			$storeMemberIDs = $linkMapper->getUsersForStore($this->store->storeID, array('format' => 'userIDArray'));
			$storeUsers = $this->usersMapper->findByColumn('userID', $storeMemberIDs, array('include' => array('username', 'userUniqueID')));
			
		// attach the users to the store
			$this->store->members = $storeUsers;
			
		// send store to the view
			$this->view->store = $this->store;
	}
	
	public function editbasicinfoAction() {
		// set up the mappers and
		// get user and store info from database
			$this->getStoreAndUser();
			
		// check priveleges of user on the store
			if(!$this->_acl->isAllowed($this->user, $this->store, 'update')) $this->errorAndRedirect('You do not have priveleges to edit this store\'s info', 'details', 'store', array('storeName' => $this->_request->getParam('storeName')));
			
		// process the form if it was submitted
			if($this->isJsonContext()) {
				$request = $this->getRequest();
				$form = new Application_Form_Store_BasicInfo;
	
				if($form->isValid($request->getPost())) {
		               // save the store info
	               		$this->store->setOptions($form->getValues());
	                	$this->storesMapper->save($this->store);      
	               // display success message
	                	$this->view->jsFlashMessage = 'Changes have been successfully saved!';         	
	            }
				else $this->view->jsFlashMessage = 'Your submission was not valid'; // If form is NOT valid	
			}
			
		// send the store to the view
			$this->view->store = $this->store;
	}


}

