<?php

class StoreController extends Custom_Zend_Controller_Action
{

//	public function init() {
//    	parent::init();  // Because this is a custom controller class
//    	$this->_ajaxContext->addActionContext('checkusername', 'json')
//    					   ->addActionContext('editbasicinfo', 'json')
//			 			   ->initContext();
//    }
    
	private function requireLoggedIn() {
    	if($this->_auth->hasIdentity()) {
			$this->usersMapper = new Application_Model_Mapper_Users_UsersMapper;
			// get user info
				$this->user = $this->usersMapper->findByUsername($this->loggedInUser->username);
		}
		else {
			$this->msg('Please login to view this page');
			$this->_helper->redirector('login', 'authentication');
		}
    }

    public function indexAction() {
       // need to check if user owns this store
    }
    
    
	public function profileAction() {
		$storeName = $this->_request->getQuery('storeName');
		
		// if no storeName is provided
			if(!isset($storeName) || $storeName == '') {
				$this->msg(array('error' => 'No storeName provided to view'));
				$this->_helper->redirector('index', 'index');
			}
		
		// get store info
			$storesMapper = new Application_Model_Mapper_Stores_StoresMapper;
			$store = $storesMapper->findByStoreName($storeName);
			
		// check is store exists
			if(!$store) {
				$this->msg(array('error' => 'There is no store with that storeName'));
				$this->_helper->redirector('index', 'index');
			}
			
		$this->view->store = $store;
	}


}

