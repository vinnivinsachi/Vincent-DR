<?php

class StoreController extends Custom_Zend_Controller_Action
{

//	public function init() {
//    	parent::init();  // Because this is a custom controller class
//    	$this->_ajaxContext->addActionContext('checkusername', 'json')
//    					   ->addActionContext('editbasicinfo', 'json')
//			 			   ->initContext();
//    }

	public function preDispatch() {
    	parent::preDispatch();
    	if($this->_auth->hasIdentity()) {
			$this->usersMapper = new Application_Model_Mapper_Users_UsersMapper;
			// get user info
				$this->user = $this->usersMapper->findByUsername($this->loggedInUser->username);
		}
		else throw new Exception('User not logged in: In Store controller');
    }

    public function indexAction()
    {
        // action body
    }


}

