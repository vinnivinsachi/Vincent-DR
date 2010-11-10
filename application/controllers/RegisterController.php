<?php

class RegisterController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('checkusername', 'json')
			 ->initContext();
    }
  

    public function indexAction() {
    	$form = new Application_Form_Account_Register;
    	$request = $this->getRequest();
    	// If form was submitted
        if($request->isPost()) {
        	// If form is valid
            if($form->isValid($request->getPost())) {
            	$user = new Application_Model_Users_User($form->getValues());
            	$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
            	if(!$usersMapper->usernameAvailable($user->username)) $this->_helper->flashMessenger(array('error' => 'That username is not available, please choose a new one'));
            	else {
            		$usersMapper->save($user);
	            	// Forward to authentication/login
	            	$request->setControllerName('authentication')
					        ->setActionName('login')
					        ->setDispatched(false);
            	}
            }
            // If form is NOT valid display errors
            //else $this->_helper->flashMessenger(array('error' => 'There were problems with your submission, please make sure javascript is enabled, and try again'));
            else throw new Exception(print_r($form->getMessages()));
        }
    }
    
    public function checkusernameAction() {
    	$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
    	$this->view->available = $usersMapper->usernameAvailable($this->_request->getParam('username'));    	
    }

}

