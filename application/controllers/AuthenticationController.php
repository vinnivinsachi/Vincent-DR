<?php

class AuthenticationController extends Custom_Zend_Controller_Action
{

    public function init() {
        parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('changepassword', 'json')
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
        // Nothing...
    }
    
    public function loginAction() {
    	$form = new Application_Form_Authentication_Login;
        $request = $this->getRequest();
        // If form was submitted
        if($request->isPost()) {
        	// If form is valid
            if($form->isValid($request->getPost())) {
            	// jsFlashMessage and redirect to home page (authentication success)
                	if($this->_validLogin($form->getValues())) {
                		$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
                		$user = $usersMapper->findByUsername($this->_auth->getIdentity()->username);
                		$user->lastLogin = date('Y-m-d H:i:s');
                		$usersMapper->save($user);
                		$this->_helper->redirector('index', 'account');
                	}
                
                // Display error (authentication failure)
                	else $this->_helper->flashMessenger(array('error' => 'Incorrect username / password'));
            }
            // If form is NOT valid
            else $this->_helper->flashMessenger(array('error' => 'There were problems with your submission, please make sure javascript is enabled, and try again'));
        }
        $this->view->loginForm = $form;
    }
    
	public function logoutAction() {
        $this->logoutUser();
        $this->_helper->redirector('login', 'authentication'); // back to login page
    }
    
    // an ajax function to change the logged in user's password
    public function changepasswordAction() {
		// set up the usersMapper and
		// get the logged in user's info from the database
			$this->getLoggedInUser();
			
		// process the form if it was submitted
			if($this->isJsonContext()) {
				$request = $this->getRequest();
				$form = new Application_Form_Authentication_ChangePassword;
	
				if($form->isValid($request->getPost())) {
					// check the old password
						$adapter = self::_getAuthAdapter();
				        $adapter->setIdentity($this->user->username); // set username to check
				        $adapter->setCredential($form->getValue('oldPassword')); // set password to check
				        if(!$adapter->authenticate()->isValid()) {
				        	$this->view->jsFlashMessage = 'Could not verify your old password, please try again';
				        	return;
				        }
					
	            	// save the user info
	               		$this->user->setOptions($form->getValues());
	                	$this->usersMapper->save($this->user);      
	            	// display success message
	                	$this->view->jsFlashMessage = 'New password has been saved!';         	
	            }
				else $this->view->jsFlashMessage = 'Your submission was not valid'; // If form is NOT valid	
			}
			
	} // END changepasswordAction()
    
    
    // ---------------------------------- HELPER METHODS ------------------------------------
    
    // logout the current user
	private function logoutUser() {
    	Zend_Auth::getInstance()->clearIdentity();
    }
    
    // Are login credentials valid?
    private function _validLogin($values) {
    	// logout the current user if logged in
    		$this->logoutUser();
    		
    	// Get our authentication adapter and check credentials
        $adapter = self::_getAuthAdapter();
        $adapter->setIdentity($values['username']); // set username to check
        $adapter->setCredential($values['password']); // set password to check

        $result = $this->_auth->authenticate($adapter);
        if ($result->isValid()) {
            $this->_auth->getStorage()->write($adapter->getResultRowObject(array(
            	'username',
            	'uniqueID',
            	'role',
            	'email',
            	'firstName',
            	'lastName',
            )));
            return true;
        }
        return false;
    }
    
    // Get the Zend_Auth_Adapter using the current database connection type (probably PDO_MYSQL)
    private function _getAuthAdapter() {
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        
        $authAdapter->setTableName('users')
        			->setIdentityColumn('username')
        			->setCredentialColumn('password')
        			->setCredentialTreatment('SHA1(CONCAT(?,salt))');
        
        return $authAdapter;
    }


}

