<?php

	class Custom_Processor_Users_AccountBalanceAndRewardPointProcessor
	{
		
		private $pendingRPAndBalanceMapper;
		private $userAccountBalanceSummaryMapper;
		private $accountBalanceWithdrawTrackingMapper;
		private $accountBalanceSummary;
		public $user;
		private $status = array('PENDING', 'POSTED', 'CANCELLED');
		
		public function __construct(Application_Model_Users_User $user){
			
			
			$this->user= $user;
			$this->pendingRPAndBalanceMapper= new Application_Model_Mapper_Users_UserPendingRewardPointAndBalanceTracking();
			$this->userAccountBalanceSummaryMapper= new Application_Model_Mapper_Users_AccountRewardPointsAndBalanceSummary();
			
		}
		
		public function loadRewardPointsAndBalanceForUser($params = array()){
			
			return $this->pendingRPAndBalanceMapper->loadAllUserRecords($this->user, $params);
		}
		
		public function updatePendingRewardPointsAndBalanceForUser($trackingType, Application_Model_Users_UserPendingRewardPointAndBalanceTracking $pendingAccountBalanceTracking)
		{
			echo 'here';
			
			//$pendingRewardPointModel = new Application_Model_Users_UserPendingRewardPointAndBalanceTracking();
			//$this->pendingRewardPointAndBalanceTracking= new DatabaseObject_Account_UserPendingRewardPointAndBalanceTracking($this->db);
			//echo 'user id is: '.$this->user->getId();

			$currentUserAccountBalance = $this->userAccountBalanceSummaryMapper->getAccountSummaryForUser($this->user);
			
			Zend_Debug::dump($currentUserAccountBalance);
			
			$trackingType = $pendingAccountBalanceTracking->trackingType;
			//process the account.
			//$amountType = $pendingRewardAndBalanceTracking->trackingType;

			$this->userAccountBalanceSummaryMapper->$trackingType($currentUserAccountBalance[0], 'PENDING', $pendingAccountBalanceTracking->$trackingType);
			//and save the account.
			$this->userAccountBalanceSummaryMapper->save($currentUserAccountBalance[0]);
			echo 'after change';
			Zend_Debug::dump($currentUserAccountBalance[0]);
			//register the pendingRewardPointModel 
			
			
			
			Zend_Debug::dump($pendingAccountBalanceTracking);
			$pendingAccountBalanceTracking->userID = $this->user->userID;
			return $this->pendingRPAndBalanceMapper->save($pendingAccountBalanceTracking); 
		}
		
		
		public function postPendingRewardPointsAndBalanceForUser($pendingTrackingId){
			
			$currentProcessingPendingTracking = $this->pendingRPAndBalanceMapper->loadUserPendingTrackingFromTrackingID($this->user, $pendingTrackingId);
			if($currentProcessingPendingTracking){
				
				$trackingType = $currentProcessingPendingTracking->trackingType;
			
				$amount = $currentProcessingPendingTracking->$trackingType;
				
				$currentUserAccountBalance = $this->userAccountBalanceSummaryMapper->getAccountSummaryForUser($this->user);
				
				$this->userAccountBalanceSummaryMapper->$trackingType($currentUserAccountBalance[0], 'POSTED', $currentProcessingPendingTracking->$trackingType);
				
				Zend_Debug::dump($currentProcessingPendingTracking);
				
				
				$currentProcessingPendingTracking->status='POSTED';
				$currentProcessingPendingTracking->dateUpdated=date('Y-m-d G:i:s');
				$this->pendingRPAndBalanceMapper->save($currentProcessingPendingTracking);
				
				echo 'processing here';
				
				//fetch the account summary here, and edit them. 
				
			}
		}
		
		//can't cancell unless the pendingTrackingId status is PENDING 
		public function cancelPendingRewardPointsAndBalanceForUser($pendingTrackingId)
		{
			$currentProcessingPendingTracking = $this->pendingRPAndBalanceMapper->loadUserPendingTrackingFromTrackingID($this->user, $pendingTrackingId);
			if($currentProcessingPendingTracking){
				
				$trackingType = $currentProcessingPendingTracking->trackingType;
			
				$amount = $currentProcessingPendingTracking->$trackingType;
				
				$currentUserAccountBalance = $this->userAccountBalanceSummaryMapper->getAccountSummaryForUser($this->user);
				
				$this->userAccountBalanceSummaryMapper->$trackingType($currentUserAccountBalance[0], 'CANCELLED', $currentProcessingPendingTracking->$trackingType);
				
				Zend_Debug::dump($currentProcessingPendingTracking);
				
				
				$currentProcessingPendingTracking->status='CANCELLED';
				$currentProcessingPendingTracking->dateUpdated=date('Y-m-d G:i:s');
				$this->pendingRPAndBalanceMapper->save($currentProcessingPendingTracking);	
			}
		}
		
		//
		
		public function widthdrawBalance($amount){
			
			$this->accountBalanceWithdrawTrackingMapper = new Application_Model_Mapper_Users_UserAccountBalanceWithdrawTracking();
			
			$accountBalanceWithdrawTracking = new Application_Model_Users_UserAccountBalanceWithdrawTracking();
			
			$accountBalanceWithdrawTracking->userID = $this->user->userID;
			$accountBalanceWithdrawTracking->balanceWithdrawAmount = $amount;
			
			//set up pending stuff.
			$pendingRewardAndBalanceTracking = new Application_Model_Users_UserPendingRewardPointAndBalanceTracking();
			$pendingRewardAndBalanceTracking->trackingType='BALANCE_DEDUCTION';
			$pendingRewardAndBalanceTracking->userID=$this->user->userID;
			$amountType = $pendingRewardAndBalanceTracking->trackingType;
			$pendingRewardAndBalanceTracking->causedByType='causedByUserID';
			$causedByColumn = $pendingRewardAndBalanceTracking->causedByType;
			$pendingRewardAndBalanceTracking->$causedByColumn=$this->user->userID;
			$pendingRewardAndBalanceTracking->description='Withdraw of $'.$amount.' USD from user DanceRialto account balance';
			$pendingRewardAndBalanceTracking->status = 'PENDING';
			$pendingRewardAndBalanceTracking->$amountType=$amount;
			$pendingRewardAndBalanceTrackingID=$this->pendingRPAndBalanceMapper->save($pendingRewardAndBalanceTracking);
			
			Zend_Debug::dump($pendingRewardAndBalanceTracking);
			
			$accountBalanceWithdrawTracking->pendingTrackingID=$pendingRewardAndBalanceTrackingID;
			$accountBalanceWithdrawTracking->status='PENDING';
			Zend_Debug::dump($accountBalanceWithdrawTracking);
			
			$this->accountBalanceWithdrawTrackingMapper->save($accountBalanceWithdrawTracking);
			Zend_Debug::dump($accountBalanceWithdrawTracking);
			
			//update users. 
			$accountSummaryMapper = new Application_Model_Mapper_Users_AccountRewardPointsAndBalanceSummary();
			$accountSummaryTmp = $accountSummaryMapper->getAccountSummaryForUser($this->user);
			$this->updatePendingRewardPointsAndBalanceForUser($accountSummaryTmp, $pendingRewardAndBalanceTracking);
			
			/*
			$this->accountBalanceWithdrawTracking = new DatabaseObject_Account_UserAccountBalanceWithdrawTracking($this->db);

			$this->accountBalanceWithdrawTracking->user_id=$this->user->getId();
			$this->accountBalanceWithdrawTracking->balance_withdraw_amount = $amount;
			$userPendingTracking = $this->updatePendingRewardPointsAndBalanceForUser('BALANCE_DEDUCTION', $amount, 'caused_by_user_id', $this->user->getId(), 'Withdraw of $'.$amount.' USD from user DanceRialto account balance');
			$this->accountBalanceWithdrawTracking->pending_tracking_id = $userPendingTracking;
			if($this->accountBalanceWithdrawTracking->save()){
				echo 'withdraw successful';
			}else{
				echo 'not working';
			}
			*/
		}
		
		public function transferBalance($amount, $targetUserEmail, $message=''){
			
			$this->accountBalanceTransferTracking= new DatabaseObject_Account_UserAccountBalanceTransferTracking($this->db);
			$this->accountBalanceTransferTracking->from_user_id=$this->user->getId();
			$this->accountBalanceTransferTracking->to_user_email=$targetUserEmail;
			$this->accountBalanceTransferTracking->balance_transfer_amount = $amount;
			$this->accountBalanceTransferTracking->message = $message;
			
			$targetUser = new DatabaseObject_User($this->db);
			if($targetUser->loadByEmail($targetUserEmail)){
				
				$this->accountBalanceTransferTracking->to_user_id=$targetUser->getId();
				$this->accountBalanceTransferTracking->to_username=$targetUser->username;
						
				$sender_pending_tracking_id = $this->updatePendingRewardPointsAndBalanceForUser('BALANCE_DEDUCTION', $amount, 'caused_by_user_id', $this->user->getId(), 'Transfer of $'.$amount.' USD to username '.$targetUser->username);
				$targetUserBalanceProcessor=new AccountBalanceAndRewardPointProcessor($this->db, $targetUser);
				$receiver_pending_tracking_id=$targetUserBalanceProcessor->updatePendingRewardPointsAndBalanceForUser('BALANCE_ADDITION', $amount, 'caused_by_user_id', $this->user->getId(), $this->user->username.'transfered $'.$amount.' USD to you');
						
				$this->accountBalanceTransferTracking->sender_pending_tracking_id= $sender_pending_tracking_id;
				$this->accountBalanceTransferTracking->receiver_pending_tracking_id = $receiver_pending_tracking_id;
				$this->accountBalanceTransferTracking->to_user_id = $targetUser->getId();
				
				if($this->accountBalanceTransferTracking->save()){
					return true;
				}else{
					echo 'save failed';
					//need to log this VERY IMPORTANT!
					return false;
				}
			}else{
				echo 'email not found in system';
				return false;
			}
		}
		
		public function checkCartCompletion($orderUniqueId)
		{
			return $this->user->accountBalanceSummary->areEverySingleItemInCartProcessedInPendingAccountAndBalanceTrackingForOrderId($orderUniqueId);
		}
	}
?>