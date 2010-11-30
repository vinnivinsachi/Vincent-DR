<?php

class IndexController extends Custom_Zend_Controller_Action
{

    public function init() {
		parent::init();  // Because this is a custom controller class
    }

    public function indexAction() {
        // action body

    	// LINK TABLES
//    	$mapper = new Application_Model_Mapper_Stores_StoresUsersLinksMapper;
//    	$exists = $mapper->linkExists(3, 64);
//    	$users = $mapper->getUsersForStore(3);
    	
    	// STORES
//    	$store = new Application_Model_Stores_Store;
//    	$store->storeDisplayName = 'Dance Wear-Ann Arbor';
//    	$storeMapper = new Application_Model_Mapper_Stores_StoresMapper;
//    	//$storeMapper->storeDisplayNameAvailable($store->storeDisplayName);
//    	//$storeMapper->save($store);
    	
    	// USERS
//        $user = new Application_Model_Users_User;
//        $mapper = new $user->_mapperClass;
//        $user = $mapper->find(64);
//        
//        Zend_Debug::dump($user);
//        $user->profiles = new Application_Model_Profiles;
//        $user->profiles->color = 'blue';
//        $user->profiles->dress = null;
//        $user->userID = '64';
//        $user->profiles->size = 'small';
//        $mapper = new Application_Model_Mapper_ExampleMapper;
//        $mapper->saveForAssociatedID($user->profiles, $user->userID);
//        print var_dump($user);
    }
}
