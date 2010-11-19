<?php
class Application_Model_Acl extends Zend_Acl
{
	public function __construct() { 
		
		// rolls
	    	$this->addRole('guest');
	    	$this->addRole('member', 'guest');
	    	$this->addRole('admin', 'member');
    	
    	// deny all
    		$this->deny();
    	
    	// Controllers / Actions
    		$this->addResource('account');
    		$this->addResource('authentication');
    		$this->addResource('error');
	    	$this->addResource('index');
	    	$this->addResource('register');
	    	
	    	$this->allow('guest', 'account', 'profile');
	    	$this->allow('member', 'account', 'index');
	    	$this->allow('member', 'account', 'details');
	    	$this->allow('member', 'account', 'editbasicinfo');
	    	$this->allow('member', 'account', 'editshipping');
	    	$this->allow('member', 'account', 'setdefaultshipping');
	    	$this->allow('member', 'account', 'deleteshipping');
	    	$this->allow('admin', 'account');
	    	$this->allow('guest', 'authentication', 'login');
	    	$this->allow('member', 'authentication', 'logout');
	    	$this->allow('admin', 'authentication');
	    	$this->allow('guest', 'error', 'error');
	    	$this->allow('admin', 'error');
	    	$this->allow('guest', 'index', 'index');
	    	$this->allow('admin', 'index');
	    	$this->allow('guest', 'register', 'index');
	    	$this->allow('guest', 'register', 'checkusername');
	    	$this->allow('admin', 'register');
	    	    	
    	// Model Resources
    		//$this->addResource('userShippingAddress');
    		
    		//$this->allow('guest', 'userShippingAddress', 'view');
    		
	    	
	    	
	    	// ===============================>>>>>>>>>>>>>>> FOR TESTING, ALLOW EVERYTHING	!!!!!!!!!!!!!
							    							//$this->allow();
	}
}
