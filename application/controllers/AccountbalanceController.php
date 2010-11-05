<?php
	/**account**
	*ALL account actions must be required to sign in!
	*/
	class AccountbalanceController extends CustomControllerAction
	{	
		/*init**********
		
		****************/
		public function init(){
			parent::init();
			$this->breadcrumbs->addStep('Account', $this->getUrl(null, 'account'));
		}
		
		/*init*********
		
		***************/
		public function preDispatch(){					
			parent::preDispatch();	
			if($this->auth->hasIdentity()){
				if(!isset($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress)){
					$this->userObject->createShippingAddressInfoSessionObject($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress);
				}
				$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
			} 
			//Zend_Debug::dump($_SERVER);
		}
	
		/*index***********
		******************/
		public function indexAction(){			
			$userAccountBalanceAndRewardPointProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $this->userObject);
			
			$rewardPointsAndBalanceRecords = $userAccountBalanceAndRewardPointProcessor->loadRewardPointsAndBalanceForUser();
			
			//echo 'user id is: '. $this->userObject->getId();
			Zend_Debug::dump($rewardPointsAndBalanceRecords);
			$this->view->rewardPointsAndBalanceRecords = $rewardPointsAndBalanceRecords;
			$this->view->accountBalance = $this->userObject->accountBalanceSummary;
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
		}
		
	}
?>