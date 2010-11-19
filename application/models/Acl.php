<?php
class Application_Model_Acl extends Zend_Acl
{
	public function __construct() { 
		   	
    	$this->addRole('guest');
    	$this->addRole('member', 'guest');
    	
    	// deny all
    		$this->deny();
    	
    	// Controllers / Actions
    		$this->addResource('error');
	    	$this->addResource('index');
	    	$this->addResource('authentication');
	    	
	    	$this->allow(null, 'error');
	    	$this->allow(null, 'authentication');
	    	$this->allow('member', 'index', 'index');
    	
    	
    	// Model Resources
    		//$this->addResource('userShippingAddress');
    		
    		//$this->allow('guest', 'userShippingAddress', 'view');
	}
}
