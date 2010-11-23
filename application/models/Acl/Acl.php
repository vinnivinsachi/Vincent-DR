<?php
class Application_Model_Acl_Acl extends Zend_Acl
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
	    	$this->addResource('store');
		//v	
			$this->addResource('test');

	    	
	    	$this->allow('guest', 'account', 'profile');
	    	$this->allow('member', 'account', 'details');
	    	$this->allow('member', 'account', 'deleteshipping');
	    	$this->allow('member', 'account', 'editbasicinfo');
	    	$this->allow('member', 'account', 'editshipping');
	    	$this->allow('member', 'account', 'index');
	    	$this->allow('member', 'account', 'setdefaultshipping');
	    	
	    	
	    	$this->allow('guest', 'authentication', 'login');
	    	$this->allow('member', 'authentication', 'logout');
	    	
	    	$this->allow('guest', 'error', 'error');
	    	
	    	$this->allow('guest', 'index', 'index');
	    	
	    	$this->allow('guest', 'register', 'checkusername');
	    	$this->allow('guest', 'register', 'index');
	    	
	    	$this->allow('guest', 'store', 'index');
	    	$this->allow('guest', 'store', 'profile');
	    	$this->allow('member', 'store', 'details');
	    	$this->allow('member', 'store', 'editbasicinfo');
	    	    	
	    	$this->allow('guest', 'test');
    	// Model Resources
    		$this->addResource('storeModel');
    		$this->addResource('userShippingAddressModel');
    		
    		$this->allow('member', 'storeModel', 'view', new Application_Model_Acl_Stores_UserAssertion);
    		$this->allow('member', 'storeModel', 'update', new Application_Model_Acl_Stores_UserAssertion);
    		$this->allow('member', 'storeModel', 'manage', new Application_Model_Acl_Stores_UserAssertion);
    		
    		$this->allow('member', 'userShippingAddressModel', 'create');
    		$this->allow('member', 'userShippingAddressModel', 'view', new Application_Model_Acl_Users_ShippingAddressAssertion);
    		$this->allow('member', 'userShippingAddressModel', 'update', new Application_Model_Acl_Users_ShippingAddressAssertion);
    		$this->allow('member', 'userShippingAddressModel', 'delete', new Application_Model_Acl_Users_ShippingAddressAssertion);
    		$this->allow('member', 'userShippingAddressModel', 'setAsDefault', new Application_Model_Acl_Users_ShippingAddressAssertion);
    		
    		
    		
    	// Allow admin to do anything
    		$this->allow('admin');
    		
	    	
	    	
	    	// ===============================>>>>>>>>>>>>>>> FOR TESTING, ALLOW EVERYTHING	!!!!!!!!!!!!!
							    							//$this->allow();
	}
}
