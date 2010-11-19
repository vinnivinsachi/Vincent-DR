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
	    	
	    	$this->allow('guest', 'authentication', 'login');
	    	$this->allow('member', 'authentication', 'logout');
	    	
	    	$this->allow('guest', 'error', 'error');
	    	
	    	$this->allow('guest', 'index', 'index');
	    	
	    	$this->allow('guest', 'register', 'index');
	    	$this->allow('guest', 'register', 'checkusername');
	    	    	
	    	
    	// Model Resources
    		$this->addResource('userShippingAddress');
    		
    		$this->allow('member', 'userShippingAddress', 'create');
    		$this->allow('member', 'userShippingAddress', 'view', new Application_Model_Acl_Users_ShippingAddressAssertion);
    		$this->allow('member', 'userShippingAddress', 'update', new Application_Model_Acl_Users_ShippingAddressAssertion);
    		$this->allow('member', 'userShippingAddress', 'delete', new Application_Model_Acl_Users_ShippingAddressAssertion);
    		$this->allow('member', 'userShippingAddress', 'setAsDefault', new Application_Model_Acl_Users_ShippingAddressAssertion);
    		
    		
    	// Allow admin to do anything
    		$this->allow('admin');
    		
	    	
	    	
	    	// ===============================>>>>>>>>>>>>>>> FOR TESTING, ALLOW EVERYTHING	!!!!!!!!!!!!!
							    							//$this->allow();
	}
}
