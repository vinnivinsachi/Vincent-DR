<?php

class IndexController extends Custom_Zend_Controller_Action
{

    public function init() {
		parent::init();  // Because this is a custom controller class
    }

    public function indexAction() {
        // action body
    	
    	// STORES
//    	$store = new Application_Model_Stores_Store;
//    	$store->storeDisplayName = 'Dance Wear-Ann Arbor';
//    	$storeMapper = new Application_Model_Mapper_Stores_StoresMapper;
//    	//$storeMapper->storeDisplayNameAvailable($store->storeDisplayName);
//    	//$storeMapper->save($store);
    	
    	// USERS
//        $user = new Application_Model_Users_User;
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

	public function testAction(){
		$userMapper = new Application_Model_Mapper_Users_UsersMapper();
		
		$user = $userMapper->findByUsername('test1');
		
		$userProcessor = new Custom_Processor_Users_AccountBalanceAndRewardPointProcessor($user);
		$accountSummaryMapper = new Application_Model_Mapper_Users_AccountRewardPointsAndBalanceSummary();
		$accountSummaryTmp = $accountSummaryMapper->getAccountSummaryForUser($user);
		
		if(!$accountSummaryTmp){			
			$accountSummary = new Application_Model_Users_AccountRewardPointsAndBalanceSummary();
			$accountSummary->userID=$user->userID;
			$accountSummary->availableRewardPoints=8;
			$accountSummary->availableBalance=8;
			$accountSummary->ledgerBalance=8;
			$accountSummary->ledgerRewardPoints=8;
		
			$user->setAccountRewardPointsAndBalance($accountSummary);
			$accountSummaryMapper->save($accountSummary);
		}else{
			
			Zend_Debug::dump($accountSummaryTmp);
			$user->setAccountRewardPointsAndBalance($accountSummaryTmp[0]);
			
		}
		
		//******Post withdraws 
		
		$userProcessor->widthdrawBalance(3);
		//******END
		
		//******Post pending reward points 
		
		/*
		
		$userProcessor->cancelPendingRewardPointsAndBalanceForUser(2);*/
		
		//******END
		
		//******Post pending reward points for user
		
		/*$userMapper = new Application_Model_Mapper_Users_UsersMapper();
		
		$user = $userMapper->findByUsername('test1');
		
		$userProcessor = new Custom_Processor_Users_AccountBalanceAndRewardPointProcessor($user);
		
		$userProcessor->postPendingRewardPointsAndBalanceForUser(1);*/
		
		//*******END
		
		
		//******loading all pending reward points for user
		/*$userMapper = new Application_Model_Mapper_Users_UsersMapper();
		
		$user = $userMapper->findByUsername('test1');
		
		$userProcessor = new Custom_Processor_Users_AccountBalanceAndRewardPointProcessor($user);
		
		$pendingStuff = $userProcessor->loadRewardPointsAndBalanceForUser();
		
		Zend_Debug::dump($pendingStuff);*/
		//****END
		
		
		/***************testing updatePendingBalanceTracking*/
		
		/*$userMapper = new Application_Model_Mapper_Users_UsersMapper();
		
		//$userMapper->f
		$user = $userMapper->findByUsername('test1');
		
		$userProcessor = new Custom_Processor_Users_AccountBalanceAndRewardPointProcessor($user);
		
		
		
	
		
		$pendingRewardAndBalanceTracking = new Application_Model_Users_UserPendingRewardPointAndBalanceTracking();
		$pendingRewardAndBalanceTracking->trackingType='BALANCE_ADDITION';
		$amountType = $pendingRewardAndBalanceTracking->trackingType;

		$pendingRewardAndBalanceTracking->causedByType='fromOrderProfileID';
		$causedByColumn = $pendingRewardAndBalanceTracking->causedByType;
		$pendingRewardAndBalanceTracking->$causedByColumn=1;
		$pendingRewardAndBalanceTracking->description='Bloody hell';
		$pendingRewardAndBalanceTracking->status = 'PENDING';
		$pendingRewardAndBalanceTracking->$amountType=5;
	
		//must fetch the accountRewardPointsAndBalanceSummary for user first. 
		//must then apply that fetched accountRewardPoints for the processor.
	
		echo 'updated reward point tracking is: '.$userProcessor->updatePendingRewardPointsAndBalanceForUser($user->getAccountRewardPointsAndBalanceSummary(), $pendingRewardAndBalanceTracking);
		
		Zend_Debug::dump($user);
		Zend_Debug::dump($accountSummaryMapper->getAccountSummaryForUser($user));
		*/
		//***********end of the testing for updatePendingBalanceTrakcing 
	}
}

?>