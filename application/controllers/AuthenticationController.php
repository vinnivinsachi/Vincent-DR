<?php

class AuthenticationController extends Custom_Zend_Controller_Action
{

    public function init() {
        parent::init();  // Because this is a custom controller class
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
            	// redirect to home page (authentication success)
                if($this->_validLogin($form->getValues())) $this->_helper->redirector('index', 'account');
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

