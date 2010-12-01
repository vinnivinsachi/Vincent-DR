<?php

class RegisterController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('checkusername', 'json')
    					   ->addActionContext('checkemail', 'json')
			 			   ->initContext();
    } // END init()
  

    public function indexAction() {
    	$form = new Application_Form_Register_Register;
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
            		$this->msg('Thank you for registering!');
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
    } // END indexAction()
    
    public function checkusernameAction() {
    	$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
    	$this->view->usernameAvailable = $usersMapper->usernameAvailable($this->_request->getParam('username'));    	
    } // END checkusernameAction()
    
    public function checkemailAction() {
    	$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
    	$this->view->emailAvailable = $usersMapper->emailAvailable($this->_request->getParam('email'));    	
    } // END checkemailAction()
    
    public function resetpasswordAction() {
    	// IF a form was submitted
    		if($this->_request->isPost()) {
    			// ELSE IF a new password form was subbmitted
    				if($this->_request->getParam('password')) {
    					// get the reset from the database
    						$reset = new Application_Model_Users_PasswordReset;
    						$resetMapper = new $reset->_mapperClass;
    						$email = $this->_request->getParam('email');
    						$uniqueID = $this->_request->getParam('resetUniqueID');
    						$options = array('include' => array('userEmail', 'expiration'));
    						$reset = $resetMapper->findByEmailAndUniqueID($email, $uniqueID, $options);
    						
    					// check the reset to make sure it exists
    						if($reset == null) $this->errorAndRedirect('Could not verify your email address, please make sure it is entered correctly', 'resetpassword', null, array('resetUniqueID' => $this->_request->getParam('resetUniqueID')));

    					// check timestamp
    						if(strtotime($reset->expiration) < time()) $this->errorAndRedirect('That password reset has already expired.  Please enter your email address to receive a new reset link', 'resetpassword');
    					
    					// get the user from the database
    						$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
    						$user = $usersMapper->findByEmail($this->_request->getParam('email'));
    						if($user == null) throw new Exception('Trying to reset a password for a user that doesn\'t exist');

    					// set the password and save the user
    						$user->password = $this->_request->getParam('password');
    						$usersMapper->save($user);
    						
    					// erase the reset from the database
    						$resetMapper->delete($reset->resetID);
    					
    					// send a confirmation email
    					print 'SEND CONFIRMATION EMAIL HERE...';
    					
    					// set the view
    						$this->view->newPasswordSet = true;
    				}
    			// ELSE IF an email form was submitted
    				else if($this->_request->getParam('email')) {
    					// create a new entry in the resetPasswordTable
		    				$reset = new Application_Model_Users_PasswordReset;
		    				$reset->userEmail = $this->_request->getParam('email');
		    				$resetMapper = new $reset->_mapperClass;
		    				$resetID = $resetMapper->save($reset);
		    			
		    			// send an email with the link to reset password
		    				$reset = $resetMapper->find($resetID);
		    				$resetLink = SITE_URL.SITE_ROOT.'/register/resetpassword?resetID='.$reset->resetUniqueID;
		    				print 'SEND MAIL HERE...';
		    			
		    			// set the view
    						$this->view->resetEmailSent = true;
    				} 				
    		}
    	// ELSE IF a reset link was clicked
    		else if($this->_request->getParam('resetUniqueID')) {
    			// get the reset info
    				$reset = new Application_Model_Users_PasswordReset;
    				$resetMapper = new $reset->_mapperClass;
    				$reset = $resetMapper->findByUniqueID($this->_request->getParam('resetUniqueID'));    				
    				
    			// make sure the reset exists and is not old
    				if($reset == null) $this->errorAndRedirect('This password reset has expired. Please enter your email address to receive a new reset link', 'resetpassword');
    				if(strtotime($reset->expiration) < time()) $this->errorAndRedirect('That password reset has already expired.  Please enter your email address to receive a new reset link', 'resetpassword');
    				
    			// send the reset to the view
    				$this->view->reset = $reset;
    				
    			// set the view
    				$this->view->resetLinkClicked = true;
    		}
    } // END resetpasswordAction()

}

