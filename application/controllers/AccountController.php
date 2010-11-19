<?php

class AccountController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('checkusername', 'json')
    					   ->addActionContext('editbasicinfo', 'json')
			 			   ->initContext();
    }
    
    public function preDispatch() {
    	parent::preDispatch();
    	if($this->_auth->hasIdentity()) {
			$this->usersMapper = new Application_Model_Mapper_Users_UsersMapper;
			// get user info
				$this->user = $this->usersMapper->findByUsername($this->loggedInUser->username);
		}
		else throw new Exception('User not logged in: In Account controller');
    }

    public function indexAction() {
        // action body
    }
    
	public function detailsAction(){
		
		// get user's shipping addresses
			$shippingMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
			$this->user->shippingAddresses = $shippingMapper->getShippingAddressesForUser($this->user);
		// get the default shipping address if it exists
			$defaultShipping = null;
			foreach($this->user->shippingAddresses as $address) if($address->shippingAddressID == $this->user->defaultShippingAddressID) $defaultShipping = $address;
			$this->user->defaultShippingAddress = $defaultShipping;
			
		// send the user to the view
			$this->view->user = $this->user;
	}
	
	public function editbasicinfoAction(){
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
		$addressMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
		
		// if editing an existing shipping address
		if($this->_request->getQuery('shippingAddressID')) {
			$address = $addressMapper->find($this->_request->getQuery('shippingAddressID'));
			// if the address doesn't belong to logged in user
				if($address->userID != $this->user->userID) {
					$this->msg(array('error' => 'You can only edit your own addresses!'));
					$this->_helper->redirector('details');
				}
		}
		// if creating a new address
		else $address = new Application_Model_Users_ShippingAddress(array('userID' => $this->user->userID));
		
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
		$addressID = $this->_request->getQuery('shippingAddressID');
		
		// if no id is provided
			if(!isset($addressID) || $addressID == '') {
				$this->msg(array('error' => 'No shipping address was chosen to set as default'));
				$this->_helper->redirector('details');
			}
		
		$addressMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
		$address = $addressMapper->find($addressID);
		
		// if couldn't find the address in the database
			if(!$address) {
				$this->msg(array('error' => 'Couldn\' find that shipping address'));
				$this->_helper->redirector('details');
			}
			
		// if the address doesn't belong to logged in user
			if($address->userID != $this->user->userID) {
				$this->msg(array('error' => 'You can only delete your own addresses!'));
				$this->_helper->redirector('details');
			}
		
		// if it belongs to the logged in user
		$this->user->setOptions(array('defaultShippingAddressID' => $addressID));
        $this->usersMapper->save($this->user);
        $this->msg('New default shipping address has been saved');
		
		$this->_helper->redirector('details');
	}
	
	public function deleteshippingAction() {		
		$addressID = $this->_request->getQuery('shippingAddressID');
		
		// if no id is provided
			if(!isset($addressID) || $addressID == '') {
				$this->msg(array('error' => 'No shipping address was chosen to delete'));
				$this->_helper->redirector('details');
			}
		
		// get the address mapper and the requested address
		$addressMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
		$address = $addressMapper->find($addressID);
		
		// if couldn't find the address in the database
			if(!$address) {
				$this->msg(array('error' => 'Couldn\' find that shipping address'));
				$this->_helper->redirector('details');
			}
		
		// if the address doesn't belong to logged in user
			if($address->userID != $this->user->userID) {
				$this->msg(array('error' => 'You can only delete your own addresses!'));
				$this->_helper->redirector('details');
			}
		
		// if it belongs to the logged in user
        $addressMapper->delete($addressID);
        $this->msg('Your shipping address has been deleted');
        
        $this->_helper->redirector('details');
	}


}

