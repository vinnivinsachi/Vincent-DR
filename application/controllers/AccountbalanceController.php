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
		
	}
?>