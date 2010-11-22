<?php
class Application_Model_Acl_Stores_UserAssertion implements Zend_Acl_Assert_Interface
{
	public function assert(Zend_Acl $acl,
						   Zend_Acl_Role_Interface $user = null,
						   Zend_Acl_Resource_Interface $store = null,
						   $privelege = null)
	{
		
		// can only do anything if the user owns the address
//		if($user->userID == $store->userID) return true;
//		else return false;
	}
}
