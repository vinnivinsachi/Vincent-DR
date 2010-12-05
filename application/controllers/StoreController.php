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
		$storeName = $this->_request->getParam('storeName');
		
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
			
		// get shipping addresses for store
			$shippingMapper = new Application_Model_Mapper_Stores_ShippingAddressesMapper;
			$this->store->shippingAddresses = $shippingMapper->getShippingAddressesForStoreID($this->store->storeID);
			
		// get the default shipping address if it exists
			$defaultShipping = null;
			foreach($this->store->shippingAddresses as $address) if($address->shippingAddressID == $this->store->defaultShippingAddressID) $defaultShipping = $address;
			$this->store->defaultShippingAddress = $defaultShipping;	
					
		// get list of users for this store
			$linksMapper = new Application_Model_Mapper_Stores_StoresUsersLinksMapper;
			$options = array('include' => array('linkRole', 'username'));
			$this->store->userLinks = $linksMapper->fetchUserLinksForStoreID($this->store->storeID, $options);
			
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
	
	public function editshippingAction() {
		// set up the mappers and
		// get user and store info from database
			$this->getStoreAndUser();
		
		// check priveleges of user for store
			if(!$this->_acl->isAllowed($this->user, $this->store, 'manage')) $this->errorAndRedirect('You do not have priveleges to manage this store', 'details', null, array('storeName' => $this->store->storeName));
			
		// get the mapper
			$addressMapper = new Application_Model_Mapper_Stores_ShippingAddressesMapper;
		
		// if editing an existing shipping address
			if($this->_request->getQuery('storeShippingAddressID')) {
				$address = $addressMapper->find($this->_request->getQuery('storeShippingAddressID'));
			}
		// if creating a new address
			else {
				$address = new Application_Model_Stores_ShippingAddress(array('storeID' => $this->store->storeID));
				if(!$this->_acl->isAllowed($this->user, $this->store, 'manage')) $this->errorAndRedirect('You cannot create new addresses for this store', 'details', null, array('storeName' => $this->store->storeName));
			}
		
		// process the form if it was submitted
		if($this->_request->isPost()) {
			$request = $this->getRequest();
			$address->setOptions($request->getPost());
			$form = new Application_Form_Store_ShippingAddress;

			if($form->isValid($request->getPost())) {
            	// save the address and get the ID
                	$addressID = $addressMapper->save($address);
                	if(isset($address->shippingAddressID)) $addressID = $address->shippingAddressID;

                // if chosen as default shipping address
                	if(isset($request->defaultShipping)) {
                		$this->store->setOptions(array('defaultShippingAddressID' => $addressID));
                		$this->storesMapper->save($this->store);
                	}
            	// display success message and redirect
                	$this->msg('The address has been saved!'); 
                // redirect to store details page
                	$this->redirect('details', 'store', array('storeName' => $this->store->storeName));    	
            }
			else $this->msg(array('error' => 'Your submission was not valid')); // If form is NOT valid	
		}
		
		// send the address to the view
			$this->view->address = $address;
			
		// send the store to the view
			$this->view->store = $this->store;
	}
	
	public function setdefaultshippingAction() {
		// set up the mappers and
		// get user and store info from database
			$this->getStoreAndUser();
		
		// get the shippingAddressID
			$addressID = $this->_request->getQuery('storeShippingAddressID');
		
		// if no id is provided
			if(!isset($addressID) || $addressID == '') $this->errorAndRedirect('No shipping address was chosen to set as the default address', 'details', null, array('storeName' => $this->store->storeName));
		
		// get the address from the database
			$addressMapper = new Application_Model_Mapper_Stores_ShippingAddressesMapper;
			$address = $addressMapper->find($addressID);
		
		// if couldn't find the address in the database
			if(!$address) $this->errorAndRedirect('Coun\'t find that shipping address', 'details', null, array('storeName' => $this->store->storeName));
			
		// make sure the user has priveleges to set this address as default
			if(!$this->_acl->isAllowed($this->user, $this->store, 'manage')) $this->errorAndRedirect('You do not have priveleges to manage thie store\'s addresses', 'details', null, array('storeName' => $this->store->storeName));
		
		// update the store table
			$this->store->setOptions(array('defaultShippingAddressID' => $addressID));
	        $this->storesMapper->save($this->store);
        
	  	// success message
	    	$this->msg('New default shipping address has been saved');
		
	    // redirect back to store details page
			$this->redirect('details', null, array('storeName' => $this->store->storeName));
	}
	
	public function deleteshippingAction() {
		// set up the mappers and
		// get user and store info from database
			$this->getStoreAndUser();
			
		// get the shippingAddressID
			$addressID = $this->_request->getQuery('storeShippingAddressID');
		
		// if no id is provided
			if(!isset($addressID) || $addressID == '') $this->errorAndRedirect('No shipping address was chosen to delete', 'details', null, array('storeName' => $this->store->storeName));
		
		// get the address mapper and the requested address
			$addressMapper = new Application_Model_Mapper_Stores_ShippingAddressesMapper;
			$address = $addressMapper->find($addressID);
		
		// if couldn't find the address in the database
			if(!$address) $this->errorAndRedirect('Couldn\'t find that shipping address', 'details', null, array('storeName' => $this->store->storeName));
		
		// make sure the user has priveleges to delete this address
			if(!$this->_acl->isAllowed($this->user, $this->store, 'manage')) $this->errorAndRedirect('You do not have priveleges to delete this address', 'details', null, array('storeName' => $this->store->storeName));
		
		// delete the address
	        $addressMapper->delete($addressID);
	        
	    // success message
	        $this->msg('The shipping address has been deleted', null, array('storeName' => $this->store->storeName));
        
	    // redirect back to the store details page
	    	$this->redirect('details', 'store', array('storeName' => $this->store->storeName));
	}


}

