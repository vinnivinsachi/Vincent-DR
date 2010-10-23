<?php
	class CustomControllerAclManager extends Zend_Controller_Plugin_abstract
	{
		// default  user role if not logged or (or invalid role found)
		private $_defaultRole = 'guest';
		//the action to dispatch if a user doesn't have sufficient privileges
		//which is directing to login specific areas. //ahah!!!!! here is the 
		//part that direct people to when they don't have sufficient privileges.
		private $_authController = array('controller' => 'account', 'action' => 'login');
		
		public function __construct(Zend_Auth $auth)
		{
			$this->auth = $auth;
			$this->acl = new Zend_Acl();
			
			//add the different user roles
			$this->acl->addRole(new Zend_Acl_Role($this->_defaultRole));
			$this->acl->addRole(new Zend_Acl_Role('member'));
			$this->acl->addRole(new Zend_Acl_Role('admin'));
			$this->acl->addRole(new Zend_Acl_Role('generalSeller'));
			$this->acl->addRole(new Zend_Acl_Role('storeSeller'));
			
			//add the resources we want to have control over
			$this->acl->add(new Zend_Acl_Resource('account'));
			$this->acl->add(new Zend_Acl_Resource('accountbalance'));
			$this->acl->add(new Zend_Acl_Resource('registration'));
			$this->acl->add(new Zend_Acl_Resource('adminaccount')); //need to work on later
			$this->acl->add(new Zend_Acl_Resource('adminproduct'));
			$this->acl->add(new Zend_Acl_Resource('productlisting'));
			$this->acl->add(new Zend_Acl_Resource('comparechart'));
			$this->acl->add(new Zend_Acl_Resource('manageattribute'));
			$this->acl->add(new Zend_Acl_Resource('manageinventory'));
			$this->acl->add(new Zend_Acl_Resource('userproductlisting'));
			$this->acl->add(new Zend_Acl_Resource('productpreview'));
			$this->acl->add(new Zend_Acl_Resource('productcategorymanager'));
			$this->acl->add(new Zend_Acl_Resource('inventorymanager'));
			$this->acl->add(new Zend_Acl_Resource('checkout'));
			$this->acl->add(new Zend_Acl_Resource('ordermanager'));
			$this->acl->add(new Zend_Acl_Resource('communication'));
			$this->acl->add(new Zend_Acl_Resource('adminuserrequest'));
			$this->acl->add(new Zend_Acl_Resource('adminorders'));
			
			//allow access to everything for all users by default
			$this->acl->allow();
			//deny all to a certain controller
			$this->acl->deny(null,'account');
			$this->acl->deny(null, 'accountbalance');
			$this->acl->deny(null, 'adminaccount');
			$this->acl->deny(null, 'adminproduct');
			$this->acl->deny(null, 'adminorders');
			$this->acl->deny(null, 'productlisting');
			$this->acl->deny(null, 'manageattribute');
			$this->acl->deny(null, 'manageinventory');
			$this->acl->deny(null, 'userproductlisting');
			$this->acl->deny(null, 'productpreview');
			$this->acl->deny(null, 'productcategorymanager');
			$this->acl->deny(null, 'inventorymanager');
			$this->acl->deny(null, 'checkout');
			$this->acl->deny(null, 'ordermanager');
			$this->acl->deny(null, 'communication');
			$this->acl->deny('guest', 'comparechart', array('savecomparelist'));
			//rewrite specific user management controls
			$this->acl->allow('guest', 'account', array('login', 'fetchpassword' ,'logout', 'verifyselleraccount'));
			$this->acl->allow('member', 'account', array('index', 'login', 'fetchpassword' ,'logout', 'verifyselleraccount', 'messages', 'details', 'rewardpoints', 'editbasicinfo', 'editshipping', 'deleteshipping', 'makedefaultshipping', 'upgradegeneralseller', 'upgradestoreseller', 'uploadmeasurement', 'images', 'verifyselleraccount'));
			$this->acl->allow('generalSeller', 'account');
			$this->acl->allow('storeSeller', 'account');
			$this->acl->allow('member', 'accountbalance');
			$this->acl->allow('generalSeller', 'accountbalance');
			$this->acl->allow('storeSeller', 'accountbalance');
			$this->acl->allow('admin','accountbalance');
			$this->acl->allow('admin', 'account');
			$this->acl->allow('guest', 'productpreview', array('index', 'tag', 'details', 'ajaxtesttwo'));
			$this->acl->allow('member', 'productpreview', array('index', 'tag', 'details', 'ajaxtesttwo'));
			$this->acl->allow('generalSeller', 'productpreview');
			$this->acl->allow('storeSeller', 'productpreview');
			$this->acl->allow('admin', 'productpreview');
			$this->acl->allow('admin', 'manageattribute');
			$this->acl->allow('storeSeller','manageattribute');
			$this->acl->allow('admin','manageinventory');
			$this->acl->allow('storeSeller', 'manageinventory');
			$this->acl->allow('generalSeller', 'manageinventory');


			$this->acl->allow('member', 'checkout');
			$this->acl->allow('generalSeller', 'checkout');
			$this->acl->allow('storeSeller', 'checkout');
			$this->acl->allow('admin', 'checkout');
			$this->acl->allow('member', 'ordermanager', array('index','orders', 'completeorder', 'addtrackingtoreturnproduct', 'ordercancellationbybuyer', 'writereview'));
			$this->acl->allow('generalSeller', 'ordermanager', array('index','orders', 'soldorders','completeorder', 'addtrackingtoreturnproduct', 'ordercancellationbybuyer', 'writereview','addtrackingtoproduct'));
			$this->acl->allow('storeSeller', 'ordermanager', array('index','orders', 'soldorders','completeorder', 'addtrackingtoreturnproduct', 'ordercancellationbybuyer', 'writereview','addtrackingtoproduct'));
			$this->acl->allow('admin', 'ordermanager');
			$this->acl->allow('guest', 'communication');
			$this->acl->allow('member', 'communication');
			$this->acl->allow('generalSeller', 'communication');
			$this->acl->allow('storeSeller', 'communication');
			$this->acl->allow('admin', 'communication');
			
			$this->acl->allow('generalSeller', 'productlisting', array('index', 'editbuynowproduct', 'uploadbuynowproduct', 'editproduct','productlistingpreview','markproductasnew','removeproductasnew','sendproductlive','sendproductdraft','viewpendingproduct','images'));
			$this->acl->allow('storeSeller', 'productlisting');
			$this->acl->allow('admin', 'productlisting');
			
			$this->acl->allow('admin', 'adminaccount');
			$this->acl->allow('admin', 'adminproduct');
			$this->acl->allow('admin', 'adminuserrequest');
			$this->acl->allow('admin', 'adminorders');
			//$this->acl->allow('storeSeller', 'productcategorymanager');
			
			$this->acl->allow('storeSeller', 'inventorymanager');
			$this->acl->allow('generalSeller', 'inventorymanager');
		}
		
		
		/**
		* preDispatch
		* Before an actino is dispatched, check if the current user has sufficient privileges. If not, disptch the default action instead. 
		* @param Zend_Controller_Request_Abstract $request
		*/
		public function preDispatch(Zend_Controller_Request_Abstract $request)
		{
			//check if a user is logged in and has a valid role,
			//otherwise, assign them the default role(guest)
			if($this->auth->hasIdentity()){ //hasIdentity is a build in function in Zend in Auth. 
				$role=$this->auth->getIdentity()->user_type;
			}else{
				$role=$this->_defaultRole;
			}	
			
			if(!$this->acl->hasRole($role)){ //hasRole is a build in function in Zend
				$role = $this->_defaultRole;
			}
			//the ACL resource is the requested controller name
			$resource = $request->controller;			
			//the ACL privilege is the requested action name
			$privilege = $request->action;
			//if we havn't explicitly added the resource, check the default
			//global permissions
			if(!$this->acl->has($resource)){
				$resource = null;
			}
			//access denied - reroute the request to the default action handler
			if(!$this->acl->isAllowed($role, $resource, $privilege)){
				$request->setControllerName($this->_authController['controller']);
				$request->setActionName($this->_authController['action']);
			}
		}
	}
?>