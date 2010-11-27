<?php

class AccountController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('editbasicinfo', 'json')
			 			   ->initContext();
    }
    
    // checks for a logged in user and
    // sets $this->userMapper and fetches the user from the database and
    // sets $this->user
    private function getLoggedInUser() {
    	if($this->_auth->hasIdentity()) {
			$this->usersMapper = new Application_Model_Mapper_Users_UsersMapper;
			// get user info
				$this->user = $this->usersMapper->findByUsername($this->loggedInUser->username);
		}
		else throw new Exception ('No user is logged in');
    }

    public function indexAction() {
    	// index action
    }
    
	public function profileAction() {
		$username = $this->_request->getQuery('username');
		
		// if no username is provided
			if(!isset($username) || $username == '') $this->errorAndRedirect('No username provided to view', 'index', 'index');
		
		// get user info
			$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
			$user = $usersMapper->findByUsername($username);
			
		// check that user exists
			if(!$user) $this->errorAndRedirect('There is no user with that username', 'index', 'index');
			
		$this->view->user = $user;
	}
    
	public function detailsAction(){
		// set up the usersMapper and
		// get the logged in user's info from the database
			$this->getLoggedInUser();
		
		// get user's shipping addresses
			$shippingMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
			$this->user->shippingAddresses = $shippingMapper->getShippingAddressesForUser($this->user);
			
		// get the default shipping address if it exists
			$defaultShipping = null;
			foreach($this->user->shippingAddresses as $address) if($address->shippingAddressID == $this->user->defaultShippingAddressID) $defaultShipping = $address;
			$this->user->defaultShippingAddress = $defaultShipping;
			
		// get list of stores for this user
			$linksMapper = new Application_Model_Mapper_Stores_StoresUsersLinksMapper;
			$options = array('include' => array('linkRole', 'storeName', 'storeDisplayName'));
			$this->user->storeLinks = $linksMapper->fetchStoreLinksForUserID($this->user->userID, $options);
			
		// send the user to the view
			$this->view->user = $this->user;
	}
	
	public function editbasicinfoAction(){
		// set up the usersMapper and
		// get the logged in user's info from the database
			$this->getLoggedInUser();
		
		// send the user to the view
			$this->view->user = $this->user;
			
		// process the form if it was submitted
		if($this->isJsonContext()) {
			$request = $this->getRequest();
			$form = new Application_Form_Account_BasicInfo;

			if($form->isValid($request->getPost())) {
               // save the user info
               		$this->user->setOptions($form->getValues());
                	$this->usersMapper->save($this->user);      
               // display success message
                	$this->view->jsFlashMessage = 'Changes have been successfully saved!';         	
            }
			else $this->view->jsFlashMessage = 'Your submission was not valid'; // If form is NOT valid	
		}
	}
	
	public function editshippingAction() {
		// set up the usersMapper and
		// get the logged in user's info from the database
			$this->getLoggedInUser();
		
		$addressMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
		
		// if editing an existing shipping address
		if($this->_request->getQuery('shippingAddressID')) {
			$address = $addressMapper->find($this->_request->getQuery('shippingAddressID'));
			// if the address doesn't belong to logged in user
				if(!$this->_acl->isAllowed($this->user, $address, 'update')) $this->errorAndRedirect('You can only edit your own addresses!', 'details');
		}
		// if creating a new address
		else {
			$address = new Application_Model_Users_ShippingAddress(array('userID' => $this->user->userID));
			if(!$this->_acl->isAllowed($this->user, $address, 'create')) $this->errorAndRedirect('You cannot create new addresses', 'details');
		}
		
		// process the form if it was submitted
		if($this->_request->isPost()) {
			$request = $this->getRequest();
			$address->setOptions($request->getPost());
			$form = new Application_Form_Account_ShippingAddress;

			if($form->isValid($request->getPost())) {
            	// save the address and get the ID
                	$addressID = $addressMapper->save($address);
                	if(isset($address->shippingAddressID)) $addressID = $address->shippingAddressID;

                	// if chosen as default shipping address
                	if(isset($request->defaultShipping)) {
                		$this->user->setOptions(array('defaultShippingAddressID' => $addressID));
                		$this->usersMapper->save($this->user);
                	}
            	// display success message and redirect
                	$this->msg('Your address has been saved!'); 
                // redirect to account details page    
                	$this->_helper->redirector('details', 'account');    	
            }
			else $this->msg(array('error' => 'Your submission was not valid')); // If form is NOT valid	
		}
		
		$this->view->address = $address;
	}
	
	public function setdefaultshippingAction() {
		// set up the usersMapper and
		// get the logged in user's info from the database
			$this->getLoggedInUser();
		
		$addressID = $this->_request->getQuery('shippingAddressID');
		
		// if no id is provided
			if(!isset($addressID) || $addressID == '') $this->errorAndRedirect('No shipping address was chosen to set as the default address', 'details');
		
		// get the address from the database
			$addressMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
			$address = $addressMapper->find($addressID);
		
		// if couldn't find the address in the database
			if(!$address) $this->errorAndRedirect('Coun\'t find that shipping address', 'details');
			
		// make sure the user has priveleges to set this address as default
			if(!$this->_acl->isAllowed($this->user, $address, 'setAsDefault')) $this->errorAndRedirect('You do not have priveleges to set this address as your default', 'details');
		
		// update the user table
			$this->user->setOptions(array('defaultShippingAddressID' => $addressID));
	        $this->usersMapper->save($this->user);
        
	  	// success message
	    	$this->msg('New default shipping address has been saved');
		
		$this->_helper->redirector('details');
	}
	
	public function deleteshippingAction() {
		// set up the usersMapper and
		// get the logged in user's info from the database
			$this->getLoggedInUser();
			
		$addressID = $this->_request->getQuery('shippingAddressID');
		
		// if no id is provided
			if(!isset($addressID) || $addressID == '') $this->errorAndRedirect('No shipping address was chosen to delete', 'details');
		
		// get the address mapper and the requested address
			$addressMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
			$address = $addressMapper->find($addressID);
		
		// if couldn't find the address in the database
			if(!$address) $this->errorAndRedirect('Couldn\'t find that shipping address', 'details');
		
		// make sure the user has priveleges to delete this address
			if(!$this->_acl->isAllowed($this->user, $address, 'delete')) $this->errorAndRedirect('You do not have priveleges to delete this address', 'details');
		
		// delete the address
	        $addressMapper->delete($addressID);
	        
	    // success message
	        $this->msg('Your shipping address has been deleted');
        
        $this->_helper->redirector('details');
	}

}

