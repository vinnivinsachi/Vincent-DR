<?php
class Application_Model_Acl_Stores_UserAssertion implements Zend_Acl_Assert_Interface
{
	public function assert(Zend_Acl $acl,
						   Zend_Acl_Role_Interface $user = null,
						   Zend_Acl_Resource_Interface $store = null,
						   $privelege = null)
	{
		
		// check for a link in the link table
			$linksMapper = new Application_Model_Mapper_Stores_StoresUsersLinksMapper;
			$link = $linksMapper->findLink($store->storeID, $user->userID);
			if(!$link) return false;
		
		// check for certain priveleges based on linkRole
			if($privelege == 'update') if($link->linkRole != 'admin') return false;
						
		return true;
	}
}
