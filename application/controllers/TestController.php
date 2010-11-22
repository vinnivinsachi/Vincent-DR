<?php

class TestController extends Custom_Zend_Controller_Action
{
	protected $db;
    public function init() {
		parent::init();  // Because this is a custom controller class
    }
	
	public function preDispatch(){
		
		parent::preDispatch();
		
	}

    public function indexAction() {
        // action body
		echo 'stuff';
		//Zend_Debug::dump(Zend_Registry::get('config'));
		
		
		//$this->db = Zend_Registry::get('db');
		//Zend_Debug::dump($this->db);
		//$select = $this->db->select();
    }
    
    
    public function accountbalancetestingAction(){
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
		
			$user->accountRewardPointsAndBalanceSummary=$accountSummary;
			//$user->setAccountRewardPointsAndBalance($accountSummary);
			$accountSummaryMapper->save($accountSummary);
		}else{
			Zend_Debug::dump($accountSummaryTmp);
			$user->accountRewardPointsAndBalanceSummary=$accountSummaryTmp[0];
			
		}
		
		//******Post withdraws 
		
		/*$this->_db->beginTransaction();
		try{
			$userProcessor->widthdrawBalance(3);
			$this->_db->commit();
		}catch(Exception $e){
			$this->_db->rollback();
			echo $e->getMessage();
		}*/
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
		
		/*
			$this->_db->beginTransaction();
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
		
			echo 'updated reward point tracking is: '.$userProcessor->updatePendingRewardPointsAndBalanceForUser($user->accountRewardPointsAndBalanceSummary, $pendingRewardAndBalanceTracking);
			
			Zend_Debug::dump($user);
			Zend_Debug::dump($accountSummaryMapper->getAccountSummaryForUser($user));
			$this->_db->rollback();
		*/
		//***********end of the testing for updatePendingBalanceTrakcing 
    	$this->render('index');
    }
	
	//productListing testing section
	public function productsavetestingAction(){
	 	echo '<br/>';
	 	//enter new product. make sure that model works. 
	 	//after product is entered. make sure that image can be uploaded.
	 	//after product image is uploaded. 
	 	//make sure that inventory works now. 

	 	//$this->_db->beginTransaction();
	 	
	 	//try{

	 		$product = new Application_Model_Products_Product();
			//$product->productID=6;
			$product->purchaseType='CUSTIMIZE';
			$product->productCategory='WOMEN';
			$product->inventoryAttributeTable='shoes';
			$product->productTag='Ladies latin shoes';
			$product->productPriceRange = 'productPrice1';
			$product->domesticShippingRate=8.95;
			$product->internationalShippingRate=12.95;
			$product->sellerType='asdfe';
			$product->sellerDisplayName='professional ballroom shoes - Ann Arbor';
			$product->sellerName='professional-ballroom-shoes-ann-arbor';
			$product->url = 'asdfe';
			$product->name='asdfe';
			$product->price=65.95;
			$product->onSale=false;
			$product->brand='DanceNaturals';
			$product->returnAllowed=true;
			$product->flagged=false;
			$product->dateCreated=date('Y-m-d G:i:s');
			$product->status='UNLISTED';
			$product->rewardPoint=4;
			$product->backorderTime='5 weeks';
			$product->competitionUsage=true;
			$product->socialUsage=true;
			$product->lastStatusChange=date('Y-m-d G:i:s');
			$productMapper = new Application_Model_Mapper_Products_ProductsMapper();
			$productMapper->save($product);
			
			//$this->_db->rollback();
			
		//	$this->_db->commit();
	 	//}catch(Exception $e){
	 		//$this->_db->rollback();
	 	//	echo $e->getMessage();
	 	//}
	 	$this->render('index');
			
	}
	
	public function pruductimagesAction(){
		
	
	}
}

?>