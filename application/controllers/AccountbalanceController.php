<?php
	/**account**
	*ALL account actions must be required to sign in!
	*/
	class AccountbalanceController extends Custom_Zend_Controller_Action
	{	
		/*init**********
		loading the testing user
		****************/
		
		//private $status = array('PENDING', 'POSTED', 'CANCELLED');
		//private $_arrayTrackingTypeColumn = array('REWARD_ADDITION' =>'addedRewardPoints', 'REWARD_DEDUCTION'=>'deductedRewardPoints', 'BALANCE_DEDUCTION'=>'deductedDollarAmount', 'BALANCE_ADDITION'=>'addedDollarAmount');
		
		public function init(){
			parent::init();
			
			//$userMapper = new Application_Model_Mapper_Users_UsersMapper();
			$this->user = new Application_Model_Users_User();
			$this->user->userID = 1;
			
			//$this->user = $userMapper->findByUniqueID('MqIquFxXrS');
			//$this->user->
		}
		
		/*init*********
		
		***************/
		public function preDispatch(){					
			parent::preDispatch();	
			
			//Zend_Debug::dump($_SERVER);
		}
	
		/*index***********
		******************/
		public function indexAction(){			
			
			
			/*$userAccountBalanceAndRewardPointProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $this->userObject);
			
			$rewardPointsAndBalanceRecords = $userAccountBalanceAndRewardPointProcessor->loadRewardPointsAndBalanceForUser();
			
			//echo 'user id is: '. $this->userObject->getId();
			Zend_Debug::dump($rewardPointsAndBalanceRecords);
			$this->view->rewardPointsAndBalanceRecords = $rewardPointsAndBalanceRecords;
			$this->view->accountBalance = $this->userObject->accountBalanceSummary;*/
		}
		
		public function balancewithdrawAction(){
			
			//$withdrawForm = new FormProcessor_Account_UserBalanceWithdraw($this->db, $this->userObject);
			$amount = $this->getRequest()->getParam('widthdrawAmount');
			
			if($this->getRequest()->isPost()){
				echo 'withdrawing';
				if($amount < $this->userObject->accountBalanceSummary->available_balance){
				$userAccountBalanceAndRewardPointProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $this->userObject);
					
				$userAccountBalanceAndRewardPointProcessor->widthdrawBalance($amount);
				}else{
					echo 'ERROR: you do not have enough to withdraw this sum';	
				}
			}else{
				//not posted
			}
			
			$currentWithdraws = DatabaseObject_Helper_UserManager::loadUserWithdraws($this->db, $this->userObject->getId());
			$this->view->currentWithdraws = $currentWithdraws;
			$this->view->accountBalance = $this->userObject->accountBalanceSummary;

		}
		
		public function balancetransferAction(){
			
			$amount = $this->getRequest()->getParam('transferAmount');
			$targetUserEmail = $this->getRequest()->getParam('targetEmail');
			
			$message = $this->getRequest()->getParam('message');
			if($this->getRequest()->isPost()){
				
				if($amount < $this->userObject->accountBalanceSummary->available_balance){
				
					//$targetUser = new DatabaseObject_User($this->db);
					//if($targetUser->loadByEmail($targetUserEmail)){
					
					$userAccountBalanceAndRewardPointProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $this->userObject);
					
					if($userAccountBalanceAndRewardPointProcessor->transferBalance($amount, $targetUserEmail, $message)){
						
					echo 'processed';
					
					}else{
						echo 'NOT processed. ERROR occured';
					}
					//}
				}
			}else{
				//not posted
			}
			
			$this->view->accountBalance = $this->userObject->accountBalanceSummary;
			$transfers = DatabaseObject_Helper_UserManager::loadUserTransferes($this->db, $this->userObject->getId());
			Zend_Debug::dump($transfers);
			$this->view->transfers = $transfers;
			
		}
		
	}
?>